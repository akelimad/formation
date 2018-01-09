@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="card">
                <div class="content">
                    <h4 class="title text-center">Modifier un le questionnaire</h4>
                    <form id="surveyForm" class="form-horizontal" action="{{ url('questionnaire/'.$evaluation->id) }}" method="post">
                        <input type="hidden" name="_method" value="PUT">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-md-2 control-label">Evaluation</label>
                            <div class="col-md-8">
                                <select class="form-control" id="evaluationsList" name="evaluation"  required>
                                    <option value="{{ $evaluation->id }}" > {{ $evaluation->nom }} </option>
                                </select>
                            </div>
                        </div>
                        <div id="questions-wrap">
                            @foreach($eval_questions as $question)
                                <div class="form-group" >
                                    <label class="col-md-2 control-label">Question</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="@if($first_question->id == $question->id) questions[0] @else questions[{{$question->id}}] @endif" value="{{$question->titre}}" required="required" />
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-default {{$first_question->id == $question->id ? 'addLine':'deleteLine'}}"><i class="fa {{$first_question->id == $question->id ? 'fa-plus':'fa-minus'}}"></i></button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- The option field template containing an option field and a Remove button -->
                        <!-- <div class="form-group hide" id="optionTemplate">
                            <label class="col-md-2 control-label">Question</label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" name="questions[]" />
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-default removeButton"><i class="fa fa-minus"></i></button>
                            </div>
                        </div> -->

                        <div class="form-group">
                            <div class="text-center">
                                <button type="submit" class="btn btn-rose btn-fill btn-wd">Sauvegarder</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection