# Estado local de WordPress Studio

Esta carpeta guarda una instantanea del sitio local `paginar-store` creado en WordPress Studio.

## Que incluye
- `paginar-store-studio.sqlite`: base local con productos, categorias, paginas y configuraciones creadas en Studio.
- El theme actualizado esta en `../theme-base/paginarg-store`.

## Importante
- Este snapshot sirve como respaldo del estado actual del sitio.
- Para restaurarlo en otro entorno de Studio o WordPress local, hay que volver a instalar los plugins usados en el sitio, especialmente WooCommerce y Mercado Pago.
- Las imagenes principales del catalogo actual se resuelven desde el theme mediante fallbacks online y estilos del theme.
