<?php get_header(); ?>

<!--MAIN BANNER AREA START -->
<div class="page-banner-area page-contact" id="page-banner">
    <div class="overlay dark-overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-sm-12 col-md-12">
                <div class="banner-content content-padding">
                    <h1 class="text-white">
											<?php
											printf( esc_html__( 'Результат поиска по&nbsp;фразе: %s', 'ks' ), '<span>' . get_search_query() . '</span>' );
											?>
										</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!--MAIN HEADER AREA END -->

<section class="section blog-wrap ">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                <?php 
                    if ( have_posts() ) : while ( have_posts() ) : the_post(); 
                ?>
                
                <div class="col-lg-6">
                    <div class="blog-post">
                        <?php 
                            // вывод миниатюры
                            if( has_post_thumbnail() ) {
                                the_post_thumbnail('post-thumbnails', array('class' => "img-fluid w-100"));
                            }
                            else { // если не задана миниатюра в записи
                                echo '<img class="img-fluid w-100" src="https://crisf.ru/wp/wp-content/uploads/2021/08/erik-mclean-sxisod0tyyq-unsplash.jpg" />';
                            }
                        ?>
                        <!-- <img src="images/blog/blog-1.jpg" alt="" class="img-fluid w-100"> -->
                        <div class="mt-4 mb-3 d-flex">
                            <div class="post-author mr-3">
                                <i class="fa fa-user"></i>
                                <span class="h6 text-uppercase"><?php the_author(); ?></span>
                            </div>

                            <div class="post-info mr-3">
                                <i class="fa fa-calendar-check"></i>
                                <span><?php the_time('j F Y'); ?></span>
                            </div>

                            <div class="post-category">
                                <i class="fa fa-th-large"></i>
                                <span><?php the_category(); ?></span>
                            </div>
                        </div>
                        <a href="<?php echo get_the_permalink(); ?>" class="h4 "><?php the_title(); ?></a>
                        <p class="mt-3"><?php echo get_the_excerpt(); ?></p>
                        <a href="<?php echo get_the_permalink(); ?>" class="read-more">Читать статью <i class="fa fa-angle-right"></i></a>
                    </div>
                </div>

                <?php endwhile; else : ?>
                        <p>Записей нет.</p>
                        <?php endif; ?>
                <div class="col-lg-12">
                    <?php the_posts_pagination( array(
                        'prev_text'    => __('<span class="p-2 border"> Назад </span>'),
                        'next_text'    => __('<span class="p-2 border"> Вперед </span>'),
                        'before_page_number' => '<span class="p-2 border">',
                        'after_page_number'  => '</span>',
                        'current'      => 1,
                    ) )?>
                </div>
                </div> 
            </div>
              
            <!-- // виждет -->
            <div class="col-lg-4">
                      <div class="row">
                        <div class="col-lg-12">
                            <?php if ( ! dynamic_sidebar('sidebar-blog')) : dynamic_sidebar('sidebar-blog'); endif; ?> 
                            <div class="sidebar-widget search">
                                <div class="form-group">
                                    <input type="text" placeholder="поиск" class="form-control">
                                    <i class="fa fa-search"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="sidebar-widget about-bar">
                                <h5 class="mb-3">О нас</h5>
                                <p>Мы — маркетинговое агентство полного цикла, которое оказывает диджитал услуги стартапам и крупным компаниям</p>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="sidebar-widget category">
                                <h5 class="mb-3">Рубрики</h5>
                                <ul class="list-styled">
                                    <li>Маркетинг</li>
                                    <li>Диджитал</li>
                                    <li>SEO</li>
                                    <li>Веб-дизайн</li>
                                    <li>Разработка</li>
                                    <li>Видео</li>
                                    <li>Подкаст</li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="sidebar-widget tag">
                                <a href="#">web</a>
                                <a href="#">development</a>
                                <a href="#">seo</a>
                                <a href="#">marketing</a>
                                <a href="#">branding</a>
                                <a href="#">web deisgn</a>
                                <a href="#">Tutorial</a>
                                <a href="#">Tips</a>
                                <a href="#">Design trend</a>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="sidebar-widget download">
                                <h5 class="mb-4">Полезные файлы</h5>
                                <a href="#"> <i class="fa fa-file-pdf"></i>Презентация Promodise</a>
                                <a href="#"> <i class="fa fa-file-pdf"></i>10 источников бесплатного SEO</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>   
        </div>
    </div>
</section>

<?php
get_footer();
