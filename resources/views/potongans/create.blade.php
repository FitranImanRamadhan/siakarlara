@extends('tmp')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $title }}</div>

                <div class="card-body">
                    <form id="form" action="{{ route('potongans.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row mt-2">
                            <label for="umr_id" class="col-md-4 col-form-label text-md-right">Upah Minimum<span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <select id="umr_id" class="form-control @error('umr_id') is-invalid @enderror" name="umr_id" required onchange="calculateBPJSTK(); calculateBPJSKES()">
                                    <option value="" disabled selected>Klik untuk memilih position</option>
                                    @foreach ($umr as $item)
                                        <option value="{{ $item->id }}" data-kota="{{ $item->kota }}" data-upah="{{ $item->upah_umr }}">{{ $item->kota }} - {{ $item->upah_umr }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label for="atur" class="col-form-label text-md-center">Atur %<span class="text-danger">*</span></label>
                            </div>
                        </div>

                        <div class="form-group row mt-2">
                            <label for="bpjs_tk" class="col-md-4 col-form-label text-md-right">BPJS TK<span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="bpjs_tk" type="number" class="form-control @error('bpjs_tk') is-invalid @enderror" name="bpjs_tk" value="{{ old('bpjs_tk', 4) }}" readonly required>
                                @error('bpjs_tk')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-2">
                                <input id="persentase-bpjsTK" class="form-control" type="number" min="0" max="100" placeholder="TK" value="4" onchange="calculateBPJSTK()">
                            </div>
                        </div>

                        <div class="form-group row mt-2">
                            <label for="bpjs_kes" class="col-md-4 col-form-label text-md-right">BPJS Kesehatan<span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="bpjs_kes" type="number" class="form-control @error('bpjs_kes') is-invalid @enderror" name="bpjs_kes" value="{{ old('bpjs_kes', 1) }}" readonly required>
                                @error('bpjs_kes')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-2">
                                <input id="persentase-bpjsKES" class="form-control" type="number" min="0" max="100" placeholder="KES" value="1" onchange="calculateBPJSKES()">
                            </div>
                        </div>

                        <div class="form-group row mt-2">
                            <label for="alpha" class="col-md-4 col-form-label text-md-right">Alpha<span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="alpha" type="number" class="form-control @error('alpha') is-invalid @enderror" name="alpha" value="{{ old('alpha') }}" required autofocus>
                                @error('alpha')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- Other fields -->

                        <div class="form-group row mt-4">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
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
    function calculateBPJSTK() {
        var umrSelect = document.getElementById('umr_id');
        var selectedOption = umrSelect.options[umrSelect.selectedIndex];
        var upahUMR = parseFloat(selectedOption.getAttribute('data-upah'));
        var persentaseBPJSTK = parseFloat(document.getElementById('persentase-bpjsTK').value);
        var bpjsTK = (persentaseBPJSTK / 100) * upahUMR;

        // Set BPJS TK value to the input field
        document.getElementById('bpjs_tk').value = bpjsTK;
    }

    function calculateBPJSKES() {
        var umrSelect = document.getElementById('umr_id');
        var selectedOption = umrSelect.options[umrSelect.selectedIndex];
        var upahUMR = parseFloat(selectedOption.getAttribute('data-upah'));
        var persentaseBPJSKES = parseFloat(document.getElementById('persentase-bpjsKES').value);
        var bpjsKES = (persentaseBPJSKES / 100) * upahUMR;

        // Set BPJS Kesehatan value to the input field
        document.getElementById('bpjs_kes').value = bpjsKES;
    }
</script>

@endsection
