<?php

namespace App\Http\Controllers;

use App\Models\Rekening; 
use App\Models\Setoran;
use App\Models\DetailSetoran;
use App\Models\Sampah; //panggil model
use App\Models\KategoriSampah; //panggil model
use App\Models\JenisSampah; //panggil model
use App\Models\MetodePembayaran; //panggil model
use App\Models\LogTransaksi; //panggil model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // jika pakai query builder
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\MessageBag;
use PDF;

class SetoranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $arraySetoran = Setoran::with('user')->orderBy('created_at', 'DESC')->get();//eloquent
        return view('private.setoran.index', compact('arraysetoran'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $arrayJenisSampah = JenisSampah::all();
        $arrayKategoriSampah = KategoriSampah::all();
        $arraySampah = Sampah::all();
        // $arrayMetodePembayaran = MetodePembayaran::all();
        return view('public.log_transaksi.form', compact('arraySampah', 'arrayKategoriSampah'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            // column to validate and rules
            [
                'rekening_id' => 'required|integer',
                'sampah' => 'required|array|min:1',
            ],

            //column custom errors
            [
                'rekening_id.required' => 'wajib login agar dapat mengakses fitur ini',
                'rekening_id.integer' => 'wajib login agar dapat mengakses fitur ini',
                'sampah.required' => 'wajib pilih sampah yang ingin dijual/beli',
                'sampah.*.sampah_id' => 'sampah harus berupa id dari sampah',
                'sampah.*.jumlah' => 'jumlah harus berupa integer/angka',
            ]);
            //lakukan insert data dari request form dgn query builder
        try {
            $now = DB::raw('CURRENT_TIMESTAMP');
            $rekeningNasabah = Rekening::find($request->rekening_id);
            
            // hitung total harga
            $totalHarga = 0;
            $totalScore = 0;
            $totalCoin = 0;
            foreach ($request->sampah as $smph) {
                $hargaSampah = DB::table('sampah')->where('id', $smph['sampah_id'])->value('harga');
                $scoreSampah = DB::table('sampah')->where('id', $smph['sampah_id'])->value('score');
                $coinSampah = DB::table('sampah')->where('id', $smph['sampah_id'])->value('coin');
                $totalHarga += floatval(bcmul($hargaSampah, strval($smph['jumlah'])));
                $totalScore += $scoreSampah * $smph['jumlah'];
                $totalCoin += $coinSampah * $smph['jumlah'];
            }
            
            //insert data ke setoran
            $lastInsertedSetoranID = DB::table('setoran')->insertGetId([
                'rekening_id' => $request->rekening_id,
                'total_harga' => $totalHarga,
                'total_score' => $totalScore,
                'total_coin' => $totalCoin,
                'created_at' => $now,
                'updated_at' => $now
            ]);
            // akhir dari hitung total harga

            // insert data detail setoran
            foreach ($request->sampah as $smph) {
                DB::table('detail_setoran')->insert([
                    'setoran_id' => $lastInsertedSetoranID,
                    'sampah_id' => $smph['sampah_id'],
                    'jumlah' => $smph['jumlah'],
                    'created_at' => $now,
                    'updated_at' => $now
                ]);
            }
            // akhir dari insert data detail setoran

            // insert data kedalam log transaksi
            $lastInsertedLogTransaksiID = DB::table('log_transaksi')->insertGetId([
                'rekening_id' => $request->rekening_id,
                'setoran_id' => $lastInsertedSetoranID,
                'status' => 'diterima',
                'created_at' => $now,
                'updated_at' => $now
            ]);
            // akhir dari insert data kedalam log transaksi

            // insert data ke rekening / tambah saldo/coin/poin
            $rekeningNasabah->increment('saldo', $total_harga);
            $rekeningNasabah->rekening->increment('score', $total_score);
            $rekeningNasabah->rekening->increment('coin', $total_coin);
            // akhir dari insert data ke rekening / tambah saldo/coin/poin

            return redirect()->route('private.setoran.detail', $lastInsertedSetoranID)
                ->with('success', 'Setoran berhasil !. ID Setoran:'.$lastInsertedSetoranID);
        } catch (\Exception $e) {
            //return redirect()->back()
            return redirect()->back()
                ->with('errors', 'Terjadi kesalahan saat setoran dibuat!. \n Error : '.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sampahArray = Sampah::all();
        $setoran = Setoran::with('detail_setoran.sampah')->find($id);
        return view('private.setoran.detail',compact('setoran','sampahArray'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $arrayMetodePembayaran = MetodePembayaran::all();
        $setoran = setoran::with('metode_pembayaran', 'user')->find($id);
        return view('private.setoran.form_edit', compact('setoran', 'arrayMetodePembayaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate(
            // column to validate and rules
            [
                'total_harga' => 'required|between:0,99.99',
                'total_score' => 'nullable|integer',
                'total_coin' => 'nullable|integer',
            ],

            //column custom errors
            [
                'total_harga.required' => 'total harga wajib diisi',
                'total_score.integer' => 'total score wajib berupa integer/angka',
                'total_coin.integer' => 'total coin wajib berupa integer/angka',
            ]);
            //lakukan insert data dari request form dgn query builder
        try {
            $now = DB::raw('CURRENT_TIMESTAMP');
            
            DB::table('setoran')->where('id',$id)->update([
                'total_harga' => $request->total_harga,
                'total_score' => $request->total_score,
                'total_coin' => $request->total_coin,
                'updated_at' => $now
            ]);
            return redirect()->route('setoran.show', $id)
                ->with('success', 'setoran berhasil diubah ID:'.$id);

            } catch (\Exception $e) {
                //return redirect()->back()
                return redirect()->route('setoran.index')
                        ->with('error', 'Terjadi kesalahan saat mengubah setoran!. \n Error : '.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $setoran = setoran::find($id);
            $setoran->delete();
            return redirect()->route('setoran.index')
                    ->with('success', 'setoran berhasil dihapus');

        } catch (\Exception $e) {
            return redirect()->back()
                    ->with('error', 'terjadi error saat hapus setoran! \nError: '.$e->getMessage());
        }
    }

    public function create_setor_oleh_admin()
    {
        return view('private.transaksi.form_create_setoran', [
            'rekening' => Rekening::all(),
            'sampah' => sampah::all(),
            'kategori_sampah' => KategoriSampah::all()
        ]);
    }

    public function store_setor_oleh_admin(Request $request)
    {
        $validated = $request->validate(
            // column to validate and rules
            [
                'rekening_id' => 'required|integer',
                'sampah' => 'required|array|min:1',
            ],

            //column custom errors
            [
                'rekening_id.required' => 'wajib login agar dapat mengakses fitur ini',
                'rekening_id.integer' => 'wajib login agar dapat mengakses fitur ini',
                'sampah.required' => 'wajib pilih sampah yang ingin dijual/beli',
                'sampah.*.sampah_id' => 'sampah harus berupa id dari sampah',
                'sampah.*.jumlah' => 'jumlah harus berupa integer/angka',
            ]);
            //lakukan insert data dari request form dgn query builder
        try {
            $now = DB::raw('CURRENT_TIMESTAMP');
            
            // hitung total harga
            $totalHarga = 0;
            $totalScore = 0;
            $totalCoin = 0;
            foreach ($request->sampah as $smph) {
                $hargaSampah = DB::table('sampah')->where('id', $smph['sampah_id'])->value('harga');
                $scoreSampah = DB::table('sampah')->where('id', $smph['sampah_id'])->value('score');
                $coinSampah = DB::table('sampah')->where('id', $smph['sampah_id'])->value('coin');
                $totalHarga += floatval(bcmul($hargaSampah, strval($smph['jumlah'])));
                $totalScore += $scoreSampah * $smph['jumlah'];
                $totalCoin += $coinSampah * $smph['jumlah'];
            }
            
            //insert data ke setoran
            $lastInsertedSetoranID = DB::table('setoran')->insertGetId([
                'rekening_id' => $request->rekening_id,
                'total_harga' => $totalHarga,
                'total_score' => $totalScore,
                'total_coin' => $totalCoin,
                'created_at' => $now,
                'updated_at' => $now
            ]);
            // akhir dari hitung total harga

            // insert data detail setoran
            foreach ($request->sampah as $smph) {
                DB::table('detail_setoran')->insert([
                    'setoran_id' => $lastInsertedSetoranID,
                    'sampah_id' => $smph['sampah_id'],
                    'jumlah' => $smph['jumlah'],
                    'created_at' => $now,
                    'updated_at' => $now
                ]);
            }
            // akhir dari insert data detail setoran

            // insert data kedalam log transaksi
            $lastInsertedLogTransaksiID = DB::table('log_transaksi')->insertGetId([
                'rekening_id' => $request->rekening_id,
                'setoran_id' => $lastInsertedSetoranID,
                'status' => 'diterima',
                'created_at' => $now,
                'updated_at' => $now
            ]);
            // akhir dari insert data kedalam log transaksi
            
            // update rekening
            $rekeningNasabah = Rekening::find($request->rekening_id);
            $rekeningNasabah->increment('saldo', $totalHarga);
            $rekeningNasabah->increment('score', $totalScore);
            $rekeningNasabah->increment('coin', $totalCoin);
            //

            
            return redirect()->route('transaksi.show', $lastInsertedLogTransaksiID)
                ->with('success', 'Setoran berhasil !. ID Setoran:'.$lastInsertedLogTransaksiID);
        } catch (\Exception $e) {
            //return redirect()->back()
            $errors = new MessageBag(['general' => 'Terjadi kesalahan saat setoran dibuat!. \n Error : '.$e->getMessage()]);
            return redirect()->back()
                ->withErrors($errors)->withInput();
        }
    }

    public function generatePDF()
    {
        $data = [
            'title' => 'Data setoran',
            'date' => date('d-m-Y H:i:s')
        ];
          
        $pdf = PDF::loadView('private.setoran.tesPDF', $data);
    
        return $pdf->download('data_tespdf_'.date('d-m-Y_H:i:s').'.pdf');
    }

    public function setoranPDF(){
        $ar_setoran = setoran::all();
        $pdf = PDF::loadView('private.setoran.setoranPDF', 
                              ['ar_setoran'=>$ar_setoran]);
        return $pdf->download('data_setoran_'.date('d-m-Y_H:i:s').'.pdf');
    }
}