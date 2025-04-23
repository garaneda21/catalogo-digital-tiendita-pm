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
git clone https://github.com/garaneda21/catalogo-digital-tiendita-pm
cd catalogo-digital-tiendita-pm
```

2. Instalar dependendias de PHP:

```bash
composer install
```

3. Configura el archivo ´.env´ a partir del de ejemplo para el entorno de desarrollo:

- Configurar principalmente la conexión a la base de datos

```bash
cp .env.example .env
```

4. Generar clave de aplicación en archivo ´.env´:

```bash
php artisan key:generate
```

5. Correr las migraciones de base de datos:

```bash
php artisan migrate
```

6. Iniciar servidor de desarrollo:

```bash
php artisan serve
```

    
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
