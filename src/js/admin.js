import React from 'react';
import * as WPElement from '@wordpress/element';

function render() {
	const container = document.getElementById( 'league-wftda-ranking-admin-display' );

	if ( null === container ) {
		return;
	}

	// @todo: Remove fallback when we drop support for WP 6.1
	const component = (
		<h1>Hello World</h1>
	);
	if ( WPElement.createRoot ) {
		WPElement.createRoot( container ).render( component );
	} else {
		WPElement.render( component, container );
	}
}

render();