<?php

namespace App\Http\Controllers;

use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\DB; // jika pakai query builder
use App\Models\MetodePembayaran; //panggil model
use App\Models\Rekening; //panggil model

class PenarikanController extends Controller
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
        $arrayMetodePembayaran = MetodePembayaran::all();
        // $arrayRekening = Rekening::all();
        return view('public.penarikan.form', compact('arrayMetodePembayaran'));
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
                'total_harga' => 'required|between:1,99.99',
                'metode_pembayaran_id' => 'required|integer'
            ],

            //column custom errors
            [
                'rekening_id.required' => 'wajib login atau mempunyai rekening agar dapat mengakses fitur ini',
                'rekening_id.integer' => 'wajib login atau mempunyai rekening agar dapat mengakses fitur ini',
                'metode_pembayaran_id.required' => 'metode pembayaran wajib diisi',
                'metode_pembayaran_id.integer' => 'pilih metode pembayaran',
                'harga.required' => 'harga wajib diisi',
                'harga.regex' => 'harga wajib berpola nominal uang',
            ]); 

        try {
            if ($request->total_harga <= 0) {
                throw new Exception('Saldo yang ditarik tidak dapat dibawah 0.');
            }

            $saldo = DB::table('rekening')->where('id', $request->rekening_id)->value('saldo');
            if ($saldo <= 0 || $saldo < $request->total_harga) {
                throw new Exception('Saldo tidak Mencukupi!');
            }

            $now = DB::raw('CURRENT_TIMESTAMP');
         
            $lastInsertedPenarikanID = DB::table('penarikan')->insertGetId([
                'rekening_id' => $request->rekening_id,
                'total_harga' => $request->total_harga,
                'metode_pembayaran_id' => $request->metode_pembayaran_id,
                'created_at' => $now,
                'updated_at' => $now
            ]);

            $lastInsertedLogTransaksiID = DB::table('log_transaksi')->insertGetId([
                'rekening_id' => $request->rekening_id,
                'penarikan_id' => $lastInsertedPenarikanID,
                'status' => 'belum diterima',
                'created_at' => $now,
                'updated_at' => $now
            ]);
            
            return redirect()->route('transaksiku.show.penarikan', $lastInsertedLogTransaksiID)
                ->with('success', 'Penarikan berhasil !. ID Penarikan:'.$lastInsertedLogTransaksiID);
        } catch (\Exception $e) {
            //return redirect()->back()
            return redirect()->route('penarikan.create')
                ->with('errors', 'Terjadi kesalahan saat penarikan dibuat!. Error : '.$e->getMessage());
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function create_tarik_oleh_admin()
    {
        return view('private.transaksi.form_create_penarikan', [
            'rekening' => Rekening::all(),
            'arrayMetodePembayaran' =>  MetodePembayaran::all()
        ]);
    }

    public function store_tarik_oleh_admin(Request $request)
    {
        $validated = $request->validate(
            // column to validate and rules
            [
                'rekening_id' => 'required|integer',
                'total_harga' => 'required|between:1,99.99',
                'metode_pembayaran_id' => 'required|integer'
            ],

            //column custom errors
            [
                'rekening_id.required' => 'wajib login atau mempunyai rekening agar dapat mengakses fitur ini',
                'rekening_id.integer' => 'wajib login atau mempunyai rekening agar dapat mengakses fitur ini',
                'metode_pembayaran_id.required' => 'metode pembayaran wajib diisi',
                'metode_pembayaran_id.integer' => 'pilih metode pembayaran',
                'harga.required' => 'harga wajib diisi',
                'harga.regex' => 'harga wajib berpola nominal uang',
            ]);

        try {
            $rekeningNasabah = Rekening::find($request->rekening_id);

            if ($request->total_harga <= 0) {
                throw new Exception('Saldo yang ditarik tidak dapat dibawah 0.');
            }

            $saldo = $rekeningNasabah->saldo;
            if ($saldo <= 0 || $saldo < $request->total_harga) {
                throw new Exception('Saldo tidak Mencukupi!');
            }

            $now = DB::raw('CURRENT_TIMESTAMP');
         
            $lastInsertedPenarikanID = DB::table('penarikan')->insertGetId([
                'rekening_id' => $request->rekening_id,
                'total_harga' => $request->total_harga,
                'metode_pembayaran_id' => $request->metode_pembayaran_id,
                'created_at' => $now,
                'updated_at' => $now
            ]);

            $lastInsertedLogTransaksiID = DB::table('log_transaksi')->insertGetId([
                'rekening_id' => $request->rekening_id,
                'penarikan_id' => $lastInsertedPenarikanID,
                'status' => 'diterima',
                'created_at' => $now,
                'updated_at' => $now
            ]);

            $rekeningNasabah->decrement('saldo', $request->total_harga);
            
            return redirect()->route('transaksi.show', $lastInsertedLogTransaksiID)
                ->with('success', 'Penarikan berhasil !. ID Penarikan:'.$lastInsertedPenarikanID);
        } catch (\Exception $e) {
            //return redirect()->back()
            $errors = new MessageBag(['general' => 'Terjadi kesalahan saat penarikan dibuat!. \n Error : '.$e->getMessage()]);
            return redirect()->back()
                ->withErrors($errors)->withInput();
        }
    }
}
