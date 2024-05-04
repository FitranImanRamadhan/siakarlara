@extends('tmp')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Cetak Slip Gaji</div>

                <div class="card-body">
                    <form action="{{ route('cetak.slip.gaji.pdf') }}" method="GET">
                        @csrf
                        <div class="form-group">
                            <label for="bulan">Bulan:</label>
                            <select class="form-select" id="bulan" name="bulan">
                                <option value="">Pilih Bulan</option>
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}">{{ date('F', mktime(0, 0, 0, $i, 1)) }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tahun">Tahun:</label>
                            <select class="form-select" id="tahun" name="tahun">
                                <option value="">Pilih Tahun</option>
                                @for ($year = 2022; $year <= 2025; $year++)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
                            </select>
                        </div>
                        <br>
                        <div class="text-center"> <!-- Tambahkan class text-center di sini -->
                            <button type="submit" class="btn btn-primary btn-block" >Cetak Slip Gaji</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
