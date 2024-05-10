<?php
function custom_tickets()
{
    register_post_type('tickets', [
        'label' => __('Tickets', 'txtdomain'),
        'public' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-tickets',
        'supports' => ['title', 'editor', 'thumbnail', 'author', 'revisions', 'comments', 'excerpt', 'custom-fields', 'post-formats', 'page-attributes', 'trackbacks'],
        'show_in_rest' => true,
        'rewrite' => ['slug' => 'tickets'],
        'taxonomies' => ['category-tickets'],
        'labels' => [
            'singular_name' => __('ticket', 'txtdomain'),
            'add_new_item' => __('Add new tickets', 'txtdomain'),
            'new_item' => __('New tickets', 'txtdomain'),
            'view_item' => __('View tickets', 'txtdomain'),
            'not_found' => __('No tickets found', 'txtdomain'),
            'not_found_in_trash' => __('No tickets found in trash', 'txtdomain'),
            'all_items' => __('All tickets', 'txtdomain'),
            'insert_into_item' => __('Insert into tickets', 'txtdomain')
        ],
    ]);

    // category

    register_taxonomy('category-tickets', ['tickets'], [
        'label' => __('Category tickets', 'txtdomain'),
        'hierarchical' => true,
        'rewrite' => ['slug' => 'category-tickets'],
        'show_admin_column' => true,
        'show_in_rest' => true,
        'labels' => [
            'singular_name' => __('category-tickets', 'txtdomain'),
            'all_items' => __('All category-tickets', 'txtdomain'),
            'edit_item' => __('Edit category-tickets', 'txtdomain'),
            'view_item' => __('View category-tickets', 'txtdomain'),
            'update_item' => __('Update category-tickets', 'txtdomain'),
            'add_new_item' => __('Add New category tickets', 'txtdomain'),
            'new_item_name' => __('New category-tickets Name', 'txtdomain'),
            'search_items' => __('Search category-tickets', 'txtdomain'),
            'parent_item' => __('Parent category tickets', 'txtdomain'),
            'parent_item_colon' => __('Parent category-tickets:', 'txtdomain'),
            'not_found' => __('No category-tickets found', 'txtdomain'),
        ],
    ]);
    register_taxonomy_for_object_type('category-tickets', 'tickets');
}



add_action('restrict_manage_posts', 'tsm_filter_post_type_by_taxonomy');
function tsm_filter_post_type_by_taxonomy() {
	global $typenow;
	$post_type = 'tickets'; 
	$taxonomy  = 'category-tickets'; 
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
add_filter('parse_query', 'tsm_convert_id_to_term_in_query');
function tsm_convert_id_to_term_in_query($query) {
	global $pagenow;
	$post_type = 'tickets'; // post type
	$taxonomy  = 'category-tickets'; // taxonomy
	$q_vars    = &$query->query_vars;
	if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0 ) {
		$term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
		$q_vars[$taxonomy] = $term->slug;
	}
}