<?php
defined( 'ABSPATH' ) || exit;

global $product;

if ( ! is_a( $product, WC_Product::class ) || ! $product->is_visible() ) {
	return;
}

$product_published = $product->get_date_created();
?>

<div <?php wc_product_class( 'col-lg-4 col-sm-6', $product ); ?>>
    <div class="single-product-wrap">
        <!-- Product Thumbnail -->
        <figure class="product-thumbnail">
            <a href="<?php echo esc_url( $product->get_permalink() ); ?>" class="d-block">
                <?php echo $product->get_image(); ?>
            </a>
            <figcaption class="product-hvr-content">
                <a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="btn btn-black btn-addToCart">
                    <?php echo esc_html( $product->add_to_cart_text() ); ?>
                </a>
                <?php if ( $product->is_on_sale() ) : ?>
                    <span class="product-badge">Распродажа</span>
                <?php elseif ( $product_published->getTimestamp() > ( time() - 86400 * 5 ) ) : ?>
                    <span class="product-badge new">Новинка</span>
                <?php elseif ( $product->is_featured() ) : ?>
                    <span class="product-badge hot">Хит продаж</span>
                <?php endif; ?>
            </figcaption>
        </figure>

        <!-- Product Details -->
        <div class="product-details">
            <h2 class="product-name">
                <a href="<?php echo esc_url( $product->get_permalink() ); ?>">
                    <?php echo esc_html( $product->get_title() ); ?>
                </a>
            </h2>
            <div class="product-prices">
                <?php echo $product->get_price_html(); ?>
            </div>
            <div class="list-view-content">
                <p class="product-desc"><?php echo $product->get_short_description(); ?></p>
                <div class="list-btn-group mt-30 mt-sm-14">
                    <a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="btn btn-black">
                        <?php echo esc_html( $product->add_to_cart_text() ); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
