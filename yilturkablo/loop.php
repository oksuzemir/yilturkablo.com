<?php if (have_posts()): while (have_posts()) : the_post(); ?>

	<!-- article -->

	<div class="fifth-blog-card">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="fifth-blog-card-header">
              <a href="<?php the_permalink(); ?>">

              <?php if ( has_post_thumbnail()) : ?>
          							
                        <picture class="lazy-picture">
                          <source srcset="<?php echo get_template_directory_uri(); ?>/img/img-placeholder.webp" data-srcset="<?php echo wp_get_attachment_image_url(get_post_meta(get_the_ID(), 'second_featured_image', true), 'medium'); ?>" type="image/webp">
                          <img src="<?php echo get_template_directory_uri(); ?>/img/img-placeholder.jpg" data-src="<?php the_post_thumbnail_url('medium'); ?>" loading="lazy" alt="<?php the_title(); ?>">
                        </picture>
        
                               <?php else: ?>
                                <picture class="lazy-picture">
                      <source srcset="<?php echo get_template_directory_uri(); ?>/img/img-placeholder.webp" data-srcset="<?php echo get_template_directory_uri(); ?>/img/bos-img.webp" type="image/webp">
                      <img width="250" height="72" src="<?php echo get_template_directory_uri(); ?>/img/img-placeholder.png" data-src="<?php echo get_template_directory_uri(); ?>/img/bos-img.jpg" loading="lazy" >
                    </picture>
                             <?php endif; ?>

              </a>
              <div class="fifth-blog-date">
                <span> <?php the_time('j'); ?></span>
                <span> <?php the_time('F'); ?></span>
              </div>
            </div>
            <div class="fifth-blog-card-content ciz">
              <div class="fifth-blog-title">
                <h2> <a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a> </h2>
              </div>
              <div class="fifth-blog-text">
                <p><?php html5wp_excerpt('html5wp_index'); ?></p>
              </div>
            </div>
			</article>
          </div>

	

<?php endwhile; ?>

<?php else: ?>

<?php endif; ?>


