<?php

namespace Cmb2MultidatesPicker\Fields;

if ( !class_exists('\Cmb2MultidatesPicker\Fields\MultidatesPicker') ) {

	/**
	 * Description of MultidatesPicker
	 *
	 * @author Pablo Pacheco <pablo.pacheco@origgami.com.br>
	 */
	class MultidatesPicker extends \Cmb2MultidatesPicker\DesignPatterns\Singleton {

		protected function __construct() {
			parent::__construct();
			$fieldName = 'multidates';
			add_action("cmb2_render_{$fieldName}", array($this, 'cmb2_render'), 10, 5);
			add_filter( "cmb2_sanitize_{$fieldName}", array($this,'cmb2_sanitize'), 10, 5 );
			add_action( 'admin_enqueue_scripts', array($this,'adminEnqueueScripts'), 10, 1 );
		}
		
		public function cmb2_sanitize($override_value, $value,$object_id,$field_args,$sanitizer_object ){
			$dates = array_map('trim', explode(',', $value));
			return $dates;
		}
		
		public function adminEnqueueScripts( $pagearg){
			$asset_path = plugins_url( '', dirname(__FILE__)  );
			
			wp_register_style('jquery-ui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css');
			wp_enqueue_style( 'jquery-ui' );   
			
			wp_register_style('multidatespicker', $asset_path . '/assets/css/cmb2-multidates-picker.css');
			wp_enqueue_style( 'multidatespicker' );   
	
			wp_register_script( 'multidatespicker-lib', $asset_path . '/assets/js/libs/multidatespicker/jquery-ui.multidatespicker.js', array( 'jquery-ui-datepicker' ),false);
			wp_enqueue_script('multidatespicker-lib');
		}

		public function cmb2_render( $field, $escaped_value, $object_id, $object_type, $field_type_object ) {
			$defaultArgs=array(
				'dateFormat' => 'yy-mm-dd'
			);
			$multidatesParams=$defaultArgs;
			if(isset($field->args['multidates_params'])){
				$multidatesParams = wp_parse_args($field->args['multidates_params'], $defaultArgs);
			}
			
			$fieldName = 'multidatespicker'.$field->args['id'];
			echo '<div id="'.$fieldName.'"></div>';
			$valueStr = is_array($escaped_value) && count($escaped_value > 0) ? implode(", ",$escaped_value) : '' ;
			echo $field_type_object->input(array('type' => 'text','class'=>'hidden','value'=>$valueStr));
			$datesJs = wp_json_encode($escaped_value);
			$multidatesParamsJs = wp_json_encode($multidatesParams);
			?>
				<script>
					var params = {
						altField: '#<?php echo $field->args['id']; ?>'
					};
					var pickerParams = <?php echo $multidatesParamsJs; ?>;
					jQuery.extend(params, pickerParams);
					<?php if ( is_array($escaped_value) && count($escaped_value > 0) ) { ?>
						var dates = <?php echo $datesJs; ?>;
						params.addDates=dates;
					<?php } ?>
					jQuery('#<?php echo $fieldName; ?>').multiDatesPicker(params);
				</script>
			<?php
		}
		
		

	}

}