<?php

namespace App\Http\Controllers\BE;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;

use App\Helpers\HttpStatus;
use App\Helpers\HttpMessage;

use App\Models\Base\ResponseModel;
use App\Models\Hoya as Model;
use App\Models\HoyaImage;
use App\Models\HoyaSpread;
use App\Models\HoyaSequence;
use App\Models\HoyaMorfology;
use App\Models\Morfology;
use App\Models\Enumeration;

use App\Exports\HoyaExport;
use App\Imports\HoyaImport;
use Maatwebsite\Excel\Facades\Excel;

use DB;
use DataTables;

class HoyaController extends Controller
{

    public function index()
    {
        $dnaTypes = Enumeration::where("key", "DNASequenceType")->get();
        return view('pages.be.hoya.index', compact("dnaTypes"));
    }

    public function api(Request $request)
    {
        $model = Model::with("hoyaMorfologies")->orderBy("created_at", "DESC");
        return DataTables::eloquent($model)
                ->filter(function ($query) use ($request) {
                    $filterable = [
                        "name",
                        "local_name",
                        "author",
                        "origin",
                        "type_information",
                        "publication",
                        "publication_link",
                        "etymology",
                        "benefit",
                        "description",
                        "stem",
                        "leaves",
                        "flowers",
                        "flower_buds",
                        "flower_size",
                        "flower_colors",
                        "roots",
                        "shoots",
                    ];

                    $search = $request["search"]["value"];
                    if ($search) {
                        foreach ($filterable as $key => $column) {
                            $query->orWhere($column, "like", "%$search%");
                        }    
                    }
                })
                ->addIndexColumn()
                ->addColumn('name', function($data) {
                    return "Hoya <i>{$data->name}</i>, <b>{$data->author}</b>";
                })
                ->addColumn('morfology_created', function($data) {
                    $morfologyCount = Morfology::count();
                    $count = $data->hoyaMorfologies()->where("value", "!=", null)->count();
                    return "<h5><span class='badge text-bg-success'>{$count}/{$morfologyCount}</span></h5>";
                })
                ->addColumn('action', function($data) {
                    return view("components.action", [
                        "edit"      => url("admin/hoya/edit/".$data->id),
                        "delete"    => url("admin/hoya/delete/".$data->id),
                    ]);
                })
                ->smart(false)
                ->rawColumns(['name', 'action', 'morfology_created'])
                ->make(true);
    }

    public function create()
    {
        $action = url('admin/hoya/store');
        $benefits   = Enumeration::where("key", "Benefit")->get();
        $dnaTypes   = Enumeration::where("key", "DNASequenceType")->get();
        $morfologies    = Morfology::get();
        $morfologies    = $morfologies->map(function($morfology) {
            $morfology->options = Enumeration::where("key", $morfology->yes_no_question ? "Yes_No_Question" : "Morfologi_" . $morfology->slug)->get();
            return $morfology;
        })
        ->groupBy("group");

        return view("pages.be.hoya.form", compact("action", "morfologies", "benefits", "dnaTypes"));
    }

