<footer>
    <div class="konten">
        <div class="bol-3">
            <div class="f-bas">İletişim</div>
            <ul>
                <li><a rel="nofollow" href="tel:0533 456 1465"><i class="fa fa-phone"></i> 0533 456 1465</a></li>
                <li><a rel="nofollow" href="tel:0533 456 1465"><i class="fa fa-phone"></i> 0533 457 1465</a></li>
                <li class="mob-sil"><a rel="nofollow" href="mailto:satis@yilturkablo.com"><i class="fa fa-envelope"></i> satis@yilturkablo.com</a></li>
                <li class="mob-sil"><a rel="nofollow" href="mailto:muhasebe@yilturkablo.com"><i class="fa fa-envelope"></i> muhasebe@yilturkablo.com</a></li>
                <li class="mob-sil"><a rel="nofollow" target="_blank" href="https://www.google.com.tr/maps/search/balaban+mahallesi+uzungöl+caddesi+b+blok+no+:4+silivri+istanbul/@41.0963233,28.3543141,10z/data=!3m1!4b1?hl=tr"><i class="fa fa-map-marker"></i> Balaban Mahallesi Uzungöl Caddesi B:blok No:4 Silivri İstanbul</a></li>
            </ul>
        </div>
        <div class="bol-3">
            <div class="f-bas">Site Haritası</div>
            <?php html5blank_nav(); ?>
        </div>
        <div class="bol-3">
            <div class="f-bas">Google Harita</div>
            <a rel="nofollow" target="_blank" href="">
                <picture class="lazy-picture">
                    <source srcset="<?php echo get_template_directory_uri(); ?>/img/img-placeholder.webp" data-srcset="<?php echo get_template_directory_uri(); ?>/img/harita.webp" type="image/webp">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/img-placeholder.jpg" data-src="<?php echo get_template_directory_uri(); ?>/img/harita.png" alt="test urun" loading="lazy">
                </picture>
            </a>
        </div>
        <div class="temizle"></div>
        <div class="copyright">© Yıltur Kablo 2022 , Tüm Hakları Saklıdır.
            <span> <a href="https://websitesimark.com/" rel="noreferrer" target="_blank">Markon Bilişim</a></span>
        </div>
    </div>
</footer>


<script type="text/javascript" async>
    (function() {
        var css = document.createElement('link');
        css.href = 'https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;700&display=swap';
        css.rel = 'stylesheet';
        css.type = 'text/css';
        document.getElementsByTagName('head')[0].appendChild(css);
    })();
</script>
<script type="text/javascript" async>
    (function() {
        var css = document.createElement('link');
        css.href = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css';
        css.rel = 'stylesheet';
        css.type = 'text/css';
        document.getElementsByTagName('head')[0].appendChild(css);
    })();
</script>



<!-- Genel -->
<script defer>
    if (window.innerWidth < 950) {

        var el = document.querySelector('.mobile-navigation');
        var elle = document.querySelector('.navigation');

        el.onclick = function() {
            elle.classList.toggle('active');
        }

        const list = document.querySelectorAll(".menu-item-has-children > a");
        for (const el of list) {
            var newEl = '<i class="fa fa-angle-down"></i>';
            el.insertAdjacentHTML('afterend', '<i class="fa fa-angle-down"></i>');
        }

        var mobileSub = document.querySelectorAll(".menu-item-has-children .fa-angle-down");
        var i;

        for (i = 0; i < mobileSub.length; i++) {
            mobileSub[i].addEventListener("click", function(ev) {
                ev.preventDefault();
                this.classList.toggle("active");
                var panel = this.nextElementSibling;
                if (panel.style.display) {
                    panel.style.display = null;
                } else {
                    panel.style.display = "block";
                }
            });
        }
    }

    (function() {
        var menuElemss = document.querySelectorAll(".rank-math-list .rank-math-question");
        var ilkfaq = document.querySelector(".rank-math-question");
        ilkfaq.classList.add("faq-renk");
        var ilki = document.querySelector(".rank-math-answer");
        ilki.classList.add("show");
        menuElemss.forEach(function(elems) {
            elems.addEventListener("click", function() {
                menuElemss.forEach(function(e) {
                    e.classList.remove("faq-renk");
                    e.nextElementSibling.classList.remove("show");
                })
                elems.classList.add("faq-renk");
                elems.nextElementSibling.classList.add("show");
            }, false)
        });
    })();
</script>

<!-- Lazy img -->
<script>
    const imgObserver = new IntersectionObserver((entries, self) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                lazyLoad(entry.target);
                self.unobserve(entry.target);
            }
        });
    });
    document.querySelectorAll('.lazy-picture').forEach((picture) => {
        imgObserver.observe(picture);
    });
    const lazyLoad = (picture) => {
        const img = picture.querySelector('img');
        const sources = picture.querySelectorAll('source');

        sources.forEach((source) => {
            source.srcset = source.dataset.srcset;
            source.removeAttribute('data-srcset');
        });
        img.src = img.dataset.src;
        img.removeAttribute('data-src');
    }
