<?php

/**
 * Master theme class
 *
 * @package Bolts
 * @since 1.0
 */
class My_Theme_Options {

	private $sections;
	private $checkboxes;
	private $settings;

	/**
	 * Construct
	 *
	 * @since 1.0
	 */
	public function __construct() {

		// This will keep track of the checkbox options for the validate_settings function.
		$this->checkboxes = array();
		$this->settings = array();
		$this->get_settings();

		$this->sections['appearance']   = __( 'Appearance' );
		$this->sections['home_slider']   = __( 'Home Slider' );
		$this->sections['social']      = __( 'Social' );
		$this->sections['contact']      = __( 'Contact' );
		$this->sections['partner']      = __( 'Partner' );
		$this->sections['reset']        = __( 'Reset to Defaults' );
		$this->sections['about']        = __( 'About' );

		add_action( 'admin_menu', array( &$this, 'add_pages' ) );
		add_action( 'admin_init', array( &$this, 'register_settings' ) );

		if ( ! get_option( 'mytheme_options' ) )
			$this->initialize_settings();

	}

	/**
	 * Add options page
	 *
	 * @since 1.0
	 */
	public function add_pages() {

		$admin_page = add_theme_page( __( 'Theme Options' ), __( 'Theme Options' ), 'manage_options', 'mytheme-options', array( &$this, 'display_page' ) );

		add_action( 'admin_print_scripts-' . $admin_page, array( &$this, 'scripts' ) );
		add_action( 'admin_print_styles-' . $admin_page, array( &$this, 'styles' ) );

	}

	/**
	 * Create settings field
	 *
	 * @since 1.0
	 */
	public function create_setting( $args = array() ) {

		$defaults = array(
			'id'      => 'default_field',
			'title'   => __( 'Default Field' ),
			'desc'    => __( 'This is a default description.' ),
			'std'     => '',
			'type'    => 'text',
			'section' => 'general',
			'choices' => array(),
			'class'   => ''
		);

		extract( wp_parse_args( $args, $defaults ) );

		$field_args = array(
			'type'      => $type,
			'id'        => $id,
			'desc'      => $desc,
			'std'       => $std,
			'choices'   => $choices,
			'label_for' => $id,
			'class'     => $class
		);

		if ( $type == 'checkbox' )
			$this->checkboxes[] = $id;

		add_settings_field( $id, $title, array( $this, 'display_setting' ), 'mytheme-options', $section, $field_args );
	}

	/**
	 * Display options page
	 *
	 * @since 1.0
	 */
	public function display_page() {

		echo '<div class="wrap">
	<div class="icon32" id="icon-options-general"></div>
	<h2>' . __( 'Theme Options' ) . '</h2>';

		if ( isset( $_GET['settings-updated'] ) && $_GET['settings-updated'] == true )
			echo '<div class="updated fade"><p>' . __( 'Theme options updated.' ) . '</p></div>';

		echo '<form action="options.php" method="post">';

		settings_fields( 'mytheme_options' );
		echo '<div class="ui-tabs">
			<ul class="ui-tabs-nav">';

		foreach ( $this->sections as $section_slug => $section )
			echo '<li><a href="#' . $section_slug . '">' . $section . '</a></li>';

		echo '</ul>';
		do_settings_sections( $_GET['page'] );

		echo '</div>
		<p class="submit"><input name="Submit" type="submit" class="button-primary" value="' . __( 'Save Changes' ) . '" /></p>

	</form>';

	echo '<script type="text/javascript">
		jQuery(document).ready(function($) {
			var sections = [];';

			foreach ( $this->sections as $section_slug => $section )
				echo "sections['$section'] = '$section_slug';";

			echo 'var wrapped = $(".wrap h3").wrap("<div class=\"ui-tabs-panel\">");
			wrapped.each(function() {
				$(this).parent().append($(this).parent().nextUntil("div.ui-tabs-panel"));
			});
			$(".ui-tabs-panel").each(function(index) {
				$(this).attr("id", sections[$(this).children("h3").text()]);
				if (index > 0)
					$(this).addClass("ui-tabs-hide");
			});
			$(".ui-tabs").tabs({
				fx: { opacity: "toggle", duration: "fast" }
			});

			$("input[type=text], textarea").each(function() {
				if ($(this).val() == $(this).attr("placeholder") || $(this).val() == "")
					$(this).css("color", "#999");
			});

			$("input[type=text], textarea").focus(function() {
				if ($(this).val() == $(this).attr("placeholder") || $(this).val() == "") {
					$(this).val("");
					$(this).css("color", "#000");
				}
			}).blur(function() {
				if ($(this).val() == "" || $(this).val() == $(this).attr("placeholder")) {
					$(this).val($(this).attr("placeholder"));
					$(this).css("color", "#999");
				}
			});

			$(".wrap h3, .wrap table").show();

			// This will make the "warning" checkbox class really stand out when checked.
			// I use it here for the Reset checkbox.
			$(".warning").change(function() {
				if ($(this).is(":checked"))
					$(this).parent().css("background", "#c00").css("color", "#fff").css("fontWeight", "bold");
				else
					$(this).parent().css("background", "none").css("color", "inherit").css("fontWeight", "normal");
			});

			// Browser compatibility
			if ($.browser.mozilla)
			         $("form").attr("autocomplete", "off");
		});
	</script>
</div>';

	}

