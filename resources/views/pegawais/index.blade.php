@extends('adminlayout')
@section('content')
    @if (session('success'))
        <div class="alert alert-primary alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <br>

    <form action="{{ route('pegawais.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <button type="submit" class="btn btn-primary">Import</button>
        <div class="form-group mt-2">
            <input style="width: 300px" type="file" name="file" class="form-control" required>
        </div>
    </form>

    <br>

    <div class="mb-2">
        <a class="btn btn-success float-end" href="{{ route('pegawais.create') }}">Add Pegawai</a>
    </div>

    <form action="{{ route('export.pegawais') }}" method="GET">
        @csrf
        <button type="submit" class="btn btn-primary">Export Pegawais to Excel</button>
    </form>

    <br><br>

    <table id="example" class="table table-striped table-responsive table-hover">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Id</th>
                <th scope="col">Nama</th>
                <th scope="col">Toko</th>
                <th scope="col">Jabatan </th>
                <th scope="col">Score</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1 @endphp
            @foreach ($pegawais as $data)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $data->id }}</td>
                    <td>{{ $data->nama }}</td>
                    <td>{{ $data->toko }}</td>
                    <td>{{ $data->jabatan }}</td>
                    <td>{{ $data->score }}</td>
                    <td data-label="Actions:" class="text-nowrap">
                        <a href="{{ route('pegawais.show', $data->id) }}" type="button"
                            class="btn btn-primary btn-sm me-1">@lang('Show')</a>
                        <div class="btn-group btn-group-sm">
                            <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown"
                                aria-expanded="false"><i class="fa fa-cog"></i></button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item"
                                        href="{{ route('pegawais.edit', $data->id) }}">@lang('Edit')</a></li>
                                <li>
                                    <form action="{{ route('pegawais.destroy', $data->id) }}" method="POST"
                                        style="display: inline;" class="m-0 p-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item delete-btn">@lang('Delete')</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
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
