@extends('tmp')
@section('content')
    <title>Gaji Saya</title>
    <style>
        .modal {
            display: none; /* Sembunyikan modal secara default */
            position: fixed; /* Tetapkan posisi ke atas */
            z-index: 1; /* Menempatkan modal di atas konten */
            left: 0;
            top: 0;
            width: 100%; /* Lebar keseluruhan */
            height: 100%; /* Tinggi keseluruhan */
            overflow: auto; /* Aktifkan scroll jika diperlukan */
            background-color: rgb(0,0,0); /* Fallback Warna */
            background-color: rgba(0,0,0,0.4); /* Warna dengan Opacity */
            padding-top: 60px;
        }
        /* Konten modal */
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto; /* Atur jarak atas dan bawah, sesuaikan jika diperlukan */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Sesuaikan lebar konten modal jika diperlukan */
        }
    </style>
</head>
<>

<!-- Tombol untuk membuka modal -->
<button onclick="openModal()">Lihat Gaji Saya</button>

<!-- Modal -->
<div id="myModal" class="modal">
    <!-- Konten modal -->
    <div class="modal-content">
        <span onclick="closeModal()" style="float: right; cursor: pointer;">&times;</span>
        <h2>Detail Gaji Saya</h2>
        
            @csrf
            <div class="row">
                <div class="col-md-3">
                    <label for="bulan" style="font-weight: bold;">Bulan:</label>
                    <select class="form-select" id="bulan" name="bulan">
                        <option value="">Pilih Bulan</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}">{{ date('F', mktime(0, 0, 0, $i, 1)) }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="tahun" style="font-weight: bold;">Tahun:</label>
                    <input class="form-control" id="tahun" name="tahun" value="{{ date('Y') }}">
                </div>
                <div class="col-md-2 align-self-end">
                    <button class="btn btn-primary" type="submit">Generate</button>
                </div>
            </div>
        </form>
        <!-- Tempat untuk menampilkan detail gaji -->
        <div id="gajiDetail"></div>
    </div>
</div>

<!-- JavaScript untuk menangani modal -->
<script>
    // Dapatkan modal
    var modal = document.getElementById("myModal");

    // Dapatkan tombol yang membuka modal
    var btn = document.getElementById("myBtn");

    // Dapatkan elemen <span> yang menutupi modal
    var span = document.getElementsByClassName("close")[0];

    // Saat pengguna mengklik tombol, buka modal
    function openModal() {
        modal.style.display = "block";
    }

    // Saat pengguna mengklik tombol (x), tutup modal
    function closeModal() {
        modal.style.display = "none";
    }

    // Saat pengguna mengklik di luar modal, tutup modal
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
@endsection
