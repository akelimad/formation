@extends('layouts.app')

@section('content') 
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="content">
                    <form action="{{url('sessions/filter/search')}}" method="get">
                        <div class="filter">
                            <div class="col-md-1">
                                <p>Filtres: </p>
                            </div>
                            <div class="col-md-2">
                                <input type="search" name="start" class="form-control datetimepicker" data-date-format="DD/MM/YYYY HH:mm" placeholder="Date début" value="{{isset($selected_start) ? $selected_start: ''}}">
                            </div>
                            <div class="col-md-2">
                                <input type="search" name="end" class="form-control datetimepicker" data-date-format="DD/MM/YYYY HH:mm" placeholder="Date fin" value="{{isset($selected_end) ? $selected_end: ''}}">
                            </div>
                            <div class="col-md-1">
                                <p class="pull-right">Statut: </p>
                            </div>
                            <div class="col-md-2">
                                <select class="form-control" name="statut">
                                    <option disabled selected>-- select --</option>
                                    <option value="Aprobation en attente" @if(isset($selected) && $selected == "Aprobation en attente") selected @endif >Aprobation en attente</option>

                                    <option value="Programmé" @if(isset($selected) && $selected == "Programmé") selected @endif >Programmé</option>

                                    <option value="Terminé" @if(isset($selected) && $selected == "Terminé") selected @endif >Terminé</option>

                                    <option value="Annulé" @if(isset($selected) && $selected == "Annulé") selected @endif >Annulé</option>

                                </select>
                            </div>
                            <div class="col-md-4">
                                <a href="{{url('sessions')}}" class="btn btn-success pull-right"><i class="fa fa-refresh"></i> Actualiser</a>
                                <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-search"></i> Consulter</button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="title">La liste des sessions </h4>
                        </div>
                        <div class="col-md-6">
                            <a href="{{url('sessions/create')}}" class="btn btn-primary pull-right"> <i class="fa fa-plus"></i> Session </a>
                            <a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#participant_modal"> <i class="fa fa-plus"></i> Participant </a>
                            <a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#formateur_modal"> <i class="fa fa-plus"></i> Formateur </a>
                        </div>
                    </div>
                    
                    <div class="toolbar">
                        
                    </div>
                    <div class="material-datatables">
                        <table id="datatables" class="table table-striped table-no-bordered table-hover" style="width:100%;cellspacing:0">
                            <thead>
                                <tr>
                                    <th>Nom de la session</th>
                                    <th>Cours</th>
                                    <th>Formateur</th>
                                    <th>Salle</th>
                                    <th>Lieu</th>
                                    <th>Date de début</th>
                                    <th>Date de fin</th>
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
                                    <td> {{ Carbon\Carbon::parse($session->start)->format('d/m/Y')}} </td>
                                    <td> {{ Carbon\Carbon::parse($session->end)->format('d/m/Y')}} </td>
                                    <td> {{ $session->statut }} </td>
                                    <td class="text-right">
                                        <a href="{{url('sessions/'.$session->id)}}" class="btn btn-fill btn-default btn-icon " title="Afficher les détails"><i class="fa fa-eye"></i></a>
                                        <a href="#" class="btn btn-fill btn-info btn-icon addBudget" data-toggle="modal" data-target="#budget_modal" data-id="{{$session->id}}" title="Ajouter un budget"><i class="fa fa-usd"></i></a>
                                        <a href="{{url('sessions/'.$session->id.'/edit')}}" class="btn btn-fill btn-warning btn-icon edit" title="Modifier"><i class="ti-pencil-alt"></i></a>
                                        <a href="#" class="btn btn-fill btn-danger btn-icon delete-session" data-id="{{$session->id}}" title="Supprimer"><i class="ti-close"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nom de la session</th>
                                    <th>Cour</th>
                                    <th>Formateur</th>
                                    <th>Salle</th>
                                    <th>Lieu</th>
                                    <th>Date de début</th>
                                    <th>Date de fin</th>
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
                    <div class="modal fade" id="budget_modal"  aria-labelledby="gridSystemModalLabel" role="dialog">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <a href="#" data-dismiss="modal" class="class pull-right"><span class="fa fa-close"></span></a>
                                    <h3 class="modal-title text-center">Ajouter les budgets de la session</h3>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <form id="" action="{{ url('budgets') }}" method="post" class="col-md-10 col-md-offset-1">
                                            {{ csrf_field() }}
                                            <div class="">
                                                <div class="row">
                                                    <!-- <div class="col-md-4">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Nom
                                                                <star>*</star>
                                                            </label>
                                                            <input class="form-control" name="nom" type="text" placeholder="Titre" />
                                                        </div>
                                                    </div>  -->
                                                    <div class="col-md-4">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Session<star>*</star> </label>
                                                            <select class="form-control" id="sessionsList" name="session"  required>
                                                                <option>-- select --</option>
                                                                @foreach ($sessions as $s)
                                                                    <option value="{{ $s->id }}" > {{ $s->nom }} </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="col-md-4">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Montant(Dhs)
                                                                <star>*</star>
                                                            </label>
                                                            <input class="form-control" name="montant" type="text" placeholder="Montant" />
                                                        </div>
                                                    </div> -->

                                                </div>

                                                <div id="budgets-wrap">
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
                                                                <label class="control-label"> </label>
                                                                <button type="button" class="btn btn-default addLine pull-right"><i class="fa fa-plus"></i></button>
                                                            </div>
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