    public function store(Request $request)
    {
        if (Storage::exists('hoya.json') === false) {
            Storage::put('hoya.json', json_encode([]));
        }

        $contents = Storage::get('hoya.json');
        $contents = json_decode($contents);

        $response = new ResponseModel(HttpStatus::SUCCESS, HttpMessage::SUCCESS_INSERT);

        $payload = $request->all();
        $validator = Validator::make($payload, Model::rules());

        if ($validator->fails()) {
            $response->status_code  = HttpStatus::VALIDATION_ERROR;
            $response->message      = HttpMessage::VALIDATION_ERROR;
            $response->errors       = $validator->errors();
            return response()->json($response, $response->status_code);
        }

        DB::beginTransaction();
        try {
            $hoyaImages     = $payload["hoya_images"] ?? [];
            $hoyaSpreads    = $payload["hoya_spreads"] ?? [];
            $hoyaSequences  = $payload["hoya_sequences"] ?? [];
            $hoyaMorfologies    = $payload["morfology"] ?? [];
            $payload["benefit"] = implode(",", $payload["benefit"] ?? []);

            unset($payload["hoya_images"], $payload["hoya_spreads"], $payload["hoya_sequences"], $payload["morfology"]);

            $data = Model::create($payload);
            $hoyaId = $data->id;

            $this->checkForBenefitEnumeration($request->benefit);

            $response->data = $data;
            $response->data->hoya_images    = [];
            $response->data->hoya_spreads   = [];
            $response->data->hoya_sequences   = [];

            foreach ($hoyaMorfologies as $key => $morfology) {
                HoyaMorfology::updateOrCreate(
                    ["hoya_id" => $hoyaId, "morfology_id" => $morfology["id"]],
                    ["hoya_id" => $hoyaId, "morfology_id" => $morfology["id"], "value" => $morfology["value"]]
                );
            }

            foreach ($hoyaImages as $key => $hoyaImage) {
                $validator = Validator::make($hoyaImage, HoyaImage::rules());

                if ($validator->fails()) {
                    $response->status_code  = HttpStatus::VALIDATION_ERROR;
                    $response->message      = HttpMessage::VALIDATION_ERROR;
                    $response->errors       = $validator->errors();
                    $response->data         = null;
                    return response()->json($response, $response->status_code);
                }

                HoyaImage::create([
                    "hoya_id"       => $hoyaId,
                    "image"         => $hoyaImage["file"]->store("hoya"),
                    "description"   => $hoyaImage["description"],
                    "photographer"  => $hoyaImage["photographer"]
                ]);
            }

            foreach ($hoyaSpreads as $key => $hoyaSpread) {
                $validator = Validator::make($hoyaSpread, HoyaSpread::rules());

                if ($validator->fails()) {
                    $response->status_code  = HttpStatus::VALIDATION_ERROR;
                    $response->message      = HttpMessage::VALIDATION_ERROR;
                    $response->errors       = $validator->errors();
                    $response->data         = null;
                    return response()->json($response, $response->status_code);
                }

                HoyaSpread::create([
                    "hoya_id"       => $hoyaId,
                    "latitude"      => $hoyaSpread["latitude"],
                    "longitude"     => $hoyaSpread["longitude"],
                    "description"   => $hoyaSpread["description"]
                ]);
            }

            foreach ($hoyaSequences as $key => $hoyaSequence) {
                $validator = Validator::make($hoyaSequence, HoyaSequence::rules());

                if ($validator->fails()) {
                    $response->status_code  = HttpStatus::VALIDATION_ERROR;
                    $response->message      = HttpMessage::VALIDATION_ERROR;
                    $response->errors       = $validator->errors();
                    $response->data         = null;
                    return response()->json($response, $response->status_code);
                }

                HoyaSequence::create([
                    "hoya_id"       => $hoyaId,
                    "dna_type"      => $hoyaSequence["dna_type"],
                    "dna_sequence"  => $hoyaSequence["dna_sequence"],
                    "link"          => $hoyaSequence["link"]
                ]);
            }

            array_push($contents, collect($data)->except(["hoya_images", "hoya_spreads", "hoya_sequences"])->toArray());
            Storage::put("hoya.json", json_encode($contents));

    		DB::commit();

            return response()->json($response);
        } catch (Exception $e) {
            DB::rollback();

            $response->status_code  = HttpStatus::INTERNAL_SERVER_ERROR;
            $response->message      = $e->getMessage();
            return response()->json($response);
        }
    
    }

    public function edit($id)
    {
        $action = url('admin/hoya/update/' . $id);
        $data   = Model::findOrFail($id);
        $benefits   = Enumeration::where("key", "Benefit")->get();
        $dnaTypes = Enumeration::where("key", "DNASequenceType")->get();

        $morfologies    = Morfology::get();
        $morfologies    = $morfologies->map(function($morfology) {
            $morfology->options = Enumeration::where("key", $morfology->yes_no_question ? "Yes_No_Question" : "Morfologi_" . $morfology->slug)->get();
            return $morfology;
        })
        ->groupBy("group");

        return view("pages.be.hoya.form", compact("action", "data", "morfologies", "benefits", "dnaTypes"));
    }

