jQuery( document ).ready( function( $ ) {

    // Profile Edit Form Submission
    $( '#profile_edit' ).on( 'submit', function(e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // data:new FormData($("#profile_edit")[0]),


        var datastring = new FormData($(this)[0]);

        $.ajax({
            type: "POST",
            url: '/edit_profile',
            // dataType:'json',
            data:datastring,
            processData: false,
            contentType: false

        }).done(function( result ) {

            var result = result;

            if(result == 1){

                $('#success').modal('show');

            }else{

                $('#error').modal('show');
            }

        });

    });


    // New Agent Form Submission
    $( '#agentForm' ).on( 'submit', function(e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#agent_submit_area").hide();


        var datastring = $('#agentForm').serialize();

        $.ajax({
            type: "POST",
            url: '/new_agent',
            data:datastring,
            // processData: false,
            // contentType: false

        }).done(function( result ) {

            var result = result;

            if(result == 1){

                $("#agentForm").reset();
                $('#success').modal('show');
                $("#agent_submit_area").show();


            }else{

                $('#error').modal('show');
                $("#agent_submit_area").show();
            }

        });

    });




    // New Performance Form Submission
    $( '#performanceForm' ).on( 'submit', function(e) {
        e.preventDefault();

        $("#performance_submit").hide();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });



        var datastring = $('#performanceForm').serialize();

        $.ajax({
            type: "POST",
            url: '/new_performance',
            data:datastring,


        }).done(function( result ) {

            var result = result;

            if(result == 1){

                $('#success').modal('show');
                $("#performance_submit").show();
                $('#performanceForm').reset();

            }else{

                $('#error').modal('show');
                $('#performanceForm').reset();
                $("#performance_submit").show();
            }

        });

    });
    
    
    // New User Form Submission
    $( '#userForm' ).on( 'submit', function(e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });



        var datastring = $('#userForm').serialize();

        $.ajax({
            type: "POST",
            url: '/new_user',
            data:datastring,
            // processData: false,
            // contentType: false

        }).done(function( result ) {

            var result = result;

            if(result == 1){

                $('#success').modal('show');

            }else{

                $('#error').modal('show');
            }

        });

    });



    // New Complain Form Submission
    $( '#complainForm' ).on( 'submit', function(e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });



        var datastring = $('#complainForm').serialize();

        $.ajax({
            type: "get",
            url: '/new_complain',
            data:datastring,


        }).done(function( result ) {

            var result = result;

            if(result == 1){

                $('#success').modal('show');

            }else{

                $('#error').modal('show');
            }

        });

    });

    

});


   