	/**
	 * Description for section
	 *
	 * @since 1.0
	 */
	public function display_section() {
		// code
	}

	/**
	 * Description for About section
	 *
	 * @since 1.0
	 */
	public function display_about_section() {

		// This displays on the "About" tab. Echo regular HTML here, like so:

	}

	/**
	 * HTML output for text field
	 *
	 * @since 1.0
	 */
	public function display_setting( $args = array() ) {

		extract( $args );

		$options = get_option( 'mytheme_options' );

		if ( ! isset( $options[$id] ) && $type != 'checkbox' )
			$options[$id] = $std;
		elseif ( ! isset( $options[$id] ) )
			$options[$id] = 0;

		$field_class = '';
		if ( $class != '' )
			$field_class = ' ' . $class;

		switch ( $type ) {

			case 'heading':
				echo '</td></tr><tr valign="top"><td colspan="2"><h4>' . $desc . '</h4>';
				break;

			case 'checkbox':

				echo '<input class="checkbox' . $field_class . '" type="checkbox" id="' . $id . '" name="mytheme_options[' . $id . ']" value="1" ' . checked( $options[$id], 1, false ) . ' /> <label for="' . $id . '">' . $desc . '</label>';

				break;

			case 'select':
				echo '<select class="select' . $field_class . '" name="mytheme_options[' . $id . ']">';

				foreach ( $choices as $value => $label )
					echo '<option value="' . esc_attr( $value ) . '"' . selected( $options[$id], $value, false ) . '>' . $label . '</option>';

				echo '</select>';

				if ( $desc != '' )
					echo '<br /><span class="description">' . $desc . '</span>';

				break;

			case 'radio':
				$i = 0;
				foreach ( $choices as $value => $label ) {
					echo '<input class="radio' . $field_class . '" type="radio" name="mytheme_options[' . $id . ']" id="' . $id . $i . '" value="' . esc_attr( $value ) . '" ' . checked( $options[$id], $value, false ) . '> <label for="' . $id . $i . '">' . $label . '</label>';
					if ( $i < count( $options ) - 1 )
						echo '<br />';
					$i++;
				}

				if ( $desc != '' )
					echo '<br /><span class="description">' . $desc . '</span>';

				break;

			case 'textarea':
				echo '<textarea class="' . $field_class . '" id="' . $id . '" name="mytheme_options[' . $id . ']" placeholder="' . $std . '" rows="5" cols="30">' . wp_htmledit_pre( $options[$id] ) . '</textarea>';

				if ( $desc != '' )
					echo '<br /><span class="description">' . $desc . '</span>';

				break;

			case 'password':
				echo '<input class="regular-text' . $field_class . '" type="password" id="' . $id . '" name="mytheme_options[' . $id . ']" value="' . esc_attr( $options[$id] ) . '" />';

				if ( $desc != '' )
					echo '<br /><span class="description">' . $desc . '</span>';

				break;

			case 'text':
			default:
		 		echo '<input class="regular-text' . $field_class . '" type="text" id="' . $id . '" name="mytheme_options[' . $id . ']" placeholder="' . $std . '" value="' . esc_attr( $options[$id] ) . '" />';

		 		if ( $desc != '' )
		 			echo '<br /><span class="description">' . $desc . '</span>';

		 		break;

		}

	}

