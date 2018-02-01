$(window).on('load', function() {
    $('.spinner-wp').fadeOut()
});
$(function() {

    var baseUrl =  $("base").attr("href")

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

    $('#addRole_modal').appendTo("body");
    $('#editRole_modal').appendTo("body");
    $('#addPermission_modal').appendTo("body");
    $('#editPermission_modal').appendTo("body");
    
    $('[data-toggle="tooltip"]').tooltip();

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
        var url = baseUrl+'/evaluations/'+id+'/delete';
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
        var url = baseUrl+'/cours/'+id+'/delete';
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
        var url = baseUrl+'/salles/'+id+'/delete';
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
        var url = baseUrl+'/prestataires/'+id+'/delete';
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
        var url = baseUrl+'/formateurs/'+id+'/delete';
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
        var url = baseUrl+'/sessions/'+id+'/delete';
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
        var url = baseUrl+'/utilisateurs/'+id+'/delete';
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
        var url = baseUrl+'/budgetsSession/'+id+'/delete';
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
        var url = baseUrl+'/participants/'+id+'/delete';
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

    //delete role 
    $(".table").on('click', '.delete-role',function () {
        var id= $(this).data('id');
        var token = $('input[name="_token"]').val();
        var url = baseUrl+'/utilisateurs/roles/'+id+'/delete';
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
                    swal('Supprimé!', "Le rôle a été supprimés ave succès.", 'success');
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



});

