<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // jika pakai query builder
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\View; //panggil model
use Illuminate\Http\RedirectResponse;

// call Models
use App\Models\Sampah;
use App\Models\JenisSampah;
use App\Models\KategoriSampah;

class SampahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $arraySampah = Sampah::with('kategori_sampah','kategori_sampah.jenis_sampah')->get(); //eloquent
        return view('private.sampah.index', compact('arraySampah'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        $arrayKategoriSampah = KategoriSampah::all();
        return view('private.sampah.form', compact('arrayKategoriSampah'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        $validated = $request->validate(
            // column to validate and rules
            [
                'nama' => 'required|string',
                'kategori_sampah_id' => 'required|integer',
                'satuan' => 'required|string',
                'harga' => 'required|between:0,99.99',
                'score' => 'nullable|integer',
                'coin' => 'nullable|integer',
            ],

            //column custom errors
            [
                'nama.required' => 'nama sampah wajib diisi',
                'nama.string' => 'nama sampah wajib berupa string/huruf',
                'kategori_sampah_id.required' => 'kategori sampah wajib diisi',
                'kategori_sampah_id.integer' => 'kategori sampah wajib berisi integer/angka',
                'satuan.required' => 'satuan wajib diisi',
                'nama.string' => 'satuan wajib berupa string/huruf',
                'harga.required' => 'harga wajib diisi',
                'harga.regex' => 'harga wajib berpola nominal uang',
                'score.integer' => 'score wajib berupa integer/angka',
                'coin.integer' => 'coin wajib berupa integer/angka',
            ]);
            //lakukan insert data dari request form dgn query builder
        try {
            $now = DB::raw('CURRENT_TIMESTAMP');
            $lastInsertedSampahID = DB::table('sampah')->insertGetId([
                'nama' => $request->nama,
                'kategori_sampah_id' => $request->kategori_sampah_id,
                'satuan' => $request->satuan,
                'harga' => $request->harga,
                'score' => $request->score,
                'coin' => $request->coin,
                'created_at' => $now,
                'updated_at' => $now
            ]);

            return redirect()->route('sampah.index')
                ->with('success', 'Sampah baru berhasil ditambahkan ID:'.$lastInsertedSampahID);
        } catch (\Exception $e) {
            //return redirect()->back()
            return redirect()->route('sampah.index')
                ->with('error', 'Terjadi kesalahan saat input data!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) : View
    {
        $sampah = Sampah::find($id);
        return view('private.sampah.detail', compact('sampah'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) : View
    {
        $arrayKategoriSampah = KategoriSampah::all();
        $dataSampahLama = Sampah::find($id);
        return view('private.sampah.form_edit', compact('arrayKategoriSampah', 'dataSampahLama'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) : RedirectResponse
    {
        $validated = $request->validate(
            // column to validate and rules
            [
                'nama' => 'required|string',
                'kategori_sampah_id' => 'required|integer',
                'satuan' => 'required|string',
                'harga' => 'required|between:0,99.99',
                'score' => 'nullable|integer',
                'coin' => 'nullable|integer',
            ],

            //column custom errors
            [
                'nama.required' => 'nama sampah wajib diisi',
                'nama.string' => 'nama sampah wajib berupa string/huruf',
                'kategori_sampah_id.required' => 'jenis sampah wajib diisi',
                'kategori_sampah_id.integer' => 'jenis sampah wajib berisi integer/angka',
                'satuan.required' => 'satuan wajib diisi',
                'nama.string' => 'satuan wajib berupa string/huruf',
                'harga.required' => 'harga wajib diisi',
                'harga.regex' => 'harga wajib berpola nominal uang',
                'score.integer' => 'score wajib berupa integer/angka',
                'coin.integer' => 'coin wajib berupa integer/angka',
            ]);
        
        try {
            DB::table('sampah')->where('id', $request->id)->update([
                    'nama' => $request->nama,
                    'kategori_sampah_id' => $request->kategori_sampah_id,
                    'satuan' => $request->satuan,
                    'harga' => $request->harga,
                    'score' => $request->score,
                    'coin' => $request->coin,
                    'updated_at' => DB::raw('CURRENT_TIMESTAMP')
                ]);
            return redirect('/sampah' . '/' . $id)->with('success', 'Data sampah berhasil diubah!');
        } catch (\Exception $e) {
            return redirect()->route('sampah.index')->with('error', 'Terjadi kesalahan saat mengubah data!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) : RedirectResponse
    {
        //get post by ID
        $sampah = Sampah::findOrFail($id);

        //delete post
        $sampah->delete();

        //redirect to index
        return redirect()->route('sampah.index')->with(['success' => 'Data berhasil dihapus!']);
    }

    public function daftar_harga_sampah()
    {
        $kategori = KategoriSampah::with('sampah')
            ->orderBy('nama')
            ->get();

        return view('public.daftar_harga.index', compact('kategori'));
    }
}
