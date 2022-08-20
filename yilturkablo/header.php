<!doctype html>
<html <?php language_attributes(); ?> class="no-js">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style/style.css">
	<?php wp_head(); ?>

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

	<link href="<?php echo get_template_directory_uri(); ?>/img/favicon/favicon.ico" rel="shortcut icon">
	<link href="<?php echo get_template_directory_uri(); ?>/img/favicon/favicon.png" rel="apple-touch-icon-precomposed">


</head>

<body <?php body_class(); ?>>
	<header>
		<div class="tepe">
			<div class="konten">
				<div class="sol">
					<ul class="cizgili">
						<li><a rel="nofollow" href="tel:0533 456 1465"><i class="fa fa-phone"></i> 0533 456 1465</a></li>
						<li class="mob-sil"><a rel="nofollow" href="mailto:satis@yilturkablo.com"><i class="fa fa-envelope"></i> satis@yilturkablo.com</a></li>
						<li class="mob-sil"><a rel="nofollow" target="_blank" href="https://www.google.com.tr/maps/search/balaban+mahallesi+uzungöl+caddesi+b+blok+no+:4+silivri+istanbul/@41.0963233,28.3543141,10z/data=!3m1!4b1?hl=tr"><i class="fa fa-map-marker"></i> Google Harita</a></li>
					</ul>
				</div>
				<div class="sag">
					<form class="search" method="get" action="http://localhost/yilturkablo" role="search">
						<input class="search-input" type="search" name="s" placeholder="Arama..">
						<button class="search-submit" type="submit" role="button"><i class="fa fa-search"></i></button>
					</form>
					<ul class="sosyal">
						<li><a rel="nofollow" target="_blank" href=""><i class="fa fa-instagram"></i></a></li>
						<li><a rel="nofollow" href="https://wa.me/+9005334561465/?text=Merhaba"><i class="fa fa-whatsapp"></i></a></li>
					</ul>
				</div>
			</div>
		</div>

	</header>
	<div class="bot-nav">
		<div class="konten">
			<div class="logo">
				<a href="/">
					<picture>
						<source srcset="<?php echo get_template_directory_uri(); ?>/img/logo.webp" type="image/webp">
						<img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" title="Başgül Grup" alt="Başgül grup solar enerji, güneş enerji ve led aydınlatma sistemleri">
					</picture>
				</a>
			</div>
			<div class="mobile-navigation">
				<div class="cizgi"></div>
				<div class="cizgi"></div>
				<div class="cizgi"></div>
				<div class="cizgi"></div>
			</div>
			<nav class="navigation">
				<?php html5blank_nav(); ?>
			</nav>
		</div>
	</div>