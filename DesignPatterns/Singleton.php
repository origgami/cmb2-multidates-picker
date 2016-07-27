<?php

namespace Cmb2MultidatesPicker\DesignPatterns;

if ( !class_exists('\Cmb2MultidatesPicker\DesignPatterns\Singleton') ) {

	/**
	 * Description of Singleton
	 *
	 * @author Pablo Pacheco <pablo.pacheco@origgami.com.br>
	 */
	class Singleton {

		protected function __construct() {
			
		}

		/**
		 * Returns the *Singleton* instance of this class.
		 *
		 * @staticvar Singleton $instance The *Singleton* instances of this class.
		 *
		 * @return Current_Class_Name
		 */
		public static function getInstance() {
			static $instance = null;
			if ( null === $instance ) {
				$instance = new static();
			}

			return $instance;
		}

		final private function __clone() {
			
		}

	}

}