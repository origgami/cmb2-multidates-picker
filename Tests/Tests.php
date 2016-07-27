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
			$cmb_demo = new_cmb2_box(array(
				'id'			 => $prefix . 'metabox',
				'title'			 => __('Test Metabox', 'cmb2'),
				'object_types'	 => array('page',), // Post type
			));

			$cmb_demo->add_field(array(
				'name'	 => __('Test Text', 'cmb2'),
				'desc'	 => __('field description (optional)', 'cmb2'),
				'id'	 => $prefix . 'dates',
				'type'	 => 'multidates',
				
				//Any value from http://multidatespickr.sourceforge.net
				'multidates_params' => array(
					//'maxPicks'	 => 3,
					//'dateFormat'   => "y-m-d",
				),
			));
		}

	}

}