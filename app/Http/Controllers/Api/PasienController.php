<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Pasien::orderBy('no_rekam_medis','asc')->get();
        return response()->json([
            'status' => true,
            'message' => 'Data ditemukan',
            'data' => $data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         // Hitung jumlah pasien yang ada di database dan tambahkan 1 untuk no_rekam_medis baru
        $latestCount = Pasien::count() + 1;
        $noRekamMedis = 'RM' . str_pad($latestCount, 4, '0', STR_PAD_LEFT);

        // Buat instance baru dari model Pasien
        $dataPasien = new Pasien;

        $rules = [
            'nama_pasien' => 'required',
            'nik' => 'required',
            'alamat' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' =>' Gagal memasukkan data',
                'data' => $validator->errors()
            ]);
        }

        $dataPasien->no_rekam_medis = $noRekamMedis;  // Isi no_rekam_medis otomatis
        $dataPasien->nama_pasien = $request->nama_pasien;
        $dataPasien->nik = $request->nik;
        $dataPasien->alamat = $request->alamat;
        $dataPasien->jumlah_kunjungan = $request->jumlah_kunjungan;

        // Simpan data pasien baru
        $post = $dataPasien->save();

        return response()->json([
            'status' => true,
            'message' => 'Sukses memasukkan data'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Pasien::find($id);
        if($data){
            return response()->json([
                'status' => true,
                'message' => 'Data ditemukan',
                'data' => $data
            ], 200);
        }else{
            return response()->json([
                'status'=>false,
                'message' => 'Data tidak ditemukan'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Buat instance baru dari model Pasien
        $dataPasien = Pasien::find($id);
        if(empty($dataPasien)){
            return response ()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $rules = [
            'nama_pasien' => 'required',
            'nik' => 'required',
            'alamat' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' =>' Gagal melakukan update data',
                'data' => $validator->errors()
            ]);
        }
        
        $dataPasien->nama_pasien = $request->nama_pasien;
        $dataPasien->nik = $request->nik;
        $dataPasien->alamat = $request->alamat;
        $dataPasien->jumlah_kunjungan = $request->jumlah_kunjungan;

        // Simpan data pasien baru
        $post = $dataPasien->save();

        return response()->json([
            'status' => true,
            'message' => 'Sukses melakukan update data'
        ]);
    }
          
    public function tambahKunjungan($id)
    {
        // Cari pasien berdasarkan ID
        $pasien = Pasien::find($id);
    
        if (!$pasien) {
            return response()->json([
                'status' => false,
                'message' => 'Pasien tidak ditemukan'
            ], 404);
        }

        // Tambahkan kunjungan
        $pasien->jumlah_kunjungan += 1;
        $pasien->save();

        return response()->json([
            'status' => true,
            'message' => 'Kunjungan berhasil ditambah',
            'jumlah_kunjungan' => $pasien->jumlah_kunjungan
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
