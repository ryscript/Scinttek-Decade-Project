<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
 */
 
if ( file_exists( dirname( __FILE__ ) . '/meta/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/meta/init.php';
}
 
/**
 * Conditionally displays a metabox when used as a callback in the 'show_on_cb' cmb_box parameter
 *
 * @param  CMB object $cmb CMB2 object
 *
 * @return bool             True if metabox should show
 */
function rs_theme_show_if_front_page( $cmb ) {
	// Don't show this metabox if it's the front page template
	if ( $cmb->object_id !== get_option( 'page_on_front' ) ) {
		return false;
	}
	return true;
}

function rs_theme_show_if_full_width( $cmb ) {
	// Show this metabox if it's full width
	if( 'page-templates/template-fullwidth.php'  == get_page_template_slug( $cmb->object_id ) ) {
		return true;
	}
	
	return false;
}

/**
 * Conditionally displays a field when used as a callback in the 'show_on_cb' field parameter
 *
 * @param  CMB2_Field object $field Field object
 *
 * @return bool                     True if metabox should show
 */
function rs_hide_if_no_cats( $field ) {
	// Don't show this field if not in the cats category
	if ( ! has_tag( 'cats', $field->object_id ) ) {
		return false;
	}
	return true;
}


add_action( 'cmb2_init', 'casanova_theme_register_metabox' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_init' hook.
 */
function casanova_theme_register_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_cmb_';
	
	$post_page_metabox = new_cmb2_box( array(
		'id'            => $prefix . 'post-page-meta',
		'title'         => __( 'Post/Page Settings', 'cmb2' ),
		'object_types'  => array( 'post', 'page' ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
	) );
	
		$post_page_metabox->add_field( array(
			'name' => __( 'Hide Title', 'cmb2' ),
			'desc' => __( 'This simply hide post or page title in front-end area.', 'cmb2' ),
			'id'   => $prefix . 'hide_title',
			'type' => 'checkbox'
		) );
}


function cmb2_taxonomy_meta_initiate() {

    //require_once( 'CMB2/init.php' );
    require_once( THEME_DIR.'/lib/metabox/Taxonomy_MetaData/Taxonomy_MetaData_CMB2.php' );
	
	// (Recommended) Use wp-large-options
    require_once( THEME_DIR.'/lib/metabox/wp-large-options/wp-large-options.php' );
	
    /**
     * Semi-standard CMB2 metabox/fields array
     */
    $meta_box = array(
        'id'         => 'cat_options',
        // 'key' and 'value' should be exactly as follows
        'show_on'    => array( 'key' => 'options-page', 'value' => array( 'unknown', ), ),
        'show_names' => true, // Show field names on the left
        'fields'     => array(
            array(
                'name' => __( 'Category Featured Image', 'taxonomy-metadata' ),
                'desc' => __( 'This will be use in front-end display.', 'taxonomy-metadata' ),
                'id'   => 'category_featured_image', // no prefix needed since the options are one option array.
                'type' => 'file',
            )
		)
    );

	// wp-large-options
    $overrides = array(
        'get_option'    => 'wlo_get_option',
        'update_option' => 'wlo_update_option',
        'delete_option' => 'wlo_delete_option',
    );

    /**
     * Instantiate our taxonomy meta class
     */
    $cats = new Taxonomy_MetaData_CMB2( 'pa_heading', $meta_box, __( 'Category Settings', 'taxonomy-metadata' ), $overrides );
}

cmb2_taxonomy_meta_initiate();