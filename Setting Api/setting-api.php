<?php
/*
 * Plugin Name: Setting Api
 * Plugin URI: https://demowordpress/plugins/hello-world
 * Description: How to use the setting api .
 * Version: 1.0.0
 * Author: Deependra
 * Author URI: https://deepench.com
 * Text Domain: setting-api
*/

class setting_api_plugin
{

    public function __construct()
    {
        add_action('admin_menu', array($this, 'addMenu'));
        add_action('admin_init', array($this, 'addMenu_process_form_setting'));
    }



    public function addMenu()
    {

        add_options_page(
            'Detail',
            'Detail',
            'manage_options',
            'detali_setting',
            array($this, 'detail_setting_func')
        );
    }

    public function addMenu_process_form_setting()
    {
        register_setting('studentPlugin', 'wpplugin_settings');
        add_settings_section(
            'wpplugin_setting_section',
            __('', 'wordpress'),
            array($this, 'wpsettings_section_callback'),
            'studentInfo'
        );
        add_settings_field(
            'wpplugin_settings_custom_text',
            __('Name', 'wordpress'),
            array($this, 'wpplugin_setting_custom_text_callback'),
            'studentInfo',
            'wpplugin_setting_section'
        );

        add_settings_field(
            'wpplugin_settings_textarea',
            __('Description', 'wordpress'),
            array($this, 'wpplugin_settings_textarea_callback'),
            'studentInfo',
            'wpplugin_setting_section'
        );

        add_settings_field(
            'wpplugin_settings_checkbox',
            __('Education', 'wordpress'),
            array($this, 'wpplugin_settings_checkbox_callback'),
            'studentInfo',
            'wpplugin_setting_section',
            [
                'option_one' => 'School',
                'option_two' => 'College'
            ]
        );
        add_settings_field(
            'wpplugin_settings_radio',
            __('Gender', 'wordpress'),
            array($this, 'wpplugin_settings_radio_callback'),
            'studentInfo',
            'wpplugin_setting_section',
            [
                'option_one' => 'Male',
                'option_two' => 'Female'
            ]
        );
        add_settings_field(
            'wpplugin_settings_select',
            __('Role', 'wordpress'),
            array($this, 'wpplugin_settings_select_callback'),
            'studentInfo',
            'wpplugin_setting_section',
            [
                'option_one' => 'Student',
                'option_two' => 'Teacher',
                'option_three' => 'Principal'
            ]
        );
    }

    public function wpplugin_setting_custom_text_callback()
    {
        $options = get_option('wpplugin_settings');
        $custom_text = '';
        if (isset($options['custom_text'])) {
            $custom_text = esc_html($options['custom_text']);
        }

        echo '<input type="text" id="wpplugin_customtext" name="wpplugin_settings[custom_text]" value="' . $custom_text . '" />';
    }

    public function wpplugin_settings_textarea_callback()
    {

        $options = get_option('wpplugin_settings');

        $textarea = '';
        if (isset($options['textarea'])) {
            $textarea = esc_html($options['textarea']);
        }
        echo '<textarea name="wpplugin_settings[textarea]" rows="5" cols="50">' . $textarea . '</textarea>';
    }

    public  function wpplugin_settings_checkbox_callback($args)
    {

        $options = get_option('wpplugin_settings');

        $checkbox = '';
        if (isset($options['checkbox'])) {
            $checkbox = esc_html($options['checkbox']);
        }

        $html = '<input type="checkbox"  name="wpplugin_settings[radio]" value="1"' . checked(1, $checkbox, false) . '/>';
        $html .= ' <label for="wpplugin_settings_checkbox_one">' . $args['option_one'] . '</label> &nbsp;';
        $html .= '<input type="checkbox" id="wpplugin_settings_checkbox_two" name="wpplugin_settings[checkbox]" value="2"' . checked(2, $checkbox, false) . '/>';
        $html .= ' <label for="wpplugin_settings_checkbox_two">' . $args['option_two'] . '</label>';

        echo $html;
    }

    public function wpplugin_settings_radio_callback($args)
    {

        $options = get_option('wpplugin_settings');

        $radio = '';
        if (isset($options['radio'])) {
            $radio = esc_html($options['radio']);
        }

        $html = '<input type="radio" id="wpplugin_settings_radio_one" name="wpplugin_settings[radio]" value="1"' . checked(1, $radio, false) . '/>';
        $html .= ' <label for="wpplugin_settings_radio_one">' . $args['option_one'] . '</label> &nbsp;';
        $html .= '<input type="radio" id="wpplugin_settings_radio_two" name="wpplugin_settings[radio]" value="2"' . checked(2, $radio, false) . '/>';
        $html .= ' <label for="wpplugin_settings_radio_two">' . $args['option_two'] . '</label>';

        echo $html;
    }

    function wpplugin_settings_select_callback($args)
    {

        $options = get_option('wpplugin_settings');

        $select = '';
        if (isset($options['select'])) {
            $select = esc_html($options['select']);
        }

        $html = '<select id="wpplugin_settings_options" name="wpplugin_settings[select]">';

        $html .= '<option value="option_one"' . selected($select, 'option_one', false) . '>' . $args['option_one'] . '</option>';
        $html .= '<option value="option_two"' . selected($select, 'option_two', false) . '>' . $args['option_two'] . '</option>';
        $html .= '<option value="option_three"' . selected($select, 'option_three', false) . '>' . $args['option_three'] . '</option>';

        $html .= '</select>';

        echo $html;
    }

    public function wpsettings_section_callback()
    {
        echo __('<h2>Please fill the Information</h2>', 'wordpress');
    }

    public function detail_setting_func()
    {
?>
        <form action='options.php' method='post'>

            <?php
            settings_fields('studentPlugin');
            do_settings_sections('studentInfo');
            submit_button();
            ?>

        </form>
<?php
    }
}

$settingapiplugin = new setting_api_plugin();
