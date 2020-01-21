@extends('parent')

@section('main')

<div class="jumbotron text-center">
	<div align="right">
		<a href="{{ route('jasa.index') }}" class="btn btn-default">Back</a>
	</div>
	<br />
	<img src="{{ URL::to('/') }}/public/images/{{ $data->images }}" class="img-thumbnail" />
	<h3>nama pemilik - {{ $data->nama_pemilik }} </h3>
	<h3>nomor hp - {{ $data->nomor_hp }}</h3>
	<h3>alamat - {{ $data->alamat }}</h3>
	<h3>setting - {{ $data->setting }}</h3>
</div>
@endsection
