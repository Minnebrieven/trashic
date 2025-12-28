<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // jika pakai query builder
use Illuminate\Database\Eloquent\Model;

use App\Models\Penukaran;
use App\Models\Rekening;
use App\Models\Hadiah;

class PenukaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $arrayPenukaran = Penukaran::with('rekening','rekening.user')->get(); //eloquent
        return view('private.penukaran.index', compact('arrayPenukaran'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $detailPenukaran = Penukaran::with('hadiah')->find($id);
        return view('private.penukaran.detail', compact('detailPenukaran'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $penukaran = Penukaran::find($id);
            $penukaran->delete();
            return redirect()->route('penukaran.index')
                ->with('success', 'berhasil menghapus data penukaran!');
        } catch (\Throwable $th) {
            return redirect()->route('penukaran.index')
                ->with('error', 'Terjadi Kesalahan Saat Menghapus Data! \n Error: '.$e->getMessage());
        }
        
    }

    public function tukar_hadiah(Request $request, string $id)
    {
        $validated = $request->validate(
            [
                'rekening_id' => 'required|integer',
            ],

            [
                'rekening_id.required' => 'User ID Wajib Diisi',
                'rekening_id.integer' => 'User ID harus berupa integer/angka',
            ]
            );

            //lakukan insert data dari request form dgn query builder
        try {
            $coinDimiliki = DB::table('rekening')->where('id', $request->rekening_id)->value('coin');
            $coinDiperlukan = DB::table('hadiah')->where('id', $id)->value('coin_diperlukan');
            $stokHadiah = DB::table('hadiah')->where('id', $id)->value('stok');
            
            if ($coinDimiliki < $coinDiperlukan) {
                $coinDibutuhkan = $coinDiperlukan - $coinDimiliki;
                return redirect()->route('hadiah.list')
                ->withErrors(['msg' => 'Coin Kurang! dibutuhkan ' .$coinDibutuhkan .' TCoin lagi untuk tukar hadiah!']);
            }
            if ($stokHadiah == 0) {
                return redirect()->route('hadiah.list')
                ->withErrors(['msg' => 'Maaf Stok Hadiah Habis']);
            }
            
            $now = DB::raw('CURRENT_TIMESTAMP');
            $lastInsertedID = DB::table('penukaran')->insertGetId([
                'rekening_id' => $request->rekening_id,
                'hadiah_id' => $id,
                'created_at' => $now,
                'updated_at' => $now
            ]);

            return redirect()->route('penukaran.detail', $lastInsertedID)
                ->with('success', 'berhasil menukar hadiah, tunggu konfirmasi dari admin!');
        } catch (\Exception $e) {
            //return redirect()->back()
            return redirect()->route('hadiah.list')
                ->with('error', 'Terjadi Kesalahan Saat Input Data! \n Error: '.$e->getMessage());
        }
    }

    public function konfirmasi_penukaran(string $id)
    {
        try {
            $penukaran = Penukaran::find($id);
            $rekening = Rekening::find($penukaran->rekening_id);
            $hadiah = Hadiah::find($penukaran->hadiah_id);
            $coinDimiliki = $rekening->coin;
            $coinDiperlukan = DB::table('hadiah')->where('id', $penukaran->hadiah_id)->value('coin_diperlukan');
            
            if ($coinDimiliki < $coinDiperlukan) {
                $coinDibutuhkan = $coinDiperlukan - $coinDimiliki;
                return redirect()->route('penukaran.index')
                ->withErrors(['msg' => 'Coin Kurang! dibutuhkan ' .$coinDibutuhkan .' TCoin lagi untuk tukar hadiah!']);
            }
            if ($hadiah->stok == 0) {
                return redirect()->route('penukaran.index')
                ->withErrors(['msg' => 'Stok Hadiah Habis!']);
            }

            $coinSisa = $coinDimiliki - $coinDiperlukan;

            $penukaran->status = 'diterima';
            $penukaran->save();

            //mengurangi stock 1 (default 1, ->decrement('stok', 1); )
            $hadiah->decrement('stok');
            
            $rekening->coin = $coinSisa;
            $rekening->save();

            return redirect()->route('penukaran.show', $id)
                ->with('success', 'penukaran berhasil diterima!');
        } catch (\Exception $e) {
            //return redirect()->back()
            return redirect()->route('penukaran.index')
                ->with('error', 'Terjadi Kesalahan Saat Input Data! \n Error: '.$e->getMessage());
        }
    }

    public function log_penukaran(string $id)
    {
        $arrayPenukaran = Penukaran::with('hadiah')->where('rekening_id', $id)->get();
        return view('public.penukaran.index', compact('arrayPenukaran'));
    }

    public function detail_penukaran(string $id)
    {
        $detailPenukaran = Penukaran::with('hadiah')->find($id);
        return view('public.penukaran.detail', compact('detailPenukaran'));
    }
}
