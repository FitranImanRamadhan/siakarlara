@extends('tmp')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $title }}</div>

                    <div class="card-body">
                        <form action="{{ route('pegawais.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="nama" class="col-md-4 col-form-label text-md-right">Nama<span
                                        class="text-danger">*</span></label>

                                <div class="col-md-6">
                                    <input id="nama" type="text"
                                        class="form-control @error('nama') is-invalid @enderror" name="nama"
                                        value="{{ old('nama') }}" required autofocus>

                                    @error('nama')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mt-2">
                                <label for="position_id" class="col-md-4 col-form-label text-md-right">Posisi<span
                                        class="text-danger">*</span></label>

                                <div class="col-md-6">
                                    <select id="position_id" class="form-control @error('position_id') is-invalid @enderror"
                                        name="position_id" required>
                                        <option value="" disabled selected>Pilih Posisi</option>
                                        @foreach ($pst as $item)
                                            <option value="{{ $item->id }}">{{ $item->jabatan }}</option>
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
                                <label for="jenis_kelamin" class="col-md-4 col-form-label text-md-right">Jenis Kelamin<span
                                        class="text-danger">*</span></label>

                                <div class="col-md-6">
                                    <select id="jenis_kelamin"
                                        class="form-control @error('jenis_kelamin') is-invalid @enderror"
                                        name="jenis_kelamin" required>
                                        <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>

                                    @error('jenis_kelamin')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mt-2">
                                <label for="tanggal_bergabung" class="col-md-4 col-form-label text-md-right">Tanggal
                                    Bergabung<span class="text-danger">*</span></label>

                                <div class="col-md-6">
                                    <input id="tanggal_bergabung" type="date"
                                        class="form-control @error('tanggal_bergabung') is-invalid @enderror"
                                        name="tanggal_bergabung" value="{{ old('tanggal_bergabung') }}" required>

                                    @error('tanggal_bergabung')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mt-4">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="buat_user" id="buat_user">
                                        <label class="form-check-label" for="buat_user">
                                            Buat user login
                                        </label>
                                    </div>
                                </div>
                            </div>


                            <div id="buat_user_fields" style="display: none;">
                                <div class="form-group row mt-2">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">Email<span
                                            class="text-danger">*</span></label>

                                    <p>Default Email disetel menggunakan nama depan <span class="text-danger">*</span></p>
                                    <div class="col-md-6">
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mt-2">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Password<span
                                            class="text-danger">*</span></label>
                                    <p>Default Password disetel menggunakan nama depan diikuti dengan angka 12345 <span
                                            class="text-danger">*</span></p>
                                    <div class="col-md-6">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mt-4">
                                    <label for="hak_akses" class="col-md-4 col-form-label text-md-right">Hak Akses<span
                                            class="text-danger">*</span></label>

                                    <div class="col-md-6">
                                        <div class="form-check form-check">
                                            <input class="form-check-input @error('hak_akses') is-invalid @enderror"
                                                type="radio" name="hak_akses" id="admin" value="Admin">
                                            <label class="form-check-label" for="admin">Admin</label>
                                        </div>

                                        <div class="form-check form-check">
                                            <input class="form-check-input @error('hak_akses') is-invalid @enderror"
                                                type="radio" name="hak_akses" id="user" value="User">
                                            <label class="form-check-label" for="user">User</label>
                                        </div>

                                        @error('hak_akses')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
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


    <!-- Skrip JavaScript untuk mengisi email dan password secara otomatis -->
    <script>
        document.getElementById('buat_user').addEventListener('change', function() {
            var buatUserFields = document.getElementById('buat_user_fields');
            var emailInput = document.getElementById('email');
            var passwordInput = document.getElementById('password');

            if (this.checked) {
                buatUserFields.style.display = 'block';
                // Panggil fungsi untuk mengisi email dan password
                isiEmailPassword(emailInput, passwordInput);
            } else {
                buatUserFields.style.display = 'none';
                // Reset nilai email dan password
                emailInput.value = '';
                passwordInput.value = '';
            }
        });

        document.getElementById('nama').addEventListener('input', function() {
            var emailInput = document.getElementById('email');
            var passwordInput = document.getElementById('password');
            // Panggil fungsi untuk mengisi email dan password saat input nama berubah
            isiEmailPassword(emailInput, passwordInput);
        });

        function isiEmailPassword(emailInput, passwordInput) {
            var nama = document.getElementById('nama').value;

            // Ambil hanya nama depan
            var namaDepan = nama.split(' ')[0];

            // Membuat email dari nama depan
            var email = namaDepan.toLowerCase() + '@gmail.com';
            // Membuat password dari nama depan diikuti dengan angka 12345
            var password = namaDepan.toLowerCase() + '12345';

            // Mengatur nilai email dan password
            emailInput.value = email;
            passwordInput.value = password;
        }
    </script>
@endsection