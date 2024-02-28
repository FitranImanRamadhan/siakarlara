@extends('tmp')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $title }}</div>

                <div class="card-body">
                    <form id="updateForm" method="POST" action="{{ route('users.update', $user->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nama<span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" required autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mt-2">
                            <label for="nip" class="col-md-4 col-form-label text-md-right">NIP<span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="nip" type="text" class="form-control @error('nip') is-invalid @enderror" name="nip" value="{{ old('nip', $user->nip) }}" required>

                                @error('nip')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mt-2">
                            <label for="position_id" class="col-md-4 col-form-label text-md-right">Jabatan<span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <select id="position_id" class="form-control @error('position_id') is-invalid @enderror" name="position_id" required>
                                    <option value="" disabled>Klik untuk memilih position</option>
                                    @foreach ($pst as $item)
                                        <option value="{{ $item->id }}" {{ $item->id == $user->position_id ? 'selected' : '' }}>{{ $item->jabatan }}</option>
                                    @endforeach
                                </select>

                                @error('position_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mt-2">
                            <label for="level" class="col-md-4 col-form-label text-md-right">Level<span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <select id="level" class="form-control @error('level') is-invalid @enderror" name="level" required>
                                    <option value="" disabled>Select Level</option>
                                    <option value="1" {{ $user->level == 1 ? 'selected' : '' }}>Admin</option>
                                    <option value="0" {{ $user->level == 0 ? 'selected' : '' }}>User</option>
                                </select>

                                @error('level')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mt-4">
                            <div class="col-md-6 offset-md-4">
                                <button type="button" id="updateBtn" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#updateBtn').click(function() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to update this user's information!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#updateForm').submit();
                }
            });
        });
    });
</script>
@endsection