	/**
	 * Settings and defaults
	 *
	 * @since 1.0
	 */
	public function get_settings() {

		/* General Settings
		===========================================*/

/*
		$this->settings['example_text'] = array(
			'title'   => __( 'Example Text Input' ),
			'desc'    => __( 'This is a description for the text input.' ),
			'std'     => 'Default value',
			'type'    => 'text',
			'section' => 'general'
		);

		$this->settings['example_textarea'] = array(
			'title'   => __( 'Example Textarea Input' ),
			'desc'    => __( 'This is a description for the textarea input.' ),
			'std'     => 'Default value',
			'type'    => 'textarea',
			'section' => 'general'
		);

		$this->settings['example_checkbox'] = array(
			'section' => 'general',
			'title'   => __( 'Example Checkbox' ),
			'desc'    => __( 'This is a description for the checkbox.' ),
			'type'    => 'checkbox',
			'std'     => 1 // Set to 1 to be checked by default, 0 to be unchecked by default.
		);

		$this->settings['example_heading'] = array(
			'section' => 'general',
			'title'   => '', // Not used for headings.
			'desc'    => 'Example Heading',
			'type'    => 'heading'
		);

		$this->settings['example_radio'] = array(
			'section' => 'general',
			'title'   => __( 'Example Radio' ),
			'desc'    => __( 'This is a description for the radio buttons.' ),
			'type'    => 'radio',
			'std'     => '',
			'choices' => array(
				'choice1' => 'Choice 1',
				'choice2' => 'Choice 2',
				'choice3' => 'Choice 3'
			)
		);

		$this->settings['example_select'] = array(
			'section' => 'general',
			'title'   => __( 'Example Select' ),
			'desc'    => __( 'This is a description for the drop-down.' ),
			'type'    => 'select',
			'std'     => '',
			'choices' => array(
				'choice1' => 'Other Choice 1',
				'choice2' => 'Other Choice 2',
				'choice3' => 'Other Choice 3'
			)
		);
*/

		/* Appearance
		===========================================*/

		$this->settings['site_logo'] = array(
			'section' => 'appearance',
			'title'   => __( 'Website Logo' ),
			'desc'    => __( 'Enter the URL to your logo for the website.' ),
			'type'    => 'text',
			'std'     => ''
		);

		$this->settings['favicon'] = array(
			'section' => 'appearance',
			'title'   => __( 'Favicon' ),
			'desc'    => __( 'Enter the URL to your custom favicon. It should be 16x16 pixels in size.' ),
			'type'    => 'text',
			'std'     => ''
		);

		$this->settings['background_image'] = array(
			'section' => 'appearance',
			'title'   => __( 'Background Image' ),
			'desc'    => __( 'Background Image URL' ),
			'type'    => 'text',
			'std'     => ''
    );

    $this->settings['intro_image'] = array(
			'section' => 'appearance',
			'title'   => __( 'Popup image' ),
			'desc'    => __( 'Enter the URL to your image.' ),
			'type'    => 'text',
			'std'     => ''
		);

		$this->settings['footer_credit_link'] = array(
			'section' => 'appearance',
			'title'   => __( 'Footer Credit Link' ),
			'desc'    => __( 'Show/Hide Footer Credit Link' ),
			'type'    => 'checkbox',
			'std'     => 1
		);

		$this->settings['custom_css'] = array(
			'title'   => __( 'Custom Styles' ),
			'desc'    => __( 'Enter any custom CSS here to apply it to your theme.' ),
			'std'     => '',
			'type'    => 'textarea',
			'section' => 'appearance',
			'class'   => 'code'
		);

		/* Slider
		===========================================*/

		$this->settings['home_slider_amount'] = array(
			'section' => 'home_slider',
			'title'   => __( 'Number of Slide' ),
			'desc'    => __( '' ),
			'type'    => 'select',
			'std'     => '',
			'choices' => array(
				'' => '',
				'1' => '1',
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'5' => '5'
			)
		);

		$this->settings['home_slider_url_0'] = array(
			'section' => 'home_slider',
			'title'   => __( 'Image URL#1' ),
			'desc'    => __( 'Enter the URL to your image.' ),
			'type'    => 'text',
			'std'     => ''
		);

		$this->settings['home_slider_title_0'] = array(
			'section' => 'home_slider',
			'title'   => __( 'Image Title#1' ),
			'desc'    => __( 'Enter the title for your image.' ),
			'type'    => 'text',
			'std'     => ''
		);

		$this->settings['home_slider_desc_0'] = array(
			'section' => 'home_slider',
			'title'   => __( 'Image Description#1' ),
			'desc'    => __( 'Enter the description for your image.' ),
			'type'    => 'text',
			'std'     => ''
		);

		$this->settings['home_slider_url_1'] = array(
			'section' => 'home_slider',
			'title'   => __( 'Image URL#2' ),
			'desc'    => __( 'Enter the URL to your image.' ),
			'type'    => 'text',
			'std'     => ''
		);

		$this->settings['home_slider_title_1'] = array(
			'section' => 'home_slider',
			'title'   => __( 'Image Title#2' ),
			'desc'    => __( 'Enter the title for your image.' ),
			'type'    => 'text',
			'std'     => ''
		);

		$this->settings['home_slider_desc_1'] = array(
			'section' => 'home_slider',
			'title'   => __( 'Image Description#2' ),
			'desc'    => __( 'Enter the description for your image.' ),
			'type'    => 'text',
			'std'     => ''
		);

		$this->settings['home_slider_url_2'] = array(
			'section' => 'home_slider',
			'title'   => __( 'Image URL#3' ),
			'desc'    => __( 'Enter the URL to your image.' ),
			'type'    => 'text',
			'std'     => ''
		);

		$this->settings['home_slider_title_2'] = array(
			'section' => 'home_slider',
			'title'   => __( 'Image Title#3' ),
			'desc'    => __( 'Enter the title for your image.' ),
			'type'    => 'text',
			'std'     => ''
		);

		$this->settings['home_slider_desc_2'] = array(
			'section' => 'home_slider',
			'title'   => __( 'Image Description#3' ),
			'desc'    => __( 'Enter the description for your image.' ),
			'type'    => 'text',
			'std'     => ''
		);

		$this->settings['home_slider_url_3'] = array(
			'section' => 'home_slider',
			'title'   => __( 'Image URL#4' ),
			'desc'    => __( 'Enter the URL to your image.' ),
			'type'    => 'text',
			'std'     => ''
		);

		$this->settings['home_slider_title_3'] = array(
			'section' => 'home_slider',
			'title'   => __( 'Image Title#4' ),
			'desc'    => __( 'Enter the title for your image.' ),
			'type'    => 'text',
			'std'     => ''
		);

		$this->settings['home_slider_desc_3'] = array(
			'section' => 'home_slider',
			'title'   => __( 'Image Description#4' ),
			'desc'    => __( 'Enter the description for your image.' ),
			'type'    => 'text',
			'std'     => ''
		);

		$this->settings['home_slider_url_4'] = array(
			'section' => 'home_slider',
			'title'   => __( 'Image URL#5' ),
			'desc'    => __( 'Enter the URL to your image.' ),
			'type'    => 'text',
			'std'     => ''
		);

		$this->settings['home_slider_title_4'] = array(
			'section' => 'home_slider',
			'title'   => __( 'Image Title#5' ),
			'desc'    => __( 'Enter the title for your image.' ),
			'type'    => 'text',
			'std'     => ''
		);

		$this->settings['home_slider_desc_4'] = array(
			'section' => 'home_slider',
			'title'   => __( 'Image Description#5' ),
			'desc'    => __( 'Enter the description for your image.' ),
			'type'    => 'text',
			'std'     => ''
		);

		/* Social Settings
		===========================================*/
		$this->settings['mj_facebook'] = array(
			'section' => 'social',
			'title'   => __( 'Facebook' ),
			'desc'    => __( 'Your Facebook Page URL' ),
			'type'    => 'text',
			'std'     => ''
		);

		$this->settings['mj_twitter'] = array(
			'section' => 'social',
			'title'   => __( 'Tiwtter' ),
			'desc'    => __( 'Your Twitter URL' ),
			'type'    => 'text',
			'std'     => ''
		);

		$this->settings['mj_googleplus'] = array(
			'section' => 'social',
			'title'   => __( 'Google +' ),
			'desc'    => __( 'Your Google+ URL' ),
			'type'    => 'text',
			'std'     => ''
		);

		/* Contact Setting
		===========================================*/
		$this->settings['mj_title'] = array(
			'section' => 'contact',
			'title'   => __( 'Company Name EN' ),
			'desc'    => __( 'English' ),
			'type'    => 'text',
			'std'     => ''
		);
		$this->settings['mj_title_th'] = array(
			'section' => 'contact',
			'title'   => __( 'Company Name TH' ),
			'desc'    => __( 'ภาษาไทย' ),
			'type'    => 'text',
			'std'     => ''
		);
		$this->settings['mj_address'] = array(
			'section' => 'contact',
			'title'   => __( 'Address EN' ),
			'desc'    => __( 'English' ),
			'type'    => 'text',
			'std'     => ''
		);
		$this->settings['mj_address_th'] = array(
			'section' => 'contact',
			'title'   => __( 'Address TH' ),
			'desc'    => __( 'ภาษาไทย' ),
			'type'    => 'text',
			'std'     => ''
		);
		$this->settings['mj_phone'] = array(
			'section' => 'contact',
			'title'   => __( 'Phone' ),
			'desc'    => __( '' ),
			'type'    => 'text',
			'std'     => ''
		);
		$this->settings['mj_fax'] = array(
			'section' => 'contact',
			'title'   => __( 'Fax' ),
			'desc'    => __( '' ),
			'type'    => 'text',
			'std'     => ''
		);
		$this->settings['mj_email'] = array(
			'section' => 'contact',
			'title'   => __( 'Email' ),
			'desc'    => __( 'example@domain.com' ),
			'type'    => 'text',
			'std'     => ''
		);
		$this->settings['mj_map'] = array(
			'section' => 'contact',
			'title'   => __( 'Map' ),
			'desc'    => __( 'Map Image URL' ),
			'type'    => 'text',
			'std'     => ''
		);

		/* Partner Setting
		===========================================*/

		$this->settings['mj_partner_title'] = array(
			'section' => 'partner',
			'title'   => __( 'Partner Title EN' ),
			'desc'    => __( 'English' ),
			'type'    => 'text',
			'std'     => ''
		);
		$this->settings['mj_partner_title_th'] = array(
			'section' => 'partner',
			'title'   => __( 'Partner Title TH' ),
			'desc'    => __( 'ภาษาไทย' ),
			'type'    => 'text',
			'std'     => ''
		);
		$this->settings['mj_partner_north_title'] = array(
			'section' => 'partner',
			'title'   => __( 'Partner North Title' ),
			'desc'    => __( 'English' ),
			'type'    => 'text',
			'std'     => ''
		);
		$this->settings['mj_partner_north_title_th'] = array(
			'section' => 'partner',
			'title'   => __( 'Partner North Title TH' ),
			'desc'    => __( 'ภาษาไทย' ),
			'type'    => 'text',
			'std'     => ''
		);
		$this->settings['mj_partner_north'] = array(
			'section' => 'partner',
			'title'   => __( 'Partner North' ),
			'desc'    => __( '' ),
			'type'    => 'textarea',
			'std'     => ''
		);
		$this->settings['mj_partner_northeast_title'] = array(
			'section' => 'partner',
			'title'   => __( 'Partner Northeast Title' ),
			'desc'    => __( 'English' ),
			'type'    => 'text',
			'std'     => ''
		);
		$this->settings['mj_partner_northeast_title_th'] = array(
			'section' => 'partner',
			'title'   => __( 'Partner Northeast Title TH' ),
			'desc'    => __( 'ภาษาไทย' ),
			'type'    => 'text',
			'std'     => ''
		);
		$this->settings['mj_partner_northeast'] = array(
			'section' => 'partner',
			'title'   => __( 'Partner Northeast' ),
			'desc'    => __( '' ),
			'type'    => 'textarea',
			'std'     => ''
		);
		$this->settings['mj_partner_east_title'] = array(
			'section' => 'partner',
			'title'   => __( 'Partner East Title' ),
			'desc'    => __( 'English' ),
			'type'    => 'text',
			'std'     => ''
		);
		$this->settings['mj_partner_east_title_th'] = array(
			'section' => 'partner',
			'title'   => __( 'Partner East Title TH' ),
			'desc'    => __( 'ภาษาไทย' ),
			'type'    => 'text',
			'std'     => ''
		);
		$this->settings['mj_partner_east'] = array(
			'section' => 'partner',
			'title'   => __( 'Partner East' ),
			'desc'    => __( '' ),
			'type'    => 'textarea',
			'std'     => ''
		);
		$this->settings['mj_partner_central_title'] = array(
			'section' => 'partner',
			'title'   => __( 'Partner Central Title' ),
			'desc'    => __( 'English' ),
			'type'    => 'text',
			'std'     => ''
		);
		$this->settings['mj_partner_central_title_th'] = array(
			'section' => 'partner',
			'title'   => __( 'Partner Central Title TH' ),
			'desc'    => __( 'ภาษาไทย' ),
			'type'    => 'text',
			'std'     => ''
		);
		$this->settings['mj_partner_central'] = array(
			'section' => 'partner',
			'title'   => __( 'Partner Central' ),
			'desc'    => __( '' ),
			'type'    => 'textarea',
			'std'     => ''
		);
		$this->settings['mj_partner_west_title'] = array(
			'section' => 'partner',
			'title'   => __( 'Partner west Title' ),
			'desc'    => __( 'English' ),
			'type'    => 'text',
			'std'     => ''
		);
		$this->settings['mj_partner_west_title_th'] = array(
			'section' => 'partner',
			'title'   => __( 'Partner west Title TH' ),
			'desc'    => __( 'ภาษาไทย' ),
			'type'    => 'text',
			'std'     => ''
		);
		$this->settings['mj_partner_west'] = array(
			'section' => 'partner',
			'title'   => __( 'Partner west' ),
			'desc'    => __( '' ),
			'type'    => 'textarea',
			'std'     => ''
		);
		$this->settings['mj_partner_south_title'] = array(
			'section' => 'partner',
			'title'   => __( 'Partner South Title' ),
			'desc'    => __( 'English' ),
			'type'    => 'text',
			'std'     => ''
		);
		$this->settings['mj_partner_south_title_th'] = array(
			'section' => 'partner',
			'title'   => __( 'Partner South Title TH' ),
			'desc'    => __( 'ภาษาไทย' ),
			'type'    => 'text',
			'std'     => ''
		);
		$this->settings['mj_partner_south'] = array(
			'section' => 'partner',
			'title'   => __( 'Partner South' ),
			'desc'    => __( '' ),
			'type'    => 'textarea',
			'std'     => ''
		);

		/* Reset
		===========================================*/

		$this->settings['reset_theme'] = array(
			'section' => 'reset',
			'title'   => __( 'Reset theme' ),
			'type'    => 'checkbox',
			'std'     => 0,
			'class'   => 'warning', // Custom class for CSS
			'desc'    => __( 'Check this box and click "Save Changes" below to reset theme options to their defaults.' )
		);

	}

