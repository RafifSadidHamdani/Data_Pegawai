@extends('layout.admin')
@push('css')
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@endpush

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Riwayat Penghapusan Data Pekerjaan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">Riwayat Penghapusan Data Pekerjaan</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="container">
        <a href="/datajob" type="button" class="btn btn-secondary active">Kembali</a>

        {{-- <div class="row g-3 align-items-center mt-2 mb-2">
            <div class="col-auto ">
            <form action="/pegawai" method="GET">
                <input type="search" id="inputPassword6" name="search" class="form-control " aria-describedby="passwordHelp">
            </form>
            </div>

            <div class="col-auto">
                <a href="/exportpdf" type="button" class="btn btn-secondary active">Export PDF</a>
            </div>

        </div> --}}
        <div class="row mt-5">
            <table class="table">
                <thead class="thead-light ">
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Gaji</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($data as $index => $row)
                    <tr>
                        <th scope="row">{{ $data as $index => $row }}</th>
                        <td>{{ $row->nama }}</td>
                        <td>Rp.{{ $row->gaji }}</td>
                        <td>
                            <button type="button" onclick="restorejob('{{ $row->id }}')" class="btn btn-secondary active">Restore</button>
                            <a href="/permjob/{{ $row->id }}" onclick="permjob('{{ $row->id }}')" class="btn btn-secondary active">Hapus Permanen</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
              </table>
              {{ $data->links() }}
        </div>
    </div>
</div>
@push('scripts')

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>
<script>
    function restorejob(id){
        message = confirm('Yakin Data Akan di-Restore?');
        if (message){
            window.location="/restorejob/"+id+" "
        }
    }

    function permjob(id){
        message = confirm('Yakin Data Akan di-Hapus Permanen?');
        if (message){
            window.location="/permjob/"+id+" "
        }
    }
  </script>

@endpush
@endsection
