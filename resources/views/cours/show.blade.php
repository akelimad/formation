                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group label-floating">
                                <label class="control-label">Titre </label>
                                <p class="form-control"> {{ $c->titre }} </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group label-floating">
                                <label class="control-label">Coordinateur  </label>
                                <p class="form-control"> {{ $c->coordinateur }} </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Devise </label>
                                        <p class="form-control"> {{ $c->devise }} </p>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Budget </label>
                                        <p class="form-control"> {{ $c->prix }} </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group label-floating">
                                <label class="control-label">Durée(Nombre de jour) </label>
                                <p class="form-control"> {{ $c->duree }} </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group label-floating">
                                <label class="control-label">Description</label>
                                <p class="form-control"> {{ $c->description }} </p>
                            </div>
                        </div>
                    </div>