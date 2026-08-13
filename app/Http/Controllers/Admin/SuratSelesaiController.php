<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\View_data_pengajuan;
use Illuminate\Http\Request;
use App\Models\master_pengajuan;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Admin\GeneratePDFController;

class SuratSelesaiController extends Controller
{
    public function index(Request $request)
    {
        $jumlahbaris = 10;
        $katakunci = $request->katakunci;
    
        if (strlen($katakunci)) {
            $datapengajuan = View_data_pengajuan::where('status', 'Selesai') // Tambahkan ini
                ->where(function($query) use ($katakunci) {
                    $query->where('nik', 'like', "%$katakunci%")
                        ->orWhere('nama_lengkap', 'like', "%$katakunci%")
                        ->orWhere('nama_surat', 'like', "%$katakunci%");
                })
                ->orderBy('id_pengajuan', 'desc')
                ->paginate($jumlahbaris);
        } else {
            $datapengajuan = View_data_pengajuan::where('status', 'Selesai') // Tambahkan ini juga
                ->orderBy('id_pengajuan', 'desc')
                ->paginate($jumlahbaris);
        }
    
        return view('admin.pengajuan_surat.suratselesai', compact('datapengajuan'));
    }
    
    public function cetakPdf($id_pengajuan)
    {
        $pengajuan = master_pengajuan::findOrFail($id_pengajuan);

        if (empty($pengajuan->file_pdf) || $pengajuan->file_pdf === '-' || !Storage::disk('public')->exists('generatesurat/' . basename($pengajuan->file_pdf))) {
            $generateController = new GeneratePDFController();
            $generateController->generateAndStorePdf($id_pengajuan);
            $pengajuan->refresh();
        }

        $filename = basename($pengajuan->file_pdf);
        $filePath = storage_path('app/public/generatesurat/' . $filename);

        if (Storage::disk('public')->exists('generatesurat/' . $filename)) {
            return response()->file($filePath, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . $filename . '"',
            ]);
        }

        return redirect()->back()->with('error', 'File PDF tidak ditemukan atau gagal dibuat.');
    }

    public function destroy($id_pengajuan)
    {
        // Cari ke model asli
        $pengajuan = master_pengajuan::findOrFail($id_pengajuan);
    
        $pengajuan->delete();
    
        return redirect()->back()->with('success', 'Pengajuan berhasil dihapus.');
    }
}
    