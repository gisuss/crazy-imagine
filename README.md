# Crazy Imagine - Prueba Técnica

[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PostgreSQL](https://img.shields.io/badge/PostgreSQL-316192?style=for-the-badge&logo=postgresql&logoColor=white)](https://www.postgresql.org/)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com/)

## Descripción del Proyecto

Aplicación web desarrollada con Laravel 12 que consume datos de la API JSONPlaceholder para mostrar usuarios, publicaciones y comentarios. Incluye un sistema de caché, procesamiento en segundo plano con colas, y una interfaz de usuario responsiva construida con Tailwind CSS.

## Características Principales

- 🚀 **Interfaz de usuario moderna y responsiva** con Tailwind CSS
- ⚡ **Sistema de caché** para mejorar el rendimiento
- 🔄 **Procesamiento asíncrono** con colas de Laravel
- 📊 Visualización de datos de usuarios, publicaciones y comentarios
- 🔍 Búsqueda y filtrado
- 📱 Diseño adaptable a dispositivos móviles

## Requisitos del Sistema

- PHP 8.2 o superior
- Composer
- Node.js 16+ y NPM
- PostgreSQL 14+

## Instalación

1. **Clonar el repositorio**
   ```bash
   git clone https://github.com/gisuss/crazy-imagine.git
   cd crazy-imagine
   ```

2. **Instalar dependencias de PHP**
   ```bash
   composer install
   ```

3. **Copiar y configurar el archivo .env**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configurar la base de datos**
   Editar el archivo `.env` con tus credenciales de PostgreSQL:
   ```env
   DB_CONNECTION=pgsql
   DB_HOST=127.0.0.1
   DB_PORT=5432
   DB_DATABASE=nombre_base_datos
   DB_USERNAME=usuario
   DB_PASSWORD=contraseña
   ```

5. **Ejecutar migraciones y seeders**
   ```bash
   php artisan migrate --seed
   ```

6. **Instalar dependencias de Node.js**
   ```bash
   npm install
   ```

7. **Compilar assets**
   ```bash
   npm run dev
   # o para producción:
   # npm run build
   ```

8. **Iniciar el servidor de desarrollo**
   ```bash
   php artisan serve
   ```

9. **Iniciar el worker de colas (en otra terminal)**
   ```bash
   php artisan queue:work
   ```

10. **Opcional: Iniciar el scheduler para tareas programadas**
    ```bash
    php artisan schedule:work
    ```

## Estructura del Proyecto

```
crazy-imagine/
├── app/                    # Código fuente de la aplicación
│   ├── Console/            # Comandos de Artisan
│   ├── Http/               # Controladores, Middleware, etc.
│   ├── Models/             # Modelos de Eloquent
│   ├── Services/           # Servicios de la aplicación
│   └── Traits/             # Traits reutilizables
├── config/                 # Archivos de configuración
├── database/               # Migraciones, seeders, factories
├── public/                 # Punto de entrada de la aplicación
├── resources/              # Vistas y assets sin compilar
│   ├── js/                 # Archivos JavaScript
│   ├── css/                # Archivos CSS
│   └── views/              # Vistas Blade
├── routes/                 # Rutas de la aplicación
├── storage/                # Almacenamiento de archivos
└── tests/                  # Pruebas automatizadas
```

## Comandos Útiles

- **Obtener datos de la API externa**
  ```bash
  php artisan fetch:data
  ```

- **Limpiar caché manualmente**
  ```bash
  php artisan cache:clear-all
  ```

- **Limpiar caché de configuración, rutas y vistas**
  ```bash
  php artisan optimize:clear
  ```

- **Ejecutar worker de colas**
  ```bash
  php artisan queue:work
  ```

- **Ejecutar scheduler**
  ```bash
  php artisan schedule:work
  ```

## Variables de Entorno Importantes

- `APP_DEBUG`: Habilita/deshabilita el modo depuración
- `CACHE_DRIVER`: Controlador de caché (database, file, redis, etc.)
- `QUEUE_CONNECTION`: Controlador de colas (sync, database, redis, etc.)
- `APP_URL`: URL base de la aplicación

## Contribución

1. Hacer fork del repositorio
2. Crear una rama para tu característica (`git checkout -b feature/AmazingFeature`)
3. Hacer commit de tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Hacer push a la rama (`git push origin feature/AmazingFeature`)
5. Abrir un Pull Request

## Licencia

Este proyecto está bajo la Licencia MIT.

---

Desarrollado para la prueba técnica de **Crazy Imagine**
