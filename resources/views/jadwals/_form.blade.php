
<div class="form-group row">
    <label class="col-md-4 col-xs-4 col-form-label justify-flex-end">Nama <span class="text-danger">*</span></label> 
    <div class="col-12 col-md-5 col-lg-5">
    <select class="form-select select2" name="user_id" id="user_id" required>
    <option value="" disabled selected>Klik untuk memilih Nama</option>
    @foreach ($np as $item)
        <option value="{{ $item->id }}" {{ isset($jadwal) && $jadwal->user_id == $item->id ? 'selected' : '' }}>
            {{ $item->name }}
        </option>
    @endforeach
</select>
    </div>
</div>
<br>
<!-- Bagian input Tanggal Masuk -->
<div class="form-group row">
    <label class="col-md-4 col-xs-4 col-form-label justify-flex-end">Tgl. Masuk <span class="text-danger">*</span></label> 
    <div class="col-12 col-md-5 col-lg-5">
        <input type="date" name="tgl_masuk" class="form-control @error('tgl_masuk') is-invalid @enderror" value="{{ old('tgl_masuk', isset($jadwal) ? $jadwal->tgl_masuk : '') }}" autocomplete="off">
        @error('tgl_masuk')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('tgl_masuk') }}</strong>
            </span>
        @enderror
    </div> 
</div>
<br>
<!-- Bagian input Keterangan Jadwal -->
<div class="form-group row">
    <label class="col-md-4 col-xs-4 col-form-label justify-flex-end">Ket. Jadwal <span class="text-danger">*</span></label> 
    <div class="col-12 col-md-5 col-lg-5">
        <select name="ket_jadwal" class="form-control select2 @error('ket_jadwal') is-invalid @enderror">
            <option value=""></option>
            @foreach ($data['ket_jadwal'] as $item)
                <option value="{{ $item }}" {{ isset($jadwal) && $jadwal->ket_jadwal == $item ? 'selected' : '' }}>{{ $item }}</option>
            @endforeach
        </select>
        @error('ket_jadwal')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div> 
</div>


<div class="card-footer">
    <div class="offset-md-4">
        <div class="form-group mb-0">
            <button type="submit" class="btn btn-primary mr-1"><i class="fas fa-check-double mr-1"></i> Simpan</button> 
            <button type="reset" class="btn btn-secondary"><i class="fas fa-undo mr-1"></i> Reset</button>
        </div>
    </div>
</div>