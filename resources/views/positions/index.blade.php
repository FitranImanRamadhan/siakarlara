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
    
    <div>
        <a class="btn btn-success" href="{{ route('position.exportExcel') }}">Export Excel</a>
        
    </div>
    <a class="btn btn-success" href="{{ route('positions.create') }}">Tambah Jabatan</a>
</div>


<br>
<table id="example" class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Jabatan</th>
            <th scope="col">Gaji Pokok</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @php $no = 1 @endphp
        @foreach ($positions as $data)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $data->jabatan }}</td>
            <td>{{ $data->gapok }}</td>
            <td>
                <form action="{{ route('positions.destroy',$data->id) }}" method="Post">
                    <a class="btn btn-warning" href="{{ route('positions.edit',$data->id) }}">Edit</a>
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