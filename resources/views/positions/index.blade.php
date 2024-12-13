@extends('adminlayout')
@section('content')
    <div class="container">
        <div class="card">
            <div class="mb-2 mr-4">
                <a class="btn btn-success float-end" href="{{ route('positions.create') }}">Add Pegawai</a>
            </div>
            <div class="card-body">
                <table id="example" class="table table-striped table-responsive table-hover">
                    <thead role="rowgroup">
                        <tr role="row">
                            <th role='columnheader'>Jabatan</th>
                            <th scope="col" data-label="Actions">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($positions as $position)
                            <tr>
                                <td data-label="Jabatan">{{ $position->jabatan ?: '(blank)' }}</td>

                                <td data-label="Actions:" class="text-nowrap">
                                    <a href="{{ route('positions.show', compact('position')) }}" type="button"
                                        class="btn btn-primary btn-sm me-1">@lang('Show')</a>
                                    <div class="btn-group btn-group-sm">
                                        <button type="button" class="btn btn-light dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                class="fa fa-cog"></i></button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item"
                                                    href="{{ route('positions.edit', compact('position')) }}">@lang('Edit')</a>
                                            </li>
                                            <li>
                                                <form action="{{ route('positions.destroy', compact('position')) }}"
                                                    method="POST" style="display: inline;" class="m-0 p-0">
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
