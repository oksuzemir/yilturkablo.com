<?php /* Template Name: Anasayfa */ get_header(); ?>

<section id="slider">
  <ul id="slides">

    <?php dynamic_sidebar('widget-area-1'); ?>
  </ul>
  <div class="konten">
    <div class="buttons">
      <button class="controls" id="previous"><i class="fa fa-angle-double-left"></i></button>
      <button class="controls" id="pause">&#10074;&#10074;</button>
      <button class="controls" id="next"><i class="fa fa-angle-double-right"></i></button>
    </div>
  </div>
  <ul id="slider-dots"></ul>
</section>
<section class="ilk bos">
  <div class="konten">
    <div class="ortala">
      <h1><?php the_title(); ?></h1>
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
          <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <?php the_content(); ?>
          </div>
        <?php endwhile; ?>
      <?php else : ?>
      <?php endif; ?>

    </div>

  </div>
</section>
<section class="fourth-section">
            <div class="konten">
                <div class="fourth-section-inner">
                <?php dynamic_sidebar('anasayfa-card'); ?>       
                </div>
            </div>
</section>
<section class="second-content">
	<?php dynamic_sidebar('widget-area-2'); ?>
</section>

<section id="blog">
            <div class="konten">
                <div class="grup-baslik">Blog</div>
                <div class="bol-uce">
                <?php
              $temp = $wp_query;
              $wp_query = null;
              $wp_query = new WP_Query();
              $wp_query->query('cat=1&showposts=12' . '&paged=' . $paged); ?>
              <?php if (have_posts()) : ?>
            <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

            
              <article>
                      <div class="blog-w">
                          <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">  

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

                              <time datetime="F j, Y"><?php the_time('F j, Y'); ?></time>
                          </a>
                          <div class="blog-icerik">
                              <span class="blog-bas"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
                              <p><?php html5wp_excerpt('html5wp_index'); ?></p>
                          </div>  
                      </div>   
                  </article> 
                 <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
          <?php endif; ?>
          </div> 
                <div class="temizle"></div>
                <div class="tumu">
                    <a title="Blog" href="/blog">Tüm Yazılar</a>
                </div>
            </div>
        </section>


<?php get_footer(); ?>

