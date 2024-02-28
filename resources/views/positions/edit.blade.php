@extends('tmp')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $title }}</div>

                <div class="card-body">
                    <form action="{{ route('positions.update', $position->id) }}" method="POST" enctype="multipart/form-data" id="updateForm">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="jabatan" class="col-md-4 col-form-label text-md-right">Jabatan<span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="jabatan" type="text" class="form-control @error('jabatan') is-invalid @enderror" name="jabatan" value="{{ $position->jabatan }}" required autofocus>

                                @error('jabatan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mt-2">
                            <label for="gapok" class="col-md-4 col-form-label text-md-right">Gaji Pokok<span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="gapok" type="text" class="form-control @error('gapok') is-invalid @enderror" name="gapok" value="{{ $position->gapok }}" required>

                                @error('gapok')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mt-4">
                            <div class="col-md-6 offset-md-4">
                                <!-- Tambahkan id pada tombol "Update" -->
                                <button type="submit" id="updateButton" class="btn btn-primary">
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

<!-- Sertakan SweetAlert script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Tangkap event klik pada tombol "Update"
    document.getElementById('updateButton').addEventListener('click', function(event) {
        event.preventDefault(); // Menghentikan aksi default (pengiriman form)

        // Tampilkan SweetAlert
        Swal.fire({
            title: 'Are you sure?',
                text: "You are about to update this positions information!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update it!'
        }).then((result) => {
            // Jika pengguna menekan tombol 'OK', lanjutkan pengiriman form
            if (result.isConfirmed) {
                document.getElementById('updateForm').submit();
            }
        });
    });
</script>
@endsection
