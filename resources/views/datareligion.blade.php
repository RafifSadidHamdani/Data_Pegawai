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
            <h1 class="m-0">Data Agama</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">Data Agama</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="container">
        <a href="/tambahreligion" type="button" class="btn btn-secondary active">Tambah</a>

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
                    <th scope="col">Nama Agama</th>
                  </tr>
                </thead>
                <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($data as $index => $row)
                    <tr>
                        <th scope="row">{{ $index + $data->firstitem() }}</th>
                        <td>{{ $row->nama }}</td>

                    </tr>
                @endforeach
                </tbody>
              </table>
              {{ $data->links() }}
        </div>
    </div>
</div>
@push('scripts')

</body>


@endpush
@endsection
