jQuery(document).ready(function () {

    jQuery( '#user_form' ).submit(function (event) {
        event.preventDefault();//prevents from autoloading

        // Get the user's Input Value
        var email = jQuery( '#email' ).val();
        var password = jQuery( '#password' ).val();
        var username = jQuery( '#username' ).val();
        var displayname = jQuery( '#displayname' ).val();
        var firstname = jQuery( '#firstname' ).val();
        var lastname = jQuery( '#lastname' ).val();
        var role = jQuery( '#role' ).val();

        // Validate the  input field if it is empty
        if ( email.length == '' ) {
            jQuery( "#p1" ).text( "Please Enter the email" );
            jQuery( '#email' ).focus();
            return false;
        } else if ( password.length == '' ) {
            jQuery( "#p2" ).text( "Please Enter the password" );
            jQuery( '#password' ).focus();
            return false;
        }
        else if (username.length == '') {
            jQuery( "#p3" ).text( "Please Enter the password" );
            jQuery( '#username' ).focus();
            return false;
        }
        else if ( displayname.length == '' ) {
            jQuery( "#p4" ).text( "Please Enter the password" );
            jQuery( '#displayname' ).focus();
            return false;
        }
        else if ( firstname.length == '' ) {
            jQuery( "#p5" ).text( "Please Enter the " );
            jQuery( '#firstname' ).focus();
            return false;
        }
        else if ( lastname.length == '' ) {
            jQuery( "#p6" ).text( "Please Enter the lastname" );
            jQuery( '#lastname' ).focus();
            return false;
        }
        else if ( password.length == '' ) {
            jQuery( "#p7" ).text( "Please Enter the role" );
            jQuery( '#role' ).focus();
            return false;
        }
    // Intializing the ajax 
        jQuery.ajax({
            url: myAjax.ajaxurl,
            type: "post",
            data: {
                action: 'my_user_form',
                efp_email: email,
                efp_password: password,
                efp_username: username,
                efp_displayname: displayname,
                efp_firstname: firstname,
                efp_lastname: lastname,
                efp_role: role,
                security: myAjax.my_script_nonce
            },
            success: function (res) {
                // callback message 
                if ( res.data.type == 'success' ) {
                    
                    alert( res.data.message );

                } else {
                    alert( res.data.message );
                }

            }
        })




    });


});
