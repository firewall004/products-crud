@extends('includes.master')

@section('content')

<head>
	<script src="{{ asset('js/app.js') }}" defer></script>
</head>

<div class="row">
	<div class="col-md-4 col-md-offset-4">
		<h4>Product CRUD</h4>
		<hr>
	</div>
</div>

<div id="app">
	<div class="py-4">
		<div id="app">
			<app></app>
		</div>
	</div>
</div>
@endsection
