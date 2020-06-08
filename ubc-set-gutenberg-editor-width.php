<?php
/**
 * UBC Set Gutenberg Editor Width
 *
 * @package           WordPress
 * @author            Rich Tape
 * @copyright         2020 Rich Tape
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       UBC Set Gutenberg Editor Width
 * Plugin URI:        https://ctlt.ubc.ca
 * Description:       Allows site admins to control the width of the gutenberg editor so that it can match what is shown on the front-end of the site (on larger screens)
 * Version:           0.1.0
 * Requires at least: 5.2
 * Requires PHP:      5.6
 * Author:            Rich Tape
 * Author URI:        https://ctlt.ubc.ca
 * Text Domain:       ubc-set-gutenberg-editor-width
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

add_action( 'admin_init', 'ubc_set_gutenberg_editor_width_settings_field' );

/**
 * Register and add our setting section and field.
 *
 * @return void
 */
function ubc_set_gutenberg_editor_width_settings_field() {

	$args = array(
		'type'              => 'string',
		'sanitize_callback' => 'ubc_set_gutenberg_editor_width_sanitiztion',
		'default'           => '1320px',
	);

	/* Register Settings */
	register_setting(
		'writing',
		'ubc-gutenberg-editor-width',
		$args
	);

	/* Create settings section */
	add_settings_section(
		'ubc-gutenberg-editor-width',
		'Content Editor Width',
		'ubc_set_gutenberg_editor_description',
		'writing'
	);

	/* Create settings field */
	add_settings_field(
		'ubc-gutenberg-editor-width',
		'Gutenberg Editor Width',
		'ubc_set_gutenberg_editor_width_input',
		'writing',
		'ubc-gutenberg-editor-width'
	);
}//end ubc_set_gutenberg_editor_width_settings_field()

/**
 * Sanitize the gutenberg content editor width field.
 *
 * @param string $input The passed content width.
 * @return bool
 */
function ubc_set_gutenberg_editor_width_sanitiztion( $input ) {
	return esc_html( $input );
}//end ubc_set_gutenberg_editor_width_sanitiztion()

/**
 * Setting description text.
 *
 * @return void
 */
function ubc_set_gutenberg_editor_description() {

}//end ubc_set_gutenberg_editor_description()


/**
 * The actual input field.
 *
 * @return void
 */
function ubc_set_gutenberg_editor_width_input() {
	?>
	<label for="ubc-gutenberg-editor-width">
		<input id="ubc-gutenberg-editor-width" type="text" value="<?php echo esc_html( get_option( 'ubc-gutenberg-editor-width', true ) ); ?>" name="ubc-gutenberg-editor-width"> <?php esc_html_e( 'Set the width in px or em to match that of your desktop max size view.' ); ?>
	</label>
	<?php
}

add_action( 'admin_head', 'ubc_gutenberg_editor_width_set_editor_width' );

/**
 * Adjust the width of the content editor based on the setting saved in settings > writing.
 *
 * @return void
 */
function ubc_gutenberg_editor_width_set_editor_width() {

	$editor_width = esc_html( get_option( 'ubc-gutenberg-editor-width', true ) );

	echo "
	<style>
		.wp-block {
			max-width: " . esc_html( $editor_width ) . ";
		}
  	</style>";

}//end ubc_gutenberg_editor_width_set_editor_width()
