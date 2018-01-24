<input type="hidden" name="id" value="{{ (isset($evaluation->id)) ? $evaluation->id : null }}">
{{ csrf_field() }}
<div class="row">
    <div class="form-group">
        <label class="col-md-2 control-label">Evaluation</label>
        <div class="col-md-8">
            <select class="form-control" id="evaluationsList" name="evaluation"  required>
                <option value="{{ $evaluation->id }}" > {{ $evaluation->nom }} </option>
            </select>
        </div>
    </div>
    <div id="addLine-wrap">
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
</div>

<script>
    $(function(){
        function uuidv4() {
            return ([1e7]+-1e3).replace(/[018]/g, c =>
                (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16)
            )
        }
        $(".addLine").click(function(event){
            event.preventDefault()
            var copy = $('#addLine-wrap').find(".form-group:first").clone()
            copy.find('input').val('')
            copy.find('button').toggleClass('addLine deleteLine')
            copy.find('button>i').toggleClass('fa-plus fa-minus')
            var uid = uuidv4()
            $.each(copy.find('input'), function(){
                var name = $(this).attr('name')
                $(this).attr('name', name.replace('[0]', '['+uid+']'))
            })
            $('#addLine-wrap').append(copy)
        })
        $('#addLine-wrap').on('click', '.deleteLine', function(){
            $(this).closest('.form-group').remove();
        });

    })
</script>