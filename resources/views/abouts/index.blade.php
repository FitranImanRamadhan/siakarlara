@extends('layout')
@section('content')
<div class="container-fluid page-header mb-0 p-0"  style="background-image: url('{{ asset('assets/img/carousel-bg-1.jpg') }}');">
    <div class="container-fluid page-header-inner py-5">
        <div class="container text-center">
            <h1 class="display-3 text-white mb-3 animated slideInDown"><i class="bi bi-person-lines-fill px-4"></i>About Us</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center text-uppercase">

                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Page Header End -->

<div class="container-fluid py-4 position-relative wow fadeIn" data-wow-delay="0.1s">
    <div class="container">
        <div class="card bg-light" style="border-radius: 10px;">
            <div class="card-body">
                <!-- Default Tabs -->
                <ul class="nav nav-tabs d-flex" id="myTabjustified" role="tablist">
                    <li class="nav-item flex-fill" role="presentation">
                        <button style="border-radius: 7px;" class="nav-link w-100 active" id="sejarah-tab" data-bs-toggle="tab" data-bs-target="#sejarah-justified" type="button" role="tab" aria-controls="sejarah" aria-selected="true">Sejarah</button>
                    </li>
                    <li class="nav-item flex-fill" role="presentation">
                        <button style="border-radius: 7px;" class="nav-link w-100" id="visiMisi-tab" data-bs-toggle="tab" data-bs-target="#visiMisi-justified" type="button" role="tab" aria-controls="visiMisi" aria-selected="false">Visi & Misi</button>
                    </li>
                    <li class="nav-item flex-fill" role="presentation">
                        <button style="border-radius: 7px;" class="nav-link w-100" id="organ-tab" data-bs-toggle="tab" data-bs-target="#organ-justified" type="button" role="tab" aria-controls="organ" aria-selected="false">Struktur Organisasi</button>
                    </li>
                    <li class="nav-item flex-fill" role="presentation">
                        <button style="border-radius: 7px;" class="nav-link w-100" id="outlet-tab" data-bs-toggle="tab" data-bs-target="#outlet-justified" type="button" role="tab" aria-controls="outlet" aria-selected="false">Outlet</button>
                    </li>
                </ul>
                <div class="tab-content pt-4" id="myTabjustifiedContent">
                    <div class="tab-pane px-3 fade show active" id="sejarah-justified" role="tabpanel" aria-labelledby="sejarah-tab">
                        <img src="{{ asset('assets/img/LOGO TASCO.png') }}" style="width: 17%; height: 17%;">
                        <h4  class="text px-3">PT. TASCO SEJAHTERA ABADI</h4><br>
                        <p class="text-center">Bisnis ritel, dalam hal ini pusat perbelanjaan terus berkembang di kota-kota besar di Indonesia termasuk di kota 
                        Tasikmalaya. Hal tersebut juga mendorong terus muncul dan berkembangnya pusat-pusat perbelanjaan di kota ini. 
                        “Tasco Minimart” merupakan perusahaan retail Lokal Tasikmalaya. Tasco hadir menjadi bagian dalam bisnis minimarket 
                        dengan tujuan memenuhi kebutuhan sehari-hari konsumen dan memberikan manfaat untuk masyarakat sekitar.<br><br>
                        Tasco memiliki harapan agar mampu memberikan stimulus terhadap pengusaha-pengusaha lokal, untuk semangat bersaing 
                        dan mampu menjadi tuan rumah dikotanya sendiri, untuk itu Tasco hadir sebagai Minimarket Lokal yang membantu warga 
                        Tasikmalaya memenuhi segala kebutuhan sehari-hari dengan memberikan pelayanan terbaik untuk memenuhi harapan dan 
                        kebutuhan pelanggan. Selain itu “Tasco” juga bekerja sama dengan UMKM local Tasikmalaya sebagai ajang promosi agar 
                        produknya dapat lebih dikenal serta meningkatkan value penjualan UMKM tersebut.<br><br>
                        CV Tasik Company Sejahtera Abadi didirikan pada tanggal 20 Februari 2012 oleh Bapak H. Cicip Gurcipta. 
                        Setelah perjalanan bisnis selama 8 tahun, CV Tasik Company Sejahtera Abadi mulai mendirikan Supermarket 
                        local Tasikmalaya yang diberinama “Tasmart” yang mulai beropersi pada bulan Juli 2020. <br><br>Seiring berjalannya 
                        waktu, CV Tasik Company Sejahtera Abadi tumbuh dan berkembang, hingga Tahun 2022 kami merubah Status 
                        Perusahaan dari CV (Commanditaire Vennootschap) menjadi PT (Perseroan Terbatas). Perubahan tersebut disah kan 
                        oleh Menteri Hukum dan Hak Asasi Manusia pada tanggal “24 Mei 2022” tentang pengesahan pendirian badan 
                        hukum Perseroan Terbatas “PT Tasco Sejahtera Abadi” dengan Nomor Putusan “AHU-0033750.AH.01.01.Tahun2022”.
                        Pada saat ini tanggal 23 Agustus 2022 “PT Tasco Sejahtera Abadi” mempunyai 331 karyawan aktif dengan berbagai 
                        divisi dan jabatan.<br><br> ***
                        </p>               
                    </div>
                    <div class="tab-pane px-3 fade" id="visiMisi-justified" role="tabpanel" aria-labelledby="visiMisi-tab">
                        <img src="{{ asset('assets/img/LOGO TASCO.png') }}" style="width: 17%; height: 17%;">
                        <h4 class="text px-3">PT. TASCO SEJAHTERA ABADI</h4><br>
                        <h5 class="text-center" style="font-family: Lucida Bright;">// VISI //</h5>
                        <p class="text-center"> "Menjadi Perusahaan Retail Terbaik di Priangan Timur dengan kualitas pelayanan standar Internasional dan 
                            Harga yang kompetitif."<br><br>
                        </p><hr>
                        <h5 class="text-center" style="font-family: Lucida Bright;">// MISI //</h5>
                        <p class="text-center"> "Menyediakan kebutuhan sehari-hari bagi konsumen (Consumer Goods) melalui pelanyanan offline maupun 
                            online."<br><br>
                        </p><hr>
                        <h5 class="text-center" style="font-family: Lucida Bright;">// STRATEGIC //</h5>
                        <p class="text-center"> "Menyediakan Toko di lokasi yang strategis dan mudah diakses dengan fasilitas dan system layanan 
                            berbasis kearifan local serta tetap mengedepankan pelayanan yang ramah sehingga dapat menghadirkan 
                            rasa senang dan nyaman ketika berbelanja, agar menjadi sahabat konsumen dalam memenuhi kebutuhan 
                            sehari-hari."<br><br> ***
                        </p>
                        </div>
                    <div class="tab-pane px-3 fade" id="organ-justified" role="tabpanel" aria-labelledby="organ-tab">
                        <img src="{{ asset('assets/img/LOGO TASCO.png') }}" style="width: 17%; height: 17%;">
                        <h4 class="text px-3">PT. TASCO SEJAHTERA ABADI</h4>
                        <img src="{{ asset('assets/img/s_o.png') }}" style="width: 100%; height: 100%;">
                    </div>
                    <div class="tab-pane px-3 fade" id="outlet-justified" role="tabpanel" aria-labelledby="outlet-tab">
                        <img src="{{ asset('assets/img/LOGO TASCO.png') }}" style="width: 17%; height: 17%;">
                        <h4 class="text px-3">PT. TASCO SEJAHTERA ABADI</h4><br><br>
                        <div class="col-12">

                            <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Daftar Outlet Tasco</h5>
                
                                <!-- Table with stripped rows -->
                                <table class="table table-striped">
                                <thead>
                                    <tr>
                                    <th scope="col">Tahun Berdiri</th>
                                    <th scope="col">Nama Outlet</th>
                                    <th scope="col">Alamat Outlet</th>
                                    <th scope="col">Grand Opening</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    <th scope="row">2012</th>
                                    <td>Tasco Cisalak</td>
                                    <td>JL. Raya Nusa Indah 4 No 81 RT 005 RW 014  Nagarasari- Cipedes</td>
                                    <td>26 Februari 2012</td>
                                    </tr>
                                    <tr>
                                    <th scope="row">2013</th>
                                    <td>Tasco Cikalang</td>
                                    <td>Jl. Siliwangi No41 Rt.003/006 Kel. Cikalang Kec. Tawang Kota Tasikmalaya</td>
                                    <td>29 Maret 2013</td>
                                    </tr>
                                    <tr>
                                    <th scope="row">2014</th>
                                    <td>Tasco Padasuka</td>
                                    <td>Jl. Padasuka No. 58 RT 002/004 Kel. Lengkongsari Kec. Tawang Kota Tasikmalaya</td>
                                    <td>14 Januari 2014</td>
                                    </tr>
                                    <tr>
                                    <th scope="row">2015</th>
                                    <td>Tasco Bebedahan</td>
                                    <td>JL. Bebedahan No. 20 RT.006/007 Kel. Lengkongsari Kec. Tawang Kota Tasikmalaya</td>
                                    <td>26 Desember 2015</td>
                                    </tr>
                                    <tr>
                                    <th scope="row">2016</th>
                                    <td>Tasco Indihiang</td>
                                    <td>JL. Ibrahim Adjie No 21 RT. 006/007 Kel. Indihiang Kec. Indihiang Kota Tasikmalaya</td>
                                    <td>10 Juni 2016</td>
                                    </tr>
                                    <tr>
                                    <th scope="row">2017</th>
                                    <td>Tasco Kalangsari</td>
                                    <td>Jl. Dr. Moch. Hatta No.139 RT 004/RW 001 Kel. Sukamanah Kec. Cipedes Kota Tasikmalaya</td>
                                    <td>06 Mei 2017</td>
                                    </tr>
                                    <tr>
                                    <th scope="row">2017</th>
                                    <td>Tasco BRP</td>
                                    <td>JL. Dinding Ari Raya No.12 Bumi Resik Panglayungan RT.002/RW018 Kel. Panglayungan Kec. Cipedes Kota Tasikmalaya</td>
                                    <td>13 Agustus 2017</td>
                                    </tr>
                                    <tr>
                                    <th scope="row">2017</th>
                                    <td>Tasco Siliwangi</td>
                                    <td>Jl. Siliwangi no.67 RT.003/009 Kel. Kahuripan Kec. Tawang Kota Tasikmalaya</td>
                                    <td>01 Oktober 2017</td>
                                    </tr>
                                    <tr>
                                    <th scope="row">2018</th>
                                    <td>Tasco Paseh</td>
                                    <td>Jl. Paseh No.321 RT.006 RW. 003 Kel. Tuguraja Kec. Cihideung Kota Tasikmalaya</td>
                                    <td>17 Agustus 2018</td>
                                    </tr>
                                    <tr>
                                    <th scope="row">2018</th>
                                    <td>Tasco Kawalu</td>
                                    <td>Jl. Perintis Kemerdekaan Kp. Pangkalan 1 No 206 RT.002 RW.012 Kel. Karsamenak Kec. Kawalu Kota Tasikmalaya</td>
                                    <td>29 Desember 2018</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2019</th>
                                        <td>Tasco Tamansari</td>
                                        <td>Jl. Tamansari Blok Babakan Muncang, RT/ 02 RW/ 01Kel. Kersamenak, Kec. Kawalu</td>
                                        <td>30 Juni 2019</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2019</th>
                                        <td>Tasco Sambong</td>
                                        <td>Jl. Sambongjaya RT/01 RW/013 Kel. Sambongjaya Kec. Mangkubumi Kota Tasikmalaya</td>
                                        <td>07 September 2019</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2019</th>
                                        <td>Tasco Cinehel</td>
                                        <td>Jl. Cinehel no 45. Rt 01, Rw 06, Kel. Nagarasari Kec, Cipedes Kota Tasikmalaya</td>
                                        <td>03 November 2019</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2020</th>
                                        <td>Tasco Gobras</td>
                                        <td>Jl. Tamansari, blok III.A.1 Rt/Rw 03/04 Kel. Sukahurip, Kec. Tamansari Kota Tasikmalaya</td>
                                        <td>22 januari 2020</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2020</th>
                                        <td>Tasco Cilembang</td>
                                        <td>Jl. Letkol Re Djaelani, No 3, RT/RW 02/14 Kel. Cilembang, Kec. Cihideung. Kota Tasikmalaya</td>
                                        <td>05 maret 2020</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2020</th>
                                        <td>Tasco Cilendek</td>
                                        <td>Jl. Cilendek, Kp. Pabrik Rt/Rw 003/002, Kel. Kotabaru Kec. Cibeureum Kota Tasikmalaya</td>
                                        <td>09 April 2020</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2020</th>
                                        <td>Tasmart Manonjaya</td>
                                        <td>Jl. Manonjaya Blok Kaum Kidul, Rt 01, Rw 01, Desa Manonjaya, Kec, Manojaya, Kab, Tasikmalaya</td>
                                        <td>21 Juli 2020</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2021</th>
                                        <td>Tasmart Ciawi</td>
                                        <td>Jl. Raya Utara Ciawi, Kp. Panulisan Rt 002 RW 001, Kel.. Kurniabakti, Kec. Ciawi, Kab, Tasikmalaya</td>
                                        <td>31 Januari 2021</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2021</th>
                                        <td>Tasco Purbaratu</td>
                                        <td>Jl. Purbaratu, RT 03 /RW 01 Blok Cihajikaler, Kel. Sukanagara. Kec. Purbaratu, Kota Tasikmalaya</td>
                                        <td>07 maret 2021</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2021</th>
                                        <td>Tasco Gegernoong</td>
                                        <td>Jl. Tamansari, Rt 03, Rw 01 Blok Sayuran, Kel. Tamanjaya, Kec, Tamansari, Kota Tasikmalaya</td>
                                        <td>25 April 2021</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2022</th>
                                        <td>Tasco Jiwa Besar</td>
                                        <td>Jl. Paseh Tuguraja, No.74 Belokan Jiwa Besar, Kel. Tuguraja Kec. Cihideung, Kota Tasikmalaya</td>
                                        <td>20 Februari 2022</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2022</th>
                                        <td>Tasco Mangkubumi</td>
                                        <td>Jl. AH. Nasution, Blok Gunung Karet, Kel. Mangkubumi, Kec. Mangkubumi, Kota Tasikmalaya</td>
                                        <td>27 Maret 2022</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2022</th>
                                        <td>Tasco Gunung Kalong</td>
                                        <td>Jl. Perum Kota Baru, Blok Gunung Kalong, Kel. Kersanagara, Kec. Cibeureum, Kota Tasikmalaya</td>
                                        <td>22 Mei 2022</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2022</th>
                                        <td>Tasco Aisyah</td>
                                        <td>Jl. Ir. Juanda NO. 39, Kelurahan Bantarsari, Kecamatan Bungursari, Kota Tasikmalaya</td>
                                        <td>06 Agustus 2022</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2022</th>
                                        <td>Tasco garuda</td>
                                        <td>Jl. Garuda No. 18 RT. 01 RW.01 kel. Sukanagara Kec. Purbaratu Kota Tasikmalaya</td>
                                        <td>24 Desember 2022</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2022</th>
                                        <td>Tasco BKR</td>
                                        <td>Jl. BKR Marga Laksana No. 38 RT. 02 RW.06 Kel.Kahuripan Kec. Tawang Kota Tasikmalaya</td>
                                        <td>26 Desember 2022</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2023</th>
                                        <td>Tasco Ahmad Yani</td>
                                        <td>Jl. Ahmad yani Kel. Sukamanah Kec. Cipedes Kota Tasikmalaya</td>
                                        <td>28 Januari 2023</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2023</th>
                                        <td>Tasco Ibrahim Adjie</td>
                                        <td>Jl, Ibrahim Adjie Blok Sukaresmi RT 20 RW. 01 Kel. Indihiang, Kec. Indihiang Kota Tasikmalaya</td>
                                        <td>04 Februari 2023</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2023</th>
                                        <td>Tasco Cigeureung</td>
                                        <td>Jl. Cigeureung RT. 05 RW. 09 kel. Nagarasari Kec. Cipedes Kota Tasikmalaya</td>
                                        <td>11 Maret 2023</td>
                                    </tr>
                                </tbody>
                                </table>
                                <!-- End Table with stripped rows -->
                            </div>
                            </div>              
                        </div>
                    </div>
                </div>
                <!-- End Default Tabs -->
            </div>
        </div>
    </div>
</div>
@endsection