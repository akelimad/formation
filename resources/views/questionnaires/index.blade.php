@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="content">
                    <h4 class="title">Le questionnaire</h4>
                    <div class="toolbar">
                        <!-- Here you can write extra buttons/actions for the toolbar   -->
                    </div>
                    <div class="row">
                        @foreach($questions as $question)
                            <div class="panel panel-default">
                                <div class="">
                                    <div class="panel-body">
                                        <div class="col-md-8"><p>{{$question->titre}}</p></div>
                                        <div class="col-md-4">
                                            <select name="reponse" id="" class="form-control">
                                                <option value="">Tout à fait satisfait</option>
                                                <option value="">Satisfait</option>
                                                <option value="">Ni insatisfait ni insatisfait</option>
                                                <option value="">Pas satisfait</option>
                                                <option value="">Pas du tout satisfait</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="text-center">
                            <button type="submit" class="btn btn-info btn-fill text-center">Envoyer  <i class="ti-arrow-right"></i></button>
                        </div>
                    </div>
                </div>
                <!-- end content-->
            </div>
            <!--  end card  -->
        </div>
        <!-- end col-md-12 -->
    </div>
</div>

@endsection