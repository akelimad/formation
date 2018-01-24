
$(function() {

    function validate(){
        $('.allInputsFormValidation').validate({
            rules: {
                tel: {
                    number: true
                },
                fax: {
                    number: true
                },
                photo:{
                    accept:"image/*",
                    filesize: 2000000   //max size 200 kb
                }
            }
        });
    }

    demo.initFormExtendedDatetimepickers();

    $(".btnFilter").click(function(){
        $(".filterContent").slideToggle(300);
        $('.btnFilter i').toggleClass('fa-plus fa-minus')
    })

    $('body').on('keyup', '.prevu, .realise', function(){
        var $container = $(this).closest('.form-group');
        var prevu = parseInt($($container).find(".prevu").val());
        var realise = parseInt($($container).find(".realise").val());
        if($($container).find('.realise').length === 0){
            $($container).find('.ajustement').val(0);  
        }else{
            $($container).find('.ajustement').val(prevu - realise);  
        }
    });

    //to get evaluation that you clicked on to attach question selected by default
    $("#questionnaire_modal" ).on('shown.bs.modal', function(event){
        $('#evaluationsList option[value="'+ $(event.relatedTarget).data('id') +'"]').prop('selected', true)
    });

    //to get session that you clicked on to attach budget selected by default
    $("#addBudget_modal" ).on('shown.bs.modal', function(event){
        //$('#sessionsList option[value="'+ $(event.relatedTarget).data('id') +'"]').prop('selected', true)
    });

    function addLine(){
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
    }

    function uuidv4() {
        return ([1e7]+-1e3).replace(/[018]/g, c =>
            (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16)
        )
    }


    $('#formateur_modal').appendTo("body");
    $('#participant_modal').appendTo("body");
    $('#addEvaluation_modal').appendTo("body");
    $('#editEvaluation_modal').appendTo("body");
    $('#addQuestionnaire_modal').appendTo("body");
    $('#editQuestionnaire_modal').appendTo("body");
    $('#addBudget_modal').appendTo("body");
    $('#showBudget_modal').appendTo("body");
    $('#editBudget_modal').appendTo("body");
    // $("#budget_modal").on("hidden.bs.modal", function(){
    //     $("#budgets-wrap > div").removeClass('has-error')
    // })
    $('#addPrestataire_modal').appendTo("body");
    $('#showPrestataire_modal').appendTo("body");
    $('#editPrestataire_modal').appendTo("body");
    $('#showCours_modal').appendTo("body");
    $('#editCours_modal').appendTo("body");
    $('#addCours_modal').appendTo("body");
    $('#addSalle_modal').appendTo("body");
    $('#showSalle_modal').appendTo("body");
    $('#editSalle_modal').appendTo("body");
    $('#showFormateur_modal').appendTo("body");
    $('#editFormateur_modal').appendTo("body");
    $('#addFormateur_modal').appendTo("body");
    $('#addSession_modal').appendTo("body");
    $('#editSession_modal').appendTo("body");
    $('#showSession_modal').appendTo("body");
    $('#showQuestionnaire_modal').appendTo("body");
    $('#addUser_modal').appendTo("body");
    $('#editUser_modal').appendTo("body");
    $('#addRole_modal').appendTo("body");
    $('#editRole_modal').appendTo("body");
    $('#addPermission_modal').appendTo("body");
    $('#editPermission_modal').appendTo("body");
    
    $('[data-toggle="tooltip"]').tooltip();

    // $('.table').DataTable({
    //     "order": [],
    //     "pagingType": "full_numbers",
    //     "lengthMenu": [
    //         [10, 25, 50, -1],
    //         [10, 25, 50, "Tous"]
    //     ],
    //     responsive: true,
    //     language: {
    //         search: "_INPUT_",
    //         searchPlaceholder: "Recherche ...",
    //         "paginate": {
    //             "first":      "Premier",
    //             "last":       "Dernier",
    //             "next":       "Suivant",
    //             "previous":   "Précedent"
    //         },
    //         "lengthMenu":     "Affichage _MENU_ entrées",
    //         "zeroRecords":    "Aucun resultat trouvée !",
    //         "emptyTable":     "Aucune donnée dans la table",
    //         "info":           "Affichage _START_ à _END_ du _TOTAL_ entrées",
    //         "infoEmpty":      "Affichage 0 à 0 du 0 entrées",
    //     },

    // });


    // var table = $('#datatables').DataTable();

    $('.card .material-datatables label').addClass('form-group');

    $(".rating-note").each(function(index,elem){
        var $this=$(".rating-note").eq(index);
        var value=$this.data('value');
        $this.find('input[value="'+value+'"]').attr('checked','checked');
    });

    //delete evaluation
    $(".table").on('click', '.delete-evaluation',function () {
        var id= $(this).data('id');
        var token = $('input[name="_token"]').val();
        var url = 'evaluations/'+id+'/delete';
        var $tr = $(this).closest('tr');
        swal({
            title: 'Etes-vous sûr ?',
            text: "Vous ne serez pas en mesure de rétablir ceci! toutes les questions et ses reponses associés seront aussi supprimés",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui, supprimer !',
            cancelButtonText: 'Annuler',
            showLoaderOnConfirm: true,
            preConfirm: function() {
            return new Promise(function(resolve) {
                $.ajax({
                    type: 'POST',
                    url:  url,
                    data: {
                        "id": id,
                        "_method": 'DELETE',
                        "_token": token,
                    },
                }).done(function(response){
                    swal('Supprimée !', "L'evaluation a été supprimée avec succès.", 'success');
                    $tr.find('td').fadeOut(1000,function(){ $tr.remove(); });
                    location.reload(); 
                }).fail(function(){
                    swal('Oops...', "Il ya quelque chose qui ne va pas ! Il se peut qu'il ya une liaison avec d'autres tables.", 'error');
                });
            });
            },
            allowOutsideClick: false     
        }); 
    });

    //delete cours
    $(".table").on('click', '.delete-cours',function () {
        var id= $(this).data('id');
        var token = $('input[name="_token"]').val();
        var url = 'cours/'+id+'/delete';
        var $tr = $(this).closest('tr');
        swal({
            title: 'Etes-vous sûr ?',
            text: "Vous ne serez pas en mesure de rétablir ceci!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui, supprimer !',
            cancelButtonText: 'Annuler',
            showLoaderOnConfirm: true,
            preConfirm: function() {
            return new Promise(function(resolve) {
                $.ajax({
                    type: 'POST',
                    url:  url,
                    data: {
                        "id": id,
                        "_method": 'DELETE',
                        "_token": token,
                    },
                }).done(function(response){
                    swal('Supprimé!', 'Le cours a été supprimé avec succès.', 'success');
                    $tr.find('td').fadeOut(1000,function(){ $tr.remove(); });
                    location.reload(); 
                }).fail(function(){
                    swal('Oops...', "Il ya quelque chose qui ne va pas ! Il se peut qu'il ya une liaison avec d'autres tables.", 'error');
                });
            });
            },
            allowOutsideClick: false     
        }); 
    });

    //delete cours
    $(".table").on('click', '.delete-salle',function () {
        var id= $(this).data('id');
        var token = $('input[name="_token"]').val();
        var url = 'salles/'+id+'/delete';
        var $tr = $(this).closest('tr');
        swal({
            title: 'Etes-vous sûr ?',
            text: "Vous ne serez pas en mesure de rétablir ceci!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui, supprimer !',
            cancelButtonText: 'Annuler',
            showLoaderOnConfirm: true,
            preConfirm: function() {
            return new Promise(function(resolve) {
                $.ajax({
                    type: 'POST',
                    url:  url,
                    data: {
                        "id": id,
                        "_method": 'DELETE',
                        "_token": token,
                    },
                }).done(function(response){
                    swal('Supprimée!', 'La salle a été supprimée avec succès.', 'success');
                    $tr.find('td').fadeOut(1000,function(){ $tr.remove(); });
                    location.reload(); 
                }).fail(function(){
                    swal('Oops...', "Il ya quelque chose qui ne va pas ! Il se peut qu'il ya une liaison avec d'autres tables.", 'error');
                });
            });
            },
            allowOutsideClick: false     
        }); 
    });

    //delete prestatire
    $(".table").on('click', '.delete-prestataire',function () {
        var id= $(this).data('id');
        var token = $('input[name="_token"]').val();
        var url = 'prestataires/'+id+'/delete';
        var $tr = $(this).closest('tr');
        swal({
            title: 'Etes-vous sûr ?',
            text: "Vous ne serez pas en mesure de rétablir ceci!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui, supprimer !',
            cancelButtonText: 'Annuler',
            showLoaderOnConfirm: true,
            preConfirm: function() {
            return new Promise(function(resolve) {
                $.ajax({
                    type: 'POST',
                    url:  url,
                    data: {
                        "id": id,
                        "_method": 'DELETE',
                        "_token": token,
                    },
                }).done(function(response){
                    swal('Supprimé!', 'Le prestataire a été supprimé ave succès.', 'success');
                    $tr.find('td').fadeOut(1000,function(){ $tr.remove(); });
                    location.reload(); 
                }).fail(function(){
                    swal('Oops...', "Il ya quelque chose qui ne va pas ! Il se peut qu'il ya une liaison avec d'autres tables.", 'error');
                });
            });
            },
            allowOutsideClick: false     
        }); 
    });

    //delete formateur
    $(".table").on('click', '.delete-formateur',function () {
        var id= $(this).data('id');
        var token = $('input[name="_token"]').val();
        var url = 'formateurs/'+id+'/delete';
        var $tr = $(this).closest('tr');
        swal({
            title: 'Etes-vous sûr ?',
            text: "Vous ne serez pas en mesure de rétablir ceci!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui, supprimer !',
            cancelButtonText: 'Annuler',
            showLoaderOnConfirm: true,
            preConfirm: function() {
            return new Promise(function(resolve) {
                $.ajax({
                    type: 'POST',
                    url:  url,
                    data: {
                        "id": id,
                        "_method": 'DELETE',
                        "_token": token,
                    },
                }).done(function(response){
                    swal('Supprimé!', 'Le formateur a été supprimé ave succès.', 'success');
                    $tr.find('td').fadeOut(1000,function(){ $tr.remove(); });
                    location.reload(); 
                }).fail(function(){
                    swal('Oops...', "Il ya quelque chose qui ne va pas ! Il se peut qu'il ya une liaison avec d'autres tables.", 'error');
                });
            });
            },
            allowOutsideClick: false     
        }); 
    });

    //delete session
    $(".table").on('click', '.delete-session',function () {
        var id= $(this).data('id');
        var token = $('input[name="_token"]').val();
        var url = 'sessions/'+id+'/delete';
        var $tr = $(this).closest('tr');
        swal({
            title: 'Etes-vous sûr ?',
            text: "Vous ne serez pas en mesure de rétablir ceci! En supprimant une session tous les budgets, participants, evaluations, questions et ses reponses qui lui sont associés seront aussi supprimés",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui, supprimer !',
            cancelButtonText: 'Annuler',
            showLoaderOnConfirm: true,
            preConfirm: function() {
            return new Promise(function(resolve) {
                $.ajax({
                    type: 'POST',
                    url:  url,
                    data: {
                        "id": id,
                        "_method": 'DELETE',
                        "_token": token,
                    },
                }).done(function(response){
                    swal('Supprimée!', 'La session a été supprimée ave succès.', 'success');
                    $tr.find('td').fadeOut(1000,function(){ $tr.remove(); });
                    location.reload(); 
                }).fail(function(){
                    swal('Oops...', "Il ya quelque chose qui ne va pas ! Il se peut qu'il ya une liaison avec d'autres tables.", 'error');
                });
            });
            },
            allowOutsideClick: false     
        }); 
    });

    //delete user
    $(".table").on('click', '.delete-user',function () {
        var id= $(this).data('id');
        var token = $('input[name="_token"]').val();
        var url = 'utilisateurs/'+id+'/delete';
        var $tr = $(this).closest('tr');
        swal({
            title: 'Etes-vous sûr ?',
            text: "Vous ne serez pas en mesure de rétablir ceci! En supprimant un utilisateur, les cours qui lui sont associés seront aussi supprimés",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui, supprimer !',
            cancelButtonText: 'Annuler',
            showLoaderOnConfirm: true,
            preConfirm: function() {
            return new Promise(function(resolve) {
                $.ajax({
                    type: 'POST',
                    url:  url,
                    data: {
                        "id": id,
                        "_method": 'DELETE',
                        "_token": token,
                    },
                }).done(function(response){
                    swal('Supprimé!', "L'utilisateur a été supprimé ave succès.", 'success');
                    $tr.find('td').fadeOut(1000,function(){ $tr.remove(); });
                    location.reload(); 
                }).fail(function(){
                    swal('Oops...', "Il ya quelque chose qui ne va pas ! Il se peut que cet utilisateur fait la coordiantion des cours il faut supprimer tout d'abord ses cours!", 'error');
                });
            });
            },
            allowOutsideClick: false     
        }); 
    });

    //delete budgets of session
    $(".table").on('click', '.delete-budget',function () {
        var id= $(this).data('id');
        var token = $('input[name="_token"]').val();
        var url = 'budgetsSession/'+id+'/delete';
        var $tr = $(this).closest('tr');
        swal({
            title: 'Etes-vous sûr ?',
            text: "Vous ne serez pas en mesure de rétablir ceci!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui, supprimer !',
            cancelButtonText: 'Annuler',
            showLoaderOnConfirm: true,
            preConfirm: function() {
            return new Promise(function(resolve) {
                $.ajax({
                    type: 'POST',
                    url:  url,
                    data: {
                        "id": id,
                        "_method": 'DELETE',
                        "_token": token,
                    },
                }).done(function(response){
                    swal('Supprimé!', "Les budgets de cette ont été supprimés ave succès.", 'success');
                    $tr.find('td').fadeOut(1000,function(){ $tr.remove(); });
                    location.reload(); 
                }).fail(function(){
                    swal('Oops...', "Il ya quelque chose qui ne va pas !", 'error');
                });
            });
            },
            allowOutsideClick: false     
        }); 
    });

    //delete participant 
    $(".table").on('click', '.delete-participant',function () {
        var id= $(this).data('id');
        var token = $('input[name="_token"]').val();
        var url = 'participants/'+id+'/delete';
        var $tr = $(this).closest('tr');
        swal({
            title: 'Etes-vous sûr ?',
            text: "Vous ne serez pas en mesure de rétablir ceci!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui, supprimer !',
            cancelButtonText: 'Annuler',
            showLoaderOnConfirm: true,
            preConfirm: function() {
            return new Promise(function(resolve) {
                $.ajax({
                    type: 'POST',
                    url:  url,
                    data: {
                        "id": id,
                        "_method": 'DELETE',
                        "_token": token,
                    },
                }).done(function(response){
                    swal('Supprimé!', "Le participant a été supprimés ave succès.", 'success');
                    $tr.find('td').fadeOut(1000,function(){ $tr.remove(); });
                    location.reload(); 
                }).fail(function(){
                    swal('Oops...', "Il ya quelque chose qui ne va pas ! il se peut que ce participant a une session en cours", 'error');
                });
            });
            },
            allowOutsideClick: false     
        }); 
    });

    

    
    ///********************************************************************************************
    //Add form prestataire
    $("#addPrestataire_modal").on("show.bs.modal", function(e) {
        $.get('prestataires/create' , function( data ) {
            $("#addPrestataire_modal .modal-body").html(data);
            validate()
            // $("#addPrestataireform").on('submit', function (e) {
            //     e.preventDefault()
            //     var token = $('input[name="_token"]').val();
            //     var route = 'prestataires'
            //     $.ajax({
            //         url: route, 
            //         headers : {'X-CSRF-TOKEN' : token},
            //         type: 'POST',
            //         dataType: 'json',
            //         data: {
            //             nom: $("input[name='nom']").val(),
            //             code: $("input[name='code']").val(),
            //             type: $("select[name='type']").val(),
            //             specialite: $("select[name='specialite']").val(),
            //             tel: $("input[name='tel']").val(),
            //             fax: $("input[name='fax']").val(),
            //             email: $("input[name='email']").val(),
            //             personne_contacter: $("input[name='personne_contacter']").val(),
            //             type_entreprise: $("input[name='type_entreprise']").val(),
            //             qualification: $("input[name='qualification']").val(),
            //             commentaire: $("textarea[name='commentaire']").val(),
            //         },
            //         success: function(data){
            //             $("#addPrestataire_modal").modal('toggle')
            //             $(".prestataire.alert-success").fadeTo(2000, 1000).fadeOut(2000, function(){
            //                 $(this).fadeOut(2000);
            //             });
            //             location.reload();
            //         },
            //         error: function(data){
            //             $(".prestataire.alert-danger").toggle();
            //             var errorString = '<ul>';
            //             $.each(data.responseJSON, function( key, value) {
            //                 errorString += '<li>' + value + '</li>';
            //             })
            //             errorString += '</ul>';
            //             $(".prestataire.alert-danger").html(errorString);
            //         }
            //     });
            // });
        });
    });

    //add prestataire in modal

    //show prestataire in modal
    $(".showPrestataire").on("click", function(e) {
        var id= $(this).data('id')
        var route = 'prestataires/'+ id 
        $.get(route, function(data){
            $("#showPrestataire_modal .modal-body").html(data);
        });
    });

    //show edit form prestataire in modal
    $(".editPrestataire").on("click", function(e) {
        var id= $(this).data('id')
        var route = 'prestataires/'+ id + '/edit'
        $.get(route , function( data ) {
            $("#editPrestataire_modal .modal-body").html(data);
            validate();
        });
    });
    ///********************************************************************************************
    //cours add form
    $("#addCours_modal").on("show.bs.modal", function(e) {
        $.get('cours/create' , function( data ) {
            $("#addCours_modal .modal-body").html(data);
            validate();
        });
    });

    //show cours in modal
    $(".showCours").on("click", function(e) {
        var id= $(this).data('id')
        var route = 'cours/'+ id 
        $.get(route, function(data){
            $("#showCours_modal .modal-body").html(data);
        });
    });

    //show edit form prestataire in modal
    $(".editCours").on("click", function(e) {
        var id= $(this).data('id')
        var route = 'cours/'+ id + '/edit'
        $.get(route , function( data ) {
            $("#editCours_modal .modal-body").html(data);
            validate();
        });
    });
    ///********************************************************************************************
    //salles add form
    $("#addSalle_modal").on("show.bs.modal", function(e) {
        $.get('salles/create' , function( data ) {
            $("#addSalle_modal .modal-body").html(data);
            validate();
        });
    });

    //show salles in modal
    $(".showSalle").on("click", function(e) {
        var id= $(this).data('id')
        var route = 'salles/'+ id 
        $.get(route, function(data){
            $("#showSalle_modal .modal-body").html(data);
        });
    });

    //show edit form prestataire in modal
    $(".editSalle").on("click", function(e) {
        var id= $(this).data('id')
        var route = 'salles/'+ id + '/edit'
        $.get(route , function( data ) {
            $("#editSalle_modal .modal-body").html(data);
            validate();
        });
    });
    ///********************************************************************************************
    //formateurs add form
    $("#addFormateur_modal").on("show.bs.modal", function(e) {
        $.get('formateurs/create' , function( data ) {
            $("#addFormateur_modal .modal-body").html(data);
            validate();
        });
    });

    $("#formateur_modal").on("show.bs.modal", function(e) {
        $.get('formateurs/create' , function( data ) {
            $("#formateur_modal .modal-body").html(data);
            validate();
        });
    });

    //show formateurs in modal
    $(".showFormateur").on("click", function(e) {
        var id= $(this).data('id')
        var route = 'formateurs/'+ id 
        $.get(route, function(data){
            $("#showFormateur_modal .modal-body").html(data);
        });
    });

    //show edit form prestataire in modal
    $(".editFormateur").on("click", function(e) {
        var id= $(this).data('id')
        var route = 'formateurs/'+ id + '/edit'
        $.get(route , function( data ) {
            $("#editFormateur_modal .modal-body").html(data);
            validate();
        });
    });
    ///********************************************************************************************
    //participants add form
    $("#participant_modal").on("show.bs.modal", function(e) {
        $.get('participants/create' , function( data ) {
            $("#participant_modal .modal-body").html(data);
            validate();
        });
    });

    ///********************************************************************************************
    //session add form
    $("#addSession_modal").on("show.bs.modal", function(e) {
        $.get('sessions/create' , function( data ) {
            $("#addSession_modal .modal-body").html(data);
            validate();
            select2();
            demo.initFormExtendedDatetimepickers();
        });
    });
    //show session in modal
    $(".showSession").on("click", function(e) {
        var id= $(this).data('id')
        var route = 'sessions/'+ id 
        $.get(route, function(data){
            $("#showSession_modal .modal-body").html(data);
        });
    });

    //show edit form session in modal
    $(".editSession").on("click", function(e) {
        var id= $(this).data('id')
        var route = 'sessions/'+ id + '/edit'
        $.get(route , function( data ) {
            $("#editSession_modal .modal-body").html(data);
            validate();
            select2();
            demo.initFormExtendedDatetimepickers();
        });
    });
    ///********************************************************************************************
    //budget add form
    $("#addBudget_modal" ).on('shown.bs.modal', function(event){
        $.get('budgets/create' , function( data ) {
            $("#addBudget_modal .modal-body").html(data);
            $('#sessionsList option[value="'+ $(event.relatedTarget).data('id') +'"]').prop('selected', true)
            addLine();
            validate();
        });
    });
    //show budget in modal
    $(".showBudget").on("click", function(e) {
        var id= $(this).data('id')
        var route = 'budgetsSession/'+ id 
        $.get(route, function(data){
            $("#showBudget_modal .modal-body").html(data);
        });
    });

    //show edit form budget in modal
    $(".editBudget").on("click", function(e) {
        var id= $(this).data('id')
        var route = 'budgetsSession/'+ id + '/edit'
        $.get(route , function( data ) {
            $("#editBudget_modal .modal-body").html(data);
            addLine();
            validate();
        });
    });
    ///********************************************************************************************
    //evaluation add form
    $("#addEvaluation_modal" ).on('shown.bs.modal', function(event){
        $.get('evaluations/create' , function( data ) {
            $("#addEvaluation_modal .modal-body").html(data);
            validate();
        });
    });

    //show edit form evaluation in modal
    $(".editEvaluation").on("click", function(e) {
        var id= $(this).data('id')
        var route = 'evaluations/'+ id + '/edit'
        $.get(route , function( data ) {
            $("#editEvaluation_modal .modal-body").html(data);
            validate();
        });
    });
    ///********************************************************************************************
    //questionnaire add form
    $("#addQuestionnaire_modal" ).on('shown.bs.modal', function(event){
        $.get('questions/create' , function( data ) {
            $("#addQuestionnaire_modal .modal-body").html(data);
            $('#evaluationsList option[value="'+ $(event.relatedTarget).data('id') +'"]').prop('selected', true)
            addLine();
            validate();
        });
    });
    //show edit form questionnaire in modal
    $(".editQuestionnaire").on("click", function(e) {
        var id= $(this).data('id')
        var route = 'questionnaire/'+ id + '/edit'
        $.get(route , function( data ) {
            $("#editQuestionnaire_modal .modal-body").html(data);
            addLine();
            validate();
        });
    });
    //show questionnaire in modal
    $(".showQuestionnaire").on("click", function(e) {
        var id= $(this).data('id')
        var route = 'questionnaire/'+ id
        $.get(route , function( data ) {
            $("#showQuestionnaire_modal .modal-body").html(data);
        });
    });
    ///********************************************************************************************
    //user add form
    $("#addUser_modal" ).on('shown.bs.modal', function(event){
        $.get('utilisateurs/create' , function( data ) {
            $("#addUser_modal .modal-body").html(data);
            validate();
        });
    });
    //show edit form user in modal
    $(".editUser").on("click", function(e) {
        var id= $(this).data('id')
        var route = 'utilisateurs/'+ id + '/edit'
        $.get(route , function( data ) {
            $("#editUser_modal .modal-body").html(data);
            validate();
        });
    });
    ///********************************************************************************************
    //role add form
    $("#addRole_modal" ).on('shown.bs.modal', function(event){
        $.get('roles/create' , function( data ) {
            $("#addRole_modal .modal-body").html(data);
            validate();
            //$("input:checkbox[name='permissions']").bootstrapSwitch();
        });
    });
    //show edit form role in modal
    $(".editRole").on("click", function(e) {
        var id= $(this).data('id')
        var route = 'roles/'+ id + '/edit'
        $.get(route , function( data ) {
            $("#editRole_modal .modal-body").html(data);
            validate();
        });
    });
    ///********************************************************************************************
    //permissions add form
    $("#addPermission_modal" ).on('shown.bs.modal', function(event){
        $.get('permissions/create' , function( data ) {
            $("#addPermission_modal .modal-body").html(data);
            validate();
        });
    });
    //show edit form Permissions in modal
    $(".editPermission").on("click", function(e) {
        var id= $(this).data('id')
        var route = 'permissions/'+ id + '/edit'
        $.get(route , function( data ) {
            $("#editPermission_modal .modal-body").html(data);
            validate();
        });
    });



});

