# Plugins y criterio de uso

## Confirmados por documentacion oficial

### WooCommerce

Fuente oficial:

- https://wordpress.org/plugins/woocommerce/
- https://woocommerce.com/

Puntos importantes:

- WooCommerce es un plugin para WordPress.
- En la ficha oficial de WordPress.org aparecen como minimos PHP 7.4+, MySQL 5.5.5 o MariaDB 10.1+, y WordPress 6.8+.

### Mercado Pago para WooCommerce

Fuente oficial:

- https://www.mercadopago.com.ar/developers/es/docs/woocommerce/installation
- https://www.mercadopago.com.ar/developers/es/docs/woocommerce/payments-configuration/checkout-pro
- https://www.mercadopago.com.ar/ayuda/36053

Puntos importantes:

- El plugin se instala desde `Plugins > Add New` buscando `Mercado Pago` o de forma manual desde un zip.
- La documentacion oficial de Mercado Pago indica que el plugin requiere una version activa de WooCommerce.
- Mercado Pago tambien documenta Checkout Pro para WooCommerce como opcion de cobro.
- En la ayuda oficial, Mercado Pago indica que WooCommerce Subscriptions no esta soportado por esta solucion en este momento.

## Stack recomendado para Argentina

- WooCommerce para catalogo, carrito y checkout
- Mercado Pago para cobros
- Transferencia bancaria como respaldo manual
- Retiro en sucursal o envio local si aplica al negocio

## Orden recomendado de configuracion

1. WooCommerce
2. Impuestos y envios
3. Mercado Pago
4. Correos transaccionales
5. SEO y backups

## Lo que no conviene prometer en esta base inicial

- suscripciones con Mercado Pago via WooCommerce, porque la propia ayuda oficial indica que hoy no esta soportado
- automatizaciones complejas antes de cerrar carrito, checkout y cobro
