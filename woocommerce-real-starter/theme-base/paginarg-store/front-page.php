<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();

$contact_url = paginarg_store_page_url_by_slug(array('contacto', 'contact'), home_url('/contacto/'));
$featured_products = class_exists('WooCommerce') ? wc_get_products(array(
    'status' => 'publish',
    'limit' => 4,
    'orderby' => 'date',
    'order' => 'DESC',
)) : array();
$slider_products = class_exists('WooCommerce') ? wc_get_products(array(
    'status' => 'publish',
    'limit' => 5,
    'orderby' => 'date',
    'order' => 'DESC',
)) : array();
?>
<section class="hero-campaign">
    <div class="container hero-campaign-grid">
        <div class="campaign-copy">
            <p class="eyebrow">Summer collection</p>
            <h1>Summer collections built to sell better online.</h1>
            <div class="hero-tagline">Coolest collection of the season is here</div>
            <p class="lead">Una home ecommerce con visual de campaña, foco en colecciones, banners promocionales y una estructura lista para WooCommerce, stock, cupones y pagos.</p>
            <div class="hero-actions">
                <a href="<?php echo esc_url(paginarg_store_get_product_category_link('women')); ?>" class="button">Go to collection</a>
                <a href="<?php echo esc_url($contact_url); ?>" class="button-secondary">Gestión WooCommerce</a>
            </div>
        </div>
        <div class="campaign-visual">
            <div class="hero-model"></div>
        </div>
    </div>
</section>

<?php if (!empty($slider_products)) : ?>
<section class="section section-runway">
    <div class="container runway-shell" data-runway>
        <div class="runway-head">
            <span class="section-tag">Colección destacada</span>
            <h2>Un banner amplio que rota productos reales y empuja la compra desde la home.</h2>
            <p>Cada slide puede llevar al producto, mostrar una categoría y darle más presencia a la tienda desde el primer scroll.</p>
        </div>
        <div class="runway-stage">
            <?php foreach ($slider_products as $index => $shop_product) : ?>
                <?php
                $product_url = get_permalink($shop_product->get_id());
                $product_image = paginarg_store_get_product_image_url($shop_product);
                $product_kicker = paginarg_store_get_product_kicker($shop_product);
                ?>
                <article class="runway-slide<?php echo 0 === $index ? ' is-active' : ''; ?>" data-runway-slide style="background-image: linear-gradient(90deg, rgba(7, 7, 7, 0.62), rgba(7, 7, 7, 0.08)), url('<?php echo esc_url($product_image); ?>');">
                    <div class="runway-slide-copy">
                        <span class="mini-label"><?php echo esc_html($product_kicker); ?></span>
                        <h3><?php echo esc_html($shop_product->get_name()); ?></h3>
                        <p><?php echo esc_html(wp_trim_words(wp_strip_all_tags($shop_product->get_short_description() ? $shop_product->get_short_description() : $shop_product->get_description()), 18)); ?></p>
                        <div class="runway-slide-actions">
                            <a href="<?php echo esc_url($product_url); ?>" class="button">Ver producto</a>
                            <a href="<?php echo esc_url(paginarg_store_shop_url()); ?>" class="button-secondary button-secondary-light">Ir al catálogo</a>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
        <div class="runway-nav" aria-label="Selector de productos destacados">
            <?php foreach ($slider_products as $index => $shop_product) : ?>
                <button type="button" class="runway-dot<?php echo 0 === $index ? ' is-active' : ''; ?>" data-runway-dot data-index="<?php echo esc_attr($index); ?>">
                    <span><?php echo esc_html($shop_product->get_name()); ?></span>
                </button>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<section class="promo-strip-section">
    <div class="container promo-strip">
        <article class="promo-tile promo-tile-one"><span>Summer</span><strong>Collection offer</strong><a href="<?php echo esc_url(paginarg_store_get_product_category_link('women')); ?>">Go to collection</a></article>
        <article class="promo-tile promo-tile-two"><span>Watch edit</span><strong>Accessories</strong><a href="<?php echo esc_url(paginarg_store_get_product_category_link('accessories')); ?>">View edit</a></article>
        <article class="promo-tile promo-tile-three"><span>Fashion</span><strong>Minimal release</strong><a href="<?php echo esc_url(paginarg_store_get_product_category_link('new-arrivals')); ?>">Shop now</a></article>
    </div>
</section>

