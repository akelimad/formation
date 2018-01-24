<input type="hidden" name="id" value="{{ (isset($session->id)) ? $session->id : null }}">
{{ csrf_field() }}
<div class="content">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group label-floating">
                <label class="control-label">Session<star>*</star> </label>
                <select class="form-control" id="sessionsList" name="session"  required>
                    <option value="{{ $session->id }}" > {{ $session->nom }} </option>
                </select>
            </div>
        </div>
    </div>

    <div id="addLine-wrap">
        @foreach($sess_budgets as $budget)
        <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    <label class="control-label">Libellé du budget </label>
                    <input type="text" class="form-control" name="@if($first_budget->id == $budget->id) budgets[0][budget] @else budgets[{{$budget->id}}][budget] @endif" placeholder="libellé de budget" required="" value="{{$budget->budget}}" />
                </div>
                <div class="col-md-3">
                    <label class="control-label">Montant prévu </label>
                    <input type="number" class="form-control prevu" name="@if($first_budget->id == $budget->id) budgets[0][prevu] @else budgets[{{$budget->id}}][prevu] @endif" placeholder="Prévu" min="0" required="" value="{{$budget->prevu}}"/>
                </div>
                <div class="col-md-3">
                    <label class="control-label">Montant réalisé </label>
                    <input type="number" class="form-control realise" name="@if($first_budget->id == $budget->id) budgets[0][realise] @else budgets[{{$budget->id}}][realise] @endif" placeholder="Réalisé" min="0" required="" value="{{$budget->realise}}"/>
                </div>
                <div class="col-md-2">
                    <label class="control-label">Ajustement </label>
                    <input type="number" class="form-control ajustement"  name="@if($first_budget->id == $budget->id) budgets[0][ajustement] @else budgets[{{$budget->id}}][ajustement] @endif" placeholder="Ajustement" value="{{$budget->ajustement}}"/>
                </div>
                <div class="col-md-1">
                    <label class="control-label"> &nbsp; </label>
                    <button type="button" class="btn btn-default pull-right {{$first_budget->id == $budget->id ? 'addLine':'deleteLine'}}"><i class="fa {{$first_budget->id == $budget->id ? 'fa-plus':'fa-minus'}}"></i></button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="category form-category"><star>*</star> Champ obligatoire</div>
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