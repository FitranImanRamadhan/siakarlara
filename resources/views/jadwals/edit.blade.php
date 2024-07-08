@extends('adminlayout')
@section('content')
    <div class="content-wrapper pb-3 pt-3">
        <div class="content pb-5">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="text-center">
                                    <h3 class="card-title">{{ $title }}</h3>
                                </div>
                                <div class="back-top">
                                <a href="{{ url()->previous() }}" class="btn text-muted" title="Kembali" data-toggle="tooltip" data-placement="right">
                                    <i class="fa fa-arrow-left fa-fw"></i></span>
                                </a>
                            </div>
                            </div> 
                            <form action="{{ route('jadwals.update', $jadwal->id) }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                                @csrf
                                @method('patch')
                                @include('jadwals._form')
                            </form>
                            <div id="loading"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
    	$('.select2').select2({
			placeholder : 'Pilih Data..'
        });
        
		$('.datepicker').daterangepicker({
		  singleDatePicker: true,
		  showDropdowns: true,
          autoUpdateInput: true,
          drops: 'up'
		});

	</script>
@endsection
