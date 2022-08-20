<?php get_header(); ?>
<div class="front-head">
      <div class="kontenf">

	  <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?> 

	 </div>
    </div>
	<main role="main" class="konten">
		<!-- section -->
		<section>

			<h1><?php echo sprintf( __( '%s : ', 'html5blank' ), $wp_query->found_posts ); echo get_search_query(); ?></h1>
			<div class="fifth-blog">
			<?php get_template_part('loop'); ?>
			</div>
			<?php get_template_part('pagination'); ?>

		</section>
		<!-- /section -->
	</main>
<?php get_footer(); ?>
