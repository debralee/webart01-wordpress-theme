<?php
/**
 * The main template file.
 *
 * This is the fallback WordPress requires every theme to have. It's used
 * for blog listings, search results, archives, etc. when no more specific
 * template (like front-page.php or single.php) applies.
 *
 * @package WebArt01
 */

get_header();
?>

<main class="mx-auto max-w-4xl px-4 py-12">

	<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>

			<article <?php post_class( 'mb-12 border-b border-slate/20 pb-8' ); ?>>
				<h2 class="text-navy">
					<a href="<?php the_permalink(); ?>" class="hover:text-badge">
						<?php the_title(); ?>
					</a>
				</h2>

				<p class="mt-1 text-sm text-slate/70">
					<?php echo esc_html( get_the_date() ); ?>
				</p>

				<div class="mt-4 text-slate">
					<?php the_excerpt(); ?>
				</div>

				<a href="<?php the_permalink(); ?>" class="mt-4 inline-block font-semibold text-teal hover:text-badge">
					<?php esc_html_e( 'Read more...', 'webart01' ); ?>
				</a>
			</article>

		<?php endwhile; ?>

		<?php the_posts_pagination(); ?>

	<?php else : ?>

		<p><?php esc_html_e( 'Nothing found.', 'webart01' ); ?></p>

	<?php endif; ?>

</main>

<?php
get_footer();
