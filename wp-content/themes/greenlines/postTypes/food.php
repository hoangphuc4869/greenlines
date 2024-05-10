<?php
function custom_food()
{
    register_post_type('food', [
        'label' => __('Foods', 'txtdomain'),
        'public' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-food',
        'supports' => ['title', 'editor', 'thumbnail', 'author', 'revisions', 'comments', 'excerpt', 'custom-fields', 'post-formats', 'page-attributes', 'trackbacks'],
        'show_in_rest' => true,
        'rewrite' => ['slug' => 'food'],
        'taxonomies' => ['category-food'],
        'labels' => [
            'singular_name' => __('food', 'txtdomain'),
            'add_new_item' => __('Add new food', 'txtdomain'),
            'new_item' => __('New food', 'txtdomain'),
            'view_item' => __('View food', 'txtdomain'),
            'not_found' => __('No food found', 'txtdomain'),
            'not_found_in_trash' => __('No food found in trash', 'txtdomain'),
            'all_items' => __('All food', 'txtdomain'),
            'insert_into_item' => __('Insert into food', 'txtdomain')
        ],
    ]);

    // category

    register_taxonomy('category-food', ['food'], [
        'label' => __('Category food', 'txtdomain'),
        'hierarchical' => true,
        'rewrite' => ['slug' => 'category-food'],
        'show_admin_column' => true,
        'show_in_rest' => true,
        'labels' => [
            'singular_name' => __('category-food', 'txtdomain'),
            'all_items' => __('All category-food', 'txtdomain'),
            'edit_item' => __('Edit category-food', 'txtdomain'),
            'view_item' => __('View category-food', 'txtdomain'),
            'update_item' => __('Update category-food', 'txtdomain'),
            'add_new_item' => __('Add New category food', 'txtdomain'),
            'new_item_name' => __('New category-food Name', 'txtdomain'),
            'search_items' => __('Search category-food', 'txtdomain'),
            'parent_item' => __('Parent category food', 'txtdomain'),
            'parent_item_colon' => __('Parent category-food:', 'txtdomain'),
            'not_found' => __('No category-food found', 'txtdomain'),
        ],
    ]);
    register_taxonomy_for_object_type('category-food', 'food');
}



add_action('restrict_manage_posts', 'tsm_filter_food_type_by_taxonomy');
function tsm_filter_food_type_by_taxonomy() {
	global $typenow;
	$post_type = 'food'; 
	$taxonomy  = 'category-food'; 
	if ($typenow == $post_type) {
		$selected      = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
		$info_taxonomy = get_taxonomy($taxonomy);
		wp_dropdown_categories(array(
			'show_option_all' => sprintf( __( 'Show all %s', 'textdomain' ), $info_taxonomy->label ),
			'taxonomy'        => $taxonomy,
			'name'            => $taxonomy,
			'orderby'         => 'name',
			'selected'        => $selected,
			'show_count'      => true,
			'hide_empty'      => true,
		));
	};
}
/**
 * Filter posts by taxonomy in admin
 * @author  Mike Hemberger
 * @link http://thestizmedia.com/custom-post-type-filter-admin-custom-taxonomy/
 */
add_filter('parse_query', 'tsm_convert_id_to_term_in_query_food');
function tsm_convert_id_to_term_in_query_food($query) {
	global $pagenow;
	$post_type = 'food'; // post type
	$taxonomy  = 'category-food'; // taxonomy
	$q_vars    = &$query->query_vars;
	if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0 ) {
		$term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
		$q_vars[$taxonomy] = $term->slug;
	}
}