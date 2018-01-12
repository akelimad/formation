<div class="modal fade" id="participant_modal" aria-labelledby="gridSystemModalLabel" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <a href="#" data-dismiss="modal" class="class pull-right"><span class="fa fa-close"></span></a>
                <h3 class="modal-title text-center">Ajouter un participant</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form id="surveyForm" action="{{ url('participants') }}" method="post" class="col-md-10 col-md-offset-1">
                        {{ csrf_field() }}
                        <div class="">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Nom <star>*</star></label>
                                        <input class="form-control" name="nom" type="text" required="" placeholder="Nom" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Email <star>*</star></label>
                                        <input class="form-control" name="email" type="email" required="" placeholder="example@gmail.com" />
                                    </div>
                                </div>
                            </div>

                            <div class="category form-category">
                                <star>*</star> Champ obligatoire</div>
                            <div class="text-center">
                                <input type="submit" class="btn btn-rose btn-fill btn-wd" value="Sauvegarder">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>