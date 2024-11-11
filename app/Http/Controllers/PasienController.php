<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $client = new Client();
        $url = "http://localhost:8000/api/pasien";
        $response = $client->request('GET', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        $data = $contentArray['data'];
        return view('pasien.index', ['data'=>$data]);

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

        $nama_pasien = $request->nama_pasien;
        $nik = $request->nik;
        $alamat = $request->alamat;
        $jumlah_kunjungan = $request->jumlah_kunjungan;

        $parameter =[
            'nama_pasien' => $nama_pasien,
            'nik' => $nik,
            'alamat' => $alamat,
            'jumlah_kunjungan' => $jumlah_kunjungan,
        ];

        $client = new Client();
        $url = "http://localhost:8000/api/pasien";
        $response = $client->request('POST', $url, [
            'headers' =>['Content-type' => 'application/json'],
            'body' => json_encode($parameter)
        ]);

        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        echo $contentArray['status'];
    }


    public function tambahKunjungan(Request $request)
    {
        // Mendapatkan input no rekam medis dan jumlah kunjungan yang akan ditambah
        $noRekamMedis = $request->input('no_rekam_medis');
        $tambahKunjungan = $request->input('tambah_kunjungan', 1);  // Default tambah 1 kunjungan jika tidak diisi

        // Cari pasien berdasarkan no_rekam_medis
        $pasien = Pasien::where('no_rekam_medis', $noRekamMedis)->first();

        // Jika pasien tidak ditemukan, tampilkan pesan error
        if (!$pasien) {
            return back()->with('error', 'Pasien dengan nomor rekam medis tersebut tidak ditemukan.');
        }

        // Tambahkan kunjungan
        $pasien->jumlah_kunjungan += $tambahKunjungan;
        $pasien->save();

        // Kembalikan tampilan dengan data pasien yang sudah ditambah kunjungannya
        return view('pasien.index', compact('pasien'))->with('success', 'Jumlah kunjungan berhasil ditambah');
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
}
