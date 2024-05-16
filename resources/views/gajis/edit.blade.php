@extends('tmp')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                <ol class="breadcrumb m-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('gajis.index', compact([])) }}"> Gajis</a></li>
                    <li class="breadcrumb-item">@lang('Edit Gaji') #{{$gaji->id}}</li>
                </ol>
            </div>
            <div class="card-body">
                <form action="{{ route('gajis.update', compact('gaji')) }}" method="POST" class="m-0 p-0">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
        <label for="kode" class="form-label">Kode:</label>
        <input type="text" name="kode" id="kode" class="form-control" value="{{@old('kode', $gaji->kode)}}" required/>
        @if($errors->has('kode'))
			<div class='error small text-danger'>{{$errors->first('kode')}}</div>
		@endif
    </div>
    <div class="mb-3">
        <label for="tahun" class="form-label">Tahun:</label>
        <input type="text" name="tahun" id="tahun" class="form-control" value="{{@old('tahun', $gaji->tahun)}}" required/>
        @if($errors->has('tahun'))
			<div class='error small text-danger'>{{$errors->first('tahun')}}</div>
		@endif
    </div>
    <div class="mb-3">
        <label for="bulan" class="form-label">Bulan:</label>
        <input type="text" name="bulan" id="bulan" class="form-control" value="{{@old('bulan', $gaji->bulan)}}" required/>
        @if($errors->has('bulan'))
			<div class='error small text-danger'>{{$errors->first('bulan')}}</div>
		@endif
    </div>
    <div class="mb-3">
        <label for="total_gaji" class="form-label">Total Gaji:</label>
        <input type="number" name="total_gaji" id="total_gaji" class="form-control" value="{{@old('total_gaji', $gaji->total_gaji)}}" required/>
        @if($errors->has('total_gaji'))
			<div class='error small text-danger'>{{$errors->first('total_gaji')}}</div>
		@endif
    </div>
    <div class="mb-3">
        <label for="insentif_absen" class="form-label">Insentif Absen:</label>
        <input type="number" name="insentif_absen" id="insentif_absen" class="form-control" value="{{@old('insentif_absen', $gaji->insentif_absen)}}" required/>
        @if($errors->has('insentif_absen'))
			<div class='error small text-danger'>{{$errors->first('insentif_absen')}}</div>
		@endif
    </div>
    <div class="mb-3">
        <label for="uang_lembur" class="form-label">Uang Lembur:</label>
        <input type="number" name="uang_lembur" id="uang_lembur" class="form-control" value="{{@old('uang_lembur', $gaji->uang_lembur)}}" required/>
        @if($errors->has('uang_lembur'))
			<div class='error small text-danger'>{{$errors->first('uang_lembur')}}</div>
		@endif
    </div>
    <div class="mb-3">
        <label for="gaji_kotor" class="form-label">Gaji Kotor:</label>
        <input type="number" name="gaji_kotor" id="gaji_kotor" class="form-control" value="{{@old('gaji_kotor', $gaji->gaji_kotor)}}" required/>
        @if($errors->has('gaji_kotor'))
			<div class='error small text-danger'>{{$errors->first('gaji_kotor')}}</div>
		@endif
    </div>
    <div class="mb-3">
        <label for="bpjs_tk" class="form-label">Bpjs Tk:</label>
        <input type="number" name="bpjs_tk" id="bpjs_tk" class="form-control" value="{{@old('bpjs_tk', $gaji->bpjs_tk)}}" required/>
        @if($errors->has('bpjs_tk'))
			<div class='error small text-danger'>{{$errors->first('bpjs_tk')}}</div>
		@endif
    </div>
    <div class="mb-3">
        <label for="bpjs_kes" class="form-label">Bpjs Kes:</label>
        <input type="number" name="bpjs_kes" id="bpjs_kes" class="form-control" value="{{@old('bpjs_kes', $gaji->bpjs_kes)}}" required/>
        @if($errors->has('bpjs_kes'))
			<div class='error small text-danger'>{{$errors->first('bpjs_kes')}}</div>
		@endif
    </div>
    <div class="mb-3">
        <label for="gaji_bersih" class="form-label">Gaji Bersih:</label>
        <input type="number" name="gaji_bersih" id="gaji_bersih" class="form-control" value="{{@old('gaji_bersih', $gaji->gaji_bersih)}}" required/>
        @if($errors->has('gaji_bersih'))
			<div class='error small text-danger'>{{$errors->first('gaji_bersih')}}</div>
		@endif
    </div>
    <div class="mb-3">
        <label for="gaji_diterima" class="form-label">Gaji Diterima:</label>
        <input type="number" name="gaji_diterima" id="gaji_diterima" class="form-control" value="{{@old('gaji_diterima', $gaji->gaji_diterima)}}" required/>
        @if($errors->has('gaji_diterima'))
			<div class='error small text-danger'>{{$errors->first('gaji_diterima')}}</div>
		@endif
    </div>

                    </div>
                    <div class="card-footer">
                        <div class="d-flex flex-row align-items-center justify-content-between">
                            <a href="{{ route('gajis.index', []) }}" class="btn btn-light">Cancel</a>
                            <button type="submit" class="btn btn-primary">@lang('Update Gaji')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
