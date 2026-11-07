/**
 * Maison Belle Child — front-end interactions (vanilla JS, no dependencies).
 *
 * Modules: sticky header, mobile menu, scroll reveal, review carousel,
 * gallery filter + lightbox, services category nav, contact form success card.
 * Everything degrades gracefully: without JS the content is fully visible.
 */
( function () {
	'use strict';

	var doc = document;
	var win = window;
	var reduceMotion = win.matchMedia && win.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;

	/** Tiny helpers. */
	function $( sel, root ) { return ( root || doc ).querySelector( sel ); }
	function $$( sel, root ) { return Array.prototype.slice.call( ( root || doc ).querySelectorAll( sel ) ); }

	/* ───────────── Sticky header shadow ───────────── */
	( function header() {
		var el = $( '#site-header' );
		if ( ! el ) { return; }
		function onScroll() { el.classList.toggle( 'is-scrolled', win.scrollY > 8 ); }
		// First run inside an animation frame so reading scrollY never forces an early layout.
		win.requestAnimationFrame( onScroll );
		win.addEventListener( 'scroll', onScroll, { passive: true } );
	}() );

	/* ───────────── Mobile menu (dialog behaviour, focus trap, Escape) ───────────── */
	( function mobileMenu() {
		var menu = $( '#mobile-menu' );
		var openBtn = $( '#menu-toggle' );
		var closeBtn = $( '#menu-close' );
		if ( ! menu || ! openBtn || ! closeBtn ) { return; }

		function open() {
			menu.hidden = false;
			menu.classList.add( 'is-open' );
			openBtn.setAttribute( 'aria-expanded', 'true' );
			doc.body.style.overflow = 'hidden';
			closeBtn.focus();
			doc.addEventListener( 'keydown', onKey );
		}
		function close( returnFocus ) {
			menu.hidden = true;
			menu.classList.remove( 'is-open' );
			openBtn.setAttribute( 'aria-expanded', 'false' );
			doc.body.style.overflow = '';
			doc.removeEventListener( 'keydown', onKey );
			if ( returnFocus ) { openBtn.focus(); }
		}
		function onKey( e ) {
			if ( e.key === 'Escape' ) { close( true ); return; }
			if ( e.key !== 'Tab' ) { return; }
			var items = $$( 'a[href], button:not([disabled])', menu );
			if ( ! items.length ) { return; }
			var first = items[ 0 ];
			var last = items[ items.length - 1 ];
			if ( e.shiftKey && doc.activeElement === first ) { e.preventDefault(); last.focus(); }
			else if ( ! e.shiftKey && doc.activeElement === last ) { e.preventDefault(); first.focus(); }
		}

		openBtn.addEventListener( 'click', open );
		closeBtn.addEventListener( 'click', function () { close( true ); } );
		$$( 'a', menu ).forEach( function ( a ) { a.addEventListener( 'click', function () { close( false ); } ); } );
		win.addEventListener( 'resize', function () { if ( win.innerWidth >= 1024 && ! menu.hidden ) { close( false ); } } );
	}() );

	/* ───────────── Scroll reveal ───────────── */
	( function reveal() {
		var els = $$( '.reveal' );
		if ( ! els.length ) { return; }
		if ( reduceMotion || ! ( 'IntersectionObserver' in win ) ) {
			els.forEach( function ( el ) { el.classList.add( 'is-visible' ); } );
			return;
		}
		var io = new IntersectionObserver( function ( entries ) {
			entries.forEach( function ( entry ) {
				if ( entry.isIntersecting ) {
					entry.target.classList.add( 'is-visible' );
					io.unobserve( entry.target );
				}
			} );
		}, { threshold: 0.12, rootMargin: '0px 0px -6% 0px' } );
		els.forEach( function ( el ) { io.observe( el ); } );
	}() );

	/* ───────────── Google Map: load only when it is close to the viewport ───────────── */
	( function lazyMaps() {
		var maps = $$( 'iframe[data-src]' );
		if ( ! maps.length ) { return; }
		function load( f ) { f.src = f.getAttribute( 'data-src' ); f.removeAttribute( 'data-src' ); }
		if ( ! ( 'IntersectionObserver' in win ) ) { maps.forEach( load ); return; }
		var io = new IntersectionObserver( function ( entries ) {
			entries.forEach( function ( entry ) {
				if ( entry.isIntersecting ) { load( entry.target ); io.unobserve( entry.target ); }
			} );
		}, { rootMargin: '200px 0px' } );
		maps.forEach( function ( f ) { io.observe( f ); } );
	}() );

	/* ───────────── Review carousel ───────────── */
	( function carousel() {
		$$( '[data-carousel]' ).forEach( function ( track ) {
			var wrap = track.parentNode;
			var prev = $( '[data-carousel-prev]', wrap );
			var next = $( '[data-carousel-next]', wrap );
			var current = $( '[data-carousel-current]', wrap );
			var bar = $( '[data-carousel-bar]', wrap );
			var cards = $$( 'li', track );
			if ( ! cards.length ) { return; }

			function step() {
				return cards[ 0 ].getBoundingClientRect().width + 24;
			}
			function go( dir ) {
				track.scrollBy( { left: dir * step(), behavior: reduceMotion ? 'auto' : 'smooth' } );
			}
			function update() {
				var index = Math.min( cards.length - 1, Math.max( 0, Math.round( track.scrollLeft / step() ) ) );
				if ( current ) { current.textContent = '0' + ( index + 1 ); }
				if ( bar ) { bar.style.width = ( ( index + 1 ) / cards.length * 100 ) + '%'; }
			}
			if ( prev ) { prev.addEventListener( 'click', function () { go( -1 ); } ); }
			if ( next ) { next.addEventListener( 'click', function () { go( 1 ); } ); }
			track.addEventListener( 'scroll', update, { passive: true } );
		} );
	}() );

	/* ───────────── Gallery: filter + lightbox ───────────── */
	( function gallery() {
		$$( '[data-gallery]' ).forEach( function ( root ) {
			var list = $( '[data-gallery-list]', root );
			var filterBtns = $$( '[data-filter]', root );
			var box = $( '[data-lightbox]', root );
			if ( ! list ) { return; }
			var items = $$( '.gallery__item', list );
			var current = -1;

			/* Filter */
			filterBtns.forEach( function ( btn ) {
				btn.addEventListener( 'click', function () {
					var cat = btn.getAttribute( 'data-filter' );
					filterBtns.forEach( function ( b ) {
						var on = b === btn;
						b.classList.toggle( 'is-active', on );
						b.setAttribute( 'aria-pressed', on ? 'true' : 'false' );
					} );
					items.forEach( function ( li ) {
						li.hidden = cat !== '*' && li.getAttribute( 'data-cat' ) !== cat;
					} );
					// Replay the soft fade-in, like the approved design.
					list.classList.remove( 'fade-in' );
					void list.offsetWidth;
					list.classList.add( 'fade-in' );
				} );
			} );

			/* Lightbox */
			if ( ! box || typeof box.showModal !== 'function' ) { return; }
			var frame = $( '[data-lb-frame]', box );
			var title = $( '[data-lb-title]', box );
			var meta = $( '[data-lb-meta]', box );

			function visibleTriggers() {
				return items.filter( function ( li ) { return ! li.hidden; } ).map( function ( li ) { return $( '[data-lightbox-trigger]', li ); } );
			}
			function show( index ) {
				var triggers = visibleTriggers();
				if ( ! triggers.length ) { return; }
				current = ( index + triggers.length ) % triggers.length;
				var t = triggers[ current ];
				var src = $( '.si', t );
				if ( src && frame ) {
					var clone = src.cloneNode( true );
					clone.className = 'si group si--rounded lb-img' + ( t.getAttribute( 'data-aspect' ) === 'wide' ? ' lb-img--wide' : '' );
					clone.style.setProperty( '--ico', '5rem' );
					clone.style.setProperty( '--ico-md', '5rem' );
					$$( '.si--zoom', clone ).forEach( function ( n ) { n.classList.remove( 'si--zoom' ); } );
					$$( 'img', clone ).forEach( function ( img ) { img.sizes = '90vw'; img.loading = 'eager'; } );
					frame.replaceChildren( clone );
				}
				if ( title ) { title.textContent = t.getAttribute( 'data-alt' ) || ''; }
				if ( meta ) { meta.textContent = ( t.getAttribute( 'data-cat' ) || '' ) + ' · ' + ( current + 1 ) + ' / ' + triggers.length; }
			}
			function open( index ) {
				show( index );
				if ( ! box.open ) { box.showModal(); doc.body.style.overflow = 'hidden'; }
			}
			function step( dir ) { show( current + dir ); }

			items.forEach( function ( li ) {
				var t = $( '[data-lightbox-trigger]', li );
				if ( t ) {
					t.addEventListener( 'click', function () { open( visibleTriggers().indexOf( t ) ); } );
				}
			} );
			$( '[data-lb-close]', box ).addEventListener( 'click', function () { box.close(); } );
			$( '[data-lb-prev]', box ).addEventListener( 'click', function () { step( -1 ); } );
			$( '[data-lb-next]', box ).addEventListener( 'click', function () { step( 1 ); } );
			box.addEventListener( 'click', function ( e ) { if ( e.target === box ) { box.close(); } } );
			box.addEventListener( 'close', function () { doc.body.style.overflow = ''; current = -1; } );
			box.addEventListener( 'keydown', function ( e ) {
				if ( e.key === 'ArrowRight' ) { step( 1 ); }
				if ( e.key === 'ArrowLeft' ) { step( -1 ); }
			} );
		} );
	}() );

	/* ───────────── Services: highlight the category in view ───────────── */
	( function categoryNav() {
		var nav = $( '[data-cat-nav]' );
		if ( ! nav || ! ( 'IntersectionObserver' in win ) ) { return; }
		var links = $$( 'a[href^="#"]', nav );
		var map = {};
		var sections = [];
		links.forEach( function ( a ) {
			var id = a.getAttribute( 'href' ).slice( 1 );
			var section = doc.getElementById( id );
			if ( section ) { map[ id ] = a; sections.push( section ); }
		} );
		if ( ! sections.length ) { return; }
		var io = new IntersectionObserver( function ( entries ) {
			var visible = entries.filter( function ( e ) { return e.isIntersecting; } ).sort( function ( a, b ) { return b.intersectionRatio - a.intersectionRatio; } );
			if ( ! visible.length ) { return; }
			var id = visible[ 0 ].target.id;
			links.forEach( function ( a ) {
				var on = a === map[ id ];
				a.classList.toggle( 'is-active', on );
				if ( on ) { a.setAttribute( 'aria-current', 'true' ); } else { a.removeAttribute( 'aria-current' ); }
			} );
		}, { rootMargin: '-30% 0px -55% 0px', threshold: [ 0, 0.25, 0.5, 1 ] } );
		sections.forEach( function ( s ) { io.observe( s ); } );
	}() );

	/* ───────────── Contact Form 7: friendly success card ───────────── */
	( function contactSuccess() {
		var holder = $( '.contact__form' );
		var card = holder ? $( '[data-form-success]', holder ) : null;
		if ( ! holder || ! card ) { return; }
		var cf7 = $( '.wpcf7', holder );
		if ( ! cf7 ) { return; }

		doc.addEventListener( 'wpcf7mailsent', function ( e ) {
			if ( ! cf7.contains( e.target ) ) { return; }
			var first = '';
			( ( e.detail && e.detail.inputs ) || [] ).forEach( function ( input ) {
				if ( input.name === 'your-name' ) { first = String( input.value ).trim().split( /\s+/ )[ 0 ]; }
			} );
			var nameEl = $( '[data-form-name]', card );
			if ( nameEl ) { nameEl.textContent = first ? ', ' + first : ''; }
			cf7.hidden = true;
			card.hidden = false;
			card.focus( { preventScroll: true } );
		} );
		var again = $( '[data-form-again]', card );
		if ( again ) {
			again.addEventListener( 'click', function () {
				card.hidden = true;
				cf7.hidden = false;
				var firstField = $( 'input[type=text]', cf7 );
				if ( firstField ) { firstField.focus(); }
			} );
		}
	}() );
}() );