    public function update(Request $request, $id)
    {
        if (Storage::exists('hoya.json') === false) {
            Storage::put('hoya.json', json_encode([]));
        }

        $contents = Storage::get('hoya.json');
        $contents = json_decode($contents);

        $response = new ResponseModel(HttpStatus::SUCCESS, HttpMessage::SUCCESS_UPDATE);

        $payload = $request->all();
        $validator = Validator::make($payload, Model::rules());

        if ($validator->fails()) {
            $response->status_code  = HttpStatus::VALIDATION_ERROR;
            $response->message      = HttpMessage::VALIDATION_ERROR;
            $response->errors       = $validator->errors();
            return response()->json($response, $response->status_code);
        }

        DB::beginTransaction();
        try {
            $hoyaImages     = $payload["hoya_images"] ?? [];
            $hoyaSpreads    = $payload["hoya_spreads"] ?? [];
            $hoyaSequences  = $payload["hoya_sequences"] ?? [];
            $hoyaMorfologies    = $payload["morfology"] ?? [];
            $payload["benefit"] = implode(",", $payload["benefit"] ?? []);

            unset($payload["hoya_images"], $payload["hoya_spreads"], $payload["hoya_sequences"], $payload["morfology"]);

            $data   = Model::findOrFail($id);
            $data->update($payload);
            $hoyaId = $data->id;

            $this->checkForBenefitEnumeration($request->benefit);

            $response->data = $data;
            $response->data->hoya_images    = [];
            $response->data->hoya_spreads   = [];
            $response->data->hoya_sequences   = [];

            $hoyaImageIds   = [];
            $hoyaSpreadIds  = [];
            $hoyaSequenceIds  = [];

            foreach ($hoyaMorfologies as $key => $morfology) {
                HoyaMorfology::updateOrCreate(
                    ["hoya_id" => $hoyaId, "morfology_id" => $morfology["id"]],
                    ["hoya_id" => $hoyaId, "morfology_id" => $morfology["id"], "value" => $morfology["value"]]
                );
            }

            foreach ($hoyaImages as $key => $hoyaImage) {
                $validator = Validator::make($hoyaImage, HoyaImage::rules(true));

                if ($validator->fails()) {
                    $response->status_code  = HttpStatus::VALIDATION_ERROR;
                    $response->message      = HttpMessage::VALIDATION_ERROR;
                    $response->errors       = $validator->errors();
                    $response->data         = null;
                    return response()->json($response, $response->status_code);
                }

                $payload = [
                    "hoya_id"       => $hoyaId,
                    "description"   => $hoyaImage["description"],
                    "photographer"  => $hoyaImage["photographer"]
                ];

                if (isset($hoyaImage["file"]))
                    $payload["image"] = $hoyaImage["file"]->store("hoya");

                if (isset($hoyaImage["id"])) {
                    $hoyaImage  = HoyaImage::findOrFail($hoyaImage["id"]);
                    $hoyaImage->update($payload);
                } else {
                    $hoyaImage = HoyaImage::create($payload);
                }

                array_push($hoyaImageIds, $hoyaImage->id);
            }

            foreach ($hoyaSpreads as $key => $hoyaSpread) {
                $validator = Validator::make($hoyaSpread, HoyaSpread::rules());

                if ($validator->fails()) {
                    $response->status_code  = HttpStatus::VALIDATION_ERROR;
                    $response->message      = HttpMessage::VALIDATION_ERROR;
                    $response->errors       = $validator->errors();
                    $response->data         = null;
                    return response()->json($response, $response->status_code);
                }

                $payload = [
                    "hoya_id"       => $hoyaId,
                    "latitude"      => $hoyaSpread["latitude"],
                    "longitude"     => $hoyaSpread["longitude"],
                    "description"   => $hoyaSpread["description"]
                ];

                if (isset($hoyaSpread["id"])) {
                    $hoyaSpread  = HoyaSpread::findOrFail($hoyaSpread["id"]);
                    $hoyaSpread->update($payload);
                } else {
                    $hoyaSpread = HoyaSpread::create($payload);
                }

                array_push($hoyaSpreadIds, $hoyaSpread["id"]);
            }

            foreach ($hoyaSequences as $key => $hoyaSequence) {
                $validator = Validator::make($hoyaSequence, HoyaSequence::rules());

                if ($validator->fails()) {
                    $response->status_code  = HttpStatus::VALIDATION_ERROR;
                    $response->message      = HttpMessage::VALIDATION_ERROR;
                    $response->errors       = $validator->errors();
                    $response->data         = null;
                    return response()->json($response, $response->status_code);
                }

                $payload = [
                    "hoya_id"       => $hoyaId,
                    "dna_type"      => $hoyaSequence["dna_type"],
                    "dna_sequence"  => $hoyaSequence["dna_sequence"],
                    "link"          => $hoyaSequence["link"]
                ];

                if (isset($hoyaSequence["id"])) {
                    $hoyaSequence  = HoyaSequence::findOrFail($hoyaSequence["id"]);
                    $hoyaSequence->update($payload);
                } else {
                    $hoyaSequence = HoyaSequence::create($payload);
                }

                array_push($hoyaSequenceIds, $hoyaSequence["id"]);
            }

            HoyaImage::where("hoya_id", $hoyaId)->whereNotIn("id", $hoyaImageIds)->delete();
            HoyaSpread::where("hoya_id", $hoyaId)->whereNotIn("id", $hoyaSpreadIds)->delete();
            HoyaSequence::where("hoya_id", $hoyaId)->whereNotIn("id", $hoyaSequenceIds)->delete();

            $contentIndex = collect($contents)->search(function($content) use ($id) {
                return $content->id == $id;
            });

            if ($contentIndex !== false) {
                $contents[$contentIndex] = collect($data)->except(["hoya_images", "hoya_spreads", "hoya_sequences"])->toArray();
            } else {
                $contents[] = collect($data)->except(["hoya_images", "hoya_spreads", "hoya_sequences"])->toArray();
            }

            Storage::put("hoya.json", json_encode($contents));
            
    		DB::commit();
            $response->data = $data;

            return response()->json($response, $response->status_code);
        } catch (Exception $e) {
            DB::rollback();

            $response->status_code  = HttpStatus::INTERNAL_SERVER_ERROR;
            $response->message      = $e->getMessage();
            return response()->json($response);
        }
    }

