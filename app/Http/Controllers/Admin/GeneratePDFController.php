<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\master_penduduk;
use App\Models\master_kartukeluarga;

use PDF; 

class GeneratePDFController extends Controller
{

public function generateAndStorePdf($id_pengajuan)
{
    $data = DB::table('view_data_pengajuan')->where('id_pengajuan', $id_pengajuan)->first();
    if (!$data) {
        return response()->json(['success' => false, 'message' => 'Data tidak ditemukan.'], 404);
    }

    $surat = DB::table('master_surat')->where('id_surat', $data->id_surat)->first();
    if (!$surat || !$surat->nama_surat) {
        return response()->json(['success' => false, 'message' => "Data surat tidak ditemukan."], 404);
    }

    $viewName = "generate." . strtolower(str_replace(' ', '', $surat->nama_surat));
    if (!view()->exists($viewName)) {
        return response()->json(['success' => false, 'message' => "Template surat untuk '{$surat->nama_surat}' tidak ditemukan."], 404);
    }

    $pdf = PDF::loadView($viewName, compact('data'))->setPaper('A4', 'portrait');

    $fileName = "{$data->id_surat}" . Str::slug($data->nama_lengkap) . "{$data->id_pengajuan}_" . time() . ".pdf";

    if (!Storage::disk('public')->exists('generatesurat')) {
        Storage::disk('public')->makeDirectory('generatesurat');
    }

    Storage::disk('public')->put("generatesurat/{$fileName}", $pdf->output());

    DB::table('master_pengajuan')->where('id_pengajuan', $id_pengajuan)->update([
        'file_pdf' => $fileName,
    ]);

    return response()->json(['success' => true, 'message' => 'PDF berhasil dibuat dan disimpan.']);
}

}