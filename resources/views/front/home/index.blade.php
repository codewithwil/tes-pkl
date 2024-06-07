<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kalkulator bank sampah</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    @php
    $setting = \App\Models\Setting::first();
    $jenis = \App\Models\JenisSampah::all();
    @endphp

    <div class="container">
        <div class="text-center mt-3">
            <h2><b>Hallo selamat datang di kalkulator bank sampah </b></h2>
            <h3 class="mb-4">Pilih sampah yang ingin kamu hitung</h3>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="jenis">Jenis sampah</label>
                    <select name="" id="jenis" class="form-control">
                        <option value="hidden" selected>-- Pilih jenis sampah ---</option>
                        @foreach ($jenis as $item)
                            <option value="{{ $item->id_jenis }}"
                                data-foto="{{ asset('storage/back/foto-jenis-sampah/' . $item->foto) }}"
                                data-nama="{{ $item->nama }}"
                                data-kategori="{{ $item->kategori->nama_kategori }}"
                                data-deskripsi="{{ $item->deskripsi }}"
                                data-harga="{{ $item->harga }}">
                                {{ $item->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="jumlah">Jumlah berat (kg)</label>
                    <input type="number" class="form-control" id="jumlah" placeholder="Masukan jumlah berat yang ingin kamu hitung" min="0" step="0.01">
                </div>
                <button id="hitung" class="btn btn-primary mb-3">Hitung</button> <br>
                <div style="float:left;">
                    <img class="mt-4" src="{{ asset('storage/back/logo/' . optional($setting)->foto_perusahaan) }}" alt="Logo" class="brand-image img-circle elevation-3 rounded-circle" style="opacity: .8" width="150px">
                </div>
                <div style="float:left; margin-left:10px; font-weight:400">
                    <p class="mt-4">nama perusahaan: {{ optional($setting)->nama_perusahaan }}</p>
                    <p class="">alamat: {{ optional($setting)->alamat }}</p>
                    <p class="">nomor telepon: {{ optional($setting)->telepon }}</p>
                    <p class="">website: {{ optional($setting)->web }}</p>
                </div>
                <div style="clear:both;"></div> <!-- Clear float -->
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h3 class="text-white">Detail sampah</h3>
                    </div>
                    <div class="card-body">
                        <div id="output">
                            <p>Foto: <br><img id="foto" src="" alt="Foto sampah" style="max-width: 50%; height: auto;"></p>
                            <p>Nama: <span id="nama"></span></p>
                            <p>Kategori: <span id="kategori"></span></p>
                            <p>Deskripsi: <span id="deskripsi"></span></p>
                            <p>Harga: <span id="harga"></span></p>
                            <p>Total Harga: <span id="totalHarga"></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="bg-light text-center text-lg-start mt-5">
        <div class="container p-4">
            <p class="text-center text-muted">&copy; 2024 {{ optional($setting)->nama_perusahaan }}. All Rights Reserved.</p>
        </div>
    </footer>
    <script>
        document.getElementById('jenis').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            document.getElementById('foto').src = selectedOption.getAttribute('data-foto');
            document.getElementById('nama').textContent = selectedOption.getAttribute('data-nama');
            document.getElementById('kategori').textContent = selectedOption.getAttribute('data-kategori');
            document.getElementById('deskripsi').textContent = selectedOption.getAttribute('data-deskripsi');
            document.getElementById('harga').textContent = selectedOption.getAttribute('data-harga');
        });

        document.getElementById('hitung').addEventListener('click', function() {
            var harga = parseFloat(document.getElementById('harga').textContent);
            var jumlah = parseFloat(document.getElementById('jumlah').value);
            if (!isNaN(harga) && !isNaN(jumlah) && jumlah > 0) {
                var totalHarga = harga * jumlah;
                document.getElementById('totalHarga').textContent = totalHarga.toFixed(2);
            } else {
                document.getElementById('totalHarga').textContent = 'Input tidak valid';
            }
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4xF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
