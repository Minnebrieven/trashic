<?php

namespace App\Http\Controllers;

use App\Models\Penjual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // jika pakai query builder
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\View; //panggil model
use Illuminate\Http\RedirectResponse;

class PenjualController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ar_penjual = Penjual::all();//eloquent
        return view('private.penjual.index', compact('ar_penjual'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        //ambil master data kategori u/ dilooping di select option form
        $ar_penjual =Penjual::all();
        return view('private.penjual.form', compact('ar_penjual'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate(
            [
                'nama' => 'required|max:45',
                'alamat' => 'required',
                'telepon' => 'required',
            ],

            [
                'nama.required' => 'Nama Wajib Diisi',
                'nama.max' => 'Nama Maksimal 45 karakter',
                'alamat.required' => 'Alamat Wajib Diisi',
                'telepon.required' => 'No Telepon Wajib Diisi',
            ]
        );
        //lakukan insert data dari request form dgn query builder
        try {
            DB::table('penjual')->insert([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'telepon' => $request->telepon,
            ]);

            return redirect()->route('penjual.index')
                ->with('success', 'Data Penjual Baru Berhasil Disimpan');
        } catch (\Exception $e) {
            //return redirect()->back()
            return redirect()->route('penjual.index')
                ->with('error', 'Terjadi Kesalahan Saat Input Data!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rs = Penjual::find($id);
        return view('private.penjual.detail', compact('rs'));
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
    public function destroy($id): RedirectResponse
    {
        //get post by ID
        $penjual = Penjual::findOrFail($id);

        //delete post
        $penjual->delete();

        //redirect to index
        return redirect()->route('penjual.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
