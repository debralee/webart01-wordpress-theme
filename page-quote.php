<?php

/**
 * Quote page template for WebArt01.
 *
 * Built for the FREE version of Advanced Custom Fields (no Repeater fields).
 *
 * @package WebArt01
 */

get_header('secondary');

$field = static function (string $name, string $fallback = '') {
    $value = get_field($name);
    return ($value !== null && $value !== '' && $value !== false) ? $value : $fallback;
};

// Image fields (Return Format: Image Array).
$graphic_decoration = get_field('graphic_decoration');

$graphic_url = (is_array($graphic_decoration) && ! empty($graphic_decoration['url']))
    ? $graphic_decoration['url']
    : get_theme_file_uri('assets/images/circle_2.png');

?>

<main class="relative overflow-hidden bg-white px-4 pb-16 pt-16 md:pt-40">

    <!-- Centered container: left column flexes, right column is a fixed 32rem (the form card) -->
    <div class="mx-auto grid max-w-5xl items-center gap-8 lg:grid-cols-[minmax(0,1fr)_32rem] lg:gap-12">

        <!-- Left: image, heading, description -->
        <div>
            <img class="hidden w-[180px] opacity-40 lg:float-right lg:block" src="<?php echo esc_url($graphic_url); ?>" alt="" aria-hidden="true">

            <div class="clear-both pb-4 sm:pb-6">
                <h1 class="mt-1 text-xl font-semibold leading-snug text-navy md:text-2xl">
                    <?php echo esc_html($field('quote_header', 'Get a Quote')); ?>
                </h1>
            </div>

            <p class="max-w-lg text-sm text-slate-600 md:text-base">
                <?php echo esc_html($field('quote_description', 'Request a free quote today.')); ?>
            </p>
        </div>

        <!-- Right: form card (no outer margin, so it sits flush with the container edge) -->
        <div class="mx-auto w-full max-w-lg rounded-xl border border-slate-200 border-t-4 border-t-teal bg-white p-5 shadow-lg sm:p-6 lg:mx-0">
            <?php
            if (shortcode_exists('ninja_form')) {
                echo do_shortcode('[ninja_form id=5]');
            } else {
                echo 'The requested component is currently unavailable.';
            }
            ?>
        </div>

    </div>
</main>

<?php
get_footer();
