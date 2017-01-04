@extends('master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-4">
                <h3>Notebooks</h3>
                <hr>
                <notebooks :notebooks="{{ $notebooks }}" :bus="bus"></notebooks>
            </div>
            <div class="col-md-8">
                <h3>Notes</h3>
                <hr>
                <notes :bus="bus"></notes>
            </div>
        </div>
    </div>
</div>
@endsection
