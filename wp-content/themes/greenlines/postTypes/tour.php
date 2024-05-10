<?php
function custom_tour()
{
    register_post_type('tour', [
        'label' => __('Tours', 'txtdomain'),
        'public' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-feedback',
        'supports' => ['title', 'editor', 'thumbnail', 'author', 'revisions', 'comments', 'excerpt', 'custom-fields', 'post-formats', 'page-attributes', 'trackbacks'],
        'show_in_rest' => true,
        'rewrite' => ['slug' => 'tour'],
        'taxonomies' => ['category-tour'],
        'labels' => [
            'singular_name' => __('tour', 'txtdomain'),
            'add_new_item' => __('Add new tour', 'txtdomain'),
            'new_item' => __('New tour', 'txtdomain'),
            'view_item' => __('View tour', 'txtdomain'),
            'not_found' => __('No tour found', 'txtdomain'),
            'not_found_in_trash' => __('No tour found in trash', 'txtdomain'),
            'all_items' => __('All tour', 'txtdomain'),
            'insert_into_item' => __('Insert into tour', 'txtdomain')
        ],
    ]);

    // category

    register_taxonomy('category-tour', ['tour'], [
        'label' => __('Category tour', 'txtdomain'),
        'hierarchical' => true,
        'rewrite' => ['slug' => 'category-tour'],
        'show_admin_column' => true,
        'show_in_rest' => true,
        'labels' => [
            'singular_name' => __('category-tour', 'txtdomain'),
            'all_items' => __('All category-tour', 'txtdomain'),
            'edit_item' => __('Edit category-tour', 'txtdomain'),
            'view_item' => __('View category-tour', 'txtdomain'),
            'update_item' => __('Update category-tour', 'txtdomain'),
            'add_new_item' => __('Add New category tour', 'txtdomain'),
            'new_item_name' => __('New category-tour Name', 'txtdomain'),
            'search_items' => __('Search category-tour', 'txtdomain'),
            'parent_item' => __('Parent category tour', 'txtdomain'),
            'parent_item_colon' => __('Parent category-tour:', 'txtdomain'),
            'not_found' => __('No category-tour found', 'txtdomain'),
        ],
    ]);
    register_taxonomy_for_object_type('category-tour', 'tour');
}



add_action('restrict_manage_posts', 'tsm_filter_tour_type_by_taxonomy');
function tsm_filter_tour_type_by_taxonomy() {
	global $typenow;
	$post_type = 'tour'; 
	$taxonomy  = 'category-tour'; 
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
add_filter('parse_query', 'tsm_convert_id_to_term_in_query_tour');
function tsm_convert_id_to_term_in_query_tour($query) {
	global $pagenow;
	$post_type = 'tour'; // post type
	$taxonomy  = 'category-tour'; // taxonomy
	$q_vars    = &$query->query_vars;
	if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0 ) {
		$term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
		$q_vars[$taxonomy] = $term->slug;
	}
}