<?php
if (!defined('ABSPATH')) {
    exit;
}

$contact_url = paginarg_store_page_url_by_slug(array('contacto', 'contact'), home_url('/contacto/'));

get_header();
?>
<section class="section">
    <div class="container panel-shell paginarg-demo-hub">
        <div class="cta-copy paginarg-demo-hub-copy">
            <span class="section-tag">PAGINARG local</span>
            <h1 class="paginarg-store-archive-title">Centro local de demos y recorridos</h1>
            <p>Mientras la web principal todavía no está publicada en un dominio, este acceso reúne los puntos más importantes de la demo para que puedas revisar home, catálogo, cuenta, contacto y flujo comercial sin salir de WordPress Studio.</p>
        </div>
        <div class="cta-notes paginarg-demo-hub-grid">
            <a class="cta-note cta-note-link" href="<?php echo esc_url(home_url('/')); ?>">
                <strong>Home de la tienda</strong>
                <span>Volvé a la portada para revisar el hero, el carrusel y el cierre comercial con la estética actual.</span>
            </a>
            <a class="cta-note cta-note-link" href="<?php echo esc_url(paginarg_store_shop_url()); ?>">
                <strong>Catálogo completo</strong>
                <span>Entrá al shop para ver categorías, productos, ordenamiento y comportamiento real de la grilla.</span>
            </a>
            <a class="cta-note cta-note-link" href="<?php echo esc_url($contact_url); ?>">
                <strong>Contacto comercial</strong>
                <span>Chequeá la página de contacto y el recorrido pensado para consultas, soporte y seguimiento.</span>
            </a>
            <a class="cta-note cta-note-highlight cta-note-link" href="<?php echo esc_url(paginarg_store_account_url()); ?>">
                <strong>Gestión del cliente</strong>
                <span>Pasá a la cuenta para revisar login, registro, panel del cliente y accesos operativos dentro de WooCommerce.</span>
            </a>
        </div>
        <div class="hero-actions cta-actions-wide">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="button">Ir a la home</a>
            <a href="<?php echo esc_url(paginarg_store_shop_url()); ?>" class="button-secondary">Ver catálogo</a>
            <a href="<?php echo esc_url($contact_url); ?>" class="button-secondary">Abrir contacto</a>
        </div>
    </div>
</section>
<?php get_footer();
