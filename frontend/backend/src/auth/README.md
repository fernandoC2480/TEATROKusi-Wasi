# Sistema de Autenticación - Teatro Kusi-Wasi

## 📚 Archivos en esta carpeta

### Autenticación Tradicional (Email + Contraseña)
- **login_process.php**: Procesa login tradicional
- **register_process.php**: Procesa registro de nuevos usuarios
- **logout.php**: Cierra la sesión

### Autenticación con Google OAuth 2.0
- **google_login.php**: Inicia el flujo OAuth con Google
- **google_callback.php**: Recibe y procesa la respuesta de Google

## 🚀 Configuración Rápida

### 1. Google Cloud Console
1. Ve a https://console.cloud.google.com/
2. Crea un proyecto
3. Habilita Google+ API
4. Crea credenciales OAuth 2.0 (Web Application)
5. Copia Client ID y Client Secret

### 2. Configurar en la aplicación
Edita `backend/src/config/google_config.php`:
```php
define('GOOGLE_CLIENT_ID', 'TU_CLIENT_ID.apps.googleusercontent.com');
define('GOOGLE_CLIENT_SECRET', 'TU_CLIENT_SECRET');
```

### 3. Base de datos
Ejecuta `backend/src/config/google_users_migration.sql` para asegurar que la tabla usuarios está lista.

## 📖 Documentación Completa
Lee `GOOGLE_OAUTH_SETUP.md` en la carpeta frontend para instrucciones detalladas.

## 🔐 Uso en tus páginas

```php
<?php
require_once '../../backend/src/config/auth_helper.php';

// Verificar si está logueado
if (isUserLoggedIn()) {
    echo "Hola, " . getCurrentUserName();
}

// Requerir login obligatorio
requireLogin();

// Requerir rol específico
requireRole('admin');
```

## 🎯 Flujo de Login

```
Usuario hace clic en botón
    ↓
google_login.php (genera CSRF token, redirige a Google)
    ↓
Google (usuario se autentica)
    ↓
google_callback.php (intercambia código por token, obtiene datos)
    ↓
Base de datos (busca/crea usuario)
    ↓
Sesión creada
    ↓
Redirige a index.php
```

## ⚡ Funciones Disponibles

- `isUserLoggedIn()` - ¿Está autenticado?
- `getCurrentUserId()` - Obtiene ID del usuario
- `getCurrentUserName()` - Obtiene nombre
- `getCurrentUserEmail()` - Obtiene email
- `getCurrentUserRole()` - Obtiene rol
- `isGoogleAuthenticated()` - ¿Usó Google para login?
- `requireLogin()` - Redirige a login si no está autenticado
- `requireRole($rol)` - Verifica rol requerido

## 🐛 Solución de Problemas

**"No puedo ver el botón de Google"**
- Verifica que google_config.php esté cargado
- Revisa la consola del navegador (F12) para errores

**"Error: No se recibió código"**
- El usuario rechazó el permiso en Google
- Verifica que el Redirect URI en Google Cloud coincide con el código

**"Error de base de datos"**
- Verifica que MySQL está corriendo
- Verifica credenciales en database.php

---

Para más información, ve a `GOOGLE_OAUTH_SETUP.md` en el directorio frontend.
