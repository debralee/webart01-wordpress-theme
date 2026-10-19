<?php

/**
 * Footer details come from Appearance → Customize → Contact & Social.
 */
$wa_email = get_theme_mod('webart_email', '');
$wa_phone = get_theme_mod('webart_phone', '');

$wa_socials = array(
	'Facebook'  => array(
		'url'  => get_theme_mod('webart_facebook', ''),
		'icon' => '<path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>',
	),
	'Instagram' => array(
		'url'  => get_theme_mod('webart_instagram', ''),
		'icon' => '<rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>',
	),
	'LinkedIn'  => array(
		'url'  => get_theme_mod('webart_linkedin', ''),
		'icon' => '<path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/>',
	),
);

$wa_has_socials = (bool) array_filter(wp_list_pluck($wa_socials, 'url'));
$wa_has_contact = ($wa_email || $wa_phone);
?>
<footer class="bg-navy text-white">
	<div class="mx-auto max-w-screen-xl px-4 py-12">

		<div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-4">

			<!-- Brand + social icons -->
			<div>
				<?php if (function_exists('the_custom_logo') && has_custom_logo()) : ?>
					<?php
					$logo_id  = get_theme_mod('custom_logo');
					$logo_src = wp_get_attachment_image_url($logo_id, 'full');
					?>

					<a href="<?php echo esc_url(home_url('/')); ?>" class="inline-block">
						<img src="<?php echo esc_url($logo_src); ?>"
							alt="<?php bloginfo('name'); ?>" class="h-14 w-auto">
					</a>
				<?php else : ?>
					<a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center text-2xl font-bold">
						<?php bloginfo('name'); ?>
					</a>
				<?php endif; ?>
				<?php if ($wa_has_socials) : ?>
					<ul class="mt-6 flex gap-3">
						<?php foreach ($wa_socials as $label => $social) : ?>
							<?php if (! empty($social['url'])) : ?>
								<li>
									<a href="<?php echo esc_url($social['url']); ?>"
										target="_blank" rel="noopener noreferrer"
										aria-label="<?php echo esc_attr($label); ?>"
										class="flex h-10 w-10 items-center justify-center rounded-full border border-white/20 text-white/80 transition-colors hover:border-ice hover:text-ice">
										<svg class="h-5 w-5" aria-hidden="true" viewBox="0 0 24 24" fill="none"
											stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
											<?php echo $social['icon']; // Static SVG markup defined above.
											?>
										</svg>
									</a>
								</li>
							<?php endif; ?>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>

			<!-- Services menu -->
			<?php if (has_nav_menu('footer_services')) : ?>
				<nav aria-labelledby="footer-services-heading">
					<h2 id="footer-services-heading" class="mb-4 text-sm font-semibold uppercase tracking-wider">Services</h2>
					<?php
					wp_nav_menu(array(
						'theme_location' => 'footer_services',
						'container'      => false,
						'depth'          => 1,
						'fallback_cb'    => false,
						'walker'         => new WebArt_Walker_Nav(),
						'wa_flat'        => true,
						'wa_link_class'  => 'text-sm text-white/80 hover:text-ice',
						'items_wrap'     => '<ul class="flex flex-col gap-2">%3$s</ul>',
					));
					?>
				</nav>
			<?php endif; ?>

			<!-- Pages menu -->
			<?php if (has_nav_menu('footer_pages')) : ?>
				<nav aria-labelledby="footer-pages-heading">
					<h2 id="footer-pages-heading" class="mb-4 text-sm font-semibold uppercase tracking-wider">Company</h2>
					<?php
					wp_nav_menu(array(
						'theme_location' => 'footer_pages',
						'container'      => false,
						'depth'          => 1,
						'fallback_cb'    => false,
						'walker'         => new WebArt_Walker_Nav(),
						'wa_flat'        => true,
						'wa_link_class'  => 'text-sm text-white/80 hover:text-ice',
						'items_wrap'     => '<ul class="flex flex-col gap-2">%3$s</ul>',
					));
					?>
				</nav>
			<?php endif; ?>

			<!-- Contact -->
			<?php if ($wa_has_contact) : ?>
				<div>
					<h2 class="mb-4 text-sm font-semibold uppercase tracking-wider">Contact</h2>
					<ul class="flex flex-col gap-3 text-sm text-white/80">

						<?php if ($wa_email) : ?>
							<li>
								<a href="mailto:<?php echo antispambot($wa_email); ?>" class="flex items-center gap-3 hover:text-ice">
									<svg class="h-5 w-5 shrink-0" aria-hidden="true" viewBox="0 0 24 24" fill="none"
										stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
										<path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
										<polyline points="22,6 12,13 2,6" />
									</svg>
									<span><?php echo esc_html(antispambot($wa_email)); ?></span>
								</a>
							</li>
						<?php endif; ?>

						<?php if ($wa_phone) : ?>
							<li>
								<a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $wa_phone)); ?>" class="flex items-center gap-3 hover:text-ice">
									<svg class="h-5 w-5 shrink-0" aria-hidden="true" viewBox="0 0 24 24" fill="none"
										stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
										<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
									</svg>
									<span><?php echo esc_html($wa_phone); ?></span>
								</a>
							</li>
						<?php endif; ?>

					</ul>
				</div>
			<?php endif; ?>

		</div>

		<!-- Copyright -->
		<div class="mt-10 border-t border-white/10 pt-6 text-sm text-white/60">
			&copy; <?php echo esc_html(gmdate('Y')); ?> <?php bloginfo('name'); ?>. All rights reserved.
		</div>

	</div>
</footer>

<?php wp_footer(); ?>
</body>

</html>