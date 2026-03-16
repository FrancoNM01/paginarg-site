# Guia rapida para usar PAGINARG con WordPress Studio

Si ya tenes WordPress Studio, este es el camino mas simple para levantar la tienda real de PAGINARG.

## Por que conviene Studio

Segun la documentacion oficial de WordPress.com, Studio es el entorno local recomendado para desarrollar sitios WordPress y esta disponible para Windows y Mac.

Fuentes oficiales:

- https://developer.wordpress.com/docs/get-started/local-environment-setup/
- https://developer.wordpress.com/docs/developer-tools/studio/
- https://developer.wordpress.com/studio/

## 1. Crear un sitio nuevo en Studio

1. Abri `WordPress Studio`.
2. Crea un sitio nuevo en blanco.
3. Ponele un nombre, por ejemplo `paginarg-store`.
4. Espera a que Studio termine la creacion.

Segun la documentacion oficial, Studio crea e instala WordPress automaticamente para el sitio local.

## 2. Abrir la carpeta del sitio

Segun la documentacion oficial de Studio, podes abrir la carpeta local del sitio desde el panel del sitio usando `Open in...` y despues `File Explorer` en Windows.

Una vez ahi, vas a ver la instalacion local de WordPress.

## 3. Donde esta wp-content/themes

La documentacion oficial de Studio indica que, para agregar themes o plugins manualmente, hay que entrar a estas carpetas dentro del sitio:

- `wp-content/themes`
- `wp-content/plugins`

En la practica, dentro del sitio local vas a terminar en una ruta de este estilo:

`C:\Users\TU_USUARIO\Studio\paginarg-store\wp-content\themes\`

La carpeta exacta puede variar un poco, pero la clave es esta:

- abrir la carpeta del sitio desde Studio
- entrar a `wp-content`
- entrar a `themes`

## 4. Copiar el theme de PAGINARG

El theme que te deje preparado esta aca:

`C:\Users\franc\Documents\GitHub\paginarg-site\woocommerce-real-starter\theme-base\paginarg-store`

Tenes que copiar esa carpeta completa dentro de:

`...\wp-content\themes\`

Entonces deberia quedar algo asi:

`...\wp-content\themes\paginarg-store`

## 5. Activar el theme

1. En Studio, abri el sitio.
2. Entra al admin de WordPress.
3. Anda a `Appearance > Themes`.
4. Activa `Paginarg Store`.

## 6. Instalar WooCommerce

1. Anda a `Plugins > Add New`.
2. Busca `WooCommerce`.
3. Instala y activa.
4. Corre el asistente inicial.

Fuente oficial WooCommerce:

- https://wordpress.org/plugins/woocommerce/
- https://woocommerce.com/

## 7. Crear las categorias que usa el theme

Para que la navegacion del theme quede bien conectada, crea estas categorias de producto:

- `women`
- `men`
- `accessories`
- `new-arrivals`

Las creas desde:

`Products > Categories`

## 8. Instalar Mercado Pago

Fuentes oficiales:

- https://www.mercadopago.com.ar/developers/es/docs/woocommerce/installation
- https://www.mercadopago.com.ar/developers/es/docs/woocommerce/payments-configuration/checkout-pro

Pasos:

1. Ir a `Plugins > Add New`.
2. Buscar `Mercado Pago`.
3. Instalar y activar.
4. Configurarlo primero en modo prueba.

## 9. Que vas a tener al final

Con esto ya vas a poder probar:

- WordPress real en local
- WooCommerce real
- carrito real
- checkout real
- Mercado Pago en sandbox
- theme visual inspirado en la demo de PAGINARG

## Ruta clave resumida

Theme de PAGINARG:

`C:\Users\franc\Documents\GitHub\paginarg-site\woocommerce-real-starter\theme-base\paginarg-store`

Destino dentro del sitio de Studio:

`...\wp-content\themes\paginarg-store`

## Recomendacion

Si ya tenes WordPress Studio, no hace falta usar LocalWP ni Docker para esta etapa.
Studio es hoy la opcion mas directa para vos.
