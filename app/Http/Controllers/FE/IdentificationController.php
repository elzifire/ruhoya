<?php

namespace App\Http\Controllers\FE;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Hoya;
use App\Models\Morfology;
use App\Models\Enumeration;

class IdentificationController extends Controller
{
    public function index(Request $request)
    {
        $morfologies = Morfology::get();
        $morfologies    = $morfologies->map(function($morfology) {
            $morfology->options = Enumeration::where("key", $morfology->yes_no_question ? "Yes_No_Question" : "Morfologi_" . $morfology->slug)->get();
            return $morfology;
        });

        $filters    = [];
        $keys       = $morfologies->map(function($morfology) { return $morfology->slug; });
        foreach ($keys as $key) {
            if ($request->has($key) && !empty($request[$key])) {
                $filters[$key] = $request[$key];
            }
        }

        if (count($filters) >= 1) {
            $filtered = $this->identification($filters, $keys);
            $data["results"] = collect($filtered)->sortByDesc("similarity")->paginate(20)->withQueryString();
        }

        $data["morfologies"] = $morfologies->groupBy("group");
        return view("pages.fe.identification.index", $data);
    }

    private function identification($filters, $keys)
    {
        // $contents = Storage::get('hoya.json');
        // $contents = json_decode($contents);
        $contents = Hoya::with("hoyaMorfologies")->get();

        // if (!is_array($contents)) return null;

        $filtered = [];
        foreach ($contents as $content) {
            // $content = (array)$content;
            $similarity = 0;
            $this->checkCondition($content, $filters, $similarity);
            $content->similarity = round(($similarity / count($keys)), 2);
            
            if ($content->similarity >= 0.15)
                $filtered[] = $content;
        }
        

        return $filtered;
    }
    
    private function checkCondition($row, $conditions, &$similarity)
    {
        foreach ($conditions as $key => $value) {
            foreach ($row->hoyaMorfologies as $index => $hoyaMorfology) {
                if ((isset($hoyaMorfology->morfology) && $hoyaMorfology->morfology->slug === $key && $hoyaMorfology->value === $value)) {
                    $similarity += 1;
                }
            }
        }
    }
}
