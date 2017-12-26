@extends('layouts.basic')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                <form action="@if(isset($token)) {{ url('questionnaire/'.$eval_id.'/'.$token) }} @endif" method="post">
                    <input type="hidden" name="_method" value="PUT">
                    {{ csrf_field() }}
                    <div class="content">
                        <h4 class="title">Le questionnaire</h4>
                        <div class="toolbar">
                            <!-- Here you can write extra buttons/actions for the toolbar   -->
                        </div>
                        <div class="row">
                            @if(count($questions)>0)
                                @foreach($questions as $question)
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <p>{{$question->titre}}</p>
                                                <input type="hidden" name="ids[]" value="{{$question->id}}">
                                            </div>
                                            <div class="col-md-4">
                                                <select name="reponses[]" id="" class="form-control">
                                                    <option value="Tout à fait satisfait">Tout à fait satisfait</option>
                                                    <option value="Satisfait">Satisfait</option>
                                                    <option value="Ni insatisfait ni insatisfait">Ni insatisfait ni insatisfait</option>
                                                    <option value="Pas satisfait">Pas satisfait</option>
                                                    <option value="Pas du tout satisfait">Pas du tout satisfait</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="text-center">
                                    @if(isset($token))
                                        <button type="submit" class="btn btn-info btn-fill text-center">Envoyer  <i class="ti-arrow-right"></i></button>
                                    @else
                                        <a href="{{url('evaluations')}}" class="btn btn-info btn-fill text-center"><i class="ti-arrow-left"></i> Retour</a>
                                    @endif
                                </div>
                            @else
                                <div class="form-group">
                                    <h4> Cette evaluation n'a pas encore de questionnaire !  <a href="{{ url('evaluations') }}" class="btn btn-primary"> <i class="fa fa-arrow-left"></i> Retour</a></h4>
                                </div>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
            <!--  end card  -->
        </div>
        <!-- end col-md-12 -->
    </div>
</div>

@endsection