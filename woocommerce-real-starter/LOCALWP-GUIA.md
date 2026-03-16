# Guia rapida para usar PAGINARG con LocalWP

Esta guia reemplaza al flujo con Docker si no tenes Docker Desktop.

## 1. Descargar e instalar LocalWP

Descarga oficial:

- https://localwp.com/
- https://localwp.com/help-docs/getting-started/installing-local/

Segun la documentacion oficial de Local, en Windows funciona con Windows 10 de 64 bits o Windows 11.

## 2. Crear un sitio nuevo en LocalWP

1. Abri `Local`.
2. Hace click en `Create a new site`.
3. Ponele un nombre, por ejemplo `paginarg-store`.
4. Elegi el entorno `Preferred` para no complicarte.
5. Crea el usuario administrador de WordPress.
6. Espera a que Local termine la instalacion.

Segun la pagina oficial de Local, la instalacion de WordPress se hace automaticamente.

## 3. Abrir la carpeta del sitio

Dentro de Local:

1. Entra al sitio que creaste.
2. Hace click en `Site Folder`.
3. Se va a abrir la carpeta del proyecto.

Segun la documentacion oficial de Local, para trabajar con el codigo del sitio hay que abrir la carpeta `app/public`.

## 4. Donde esta wp-content/themes

Cuando abras la carpeta del sitio, la ruta va a ser parecida a esta:

`C:\Users\TU_USUARIO\Local Sites\paginarg-store\app\public\wp-content\themes\`

O sea:

- carpeta del sitio en Local
- `app`
- `public`
- `wp-content`
- `themes`

## 5. Copiar el theme de PAGINARG

El theme que te arme esta aca:

`C:\Users\franc\Documents\GitHub\paginarg-site\woocommerce-real-starter\theme-base\paginarg-store`

Tenes que copiar esa carpeta completa dentro de:

`...\app\public\wp-content\themes\`

Entonces deberia quedar asi:

`...\app\public\wp-content\themes\paginarg-store`

## 6. Activar el theme

1. En Local, hace click en `Open Site` para abrir WordPress.
2. Entra al panel admin.
3. Anda a `Appearance > Themes`.
4. Activa `Paginarg Store`.

## 7. Instalar WooCommerce

1. Anda a `Plugins > Add New`.
2. Busca `WooCommerce`.
3. Instala y activa.
4. Corre el asistente inicial.

## 8. Crear las categorias correctas

Para que el theme quede bien armado, crea estas categorias de producto:

- `women`
- `men`
- `accessories`
- `new-arrivals`

En WooCommerce las podes crear desde:

`Products > Categories`

## 9. Instalar Mercado Pago

Fuente oficial:

- https://www.mercadopago.com.ar/developers/es/docs/woocommerce/installation
- https://www.mercadopago.com.ar/developers/es/docs/woocommerce/payments-configuration/checkout-pro

Pasos:

1. Ir a `Plugins > Add New`.
2. Buscar `Mercado Pago`.
3. Instalar y activar el plugin.
4. Configurarlo primero en modo prueba.

## 10. Que vas a tener al final

Con esto ya vas a poder tener:

- WordPress real en local
- WooCommerce real
- carrito real
- checkout real
- Mercado Pago en pruebas
- theme visual inspirado en la demo de PAGINARG

## Ruta clave resumida

Theme de PAGINARG:

`C:\Users\franc\Documents\GitHub\paginarg-site\woocommerce-real-starter\theme-base\paginarg-store`

Ruta destino en LocalWP:

`C:\Users\TU_USUARIO\Local Sites\paginarg-store\app\public\wp-content\themes\paginarg-store`

## Siguiente paso recomendado

Despues de instalar todo, el siguiente paso ideal es que yo te adapte tambien:

- home de tienda
- catalogo
- producto individual
- carrito
- checkout

para que WooCommerce real se parezca mucho mas a tu demo actual.
