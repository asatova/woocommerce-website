<?php

/* подключение стилей и скриптов */
add_action( 'wp_enqueue_scripts', function(){

	wp_enqueue_style( 'open-sans-font', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,500,600,700,800' );
	wp_enqueue_style( 'playfair-font', 'https://fonts.googleapis.com/css?family=Playfair+Display' );

	wp_enqueue_style( 'bootstrap', get_stylesheet_directory_uri() . '/assets/css/vendor/bootstrap.min.css' );
	wp_enqueue_style( 'dl-icon', get_stylesheet_directory_uri() . '/assets/css/vendor/dl-icon.css' );
	wp_enqueue_style( 'fa', get_stylesheet_directory_uri() . '/assets/css/vendor/font-awesome.css' );
	wp_enqueue_style( 'helper', get_stylesheet_directory_uri() . '/assets/css/helper.min.css' );
	wp_enqueue_style( 'plugins', get_stylesheet_directory_uri() . '/assets/css/plugins.css' );
	wp_enqueue_style( 'main', get_stylesheet_directory_uri() . '/assets/css/style.css', array(), time() );

	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'bootstrap', get_stylesheet_directory_uri() . '/assets/js/bootstrap.min.js', 'jquery', null, true );
	wp_enqueue_script( 'plugins', get_stylesheet_directory_uri() . '/assets/js/plugins.js', 'jquery', null, true );
	wp_enqueue_script( 'scripts', get_stylesheet_directory_uri() . '/assets/js/scripts.js', array(), time(), true );

    wp_deregister_style('woocommerce-general');
     wp_deregister_style('woocommerce-layout');
});


/* регистрация меню */

register_nav_menus(
	array(
		'head_menu' => 'Меню в шапке',
		'foot_1' => 'Футер 1: Каталог',
		'foot_2' => 'Футер 2: Страницы',
		'foot_3' => 'Футер 3: Товары',
	)
);
remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination', 10);
add_action('woocommerce_after_shop_loop', 'custom_woocommerce_pagination', 10);

function custom_woocommerce_pagination() {
    global $wp_query;
    
    if ($wp_query->max_num_pages <= 1) {
        return;
    }
    
    $current_page = max(1, get_query_var('paged'));
    $max_pages = $wp_query->max_num_pages;
    ?>
    <nav class="page-pagination">
        <ul class="pagination justify-content-center">
            <?php
            // Previous page arrow
            if ($current_page > 1) {
                $prev_url = get_pagenum_link($current_page - 1);
                echo '<li><a href="' . $prev_url . '"><i class="fa fa-angle-double-left"></i></a></li>';
            }
            
            // Page numbers
            $start_page = max(1, $current_page - 2);
            $end_page = min($max_pages, $current_page + 2);
            
            for ($i = $start_page; $i <= $end_page; $i++) {
                $page_url = get_pagenum_link($i);
                $active_class = ($i == $current_page) ? 'active' : '';
                echo '<li><a href="' . $page_url . '" class="' . $active_class . '">' . $i . '</a></li>';
            }
            
            // Next page arrow
            if ($current_page < $max_pages) {
                $next_url = get_pagenum_link($current_page + 1);
                echo '<li><a href="' . $next_url . '"><i class="fa fa-angle-double-right"></i></a></li>';
            }
            ?>
        </ul>
    </nav>
    <?php
}

