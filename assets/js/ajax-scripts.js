window.addEventListener( 'DOMContentLoaded', function() {
    $refresh_button = document.getElementById( 'sab-refresh-data' );
    if ( $refresh_button ){
        $refresh_button.addEventListener( 'click', async function(e) {
            e.preventDefault();

            jQuery.ajax({
                url: sab_ajax_object.ajax_url,
                data: {
                    'action': 'refresh_api_data',
                },
                beforeSend: function() {
                    jQuery( '.lds-roller' ).show();
                },
                success: function( data ) {                            
                    for( let i = 1; i <= 5; i++ ) {
                        jQuery( '.id-' + i ).html( data.data.data.rows[i].id ); 
                        jQuery( '.fname-' + i ).html( data.data.data.rows[i].fname );
                        jQuery( '.lname-' + i ).html( data.data.data.rows[i].lname );
                        jQuery( '.email-' + i ).html( data.data.data.rows[i].email );
                        jQuery( '.date-' + i ).html( data.data.data.rows[i].date );
                    }
                },
                error: function( errorThrown ) {
                    console.log( errorThrown );
                },
                complete: function() {
                    jQuery( '.lds-roller' ).hide();
                }
            });
        })
    }
})
