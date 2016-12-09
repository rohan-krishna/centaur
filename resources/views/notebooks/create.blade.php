@extends('master')

@section('content')
	
	<div class="container">
		<h3>Create A New Notebook</h3>
		<hr>

		<div class="row">
			<div class="col-md-12">
				<div class="col-md-6 col-md-offset-3">
					<form action="{{ url('notebooks') }}" method="POST">
						{{ csrf_field() }}
						<div class="form-group">
							<label for="title">Notebook Title: </label>
							<input type="text" name="title" placeholder="Title" class="form-control">
						</div>
						<div class="form-group">
							<div class="col-md-6">
								<button type="submit" class="btn btn-success btn-block">Create New Notebook</button>
							</div>
							<div class="col-md-6">
								<button type="reset" class="btn btn-danger btn-block">Reset</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	



@stop