<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisSampah;
use App\Models\LogTransaksi;
use App\Models\DetailTransaksi;
use Illuminate\Support\Facades\DB; // jika pakai query builder
use Illuminate\Database\Eloquent\Model;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $transactionData['title'] = ['Tipe Transaksi', 'Nasabah', 'Total Harga', 'Status', 'Tanggal Transaksi'];
        $transactionData['data'] = LogTransaksi::with('rekening','rekening.user','setoran','penarikan')->take(5)->orderBy('created_at', 'DESC')->get(); // 5 latest transaction
        $reportSummary['totalHargaTransaksiSetor'] = DB::table('log_transaksi')
                                                    ->join('setoran', 'log_transaksi.setoran_id', '=', 'setoran_id')
                                                    ->where('status', '=', 'diterima')
                                                    ->sum('setoran.total_harga');
        $reportSummary['totalHargaTransaksiTarik'] = DB::table('log_transaksi')
                                                    ->join('penarikan', 'log_transaksi.penarikan_id', '=', 'penarikan_id')
                                                    ->where('status', '=', 'diterima')
                                                    ->sum('penarikan.total_harga');
        $reportSummary['jumlahTransaksiBelumDiterima'] = DB::table('log_transaksi')->where('status', 'belum diterima')->count();
        $reportSummary['jumlahTransaksiDiterima'] = DB::table('log_transaksi')->where('status', 'diterima')->count();
        $reportSummary['jumlahTransaksiDitolak'] = DB::table('log_transaksi')->where('status', 'ditolak')->count();
        
        // sampah terkumpul berdasarkan jenis
        $chart['total'] = DB::table('detail_setoran')->sum('jumlah');
        $chart['non organik'] = 0;
        $chart['organik'] = 0;
        // $detailTransaksi = DetailTransaksi::with('sampah.jenis_sampah')->get();
        // foreach ($detailTransaksi as $detail) {
        //     $chart[strtolower($detail->sampah->jenis_sampah->nama)] += $detail->jumlah;
        // }
        

        
        $grafik_pie = DB::table('users')
                        ->select('role', DB::raw('count(*) as total'))
                        ->groupBy('role')
                        ->get();

        return view('private.dashboard', compact('chart','grafik_pie', 'transactionData', 'reportSummary'));
    }
}
