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
    <a class="btn btn-success" href="{{ route('positions.create') }}">Add Jabatan</a>
</div>


<br>
<table id="example" class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Jabatan</th>
            <th scope="col">Gaji Perhari</th>
            <th scope="col">Tunjangan Jabatan</th>
            <th scope="col">Uang Makan</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @php $no = 1 @endphp
        @foreach ($positions as $data)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $data->jabatan }}</td>
            <td>{{ $data->gaji_perhari }}</td>
            '<td>{{ $data->tunjangan_jabatan }}</td>
            <td>{{ $data->uang_makan }}</td>
            <td>
                <form action="{{ route('positions.destroy',$data->id) }}" method="Post">
                    <a class="btn btn-warning" href="{{ route('positions.edit',$data->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger delete-btn">Delete</button>
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

    $(document).ready(function() {
        $('#example').DataTable();
        $('.delete-btn').click(function(e) {
            e.preventDefault();
            var form = $(this).closest('form');
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
                    form.submit();
                }
            });
        });
    });

</script>
@endsection