<?php
add_action( 'init', 'bq_testmonials_init' );
/**
 * Register a testmonial post type.
 *
 * @link http://bq.wordpress.org/Function_Reference/register_post_type
 */
function bq_testmonials_init() {
	$labels = array(
		'name'               => _x( 'Testmonials', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Testmonial', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Testmonials', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Testmonial', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'testmonial', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Testmonial', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Testmonial', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit Testmonial', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View Testmonials', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All Testmonials', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search Testmonials', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Testmonials:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No testmonials found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No testmonials found in Trash.', 'your-plugin-textdomain' )
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'testmonial' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields' )
	);

	register_post_type( 'testmonial', $args );
}


add_filter( 'post_updated_messages', 'bq_testmonials_updated_messages' );
/**
 * Slider update messages.
 *
 * See /wp-admin/edit-form-advanced.php
 *
 * @param array $messages Existing post update messages.
 *
 * @return array Amended post update messages with new CPT update messages.
 */
function bq_testmonials_updated_messages( $messages ) {
	$post             = get_post();
	$post_type        = get_post_type( $post );
	$post_type_object = get_post_type_object( $post_type );

	$messages['testmonial'] = array(
		0  => '', // Unused. Messages start at index 1.
		1  => __( 'Slider updated.', 'your-plugin-textdomain' ),
		2  => __( 'Custom field updated.', 'your-plugin-textdomain' ),
		3  => __( 'Custom field deleted.', 'your-plugin-textdomain' ),
		4  => __( 'Testmonial updated.', 'your-plugin-textdomain' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Slider restored to revision from %s', 'your-plugin-textdomain' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6  => __( 'Testmonial published.', 'your-plugin-textdomain' ),
		7  => __( 'Testmonial saved.', 'your-plugin-textdomain' ),
		8  => __( 'Testmonial submitted.', 'your-plugin-textdomain' ),
		9  => sprintf(
			__( 'Testmonial scheduled for: <strong>%1$s</strong>.', 'your-plugin-textdomain' ),
			// translators: Publish box date format, see http://php.net/date
			date_i18n( __( 'M j, Y @ G:i', 'your-plugin-textdomain' ), strtotime( $post->post_date ) )
		),
		10 => __( 'Slider draft updated.', 'your-plugin-textdomain' )
	);

	if ( $post_type_object->publicly_queryable ) {
		$permalink = get_permalink( $post->ID );

		$view_link = sprintf( ' <a href="%s">%s</a>', esc_url( $permalink ), __( 'View testmonial', 'your-plugin-textdomain' ) );
		$messages[ $post_type ][1] .= $view_link;
		$messages[ $post_type ][6] .= $view_link;
		$messages[ $post_type ][9] .= $view_link;

		$preview_permalink = add_query_arg( 'preview', 'true', $permalink );
		$preview_link = sprintf( ' <a target="_blank" href="%s">%s</a>', esc_url( $preview_permalink ), __( 'Preview Testmonial', 'your-plugin-textdomain' ) );
		$messages[ $post_type ][8]  .= $preview_link;
		$messages[ $post_type ][10] .= $preview_link;
	}

	return $messages;
}


//display contextual help for Sliders

function bq_testmonial_add_help_text( $contextual_help, $screen_id, $screen ) {
  //$contextual_help .= var_dump( $screen ); // use this to help determine $screen->id
  if ( 'testmonial' == $screen->id ) {
    $contextual_help =
      '<p>' . __('Things to remember when adding or editing a testmonial:', 'your_text_domain') . '</p>' .
      '<ul>' .
      '<li>' . __('Specify the correct genre such as Mystery, or Historic.', 'your_text_domain') . '</li>' .
      '<li>' . __('Specify the correct writer of the testmonial.  Remember that the Author module refers to you, the author of this testmonial review.', 'your_text_domain') . '</li>' .
      '</ul>' .
      '<p>' . __('If you want to schedule the testmonial review to be published in the future:', 'your_text_domain') . '</p>' .
      '<ul>' .
      '<li>' . __('Under the Publish module, click on the Edit link next to Publish.', 'your_text_domain') . '</li>' .
      '<li>' . __('Change the date to the date to actual publish this article, then click on Ok.', 'your_text_domain') . '</li>' .
      '</ul>' .
      '<p><strong>' . __('For more information:', 'your_text_domain') . '</strong></p>' .
      '<p>' . __('<a href="http://bq.wordpress.org/Posts_Edit_SubPanel" target="_blank">Edit Posts Documentation</a>', 'your_text_domain') . '</p>' .
      '<p>' . __('<a href="http://wordpress.org/support/" target="_blank">Support Forums</a>', 'your_text_domain') . '</p>' ;
  } elseif ( 'edit-testmonial' == $screen->id ) {
    $contextual_help =
      '<p>' . __('This is the help screen displaying the table of testmonials blah blah blah.', 'your_text_domain') . '</p>' ;
  }
  return $contextual_help;
}
add_action( 'contextual_help', 'bq_testmonial_add_help_text', 10, 3 );


// Adding WordPress 3.3+ Help Tab: 

function bq_testmonial_custom_help_tab() {

  $screen = get_current_screen();

  // Return early if we're not on the testmonial post type.
  if ( 'testmonial' != $screen->post_type )
    return;

  // Setup help tab args.
  $args = array(
    'id'      => 'you_custom_id', //unique id for the tab
    'title'   => 'Custom Help', //unique visible title for the tab
    'content' => '<h3>Help Title</h3><p>Help content</p>',  //actual help text
  );
  
  // Add the help tab.
  $screen->add_help_tab( $args );

}

add_action('admin_head', 'bq_testmonial_custom_help_tab');