@extends('master')

@section('content')

	<div class="container">
		<h3>Edit <strong>{{ $notebook->title }}</strong>'s Details</h3>
		<hr>

		<form action="{{ url('notebooks/' . $notebook->id) }}" method="POST">
			{{ method_field('PUT') }}
			{{ csrf_field() }}
			<div class="form-group">
				<label for="title">Notebook Title: </label>
				<input type="text" name="title" placeholder="{{ $notebook->title }}" class="form-control">
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-success">Edit Notebook</button>
			</div>
		</form>
	</div>

@stop