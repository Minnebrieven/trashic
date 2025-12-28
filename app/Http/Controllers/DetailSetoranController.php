<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Setoran;
use App\Models\DetailSetoran;
use App\Models\Sampah; //panggil model
use Illuminate\Support\Facades\DB; // jika pakai query builder
use Illuminate\Database\Eloquent\Model;

class DetailSetoranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            // column to validate and rules
            [
                'setoran_id' => 'required|integer',
                'sampah_id' => 'required|integer',
                'jumlah' => 'required|integer',
            ],

            //column custom errors
            [
                'setoran_id.required' => 'id transaksi wajib diisi',
                'setoran_id.integer' => 'id transaksi wajib berupa id dari transaksi',
                'sampah_id.required' => 'id sampah wajib diisi',
                'sampah_id.integer' => 'id sampah wajib berupa id dari sampah',
                'jumlah.required' => 'jumlah wajib diisi',
                'jumlah.integer' => 'jumlah harus berupa integer/angka',
            ]);
            try {
                $now = DB::raw('CURRENT_TIMESTAMP');
                
                $setoran = Setoran::find($request->setoran_id);
                $hargaSampah = DB::table('sampah')->where('id', $request->sampah_id)->value('harga');
                $scoreSampah = DB::table('sampah')->where('id', $request->sampah_id)->value('score');
                $coinSampah = DB::table('sampah')->where('id', $request->sampah_id)->value('coin');
                $setoran->total_harga += $hargaSampah * $request->jumlah;
                $setoran->total_score += $scoreSampah * $request->jumlah;
                $setoran->total_coin += $coinSampah * $request->jumlah;
                $setoran->save();
                
                $lastInsertedDetailTransaksiID = DB::table('detail_setoran')->insertGetId([
                    'setoran_id' => $request->setoran_id,
                    'sampah_id' => $request->sampah_id,
                    'jumlah' => $request->jumlah,
                    'created_at' => $now,
                    'updated_at' => $now
                ]);

                return redirect()->route('transaksi.show', $request->setoran_id)
                        ->with('success', 'detail transaksi berhasil ditambah ID:'.$lastInsertedDetailTransaksiID);

            } catch (\Exception $e) {
                return redirect()->route('transaksi.show', $request->setoran_id)
                        ->with('error', 'Terjadi kesalahan saat menambah detail transaksi!. \n Error : '.$e->getMessage());
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
            // column to validate and rules
            [
                'setoran_id' => 'required|integer',
                'sampah_id' => 'required|integer',
                'jumlah' => 'required|integer',
            ],

            //column custom errors
            [
                'setoran_id.required' => 'id transaksi wajib diisi',
                'setoran_id.integer' => 'id transaksi wajib berupa id dari transaksi',
                'sampah_id.required' => 'id sampah wajib diisi',
                'sampah_id.integer' => 'id sampah wajib berupa id dari sampah',
                'jumlah.required' => 'jumlah wajib diisi',
                'jumlah.integer' => 'jumlah harus berupa integer/angka',
            ]);
            //lakukan update data dari request form dgn query builder

        try {
            $detailSetoran = DetailSetoran::with('sampah')->find($id);
            $setoran = Setoran::find($detailSetoran->setoran_id);
            $hargaLama = $detailSetoran->sampah->harga * $detailSetoran->jumlah;
            $hargaSampah = ($detailSetoran->sampah_id == $request->sampah_id)? $detailSetoran->sampah->harga : DB::table('sampah')->where('id', $request->sampah_id)->value('harga');
            $hargaBaru = $hargaSampah * $request->jumlah;

            $scoreLama = $detailSetoran->sampah->score * $detailSetoran->jumlah;
            $scoreSampah = ($detailSetoran->sampah_id == $request->sampah_id)? $detailSetoran->sampah->score : DB::table('sampah')->where('id', $request->sampah_id)->value('score');
            $scoreBaru = $scoreSampah * $request->jumlah;

            $coinLama = $detailSetoran->sampah->coin * $detailSetoran->jumlah;
            $coinSampah = ($detailSetoran->sampah_id == $request->sampah_id)? $detailSetoran->sampah->coin : DB::table('sampah')->where('id', $request->sampah_id)->value('coin');
            $coinBaru = $coinSampah * $request->jumlah;

            // ubah total harga transaksi, score dan coin
            $setoran->total_harga = $setoran->total_harga - $hargaLama;
            $setoran->total_harga = $setoran->total_harga + $hargaBaru;

            $setoran->total_score = $setoran->total_score - $scoreLama;
            $setoran->total_score = $setoran->total_score + $scoreBaru;

            $setoran->total_coin = $setoran->total_coin - $coinLama;
            $setoran->total_coin = $setoran->total_coin + $coinBaru;
            $setoran->save();

            //ubah detail transaksi
            $detailSetoran->sampah_id = $request->sampah_id;
            $detailSetoran->jumlah = $request->jumlah;
            $detailSetoran->save();

            return redirect()->route('transaksi.show', $detailSetoran->setoran_id)
                ->with('success', 'detail transaksi berhasil diubah ID:'.$id);

        } catch (\Exception $e) {
            //return redirect()->back()
            return redirect()->route('transaksi.show', $detailSetoran->setoran_id)
                    ->with('error', 'Terjadi kesalahan saat mengubah detail transaksi!. \n Error : '.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $detailTransaksi = DetailSetoran::with('sampah')->find($id);
        $totalHarga = DB::table('setoran')->where('id', $detailTransaksi->setoran_id)->value('total_harga');
        $hargaDikurang = strval($detailTransaksi->sampah->harga * $detailTransaksi->jumlah);
        $totalHargaAkhir = floatval(bcsub($totalHarga, $hargaDikurang));

        $totalScore = DB::table('setoran')->where('id', $detailTransaksi->setoran_id)->value('total_score');
        $scoreDikurang = strval($detailTransaksi->sampah->score * $detailTransaksi->jumlah);
        $totalScoreAkhir = $totalScore - $scoreDikurang;

        $totalCoin = DB::table('setoran')->where('id', $detailTransaksi->setoran_id)->value('total_coin');
        $coinDikurang = strval($detailTransaksi->sampah->coin * $detailTransaksi->jumlah);
        $totalCoinAkhir = $totalCoin - $coinDikurang;
        try {
            DB::table('setoran')->where('id', $detailTransaksi->setoran_id)->update([
                'total_harga' => $totalHargaAkhir,
                'total_score' => $totalScoreAkhir,
                'total_coin' => $totalCoinAkhir,
                'updated_at' => DB::raw('CURRENT_TIMESTAMP')
            ]);
            $detailTransaksi->delete();
            return redirect()->back()
                    ->with('success', 'detail transaksi berhasil dihapus');

        } catch (\Exception $e) {
            return redirect()->back()
                    ->with('error', 'terjadi error saat hapus detail transaksi! \nError: '.$e->getMessage());
        }
    }
}
