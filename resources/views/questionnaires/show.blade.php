<div class="content">
        @if(count($questions)>0)
            @foreach($questions as $key => $question)
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-9">
                            <p>{{$key +1 }} <i class="fa fa-caret-right"></i> {{$question->titre}}</p>
                            <input type="hidden" name="questionsIds[]" value="{{$question->id}}">
                        </div>
                        <div class="col-md-3">
                            <select name="reponses[]" class="btn btn-primary" required="">
                                <option selected value="">=== Selectionnez ===</option>
                                <option value="5">Fortement satisfait</option>
                                <option value="4">Satisfait</option>
                                <option value="3">Neutre</option>
                                <option value="2">Pas satisfait</option>
                                <option value="1">Fortement insatisfait</option>
                            </select>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            @endforeach
            <div class="text-center">
                @if(isset($token))
                    <button type="submit" class="btn btn-info btn-fill text-center">Envoyer  <i class="fa fa-long-arrow-right"></i></button>
                @else
                    <!-- <a href="{{url('evaluations')}}" class="btn btn-info btn-fill text-center"><i class="fa fa-long-arrow-left"></i> Retour</a> -->
                @endif
            </div>
        @else
            <div class="form-group">
                <h4> Cette evaluation n'a pas encore de questionnaire !  <a href="{{ url('evaluations') }}" class="btn btn-primary"> <i class="fa fa-long-arrow-left"></i> Retour</a></h4>
            </div>
        @endif
</div>
