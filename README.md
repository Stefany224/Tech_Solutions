# Tech Solutions — Sistema de Gestión de Proyectos

Proyecto desarrollado con Laravel, que incluye autenticación con JWT y un CRUD de proyectos, tanto en formato web (Blade) como API REST documentada con Swagger.

## Requisitos previos

Antes de empezar, asegúrate de tener instalado en tu equipo:

- **PHP** 8.2 o superior
- **Composer**
- **Node.js** y **npm**
- **Git**

## Instalación paso a paso

Sigue estos pasos en orden. Cuando termines, tendrás el proyecto corriendo en tu equipo.

### 1. Clonar el repositorio

```bash
git clone https://github.com/Stefany224/Tech_Solutions.git
cd Tech_Solutions
```

### 2. Instalar las dependencias de PHP

```bash
composer install
```

### 3. Crear el archivo de configuración `.env`

```bash
cp .env.example .env
```

Abre el archivo `.env` y confirma que la conexión a la base de datos esté así:

```
DB_CONNECTION=sqlite
```

### 4. Agregar la clave JWT

Al final del archivo `.env`, agrega:

```
JWT_SECRET=3vlCv8sEK7Wnnh6sVTiuTuzc0wTFm6LApadyJpnviqNcJwWZQNirYXuwnl3KaXhY
```

Esta clave es necesaria para que el sistema de login funcione igual en todos los equipos.

### 5. Generar la clave de la aplicación

```bash
php artisan key:generate
```

### 6. Crear la base de datos

El proyecto usa SQLite (no requiere instalar MySQL ni configurar un servidor de base de datos aparte).

**En Mac / Linux:**
```bash
touch database/database.sqlite
```

**En Windows (CMD):**
```bash
type nul > database\database.sqlite
```

**En Windows (PowerShell):**
```bash
New-Item database\database.sqlite
```

### 7. Correr las migraciones

```bash
php artisan migrate
```

Deberías ver varias tablas creadas, terminando cada una en `DONE` (incluyendo `usuarios`, `proyectos`, `personal_access_tokens`, etc.).

### 8. Instalar y compilar los assets (Tailwind / JS)

```bash
npm install
npm run build
```

> Si `npm install` muestra vulnerabilidades, correr `npm audit` para revisarlas y `npm audit fix` (sin `--force`) para corregir las que tengan solución automática.

### 9. Levantar el servidor

```bash
php artisan serve
```

Abre el navegador en:

```
http://127.0.0.1:8000
```

## Documentación de la API (Swagger)

El proyecto incluye documentación interactiva de la API con Swagger. Para generarla o regenerarla después de algún cambio en los controladores:

```bash
composer require "darkaonline/l5-swagger"
php artisan vendor:publish --provider="L5Swagger\L5SwaggerServiceProvider"
php artisan config:clear
php artisan route:clear
php artisan l5-swagger:generate
```

Luego, visita:

```
http://127.0.0.1:8000/api/documentation
```

> Si ya clonaste el proyecto con Swagger ya instalado (revisa si aparece `darkaonline/l5-swagger` en `composer.json`), solo necesitas correr el último comando (`l5-swagger:generate`).

## Problemas comunes al levantar el proyecto

| Error | Solución |
|---|---|
| `MissingAppKeyException` (No application encryption key) | Correr `php artisan key:generate` |
| `ViteManifestNotFoundException` (Vite manifest not found) | Correr `npm install` y `npm run build` |
| `419 \| Page Expired` al probar rutas web desde Postman | Las rutas de `web.php` requieren el token CSRF; usar las rutas de `api.php` para pruebas con Postman/Swagger, o configurar el header `X-XSRF-TOKEN` |
| `"message": "Token expirado"` | El JWT expira por seguridad; volver a iniciar sesión en `/login` para generar uno nuevo |
| Error de `vendor/autoload.php` no encontrado | Correr `composer install` |

## Estructura del proyecto

- **Autenticación (JWT):** registro, login, middleware de rutas protegidas.
- **Gestión de proyectos (web):** CRUD completo en `/proyectos`, con diseño atómico (átomos y moléculas reutilizables) y validaciones.
- **Gestión de proyectos (API):** CRUD completo en `/api/proyectos`, con respuestas JSON y códigos de estado HTTP estándar (`200`, `201`, `404`, `204`).