@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="card" style="overflow: auto;">
                @include('partials/budgets.create')
            </div>
        </div>
    </div>
</div>


@endsection