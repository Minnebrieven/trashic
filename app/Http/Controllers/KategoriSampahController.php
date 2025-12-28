<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View; //panggil model
use Illuminate\Support\Facades\DB; // jika pakai query builder
use Illuminate\Database\Eloquent\Model;
use App\Models\JenisSampah;
use App\Models\KategoriSampah;
use Illuminate\Http\RedirectResponse;

class KategoriSampahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ar_jenis_sampah = JenisSampah::all(); //eloquent
        $ar_kategori_sampah = KategoriSampah::all(); //eloquent
        return view('private.kategorisampah.index', compact('ar_jenis_sampah', 'ar_kategori_sampah'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'nama' => 'required|string',
                'jenis_sampah_id' => 'required|integer'
            ],

            [
                'nama.required' => 'Nama Wajib Diisi',
                'nama.string' => 'Nama harus berupa string/huruf',
                'jenis_sampah_id.required' => 'wajib login atau mempunyai rekening agar dapat mengakses fitur ini',
                'jenis_sampah_id.integer' => 'wajib login atau mempunyai rekening agar dapat mengakses fitur ini',
            ]
            );
            //lakukan insert data dari request form dgn query builder
        try {
            $now = DB::raw('CURRENT_TIMESTAMP');
            $lastInsertedID = DB::table('kategori_sampah')->insertGetId([
                'nama' => $request->nama,
                'jenis_sampah_id' => $request->jenis_sampah_id,
                'created_at' => $now,
                'updated_at' => $now
            ]);

            return redirect()->route('kategorisampah.index')
                ->with('success', 'Data kategori sampah baru berhasil disimpan');
        } catch (\Exception $e) {
            //return redirect()->back()
            return redirect()->route('kategorisampah.index')
                ->with('error', 'Terjadi Kesalahan Saat Input Data! \n Error: '.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate(
            [
                'nama' => 'required|string',
                'jenis_sampah_id' => 'required|integer'
            ],

            [
                'nama.required' => 'Nama Wajib Diisi',
                'nama.string' => 'Nama harus berupa string/huruf',
                'jenis_sampah_id.required' => 'wajib login atau mempunyai rekening agar dapat mengakses fitur ini',
                'jenis_sampah_id.integer' => 'wajib login atau mempunyai rekening agar dapat mengakses fitur ini',
            ]
            );
            //lakukan insert data dari request form dgn query builder
        try {
            $now = DB::raw('CURRENT_TIMESTAMP');
            $lastInsertedID = DB::table('kategori_sampah')->where('id', $id)->update([
                'nama' => $request->nama,
                'jenis_sampah_id' => $request->jenis_sampah_id,
                'updated_at' => $now
            ]);

            return redirect()->route('kategorisampah.index')
                ->with('success', 'Data kategori sampah berhasil diubah');
        } catch (\Exception $e) {
            //return redirect()->back()
            return redirect()->route('kategorisampah.index')
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
