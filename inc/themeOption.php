<?php 
/**
 * Create A Simple Theme Options Panel
 *
 */
 
    


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start Class
if ( ! class_exists( 'anupranan_Theme_Options' ) ) {

	class anupranan_Theme_Options {

		/**
		 * Start things up
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			// We only need to register the admin panel on the back-end
			if ( is_admin() ) {
				add_action( 'admin_menu', array( 'anupranan_Theme_Options', 'add_admin_menu' ) );
				add_action( 'admin_init', array( 'anupranan_Theme_Options', 'register_settings' ) );
			}

		}

		/**
		 * Returns all theme options
		 *
		 * @since 1.0.0
		 */
		public static function get_theme_options() {
			return get_option( 'theme_options' );
		}

		/**
		 * Returns single theme option
		 *
		 * @since 1.0.0
		 */
		public static function get_theme_option( $id ) {
			$options = self::get_theme_options();
			if ( isset( $options[$id] ) ) {
				return $options[$id];
			}
		}

		/**
		 * Add sub menu page
		 *
		 * @since 1.0.0
		 */
		public static function add_admin_menu() {
			add_menu_page(
				esc_html__( 'Theme Settings', 'text-domain' ),
				esc_html__( 'Theme Settings', 'text-domain' ),
				'manage_options',
				'theme-settings',
				array( 'anupranan_Theme_Options', 'create_admin_page' )
			);
		}

		/**
		 * Register a setting and its sanitization callback.
		 *
		 * We are only registering 1 setting so we can store all options in a single option as
		 * an array. You could, however, register a new setting for each option
		 *
		 * @since 1.0.0
		 */
		public static function register_settings() {
			register_setting( 'theme_options', 'theme_options', array( 'anupranan_Theme_Options', 'sanitize' ) );
		}

		/**
		 * Sanitization callback
		 *
		 * @since 1.0.0
		 */
		public static function sanitize( $options ) {

			// If we have options lets sanitize them
			if ( $options ) {

				// Checkbox
				if ( ! empty( $options['checkbox_example'] ) ) {
					$options['checkbox_example'] = 'on';
				} else {
					unset( $options['checkbox_example'] ); // Remove from options if not checked
				}

				// Input
				if ( ! empty( $options['input_example'] ) ) {
					$options['input_example'] = sanitize_text_field( $options['input_example'] );
				} else {
					unset( $options['input_example'] ); // Remove from options if empty
				}

				// Select
				if ( ! empty( $options['select_example'] ) ) {
					$options['select_example'] = sanitize_text_field( $options['select_example'] );
				}

			}

			// Return sanitized options
			return $options;

		}

		/**
		 * Settings page output
		 *
		 * @since 1.0.0
		 */
		public static function create_admin_page() { 
                    
                    function currencyConverter($from_Currency,$to_Currency,$amount) {
                        $from_Currency = urlencode($from_Currency);
                        $to_Currency = urlencode($to_Currency);
                        $get = file_get_contents("https://finance.google.com/finance/converter?a=1&from=$from_Currency&to=$to_Currency");
                        $get = explode("<span class=bld>",$get);
                        $get = explode("</span>",$get[1]);
                        $converted_currency = preg_replace("/[^0-9\.]/", null, $get[0]);
                        return $converted_currency;
                    }
                    
                    // change amount according to your needs
                    $amount =1;
                    // change From Currency according to your needs
                    $from_Curr = "USD";
                    // change To Currency according to your needs
                    $to_Curr = "BDT";
                    $converted_currency=currencyConverter($from_Curr, $to_Curr, $amount);
                    // Print outout
                    echo $converted_currency;
                    
                    
                    ?>	

			<div class="wrap">

				<h1><?php esc_html_e( 'Theme Options', 'text-domain' ); ?></h1>

				<form method="post" action="options.php">

					<?php settings_fields( 'theme_options' ); ?>

					<table class="form-table wpex-custom-admin-login-table">
                                            <?php // Text input example ?>
                                            <tr valign="top">
                                                    <th scope="row"><?php esc_html_e( 'Logo Upload', 'text-domain' ); ?></th>
                                                    <td>
                                                        <?php $value = self::get_theme_option( 'logo' ); ?>
                                                        <input class="header_logo_url" type="text" name="theme_options[logo]" size="60" value="<?php echo esc_attr( $value ); ?>">
                                                        <a href="#" class="header_logo_upload button button-primary">Upload</a>
                                                    </td>
                                            </tr>
                                            <script>
                                                jQuery(document).ready(function($) {
                                                    $('.header_logo_upload').click(function(e) {
                                                        e.preventDefault();

                                                        var custom_uploader = wp.media({
                                                            title: 'Custom Image',
                                                            button: {
                                                                text: 'Upload Image'
                                                            },
                                                            multiple: false  // Set this to true to allow multiple files to be selected
                                                        })
                                                        .on('select', function() {
                                                            var attachment = custom_uploader.state().get('selection').first().toJSON();
                                                            $('.header_logo').attr('src', attachment.url);
                                                            $('.header_logo_url').val(attachment.url);

                                                        })
                                                        .open();
                                                    });
                                                });
                                            </script>
                                            <tr valign="top">
                                                    <th scope="row"><?php esc_html_e( 'Dollar Rate', 'text-domain' ); ?></th>
                                                    <td>
                                                            <?php $value = self::get_theme_option( 'dollarRate' ); ?>
                                                            <input type="text" name="theme_options[dollarRate]" value="<?php echo esc_attr( $value ); ?>">
                                                    </td>
                                            </tr>
                                            <tr valign="top">
                                                    <th scope="row"><?php esc_html_e( 'Footer logo Text', 'text-domain' ); ?></th>
                                                    <td>
                                                            <?php $value = self::get_theme_option( 'logo-text' ); ?>
                                                            <input type="text" name="theme_options[logo-text]" value="<?php echo esc_attr( $value ); ?>">
                                                    </td>
                                            </tr>
                                            <tr valign="top">
                                                    <th scope="row"><?php esc_html_e( 'Mobile', 'text-domain' ); ?></th>
                                                    <td>
                                                            <?php $value = self::get_theme_option( 'mobile' ); ?>
                                                            <input type="text" name="theme_options[mobile]" value="<?php echo esc_attr( $value ); ?>">
                                                    </td>
                                            </tr>
                                            <tr valign="top">
                                                <td>Social Links</td>
                                            </tr>
                                            <tr valign="top">
                                                    <th scope="row"><?php esc_html_e( 'Facebook', 'text-domain' ); ?></th>
                                                    <td>
                                                            <?php $value = self::get_theme_option( 'facebook' ); ?>
                                                            <input type="text" name="theme_options[facebook]" value="<?php echo esc_attr( $value ); ?>">
                                                    </td>
                                            </tr>
                                            <tr valign="top">
                                                    <th scope="row"><?php esc_html_e( 'Twitter', 'text-domain' ); ?></th>
                                                    <td>
                                                            <?php $value = self::get_theme_option( 'twitter' ); ?>
                                                            <input type="text" name="theme_options[twitter]" value="<?php echo esc_attr( $value ); ?>">
                                                    </td>
                                            </tr>
                                            <tr valign="top">
                                                    <th scope="row"><?php esc_html_e( 'Google +', 'text-domain' ); ?></th>
                                                    <td>
                                                            <?php $value = self::get_theme_option( 'googleplus' ); ?>
                                                            <input type="text" name="theme_options[googleplus]" value="<?php echo esc_attr( $value ); ?>">
                                                    </td>
                                            </tr>
                                            <tr valign="top">
                                                    <th scope="row"><?php esc_html_e( 'Linkin', 'text-domain' ); ?></th>
                                                    <td>
                                                            <?php $value = self::get_theme_option( 'linkin' ); ?>
                                                            <input type="text" name="theme_options[linkin]" value="<?php echo esc_attr( $value ); ?>">
                                                    </td>
                                            </tr>
                                            <tr valign="top">
                                                    <th scope="row"><?php esc_html_e( 'RSS', 'text-domain' ); ?></th>
                                                    <td>
                                                            <?php $value = self::get_theme_option( 'rss' ); ?>
                                                            <input type="text" name="theme_options[rss]" value="<?php echo esc_attr( $value ); ?>">
                                                    </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Payment 
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                    <th scope="row"><?php esc_html_e( 'Payment Text', 'text-domain' ); ?></th>
                                                    <td>
                                                            <?php $value = self::get_theme_option( 'paymentText' ); ?>
                                                            <input type="text" name="theme_options[paymentText]" value="<?php echo esc_attr( $value ); ?>">
                                                    </td>
                                            </tr>
                                            <tr valign="top">
                                                    <th scope="row"><?php esc_html_e( 'Payment Link Image-1', 'text-domain' ); ?></th>
                                                    <td>
                                                        <?php $value = self::get_theme_option( 'paymentlinkimage-1' ); ?>
                                                        <input class="paymentlinkimage-1_url" type="text" name="theme_options[paymentlinkimage-1]" size="60" value="<?php echo esc_attr( $value ); ?>">
                                                        <a href="#" class="paymentlinkimage-1 button button-primary">Upload</a>
                                                    </td>
                                            </tr>
                                            <script>
                                                jQuery(document).ready(function($) {
                                                    $('.paymentlinkimage-1').click(function(e) {
                                                        e.preventDefault();

                                                        var custom_uploader = wp.media({
                                                            title: 'Custom Image',
                                                            button: {
                                                                text: 'Upload Image'
                                                            },
                                                            multiple: false  // Set this to true to allow multiple files to be selected
                                                        })
                                                        .on('select', function() {
                                                            var attachment = custom_uploader.state().get('selection').first().toJSON();
                                                            $('.paymentlinkimage-1').attr('src', attachment.url);
                                                            $('.paymentlinkimage-1_url').val(attachment.url);

                                                        })
                                                        .open();
                                                    });
                                                });
                                            </script>
                                            <tr valign="top">
                                                    <th scope="row"><?php esc_html_e( 'Payment Link Image-2', 'text-domain' ); ?></th>
                                                    <td>
                                                        <?php $value = self::get_theme_option( 'paymentlinkimage-2' ); ?>
                                                        <input class="paymentlinkimage-2_url" type="text" name="theme_options[paymentlinkimage-2]" size="60" value="<?php echo esc_attr( $value ); ?>">
                                                        <a href="#" class="paymentlinkimage-2 button button-primary">Upload</a>
                                                    </td>
                                            </tr>
                                            <script>
                                                jQuery(document).ready(function($) {
                                                    $('.paymentlinkimage-2').click(function(e) {
                                                        e.preventDefault();

                                                        var custom_uploader = wp.media({
                                                            title: 'Custom Image',
                                                            button: {
                                                                text: 'Upload Image'
                                                            },
                                                            multiple: false  // Set this to true to allow multiple files to be selected
                                                        })
                                                        .on('select', function() {
                                                            var attachment = custom_uploader.state().get('selection').first().toJSON();
                                                            $('.paymentlinkimage-2').attr('src', attachment.url);
                                                            $('.paymentlinkimage-2_url').val(attachment.url);

                                                        })
                                                        .open();
                                                    });
                                                });
                                            </script>
                                            <tr valign="top">
                                                    <th scope="row"><?php esc_html_e( 'Payment Link Image-3', 'text-domain' ); ?></th>
                                                    <td>
                                                        <?php $value = self::get_theme_option( 'paymentlinkimage-3' ); ?>
                                                        <input class="paymentlinkimage-3_url" type="text" name="theme_options[paymentlinkimage-3]" size="60" value="<?php echo esc_attr( $value ); ?>">
                                                        <a href="#" class="paymentlinkimage-3 button button-primary">Upload</a>
                                                    </td>
                                            </tr>
                                            <script>
                                                jQuery(document).ready(function($) {
                                                    $('.paymentlinkimage-3').click(function(e) {
                                                        e.preventDefault();

                                                        var custom_uploader = wp.media({
                                                            title: 'Custom Image',
                                                            button: {
                                                                text: 'Upload Image'
                                                            },
                                                            multiple: false  // Set this to true to allow multiple files to be selected
                                                        })
                                                        .on('select', function() {
                                                            var attachment = custom_uploader.state().get('selection').first().toJSON();
                                                            $('.paymentlinkimage-3').attr('src', attachment.url);
                                                            $('.paymentlinkimage-3_url').val(attachment.url);

                                                        })
                                                        .open();
                                                    });
                                                });
                                            </script>
                                            <tr valign="top">
                                                    <th scope="row"><?php esc_html_e( 'Payment Link Image-4', 'text-domain' ); ?></th>
                                                    <td>
                                                        <?php $value = self::get_theme_option( 'paymentlinkimage-4' ); ?>
                                                        <input class="paymentlinkimage-4_url" type="text" name="theme_options[paymentlinkimage-4]" size="60" value="<?php echo esc_attr( $value ); ?>">
                                                        <a href="#" class="paymentlinkimage-4 button button-primary">Upload</a>
                                                    </td>
                                            </tr>
                                            <script>
                                                jQuery(document).ready(function($) {
                                                    $('.paymentlinkimage-4').click(function(e) {
                                                        e.preventDefault();

                                                        var custom_uploader = wp.media({
                                                            title: 'Custom Image',
                                                            button: {
                                                                text: 'Upload Image'
                                                            },
                                                            multiple: false  // Set this to true to allow multiple files to be selected
                                                        })
                                                        .on('select', function() {
                                                            var attachment = custom_uploader.state().get('selection').first().toJSON();
                                                            $('.paymentlinkimage-4').attr('src', attachment.url);
                                                            $('.paymentlinkimage-4_url').val(attachment.url);

                                                        })
                                                        .open();
                                                    });
                                                });
                                            </script>
                                            <tr valign="top">
                                                    <th scope="row"><?php esc_html_e( 'Payment Link Image-5', 'text-domain' ); ?></th>
                                                    <td>
                                                        <?php $value = self::get_theme_option( 'paymentlinkimage-5' ); ?>
                                                        <input class="paymentlinkimage-5_url" type="text" name="theme_options[paymentlinkimage-5]" size="60" value="<?php echo esc_attr( $value ); ?>">
                                                        <a href="#" class="paymentlinkimage-5 button button-primary">Upload</a>
                                                    </td>
                                            </tr>
                                            <script>
                                                jQuery(document).ready(function($) {
                                                    $('.paymentlinkimage-5').click(function(e) {
                                                        e.preventDefault();

                                                        var custom_uploader = wp.media({
                                                            title: 'Custom Image',
                                                            button: {
                                                                text: 'Upload Image'
                                                            },
                                                            multiple: false  // Set this to true to allow multiple files to be selected
                                                        })
                                                        .on('select', function() {
                                                            var attachment = custom_uploader.state().get('selection').first().toJSON();
                                                            $('.paymentlinkimage-5').attr('src', attachment.url);
                                                            $('.paymentlinkimage-5_url').val(attachment.url);

                                                        })
                                                        .open();
                                                    });
                                                });
                                            </script>
                                            <tr valign="top">
                                                <td>Copyright</td>
                                            </tr>
                                            <tr valign="top">
                                                    <th scope="row"><?php esc_html_e( 'Copywrite Text', 'text-domain' ); ?></th>
                                                    <td>
                                                            <?php $value = self::get_theme_option( 'copyWrite' ); ?>
                                                            <input type="text" name="theme_options[copyWrite]" value="<?php echo esc_attr( $value ); ?>">
                                                    </td>
                                            </tr>
                                            <tr valign="top">
                                                    <th scope="row"><?php esc_html_e( 'Copywrite link Name-1', 'text-domain' ); ?></th>
                                                    <td>
                                                            <?php $value = self::get_theme_option( 'copyWriteLinkname1' ); ?>
                                                            <input type="text" name="theme_options[copyWriteLinkname1]" value="<?php echo esc_attr( $value ); ?>">
                                                    </td>
                                            </tr>
                                            <tr valign="top">
                                                    <th scope="row"><?php esc_html_e( 'Copywrite link 1', 'text-domain' ); ?></th>
                                                    <td>
                                                            <?php $value = self::get_theme_option( 'copyWriteLink1' ); ?>
                                                            <input type="text" name="theme_options[copyWriteLink1]" value="<?php echo esc_attr( $value ); ?>">
                                                    </td>
                                            </tr>
                                            <tr valign="top">
                                                    <th scope="row"><?php esc_html_e( 'Copywrite link Name-2', 'text-domain' ); ?></th>
                                                    <td>
                                                            <?php $value = self::get_theme_option( 'copyWriteLinkname2' ); ?>
                                                            <input type="text" name="theme_options[copyWriteLinkname2]" value="<?php echo esc_attr( $value ); ?>">
                                                    </td>
                                            </tr>
                                            <tr valign="top">
                                                    <th scope="row"><?php esc_html_e( 'Copywrite link 2', 'text-domain' ); ?></th>
                                                    <td>
                                                            <?php $value = self::get_theme_option( 'copyWriteLink2' ); ?>
                                                            <input type="text" name="theme_options[copyWriteLink2]" value="<?php echo esc_attr( $value ); ?>">
                                                    </td>
                                            </tr>
                                        </table>

					<?php submit_button(); ?>

				</form>

			</div><!-- .wrap -->
		<?php }

	}
}
new anupranan_Theme_Options();

// Helper function to use in your theme to return a theme option value
function anupranan_get_theme_option( $id = '' ) {
	return anupranan_Theme_Options::get_theme_option( $id );
}

                        