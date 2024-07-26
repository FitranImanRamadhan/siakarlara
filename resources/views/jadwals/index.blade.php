@extends('adminlayout')
@section('content')
    @if(session('success'))
        <div class="alert alert-primary alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <br>
    <div class="content-wrapper pb-3 pt-3">
    <div class="d-flex justify-content-between mb-2">
        <a class="btn btn-success" href="{{ route('jadwals.create') }}">Tambah Jabatan</a>
    </div>
    <br>
    <table id="example" class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Pengguna</th>
                <th scope="col">Tgl. Masuk</th>
                <th scope="col">Ket. Jadwal</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1 @endphp
            @foreach ($jadwals as $data)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $data->user->name }}</td>
                    <td>{{ $data->tgl_masuk }}</td>
                    <td>{{ $data->ket_jadwal }}</td>
                    <td>
                        <form action="{{ route('jadwals.destroy',$data->id) }}" method="POST">
                            <a class="btn btn-warning" href="{{ route('jadwals.edit',$data->id) }}">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
@endsection
