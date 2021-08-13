<?php

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'ks_setup' ) ) :

	function ks_setup() {
		
		load_theme_textdomain( 'ks', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		add_theme_support( 'title-tag' );

		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 730, 480, true ); // размер миниатюры поста по умолчанию
		// add_image_size( 'ks-blog-thumbs', 350, 227, true );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'ks_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

	
	}
endif;
add_action( 'after_setup_theme', 'ks_setup' );


function ks_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'ks_content_width', 640 );
}
add_action( 'after_setup_theme', 'ks_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ks_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar Blog', 'ks' ),
			'id'            => 'sidebar-blog',
			'description'   => esc_html__( 'Add widgets here.', 'ks' ),
			'before_widget' => '<section id="%1$s" class="sidebar-widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h5 class="widget-title mb-3">',
			'after_title'   => '</h5>',
		)
	);
}
add_action( 'widgets_init', 'ks_widgets_init' );
// старый вид сайдбара в админке
add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' );
add_filter( 'use_widgets_block_editor', '__return_false' );

/**
 * Enqueue scripts and styles.
 */
require get_template_directory() . '/inc/enqueue-scripts.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

// добавляем возможность добавлеия своего лого через настройки темы
if (! function_exists	('ks_setup_logo')) {
	function ks_setup_logo() {
		add_theme_support( 'custom-logo', [
			'height'      => 50,
			'width'       => 80,
			'flex-width'  => false,
			'flex-height' => false,
			'header-text' => '',
			'unlink-homepage-logo' => false, // WP 5.5
		] );
	}
	add_action('after_setup_theme', 'ks_setup_logo');
}

// добавление класса в лого
add_filter( 'get_custom_logo', 'change_logo_class' );
function change_logo_class( $html ) {
	$html = str_replace( 'custom-logo-link', 'navbar-brand', $html );
    $html = str_replace( 'custom-logo', 'img-fluid b-logo', $html );
    return $html;
}

// добавляем зоны меню
function ks_menus() {
	$locations = array(
		'header_menu' => __('Меню в шапке', 'ks'),
		'footer_menu' => __('Меню в подвале', 'ks'),
	);
	register_nav_menus($locations);
}
add_action( 'init', 'ks_menus');


// Walker для кустомного меню на bootsrap
class bootstrap_4_walker_nav_menu extends Walker_Nav_menu {
    
    function start_lvl( &$output, $depth = 0, $args = array() ){ // ul
        $indent = str_repeat("\t",$depth); // indents the outputted HTML
        $submenu = ($depth > 0) ? ' sub-menu' : '';
        $output .= "\n$indent<ul class=\"dropdown-menu$submenu depth_$depth\">\n";
    }
  
