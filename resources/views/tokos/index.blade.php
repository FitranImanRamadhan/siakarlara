@extends('adminlayout')

@section('content')
    <div class="container">
        <div class="card">
            <div class="mb-2">
                <a class="btn btn-success float-end" href="{{ route('tokos.create') }}">Tambah Cabang</a>
            </div>
            <div class="card-body">
                <table id="example" class="table table-striped table-responsive table-hover">
                    <thead role="rowgroup">
                        <tr role="row">
                            <th role='columnheader'>Toko</th>
                            <th scope="col" data-label="Actions">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tokos as $toko)
                            <tr>
                                <td data-label="Toko">{{ $toko->toko ?: '(blank)' }}</td>

                                <td data-label="Actions:" class="text-nowrap">
                                    <a href="{{ route('tokos.show', compact('toko')) }}" type="button"
                                        class="btn btn-primary btn-sm me-1">@lang('Show')</a>
                                    <div class="btn-group btn-group-sm">
                                        <button type="button" class="btn btn-light dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                class="fa fa-cog"></i></button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item"
                                                    href="{{ route('tokos.edit', compact('toko')) }}">@lang('Edit')</a>
                                            </li>
                                            <li>
                                                <form action="{{ route('tokos.destroy', compact('toko')) }}" method="POST"
                                                    style="display: inline;" class="m-0 p-0">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item">@lang('Delete')</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
@endsection
@section('js')
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
@endsection