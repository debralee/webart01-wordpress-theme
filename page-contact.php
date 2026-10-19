<?php

/**
 * Contact page template for WebArt01.
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

// Collect the contact people (ACF fields contact_1_*, contact_2_*).
$contacts = [];
for ($i = 1; $i <= 2; $i++) {
    $name = get_field("contact_{$i}_name");
    if (! $name) {
        continue;
    }
    $contacts[] = [
        'name'  => $name,
        'phone' => get_field("contact_{$i}_phone"),
        'email' => get_field("contact_{$i}_email"),
    ];
}

?>



<main class="relative overflow-hidden bg-white px-4 pb-16 pt-16 md:pt-40">
    <div class="mx-auto grid gap-4 sm:grid-cols-3">
        <div class="flex sm:items-center sm:ml-8 width-[400px] md:width-1/2">
            <div class="pb-4 sm:pb-8">
                <img class="hidden md:opacity-40 md:float-right md:block w-[200px]" src="<?php echo esc_url($graphic_url); ?>" alt="" aria-hidden="true">

                <!-- Heading (left column, row 1) -->
                <div class="pb-4 sm:pb-8 clear-both">

                    <h1 class=" mt-1 text-xl leading-snug font-semibold text-navy md:text-2xl">
                        <?php echo esc_html($field('contact_header', 'Contact Us')); ?>
                    </h1>
                </div>

                <!-- Contact description (left column, row 2) -->
                <div class="mt-2 text-slate-600 text-sm md:text-base">
                    <?php echo esc_html($field('contact_description', 'We would love to hear from you.')); ?>
                </div>
            </div>
        </div>

        <!-- Contact form (right column, spans both rows) -->

        <div class="rounded-xl border border-slate-200 border-t-4 border-t-teal bg-white p-5 shadow-lg sm:p-6">

            <?php
            if (shortcode_exists('ninja_form')) {
                echo do_shortcode('[ninja_form id=2]');
            } else {
                echo 'The requested component is currently unavailable.';
            }
            ?>
        </div>

        <!-- Contact Cards -->
        <div class="sm:pt-8 p-4 sm:mr-8">
            <h2 class="text-lg font-medium text-navy md:text-xl pb-4 sm:pb-6">
                <?php echo esc_html($field('contact_cards_header', 'Our Contact Information')); ?>
            </h2>
            <ul class="mt-4 divide-y divide-slate-200 border-y border-slate-200">
                <?php foreach ($contacts as $contact) : ?>
                    <li class="py-5">
                        <p class="text-base font-semibold text-teal">
                            <?php echo esc_html($contact['name']); ?>
                        </p>

                        <?php if ($contact['phone']) : ?>
                            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $contact['phone'])); ?>"
                                class="mt-2 flex items-center gap-3 text-slate-700 hover:text-navy focus-visible:outline focus-visible:outline-2 focus-visible:outline-teal">
                                <svg class="h-4 w-4 shrink-0 text-navy" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 1.9.7 2.8a2 2 0 0 1-.5 2.1L8.1 9.9a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.4c.9.3 1.8.6 2.8.7a2 2 0 0 1 1.7 2z" />
                                </svg>
                                <span><?php echo esc_html($contact['phone']); ?></span>
                            </a>
                        <?php endif; ?>

                        <?php if ($contact['email']) : ?>
                            <a href="mailto:<?php echo esc_attr($contact['email']); ?>"
                                class="mt-1 flex items-center gap-3 break-all text-slate-700 hover:text-navy focus-visible:outline focus-visible:outline-2 focus-visible:outline-teal">
                                <svg class="h-4 w-4 shrink-0 text-navy" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <rect x="2" y="4" width="20" height="16" rx="2" />
                                    <path d="m22 7-10 6L2 7" />
                                </svg>
                                <span><?php echo esc_html($contact['email']); ?></span>
                            </a>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

</main>

<?php
get_footer();
