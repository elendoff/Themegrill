<?php
/*
 * Plugin Name: Email Plugin
 * Plugin URI: https://demowordpress/plugins/email-form-plugin/email-form-plugin.php
 * Description: It is a simple Email form like Plugiin.
 * Version: 1.0.0
 * Author: Deependra
 * Author URI: https://deepench.com
 * License:GPLv2 or later
 * Text Domain:email-form-Plugin
*/


class EmailFormPlugin
{
    public function __construct()
    {
        $this->init();
    }
    public function init()
    {
        add_shortcode('email_form', array($this, 'email_form_plugin'));
        add_action('init', array($this, 'my_script_enqueuer'));
        add_action("wp_ajax_my_user_form", array($this, 'load_my_user_form'));
        // add_action("wp_ajax_nopriv_my_script_vote", array($this, 'my_must_login'));
    }

    public function email_form_plugin()
    {
        ob_start();
        include('ef-email-form.php');
        return ob_get_clean();
    }


    public function my_script_enqueuer()
    {
        wp_register_script("my_script", plugin_dir_url(__FILE__) . 'assets/main.js', array('jquery'), '1.0.0', true);
        wp_localize_script('my_script', 'myAjax', array('ajaxurl' => admin_url('admin-ajax.php'), 'my_script_nonce' => wp_create_nonce('my_script_form_nonce')));
        wp_enqueue_script('jquery');
        wp_enqueue_script('my_script');
    }

    public function load_my_user_form()
    {
        // if (!wp_verify_nonce($_REQUEST['nonce'], "my_script_form_nonce")) {
        //     exit("No naughty business please");
        // }
        if (!check_ajax_referer('my_script_form_nonce', 'security', false)) {
            wp_send_json_error(
                array(
                    'message' => __('Nonce error, please reload.', 'user-registration'),
                )
            );
        }
        $email = sanitize_email($_POST['email']);
        $password = sanitize_text_field($_POST['password']);
        $username = sanitize_user($_POST['username']);
        $displayname = sanitize_text_field($_POST['displayname']);
        $firstname = sanitize_text_field($_POST['firstname']);
        $lastname = sanitize_text_field($_POST['lastname']);
        $role = sanitize_text_field($_POST['role']);
        $user = wp_insert_user(array(
            'user_email' => $email,
            'user_pass' => $password,
            'user_login' => $username,
            'display_name' => $displayname,
            'first_name' => $firstname,
            'last_name' => $lastname,
            'role' => $role,
        ));
        if (!is_wp_error($user)) {
            add_user_meta($user, 'deepen', 'deepen');
            wp_send_json_success(array('message' => 'form is inserted successfully ', 'type' => 'success'));
        } else {
            wp_send_json_success(array('message' => 'form is not inserted successfully ', 'type' => 'error'));
        }
    }
}
$emailformPlugin = new EmailFormPlugin();
