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

6. Correr las migraciones de base de datos:

```bash
php artisan migrate
```

7. Iniciar servidor de desarrollo:

```bash
composer run dev
```

</details>

## Instalación (entorno de desarrollo)

<details>
<summary>Click para pasos de instalación</summary>

### *PRONTO*

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
