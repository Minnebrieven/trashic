<?php

namespace App\Http\Controllers;

use App\Models\JenisSampah;
use Illuminate\Http\Request;
use Illuminate\View\View; //panggil model
use Illuminate\Support\Facades\DB; // jika pakai query builder
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;

class JenisSampahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ar_jenis_sampah = JenisSampah::all();//eloquent
        return view('private.jenissampah.index', compact('ar_jenis_sampah'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate(
            [
                'nama' => 'required|string',
            ],

            [
                'nama.required' => 'Nama Wajib Diisi',
                'nama.string' => 'Nama harus berupa string/huruf'
            ]
            );
            //lakukan insert data dari request form dgn query builder
        try {
            $now = DB::raw('CURRENT_TIMESTAMP');
            $lastInsertedID = DB::table('jenis_sampah')->insertGetId([
                'nama' => $request->nama,
                'created_at' => $now,
                'updated_at' => $now
            ]);

            return redirect()->route('jenissampah.index')
                ->with('success', 'Data jenis sampah baru berhasil disimpan');
        } catch (\Exception $e) {
            //return redirect()->back()
            return redirect()->route('jenissampah.index')
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
                'nama.string' => 'Nama harus berupa string/huruf'
            ]
            );
            //lakukan insert data dari request form dgn query builder
        try {
            $now = DB::raw('CURRENT_TIMESTAMP');
            $lastInsertedID = DB::table('jenis_sampah')->where('id', $id)->update([
                'nama' => $request->nama,
                'updated_at' => $now
            ]);

            return redirect()->route('jenissampah.index')
                ->with('success', 'Data jenis sampah berhasil diubah');
        } catch (\Exception $e) {
            //return redirect()->back()
            return redirect()->route('jenissampah.index')
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
