@extends('tmp')
@section('content')
    @if (session('success'))
        <div class="alert alert-primary alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

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
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

