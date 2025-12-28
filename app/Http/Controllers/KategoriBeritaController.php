<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriBerita;
use Illuminate\Support\Facades\DB; // jika pakai query builder
use Illuminate\Database\Eloquent\Model; //panggil model

class KategoriBeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ar_kategoriberita = KategoriBerita::all();//eloquent
        return view('private.kategoriberita.index', compact('ar_kategoriberita'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'nama' => 'required|string',
            ],

            [
                'nama.required' => 'Nama Wajib Diisi',
                'nama.string' => 'Nama berupa string/huruf',
            ]
            );
            //lakukan insert data dari request form dgn query builder
        try {
            $now = DB::raw('CURRENT_TIMESTAMP');
            $lastInsertedID = DB::table('kategori_berita')->insertGetId([
                'nama' => $request->nama,
                'created_at' => $now,
                'updated_at' => $now
            ]);

            return redirect()->route('kategoriberita.index')
                ->with('success', 'kategori berita baru berhasil disimpan ID:'.$lastInsertedID);
        } catch (\Exception $e) {
            //return redirect()->back()
            return redirect()->route('kategoriberita.index')
                ->with('error', 'Terjadi Kesalahan Saat Input Data! \n Error: '.$e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate(
            [
                'nama' => 'required|string',
            ],

            [
                'nama.required' => 'Nama Wajib Diisi',
                'nama.string' => 'Nama berupa string/huruf',
            ]
            );
            //lakukan insert data dari request form dgn query builder
        try {
            $now = DB::raw('CURRENT_TIMESTAMP');
            $lastInsertedID = DB::table('kategori_berita')->where('id', $id)->update([
                'nama' => $request->nama,
                'updated_at' => $now
            ]);

            return redirect()->route('kategoriberita.index')
                ->with('success', 'kategori berita berhasil diubah ID:'.$lastInsertedID);
        } catch (\Exception $e) {
            //return redirect()->back()
            return redirect()->route('kategoriberita.index')
                ->with('error', 'Terjadi kesalahan saat mengubah data! \n Error: '.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
