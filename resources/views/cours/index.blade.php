@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="content">
                    <div class="cours alert alert-success alert-dismissable" role="alert" style="display: none">
                        <button type="button" class="close" data-dismiss="alert">
                            <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                        </button>
                        <span><strong><i class="fa fa-check "></i></strong> Le cours a été modifié avec suucès</span>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="title">La liste des cours</h4>
                        </div>
                        
                        <div class="col-md-4">
                            <a href="{{ url('cours/create') }}" class="btn btn-primary pull-right"> <i class="fa fa-plus"></i> Nouveau</a>
                            <a href="{{url('cours/c/export')}}" class="pull-right excelIcon"  data-toggle="tooltip" title="Exporter vers Excel"><i class="fa fa-file-excel-o fa-2x"></i></a>
                        </div>
                    </div>
                    
                    <div class="toolbar">
                        <!-- Here you can write extra buttons/actions for the toolbar   -->
                    </div>
                    <div class="material-datatables">
                        <table class="table table-striped table-no-bordered table-hover" style="width:100%;cellspacing:0">
                            <thead>
                                <tr>
                                    <th>Titre</th>
                                    <th>Coordinateur</th>
                                    <th>Durée(j)</th>
                                    <th>Budget(DH)</th>
                                    <th class="disabled-sorting text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cours as $cour)
                                <tr>
                                    <td> {{ $cour->titre }} </td>
                                    <td> {{ $cour->user->name }} </td>
                                    <td> {{ $cour->duree }} </td>
                                    <td> {{ $cour->prix }} </td>
                                    <td class="text-right">
                                        {{ csrf_field() }}
                                        <a href="#" class="btn btn-fill btn-default btn-icon showCours" data-toggle="modal" data-target="#showCours_modal" data-id="{{$cour->id}}"><i class="fa fa-eye"></i></a>
                                        <a href="#" class="btn btn-fill btn-warning btn-icon editCours" data-toggle="modal" data-target="#editCours_modal" data-id="{{$cour->id}}"><i class="ti-pencil-alt"></i></a>
                                        <a href="#" class="btn btn-fill btn-danger btn-icon delete-cours" data-id="{{$cour->id}}"><i class="ti-close"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Titre</th>
                                    <th>Coordinateur</th>
                                    <th>Durée(j)</th>
                                    <th>Budget(DH)</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    {{ $cours->links() }}

                    <div class="modal fade" id="showCours_modal" aria-labelledby="gridSystemModalLabel" role="dialog">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <a href="#" data-dismiss="modal" class="class pull-right"><span class="fa fa-close"></span></a>
                                    <h3 class="modal-title text-center"> Détails du cours </h3>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Titre </label>
                                                <p class="form-control" id="titre">  </p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Coordinateur  </label>
                                                <p class="form-control" id="coordianteur">  </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Devise </label>
                                                        <p class="form-control" id="devise">  </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Budget </label>
                                                        <p class="form-control" id="budget">  </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Durée(Nombre de jour) </label>
                                                <p class="form-control" id="duree">  </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Description</label>
                                                <p class="form-control" id="description">  </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="editCours_modal" aria-labelledby="gridSystemModalLabel" role="dialog">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <a href="#" data-dismiss="modal" class="class pull-right"><span class="fa fa-close"></span></a>
                                    <h3 class="modal-title text-center"> Editer le cours </h3>
                                </div>
                                <div class="modal-body">
                                    <form class="allInputsFormValidation" id="editCoursForm" method="post" novalidate="novalidate">
                                        <input type="hidden" name="id">
                                        <input type="hidden" name="_method" value="PUT">
                                        {{ csrf_field() }}
                                        <div class="content">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Titre<star>*</star></label>
                                                        <input class="form-control"  name="titre" type="text" required="required" placeholder="Titre" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Coordinateur<star>*</star> </label>
                                                        <select id="coordinateur" class="form-control" name="coordinateur" required="required">
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group label-floating">
                                                                <label class="control-label">Devise <star>*</star></label>
                                                                <select class="form-control" name="devise" required="required">
                                                                    <option value="USD" selected="selected">United States Dollars</option>
                                                                    <option value="EUR">Euro</option>
                                                                    <option value="MAD">Maghreb Dirham</option>
                                                                    <option value="GBP">United Kingdom Pounds</option>
                                                                    <option value="DZD">Algeria Dinars</option>
                                                                    <option value="ARP">Argentina Pesos</option>
                                                                    <option value="AUD">Australia Dollars</option>
                                                                    <option value="ATS">Austria Schillings</option>
                                                                    <option value="BSD">Bahamas Dollars</option>
                                                                    <option value="BBD">Barbados Dollars</option>
                                                                    <option value="BEF">Belgium Francs</option>
                                                                    <option value="BMD">Bermuda Dollars</option>
                                                                    <option value="BRR">Brazil Real</option>
                                                                    <option value="BGL">Bulgaria Lev</option>
                                                                    <option value="CAD">Canada Dollars</option>
                                                                    <option value="CLP">Chile Pesos</option>
                                                                    <option value="CNY">China Yuan Renmimbi</option>
                                                                    <option value="CYP">Cyprus Pounds</option>
                                                                    <option value="CSK">Czech Republic Koruna</option>
                                                                    <option value="DKK">Denmark Kroner</option>
                                                                    <option value="NLG">Dutch Guilders</option>
                                                                    <option value="XCD">Eastern Caribbean Dollars</option>
                                                                    <option value="EGP">Egypt Pounds</option>
                                                                    <option value="FJD">Fiji Dollars</option>
                                                                    <option value="FIM">Finland Markka</option>
                                                                    <option value="FRF">France Francs</option>
                                                                    <option value="DEM">Germany Deutsche Marks</option>
                                                                    <option value="XAU">Gold Ounces</option>
                                                                    <option value="GRD">Greece Drachmas</option>
                                                                    <option value="HKD">Hong Kong Dollars</option>
                                                                    <option value="HUF">Hungary Forint</option>
                                                                    <option value="ISK">Iceland Krona</option>
                                                                    <option value="INR">India Rupees</option>
                                                                    <option value="IDR">Indonesia Rupiah</option>
                                                                    <option value="IEP">Ireland Punt</option>
                                                                    <option value="ILS">Israel New Shekels</option>
                                                                    <option value="ITL">Italy Lira</option>
                                                                    <option value="JMD">Jamaica Dollars</option>
                                                                    <option value="JPY">Japan Yen</option>
                                                                    <option value="JOD">Jordan Dinar</option>
                                                                    <option value="KRW">Korea (South) Won</option>
                                                                    <option value="LBP">Lebanon Pounds</option>
                                                                    <option value="LUF">Luxembourg Francs</option>
                                                                    <option value="MYR">Malaysia Ringgit</option>
                                                                    <option value="MXP">Mexico Pesos</option>
                                                                    <option value="NLG">Netherlands Guilders</option>
                                                                    <option value="NZD">New Zealand Dollars</option>
                                                                    <option value="NOK">Norway Kroner</option>
                                                                    <option value="PKR">Pakistan Rupees</option>
                                                                    <option value="XPD">Palladium Ounces</option>
                                                                    <option value="PHP">Philippines Pesos</option>
                                                                    <option value="XPT">Platinum Ounces</option>
                                                                    <option value="PLZ">Poland Zloty</option>
                                                                    <option value="PTE">Portugal Escudo</option>
                                                                    <option value="ROL">Romania Leu</option>
                                                                    <option value="RUR">Russia Rubles</option>
                                                                    <option value="SAR">Saudi Arabia Riyal</option>
                                                                    <option value="XAG">Silver Ounces</option>
                                                                    <option value="SGD">Singapore Dollars</option>
                                                                    <option value="SKK">Slovakia Koruna</option>
                                                                    <option value="ZAR">South Africa Rand</option>
                                                                    <option value="KRW">South Korea Won</option>
                                                                    <option value="ESP">Spain Pesetas</option>
                                                                    <option value="XDR">Special Drawing Right (IMF)</option>
                                                                    <option value="SDD">Sudan Dinar</option>
                                                                    <option value="SEK">Sweden Krona</option>
                                                                    <option value="CHF">Switzerland Francs</option>
                                                                    <option value="TWD">Taiwan Dollars</option>
                                                                    <option value="THB">Thailand Baht</option>
                                                                    <option value="TTD">Trinidad and Tobago Dollars</option>
                                                                    <option value="TRL">Turkey Lira</option>
                                                                    <option value="VEB">Venezuela Bolivar</option>
                                                                    <option value="ZMK">Zambia Kwacha</option>
                                                                    <option value="EUR">Euro</option>
                                                                    <option value="XCD">Eastern Caribbean Dollars</option>
                                                                    <option value="XDR">Special Drawing Right (IMF)</option>
                                                                    <option value="XAG">Silver Ounces</option>
                                                                    <option value="XAU">Gold Ounces</option>
                                                                    <option value="XPD">Palladium Ounces</option>
                                                                    <option value="XPT">Platinum Ounces</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group label-floating">
                                                                <label class="control-label">Budget <star>*</star></label>
                                                                <input class="form-control" name="prix" type="number" placeholder="Budget" required="required" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Durée(Nombre de jour) <star>*</star></label>
                                                        <input class="form-control"  name="duree" type="number" placeholder="Nomre de jour" required="required" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Description</label>
                                                        <textarea class="form-control" name="description" placeholder="Description" rows="3"></textarea>
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
                <!-- end content-->
            </div>
            <!--  end card  -->
        </div>
        <!-- end col-md-12 -->
    </div>
</div>

@endsection