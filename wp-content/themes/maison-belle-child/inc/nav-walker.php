<?php
/**
 * Menu walker producing the design's markup for the desktop and mobile menus.
 *
 * Pass 'walker' => new MB_Nav_Walker( 'desktop' | 'mobile' | 'footer' ) and 'depth' => 1.
 *
 * @package MaisonBelleChild
 */

defined( 'ABSPATH' ) || exit;

/**
 * Class MB_Nav_Walker
 */
class MB_Nav_Walker extends Walker_Nav_Menu {

	/**
	 * Output mode.
	 *
	 * @var string
	 */
	private $mode;

	/**
	 * Running item counter (for the 01, 02... numbers in the mobile menu).
	 *
	 * @var int
	 */
	private $count = 0;

	/**
	 * Constructor.
	 *
	 * @param string $mode desktop|mobile|footer.
	 */
	public function __construct( $mode = 'desktop' ) {
		$this->mode = $mode;
	}

	/**
	 * We never render nested lists (one level only).
	 *
	 * @param string   $output Output.
	 * @param int      $depth  Depth.
	 * @param stdClass $args   Args.
	 */
	public function start_lvl( &$output, $depth = 0, $args = null ) {}

	/**
	 * End of a nested level.
	 *
	 * @param string   $output Output.
	 * @param int      $depth  Depth.
	 * @param stdClass $args   Args.
	 */
	public function end_lvl( &$output, $depth = 0, $args = null ) {}

	/**
	 * Is the item the current page or one of its ancestors (e.g. Blog on a post)?
	 *
	 * @param WP_Post $item Menu item.
	 * @return bool
	 */
	private function is_active( $item ) {
		if ( is_404() || is_search() ) {
			return false; // WordPress marks the Posts page as "parent" on these screens; do not highlight it.
		}
		$flags = array( 'current-menu-item', 'current-menu-ancestor', 'current-menu-parent', 'current_page_parent', 'current_page_ancestor' );
		return (bool) array_intersect( $flags, (array) $item->classes );
	}

	/**
	 * Start an item.
	 *
	 * @param string   $output Output.
	 * @param WP_Post  $item   Menu item.
	 * @param int      $depth  Depth.
	 * @param stdClass $args   Args.
	 * @param int      $id     Item ID.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		++$this->count;
		$active = $this->is_active( $item );
		$label  = esc_html( $item->title );
		$href   = esc_url( $item->url );
		$aria   = $active ? ' aria-current="page"' : '';

		if ( 'desktop' === $this->mode ) {
			$output .= sprintf(
				'<li><a href="%1$s" class="nav-link%2$s"%3$s>%4$s<span class="nav-link__bar"></span></a></li>',
				$href,
				$active ? ' is-active' : '',
				$aria,
				$label
			);
		} elseif ( 'mobile' === $this->mode ) {
			$output .= sprintf(
				'<li class="mm-item"><a href="%1$s" class="mm-link" style="--i:%2$d"%3$s><span%4$s>%5$s</span><span class="mm-num">0%2$d</span></a></li>',
				$href,
				$this->count,
				$aria,
				$active ? ' class="is-active"' : '',
				$label
			);
		} else {
			$output .= sprintf( '<li><a href="%1$s"%2$s>%3$s</a></li>', $href, $aria, $label );
		}
	}

	/**
	 * End an item (we print complete <li> in start_el).
	 *
	 * @param string   $output Output.
	 * @param WP_Post  $item   Menu item.
	 * @param int      $depth  Depth.
	 * @param stdClass $args   Args.
	 */
	public function end_el( &$output, $item, $depth = 0, $args = null ) {}
}

/**
 * Print a menu location with the design's markup. Falls back to the standard pages.
 *
 * @param string $location Theme location.
 * @param string $mode     desktop|mobile|footer.
 * @param string $ul_class Class for the <ul>.
 */
function mb_nav( $location, $mode, $ul_class = '' ) {
	$has = has_nav_menu( $location );
	if ( $has ) {
		wp_nav_menu(
			array(
				'theme_location' => $location,
				'container'      => false,
				'items_wrap'     => '<ul class="' . esc_attr( $ul_class ) . '">%3$s</ul>',
				'depth'          => 1,
				'walker'         => new MB_Nav_Walker( $mode ),
			)
		);
		return;
	}
	// Fallback: no menu assigned yet. Show Home + published top-level pages.
	$walker_items = get_pages( array( 'sort_column' => 'menu_order,post_title', 'parent' => 0 ) );
	echo '<ul class="' . esc_attr( $ul_class ) . '">';
	echo '<li><a href="' . esc_url( home_url( '/' ) ) . '" class="nav-link">' . esc_html__( 'Home', 'maison-belle-child' ) . '<span class="nav-link__bar"></span></a></li>';
	foreach ( $walker_items as $page ) {
		if ( (int) get_option( 'page_on_front' ) === (int) $page->ID ) {
			continue;
		}
		echo '<li><a href="' . esc_url( get_permalink( $page ) ) . '" class="nav-link">' . esc_html( get_the_title( $page ) ) . '<span class="nav-link__bar"></span></a></li>';
	}
	echo '</ul>';
}
