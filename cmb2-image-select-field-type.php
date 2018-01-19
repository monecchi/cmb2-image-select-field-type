<?php
/*
Plugin Name: CMB2 Image Select Field Type
Plugin URI: https://github.com/monecchi/cmb2-image-select-field-type
GitHub Plugin URI: https://github.com/monecchi/cmb2-image-select-field-type
Description: Image Select field type for CMB2.
Version: 1.0.0
Author: Adriano Monecchi
Author URI: https://twitter.com/dico_monecchi/
Contributors: designroom
License: GPLv2+
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
*/

/**
 * Class PR_CMB2_Image_Select_Field
 */
class PR_CMB2_Image_Select_Field {

	/**
	 * Current version number
	 */
	const VERSION = '1.0.0';

	/**
	 * Initialize the plugin by hooking into CMB2
	 */
	public function __construct() {
	    add_action( 'init', array( $this, 'init_setup' ), 10, 1 );
		add_action( 'cmb2_render_image_select', array( $this, 'cmb2_render_image_select' ), 10, 5 );
		add_action( 'plugins_loaded', array( $this, 'setup_plugin_updater' ), 10, 1 );

	}

	/**
	 * Setup Scripts 
	 */
	public function init_setup() {

		$this->setup_admin_scripts();	

	}

	/**
	 * Render Image Select Field
	 */
	public function cmb2_render_image_select( $field, $escaped_value, $object_id, $object_type, $field_type_object ) {	

		if ( version_compare( CMB2_VERSION, '2.2.2', '>=' ) ) {
			$field_type_object->type = new PR_CMB2_Image_Select_Field( $field_type_object );
		}

		$conditional_value =(isset($field->args['attributes']['data-conditional-value'])?'data-conditional-value="'.esc_attr($field->args['attributes']['data-conditional-value']).'"':'');
		$conditional_id =(isset($field->args['attributes']['data-conditional-id'])?'data-conditional-id="'.esc_attr($field->args['attributes']['data-conditional-id']).'"':'');

		$default_value = $field->args['attributes']['default'];  

		$image_select = '<ul id="cmb2-image-select'.$field->args['_id'].'" class="cmb2-image-select-list">';

		foreach ( $field->options() as $value => $item ) {

			$selected = ( $value === ( $escaped_value =='' ? $default_value : $escaped_value ) ) ? 'checked="checked"' : '';

			$image_select .= '<li class="cmb2-image-select '.($selected!= ''?'cmb2-image-select-selected':'').'">
				<label for="' . $field->args['_id'] . esc_attr( $value ) . '">
				<input '.$conditional_value.$conditional_id.' type="radio" id="'. $field->args['_id'] . esc_attr( $value ) . '" name="' . $field->args['_name'] . '" value="' . esc_attr( $value ) . '" ' . $selected . ' class="cmb2-option"><img class="" style=" width: auto; " alt="' . $item['alt'] . '" src="' . $item['img'] . '">
				<br>
				<span>' . esc_html( $item['title'] ) . '</span>
				</label>
				</li>';
		}

		$image_select .= '</ul>';

		$image_select .= $field_type_object->_desc( true );

		echo $image_select;
	}



	/**
	 * Github Plugin Updater
	 */

	public function setup_plugin_updater() {

		if( ! class_exists( 'Github_Updater' ) ) {
			include_once( plugin_dir_path( __FILE__ ) . 'git-updater.php' );
		}

		$updater = new Github_Updater( __FILE__ );
		$updater->set_username( 'monecchi' );
		$updater->set_repository( 'cmb2-image-select-field-type' ); 

		/* Access Token for private repo */
		//$updater->authorize( '' ); // Your auth code goes here for private repos

		$updater->initialize();

	}


	/**
	 * Enqueue scripts and styles
	 */
	public function setup_admin_scripts() {

		$asset_path = apply_filters( 'pr_cmb2_image_select_asset_path', plugins_url( '', __FILE__  ) );

        wp_register_style( 'cmb2_imgselect-css', $asset_path . '/css/image_select_metafield.css', array(), '1.0.0' );
		wp_enqueue_style( 'cmb2_imgselect-css', $asset_path . '/css/image_select_metafield.css', array(), self::VERSION ); // CMB2 Image_select Field Styling

        wp_register_script( 'cmb2_imgselect-js', $asset_path . '/js/image_select_metafield.js', array(), '1.0.0' );
		wp_enqueue_script( 'cmb2_imgselect-js', $asset_path . '/js/image_select_metafield.js', array( 'cmb2-scripts' ), self::VERSION ); // CMB2 Image_select Event

	}

}

$pr_cmb2_image_select_field = new PR_CMB2_Image_Select_Field();