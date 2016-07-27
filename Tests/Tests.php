<?php

namespace Cmb2MultidatesPicker\Tests;

if ( !class_exists('\Cmb2MultidatesPicker\Tests\Tests') ) {

	/**
	 * Description of Tests
	 *
	 * @author Pablo Pacheco <pablo.pacheco@origgami.com.br>
	 */
	class Tests {

		public function __construct() {
			add_action('cmb2_admin_init', array($this, 'testCmb'));
		}

		public function testCmb() {
			$prefix = '_mdpt_';
			/**
			 * Sample metabox to demonstrate each field type included
			 */
			$cmb_demo = new_cmb2_box(array(
				'id'			 => $prefix . 'metabox',
				'title'			 => __('Test Metabox', 'cmb2'),
				'object_types'	 => array('page',), // Post type
			));

			$cmb_demo->add_field(array(
				'name'					 => __('Test Text', 'cmb2'),
				'desc'					 => __('field description (optional)', 'cmb2'),
				'id'					 => $prefix . 'dates',
				'type'					 => 'multidates',
				'multidates_params' => array(
					
				),
				'show_on_cb'			 => 'yourprefix_hide_if_no_cats', // function should return a bool value
			));
		}

	}

}