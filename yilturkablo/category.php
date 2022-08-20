<?php get_header(); ?>
<div class="front-head">
	<div class="kontenf">
		<?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>

	</div>
</div>
<main role="main" class="konten fifth-contentz">
	<!-- section -->
	<section>

		<h1 class="page-title"><?php _e('', 'html5blank');
								single_cat_title(); ?></h1>
		<?php
		the_archive_description('<div class="cat-wrap">', '</div>');
		?>
		<?php if (category_has_children($cat) == false) : ?>

			<div class="fifth-blog">
				<?php get_template_part('loop'); ?>
			</div>
			<?php get_template_part('pagination'); ?>

		<?php endif; ?>


	</section>
	<!-- /section -->
</main>


<div class="konten">
	<?php if (is_category()) {
		$this_category = get_category($cat);
		if (get_category_children($this_category->cat_ID) != "") {
			echo '<div class="fifth-blog blog-cat">';
			$childcategories = get_categories(array(
				'orderyby' => 'name',
				'hide_empty' => false,
				'child_of' => $this_category->cat_ID
			));
			foreach ($childcategories as $category) {


	?>
				<div class="fifth-blog-card">

					<div class="fifth-blog-card-header">
						<a href="<?php echo get_category_link($category->term_id) ?>" title="<?php echo $category->name ?>">
							<picture class="lazy-picture">
								<source srcset="<?php echo get_template_directory_uri(); ?>/img/img-placeholder.webp" data-srcset="<?php echo z_taxonomy_image_url($category->term_id); ?>" type="image/webp">
								<img width="250" height="72" src="<?php echo get_template_directory_uri(); ?>/img/img-placeholder.png" data-src="<?php echo z_taxonomy_image_url($category->term_id); ?>" loading="lazy">
							</picture>
						</a>
					</div>
					<div class="fifth-blog-card-content ciz">
						<div class="fifth-blog-title">
							<h2> <a href="<?php echo get_category_link($category->term_id) ?>"> <?php echo $category->name ?> </a> </h2>
						</div>
					</div>
				</div>

	<?php
			}
			echo '</div>';
		} else {
			get_template_part('loop-header');
			if (have_posts()) :
				get_template_part('loop-actions');
				get_template_part('loop-content');
				get_template_part('loop-nav');
			else :
				get_template_part('loop-error');
			endif;
		}
	} ?>
	<?php
	?>
</div>

<div class="yuksek"></div>



<?php get_footer(); ?>