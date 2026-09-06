# Tech Solutions — Intrucciones

Para inicializar el proyecto se necesita tener:

- **PHP** 8.2 o superior
- **Composer**
- **Node.js** y **npm**
- **Git**

## Instalacion:

### 1. Clonar el repositorio

```bash
git clone https://github.com/Stefany224/Tech_Solutions.git
cd Tech_Solutions
```

### 2. Instalar las dependencias de PHP

```bash
composer install
```

### 3. Instalar dependencias de JavaScript:

```bash
npm install
```

### 4. Crear el archivo de entorno:

```
copy .env.example .env
```

### 5. Generar la clave de la aplicacion:

```
php artisan key:generate
```

### 6. Abrir el archivo `.env` para configurar la DB en el vsc y confirmar que la linea que diga:

```bash
DB_CONNECTION=sqlite
```

### 7. Crear el archivo de base de datos vacio:

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

### 8. Generar la clave JWT:

```bash
php artisan jwt:secret
```

### 9. Ejecutar las migraciones:

```bash
php artisan migrate
```
## Levantar el proyecto

Se necesitan dos terminales abiertas simultáneamente, ambas ubicadas en la carpeta del proyecto:

**Terminal 1:**

```bash
php artisan serve
```

**Terminal 2:**

```bash
npm run dev
```


### 10. Abrir el proyecto en el navegador con el link de artisan serve.

## Uso del sistema web

Desde la pantalla de inicio se puede registrar un usuario nuevo, iniciar sesion, y acceder al listado de proyectos para crear, editar y eliminar registros.

## Documentación de la API (Swagger)

Con el proyecto corriendo, la documentacion interactiva de la API esta disponible en:
http://127.0.0.1:8000/api/documentation
