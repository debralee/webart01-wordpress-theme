<?php

/**
 * The header for the WebArt01 theme.
 *
 * @package WebArt01
 */

if (! defined('ABSPATH')) {
    exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class('bg-white text-slate'); ?>>
    <?php wp_body_open(); ?>

    <header id="wa-header"
        class="group fixed inset-x-0 top-0 z-50 text-white bg-navy transition-colors duration-300
		       data-[scrolled=true]:bg-navy data-[scrolled=true]:shadow-lg
		       data-[open=true]:bg-navy">

        <div class="mx-auto flex max-w-screen-xl flex-wrap items-center justify-between p-4">

            <!-- Logo -->
            <?php if (function_exists('the_custom_logo') && has_custom_logo()) : ?>
                <?php
                $logo_id  = get_theme_mod('custom_logo');
                $logo_src = wp_get_attachment_image_url($logo_id, 'full');
                ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center">
                    <img src="<?php echo esc_url($logo_src); ?>"
                        alt="<?php bloginfo('name'); ?>"
                        class="h-14 w-auto transition-all duration-300 md:h-20 group-data-[scrolled=true]:md:h-14">
                </a>
            <?php else : ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center text-2xl font-bold">
                    <?php bloginfo('name'); ?>
                </a>
            <?php endif; ?>
            <!-- Mobile toggle -->
            <button id="wa-toggle" type="button"
                class="inline-flex h-10 w-10 items-center justify-center rounded-lg p-2 hover:bg-white/10 focus:outline-none focus-visible:ring-2 focus-visible:ring-white/60 md:hidden"
                aria-controls="wa-menu" aria-expanded="false" aria-label="Open main menu">
                <!-- Hamburger -->
                <svg class="h-6 w-6 group-data-[open=true]:hidden" aria-hidden="true" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h14" />
                </svg>
                <!-- Close -->
                <svg class="hidden h-6 w-6 group-data-[open=true]:block" aria-hidden="true" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M6 6l12 12M18 6L6 18" />
                </svg>
            </button>

            <!-- Menu -->
            <nav id="wa-menu" aria-label="Primary"
                class="hidden w-full group-data-[open=true]:block md:block md:w-auto">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container'      => false,
                    'depth'          => 2,
                    'fallback_cb'    => false,
                    'walker'         => new WebArt_Walker_Nav(),
                    'items_wrap'     => '<ul class="flex flex-col pb-4 pt-2 font-medium md:flex-row md:items-center md:gap-8 md:p-0">%3$s</ul>',
                ));
                ?>
            </nav>

        </div>
    </header>