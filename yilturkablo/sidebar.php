<!-- sidebar -->
<aside class="sidebar" role="complementary">


<div class="sidebar-title">İlginizi Çekebilir</div>
<ul>	
<?php

while ( have_posts() ) {
	the_post();

	// Show current posts info
	// Show posts of current post categories
	$post_id = get_the_ID();
	$post_categories = wp_get_post_categories( $post_id );

	$query_args = array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'category__in' => $post_categories,
	);

	$query_res = new WP_Query($query_args);

	if ( $query_res->have_posts() ) {

		while ( $query_res->have_posts() ) {

			$query_res->the_post(); 
			?>
			 <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
			<?php
		}

	} else {

		echo '';
	}

	wp_reset_postdata();

}

?>
</ul>	
</aside>
<!-- /sidebar -->



