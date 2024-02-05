<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StuntingController extends Controller
{
    public function getDetail($ulid)
    {
        $url = env('API_BE_SIMS') . "/stunting/{$ulid}";
        $data = file_get_contents($url);
        $dataArray = json_decode($data, true);
        return view('pages.dinkes.stunting.detaildataMap', compact('dataArray'));
    }
}
