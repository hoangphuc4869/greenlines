<?php
function custom_combo()
{
    register_post_type('combo', [
        'label' => __('Combos', 'txtdomain'),
        'public' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-tag',
        'supports' => ['title', 'editor', 'thumbnail', 'author', 'revisions', 'comments', 'excerpt', 'custom-fields', 'post-formats', 'page-attributes', 'trackbacks'],
        'show_in_rest' => true,
        'rewrite' => ['slug' => 'combo'],
        'taxonomies' => ['category-combo'],
        'labels' => [
            'singular_name' => __('combo', 'txtdomain'),
            'add_new_item' => __('Add new combo', 'txtdomain'),
            'new_item' => __('New combo', 'txtdomain'),
            'view_item' => __('View combo', 'txtdomain'),
            'not_found' => __('No combo found', 'txtdomain'),
            'not_found_in_trash' => __('No combo found in trash', 'txtdomain'),
            'all_items' => __('All combo', 'txtdomain'),
            'insert_into_item' => __('Insert into combo', 'txtdomain')
        ],
    ]);

    // category

    register_taxonomy('category-combo', ['combo'], [
        'label' => __('Category combo', 'txtdomain'),
        'hierarchical' => true,
        'rewrite' => ['slug' => 'category-combo'],
        'show_admin_column' => true,
        'show_in_rest' => true,
        'labels' => [
            'singular_name' => __('category-combo', 'txtdomain'),
            'all_items' => __('All category-combo', 'txtdomain'),
            'edit_item' => __('Edit category-combo', 'txtdomain'),
            'view_item' => __('View category-combo', 'txtdomain'),
            'update_item' => __('Update category-combo', 'txtdomain'),
            'add_new_item' => __('Add New category combo', 'txtdomain'),
            'new_item_name' => __('New category-combo Name', 'txtdomain'),
            'search_items' => __('Search category-combo', 'txtdomain'),
            'parent_item' => __('Parent category combo', 'txtdomain'),
            'parent_item_colon' => __('Parent category-combo:', 'txtdomain'),
            'not_found' => __('No category-combo found', 'txtdomain'),
        ],
    ]);
    register_taxonomy_for_object_type('category-combo', 'combo');
}



add_action('restrict_manage_posts', 'tsm_filter_combo_type_by_taxonomy');
function tsm_filter_combo_type_by_taxonomy() {
	global $typenow;
	$post_type = 'combo'; 
	$taxonomy  = 'category-combo'; 
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
add_filter('parse_query', 'tsm_convert_id_to_term_in_query_combo');
function tsm_convert_id_to_term_in_query_combo($query) {
	global $pagenow;
	$post_type = 'combo'; // post type
	$taxonomy  = 'category-combo'; // taxonomy
	$q_vars    = &$query->query_vars;
	if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0 ) {
		$term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
		$q_vars[$taxonomy] = $term->slug;
	}
}