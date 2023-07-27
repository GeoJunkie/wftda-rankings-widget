import * as WPElement from '@wordpress/element';
import React, { useEffect } from 'react';

/**
 * Initial render function.
 */
function render() {
    const container = document.getElementById( 'react-test' );
    console.log(container);

    if ( null === container ) {
        return;
    }

    const component = (
        <h1>Hello World!</h1>
    );
    if ( WPElement.createRoot ) {
        WPElement.createRoot( container ).render( component );
    } else {
        WPElement.render( component, container );
    }
}

render();