<section class="section">
    <div class="container section-heading"><span class="section-tag">Shop by category</span><h2>Una tienda pensada para vender con una estructura visual clara.</h2><p>La marca puede destacar colecciones, empujar promociones y ordenar productos desde WooCommerce sin perder coherencia visual.</p></div>
    <div class="container category-grid">
        <article class="category-card category-card-one"><a href="<?php echo esc_url(paginarg_store_get_product_category_link('women')); ?>" class="category-link"><div class="category-copy"><span>Women</span><h3>Editorial looks</h3></div></a></article>
        <article class="category-card category-card-two"><a href="<?php echo esc_url(paginarg_store_get_product_category_link('men')); ?>" class="category-link"><div class="category-copy"><span>Men</span><h3>Daily essentials</h3></div></a></article>
        <article class="category-card category-card-three"><a href="<?php echo esc_url(paginarg_store_get_product_category_link('accessories')); ?>" class="category-link"><div class="category-copy"><span>Accessories</span><h3>Small upgrades</h3></div></a></article>
        <article class="category-card category-card-four"><a href="<?php echo esc_url(paginarg_store_get_product_category_link('new-arrivals')); ?>" class="category-link"><div class="category-copy"><span>New arrivals</span><h3>Fresh campaign</h3></div></a></article>
    </div>
</section>

<?php if (!empty($featured_products)) : ?>
<section class="section section-soft">
    <div class="container section-heading"><span class="section-tag">Featured products</span><h2>Productos reales cargados en WooCommerce para que la demo se sienta completa.</h2><p>La tienda ya muestra piezas, categorías y precios dentro de un recorrido más cercano a una marca real.</p></div>
    <div class="container woocommerce paginarg-featured-products">
        <ul class="products columns-4">
            <?php foreach ($featured_products as $shop_product) : ?>
                <?php
                $GLOBALS['product'] = $shop_product;
                $GLOBALS['post'] = get_post($shop_product->get_id());
                setup_postdata($GLOBALS['post']);
                wc_get_template_part('content', 'product');
                ?>
            <?php endforeach; ?>
        </ul>
        <?php wp_reset_postdata(); ?>
    </div>
</section>
<?php endif; ?>

<section class="section section-ink">
    <div class="container feature-band">
        <article class="feature-band-card"><strong>WooCommerce</strong><span>Productos, stock, talles y precios administrables.</span></article>
        <article class="feature-band-card"><strong>Promos</strong><span>Banners, cupones y ofertas visibles dentro del recorrido.</span></article>
        <article class="feature-band-card"><strong>Conversión</strong><span>Hero de campaña, categorías, destacados y CTA comerciales.</span></article>
    </div>
</section>

<section class="section">
    <div class="container cta-panel cta-panel-rich">
        <div class="cta-copy">
            <span class="section-tag">Siguiente paso</span>
            <h2>Explorá una tienda real en funcionamiento y mirá cómo conviven catálogo, carrito, checkout y gestión del cliente dentro de un recorrido comercial listo para presentar.</h2>
            <p>Esta versión ya reúne catálogo administrable, categorías, cuenta, contacto comercial y flujo de compra completo, con una base visual preparada para adaptarse a una marca real sin rehacer toda la estructura.</p>
        </div>
        <div class="cta-notes">
            <div class="cta-note"><strong>Base operativa ya resuelta</strong><span>Catálogo, carrito, checkout, categorías, cuenta de cliente y administración básica dentro de WordPress y WooCommerce.</span></div>
            <div class="cta-note"><strong>Todo lo que todavía podés personalizar</strong><span>Identidad visual, banners, fichas de producto, medios de pago, envíos, automatizaciones y tono comercial de cada sección.</span></div>
            <a href="https://franconm01.github.io/paginarg-site/index.html#hero" class="cta-note cta-note-highlight cta-note-link"><strong>Volver a PAGINARG</strong><span>Abrí un centro local de demos para seguir comparando recorridos, secciones y accesos sin salir de WordPress Studio.</span></a>
        </div>
        <div class="hero-actions cta-actions-wide">
            <a href="<?php echo esc_url(paginarg_store_shop_url()); ?>" class="button">Ver catálogo</a>
            <a href="<?php echo esc_url(paginarg_store_account_url()); ?>" class="button-secondary">Ver gestión</a>
            <a href="https://franconm01.github.io/paginarg-site/index.html#hero" class="button-secondary paginarg-return">Volver a PAGINARG</a>
        </div>
    </div>
</section>
<?php get_footer(); ?>
