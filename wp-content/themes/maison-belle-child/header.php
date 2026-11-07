<?php
/**
 * Site header: skip link, announcement bar, sticky header, mobile menu.
 *
 * @package MaisonBelleChild
 */

defined( 'ABSPATH' ) || exit;

$mb_announcement = (string) mb_s( 'announcement' );
$mb_phone        = (string) mb_s( 'phone' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<?php /* The viewport meta tag is printed by the parent theme through wp_head(). */ ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a href="#main" class="skip-link"><?php esc_html_e( 'Skip to content', 'maison-belle-child' ); ?></a>

<?php if ( $mb_announcement || $mb_phone ) : ?>
	<div class="announce on-dark">
		<div class="container-x announce__inner">
			<p class="announce__text"><?php echo esc_html( $mb_announcement ); ?></p>
			<?php if ( $mb_phone ) : ?>
				<a href="tel:<?php echo esc_attr( mb_phone_tel() ); ?>" class="announce__phone">
					<?php echo mb_icon( 'phone', 'ico ico--xs' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<?php echo esc_html( $mb_phone ); ?>
				</a>
			<?php endif; ?>
		</div>
	</div>
<?php endif; ?>

<header class="site-header" id="site-header">
	<div class="container-x site-header__inner">
		<?php /* A text wordmark already names the link; an uploaded logo gets the salon name as its alt text. */ ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-header__brand">
			<?php mb_wordmark(); ?>
		</a>

		<nav aria-label="<?php esc_attr_e( 'Primary', 'maison-belle-child' ); ?>" class="site-nav">
			<?php mb_nav( 'primary', 'desktop', 'site-nav__list' ); ?>
		</nav>

		<div class="site-header__actions">
			<?php mb_book_button( array( 'size' => 'sm', 'class' => 'site-header__book' ) ); ?>
			<button type="button" class="nav-toggle" id="menu-toggle" aria-label="<?php esc_attr_e( 'Open menu', 'maison-belle-child' ); ?>" aria-expanded="false" aria-controls="mobile-menu">
				<?php echo mb_icon( 'menu', 'ico ico--lg' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</button>
		</div>
	</div>
</header>

<?php /* Mobile menu: a sibling of the header, because backdrop-filter would trap position:fixed inside it. */ ?>
<div id="mobile-menu" class="mobile-menu on-dark" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e( 'Menu', 'maison-belle-child' ); ?>" hidden>
	<div class="container-x mobile-menu__top">
		<?php mb_wordmark( true ); ?>
		<button type="button" class="mobile-menu__close" id="menu-close" aria-label="<?php esc_attr_e( 'Close menu', 'maison-belle-child' ); ?>">
			<?php echo mb_icon( 'close', 'ico ico--lg' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</button>
	</div>
	<nav aria-label="<?php esc_attr_e( 'Mobile', 'maison-belle-child' ); ?>" class="container-x mobile-menu__nav">
		<?php mb_nav( 'primary', 'mobile', 'mobile-menu__list' ); ?>
		<div class="mobile-menu__actions">
			<?php
			mb_book_button( array( 'variant' => 'light', 'class' => 'btn--grow' ) );
			mb_call_button(
				array(
					'variant' => 'ghost-light',
					'class'   => 'btn--grow',
					'label'   => __( 'Call us', 'maison-belle-child' ),
					'icon'    => mb_icon( 'phone', 'ico ico--sm' ),
				)
			);
			?>
		</div>
	</nav>
</div>

<main id="main" class="site-main">
