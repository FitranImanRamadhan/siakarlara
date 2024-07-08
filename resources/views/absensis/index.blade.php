@extends('adminlayout')

@section('content')
    @if (session('success'))
        <div class="alert alert-primary alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <br>

    <form action="{{ route('absensis.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <button type="submit" class="btn btn-primary">Import</button>
        <div class="form-group mt-2">
            <input style="width: 300px" type="file" name="file" class="form-control" required>
        </div>
    </form>

    <br>

    <div class="mb-2">
        <a class="btn btn-success float-end" href="{{ route('absensis.create') }}">Add Absensi</a>
    </div>

    <form action="{{ route('export.absensis') }}" method="GET">
        @csrf
        <button type="submit" class="btn btn-primary">Export Absensis to Excel</button>
    </form>

    <br><br>

    <table id="example" class="table table-striped table-responsive table-hover">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Id</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Jam</th>
                <th scope="col">Kode1 </th>
                <th scope="col">Kode2 </th>
                <th scope="col">Kode3 </th>
                <th scope="col">Keterangan </th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1 @endphp
            @foreach ($absensis as $data)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $data->id }}</td>
                    <td>{{ $data->tanggal }}</td>
                    <td>{{ $data->jam }}</td>
                    <td>{{ $data->kode1 }}</td>
                    <td>{{ $data->kode2 }}</td>
                    <td>{{ $data->kode3 }}</td>
                    <td>{{ $data->keterangan }}</td>
                    <td data-label="Actions:" class="text-nowrap">
                        <a href="{{ route('absensis.show', $data->id) }}" type="button"
                            class="btn btn-primary btn-sm me-1">@lang('Show')</a>
                        <div class="btn-group btn-group-sm">
                            <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown"
                                aria-expanded="false"><i class="fa fa-cog"></i></button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item"
                                        href="{{ route('absensis.edit', $data->id) }}">@lang('Edit')</a></li>
                                <li>
                                    <form action="{{ route('absensis.destroy', $data->id) }}" method="POST"
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