</script>
<script defer>
    document.addEventListener("DOMContentLoaded", function() {
        var lazyloadImages;

        if ("IntersectionObserver" in window) {
            lazyloadImages = document.querySelectorAll(".lazy");
            var imageObserver = new IntersectionObserver(function(entries, observer) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        var image = entry.target;
                        image.classList.remove("lazy");
                        imageObserver.unobserve(image);
                    }
                });
            });

            lazyloadImages.forEach(function(image) {
                imageObserver.observe(image);
            });
        } else {
            var lazyloadThrottleTimeout;
            lazyloadImages = document.querySelectorAll(".lazy");

            function lazyload() {
                if (lazyloadThrottleTimeout) {
                    clearTimeout(lazyloadThrottleTimeout);
                }

                lazyloadThrottleTimeout = setTimeout(function() {
                    var scrollTop = window.pageYOffset;
                    lazyloadImages.forEach(function(img) {
                        if (img.offsetTop < (window.innerHeight + scrollTop)) {
                            img.src = img.dataset.src;
                            img.classList.remove('lazy');
                        }
                    });
                    if (lazyloadImages.length == 0) {
                        document.removeEventListener("scroll", lazyload);
                        window.removeEventListener("resize", lazyload);
                        window.removeEventListener("orientationChange", lazyload);
                    }
                }, 20);
            }

            document.addEventListener("scroll", lazyload);
            window.addEventListener("resize", lazyload);
            window.addEventListener("orientationChange", lazyload);
        }
    })
</script>

<!-- Youtube Lazy -->
<script type="text/javascript">
    (function() {
        var youtube = document.querySelectorAll('.yt-lazyload');
        for (var i = 0; i < youtube.length; i++) {

            //VARIABLES
            var data_id = youtube[i].dataset.id,
                data_random = youtube[i].dataset.random, //TO DO: In future versions - change to data_thumb [breaking change!!!] [??????]
                yt_image = new Image(),
                yt_playbtn = document.createElement('div'),
                yt_logo = document.createElement('a');

            //image - thumbnail
            yt_image.classList.add('yt-lazyload-img');
            yt_image.src = 'https://img.youtube.com/vi/' + data_id + data_random + '/maxresdefault.jpg';
            yt_image.alt = '';

            //load thumbail after they are loaded
            yt_image.addEventListener('load', function() {
                youtube[i].appendChild(yt_image);
            }(i));

            //play btn
            yt_playbtn.classList.add('yt-lazyload-playbtn');
            youtube[i].appendChild(yt_playbtn);

            //logo link
            //TO DO: In future versions - if data-logo="0" do not create this [??????]
            yt_logo.classList.add('yt-lazyload-logo');
            yt_logo.href = 'https://youtu.be/' + data_id;
            yt_logo.target = '_blank';
            yt_logo.rel = 'noreferrer';
            youtube[i].appendChild(yt_logo);

            //create iframe onclick play-btn
            youtube[i].querySelector('.yt-lazyload-playbtn').addEventListener('click', function() {
                var yt_container = this.parentElement,
                    yt_iframe = document.createElement('iframe');

                yt_iframe.src = 'https://www.youtube.com/embed/' + yt_container.dataset.id + '?autoplay=1';
                yt_iframe.setAttribute('allow', 'accelerometer;autoplay;encrypted-media;gyroscope;picture-in-picture');
                yt_iframe.setAttribute('allowfullscreen', '');
                yt_container.appendChild(yt_iframe);
            });

        }
    })();
</script>
<!-- Slider -->
<script defer>
    var controls = document.querySelectorAll('.controls');
    for (var i = 0; i < controls.length; i++) {
        controls[i].style.display = 'inline-block';
    }

    var slides = document.querySelectorAll('#slides .slide');
    var totalSlides = document.querySelectorAll('#slides .slide').length;
    var dots = document.getElementById('slider-dots');

    for (let i = 0; i < totalSlides; i++) {
        dots.innerHTML += '<li class="dot"></li>'
    }

    var currentSlide = 0;
    var slideInterval = setInterval(nextSlide, 4000);
    var dotElem = document.querySelectorAll('#slider-dots .dot');

    function nextSlide() {
        goToSlide(currentSlide + 1);
    }

    function previousSlide() {
        goToSlide(currentSlide - 1);
    }

    function goToSlide(n) {
        slides[currentSlide].className = 'slide';
        dotElem[currentSlide].className = 'dot';

        currentSlide = (n + slides.length) % slides.length;

        slides[currentSlide].className = 'slide showing';
        dotElem[currentSlide].className = 'dot showing';
    }


    var playing = true;
    var pauseButton = document.getElementById('pause');

    function pauseSlideshow() {
        pauseButton.innerHTML = '&#9658;';
        playing = false;
        clearInterval(slideInterval);
    }

    function playSlideshow() {
        pauseButton.innerHTML = '&#10074;&#10074;';
        playing = true;
        slideInterval = setInterval(nextSlide, 4000);
    }

    pauseButton.onclick = function() {
        if (playing) {
            pauseSlideshow();
        } else {
            playSlideshow();
        }
    };

    var next = document.getElementById('next');
    var previous = document.getElementById('previous');

    next.onclick = function() {
        pauseSlideshow();
        nextSlide();
    };
    previous.onclick = function() {
        pauseSlideshow();
        previousSlide();
    };
</script>

</body>

</html>