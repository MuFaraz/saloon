/**
 * Maison Belle Core: tiny admin helpers (media picker, settings tabs).
 */
( function ( $ ) {
	'use strict';

	$( document ).on( 'click', '.mb-media__pick', function ( e ) {
		e.preventDefault();
		var $wrap = $( this ).closest( '.mb-media' );
		var frame = wp.media( {
			title: 'Choose image',
			button: { text: 'Use this image' },
			library: { type: 'image' },
			multiple: false
		} );
		frame.on( 'select', function () {
			var att = frame.state().get( 'selection' ).first().toJSON();
			var url = att.sizes && att.sizes.thumbnail ? att.sizes.thumbnail.url : att.url;
			$wrap.find( 'input[type=hidden]' ).val( att.id );
			$wrap.find( '.mb-media__preview' ).html( $( '<img>', { src: url, width: 96, height: 96, alt: '' } ) );
			$wrap.find( '.mb-media__clear' ).prop( 'hidden', false );
		} );
		frame.open();
	} );

	$( document ).on( 'click', '.mb-media__clear', function ( e ) {
		e.preventDefault();
		var $wrap = $( this ).closest( '.mb-media' );
		$wrap.find( 'input[type=hidden]' ).val( '' );
		$wrap.find( '.mb-media__preview' ).empty();
		$( this ).prop( 'hidden', true );
	} );
}( jQuery ) );
