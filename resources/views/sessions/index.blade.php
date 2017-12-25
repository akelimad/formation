@extends('layouts.app')

@section('content') 
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="content">
                    
                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="title">La liste des sessions </h4>
                        </div>
                        <div class="col-md-4">
                            <a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#formateur_modal"> <i class="fa fa-plus"></i> Formateur </a>
                            <a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#participant_modal"> <i class="fa fa-plus"></i> Participant </a>
                        </div>
                    </div>
                    
                    <div class="toolbar">
                        <!-- Here you can write extra buttons/actions for the toolbar   -->
                    </div>
                    <div class="material-datatables">
                        <table id="datatables" class="table table-striped table-no-bordered table-hover" style="width:100%;cellspacing:0">
                            <thead>
                                <tr>
                                    <th>Nom de la sessions</th>
                                    <th>Cours</th>
                                    <th>Formateur</th>
                                    <th>Salle</th>
                                    <th>Lieu</th>
                                    <th>Date de début</th>
                                    <th>Statut</th>
                                    <th class="disabled-sorting text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sessions as $session)
                                <tr>
                                    <td> {{ $session->nom }} </td>
                                    <td> {{ $session->cour->titre }} </td>
                                    <td> {{ $session->formateur->nom }} </td>
                                    <td> {{ $session->salle->numero }} </td>
                                    <td> {{ $session->lieu }} </td>
                                    <td> {{ $session->start }} </td>
                                    <td> {{ $session->statut }} </td>
                                    <td class="text-right">
                                        <a href="{{ url('sessions/'.$session->id.'/show') }}" class="btn btn-simple btn-info btn-icon addBudget"><i class="fa fa-eye"></i></a>
                                        <a href="{{ url('budgets/create') }}" class="btn btn-simple btn-info btn-icon addBudget"><i class="fa fa-usd"></i></a>
                                        <a href="{{url('sessions/'.$session->id.'/edit')}}" class="btn btn-simple btn-warning btn-icon edit"><i class="ti-pencil-alt"></i></a>
                                        <a href="#" class="btn btn-simple btn-danger btn-icon remove"><i class="ti-close"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nom de la sessions</th>
                                    <th>Cour</th>
                                    <th>Formateur</th>
                                    <th>Salle</th>
                                    <th>Lieu</th>
                                    <th>Date de début</th>
                                    <th>Statut</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="modal fade" id="formateur_modal"  aria-labelledby="gridSystemModalLabel" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <a href="#" data-dismiss="modal" class="class pull-right"><span class="fa fa-close"></span></a>
                                    <h3 class="modal-title text-center">Ajouter un formateur</h3>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <form id="LoginValidation" action="{{ url('formateurs') }}" method="post" class="col-md-10 col-md-offset-1" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <div class="">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Nom complet
                                                                <star>*</star>
                                                            </label>
                                                            <input class="form-control" name="nom" type="text" required="true" placeholder="Nom" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Type</label>
                                                            <select name="type" id="type" class="form-control">
                                                                <option value="Interne">Interne</option>
                                                                <option value="Externe">Externe</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Email</label>
                                                            <input class="form-control" name="email" type="text" placeholder="example@gmail.com" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Tel</label>
                                                            <input class="form-control" name="tel" type="text" placeholder="06 00 00 00 00" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Qualification</label>
                                                            <input class="form-control" name="qualification" type="text" placeholder="Qualification" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Expertise</label>
                                                            <input class="form-control" name="expertise" type="text" placeholder="Expertise" />
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
                                                            <label class="control-label">Télécharger votre C.V en pièce jointe</label>
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
                    <div class="modal fade" id="participant_modal" aria-labelledby="gridSystemModalLabel" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <a href="#" data-dismiss="modal" class="class pull-right"><span class="fa fa-close"></span></a>
                                    <h3 class="modal-title text-center">Ajouter un participant</h3>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <form id="LoginValidation" action="{{ url('participants') }}" method="post" class="col-md-10 col-md-offset-1">
                                            {{ csrf_field() }}
                                            <div class="">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Nom
                                                                <star>*</star>
                                                            </label>
                                                            <input class="form-control" name="nom" type="text" required="" placeholder="Nom" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Email</label>
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


                </div>
                <!-- end content-->
            </div>
            <!--  end card  -->
        </div>
        <!-- end col-md-12 -->
    </div>
</div>

@endsection