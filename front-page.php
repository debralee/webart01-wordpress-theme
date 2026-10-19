<?php

/**
 * Front page template for WebArt01.
 *
 * Built for the FREE version of Advanced Custom Fields (no Repeater fields).
 *
 * @package WebArt01
 */

get_header();

/**
 * Small helper: returns the ACF field value, or a fallback if it is empty.
 * Declared as a closure so it can't clash with other functions.
 */
$field = static function (string $name, string $fallback = '') {
	$value = get_field($name);
	return ($value !== null && $value !== '' && $value !== false) ? $value : $fallback;
};

// Hero background (field Return Format: Image URL).
$hero_bg = get_field('hero_bg');

// Images (field Return Format: Image Array).
$welcome_img = get_field('welcome_image');
$offer_img   = get_field('offer_image');

// How many numbered badges / offers the template looks for.
$badge_count = 3;
$offer_count = 7;
?>

<!-- HERO ==================================================== -->
<?php if ($hero_bg) : ?>
	<section class="relative bg-navy bg-cover bg-left-top text-white p-4"
		style="background-image:url('<?php echo esc_url($hero_bg); ?>')">
	<?php else : ?>
		<section class="relative bg-navy bg-[url('../images/webArtHero.jpg')] bg-cover bg-left-top text-white p-4">
		<?php endif; ?>

		<div class="mx-auto max-w-6xl px-4 pt-20 pb-20 md:w-1/2 md:pb-28">
			<h1 class="text-2xl font-bold text-white lg:text-4xl mt-5">
				<?php echo esc_html($field('hero_heading', 'Your Business. Your Website. Your Online Presence.')); ?>
			</h1>

			<?php $hero_sub = $field('hero_subheading', 'Professional Websites for Small Businesses'); ?>
			<h2 class="mt-2 text-lg text-white/90 lg:text-2xl">
				<?php echo esc_html($hero_sub); ?>
			</h2>

			<?php if ($hero_text = get_field('hero_text')) : ?>
				<div class="mt-4 space-y-3 text-white/90">
					<?php echo wp_kses_post($hero_text); ?>
				</div>
			<?php endif; ?>

			<a
				href="<?php echo esc_url($field('hero_button_url', '#contact')); ?>"
				class="mt-6 inline-block rounded bg-teal px-6 py-3 font-semibold text-white transition hover:bg-badge">
				<?php echo esc_html($field('hero_button_text', "Let's Build Your Website")); ?>
			</a>
		</div>

		<!-- Circle badges: straddle the hero and the section below -->
		<ul class="relative z-10 mx-auto -mb-16 flex max-w-4xl flex-col items-center gap-6 px-4 md:flex-row md:justify-around md:gap-4">
			<?php for ($i = 1; $i <= $badge_count; $i++) : ?>
				<?php
				$badge_label = get_field("badge_{$i}_label");
				$badge_link   = get_field("badge_{$i}_link");

				if (! $badge_label) {
					continue;
				}
				?>
				<li>
					<a
						href="<?php echo esc_url($badge_link['url'] ?? '#'); ?>"
						class="group grid size-32 place-items-center rounded-full border-4 border-white bg-navy text-center font-bold text-white transition
					 hover:bg-badge lg:size-36">
						<?php echo esc_html($badge_label); ?>
					</a>
				</li>
			<?php endfor; ?>
		</ul>
		</section>

		<!-- WELCOME =================================================== -->
		<section class="pt-24 pb-12">
			<div class="mx-auto grid max-w-6xl gap-8 px-4 md:grid-cols-2 md:items-center">
				<div>
					<?php if ($welcome_img) : ?>
						<?php
						echo wp_get_attachment_image(
							$welcome_img['ID'],
							'large',
							false,
							array('class' => 'w-full rounded')
						);
						?>
					<?php else : ?>
						<img
							src="<?php echo esc_url(get_theme_file_uri('assets/images/devices_3.jpg')); ?>"
							alt="<?php esc_attr_e('Responsive website shown on multiple devices', 'webart01'); ?>"
							class="w-full rounded">
					<?php endif; ?>
				</div>

				<div class="md:border-l md:border-slate/20 md:pl-8">
					<?php if ($welcome_heading = get_field('welcome_heading')) : ?>
						<h2 class="text-navy text-lg font-semibold sm:text-xl"><?php echo esc_html($welcome_heading); ?></h2>
					<?php endif; ?>

					<?php if ($welcome_content = get_field('welcome_content')) : ?>
						<div class="mt-4 space-y-4 text-slate">
							<?php echo wp_kses_post($welcome_content); ?>
						</div>
					<?php endif; ?>

					<?php if (get_field('welcome_link_text') && get_field('welcome_link_url')) : ?>
						<a href="<?php echo esc_url(get_field('welcome_link_url')); ?>" class="mt-4 inline-block font-semibold text-teal hover:text-badge">
							<?php echo esc_html(get_field('welcome_link_text')); ?>
						</a>
					<?php endif; ?>
				</div>
			</div>
		</section>

		<!-- WHAT WE OFFER ============================================= -->
		<section class="bg-gradient-to-b from-navy to-ice px-4 py-16 text-white">
			<div class="mx-auto grid max-w-6xl gap-10 md:grid-cols-2 md:items-start">
				<div>
					<?php if ($offer_heading = get_field('offer_heading')) : ?>
						<h3 class="text-white text-lg font-semibold sm:text-xl"><?php echo esc_html($offer_heading); ?></h3>
					<?php endif; ?>

					<ul class="mt-4 list-outside list-disc space-y-4 pl-5">
						<?php for ($i = 1; $i <= $offer_count; $i++) : ?>
							<?php
							$offer_title = get_field("offer_{$i}_title");

							$offer_desc  = get_field("offer_{$i}_description");

							if (! $offer_title) {
								continue;
							}
							?>
							<li>
								<h4 class="text-white font-semibold"><?php echo esc_html($offer_title); ?></h4>
								<?php if ($offer_desc) : ?>
									<p><?php echo esc_html($offer_desc); ?></p>
								<?php endif; ?>
							</li>
						<?php endfor; ?>
					</ul>
				</div>

				<div class="rounded border border-white/40 p-2">
					<?php if ($offer_img) : ?>
						<?php
						echo wp_get_attachment_image(
							$offer_img['ID'],
							'large',
							false,
							array('class' => 'w-full rounded')
						);
						?>
					<?php else : ?>
						<img
							src="<?php echo esc_url(get_theme_file_uri('assets/images/website_development.jpg')); ?>"
							alt="<?php esc_attr_e('Website development illustration', 'webart01'); ?>"
							class="w-full rounded">
					<?php endif; ?>
				</div>
			</div>
		</section>

		<?php
		get_footer();
