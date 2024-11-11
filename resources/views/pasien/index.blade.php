<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MEDISIN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>

<body class="bg-light">
    <main class="container">
        <!-- Menampilkan pesan sukses atau error -->
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        <div class="d-flex justify-content-center align-items-center mb-1">
            <!-- Menampilkan logo di tengah -->
            <img src="{{ asset('images/logo-medisin.png') }}" alt="Logo" class="img-fluid" style="max-width: 200px;">
        </div>
        
        <!-- Tombol Awal (Tambah Pasien dan Tambah Kunjungan-->
        <div class="my-3 p-3 rounded d-flex gap-4" >
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahPasienModal">
                Tambah Pasien
            </button>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#cariPasienModal">
                Tambah Kunjungan
            </button>
        </div>


        <!-- AWAL FORM TOMBOL TAMBAH KUNJUNGAN -->
        <div class="modal fade" id="cariPasienModal" tabindex="-1" aria-labelledby="cariPasienLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cariPasienLabel">Cari Pasien Berdasarkan No Rekam Medis</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('pasien.tambahKunjungan') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="no_rekam_medis" class="form-label">No Rekam Medis</label>
                                <input type="text" class="form-control" name="no_rekam_medis" id="no_rekam_medis" required>
                            </div>

                            <!-- Display data pasien jika tersedia -->
                            @isset($pasien)
                            <div class="mt-3">
                                <h5>Data Pasien</h5>
                                <div class="mb-3">
                                    <label class="form-label">Nama Pasien</label>
                                    <input type="text" class="form-control" value="{{ $pasien->nama_pasien }}" disabled>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">NIK</label>
                                    <input type="text" class="form-control" value="{{ $pasien->nik }}" disabled>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Alamat</label>
                                    <input type="text" class="form-control" value="{{ $pasien->alamat }}" disabled>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Jumlah Kunjungan</label>
                                    <input type="text" class="form-control" value="{{ $pasien->jumlah_kunjungan }}" disabled>
                                </div>
                                <!-- Kunjungan akan bertambah 1 -->
                                <div class="mb-3">
                                    <label class="form-label">Tambah Kunjungan</label>
                                    <input type="number" class="form-control" name="tambah_kunjungan" value="1" min="1" required>
                                </div>
                            </div>
                            @endisset

                            <!-- Tombol Submit Tambah Kunjungan -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Tambah Kunjungan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- AKHIR FORM TOMBOL TAMBAH KUNJUNGAN -->

        <!-- AWAL FORM TOMBOL TAMBAH PASIEN -->
        <div class="modal fade" id="tambahPasienModal" tabindex="-1" aria-labelledby="tambahPasienLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahPasienLabel">Tambah Pasien</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action='' method='post'>
                            @csrf
                            <div class="mb-3 row">
                                <label for="no_rekam_medis" class="col-sm-4 col-form-label"></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name='no_rekam_medis' id="no_rekam_medis" 
                                           value="No. Rekam Medis" disabled style="background-color: #e9ecef;">
                                </div>
                            </div>
                            <!-- Menambah Data Pasien -->
                            <div class="mb-3 row">
                                <label for="nama_pasien" class="col-sm-4 col-form-label">Nama Pasien</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name='nama_pasien' id="nama_pasien">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="nik" class="col-sm-4 col-form-label">NIK</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name='nik' id="nik">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="alamat" class="col-sm-4 col-form-label">Alamat</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name='alamat' id="alamat">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="jumlah_kunjungan" class="col-sm-4 col-form-label">Jumlah Kunjungan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="Isi 0 jika belum ada" name='jumlah_kunjungan' id="jumlah_kunjungan">
                                </div>
                            </div>
                            <!-- Tombol Submit Tambah Pasien-->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary" name="submit">SIMPAN</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- AKHIR FORM TOMBOL TAMBAH PASIEN -->

        <!-- START DATA -->
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="col-md-1">No</th>
                        <th class="col-md-4">No. Rekam Medis</th>
                        <th class="col-md-3">Nama Pasien</th>
                        <th class="col-md-2">NIK</th>
                        <th class="col-md-2">Alamat</th>
                        <th class="col-md-2">Jumlah Kunjungan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                    <tr>
                        <td>{{ $item['id'] }}</td>
                        <td>{{ $item['no_rekam_medis'] }}</td>
                        <td>{{ $item['nama_pasien'] }}</td>
                        <td>{{ $item['nik'] }}</td>
                        <td>{{ $item['alamat'] }}</td>
                        <td>{{ $item['jumlah_kunjungan'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- AKHIR DATA -->
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>
</body>

</html>