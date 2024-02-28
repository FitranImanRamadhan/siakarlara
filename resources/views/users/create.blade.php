@extends('tmp')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $title }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('users.create') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nama <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>

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
                                <input id="nip" type="text" class="form-control @error('nip') is-invalid @enderror" name="nip" value="{{ old('nip') }}" required>

                                @error('nip')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mt-2">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password<span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                <small id="passwordHelpBlock" class="form-text text-muted">
                                    Password akan disetel otomatis berdasarkan NIP.
                                </small>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                       <div class="form-group row mt-2">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password<span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                   <div class="form-group row mt-2">
                        <label for="position_id" class="col-md-4 col-form-label text-md-right">Jabatan<span class="text-danger">*</span></label>

                        <div class="col-md-6">
                            <select id="position_id" class="form-control @error('position_id') is-invalid @enderror" name="position_id" required>
                                <option value="" disabled selected>Klik untuk memilih position</option>
                                @foreach ($pst as $item)
                                    <option value="{{ $item->id }}">{{ $item->jabatan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                       <div class="form-group row mt-2">
                            <label for="level" class="col-md-4 col-form-label text-md-right">Level<span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <select id="level" class="form-control @error('level') is-invalid @enderror" name="level" required>
                                    <option value="">Select Level</option>
                                    <option value="1">Admin</option>
                                    <option value="0">User</option>
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
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('nip').addEventListener('input', function() {
    var nipValue = this.value;
    var passwordInput = document.getElementById('password');
    var confirmPasswordInput = document.getElementById('password-confirm');
    
    // Jika nilai NIP tidak kosong, set nilai password dan konfirmasi password sesuai dengan nilai NIP
    if (nipValue !== '') {
        passwordInput.value = nipValue;
        confirmPasswordInput.value = nipValue;
    } else {
        passwordInput.value = '';
        confirmPasswordInput.value = '';
    }
});
</script>
@endsection
