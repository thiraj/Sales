jQuery( document ).ready( function( $ ) {

    $( '#profile_edit' ).on( 'submit', function(e) {
        e.preventDefault();

        data:new FormData($("#profile_edit")[0]),


        $.ajax({
            type: "POST",
            url: '/edit_profile',
            dataType:'json',
            data:data,
            processData: false,
            contentType: false
        }).done(function( msg ) {

            console.log( msg );
        });

    });
});