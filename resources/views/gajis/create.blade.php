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
                                <option value="{{ $pegawai->id }}" 
                                        data-jabatan="{{ $pegawai->position->jabatan }}" 
                                        data-gaji_perhari="{{ $pegawai->position->gaji_perhari }}"
                                        data-tunjangan_jabatan="{{ $pegawai->position->tunjangan_jabatan }}"
                                        data-uang_makan="{{ $pegawai->position->uang_makan }}">
                                    {{ $pegawai->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <input type="text" class="form-control" id="jabatan" name="jabatan" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="hadir" class="form-label">Total Hadir</label>
                        <input type="text" class="form-control" id="hadir" name="hadir" value="{{ $absensis?->hadir }}">
                    </div>
                    <div class="mb-3">
                        <label for="gaji_perhari" class="form-label">Gaji Perhari</label>
                        <input type="text" class="form-control" id="gaji_perhari" name="gaji_perhari" readonly>
                    </div>
                    
                    <div class="mb-3">
                        <label for="tunjangan_jabatan" class="form-label">Tunjangan Jabatan</label>
                        <input type="text" class="form-control" id="tunjangan_jabatan" name="tunjangan_jabatan" readonly>
                    </div>
                    
                    <div class="mb-3">
                        <label for="uang_makan" class="form-label">Uang Makan</label>
                        <input type="text" class="form-control" id="uang_makan" name="uang_makan" readonly>
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
                        <input type="text" class="form-control" id="total_gaji" name="total_gaji">
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
        
        var selectedOption = $(this).find('option:selected');
        $('#gaji_perhari').val(selectedOption.data('gaji_perhari'));
        $('#tunjangan_jabatan').val(selectedOption.data('tunjangan_jabatan'));
        $('#uang_makan').val(selectedOption.data('uang_makan'));
        
        var selectedPegawai = selectedOption.val();
        var selectedBulan = $('#bulan').find('option:selected').val();
        var selectedTahun = $('#tahun').find('option:selected').val();

        // Mengirimkan permintaan AJAX
        $.ajax({
            url: "{{ route('get_absensi_data') }}",
            method: 'GET',
            data: {
                tahun: selectedTahun,
                bulan: selectedBulan,
                pegawai: selectedPegawai
            },
            success: function(response) {
                $('#hadir').val(response.hadir); // Mengupdate nilai hadir
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
    
    // Function to update BPJS values based on selected potongan ID
    $('#potongan_id').change(function() {
        var selectedOption = $(this).find('option:selected');
        $('#bpjs_tk').val(selectedOption.data('bpjs_tk'));
        $('#bpjs_kes').val(selectedOption.data('bpjs_kes'));
    });
});
    </script>
@endsection