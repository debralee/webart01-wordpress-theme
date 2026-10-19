<?php

/**
 * About page template for WebArt01.
 *
 * Built for the FREE version of Advanced Custom Fields (no Repeater fields).
 *
 * @package WebArt01
 */

get_header('secondary');

/**
 * Returns the ACF field value, or a fallback if it is empty.
 */
$field = static function (string $name, string $fallback = '') {
    $value = get_field($name);
    return $value ? $value : $fallback;
};

// Image fields (Return Format: Image Array).
$member_1_img   = get_field('member_1_image');
$member_2_img   = get_field('member_2_image');
$circle_graphic = get_field('circle_graphic');

$member_1_name = $field('member_1_name', 'Debra Rivera');
$member_2_name = $field('member_2_name', 'Adolfo Rivera');

$graphic_url = $circle_graphic
    ? $circle_graphic['url']
    : get_theme_file_uri('assets/images/circle_2.png');

/**
 * Renders a member photo: the ACF image if set, otherwise the theme fallback.
 */
$member_photo = static function ($img, string $fallback_file, string $name) {
    $classes = 'aspect-[4/5] w-full rounded-xl object-cover';

    if ($img) {
        echo wp_get_attachment_image($img['ID'], 'large', false, array('class' => $classes, 'alt' => $name));
        return;
    }
?>
    <img src="<?php echo esc_url(get_theme_file_uri('assets/images/' . $fallback_file)); ?>"
        alt="<?php echo esc_attr($name); ?>"
        class="<?php echo esc_attr($classes); ?>">
<?php
};
?>

<main>

    <!-- Team Section
         md:pt-40 pushes content below the fixed header. -->
    <section class="relative overflow-hidden bg-white px-4 pb-16 pt-16 md:pt-40">
        <div class="mx-auto max-w-screen-xl">

            <!-- Heading -->
            <header class="mb-10 md:mb-14">
                <p class="text-sm font-medium text-navy">
                    <?php echo esc_html($field('team_intro', 'Meet the people behind the work')); ?>
                </p>
                <h1 class="mt-1 text-xl font-semibold text-navy md:text-3xl">
                    <?php echo esc_html($field('team_header', 'Our Team')); ?>
                </h1>
            </header>

            <!-- DOM order = mobile order (card, text, card, text).
                 mobile: single column
                 md (iPad): 2 columns, card on top, text underneath
                 lg+: 4 columns, text sits beside each card, bottom-aligned with the cards.
                      The text columns stop growing at 17rem and the whole group is centered,
                      so on wide screens the text is indented from the heading like the design. -->
            <div class="grid items-start gap-6 md:grid-cols-2 md:gap-x-10 md:gap-y-6 lg:grid-cols-[minmax(0,17rem)_16rem_16rem_minmax(0,17rem)] lg:items-end lg:justify-center lg:gap-8">

                <!-- Member 1 -->
                <article class="rounded-3xl border border-navy/70 bg-white p-4 shadow-md md:col-start-1 md:row-start-1 md:w-full md:max-w-sm md:justify-self-center lg:col-start-2 lg:max-w-none">
                    <?php $member_photo($member_1_img, 'debbie.jpg', $member_1_name); ?>
                    <h2 class="mt-4 text-center text-xl font-semibold italic text-slate">
                        <?php echo esc_html($member_1_name); ?>
                    </h2>
                </article>

                <div class="md:col-start-1 md:row-start-2 md:mx-auto md:w-full md:max-w-sm lg:col-start-1 lg:row-start-1 lg:max-w-none lg:pb-4 lg:text-right">
                    <p class="text-slate"><?php echo esc_html($field('member_1_description')); ?></p>
                </div>

                <!-- Member 2 -->
                <article class="rounded-3xl border border-navy/70 bg-white p-4 shadow-md md:col-start-2 md:row-start-1 md:w-full md:max-w-sm md:justify-self-center lg:col-start-3 lg:max-w-none">
                    <?php $member_photo($member_2_img, 'aj.jpg', $member_2_name); ?>
                    <h2 class="mt-4 text-center text-xl font-semibold italic text-slate">
                        <?php echo esc_html($member_2_name); ?>
                    </h2>
                </article>

                <!-- lg+: this column is as tall as the cards (self-stretch) with the text pushed to
                     the bottom, so the gears can be placed against the top of the row. -->
                <div class="relative md:col-start-2 md:row-start-2 md:mx-auto md:w-full md:max-w-sm lg:col-start-4 lg:row-start-1 lg:flex lg:max-w-none lg:flex-col lg:justify-end lg:self-stretch lg:pb-4">
                    <!-- Gears graphic: lg+ only, above the text, slightly higher than the card tops. -->
                    <img class="pointer-events-none absolute hidden w-20 opacity-40 lg:-top-6 lg:right-6 lg:block"
                        src="<?php echo esc_url($graphic_url); ?>" alt="" aria-hidden="true">
                    <p class="text-slate"><?php echo esc_html($field('member_2_description')); ?></p>
                </div>

            </div>
        </div>
    </section>

    <!-- About Section
         Large bottom padding keeps the text in the dark part of the gradient
         so white copy stays readable. -->
    <section class="relative overflow-hidden bg-gradient-to-b from-navy via-navy via-70% to-ice px-4 pb-32 pt-16 text-white">
        <div class="mx-auto max-w-screen-xl">

            <header class="mb-8">
                <p class="text-sm font-medium text-white/80">
                    <?php echo esc_html($field('intro_about', 'Who we are')); ?>
                </p>
                <h2 class="mt-1 text-xl font-semibold text-white md:text-2xl">
                    <?php echo esc_html($field('about_header', 'About Us')); ?>
                </h2>
            </header>

            <!-- md: two equal columns. lg+: keeps the original spacer column on the right. -->
            <div class="grid gap-8 md:grid-cols-2 md:gap-10 lg:grid-cols-[1fr_1fr_8rem] lg:gap-12">
                <p class="max-w-prose text-white"><?php echo esc_html($field('about_description_1')); ?></p>
                <p class="max-w-prose text-white"><?php echo esc_html($field('about_description_2')); ?></p>
            </div>

        </div>
    </section>

</main>

<?php
get_footer();
