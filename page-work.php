<?php

/**
 * Work page template for WebArt01.
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
$cta = get_field('call_to_action_button');

// Image fields (Return Format: Image Array).

$graphic_decoration = get_field('graphic_decoration');
$work_count = 4;

$graphic_url = (is_array($graphic_decoration) && ! empty($graphic_decoration['url']))
    ? $graphic_decoration['url']
    : get_theme_file_uri('assets/images/circle_2.png');

$image_classes = 'w-full max-w-[400px] h-auto rounded-3xl border border-navy/70 bg-white p-4';
$image_alt = __('Example of our work.', 'webart01');
?>


<main class="relative overflow-hidden bg-white px-4 pb-16 pt-16 md:pt-40">
    <div class="mx-auto grid gap-4 sm:grid-cols-2 lg:grid-cols-4">

        <!-- Heading (left column, row 1) -->
        <div class="pb-4 sm:pb-8 sm:col-span-2">
            <p class=" text-sm font-medium text-slate">
                <?php echo esc_html($field('work_intro', 'Our Work')); ?>
            </p>
            <h1 class="mt-1 text-xl leading-snug font-semibold text-navy md:text-2xl">
                <?php echo esc_html($field('work_header', 'Websites Built With Purpose')); ?>
            </h1>
            <p class="mt-2 text-sm text-slate">
                <?php echo esc_html($field('work_description', 'Description of our work.')); ?>
            </p>
        </div>

        <!-- CTA (middle column, row 1) -->
        <div class="pb-4 sm:pb-8 text-center sm:text-start lg:text-end sm:mt-4">
            <h2 class="mt-1 text-lg leading-snug font-semibold text-navy md:text-xl">
                <?php echo esc_html($field('call_to_action_header', 'Do you have a project in mind?')); ?>
            </h2>
            <p class="mt-2 text-sm text-slate">
                <?php echo esc_html($field('call_to_action', 'We are excited to hear about it!')); ?>
            </p>
            <?php if ($cta) : ?>
                <a href="<?php echo esc_url($cta['url']); ?>">
                    <button class="mt-4 inline-block rounded bg-lime-600 px-6 py-2 text-black hover:text-white hover:bg-lime-800">
                        <?php echo esc_html($cta['title']); ?>
                    </button>
                </a>
            <?php endif; ?>
        </div>

        <!-- gears decoration image (right column, row 1) -->
        <div class="pb-4 sm:pb-8 text-center sm:text-end sm:mt-4">
            <img class="hidden md:opacity-20 lg:float-right lg:block w-[150px]" src="<?php echo esc_url($graphic_url); ?>" alt="" aria-hidden="true">
        </div>

    </div>
    <!-- Work 5 columns-->

    <div class="mx-auto grid gap-4 sm:grid-cols-2 lg:grid-cols-4">

        <?php for ($i = 1; $i <= $work_count; $i++) : ?>
            <?php
            $work_image = get_field('work_' . $i . '_image');
            $work_link  = get_field('work_' . $i . '_link');

            if (! is_array($work_image) || empty($work_image['ID'])) {
                continue;
            }
            if (! is_array($work_link) || empty($work_link['url'])) {
                continue;
            }

            $link_target = ! empty($work_link['target']) ? $work_link['target'] : '_self';
            $link_rel    = ('_blank' === $link_target) ? ' rel="noopener noreferrer"' : '';
            ?>
            <div class="group">
                <a href="<?php echo esc_url($work_link['url']); ?>"
                    target="<?php echo esc_attr($link_target); ?>" <?php echo $link_rel; ?>
                    class="relative block overflow-hidden rounded-3xl border border-navy/70 bg-white p-4 shadow-sm transition-all duration-300 ease-out hover:-translate-y-1 hover:shadow-xl focus-visible:-translate-y-1 focus-visible:shadow-xl">

                    <?php
                    echo wp_get_attachment_image(
                        $work_image['ID'],
                        'large',
                        false,
                        array(
                            'class' => 'w-full h-auto rounded-2xl transition-transform duration-500 ease-out group-hover:scale-105 group-focus-within:scale-105',
                            'alt'   => ! empty($work_image['alt']) ? $work_image['alt'] : $image_alt,
                        )
                    );
                    ?>

                    <!-- Hover overlay -->
                    <span class="pointer-events-none absolute inset-4 flex items-center justify-center rounded-2xl bg-navy/60 opacity-0 transition-opacity duration-300 group-hover:opacity-100 group-focus-within:opacity-100">
                        <span class="translate-y-2 rounded bg-lime-600 px-6 py-2 text-black transition-all duration-300 group-hover:translate-y-0 group-focus-within:translate-y-0 hover:bg-lime-800">
                            Visit Site
                        </span>
                    </span>
                </a>
            </div>
        <?php endfor; ?>

        <!-- <img class="hidden opacity-50 md:block absolute top-50 right-25 w-[203px]" src="<?php echo esc_url($graphic_url); ?>" alt="" aria-hidden="true"> -->
    </div>

</main>

<?php
get_footer();
