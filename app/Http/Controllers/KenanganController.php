<?php

namespace App\Http\Controllers;

use App\Models\Kenangan;
use App\Models\Komentar;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KenanganController extends Controller
{
    public function index()
    {
        $data = Kenangan::all();
        return view('kenangan.index', compact('data'));
    }

    public function store(Request $request)
    {
        // VALIDASI DULU
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'nama_teman' => 'required',
        ]);

        $path = null;

        // UPLOAD FOTO
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('kenangan', 'public');
        }

        Kenangan::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'foto' => $path,
            'nama_teman' => $request->nama_teman,
        ]);

        return redirect('/kenangan');
    }

    public function edit($id)
    {
        $data = Kenangan::findOrFail($id);
        return view('kenangan.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'nama_teman' => 'required',
        ]);

        $data = Kenangan::findOrFail($id);

        // UPDATE FOTO
        if ($request->hasFile('foto')) {

            // hapus foto lama
            if ($data->foto) {
                Storage::disk('public')->delete($data->foto);
            }

            $path = $request->file('foto')->store('kenangan', 'public');
            $data->foto = $path;
        }

        $data->judul = $request->judul;
        $data->deskripsi = $request->deskripsi;
        $data->nama_teman = $request->nama_teman;

        $data->save();

        return redirect('/kenangan');
    }

    public function destroy($id)
    {
        $data = Kenangan::findOrFail($id);

        // hapus foto
        if ($data->foto) {
            Storage::disk('public')->delete($data->foto);
        }

        $data->delete();

        return redirect('/kenangan');
    }
    public function komentar(Request $request, $id)
    {
        Komentar::create([
            'kenangan_id' => $id,
            'nama' => $request->nama,
            'isi' => $request->isi,
        ]);

        return back();
    }
    public function show($id)
    {
        $data = Kenangan::with('komentar')->findOrFail($id);
        return view('kenangan.show', compact('data'));
    }

    public function upload(Request $request, $id)
    {
        // validasi (optional tapi bagus)
        $request->validate([
            'file.*' => 'required|file|mimes:jpg,jpeg,png,mp4,mov,avi|max:10240'
        ]);

        if ($request->hasFile('file')) {

            foreach ($request->file('file') as $file) {

                $path = $file->store('media', 'public');

                $tipe = str_contains($file->getMimeType(), 'video') ? 'video' : 'foto';

                Media::create([
                    'kenangan_id' => $id,
                    'file' => $path,
                    'tipe' => $tipe
                ]);
            }
        }

        return back();
    }

    public function hapusMedia($id)
    {
        $media = Media::findOrFail($id);

        // hapus file dari storage
        if ($media->file) {
            Storage::disk('public')->delete($media->file);
        }

        $media->delete();

        return back();
    }

public function hapusKomentar($id)
{
    $komen = Komentar::findOrFail($id);
    $komen->delete();

    return back();
}
}
