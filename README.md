# Catálogo Digital para Tiendita PM

Sistema de catálogo digital para emprendimiento Tiendita PM, con visualización de productos y panel de administrador.

## Requisitos

- PHP 8.X
- Composer
- Laravel 12.X
- MySQL configurado y ejecutandose con la base de datos creada
- Node.js y npm

## Instalación (entorno de desarrollo)

<details>

<summary>Click para pasos de instalación</summary>

### Instalando en entorno de desarrollo

1. Clonar el repositorio en el directorio deseado:

*Se recomienda clonar el repositorio usando SSH en lugar de URL web*

```bash
git clone git@github.com:garaneda21/catalogo-digital-tiendita-pm.git
cd catalogo-digital-tiendita-pm
```

2. Instalar dependendias de PHP y Node:

```bash
composer install && npm install
```

3. Configura el archivo ´.env´ a partir del de ejemplo para el entorno de desarrollo:

- Configurar principalmente la conexión a la base de datos

```bash
cp .env.example .env
```

4. En el archivo ´.env´, definir el correo y contraseña del SuperAdmin:
    
```bash
ADMIN_PASSWORD=<contraseña>
ADMIN_MAIL=admin@test.com
```


5. Generar clave de aplicación en archivo ´.env´:

```bash
php artisan key:generate
```

6. Enlazar el storage al directorio `/public`.

```bash
php artisan storage:link
```

7. Correr las migraciones de base de datos:

```bash
php artisan migrate
```

8. Iniciar servidor de desarrollo:

```bash
composer run dev
```

    
</details>

## Instalación (Producción)

<details>

<summary>Click para pasos de instalación</summary>

### Instalando en entorno de producción

Asumiendo que se instalará en un servidor usando Debian Linux, y que la base de
datos MySQL se encuentra funcionando (La base de datos puede ser externa o
estar instalada en el mismo servidor, luego configurar asegurarse de configurar
el archivo `.env`).

1. Clonar repositorio

```bash
git clone https://github.com/garaneda21/catalogo-digital-tiendita-pm.git
cd catalogo-digital-tiendita-pm
```

-  Configurar Proyecto

```bash
composer install && npm install
```

3. Configura el archivo ´.env´ a partir del de ejemplo:

```bash
cp .env.example .env
```

- Configurar los datos iniciales del Admin en las variables de entorno `ADMIN_PASSWORD` y `ADMIN_MAIL`.
- Configurar `APP_ENV=production`.
- Configurar `APP_DEBUG=false` para el entorno de producción.
- Configurar `APP_URL` con la URL que alojará la aplicación.
- Configurar la conexión a la base de datos
- Generar clave de aplicación en archivo ´.env´ con el comando `php artisan key:generate`.
- Enlazar el storage con el directorio `/public` con el comando `php artisan storage:link`.








Optimizar aplicación para producción

```bash
php artisan optimize
php artisan optimize:clear
php artisan config:cache
php artisan event:cache
php artisan route:cache
php artisan view:cache
```


3. Instalar servidor web NGINX

```bash
sudo apt install nginx
```

Comprobar que está funcionando NGINX
- Se puede usar el comando `curl http://localhost:80` o abrir el mismo url en el navegador.
- También se puede comprobar con el comando `systemctl status nginx`.

</details>

## Contribución

1. Crea una rama para tu funcionalidad/tarea:

```bash
git switch -c feature/<nombre-funcionalidad/tarea>
```

2. Realiza cambios y haz commit:

```bash
git add <archivos-cambiados>
git commit -m "<descripcion pequeña del cambio>"
```

3. Pushea tus cambios de la rama:

```bash
git push origin feature/<nombre-funcionalidad/tarea> 
```

4. Crea un Pull Request (PR) a la rama ´develop´ desde GitHub para que sea revisado por otro desarrollador
