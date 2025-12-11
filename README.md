# TallerLink - Sistema de Gestión de Talleres

Sistema web desarrollado en Laravel para la gestión de talleres mecánicos, citas y técnicos.

## Requisitos Previos

- PHP >= 8.1
- Composer
- Node.js y npm
- SQLite (o MySQL/PostgreSQL)

## Instalación

Después de clonar el repositorio, ejecuta los siguientes comandos:

### 1. Instalar dependencias de PHP
```bash
composer install
```

### 2. Instalar dependencias de Node.js
```bash
npm install
```

### 3. Configurar archivo de entorno
```bash
cp .env.example .env
```

### 4. Generar clave de aplicación
```bash
php artisan key:generate
```

### 5. Configurar base de datos

Si usas SQLite (por defecto), asegúrate de que el archivo `database/database.sqlite` exista:
```bash
touch database/database.sqlite
```

O configura tu base de datos en el archivo `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_base_datos
DB_USERNAME=usuario
DB_PASSWORD=contraseña
```

### 6. Ejecutar migraciones
```bash
php artisan migrate
```

### 7. Compilar assets (opcional, para desarrollo)
```bash
npm run dev
```

O para producción:
```bash
npm run build
```

### 8. Iniciar servidor de desarrollo
```bash
php artisan serve
```

El proyecto estará disponible en: `http://127.0.0.1:8000`

## Roles del Sistema

- **Administrador**: Gestión completa del sistema, talleres, técnicos y usuarios
- **Técnico**: Puede tomar reservas, cambiar estados de citas y gestionar su taller asignado
- **Usuario**: Puede buscar talleres, hacer reservas y ver su historial

## Funcionalidades Principales

- Gestión de talleres mecánicos
- Sistema de reservas de citas
- Asignación de técnicos a talleres
- Notificaciones en tiempo real
- Historial de citas
- Dashboard administrativo

## Estructura del Proyecto

```
lp3n/
├── app/
│   ├── Http/Controllers/    # Controladores
│   ├── Models/              # Modelos Eloquent
│   └── ...
├── database/
│   ├── migrations/          # Migraciones de base de datos
│   └── database.sqlite      # Base de datos SQLite
├── resources/
│   └── views/               # Vistas Blade
└── routes/
    └── web.php              # Rutas web
```

## Comandos Útiles

### Limpiar caché
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Ver rutas disponibles
```bash
php artisan route:list
```

### Crear nuevo usuario administrador
```bash
php artisan tinker
```
Luego en tinker:
```php
User::create([
    'name' => 'Admin',
    'email' => 'admin@example.com',
    'password' => Hash::make('password'),
    'role' => 'admin'
]);
```

## Licencia

Este proyecto es de código abierto y está disponible bajo la licencia MIT.
