# AlquiClick 🏠

Sistema de gestión de alquileres de habitaciones con QR

## Descripción

AlquiClick es una aplicación web moderna que facilita la gestión y visualización de habitaciones disponibles para alquiler en diferentes edificios. Utiliza códigos QR para un acceso rápido a la información de las habitaciones.

## Tecnologías Principales

- Backend: Laravel 10 (PHP 8.2)
- Frontend: React + Vite
- Base de datos: MySQL 8.0
- Contenedorización: Docker

## Requisitos Previos

- Docker
- Docker Compose
- Git

## Estructura del Proyecto

```
alquiclick/
├── backend/         # API Laravel
├── frontend/        # Aplicación React
├── docker-compose.yml
└── README.md
```

## Instalación

1. Clonar el repositorio:
```bash
git clone https://github.com/tuusuario/alquiclick.git
cd alquiclick
```

2. Configurar variables de entorno:
```bash
cp backend/.env.example backend/.env
cp frontend/.env.example frontend/.env
```

3. Iniciar los contenedores:
```bash
docker-compose up -d
```

4. Instalar dependencias del backend:
```bash
docker-compose exec backend composer install
docker-compose exec backend php artisan key:generate
docker-compose exec backend php artisan migrate
docker-compose exec backend php artisan db:seed
```

5. Instalar dependencias del frontend:
```bash
docker-compose exec frontend npm install
```

## Acceso a la Aplicación

- Frontend: http://localhost:5173
- Backend API: http://localhost:8000
- phpMyAdmin: http://localhost:8080

## Características Principales

### Para Usuarios Finales
- Escaneo de QR para ver habitaciones disponibles
- Visualización de detalles de habitaciones
- Contacto directo con propietarios

### Para Administradores
- Gestión completa de edificios
- Gestión de habitaciones
- Generación de códigos QR
- Panel de control administrativo

## Seguridad

- Autenticación JWT para administradores
- Acceso restringido al panel de administración
- Endpoints API protegidos

## Desarrollo

Para ejecutar las pruebas:
```bash
docker-compose exec backend php artisan test
```

## Contribución

1. Fork el proyecto
2. Crea tu rama de características (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

## Licencia

Este proyecto está bajo la Licencia MIT - ver el archivo [LICENSE.md](LICENSE.md) para más detalles.
