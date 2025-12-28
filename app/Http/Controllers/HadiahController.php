<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hadiah;
use Illuminate\Support\Facades\DB; // jika pakai query builder
use Illuminate\Database\Eloquent\Model;

class HadiahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $arrayHadiah = Hadiah::all();
        return view('private.hadiah.index', compact('arrayHadiah'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('private.hadiah.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'nama' => 'required|string',
                'coin_diperlukan' => 'required|integer',
                'stok' => 'required|integer',
                'gambar' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|min:2|max:9000'
            ],

            [
                'nama.required' => 'Nama Wajib Diisi',
                'nama.string' => 'Nama harus berupa string/huruf',
                'coin_diperlukan.required' => 'Coin Wajib Diisi',
                'coin_diperlukan.integer' => 'Coin harus berupa integer/angka',
                'stok.required' => 'Stok Wajib Diisi',
                'stok.integer' => 'Stok harus berupa integer/angka',
                'gambar.min' => 'Ukuran file kurang 2 KB',
                'gambar.max' => 'Ukuran file melebihi 9000 KB',
                'gambar.image' => 'File gambar bukan gambar',
                'gambar.mimes' => 'Extension file selain jpg,jpeg,png,gif,svg',
            ]
            );

            if (!empty($request->gambar)) {
                $fileName = 'hadiah_' . date("Ymd_h-i-s") . '.' . $request->gambar->extension();
                //$fileName = $request->gambar->getClientOriginalName();
                $request->gambar->move(public_path('private/assets/img'), $fileName);
            } else {
                $fileName = '';
            }

            //lakukan insert data dari request form dgn query builder
        try {
            $now = DB::raw('CURRENT_TIMESTAMP');
            $lastInsertedID = DB::table('hadiah')->insertGetId([
                'nama' => $request->nama,
                'coin_diperlukan' => $request->coin_diperlukan,
                'stok' => $request->stok,
                'gambar' => $fileName,
                'created_at' => $now,
                'updated_at' => $now
            ]);

            return redirect()->route('hadiah.index')
                ->with('success', 'Data hadiah baru berhasil disimpan');
        } catch (\Exception $e) {
            //return redirect()->back()
            return redirect()->route('hadiah.index')
                ->with('error', 'Terjadi Kesalahan Saat Input Data! \n Error: '.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $hadiah = Hadiah::find($id);
        return view('private.hadiah.detail', compact('hadiah'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $hadiah = Hadiah::find($id);
        return view('private.hadiah.form_edit', compact('hadiah'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate(
            [
                'nama' => 'required|string',
                'coin_diperlukan' => 'required|integer',
                'stok' => 'required|integer',
                'gambar' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|min:2|max:9000'
            ],

            [
                'nama.required' => 'Nama Wajib Diisi',
                'nama.string' => 'Nama harus berupa string/huruf',
                'coin_diperlukan.required' => 'Coin Wajib Diisi',
                'coin_diperlukan.integer' => 'Coin harus berupa integer/angka',
                'stok.required' => 'Stok Wajib Diisi',
                'stok.integer' => 'Stok harus berupa integer/angka',
                'gambar.min' => 'Ukuran file kurang 2 KB',
                'gambar.max' => 'Ukuran file melebihi 9000 KB',
                'gambar.image' => 'File gambar bukan gambar',
                'gambar.mimes' => 'Extension file selain jpg,jpeg,png,gif,svg',
            ]
        );

        $gambar = DB::table('hadiah')->select('gambar')->where('id', $id)->get();
        foreach ($gambar as $g) {
            $namaFileGambarLama = $g->gambar;
        }
        //------------apakah user  ingin ubah upload gambar baru-----------
        if (!empty($request->gambar)) {
            //jika ada gambar lama, hapus gambar lamanya terlebih dahulu
            if (!empty($namaFileGambarLama)) {
                try {
                    unlink('private/assets/img/' . $namaFileGambarLama);
                } catch (\Exception $e) {
                    //throw $th;
                }
            }
            //lalukan proses ubah gambar lama menjadi gambar baru
            $fileName = 'hadiah_' . date("Ymd_h-i-s") . '.' . $request->gambar->extension();
            //$fileName = $request->gambar->getClientOriginalName();
            $request->gambar->move(public_path('private/assets/img'), $fileName);
        } else {
            $fileName = $namaFileGambarLama;
        }

        //lakukan insert data dari request form dgn query builder
        DB::table('hadiah')->where('id',$id)->update([
            'nama' => $request->nama,
            'coin_diperlukan' => $request->coin_diperlukan,
            'stok' => $request->stok,
            'gambar' => $fileName,
        ]);
        return redirect('/hadiah' . '/' . $id)
            ->with('success', 'Data Hadiah Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //sebelum hapus data, hapus terlebih dahulu fisik file gambarnya jika ada
        $hadiah = Hadiah::find($id);

        if ($hadiah) {
            $hadiah->delete();

            // Additional logic (e.g., deleting associated file)
            if (!empty($hadiah->gambar)) {
                $filePath = 'private/assets/img/' . $hadiah->gambar;
                if (Hadiah::exists($filePath)) {
                    unlink($filePath);
                }
            }

            return redirect()->route('hadiah.index')->with('success', 'Data Hadiah Berhasil Dihapus');
        } else {
            return redirect()->route('hadiah.index')->with('error', 'Data Hadiah tidak ditemukan');
        }
    }

    public function halamanListHadiah()
    {
        $arrayHadiah = Hadiah::all();
        return view('public.hadiah.index', compact('arrayHadiah'));
    }
}