	/**
	 * Initialize settings to their default values
	 *
	 * @since 1.0
	 */
	public function initialize_settings() {

		$default_settings = array();
		foreach ( $this->settings as $id => $setting ) {
			if ( $setting['type'] != 'heading' )
				$default_settings[$id] = $setting['std'];
		}

		update_option( 'mytheme_options', $default_settings );

	}

	/**
	* Register settings
	*
	* @since 1.0
	*/
	public function register_settings() {

		register_setting( 'mytheme_options', 'mytheme_options', array ( &$this, 'validate_settings' ) );

		foreach ( $this->sections as $slug => $title ) {
			if ( $slug == 'about' )
				add_settings_section( $slug, $title, array( &$this, 'display_about_section' ), 'mytheme-options' );
			else
				add_settings_section( $slug, $title, array( &$this, 'display_section' ), 'mytheme-options' );
		}

		$this->get_settings();

		foreach ( $this->settings as $id => $setting ) {
			$setting['id'] = $id;
			$this->create_setting( $setting );
		}

	}

	/**
	* jQuery Tabs
	*
	* @since 1.0
	*/
	public function scripts() {

		wp_print_scripts( 'jquery-ui-tabs' );

	}

	/**
	* Styling for the theme options page
	*
	* @since 1.0
	*/
	public function styles() {

		wp_register_style( 'mytheme-admin', get_bloginfo( 'stylesheet_directory' ) . '/mytheme-options.css' );
		wp_enqueue_style( 'mytheme-admin' );

	}

	/**
	* Validate settings
	*
	* @since 1.0
	*/
	public function validate_settings( $input ) {

		if ( ! isset( $input['reset_theme'] ) ) {
			$options = get_option( 'mytheme_options' );

			foreach ( $this->checkboxes as $id ) {
				if ( isset( $options[$id] ) && ! isset( $input[$id] ) )
					unset( $options[$id] );
			}

			return $input;
		}
		return false;

	}

}

$theme_options = new My_Theme_Options();

function mytheme_option( $option ) {
	$options = get_option( 'mytheme_options' );
	if ( isset( $options[$option] ) )
		return $options[$option];
	else
		return false;
}
?>
