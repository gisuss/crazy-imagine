# Crazy Imagine

[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PostgreSQL](https://img.shields.io/badge/PostgreSQL-316192?style=for-the-badge&logo=postgresql&logoColor=white)](https://www.postgresql.org/)
[![Docker](https://img.shields.io/badge/Docker-2CA5E0?style=for-the-badge&logo=docker&logoColor=white)](https://www.docker.com/)

## Descripción del Proyecto

Aplicación web desarrollada con Laravel 10 y PostgreSQL, utilizando Docker para el entorno de desarrollo.

## Requisitos Previos

- [Docker](https://www.docker.com/products/docker-desktop/)
- [Docker Compose](https://docs.docker.com/compose/install/)
- [Git](https://git-scm.com/)
- PHP 8.2+
- Composer

## Configuración del Entorno

1. **Clonar el repositorio**
   ```bash
   git clone [URL_DEL_REPOSITORIO]
   cd crazy-imagine
   ```

2. **Instalar dependencias de PHP**
   ```bash
   composer install
   ```

3. **Copiar el archivo .env**
   ```bash
   cp .env.example .env
   ```

4. **Configurar variables de entorno**
   Asegúrate de que tu archivo `.env` tenga la siguiente configuración para la base de datos:
   ```env
   DB_CONNECTION=pgsql
   DB_HOST=pgsql
   DB_PORT=5432
   DB_DATABASE=laravel
   DB_USERNAME=sail
   DB_PASSWORD=password
   ```

## Iniciar el Entorno de Desarrollo

1. **Iniciar los contenedores**
   ```bash
   ./vendor/bin/sail up -d
   ```

2. **Instalar dependencias de Node.js**
   ```bash
   ./vendor/bin/sail npm install
   ```

3. **Construir assets**
   ```bash
   ./vendor/bin/sail npm run dev
   ```

4. **Ejecutar migraciones**
   ```bash
   ./vendor/bin/sail artisan migrate
   ```

5. **Ejecutar seeders (opcional)**
   ```bash
   ./vendor/bin/sail artisan db:seed
   ```

La aplicación estará disponible en: http://localhost:8080

## Estructura del Proyecto

```
crazy-imagine/
├── app/
│   ├── Models/              # Modelos de Eloquent
│   │   ├── User.php
│   │   ├── Post.php
│   │   ├── Comment.php
│   │   ├── Address.php
│   │   └── Company.php
│   └── ...
├── config/                # Archivos de configuración
├── database/
│   ├── migrations/        # Migraciones de base de datos
│   └── seeders/           # Seeders para datos de prueba
├── public/                # Punto de entrada de la aplicación
├── resources/
│   ├── js/               # Archivos JavaScript
│   ├── views/             # Vistas de Blade
│   └── ...
├── routes/               # Rutas de la aplicación
├── storage/               # Almacenamiento de archivos
├── tests/                 # Pruebas automatizadas
└── vendor/                # Dependencias de Composer
```

## Comandos Útiles

- **Iniciar el entorno de desarrollo**
  ```bash
  ./vendor/bin/sail up -d
  ```

- **Detener los contenedores**
  ```bash
  ./vendor/bin/sail down
  ```

- **Ejecutar migraciones**
  ```bash
  ./vendor/bin/sail artisan migrate
  ```

- **Ejecutar pruebas**
  ```bash
  ./vendor/bin/sail test
  ```

- **Acceder a la terminal del contenedor**
  ```bash
  ./vendor/bin/sail shell
  ```

## Configuración de Base de Datos

La aplicación utiliza PostgreSQL como base de datos. La configuración por defecto es:

- **Host**: pgsql (dentro de Docker) o localhost (fuera de Docker)
- **Puerto**: 5432
- **Base de datos**: laravel
- **Usuario**: sail
- **Contraseña**: password

## Variables de Entorno Importantes

```env
APP_NAME="Crazy Imagine"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8080

DB_CONNECTION=pgsql
DB_HOST=pgsql
DB_PORT=5432
DB_DATABASE=laravel
DB_USERNAME=sail
DB_PASSWORD=password

CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis

MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

## Solución de Problemas

### Error de conexión a la base de datos

Si recibes un error de conexión a la base de datos, verifica que:

1. Los contenedores estén en ejecución:
   ```bash
   docker ps
   ```

2. La configuración en `.env` sea correcta

3. La base de datos esté accesible desde el contenedor:
   ```bash
   ./vendor/bin/sail exec pgsql psql -U sail -d laravel -c "\dt"
   ```

### Limpiar caché

Si encuentras problemas con las vistas o rutas, intenta limpiar la caché:

```bash
./vendor/bin/sail artisan cache:clear
./vendor/bin/sail artisan config:clear
./vendor/bin/sail artisan route:clear
./vendor/bin/sail artisan view:clear
```

## Licencia

Este proyecto está bajo la [Licencia MIT](LICENSE).
