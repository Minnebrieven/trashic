<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // jika pakai query builder
use Illuminate\Database\Eloquent\Model;

use App\Models\LogTransaksi;
use App\Models\Sampah;
use App\Models\Setoran;
use App\Models\MetodePembayaran;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $arrayLogTransaksi = LogTransaksi::all();
        return view('private.transaksi.index', compact('arrayLogTransaksi'));
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
        $arraySampah = Sampah::all();
        $logTransaksi = LogTransaksi::with('setoran.detail_setoran.sampah', 'penarikan')->find($id);
        return view('private.transaksi.detail', compact('arraySampah', 'logTransaksi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $arrayMetodePembayaran = MetodePembayaran::all();
        $logTransaksi = LogTransaksi::with('setoran', 'penarikan')->find($id);
        return view('private.transaksi.form_edit', compact('arrayMetodePembayaran', 'logTransaksi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate(
            // column to validate and rules
            [

                // 'user_id' => 'required|integer',
                // 'tipe_transaksi' => 'required|string',
                'metode_pembayaran_id' => 'integer',
                'status' => 'required|string',
                // 'total_harga' => 'required|between:0,99.99',
            ],

            //column custom errors
            [
                // 'user_id.required' => 'wajib login agar dapat mengakses fitur ini',
                // 'user_id.integer' => 'wajib login agar dapat mengakses fitur ini',
                // 'metode_pembayaran_id.required' => 'metode pembayaran wajib diisi',
                'metode_pembayaran_id.integer' => 'satuan wajib berupa id metode pembayaran',
                'status.required' => 'wajib pilih status',
                'status.string' => 'status harus berupa string/huruf',
                // 'total_harga.required' => 'total harga wajib diisi',
            ]);
            //lakukan insert data dari request form dgn query builder
        try {
            $now = DB::raw('CURRENT_TIMESTAMP');
            $isSetoran = $request->tipeTransaksi == 'setoran';
            
            if ($isSetoran) {
                DB::table('log_transaksi')->where('id',$id)->update([
                    'metode_pembayaran_id' => $request->metode_pembayaran_id,
                    'status' => $request->status,
                    'updated_at' => $now
                ]);
            } else {
                DB::table('log_transaksi')->where('id',$id)->update([
                    'status' => $request->status,
                    'updated_at' => $now
                ]);
            }

            return redirect()->route('transaksi.show', $id)
                ->with('success', 'transaksi berhasil diubah ID:'.$id);

            } catch (\Exception $e) {
                //return redirect()->back()
                return redirect()->route('transaksi.index')
                        ->with('error', 'Terjadi kesalahan saat mengubah transaksi!. \n Error : '.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $transaksi = LogTransaksi::find($id);
            $transaksi->delete();
            return redirect()->route('transaksi.index')
                    ->with('success', 'setoran berhasil dihapus');

        } catch (\Exception $e) {
            return redirect()->back()
                    ->with('error', 'terjadi error saat hapus setoran! \nError: '.$e->getMessage());
        }
    }

    public function konfirmasi_transaksi(string $id)
    {
        $tipeTransaksi = "";
        try {
            $logTransaksi = LogTransaksi::find($id);
            
            if (!empty($logTransaksi->setoran_id) && (empty($logTransaksi->penarikan_id))) {
                $tipeTransaksi = 'setoran';
            } elseif (!empty($logTransaksi->penarikan_id) && (empty($logTransaksi->setoran_id))) {
                $tipeTransaksi = 'penarikan';
            } else {
                return redirect()->route('transaksi.index')
                ->withErrors(['msg' => 'Tipe Transaksi Salah! Tidak ada tipe transaksi yang terpilih.']);
            }

            switch ($tipeTransaksi) {
                case 'setoran':
                    //tambah saldo ke rekening
                    $logTransaksi->rekening->increment('saldo', $logTransaksi->setoran->total_harga);
                    $logTransaksi->rekening->increment('score', $logTransaksi->setoran->total_score);
                    $logTransaksi->rekening->increment('coin', $logTransaksi->setoran->total_coin);
                    break;
                
                case 'penarikan':
                    // cek saldo mencukupi atau tidak
                    if ($logTransaksi->rekening->saldo < $logTransaksi->penarikan->total_harga) {
                        return redirect()->route('transaksi.index')
                        ->withErrors(['msg' => 'Penarikan Gagal! Saldo yang ditarik tidak mencukupi.']);
                    } else {
                    //kurangi saldo dari rekening 
                    $logTransaksi->rekening->decrement('saldo', $logTransaksi->penarikan->total_harga);   
                    }
                    break;
                
                default:
                    return redirect()->route('transaksi.index')
                    ->withErrors(['msg' => 'Transaksi Gagal! terjadi kegagalan dalam konfirmasi transaksi.']);
                    break;
            }

            $logTransaksi->status = 'diterima';
            $logTransaksi->save();

            return redirect()->route('transaksi.show', $id)
                ->with('success', 'transaksi berhasil dikonfirmasi!');
        } catch (\Exception $e) {
            //return redirect()->back()
            return redirect()->route('transaksi.index')
                ->with('error', 'Terjadi Kesalahan konfirmasi transaksi! \n Error: '.$e->getMessage());
        }
    }
}