    public function destroy($id)
    {
        $response = new ResponseModel(HttpStatus::SUCCESS, HttpMessage::SUCCESS_DELETE);

        DB::beginTransaction();
        try 
        {
            $data   = Model::findOrFail($id);
            $data->delete();

            DB::commit();

            return response()->json($response, $response->status_code);
        }
        catch (Exception $e) 
        {
            DB::rollback();

            $response->status_code  = HttpStatus::INTERNAL_SERVER_ERROR;
            $response->message      = $e->getMessage();
            return response()->json($response, $response->status_code);
        }
    }

    public function export()
    {
        $t = date('dmyHis');
        return Excel::download(new HoyaExport, "hoya-{$t}.xlsx");
    }

    public function import()
    {
        $action = url('/admin/hoya/upload');
        return view("pages.be.hoya.import", compact("action"));
    }

    public function upload(Request $request)
    {
        $response = new ResponseModel(HttpStatus::SUCCESS, HttpMessage::SUCCESS_IMPORT);

        try {
            Excel::import(new HoyaImport, $request->file("file"));
            return response()->json($response);
        } catch (Exception $e) {
            $response->status_code  = HttpStatus::INTERNAL_SERVER_ERROR;
            $response->message      = $e->getMessage();
            return response()->json($response, $response->status_code);
        }
    }

    private function checkForBenefitEnumeration($benefits)
    {
        if (!is_array($benefits)) return;
        foreach ($benefits as $index => $benefit) {
            $count = Enumeration::where("value", $benefit)->count();
            if ($count < 1) Enumeration::insert([
                "group" => "Benefit",
                "key"   => "Benefit",
                "value" => $benefit
            ]);
        }
    }
}
