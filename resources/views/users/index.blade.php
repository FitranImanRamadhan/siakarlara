@extends('tmp')
@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="d-flex justify-content-between mb-2">
<div class="text-end mb-2">
    <a class="btn btn-success" style="margin-top: 20px;" href="{{ route('users.exportPdf') }}">Export</a>
</div>
<div class="text-end mb-2">
    <a class="btn btn-success" style="margin-top: 20px;" href="{{ route('users.create') }}">Add User</a>
</div>
</div>


<br>
<table id="example" class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Email</th>
            <th scope="col">Level</th>  
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @php $no = 1 @endphp
        @foreach ($users as $data)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{$data->nama}}</td>
            <td>{{$data->email}}</td>
            <td>{{$data->hak_akses}}</td>
            <td>
                <form id="delete-form-{{ $data->id }}" action="{{ route('users.destroy', $data->id) }}" method="POST">
                    <a class="btn btn-warning" href="{{ route('users.edit', $data->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-danger" onclick="deleteUser({{ $data->id }})">Delete</button>
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

    function deleteUser(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the form after confirmation
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
@endsection
