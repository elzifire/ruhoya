<?php

namespace App\Http\Controllers\FE;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Hoya;
use App\Models\Enumeration;

class IdentificationController extends Controller
{
    public function index(Request $request)
    {
        foreach (Hoya::ENUM_MORFOLOGY_KEYS as $key => $enum)
            $data[$enum] = Enumeration::where("key", $enum)->get();

        $filters    = [];
        $keys       = [
            "stem",
            "leaves",
            "flowers",
            "flower_buds",
            "flower_size",
            "flower_colors",
            "roots",
            "shoots"
        ];

        foreach ($keys as $key) {
            if ($request->has($key) && !empty($request[$key])) {
                $filters[$key] = $request[$key];
            }
        }

        if (count($filters) >= 1) {
            $filtered = $this->identification($filters, $keys);
            $data["results"] = collect($filtered)->paginate(20)->withQueryString();
        }

        return view("pages.fe.identification.index", $data);
    }

    private function identification($filters, $keys)
    {
        $contents = Storage::get('hoya.json');
        $contents = json_decode($contents);

        if (!is_array($contents)) return null;

        $filtered = [];
        foreach ($contents as $content) {
            $content = (array)$content;
            $similarity = 0;
            if ($this->checkCondition($content, $filters, $similarity)) {
                $filtered[] = array_merge($content, ["similarity" => round(($similarity / count($keys) * 100), 2)]);
            }
        }

        return collect($filtered)->map(function($item) { return (object)$item; });
    }

    private function checkCondition($row, $conditions, &$similarity)
    {
        foreach ($conditions as $key => $value) {
            if (!isset($row[$key]) || $row[$key] !== $value) {
                return false;
            }
        }
        
        $similarity += 1;
        return true;
    }
}
