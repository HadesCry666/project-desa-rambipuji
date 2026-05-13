<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\master_surat;

class SuratControllerMobile extends Controller
{
    public function index()
    {
        $surat = master_surat::get();

        return response()->json($surat);
    }
}