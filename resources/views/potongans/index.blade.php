@extends('tmp')
@section('content')
@if(session('success'))
<div class="alert alert-primary alert-dismissible fade show">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<br>
<div class="mb-4">
    <a class="btn btn-success float-end" href="{{ route('potongans.create') }}">Add Potongan</a>
</div>


<br>
<table id="example" class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Umur</th>
            <th scope="col">BPJS TK</th>
            <th scope="col">BPJS KESEHATAN</th>
            <th scope="col">Alpha</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @php $no = 1 @endphp
        @foreach ($potongans as $data)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $data->umr ? $data->umr->upah_umr : '0' }}</td>
            <td>{{ $data->bpjs_tk }}</td>
            <td>{{ $data->bpjs_kes }}</td>
            <td>{{ $data->alpha }}</td>
            <td>
                <form action="{{ route('potongans.destroy',$data->id) }}" method="Post">
                    <a class="btn btn-warning" href="{{ route('potongans.edit',$data->id) }}">Edit</a>
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