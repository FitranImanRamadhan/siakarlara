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
                            <label for="nama" class="col-md-4 col-form-label text-md-right">Nama <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" required autofocus>

                                @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                       <div class="form-group row mt-2">
                            <label for="email" class="col-md-4 col-form-label text-md-right">EMAIL<span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>

                                @error('email')
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
                                    Password akan disetel otomatis berdasarkan EMAIL.
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
                            <label for="hak_akses" class="col-md-4 col-form-label text-md-right">Hak_akses<span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <select id="hak_akses" class="form-control @error('hak_akses') is-invalid @enderror" name="hak_akses" required>
                                    <option value="">Select Hak_akses</option>
                                    <option value="Admin">Admin</option>
                                    <option value="User">User</option>
                                </select>

                                @error('hak_akses')
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
document.getElementById('email').addEventListener('input', function() {
    var emailValue = this.value;
    var passwordInput = document.getElementById('password');
    var confirmPasswordInput = document.getElementById('password-confirm');
    
    // Jika nilai EMAIL tidak kosong, set nilai password dan konfirmasi password sesuai dengan nilai EMAIL
    if (emailValue !== '') {
        passwordInput.value = emailValue;
        confirmPasswordInput.value = emailValue;
    } else {
        passwordInput.value = '';
        confirmPasswordInput.value = '';
    }
});
</script>
@endsection
