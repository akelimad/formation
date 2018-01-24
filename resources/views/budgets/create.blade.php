<input type="hidden" name="id">
{{ csrf_field() }}
<div class="">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group label-floating">
                <label class="control-label">Session<star>*</star> </label>
                <select class="form-control" id="sessionsList" name="session"  required="required">
                    <option value="">-- select --</option>
                    @foreach ($sessions as $s)
                        <option value="{{ $s->id }}" > {{ $s->nom }} </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div id="addLine-wrap">
        <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    <label class="control-label">Libellé du budget </label>
                    <input type="text" class="form-control" name="budgets[0][budget]" placeholder="libellé de budget" required="" />
                </div>
                <div class="col-md-3">
                    <label class="control-label">Montant prévu </label>
                    <input type="number" class="form-control prevu" name="budgets[0][prevu]" placeholder="Prévu" min="0" required="" />
                </div>
                <div class="col-md-3">
                    <label class="control-label">Montant réalisé </label>
                    <input type="number" class="form-control realise" name="budgets[0][realise]" placeholder="Réalisé" min="0" required="" />
                </div>
                <div class="col-md-2">
                    <label class="control-label">Ajustement </label>
                    <input type="number" class="form-control ajustement"  name="budgets[0][ajustement]" placeholder="Ajustement" />
                </div>
                <div class="col-md-1">
                    <label class="control-label"> &nbsp; </label>
                    <button type="button" class="btn btn-default addLine pull-right"><i class="fa fa-plus"></i></button>
                </div>
            </div>
        </div>
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

        $('#sessionsList option[value="{{$sid}}"]').prop('selected', true)

    })
</script>