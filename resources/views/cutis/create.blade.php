@extends('adminlayout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Cuti') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('cutis.store') }}">
                        @csrf

                        <div class="form-group row pb-3">
                            <label for="id" class="col-md-4 col-form-label text-md-right">{{ __('ID') }}</label>

                            <div class="col-md-6">
                                <input id="id" type="text" class="form-control @error('id') is-invalid @enderror" name="id" value="{{ old('id') }}" required autocomplete="id" autofocus>

                                @error('id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row pb-3">
                            <label for="nama" class="col-md-4 col-form-label text-md-right">{{ __('Nama') }}</label>

                            <div class="col-md-6">
                                <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" required autocomplete="nama">

                                @error('nama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row pb-3">
                            <label for="tanggal_cuti" class="col-md-4 col-form-label text-md-right">{{ __('Tanggal Cuti') }}</label>

                            <div class="col-md-3">
                                <input id="date_cuti" type="date" class="form-control @error('date_cuti') is-invalid @enderror" name="date_cuti" value="{{ old('date_cuti') }}" required autocomplete="date_cuti">

                                @error('date_cuti')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <input id="end_cuti" type="date" class="form-control @error('end_cuti') is-invalid @enderror" name="end_cuti" value="{{ old('end_cuti') }}" required autocomplete="end_cuti">

                                @error('end_cuti')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row pb-3">
                            <label for="jumlah_cuti" class="col-md-4 col-form-label text-md-right">{{ __('Jumlah Cuti') }}</label>

                            <div class="col-md-6">
                                <input id="jumlah_cuti" type="number" class="form-control @error('jumlah_cuti') is-invalid @enderror" name="jumlah_cuti" value="{{ old('jumlah_cuti') }}" required autocomplete="jumlah_cuti">

                                @error('jumlah_cuti')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row pb-3">
                            <label for="toko" class="col-md-4 col-form-label text-md-right">{{ __('Toko') }}</label>

                            <div class="col-md-6">
                                <input id="toko" type="text" class="form-control @error('toko') is-invalid @enderror" name="toko" value="{{ old('toko') }}" required autocomplete="toko">

                                @error('toko')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row pb-3">
                            <label for="jabatan" class="col-md-4 col-form-label text-md-right">{{ __('Jabatan') }}</label>

                            <div class="col-md-6">
                                <input id="jabatan" type="text" class="form-control @error('jabatan') is-invalid @enderror" name="jabatan" value="{{ old('jabatan') }}" required autocomplete="jabatan">

                                @error('jabatan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row pb-3">
                            <label for="jenis_cuti" class="col-md-4 col-form-label text-md-right">{{ __('Jenis Cuti') }}</label>
                        
                            <div class="col-md-6">
                                <select id="jenis_cuti" class="form-control @error('jenis_cuti') is-invalid @enderror" name="jenis_cuti" required autocomplete="jenis_cuti">
                                    <option value="">-- Pilih Jenis Cuti --</option>
                                    <option value="CUTI TAHUNAN" {{ old('jenis_cuti') == 'CUTI TAHUNAN' ? 'selected' : '' }}>CUTI TAHUNAN</option>
                                    <option value="CUTI MENIKAH" {{ old('jenis_cuti') == 'CUTI MENIKAH' ? 'selected' : '' }}>CUTI MENIKAH</option>
                                    <option value="CUTI MELAHIRKAN" {{ old('jenis_cuti') == 'CUTI MELAHIRKAN' ? 'selected' : '' }}>CUTI MELAHIRKAN</option>
                                </select>
                        
                                @error('jenis_cuti')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        

                        <div class="form-group row pb-3">
                            <label for="alasan_cuti" class="col-md-4 col-form-label text-md-right">{{ __('Alasan Cuti') }}</label>

                            <div class="col-md-6">
                                <textarea id="alasan_cuti" class="form-control @error('alasan_cuti') is-invalid @enderror" name="alasan_cuti" required autocomplete="alasan_cuti">{{ old('alasan_cuti') }}</textarea>

                                @error('alasan_cuti')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row pb-3">
                            <label for="ambil_tugas" class="col-md-4 col-form-label text-md-right">{{ __('Ambil Tugas') }}</label>

                            <div class="col-md-6">
                                <input id="ambil_tugas" type="text" class="form-control @error('ambil_tugas') is-invalid @enderror" name="ambil_tugas" value="{{ old('ambil_tugas') }}" required autocomplete="ambil_tugas">

                                @error('ambil_tugas')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- <div class="form-group row pb-3">
                            <label for="filename" class="col-md-4 col-form-label text-md-right">{{ __('Filename') }}</label>

                            <div class="col-md-6">
                                <input id="filename" type="text" class="form-control @error('filename') is-invalid @enderror" name="filename" value="{{ old('filename') }}" required autocomplete="filename">

                                @error('filename')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row pb-3">
                            <label for="image_data" class="col-md-4 col-form-label text-md-right">{{ __('Image Data') }}</label>

                            <div class="col-md-6">
                                <input id="image_data" type="text" class="form-control @error('image_data') is-invalid @enderror" name="image_data" value="{{ old('image_data') }}" required autocomplete="image_data">

                                @error('image_data')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div> --}}

                        <div class="form-group row pb-3">
                            <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>
                        
                            <div class="col-md-6">
                                <select id="status" class="form-control @error('status') is-invalid @enderror" name="status" required autocomplete="status">
                                    <option value="">-- Pilih Status --</option>
                                    <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="Sudah Acc" {{ old('status') == 'Sudah Acc' ? 'selected' : '' }}>Sudah Acc</option>
                                    <option value="Tidak Acc" {{ old('status') == 'Tidak Acc' ? 'selected' : '' }}>Tidak Acc</option>
                                </select>
                        
                                @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row pb-3">
                            <label for="kode" class="col-md-4 col-form-label text-md-right">{{ __('Kode') }}</label>

                            <div class="col-md-6">
                                <input id="kode" type="text" class="form-control @error('kode') is-invalid @enderror" name="kode" value="{{ old('kode') }}" required autocomplete="kode">

                                @error('kode')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                                <a href="{{ route('cutis.index') }}" class="btn btn-secondary">
                                    {{ __('Cancel') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
