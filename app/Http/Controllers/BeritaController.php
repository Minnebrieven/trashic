<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita; //panggil model
use App\Models\KategoriBerita;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View; //panggil model
use Illuminate\Support\Facades\DB; // jika pakai query builder
use Illuminate\Database\Eloquent\Model; //jika pakai eloquent
use App\Http\Controllers\redirect;
use PDF;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ar_berita = Berita::with('kategori_berita')->get(); //eloquent
        return view('private.berita.index', compact('ar_berita'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        //ambil master data kategori u/ dilooping di select option form
        $ar_kategoriberita = KategoriBerita::all();
        return view('private.berita.form', compact('ar_kategoriberita'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate(
            [
                'kategori_berita_id' => 'required|integer',
                'judul' => 'required',
                'url' => 'required',
                'deskripsi' => 'required',
                'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|min:2|max:9000', //KB
            ],

            [
                'kategori_berita_id.required' => 'Kategori Wajib Diisi',
                'url.required' => 'link Wajib Diisi',
                'deskripsi.required' => 'Deskeirpsi Wajib Diisi',
                'foto.min' => 'Ukuran file kurang 2 KB',
                'foto.max' => 'Ukuran file melebihi 9000 KB',
                'foto.image' => 'File foto bukan gambar',
                'foto.mimes' => 'Extension file selain jpg,jpeg,png,gif,svg',
            ]
        );

        if (!empty($request->foto)) {
            $fileName = 'berita_' . date("Ymd_h-i-s") . '.' . $request->foto->extension();
            //$fileName = $request->foto->getClientOriginalName();
            $request->foto->move(public_path('private/assets/img'), $fileName);
        } else {
            $fileName = '';
        }

        //lakukan insert data dari request form dgn query builder
        try {
            DB::table('berita')->insert([
                'kategori_berita_id' => $request->kategori_berita_id,
                'user_id' => $request->user_id,
                'judul' => $request->judul,
                'url' => $request->url,
                'deskripsi' => $request->deskripsi,
                'foto' => $fileName
            ]);

            return redirect()->route('berita.index')
                ->with('success', 'Data Berita Baru Berhasil Disimpan');
        } catch (\Exception $e) {
            //return redirect()->back()
            return redirect()->route('berita.index')
                ->with('error', 'Terjadi Kesalahan Saat Input Data!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rs = Berita::find($id);
        return view('private.berita.detail', compact('rs'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //ambil master untuk dilooping di select option
        $ar_kategori = KategoriBerita::all();
        //tampilkan data lama di form edit
        $row = Berita::find($id);
        return view('private.berita.form_edit', compact('row', 'ar_kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate(
            [
                'kategori_berita_id' => 'required|integer',
                'judul' => 'required',
                'url' => 'required',
                'deskripsi' => 'required',
                'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|min:2|max:9000', //KB
            ],

            [
                'kategori_berita_id.required' => 'Kategori Wajib Diisi',
                'url.required' => 'url Wajib Diisi',
                'deskripsi.required' => 'Deskeirpsi Wajib Diisi',
                'foto.min' => 'Ukuran file kurang 2 KB',
                'foto.max' => 'Ukuran file melebihi 9000 KB',
                'foto.image' => 'File foto bukan gambar',
                'foto.mimes' => 'Extension file selain jpg,jpeg,png,gif,svg'
            ]
        );

        $foto = DB::table('berita')->select('foto')->where('id', $id)->get();
        foreach ($foto as $f) {
            $namaFileFotoLama = $f->foto;
        }
        //------------apakah user  ingin ubah upload foto baru-----------
        if (!empty($request->foto)) {
            //jika ada foto lama, hapus foto lamanya terlebih dahulu
            if (!empty($namaFileFotoLama)) {
                try {
                    unlink('private/assets/img/' . $namaFileFotoLama);
                } catch (\Exception $e) {
                    //throw $th;
                }
            }
            //lalukan proses ubah foto lama menjadi foto baru
            $fileName = 'berita_' . date("Ymd_h-i-s") . '.' . $request->foto->extension();
            //$fileName = $request->foto->getClientOriginalName();
            $request->foto->move(public_path('private/assets/img'), $fileName);
        } else {
            $fileName = $namaFileFotoLama;
        }

        //lakukan insert data dari request form dgn query builder
        DB::table('berita')->where('id',$id)->update([
            'kategori_berita_id' => $request->kategori_berita_id,
            'user_id' => $request->user_id,
            'judul' => $request->judul,
            'url' => $request->url,
            'deskripsi' => $request->deskripsi,
            'foto' => $fileName
        ]);
        return redirect('/berita' . '/' . $id)
            ->with('success', 'Data Asset Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //sebelum hapus data, hapus terlebih dahulu fisik file fotonya jika ada
        $berita = Berita::find($id);

        if ($berita) {
            $berita->delete();

            // Additional logic (e.g., deleting associated file)
            if (!empty($berita->foto)) {
                $filePath = 'private/assets/img/' . $berita->foto;
                if (Berita::exists($filePath)) {
                    unlink($filePath);
                }
            }

            return redirect()->route('berita.index')->with('success', 'Data Asset Berhasil Dihapus');
        } else {
            return redirect()->route('berita.index')->with('error', 'Data Asset tidak ditemukan');
        }
    }

    public function delete($id)
    {
        //sebelum hapus data, hapus terlebih dahulu fisik file fotonya jika ada
        $row = Berita::find($id);
        if (!empty($row->foto)) unlink('private/assets/img/' . $row->foto);
        //hapus datanya dari tabel
        Berita::where('id', $id)->delete();
        return redirect()->back();
    }

    public function generatePDF()
    {
        $data = [
            'title' => 'Berita',
            'date' => date('d-m-Y H:i:s')
        ];
        
        $pdf = PDF::loadView('private.berita.beritaPDF', $data);
    
        return $pdf->download('data_tespdf_'.date('d-m-Y_H:i:s').'.pdf');
    }

    public function beritaPDF(){
        $ar_berita = berita::all();
        $pdf = PDF::loadView('private.berita.beritaPDF', 
                            ['ar_berita'=>$ar_berita]);
        return $pdf->download('data_berita_'.date('d-m-Y_H:i:s').'.pdf');
    }   
    
    public function news(){
        $beritaArray = Berita::with('kategori_berita')->orderBy('created_at', 'DESC')->get(); //eloquent
        return view('public.berita.index', compact('beritaArray'));
    }

    public function showNews(string $id){
        $berita = Berita::with('kategori_berita')->find($id); //eloquent
        return view('public.berita.detail', compact('berita'));
    }
}
