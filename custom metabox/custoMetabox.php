<?php



class EmailMetabox
{

    public function __construct()
    {
        add_action('add_meta_boxes', function () {
            add_meta_box(
                '_mycustommetabox',
                'Fill Your Person Details',
                array($this, 'email_custom_metabox'),
                'post'
            );
        });
        add_action('save_post', array($this, 'email_save_post'));
        add_action('comment_form_before', array($this, 'show_email_custom_metabox'));
    }
    public function email_custom_metabox($post)
    {
        $_mymetabox = get_post_meta(get_the_ID(), 'my_name', true) ? get_post_meta($post->ID, 'my_name', true) : '';
        $_myselectmetabox = get_post_meta($post->ID, '_selectbox', true) ? get_post_meta($post->ID, '_selectbox', true) : '';
        $_mytextareametabox = get_post_meta($post->ID, '_textareabox', true) ? get_post_meta($post->ID, '_textareabox', true) : '';
?>
        <div class="my_box">
            <style scoped>
                .my_box {
                    display: grid;
                    grid-template-columns: max-content 1fr;
                    grid-row-gap: 10px;
                    grid-column-gap: 20px;
                }

                .my_field {
                    display: contents;
                }
            </style>
            <p class="meta-options my_field">
                <label for="my_name">Name</label>
                <input id="my_name" type="text" name="my_name" value="<?php echo $_mymetabox  ?>">
            </p>
            <p class="meta-options my_field">
                <label for="hcf_published_date">Published Date</label>
                <select name="_selectbox" id="">
                    <option value="1" <?php echo $_myselectmetabox == 1 ? 'selected' : '' ?>>Male</option>
                    <option value="2" <?php echo $_myselectmetabox == 2 ? 'selected' : '' ?>>Female</option>
                    <option value="3" <?php echo $_myselectmetabox == 3 ? 'selected' : '' ?>>Other</option>
                </select>
            </p>
            <p class="meta-options my_field">
                <label for="hcf_price">Description</label>
                <textarea name="_textareabox" id="" cols="30" rows="10"><?php echo $_mytextareametabox ?></textarea>
            </p>
        </div>
    <?php
    }



    public function email_save_post($post_id)
    {
        $fields = [
            'my_name',
            '_selectbox',
            '_textareabox',
        ];
        foreach ($fields as $field) {
            if (array_key_exists($field, $_POST)) {
                update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
            }
        }
        // if (array_key_exists('_mymetabox', $_POST) && array_key_exists('_selectbox', $_POST) && array_key_exists('_textareabox', $_POST)) {
        //     update_post_meta($post_id, '_mymetabox', $_POST['_mymetabox']);
        //     update_post_meta($post_id, '_myselectmetabox', $_POST['_selectbox']);
        //     update_post_meta($post_id, '_mytextareametabox', $_POST['_textareabox']);
        // }
        //  if ($post->post_type == 'post') {
        // if (isset($_POST['meta'])) {
        //     foreach ($_POST['meta'] as $key => $value) {
        //         update_post_meta($post_id, $key, $value);
        //     }
        // }
        // }
    }
    public function show_email_custom_metabox()
    {
    ?>
        <ul style="border:1px solid" padding:5px>
            <li><strong>Name: </strong><?php echo esc_attr(get_post_meta(get_the_ID(), 'my_name', true)); ?></li>
            <li><strong>Gender: </strong><?php echo esc_attr(get_post_meta(get_the_ID(), '_selectbox', true)); ?></li>
            <li><strong>Description: </strong><?php echo esc_attr(get_post_meta(get_the_ID(), '_textareabox', true)); ?></li>
        </ul>
<?php
    }
}

$emailmetabox = new EmailMetabox();

