<?php

namespace WFTDA_Rankings;

defined( 'ABSPATH' ) or exit();

class Activation {

	public static function activate() {

		$role = get_role( 'administrator' );

		if ( ! empty( $role ) ) {
			$role->add_cap( 'wrw_manage' );
		}
	}
}
