# Guía de Configuración: Inicio de Sesión con Google OAuth 2.0

## 📋 Resumen
Se ha implementado un sistema completo de autenticación OAuth 2.0 con Google para el proyecto Teatro Kusi-Wasi. Los usuarios pueden ahora iniciar sesión usando su cuenta de Gmail.

## 🔧 Pasos para Configurar Google Cloud Console

### 1. Crear un Proyecto en Google Cloud Console

1. Ve a [Google Cloud Console](https://console.cloud.google.com/)
2. Haz clic en el selector de proyecto (arriba a la izquierda)
3. Haz clic en **"NEW PROJECT"**
4. Nombre del proyecto: **Teatro Kusi-Wasi** (o el que prefieras)
5. Haz clic en **CREATE**
6. Espera a que se cree el proyecto

### 2. Habilitar Google+ API

1. En la consola, busca **"Google+ API"** en la barra de búsqueda
2. Haz clic en **Google+ API** en los resultados
3. Haz clic en el botón **ENABLE**
4. Espera a que se habilite

### 3. Crear Credenciales OAuth 2.0

1. En el menú de la izquierda, ve a **Credentials** (Credenciales)
2. Haz clic en **+ CREATE CREDENTIALS**
3. Selecciona **OAuth client ID**
4. Si aparece un aviso pidiendo configurar la pantalla de consentimiento, haz clic en **CONFIGURE CONSENT SCREEN**

### 4. Configurar la Pantalla de Consentimiento (OAuth Consent Screen)

1. Selecciona **External** (Externo)
2. Haz clic en **CREATE**
3. Completa el formulario:
   - **App name**: Teatro Kusi-Wasi
   - **User support email**: tu_email@gmail.com
   - **Developer contact**: tu_email@gmail.com
4. Haz clic en **SAVE AND CONTINUE**
5. En "Scopes", no es necesario agregar nada especial, haz clic en **SAVE AND CONTINUE**
6. En "Test users", puedes agregar las cuentas de Gmail que usarán la app en desarrollo
7. Haz clic en **SAVE AND CONTINUE**
8. Vuelve a **Credentials**

### 5. Crear OAuth 2.0 Client ID

1. Haz clic en **+ CREATE CREDENTIALS** nuevamente
2. Selecciona **OAuth client ID**
3. En "Application type", selecciona **Web application**
4. Nombre: **Teatro Kusi-Wasi Web**
5. En "Authorized redirect URIs", agrega:
   - Para desarrollo: `http://localhost/TEATROKusi-Wasi/frontend/backend/src/auth/google_callback.php`
   - Para producción: `https://tudominio.com/backend/src/auth/google_callback.php`
6. Haz clic en **CREATE**
7. Se abrirá una ventana con tus credenciales:
   - **Client ID** (ID de cliente)
   - **Client Secret** (Secreto de cliente)

## 📝 Configurar las Credenciales en la Aplicación

1. Abre el archivo: `backend/src/config/google_config.php`
2. Reemplaza los valores:
   ```php
   define('GOOGLE_CLIENT_ID', 'TU_GOOGLE_CLIENT_ID.apps.googleusercontent.com');
   define('GOOGLE_CLIENT_SECRET', 'TU_GOOGLE_CLIENT_SECRET');
   ```

3. Con los valores que copiaste de Google Cloud Console
4. Guarda el archivo

## 📁 Archivos Creados/Modificados

### Nuevos archivos:
- **backend/src/auth/google_login.php**: Inicia el flujo OAuth
- **backend/src/auth/google_callback.php**: Recibe y procesa la respuesta de Google

### Archivos modificados:
- **backend/src/config/google_config.php**: Actualizado con configuración completa
- **frontend/pages/loging.php**: Botón de Google ahora funcional

## 🔐 Características de Seguridad

✅ **CSRF Protection**: Se usa un token CSRF para proteger contra ataques
✅ **SSL Verification**: Se verifica el certificado SSL de Google
✅ **Contraseña Aleatoria**: Los usuarios OAuth reciben una contraseña aleatoria como respaldo
✅ **Validación de Estado**: Se valida el parámetro `state` de OAuth 2.0

## 🎯 Flujo de Autenticación

1. Usuario hace clic en "Iniciar sesión con Google"
2. Se redirige a `google_login.php`
3. Se genera un token CSRF y se redirige a Google
4. Usuario se autentica en Google
5. Google redirige a `google_callback.php` con un código
6. Se intercambia el código por un token de acceso
7. Se obtiene la información del usuario (email, nombre)
8. Se busca/crea al usuario en la base de datos
9. Se crea una sesión y se redirige al índice

## 📊 Datos Almacenados

Cuando un usuario se autentica por primera vez con Google:
- Se crea automáticamente en la tabla `usuarios`
- Se guarda: nombre, email, contraseña aleatoria, rol="usuario"
- En intentos posteriores, solo se actualiza el nombre si cambió

## ⚙️ Variables de Sesión

Después de autenticarse, están disponibles:
- `$_SESSION['user_id']`: ID del usuario
- `$_SESSION['user_name']`: Nombre del usuario
- `$_SESSION['user_rol']`: Rol del usuario
- `$_SESSION['user_email']`: Email del usuario
- `$_SESSION['google_auth']`: Indica que fue autenticado con Google

## 🌐 URLs Importantes

- **Google Cloud Console**: https://console.cloud.google.com/
- **OAuth 2.0 Documentation**: https://developers.google.com/identity/protocols/oauth2

## ⚠️ Solución de Problemas

### "Token de seguridad inválido"
- El estado no coincide entre las dos solicitudes
- Verifica que las cookies de sesión están habilitadas

### "No se recibió código de autorización"
- El usuario rechazó la autorización en Google
- Verifica que el `client_id` es correcto

### "Error de conexión a Google"
- Verifica que `curl` está habilitado en PHP
- Verifica la conexión a internet

### "No existe tabla usuarios"
- Importa la base de datos desde `backend/src/config/bdkusiwasi.sql`
- Verifica que MySQL está corriendo

## 📱 Para Producción

1. Cambiar `GOOGLE_REDIRECT_URI` en `google_config.php` a tu dominio
2. Crear un nuevo OAuth Client ID en Google Cloud con la URL de producción
3. Actualizar credenciales en `google_config.php`
4. Habilitar HTTPS en tu servidor
5. Verificar que la BD está segura y los datos confidenciales están protegidos

---

**Fecha de creación**: 20 de enero de 2026
**Versión**: 1.0
