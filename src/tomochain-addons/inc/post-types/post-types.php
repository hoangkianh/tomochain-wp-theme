<?php
/**
 * Import Post Type
 */

if( ! class_exists( 'Tomochain_Add_Posttypes' ) ) {

	class Tomochain_Add_Posttypes {

		public function __construct() {
            $this->includes();
		}

		public function includes() {
			require_once( TOMOCHAIN_ADDONS_DIR . '/inc/post-types/event.php');
		}
    }

	new Tomochain_Add_Posttypes;
}
