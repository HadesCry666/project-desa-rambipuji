<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\landing_page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; 

class LandingpageController extends Controller
{
    public function index()
    {
        $data = landing_page::first();

        if (!$data) {
            $data = new landing_page(); 
        }

        return view('admin.landingpage.index', compact('data'));
    }

    public function tampil() {
        $data = landing_page::first();

        if (!$data) {
            $data = new landing_page();
            $data->judul = 'Sistem Informasi & Persuratan Desa Rambipuji';
            $data->deskripsi1 = 'Pelayanan persuratan dan informasi desa yang lebih cepat, transparan, dan dapat diakses secara online.';
            $data->subtittle = 'Layanan Persuratan Mandiri';
            $data->section_text = 'Warga dapat mengajukan berbagai kebutuhan persuratan secara mudah.';
            $data->about_us = 'Desa Rambipuji terus berkomitmen meningkatkan kualitas pelayanan publik.';
        }

        return view('landingpage.index', compact('data'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'subtittle' => 'nullable|string',
            'section_text' => 'nullable|string',
            'subtitle_2' => 'nullable|string',
            'section_second' => 'nullable|string',
            'about_content' => 'nullable|string',
            'hero_image' => 'nullable|array',
            'hero_image.*' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif,svg|max:10240',
            'image_description1' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif,svg|max:10240',
            'image_description2' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif,svg|max:10240',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
        ]);

        // Cari data pertama atau buat baru jika tidak ada
        $content = landing_page::first();

        if (!$content) {
            $content = new landing_page();
        }

        // Update teks
        $content->judul = $request->title;
        $content->deskripsi1 = $request->description;
        $content->subtittle = $request->subtittle;
        $content->section_text = $request->section_text;
        $content->subtitle_2 = $request->subtitle_2;
        $content->section_second = $request->section_second;
        $content->about_us = $request->about_content;
        $content->visi = $request->visi;
        $content->misi = $request->misi;

        // Upload hero image jika ada (menambahkan gambar ke daftar yang sudah ada)
        if ($request->hasFile('hero_image')) {
            $existing = !empty($content->gambar1) && is_array(json_decode($content->gambar1, true)) ? json_decode($content->gambar1, true) : [];
            $paths = $existing;
            foreach ($request->file('hero_image') as $file) {
                $paths[] = $file->store('landingpage/hero_images', 'public');
            }
            $content->gambar1 = json_encode(array_values($paths));
        }

        // Upload image_description1 jika ada
        if ($request->hasFile('image_description1')) {
            if (!empty($content->image_description1)) {
                Storage::disk('public')->delete($content->image_description1);
            }
            $content->image_description1 = $request->file('image_description1')->store('landingpage/description_images', 'public');
        }

        // Upload image_description2 jika ada
        if ($request->hasFile('image_description2')) {
            if (!empty($content->image_description2)) {
                Storage::disk('public')->delete($content->image_description2);
            }
            $content->image_description2 = $request->file('image_description2')->store('landingpage/description_images', 'public');
        }

        // Simpan perubahan
        $content->save();

        return redirect()->back()->with('success', 'Konten dan foto landing page berhasil diperbarui!');
    }

    // Hapus satu gambar spesifik dari Carousel Hero Banner
    public function deleteHeroImage(Request $request)
    {
        $request->validate([
            'image_index' => 'required|integer',
        ]);

        $content = landing_page::first();
        if ($content && !empty($content->gambar1)) {
            $images = json_decode($content->gambar1, true);
            $index = (int) $request->image_index;

            if (is_array($images) && isset($images[$index])) {
                Storage::disk('public')->delete($images[$index]);
                array_splice($images, $index, 1);
                $content->gambar1 = count($images) > 0 ? json_encode(array_values($images)) : null;
                $content->save();

                return redirect()->back()->with('success', 'Gambar carousel hero berhasil dihapus!');
            }
        }

        return redirect()->back()->with('error', 'Gambar carousel tidak ditemukan.');
    }

    // Hapus Foto Deskripsi 1 atau 2
    public function deleteDescImage($type)
    {
        $content = landing_page::first();
        if (!$content) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        if ($type === '1' && !empty($content->image_description1)) {
            Storage::disk('public')->delete($content->image_description1);
            $content->image_description1 = null;
            $content->save();
            return redirect()->back()->with('success', 'Foto profil/deskripsi 1 berhasil dihapus!');
        }

        if ($type === '2' && !empty($content->image_description2)) {
            Storage::disk('public')->delete($content->image_description2);
            $content->image_description2 = null;
            $content->save();
            return redirect()->back()->with('success', 'Foto profil/deskripsi 2 berhasil dihapus!');
        }

        return redirect()->back()->with('error', 'Foto tidak ditemukan.');
    }
}