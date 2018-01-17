<div class="row">
    <div class="col-md-12">
        <p> la liste des budgets de la session {{ $session->nom }} </p>
        <table class="table" style="width:100%;cellspacing:0">
            <thead>
                <tr>
                    <th>Libellé</th>
                    <th>Prevu</th>
                    <th>Realisé</th>
                    <th>Ajustement</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sess_budgets as $budget)
                    <tr>
                        <td>{{ $budget->budget }}</td>
                        <td>{{ $budget->prevu }}</td>
                        <td>{{ $budget->realise }}</td>
                        <td>{{ $budget->ajustement }}</td>
                        <td> </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>