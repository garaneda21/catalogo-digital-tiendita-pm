# Catálogo Digital para Tiendita PM

Sistema de catálogo digital para emprendimiento Tiendita PM, con visualización de productos y panel de administrador.

<img width="750" alt="Screenshot 2025-07-17 at 17-11-22 " src="https://github.com/user-attachments/assets/dfc4e15e-758c-480c-bef9-472d93a85113" />

> Pantalla de Inicio

<img width="750" alt="Screenshot 2025-07-17 at 17-12-25 Dashboard" src="https://github.com/user-attachments/assets/fa2b50fb-4fac-415c-b7a3-92c990cfa37e" />

> Panel de Administración, Módulo Productos

<img width="750" alt="Screenshot 2025-07-17 at 17-39-52 Dashboard" src="https://github.com/user-attachments/assets/bb35eab3-2d19-4317-aefb-c4c7c8feda64" />

> Panel de Administración, Módulo Administradores

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
estar instalada en el mismo servidor, luego asegurarse de configurar
el archivo `.env`).

No se toma en cuenta el uso de certificados SSL en los siguientes pasos.

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
- Configurar la conexión a la base de datos.
- Generar clave de aplicación en archivo `.env` con el comando `php artisan key:generate`.
- Enlazar el storage con el directorio `/public` con el comando `php artisan storage:link` (puede que este paso sea mejor realizarlo dentro del servidor).
- Ejecutar `npm run build`.

4. Ahora se pasará a configurar el servidor, primero mover el proyecto al servidor (ftp, ssh, etc.).

5. Instalar dependencias en el servidor.

```bash
sudo apt install php8.2 php8.2-cli php8.2-fpm php8.2-mysql php8.2-curl \
php8.2-mbstring php8.2-xml php8.2-zip php8.2-bcmath php8.2-readline \
php8.2-soap php8.2-intl php8.2-common unzip -y
```

6. Instalar servidor web NGINX

```bash
sudo apt install nginx
```

Comprobar que está funcionando NGINX
- Se puede usar el comando `curl http://localhost:80` o abrir el mismo url en el navegador.
- También se puede comprobar con el comando `systemctl status nginx`.

7. Configurar NGINX

- Mover proyecto a la ruta `/var/www`.
- Entregar permisos de directorios al servicio.

```bash
sudo chown -R www-data:www-data /var/www/catalogo-digital-tiendita-pm/storage
sudo chown -R www-data:www-data /var/www/catalogo-digital-tiendita-pm/bootstrap/cache
```

- Configurar NGINX para que sirva el proyecto, para esto, crear un archivo de configuración en `/etc/nginx/sites-available/tiendita-pm`, laravel entrega una configuración recomendada en la [documentación](https://laravel.com/docs/12.x/deployment#server-configuration). Y como dice en la documentación, cambiar las siguietes líneas.

```conf
server_name <IP o dominio que se utilizará>;
root /var/www/catalogo-digital-tiendita-pm/public;
```

- Ahora activar el sitio creando un enlace simbólico de este archivo en `sites-enabled`.

```bash
sudo ln -s /etc/nginx/sites-available/tiendita-pm /etc/nginx/sites-enabled/
```

> NOTA: Puede que haya conflicto con el archivo de configuración por defecto de nginx `/etc/nginx/sites-enabled/default`, de puede eliminar.

- Comprobar si la configuración es correcta

```bash
sudo nginx -t
```

- Aplicar cambios

```bash
sudo systemctl reload nginx
```

- Optimizar aplicación para producción (debe existir la conexión a la base de datos)

```bash
php artisan optimize
php artisan optimize:clear
php artisan config:cache
php artisan event:cache
php artisan route:cache
php artisan view:cache
```

> NOTA: Puede que hayan errores con los permisos de los archivos, dando acceso a `www-data` a los directorios `/storage` y `/bootstrap/cache` debería ser suficiente para NGINX y Laravel.

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
