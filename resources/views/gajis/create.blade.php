@extends('tmp')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Create New Gaji</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('gajis.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="tanggal_gajian" class="form-label">Tanggal Gajian</label>
                        <input type="date" class="form-control" id="tanggal_gajian" name="tanggal_gajian">
                    </div>
                    <div class="mb-3">
                    
                    <div class="mb-3">
                        <label for="tahun" class="form-label">Tahun</label>
                        <select class="form-select" id="tahun" name="tahun">
                            <option selected disabled>Select Tahun</option>
                            @for ($i = date('Y'); $i >= 2010; $i--)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="bulan" class="form-label">Bulan</label>
                        <select class="form-select" id="bulan" name="bulan">
                            <option selected disabled>Select Bulan</option>
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}">{{ date('F', mktime(0, 0, 0, $i, 1)) }}</option>
                            @endfor
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="pegawai_id" class="form-label">Nama Pegawai</label>
                        <select class="form-select" id="pegawai_id" name="pegawai_id">
                            <option selected disabled>Select Nama Pegawai</option>
                            @foreach($pegawais as $pegawai)
                                <option value="{{ $pegawai->id }}" data-jabatan="{{ $pegawai->position->jabatan }}">{{ $pegawai->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <input type="text" class="form-control" id="jabatan" name="jabatan">
                    </div>
                    <div class="mb-3">
                        <label for="potongan_id" class="form-label">Kota</label>
                        <select class="form-select" id="potongan_id" name="potongan_id">
                            <option selected disabled>Select Potongan</option>
                            @foreach($potongans as $potongan)
                                <option value="{{ $potongan->id }}" data-bpjs_tk="{{ $potongan->bpjs_tk }}" data-bpjs_kes="{{ $potongan->bpjs_kes }}">{{ $potongan->umr->kota }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="bpjs_tk" class="form-label">BPJS TK</label>
                        <input type="text" class="form-control" id="bpjs_tk" name="bpjs_tk">
                    </div>
                    <div class="mb-3">
                        <label for="bpjs_kes" class="form-label">BPJS Kesehatan</label>
                        <input type="text" class="form-control" id="bpjs_kes" name="bpjs_kes">
                    </div>
                    <div class="mb-3">
                        <label for="total_gaji" class="form-label">Total Gaji</label>
                        <input type="text" class="form-control" id="total_gaji" name="total_gaji" value="{{ $absensis?->hadir }}">
                    </div>
                    <div class="mb-3">
                        <label for="gaji_kotor" class="form-label">Gaji Kotor</label>
                        <input type="text" class="form-control" id="gaji_kotor" name="gaji_kotor">
                    </div>
                    <div class="mb-3">
                        <label for="gaji_bersih" class="form-label">Gaji Bersih</label>
                        <input type="text" class="form-control" id="gaji_bersih" name="gaji_bersih">
                    </div>
                    <div class="mb-3">
                        <label for="pembulatan" class="form-label">Pembulatan</label>
                        <input type="text" class="form-control" id="pembulatan" name="pembulatan">
                    </div>
                    <div class="mb-3">
                        <label for="gaji_diterima" class="form-label">Gaji Diterima</label>
                        <input type="text" class="form-control" id="gaji_diterima" name="gaji_diterima">
                    </div>
                    <div class="mb-3">
                        <label for="remember_token" class="form-label">Remember Token</label>
                        <input type="text" class="form-control" id="remember_token" name="remember_token">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>    
         $(document).ready(function() {
        $('#pegawai_id').change(function() {
            var selectedJabatan = $(this).find('option:selected').data('jabatan');
            $('#jabatan').val(selectedJabatan);
            var selectedPegawai = $(this).find('option:selected').val();
            var selectedBulan = $('#bulan').find('option:selected').val();
            var selectedTahun = $('#tahun').find('option:selected').val();
            window.location.href = "{{route('gajis.create')}}?tahun="+selectedTahun+"&bulan="+selectedBulan+"&pegawai="+selectedPegawai;
        });
    });
        // Function to update BPJS values based on selected potongan ID
        document.getElementById('potongan_id').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            document.getElementById('bpjs_tk').value = selectedOption.getAttribute('data-bpjs_tk');
            document.getElementById('bpjs_kes').value = selectedOption.getAttribute('data-bpjs_kes');
        });
    </script>
@endsection
