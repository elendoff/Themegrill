<?php
/*
 * Plugin Name: Email Plugin
 * Plugin URI: https://demowordpress/plugins/email-form-plugin/email-form-plugin.php
 * Description: It is a simple Email form like Plugiin.
 * Version: 1.0.0
 * Author: Deependra
 * Author URI: https://deepench.com
 * License:GPLv2 or later
 * Text Domain:email-form-plugin
 * Domain Path: /languages
*/
if ( !defined( 'ABSPATH')
) {
    exit; // Exit if accessed directly.
  }

if ( !class_exists( 'EmailFormPlugin' ) ) :

    /**
	 * Main EmailFormPlufin Class.
	 *
	 * @class   UserRegistration
	 * @version 1.0.0
	 */

    class EmailFormPlugin
    {
        public function __construct()
        {
            $this->init(); 
        }

        /**
         * Hook into actions and filters.
         */
        public function init()
        {
            add_shortcode( 'email_form', array( $this, 'ur_email_form_plugin' ) );
            add_action( 'init', array( $this, 'my_script_enqueuer' ) );
            add_action( "wp_ajax_my_user_form", array( $this, 'efp_load_my_user_form' ) );
            add_filter( 'sucess_message_update', array( $this,'email_success_message_update'  ));  
        }

        /**
         * including a shortcode form
         */
        public function ur_email_form_plugin()
        {
            ob_start();
            include( 'ef-email-form.php' );
            return ob_get_clean();
        }
        /**
         * Registering the javascript for using ajax and including ajax file
         */
        public function my_script_enqueuer()
        {
            wp_register_script( "my_script", plugin_dir_url(__FILE__) . 'assets/main.js', array('jquery'), '1.0.0', true );
            wp_localize_script( 'my_script', 'myAjax', array( 'ajaxurl' => admin_url('admin-ajax.php'), 'my_script_nonce' => wp_create_nonce('my_script_form_nonce' ) ) );
            wp_enqueue_script( 'jquery' );
            wp_enqueue_script( 'my_script' );
        }

        /**
         * Checkig the Nonce for cross site request forgery
         * and sanitize the users input and submit into the database
         */
        public function efp_load_my_user_form()
        {
            if (!check_ajax_referer( 'my_script_form_nonce', 'security', false ) ) {
                wp_send_json_error(
                    array(
                        'message' => __( 'Nonce error, please reload.', 'email-form-plugin' ),
                    )
                );
            }
            $email = sanitize_email( isset($_POST['efp_email']) ? $_POST['efp_email'] : '' );
            $password = sanitize_text_field( isset( $_POST['efp_password'] ) ? $_POST['efp_password'] : '');
            $username = sanitize_user( isset( $_POST['efp_username'] ) ? $_POST['efp_username'] : '' );
            $displayname = sanitize_text_field( isset($_POST['efp_displayname'] ) ? $_POST['efp_displayname'] :'');
            $firstname = sanitize_text_field( isset($_POST['efp_firstname'] ) ? $_POST['efp_firstname'] : '' );
            $lastname = sanitize_text_field ( isset($_POST['efp_lastname'] ) ? $_POST['efp_lastname'] : '');
            $role = sanitize_text_field( isset( $_POST['efp_role'] ) ? $_POST['efp_role'] : '' );
                    if (empty($email)) {
                        echo "email is required";
                                        if (empty($password)) {
                                            echo "password is required";
                                        
                                        if (empty($username)) {
                                            echo "username is required";
                                        
                                        if (empty($displayname)) {
                                            echo "displayname is required";
                                        
                                        if (empty($firstname)) {
                                            echo "Firstname is required";
                                        
                                        if (empty($lastname)) {
                                            echo "lastname is required";
                                        
                                        if (empty($rorle)) {
                                            echo "role is required";
                                        }
                                    }
                                }
                            }
                        }
                    }
                 } else {
                            $user = wp_insert_user( array(
                                'user_email' => $email,
                                'user_pass' => $password,
                                'user_login' => $username,
                                'display_name' => $displayname,
                                'first_name' => $firstname,
                                'last_name' => $lastname,
                                'role' => $role,
                            ));
                            if ( !is_wp_error( $user ) ) {
                                add_user_meta( $user, 'deepen', 'deepen' );
                                $msg= __( 'Form is inserted succesfully', 'email-form-plugin' );
                                $msg=apply_filters( 'sucess_message_update', $msg );
                                 wp_send_json_success(array('message' => $msg, 'type' => 'success'));
                            } else {
                                    $msg = __( 'Form is not inserted succesfully', 'email-form-plugin' );
                                    $msg = apply_filters( 'sucess_message_update', $msg );
                                    wp_send_json_success( array( 'message' => $msg, 'type' => 'error' ) );
                            }
        }
    }
    /**
     * Filter is added to change the message accordinginly
     */
      public function email_success_message_update( $content )
        {
            $content = 'This message is updated sucessfully';
            return $content;
        }

     
    }
endif;
/** End Of the class */

/** Instance of class */
$emailformPlugin = new EmailFormPlugin();
