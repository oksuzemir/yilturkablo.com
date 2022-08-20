<?php get_header(); ?>

<div class="front-head">
      <div class="kontenf">

	  <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?> 

	 </div>
    </div>

	<main role="main" class="konten">
		<!-- section -->
		<section>

			<h1 class="page-title"><?php the_title(); ?></h1>
		<?php if (have_posts()): while (have_posts()) : the_post(); ?>

			<!-- article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php the_content(); ?>

			</article>
			<!-- /article -->

		<?php endwhile; ?>

		<?php else: ?>

		<?php endif; ?>

		</section>
		<!-- /section -->
	</main>

	<div class="yuksek"></div>
<?php get_footer(); ?>
