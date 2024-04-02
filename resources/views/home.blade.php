@extends('tmp')
@section('content')
<div class="text-center text-dark">
<h1>
  Hallo!!! 
</h1>
<h3>{{ Auth::user()->nama }}</h3>
</div>
@endsection
