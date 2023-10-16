@extends('tmp')
@section('content')

<form action="{{ route('raks.update', $rak->no_inventaris) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>No Inventaris</strong>
                <input type="text" name="no_inventaris" class="form-control" placeholder="No Inventaris" value="{{ $rak->no_inventaris }}">
                @error('no_inventaris')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nama Rak:</strong>
                <input type="text" name="nama_rak" class="form-control" placeholder="Nama Rak" value="{{ $rak->nama_rak }}">
                @error('nama_rak')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Kapasitas:</strong>
                <input type="number" name="kapasitas" class="form-control" placeholder="Kg" value="{{ $rak->kapasitas }}">
                @error('kapasitas')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row col-xs-12 col-sm-12 col-md-12 mt-3">
            <div class="col-md-10 form-group">
                <input type="text" name="search" id="search" class="form-control" placeholder="Masukkan Nama Barang">
                @error('name')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-2 form-group text-center">
                <button class="btn btn-success" type="button" name="btnAdd" id="btnAdd"><i class="fa fa-plus"></i>Tambah</button>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
            <table id="example" class="table table-striped table-success" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">NO</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Stok</th>
                        <th scope="col">Sub Total</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="detail">
                    <?php $no = 0; ?>
                    @foreach($detail as $item)
                    <?php $no++ ?>
                    <tr>
                        <td>
                            <input type="hidden" name="productId{{$no}}" class="form-control" value="{{$item->id_barang}}">
                            <span>{{$no}}</span>
                        </td>
                        <td>
                            <input type="text" name="namaBarang{{$no}}" class="form-control" value="{{$item->getBarang->nama_barang}}">
                        </td>
                        <td>
                            <input type="number" name="stok{{$no}}" class="form-control" oninput="sumStok('{{$no}}',this.value)" value="{{$item->stok}}">
                        </td>
                        <td>
                            <input type="number" name="sub_total{{$no}}" class="form-control" value="{{$item->sub_total}}">
                        </td>
                        <td>
                            <a href="#" class="btn btn-sm btn-danger">X</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <input type="hidden" name="jml" class="form-control" value="{{count($detail)}}">
                <div class="form-group">
                    <strong>Grand Total:</strong>
                    <input type="text" name="total" class="form-control" value="{{$rak->total}}">
                    @error('tanggal')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3 ml-3">Submit</button>
    </div>
</form>
@endsection
@section('js')
<script type="text/javascript">
    var path = "{{ route('search.barang') }}";

    $("#search").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: path,
                type: 'GET',
                dataType: "json",
                data: {
                    search: request.term
                },
                success: function(data) {
                    response(data);
                }
            });
        },
        select: function(event, ui) {
            $('#search').val(ui.item.label);
            console.log($("input[name=jml]").val());
            if ($("input[name=jml]").val() > 0) {
                for (let i = 1; i <= $("input[name=jml]").val(); i++) {
                    id = $("input[name=id_barang" + i + "]").val();
                    if (id == ui.item.id) {
                        alert(ui.item.value + ' sudah ada!');
                        break;
                    } else {
                        add(ui.item.id);
                    }
                }
            } else {
                add(ui.item.id);
            }
            return false;
        }
    });

    function add(id) {
        const path = "{{ route('barangs.index') }}/" + id;
        var html = "";
        var no = 0;
        if ($('#detail tr').length > no) {
            html = $('#detail').html();
            no = no + $('#detail tr').length;
        }
        $.ajax({
            url: path,
            type: 'GET',
            dataType: "json",
            success: function(data) {
                console.log(data);
                no++;
                html += '<tr>' +
                    '<td>' + no + '<input type="hidden" name="id_barang' + no + '" class="form-control" value="' + data.id + '"></td>' +
                    '<td><input type="text" name="nama_barang' + no + '" class="form-control" value="' + data.nama_barang + '"></td>' +
                    '<td><input type="text" name="stok' + no + '" class="form-control" oninput="sumStok(' + no + ', this.value)" value="1"></td>' +
                    '<td><input type="text" name="sub_total' + no + '" class="form-control"></td>' +
                    '<td><a href="#" class="btn btn-sm btn-danger">X</a></td>' +
                    '</tr>';
                $('#detail').html(html);
                $("input[name=jml]").val(no);
                sumStok(no, 1);
            }
        });
    }

    function sumStok(no, q) {
        var stok = $("input[name=stok" + no + "]").val();
        var subtotal = stok;
        $("input[name=sub_total" + no + "]").val(subtotal);
        console.log(q + "*" + stok + "=" + subtotal);
        sumTotal();
    }

    function sumTotal() {
        var total = 0;
        for (let i = 1; i <= $("input[name=jml]").val(); i++) {
            var sub = $("input[name=sub_total" + i + "]").val();
            total = total + parseInt(sub);
        }
        $("input[name=total]").val(total);
    }
</script>
@endsection