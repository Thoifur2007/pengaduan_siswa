<?php

namespace App\Http\Controllers;


use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswas = Siswa::all();

        
        return view('siswa.index' , compact('siswas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('siswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        try {
            $request->validate([
                'pelapor'=> 'required|min:1',
                'terlapor'=> 'required|min:1',
                'kelas'=> 'required|min:1',
                'laporan'=> 'required|min:1',
                'bukti'=> 'required'
            ]);
        
            // Mengupload gambar
                $bukti = $request->file('bukti')->store('bukti', 'public');
                $buktipath =  'storage/'.$bukti;
        
            // Simpan data siswa
            $siswa = Siswa::create([
                'pelapor' => $request->pelapor,
                'terlapor' => $request->terlapor,
                'kelas' => $request->kelas,
                'laporan' => $request->laporan,
                'bukti' => $buktipath,
            ]);
        
            return redirect()->route('siswa.index')->with('success', 'Data Berhasil Disimpan!');
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
        
    }
    


    /**
     * Display the specified resource.
     */
    public function show( $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $user)
    {
        //
    }
    public function selesai($id)
    {
        $siswa = Siswa::find($id);
        $siswa->status = 'SELESAI';
        $siswa->save();

        return redirect()->route('guru.index')->with('success', 'Data Berhasil Diubah');
    }
}
