<?php

/**
 * Social media marketing page template for WebArt01.
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
$service_img        = get_field('service_image');
$graphic_decoration = get_field('graphic_decoration');

$offer_count = 5;

$graphic_url = (is_array($graphic_decoration) && ! empty($graphic_decoration['url']))
    ? $graphic_decoration['url']
    : get_theme_file_uri('assets/images/circle_2.png');

$image_classes = 'block w-full max-w-[400px] h-auto rounded-3xl border border-navy/70 bg-white p-4';
$image_alt = __('Social Media Icons', 'webart01');
?>


<main class="relative overflow-hidden bg-white px-4 pb-16 pt-16 md:pt-40">
    <div class="mx-auto grid gap-4 sm:grid-cols-2 sm:gap-8 lg:grid-cols-[minmax(0,1fr)_32rem] lg:gap-12 max-w-5xl">
        <div class="flex sm:justify-end sm:mr-8">
            <div class="pb-4 sm:pb-8">

                <!-- Heading (left column, row 1) -->
                <header class="pb-4 sm:pb-8"">
                <p class=" text-sm font-medium text-slate">
                    <?php echo esc_html($field('service_intro', 'We Offer')); ?>
                    </p>
                    <h1 class="mt-1 text-xl leading-snug font-semibold text-navy md:text-2xl">
                        <?php echo esc_html($field('service_header', 'Social Media Marketing Services')); ?>
                    </h1>
                </header>

                <!-- Service image (left column, row 2) -->
                <div class="">
                    <?php if ($service_img) : ?>
                        <?php
                        echo wp_get_attachment_image(
                            $service_img['ID'],
                            'large',
                            false,
                            array('class' => $image_classes, 'alt' => $image_alt)
                        );
                        ?>
                    <?php else : ?>
                        <img src="<?php echo esc_url(get_theme_file_uri('assets/images/social_media.jpg')); ?>"
                            alt="<?php echo esc_attr($image_alt); ?>"
                            class="<?php echo esc_attr($image_classes); ?>">
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Offers (right column, spans both rows) -->


        <div class="sm:pt-8 relative">
            <img class="hidden md:opacity-20 lg:float-right lg:block w-[150px] absolute md:-top-10 md:-right-10" src="<?php echo esc_url($graphic_url); ?>" alt="" aria-hidden="true">
            <h2 class="text-lg font-medium text-navy md:text-xl pb-4 sm:pb-8">
                <?php echo esc_html($field('offers_heading', 'Our Approach to Social Media Marketing')); ?>
            </h2>
            <ul class="max-w-800px sm:list-disc">
                <?php for ($i = 1; $i <= $offer_count; $i++) : ?>
                    <?php
                    $offer = get_field('offer_' . $i . '_subheading');
                    if (! $offer) {
                        continue;
                    }
                    ?>
                    <li>
                        <h3 class="text-sm font-semibold text-slate md:text-base">
                            <?php echo esc_html($offer); ?>
                        </h3>
                        <p class="text-sm text-slate md:text-base">
                            <?php echo esc_html($field('offer_' . $i . '_description')); ?>
                        </p>
                    </li>
                <?php endfor; ?>
            </ul>
</main>

<?php
get_footer();
