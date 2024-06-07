@extends('back.layout.template')
@section('title', 'jenis sampah')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">


    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data jenis sampah</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data jenis sampah</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Kelola data user</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <a href="{{route('jenis.tambah')}}" class="btn btn-warning mb-3">Tambah jenis sampah</a>
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
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>foto</th>
                    <th>nama</th>
                    <th>kategori sampah</th>
                    <th>deskripsi</th>
                    <th>harga</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($jenis as $item)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td><img src="{{asset('storage/back/foto-jenis-sampah/'.$item->foto) }}" class="img-thumbnail img-preview" alt="Foto sampah" width="120px">                              </td>
                    <td>{{$item->nama}}</td>
                    <td>{{$item->kategori->nama_kategori}}</td>
                    <td>{{$item->deskripsi}}</td>

                    <td>
                        <a href="{{route('jenis.edit', $item->id_jenis)}}" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pen"></i></a>
                        @if (Auth::user()->level !== 'petugas')
                        <a href="#" onclick="deleteKategori(this)" data-id="{{$item->id_jenis}}"
                          class="btn btn-danger shadow btn-xs sharp"><i class="fas fa-trash"></i></a>
                          @endif
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No</th>
                    <th>nama</th>
                    <th>foto</th>
                    <th>kategori sampah</th>
                    <th>deskripsi</th>
                    <th>harga</th>
                  </tr>
                  </tfoot>
                </table>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->




  @push('js')
    <!-- DataTables  & Plugins -->
    <script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin/plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('admin/plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('admin/plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('admin/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('admin/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('admin/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    $(function () {
        $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        });
    });
    </script>
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

<script>
  function deleteKategori(e) {
      let id_kategori = e.getAttribute('data-id');
      console.log("ID Kategori yang Dihapus:", id_kategori);

      Swal.fire({
          title: 'Delete Kategori ' + id_kategori,
          text: "Are you sure?",
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Delete',
          cancelButtonText: 'Cancel',
      }).then((result) => {
          if (result.isConfirmed) {
              $.ajax({
                  type: 'POST',
                  url: '{{ route("jenis.delete") }}',
                  data: {
                      _token: '{{ csrf_token() }}',
                      _method: 'POST',
                      id_kategori: id_kategori
                  },
                  dataType: "json",
                  success: function (response) {
                      Swal.fire({
                          title: "Success",
                          text: response.message,
                          icon: 'success',
                      }).then((result) => {
                          window.location.href = '/jenis';
                      });
                  },
                  error: function (xhr, ajaxOptions, thrownError) {
                      alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                  }
              });
          }
      });
  }
  </script>
  @endpush
@endsection
