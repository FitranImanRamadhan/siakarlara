@extends('penggajians.layout')

@section('penggajians.content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                <ol class="breadcrumb m-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('penggajians.index', compact([])) }}"> Penggajians</a></li>
                    <li class="breadcrumb-item">@lang('Edit Penggajian') #{{$penggajian->id}}</li>
                </ol>
            </div>
            <div class="card-body">
                <form action="{{ route('penggajians.update', compact('penggajian')) }}" method="POST" class="m-0 p-0">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
        <label for="absensi_id" class="form-label">Absensi:</label>
        <div class="d-flex flex-row align-items-center justify-content-between">
    <select name="absensi_id" id="absensi_id" class="form-control form-select flex-grow-1" required>
        <option value="">Select Absensi</option>
        @foreach($absensis as $absensi)
            <option value="{{ $absensi->id }}" {{ @old('absensi_id', $penggajian->absensi_id) == $absensi->id ? "selected" : "" }}>{{ $absensi->bulan }}</option>
        @endforeach
    </select>

    <a class="btn btn-light text-nowrap" href="{{route('absensis.create', compact([]))}}"><i class="fa fa-plus-circle"></i> New</a>
</div>
        @if($errors->has('absensi_id'))
			<div class='error small text-danger'>{{$errors->first('absensi_id')}}</div>
		@endif
    </div>
    <div class="mb-3">
        <label for="tahun" class="form-label">Tahun:</label>
        <input type="text" name="tahun" id="tahun" class="form-control" value="{{@old('tahun', $penggajian->tahun)}}" required/>
        @if($errors->has('tahun'))
			<div class='error small text-danger'>{{$errors->first('tahun')}}</div>
		@endif
    </div>
    <div class="mb-3">
        <label for="bulan" class="form-label">Bulan:</label>
        <input type="text" name="bulan" id="bulan" class="form-control" value="{{@old('bulan', $penggajian->bulan)}}" required/>
        @if($errors->has('bulan'))
			<div class='error small text-danger'>{{$errors->first('bulan')}}</div>
		@endif
    </div>
    <div class="mb-3">
        <label for="total_gaji" class="form-label">Total Gaji:</label>
        <input type="number" name="total_gaji" id="total_gaji" class="form-control" value="{{@old('total_gaji', $penggajian->total_gaji)}}" required/>
        @if($errors->has('total_gaji'))
			<div class='error small text-danger'>{{$errors->first('total_gaji')}}</div>
		@endif
    </div>
    <div class="mb-3">
        <label for="gaji_kotor" class="form-label">Gaji Kotor:</label>
        <input type="number" name="gaji_kotor" id="gaji_kotor" class="form-control" value="{{@old('gaji_kotor', $penggajian->gaji_kotor)}}" required/>
        @if($errors->has('gaji_kotor'))
			<div class='error small text-danger'>{{$errors->first('gaji_kotor')}}</div>
		@endif
    </div>
    <div class="mb-3">
        <label for="bpjs_tk" class="form-label">Bpjs Tk:</label>
        <input type="number" name="bpjs_tk" id="bpjs_tk" class="form-control" value="{{@old('bpjs_tk', $penggajian->bpjs_tk)}}" required/>
        @if($errors->has('bpjs_tk'))
			<div class='error small text-danger'>{{$errors->first('bpjs_tk')}}</div>
		@endif
    </div>
    <div class="mb-3">
        <label for="bpjs_kes" class="form-label">Bpjs Kes:</label>
        <input type="number" name="bpjs_kes" id="bpjs_kes" class="form-control" value="{{@old('bpjs_kes', $penggajian->bpjs_kes)}}" required/>
        @if($errors->has('bpjs_kes'))
			<div class='error small text-danger'>{{$errors->first('bpjs_kes')}}</div>
		@endif
    </div>
    <div class="mb-3">
        <label for="gaji_bersih" class="form-label">Gaji Bersih:</label>
        <input type="number" name="gaji_bersih" id="gaji_bersih" class="form-control" value="{{@old('gaji_bersih', $penggajian->gaji_bersih)}}" required/>
        @if($errors->has('gaji_bersih'))
			<div class='error small text-danger'>{{$errors->first('gaji_bersih')}}</div>
		@endif
    </div>
    <div class="mb-3">
        <label for="pembulatan" class="form-label">Pembulatan:</label>
        <input type="number" name="pembulatan" id="pembulatan" class="form-control" value="{{@old('pembulatan', $penggajian->pembulatan)}}" required/>
        @if($errors->has('pembulatan'))
			<div class='error small text-danger'>{{$errors->first('pembulatan')}}</div>
		@endif
    </div>
    <div class="mb-3">
        <label for="gaji_diterima" class="form-label">Gaji Diterima:</label>
        <input type="number" name="gaji_diterima" id="gaji_diterima" class="form-control" value="{{@old('gaji_diterima', $penggajian->gaji_diterima)}}" required/>
        @if($errors->has('gaji_diterima'))
			<div class='error small text-danger'>{{$errors->first('gaji_diterima')}}</div>
		@endif
    </div>

                    </div>
                    <div class="card-footer">
                        <div class="d-flex flex-row align-items-center justify-content-between">
                            <a href="{{ route('penggajians.index', []) }}" class="btn btn-light">Cancel</a>
                            <button type="submit" class="btn btn-primary">@lang('Update Penggajian')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