  function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ){ // li a span
        
    $indent = ( $depth ) ? str_repeat("\t",$depth) : ''; 
    $li_attributes = '';
    $class_names = $value = '';
    
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;    
        $classes[] = ($args->walker->has_children) ? 'dropdown' : '';
        $classes[] = ($item->current || $item->current_item_anchestor) ? 'active' : '';
        $classes[] = 'nav-item';
        $classes[] = 'nav-item-' . $item->ID;
        if( $depth && $args->walker->has_children ){
            $classes[] = 'dropdown-menu';
        }
        
        $class_names =  join(' ', apply_filters('nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = ' class="' . esc_attr($class_names) . '"';
        
        $id = apply_filters('nav_menu_item_id', 'menu-item-'.$item->ID, $item, $args);
        $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
        
        $output .= $indent . '<li ' . $id . $value . $class_names . $li_attributes . '>';
        
        $attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= ! empty( $item->target ) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr($item->url) . '"' : '';
        
        $attributes .= ( $args->walker->has_children ) ? ' class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : ' class="nav-link"';
        
        $item_output = $args->before;
        $item_output .= ( $depth > 0 ) ? '<a class="dropdown-item"' . $attributes . '>' : '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;
        
        $output .= apply_filters ( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

// отключаем создание миниатюр файлов для указанных размеров
add_filter( 'intermediate_image_sizes', 'ks_delete_intermediate_image_sizes' );
function ks_delete_intermediate_image_sizes( $sizes ){
	// размеры которые нужно удалить
	return array_diff( $sizes, [
		'medium_large',
		'large',
		'1536x1536',
		'2048x2048',
	] );
}

// удаляет H2 из шаблона пагинации
add_filter('navigation_markup_template', 'my_navigation_template', 10, 2 );
function my_navigation_template( $template, $class ){
	return '
	<nav class="navigation %1$s" role="navigation">
		<div class="nav-links">%3$s</div>
	</nav>    
	';
}

function wporg_only_title_home_page( $title )
{
    if ( is_home() || is_front_page() ) {
        $title = get_bloginfo( 'name' );
    }
 
    return $title;
}
add_filter( 'pre_get_document_title', 'wporg_only_title_home_page' );




// собственный виджет Download_Widget
class Download_Widget extends WP_Widget {

	// Регистрация виджета используя основной класс
	function __construct() {
		// вызов конструктора выглядит так:
		// __construct( $id_base, $name, $widget_options = array(), $control_options = array() )
		parent::__construct(
			'download_widget', // ID виджета, если не указать (оставить ''), то ID будет равен названию класса в нижнем регистре: download_widget
			'Полезные файлы',
			array( 'description' => 'Прикрепите ссылки на полезные файлы', 'classname' => 'download', )
		);

		// скрипты/стили виджета, только если он активен
		if ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() ) {
			add_action('wp_enqueue_scripts', array( $this, 'add_download_widget_scripts' ));
			add_action('wp_head', array( $this, 'add_download_widget_style' ) );
		}
	}

	/**
	 * Вывод виджета во Фронт-энде
	 *
	 * @param array $args     аргументы виджета.
	 * @param array $instance сохраненные данные из настроек
	 */
	function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		$file_name = $instance['file_name'];
		$file = $instance['file'];

		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		echo '<a href="' .$file. '" target=_blank><i class="fa fa-file-pdf"></i>' .$file_name. '</a>';
		echo $args['after_widget'];
	}

	/**
	 * Админ-часть виджета
	 *
	 * @param array $instance сохраненные данные из настроек
	 */
	function form( $instance ) {
		$title = @ $instance['title'] ?: 'Полезные файлы';
		$file_name = @ $instance['file_name'] ?: 'Название файла';
		$file = @ $instance['file'] ?: 'Ссылка на файл';

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'file_name' ); ?>"><?php _e( 'Название файла:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'file_name' ); ?>" name="<?php echo $this->get_field_name( 'file_name' ); ?>" type="text" value="<?php echo esc_attr( $file_name ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'file' ); ?>"><?php _e( 'Ссылка на файл:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'file' ); ?>" name="<?php echo $this->get_field_name( 'file' ); ?>" type="text" value="<?php echo esc_attr( $file ); ?>">
		</p>
		<?php
	}

	/**
	 * Сохранение настроек виджета. Здесь данные должны быть очищены и возвращены для сохранения их в базу данных.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance новые настройки
	 * @param array $old_instance предыдущие настройки
	 *
	 * @return array данные которые будут сохранены
	 */
	function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['file_name'] = ( ! empty( $new_instance['file_name'] ) ) ? strip_tags( $new_instance['file_name'] ) : '';
		$instance['file'] = ( ! empty( $new_instance['file'] ) ) ? strip_tags( $new_instance['file'] ) : '';

		return $instance;
	}

	// скрипт виджета
	function add_download_widget_scripts() {
		// фильтр чтобы можно было отключить скрипты
		if( ! apply_filters( 'show_download_widget_script', true, $this->id_base ) )
			return;

		$theme_url = get_template_directory_uri();

		// wp_enqueue_script('download_widget_script', $theme_url .'/download_widget_script.js' );
	}

	// стили виджета
	function add_download_widget_style() {
		// фильтр чтобы можно было отключить стили
		if( ! apply_filters( 'show_download_widget_style', true, $this->id_base ) )
			return;
		?>
		<style type="text/css">
			.download_widget a{ display:inline; }
		</style>
		<?php
	}

}
// конец класса Download_Widget

// регистрация Download_Widget в WordPress
function register_download_widget() {
	register_widget( 'Download_Widget' );
}
add_action( 'widgets_init', 'register_download_widget' );
