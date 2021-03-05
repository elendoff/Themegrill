<?php
class customMoviePost
{
    public function __construct()
    {
        add_action('init', array($this, 'deependra_movie_post'));
        add_action('admin_init', array($this, 'my_movie_detail_meta'));
        add_action('save_post', array($this, 'add_movie_detail_fields'));
    }

    public function deependra_movie_post()
    {
        register_post_type('movie_detail', array(
            'labels' => array(
                'name' => 'Movie Details',
                'singular_name' => 'Movie Details',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Movie Title'

            ),
            'public' => true,
            'menu-position' => 15,
            'supports' => array('title', 'editor', 'comments', 'thumbnail', 'custom-fields'),
            'taxonomy' => 'fruit',
            'has_archive' => true

        ));
        register_taxonomy('fruit', ['movie_detail'], array(
            'labels' => array(
                'name' => 'Fruit',
                'search_items' => 'Search Fruit Category',
                'add_new_item' => 'Add New Fruit'
            ),
            'hierarchical' => true,
            'show_ui' => true,
            'query_var' => true,
        ));
    }

    public function my_movie_detail_meta()
    {
        add_meta_box('movie_detail_meta_box', 'Movie Details', array($this, 'display_movie_detail_meta_box'), 'movie_detail', 'normal', 'high');
    }

    public function display_movie_detail_meta_box($movie_detail)
    {
        $movie_display_details = get_post_meta($movie_detail->ID, 'custom_movie_detail_meta', true);
        $movie_detail_release_date = esc_html($movie_display_details['movie_detail_release_date']);
        $movie_detail_director_name = esc_html($movie_display_details['movie_detail_director_name']);
        $movie_detail_cast_name = esc_html($movie_display_details['movie_detail_cast_name']);

?>
        <table>
            <tr>
                <td style="width: 100%">Movie Release Date</td>
                <td><input type="text" size="80" name="movie_detail_release_date" value="<?php echo $movie_detail_release_date; ?>" /></td>
            </tr>
            <tr>
                <td style="width: 100%">Movie Director</td>
                <td><input type="text" size="80" name="movie_detail_director_name" value="<?php echo $movie_detail_director_name; ?>" /></td>
            </tr>
            <tr>
                <td style="width: 100%">Movie Cast</td>
                <td><input type="text" size="80" name="movie_detail_cast_name" value="<?php echo $movie_detail_cast_name; ?>" /></td>
            </tr>
        </table>
<?php
    }

    public function add_movie_detail_fields($movie_detail_id)
    {
        $fields = array(
            'movie_detail_release_date' => isset($_POST['movie_detail_release_date']) ? $_POST['movie_detail_release_date'] : '',

            'movie_detail_director_name' => isset($_POST['movie_detail_director_name']) ? $_POST['movie_detail_director_name'] : '',

            'movie_detail_cast_name' => isset($_POST['movie_detail_cast_name']) ? $_POST['movie_detail_cast_name'] : '',
        );

        // error_log(print_r($fields, true));
        // foreach ($fields as  $field) {
        update_post_meta($movie_detail_id, 'custom_movie_detail_meta', $fields);
        // }
    }
}

$customMoviePost = new customMoviePost();
