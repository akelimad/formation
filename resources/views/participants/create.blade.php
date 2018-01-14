@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="card">
                @include('partials/participants.create')
            </div>
        </div>
    </div>
</div>

@endsection