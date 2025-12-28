<?php

namespace App\Http\Controllers;

use App\Models\MetodePembayaran;
use Illuminate\Http\Request;
use Illuminate\View\View; //panggil model
use Illuminate\Support\Facades\DB; // jika pakai query builder
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;

class MetodePembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $arrayMetodePembayaran = MetodePembayaran::all();//eloquent
        return view('private.metode_pembayaran.index', compact('arrayMetodePembayaran'));
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
                'nama.string' => 'Nama berupa string/huruf',
            ]
            );
            //lakukan insert data dari request form dgn query builder
        try {
            $now = DB::raw('CURRENT_TIMESTAMP');
            $lastInsertedID = DB::table('metode_pembayaran')->insertGetId([
                'nama' => $request->nama,
                'created_at' => $now,
                'updated_at' => $now
            ]);

            return redirect()->route('metode_pembayaran.index')
                ->with('success', 'metode pembayaran baru berhasil disimpan ID:'.$lastInsertedID);
        } catch (\Exception $e) {
            //return redirect()->back()
            return redirect()->route('metode_pembayaran.index')
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
            $lastInsertedID = DB::table('metode_pembayaran')->where('id', $id)->update([
                'nama' => $request->nama,
                'updated_at' => $now
            ]);

            return redirect()->route('metode_pembayaran.index')
                ->with('success', 'metode pembayaran berhasil diubah ID:'.$lastInsertedID);
        } catch (\Exception $e) {
            //return redirect()->back()
            return redirect()->route('metode_pembayaran.index')
                ->with('error', 'terjadi kesalahan saat mengubah data! \n Error: '.$e->getMessage());
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
