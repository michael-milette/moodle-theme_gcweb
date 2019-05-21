// Pink day - April 10 2019 - Apply the style
//
( function( d ) {
    "use strict";

    var t = new Date(),
        msT = t.getTime(),
        s = new Date( 2019, 3, 10, 0, 1 ),
        e = new Date( 2019, 3, 10, 23, 59 );

    if ( s.getTime() < msT && msT < e.getTime() ) {
        d.getElementsByTagName( "html" )[ 0 ].classList.add( "pinkDay" );
    }

} )( document );
