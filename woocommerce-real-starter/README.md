# WooCommerce real para PAGINARG

Esta carpeta deja preparada una base real de WordPress + WooCommerce para trabajar aparte de la demo estatica del sitio principal.

## Que resuelve

- WordPress real en local con base de datos
- espacio listo para instalar WooCommerce
- entorno ideal para probar carrito, checkout y medios de pago
- separacion limpia entre la demo comercial y la tienda real

## Requisitos

- Docker Desktop instalado
- puertos 8080 y 8081 libres
- conexion a internet para descargar las imagenes de Docker y luego instalar plugins desde WordPress

## Arranque rapido

1. Copia `.env.example` a `.env`.
2. En esta carpeta, ejecuta `docker compose up -d`.
3. Abre `http://localhost:8080` y completa la instalacion de WordPress.
4. Abre `http://localhost:8081` si necesitas revisar la base con Adminer.

## Instalacion recomendada dentro de WordPress

1. Instalar WordPress.
2. Ir a `Plugins > Add New`.
3. Instalar `WooCommerce`.
4. Ejecutar el asistente inicial de WooCommerce.
5. Crear paginas de tienda, carrito, checkout y mi cuenta.
6. Cargar productos de prueba.
7. Instalar `Mercado Pago` para WooCommerce.
8. Configurar la pasarela primero en modo prueba.

## Plugins recomendados

Base minima:

- WooCommerce
- Mercado Pago para WooCommerce

Muy utiles:

- WooCommerce PDF Invoices & Packing Slips
- Advanced Shipment Tracking for WooCommerce
- Yoast SEO o Rank Math
- UpdraftPlus para backups

## Flujo sugerido de implementacion

1. Validar estetica y estructura en la demo estatica actual.
2. Replicar la estructura comercial en una instalacion WordPress.
3. Crear categorias reales como Women, Men y Accessories.
4. Configurar carrito y checkout.
5. Integrar Mercado Pago en sandbox.
6. Hacer compras de prueba.
7. Recien despues pasar a produccion.

## Notas importantes

- La web actual de PAGINARG es estatica. No soporta WooCommerce real por si sola.
- WooCommerce real necesita WordPress, PHP y base de datos.
- Para Argentina, Mercado Pago es la opcion mas natural para medios de pago.
- Segun la documentacion oficial de Mercado Pago para WooCommerce, el plugin requiere una version activa de WooCommerce.
- Segun la ayuda oficial de Mercado Pago, WooCommerce Subscriptions no esta soportado con esa solucion en este momento.


## Tema base incluido

Tambien queda incluida una base visual para WordPress/WooCommerce en:

- `theme-base/paginarg-store`

Ese tema replica la direccion estetica de la demo ecommerce actual y sirve como punto de partida para que la tienda real no arranque con apariencia generica.
## Siguiente paso recomendado

Cuando quieras, el siguiente trabajo logico es que yo te deje tambien una guia de tema base para que esta tienda real se parezca a la demo de PAGINARG y no a un WordPress generico.

