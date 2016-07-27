<?php

/**
 * Plugin Name: CMB2 Multidates Picker
 * Plugin URI:  https://github.com/origgami/cmb2-multidates-picker
 * Description: Creates a CMB2 field that enables a multiple date calendar
 * Version:     1.0.0
 * Author:      Origgami
 * Author URI:  http://origgami.com.br
 * Depends:     CMB2
 * License:     GPLv2
 * Text Domain: cmb2-multidates-picker
 */

namespace Cmb2MultidatesPicker;

//SETUP AUTOLOAD ======================================================================
spl_autoload_register(function($class) {
	if (false !== strpos($class, 'Cmb2MultidatesPicker')) {
		if (!class_exists($class)) {			
			$dir = plugin_dir_path( __FILE__ );
			$classes_dir = $dir;
			$class_file	 = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
			$class_file	 = preg_replace('/Cmb2MultidatesPicker\\\\/', '', $class) . '.php';
			$file		 = $classes_dir . $class_file;
			if (file_exists($file)) {
				require_once $file;
			} 			
		}
	}
});

if ( !class_exists('\Cmb2MultidatesPicker\Cmb2MultidatesPicker') ) {

	/**
	 * Description of Cmb2MultidatesPicker
	 *
	 * @author Pablo Pacheco <pablo.pacheco@origgami.com.br>
	 */
	class Cmb2MultidatesPicker extends DesignPatterns\Singleton {
		public function __construct() {
			add_action('cmb2_admin_init', array($this, 'addFields'));
			new Tests\Tests();
		}
		
		public function addFields(){
			Fields\MultidatesPicker::getInstance();
		}
	}

}

Cmb2MultidatesPicker::getInstance();