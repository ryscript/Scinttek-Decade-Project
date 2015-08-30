<?php

// pretty useless without this
if ( ! function_exists( 'wp_nav_menu' ) )
	return false;

/**
 * Tack on the blank option for urls not in the menu
 */
add_filter( 'wp_nav_menu_items', 'dropdown_add_blank_item', 10, 2 );
function dropdown_add_blank_item( $items, $args ) {
	if ( isset( $args->walker ) && is_object( $args->walker ) && method_exists( $args->walker, 'is_dropdown' ) ) {
		if ( ( ! isset( $args->menu ) || empty( $args->menu ) ) && isset( $args->theme_location ) ) {
			$theme_locations = get_nav_menu_locations();
			$args->menu = wp_get_nav_menu_object( $theme_locations[ $args->theme_location ] );
		}
		$title = isset( $args->dropdown_title ) ? wptexturize( $args->dropdown_title ) : '&mdash; ' . $args->menu->name . ' &mdash;';
		if ( ! empty( $title ) )
			$items = '<option value="" class="blank">' . apply_filters( 'dropdown_blank_item_text', $title, $args ) . '</option>' . $items;
	}
	return $items;
}


/**
 * Remove empty options created in the sub levels output
 */
add_filter( 'wp_nav_menu_items', 'dropdown_remove_empty_items', 10, 2 );
function dropdown_remove_empty_items( $items, $args ) {
	if ( isset( $args->walker ) && is_object( $args->walker ) && method_exists( $args->walker, 'is_dropdown' ) )
		$items = str_replace( "<option></option>", "", $items );
	return $items;
}	
	
	
/**
 * @desc	Overrides the walker argument and container argument then calls wp_nav_menu
 */
function rs_dropdown_menu( $args ) {
	// enforce these arguments so it actually works
	$args[ 'walker' ] = new Walker_Nav_Menu_Dropdown();
	$args[ 'items_wrap' ] = '<select name="mobile-menu" id="%1$s" class="%2$s menu-pages">%3$s</select>';

	// custom args for controlling indentation of sub menu items
	$args[ 'indent_string' ] = isset( $args[ 'indent_string' ] ) ? $args[ 'indent_string' ] : '&ndash;&nbsp;';
	$args[ 'indent_after' ] =  isset( $args[ 'indent_after' ] ) ? $args[ 'indent_after' ] : '';

	wp_nav_menu( $args );
}

/**
 * @desc Create our walker menu
 * This is for responsive layout and small screen devices
 */
class Walker_Nav_Menu_Dropdown extends Walker_Nav_Menu {

	// easy way to check it's this walker we're using to mod the output
	function is_dropdown() {
		return true;
	}

	/**
	 * @see Walker::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 */
	function start_lvl( &$output, $depth ) {
		$output .= "</option>";
	}

	/**
	 * @see Walker::end_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 */
	function end_lvl( &$output, $depth ) {
		$output .= "<option>";
	}

	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param int $current_page Menu item ID.
	 * @param object $args
	 */
	function start_el( &$output, $item, $depth, $args ) {
		global $wp_query;
		
		// return none if no menu is selected
		if( ! is_object( $args ) )
			return false;
		
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		$classes[] = 'menu-item-depth-' . $depth;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_unique( array_filter( $classes ) ), $item, $args ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		// select current item
		$selected = in_array( 'current-menu-item', $classes ) ? ' selected="selected"' : '';

		$output .= $indent . '<option' . $class_names .' value="'. $item->url .'"'. $selected .'>';

		// push sub-menu items in as we can't nest optgroups
		$indent_string = str_repeat( apply_filters( 'dropdown_menus_indent_string', $args->indent_string, $item, $depth, $args ), ( $depth ) ? $depth : 0 );
		$indent_string .= !empty( $indent_string ) ? apply_filters( 'dropdown_menus_indent_after', $args->indent_after, $item, $depth, $args ) : '';

		$item_output = $args->before . $indent_string;
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_dropdown_start_el', $item_output, $item, $depth, $args );
	}

	/**
	 * @see Walker::end_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Page data object. Not used.
	 * @param int $depth Depth of page. Not Used.
	 */
	function end_el( &$output, $item, $depth ) {
		$output .= apply_filters( 'walker_nav_menu_dropdown_end_el', "</option>\n", $item, $depth);
	}
	
}
	
?>