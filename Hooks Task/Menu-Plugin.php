<?php
/*
 * Plugin Name: Menu Plugin
 * Plugin URI: https://demowordpress/plugins/Menu-Plugin/Menu-Plugin.php
 * Description: It is a simple Emain like Plugiin.
 * Version: 1.0.0
 * Author: Deependra
 * Author URI: https://deepench.com
 * License:GPLv2 or later
 * Text Domain:Menu-Plugin
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class EmailPlugin
{

    public function __construct()
    {

        $this->init();
    }
    public function init()
    {
        add_action('admin_menu', array($this, 'addMenu'));
        add_action('admin_init', array($this, 'savesetting'));
        add_filter('email_message_updates', array($this, 'EmailFilter'), 10, 1);
        add_action('mp_send_email', array($this, 'sendMyemail'), 10, 2);
    }
    public function addMenu()
    {
        add_menu_page(
            'EmailPlugin',
            'Mail',
            'manage_options',
            'Email-Plugin',
            array($this, 'EmailTemplate'),
            'dashicons-wordpress-alt',
            10
        );

        add_submenu_page(
            'Email-Plugin',
            'SendMAil',
            'Send Email',
            'manage_options',
            'send-email',
            array($this, 'EmailTemplate_subpage')
        );
    }

    public function EmailTemplate()
    {
?>
        <div>
            <h1><?php echo "Hello Welcome to the Email Plugin <br><br> Thank YOU " ?></h1>
        </div>
    <?php
    }

    public function EmailTemplate_subpage()
    {
    ?>
        <div>
            <form method="POST">
                <div class="row">
                    <label for=""><?php esc_html_e('Email Subject'); ?></label>
                    <input type="text" name="email-subject" placeholder="Enter your Email Subject">
                </div>
                <br>
                <br>
                <div class="row">
                    <label for=""><?php esc_html_e('Email-content'); ?></label>
                    <textarea name="email-content" id="" cols="30" rows="10"></textarea>

                </div>
                <input type="submit" name="submit" value="send">

            </form>
        </div>

<?php



    }
    public function savesetting()
    {
        if (isset($_POST['submit'])) {
            $emailSubject
                = apply_filters('email_message_update', sanitize_text_field($_POST['email-subject']));
            $emailContent =
                apply_filters('email_message_updates', sanitize_textarea_field($_POST['email-content']));



            echo $emailSubject;
            echo '<br><br>';
            echo $emailContent;
            echo '<br><br>';
            do_action('mp_send_email', $emailSubject, $emailContent);
        }
    }


    public function EmailFilter($content)
    {
        $content = 'Hy My name is Deependra';
        return $content;
    }

    public function sendMyEmail($emailSubject, $emailContent)
    {
        wp_mail(
            'jakokynob@zetmail.com',
            $emailSubject,
            $emailContent
        );
    }
}
$emailPlugin = new EmailPlugin();
