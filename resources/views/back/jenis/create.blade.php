@extends('back.layout.template')
@section('title', 'tambah jenis sampah')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Tambah jenis sampah</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Tambah jenis sampah </li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">jenis sampah</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            @if ($errors->any())
            <div class="my-3">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif

            <form action="{{route('jenis.store')}}" method="post" enctype="multipart/form-data">
                @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="foto">Foto sampah</label>
                      <input type="file" class="form-control" id="foto" name="foto">
                  </div>

                <div class="form-group">
                    <label for="nama">Nama sampah</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="isi nama sampah..." >
                    @error('nama')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
                  </div>

                  <div class="form-group">
                    <label for="kategori">Kategori sampah</label>
                    <select name="kategori_id" id="kategori" class="form-control">
                        <option value="hidden" selected>--- pilih kategori sampah ---</option>
                      @foreach ($kategori as $item)
                          <option value="{{$item->id_kategori}}">{{$item->nama_kategori}}</option>
                      @endforeach
                    </select>
                    @error('nama')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
                  </div>
                  <div class="form-group">
                    <label for="deskripsi">deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control" cols="30" rows="5"></textarea>
                    @error('deskripsi')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
                  </div>
                  <div class="form-group">
                    <label for="harga">harga per kilogram</label>
                    <input type="number" min="1" class="form-control" id="harga" name="harga" placeholder="isi harga sampah..." >
                    @error('harga')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
                  </div>
                  </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-warning">Submit</button>
                <a href="{{route('kategori.index')}}" class="btn btn-primary">Kembali</a>
              </div>
            </form>
          </div>
          <!-- /.card -->
        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>


  @push('js')

  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <script>
    $(document).ready(function(){
        // Cek apakah pesan 'success' ada dalam session
        @if(session('success'))
            // Tampilkan pesan Toastr
            toastr.success('{{ session('success') }}');
            // Hapus pesan 'success' dari session
            {{ session()->forget('success') }}
        @endif
    });
  </script>


  @endpush
@endsection
