
$().ready(function() {

    // Add new Line
    $(".addLine").click(function(event){
        event.preventDefault()
        var copy = $('#budgets-wrap').find(".form-group:first").clone()
        copy.find('input').val('')
        copy.find('button').toggleClass('addLine deleteLine')
        copy.find('button>i').toggleClass('fa-plus fa-minus')
        var uid = uuidv4()
        $.each(copy.find('input'), function(){
            var name = $(this).attr('name')
            $(this).attr('name', name.replace('[0]', '['+uid+']'))
        })
        $('#budgets-wrap').append(copy)
    })
    $('#budgets-wrap').on('click', '.deleteLine', function(){
        $(this).closest('.form-group').remove();
    });

    // Add new Line
    $(".addLine").click(function(event){
        event.preventDefault()
        var copy = $('#questions-wrap').find(".form-group:first").clone()
        copy.find('input').val('')
        copy.find('button').toggleClass('addLine deleteLine')
        copy.find('button>i').toggleClass('fa-plus fa-minus')
        var uid = uuidv4()
        $.each(copy.find('input'), function(){
            var name = $(this).attr('name')
            $(this).attr('name', name.replace('[0]', '['+uid+']'))
        })
        $('#questions-wrap').append(copy)
    })
    $('#questions-wrap').on('click', '.deleteLine', function(){
        $(this).closest('.form-group').remove();
    });



    function uuidv4() {
        return ([1e7]+-1e3).replace(/[018]/g, c =>
            (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16)
        )
    }


    $('.js-example-basic-multiple').select2({
        multiple: true,
        width: "100%",
        'placeholder':'Selectionnez',
    });


    $('#formateur_modal').appendTo("body");
    $('#participant_modal').appendTo("body");
    $('#questionnaire_modal').appendTo("body");
    $('[data-toggle="tooltip"]').tooltip();

    $('#datatables').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "Tous"]
        ],
        responsive: true,
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Recherche ...",
            "paginate": {
                "first":      "Premier",
                "last":       "Dernier",
                "next":       "Suivant",
                "previous":   "Précedent"
            },
            "lengthMenu":     "Affichage _MENU_ entrées",
            "zeroRecords":    "Aucun resultat trouvée !",
            "emptyTable":     "Aucune donnée dans la table",
            "info":           "Affichage _START_ à _END_ du _TOTAL_ entrées",
            "infoEmpty":      "Affichage 0 à 0 du 0 entrées",
        },

    });


    var table = $('#datatables').DataTable();

    // Edit record
    table.on('click', '.edit', function() {
        $tr = $(this).closest('tr');

        var data = table.row($tr).data();
        //alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
    });

    // Delete a record
    table.on('click', '.remove', function(e) {
        $tr = $(this).closest('tr');
        table.row($tr).remove().draw();
        e.preventDefault();
    });

    //Like record
    table.on('click', '.like', function() {
        alert('You clicked on Like button');
    });

    $('.card .material-datatables label').addClass('form-group');

        demo.checkFullPageBackgroundImage();
        setTimeout(function() {
            // after 1000 ms we add the class animated to the login/register card
            $('.card').removeClass('card-hidden');
        }, 700)
    });
    demo.initFormExtendedDatetimepickers();

    var MAX_OPTIONS = 30;
    $('#surveyForm').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            question: {
                validators: {
                    notEmpty: {
                        message: 'The question required and cannot be empty'
                    }
                }
            },
            'option[]': {
                validators: {
                    notEmpty: {
                        message: 'The option required and cannot be empty'
                    },
                    stringLength: {
                        max: 100,
                        message: 'The option must be less than 100 characters long'
                    }
                }
            }
        }
    })

    // Add button click handler
    .on('click', '.addButton', function() {
        var $template = $('#optionTemplate'),
            $clone    = $template
                            .clone()
                            .removeClass('hide')
                            .removeAttr('id')
                            .insertBefore($template),
            $option   = $clone.find('[name="option[]"]');

        // Add new field
        $('#surveyForm').bootstrapValidator('addField', $option);
    })

    // Remove button click handler
    .on('click', '.removeButton', function() {
        var $row    = $(this).parents('.form-group'),
            $option = $row.find('[name="option[]"]');

        // Remove element containing the option
        $row.remove();

        // Remove field
        $('#surveyForm').bootstrapValidator('removeField', $option);
    })

    // Called after adding new field
    .on('added.field.bv', function(e, data) {
        // data.field   --> The field name
        // data.element --> The new field element
        // data.options --> The new field options

        if (data.field === 'option[]') {
            if ($('#surveyForm').find(':visible[name="option[]"]').length >= MAX_OPTIONS) {
                $('#surveyForm').find('.addButton').attr('disabled', 'disabled');
            }
        }
    })

    // Called after removing the field
    .on('removed.field.bv', function(e, data) {
       if (data.field === 'option[]') {
            if ($('#surveyForm').find(':visible[name="option[]"]').length < MAX_OPTIONS) {
                $('#surveyForm').find('.addButton').removeAttr('disabled');
            }
        }
    });


    $('.realise').keyup(function(){
        var prevu = parseInt($(".prevu").val());
        var realise = parseInt($(".realise").val());
        if($('.realise').val().length === 0){
            $('.ajustement').val(0);  
        }else{
            $('.ajustement').val(prevu - realise);  
        }
    });