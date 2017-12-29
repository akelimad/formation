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
                                                <input type="hidden" name="questionsIds[]" value="{{$question->id}}">
                                            </div>
                                            <div class="col-md-4">
                                                <select name="reponses[]" class="selectpicker" data-style="btn btn-primary btn-round" title="Single Select" data-size="7">
                                                    <option selected value="0">=== Selectionnez ===</option>
                                                    <option value="5">Tout à fait satisfait</option>
                                                    <option value="4">Satisfait</option>
                                                    <option value="3">Ni insatisfait ni insatisfait</option>
                                                    <option value="2">Pas satisfait</option>
                                                    <option value="1">Pas du tout satisfait</option>
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