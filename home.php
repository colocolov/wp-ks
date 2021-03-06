<?php get_header(); ?>

<!--MAIN BANNER AREA START -->
<div class="page-banner-area page-contact" id="page-banner">
    <div class="overlay dark-overlay"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 m-auto text-center col-sm-12 col-md-12">
                <div class="banner-content content-padding">
                    <h1 class="text-white">Promodise журнал</h1>
                    <p>Полезные статьи про маркетинг и диджитал</p>
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
                <?php $cnt = 0; // счетчик
                    if ( have_posts() ) : while ( have_posts() ) : the_post(); 
                    $cnt ++;
                    switch ($cnt) {
                        case '3': ?>
                
                <div class="col-lg-12">
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

                <?php break; default: ?>
                
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

                <?php break; } 
                endwhile; else : ?>
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
              
            <?php get_sidebar(); ?>
               
        </div>
    </div>
</section>

<?php get_footer(); ?>