@extends('tmp')
@section('content')
@if(session('success'))
<div class="alert alert-primary alert-dismissible fade show">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<br>
<div class="d-flex justify-content-between mb-2">
    <a class="btn btn-success" href="{{ route('umrs.create') }}">Tambah Upah Minimum</a>
</div>


<br>
<table id="example" class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Kota</th>
            <th scope="col">Upah Minimun</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @php $no = 1 @endphp
        @foreach ($umrs as $data)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $data->kota }}</td>
            <td>{{ $data->upah_umr }}</td>
            <td>
                <form action="{{ route('umrs.destroy',$data->id) }}" method="Post">
                    <a class="btn btn-warning" href="{{ route('umrs.edit',$data->id) }}">Edit</a>
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