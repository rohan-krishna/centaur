@extends('master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-4 centaur-card" id="notebooksComponent">
                <div class="centaur-card--header has-ripple">
                    <md-ink-ripple></md-ink-ripple>
                    <h3>Notebooks</h3>
                </div>
                <notebooks :bus="bus"></notebooks>
            </div>
            <div class="col-md-8 centaur-card has-padding--lr no-background" id="notesComponent">
                <div class="centaur-card--header has-ripple">
                    <md-ink-ripple></md-ink-ripple>
                    <h3>Notes</h3>
                </div>
                <notes :bus="bus"></notes>
            </div>
        </div>
        <div class="col-md-12" id="addNewNoteComponent">
            <addnewnote></addnewnote>
        </div>
    </div>
</div>
@endsection
