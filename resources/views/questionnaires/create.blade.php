<div class="row">
    <form class="allInputsFormValidation form-horizontal" action="{{ url('questions') }}" method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <label class="col-md-2 control-label">Evaluation</label>
            <div class="col-md-8">
                <select class="form-control" id="evaluationsList" name="evaluation"  required>
                    <option value="">-- select --</option>
                    @foreach ($evaluations as $e)
                        <option value="{{ $e->id }}" > {{ $e->nom }} </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div id="addLine-wrap">
            <div class="form-group" >
                <label class="col-md-2 control-label">Question</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="questions[0]" required="required" />
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-default addLine"><i class="fa fa-plus"></i></button>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="text-center">
                <button type="submit" class="btn btn-rose btn-fill btn-wd">Sauvegarder</button>
            </div>
        </div>
    </form>
</div>