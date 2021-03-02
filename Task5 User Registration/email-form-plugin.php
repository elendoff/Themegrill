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
    }

    public function email_form_plugin()
    {
        ob_start();
        include('ef-email-form.php');
        return ob_get_clean();
    }
  
}
$emailformPlugin = new EmailFormPlugin();
