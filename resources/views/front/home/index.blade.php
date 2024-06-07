<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=], initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kalkulator bank sampah</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    @php
    $setting = \App\Models\setting::first();
    $jenis = \App\Models\jenisSampah::get();
    @endphp

        <div class="container">
            <div class="text-center mt-3">
                <h2>Hallo selamat datang di kalkulator bank sampah {{ optional($setting)->nama_perusahaan }}</h2>
                <img src="{{ asset('storage/back/logo/' . optional($setting)->foto_perusahaan) }}" alt=" Logo" class="brand-image img-circle elevation-3 rounded-circle" style="opacity: .8" width="150px">
                <h3 class="mb-4">pilih sampah yang ingin kamu hitung</h3>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="jenis">Jenis sampah</label>
                        <select name="" id="jenis" class="form-control">
                            <option value="hidden" selected>-- Pilih jenis sampah ---</option>
                            @foreach ($jenis as $item)
                                <option value="{{$item->id_jenis}}">{{$item->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah berat</label>
                        <input type="number" class="form-control" id="jumlah" placeholder="masukan jumlah berat yang ingin kamu hitung">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3>Detail sampah</h3>
                        </div>
                        <div class="card-body">
                            tes
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>