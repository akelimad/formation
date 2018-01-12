<div class="modal fade" id="formateur_modal"  aria-labelledby="gridSystemModalLabel" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <a href="#" data-dismiss="modal" class="class pull-right"><span class="fa fa-close"></span></a>
                <h3 class="modal-title text-center">Ajouter un formateur</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form id="allInputsFormValidation" action="{{ url('formateurs') }}" method="post" enctype="multipart/form-data" novalidate="novalidate" class="col-md-10 col-md-offset-1">
                    {{ csrf_field() }}
                    <div class="content">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger alert-dismissable" role="alert">
                                    <button type="button" class="close" data-dismiss="alert">
                                        <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                                    </button>
                                    <span><strong>Attention !</strong> {{ $error }}</span>
                                </div>
                            @endforeach
                        @endif
                        <h4 class="title">Ajouter un formateur</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Nom complet
                                        <star>*</star>
                                    </label>
                                    <input class="form-control" name="nom" type="text" required="required" placeholder="Nom" value="{{old('nom')}}" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Type <star>*</star></label>
                                    <select name="type" id="type" class="form-control" required="required">
                                        <option value="Interne">Interne</option>
                                        <option value="Externe">Externe</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Email <star>*</star></label>
                                    <input class="form-control" name="email" type="email" placeholder="example@gmail.com" required="required" value="{{old('email')}}"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Tel <star>*</star></label>
                                    <input class="form-control" name="tel" type="tel" placeholder="0600000000" required="required" value="{{old('tel')}}"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Qualification <star>*</star></label>
                                    <input class="form-control" name="qualification" type="text" placeholder="Qualification" required="required" value="{{old('qualification')}}"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Expertise <star>*</star></label>
                                    <input class="form-control" name="expertise" type="text" placeholder="Expertise" required="required" value="{{old('expertise')}}"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">Autres</label>
                                    <textarea name="autres" id="" class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">Importer le C.V en pièce jointe</label>
                                    <input type="file" name="cv" class="form-control" accept=".docx,.pdf" >    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 ">
                                <label class="control-label rating">Rating</label>
                            </div>
                            <div class="col-md-10">
                                <div class="stars quality">
                                    <input class="star star-5-q" id="star-5-q" type="radio" name="rating" value="5" />
                                    <label class="star star-5-q" for="star-5-q" title=" Qualité 5/5"></label>
                                    <input class="star star-4-q" id="star-4-q" type="radio" name="rating" value="4"/>
                                    <label class="star star-4-q" for="star-4-q" title=" Qualité 4/5"></label>
                                    <input class="star star-3-q" id="star-3-q" type="radio" name="rating" value="3"/>
                                    <label class="star star-3-q" for="star-3-q" title=" Qualité 3/5"></label>
                                    <input class="star star-2-q" id="star-2-q" type="radio" name="rating" value="2"/>
                                    <label class="star star-2-q" for="star-2-q" title=" Qualité 2/5"></label>
                                    <input class="star star-1-q" id="star-1-q" type="radio" name="rating" value="1"/>
                                    <label class="star star-1-q" for="star-1-q" title=" Qualité 1/5"></label>
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