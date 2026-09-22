# Lista de seguridad para el despliegue

- Revoca cualquier clave de API que haya aparecido anteriormente en el HTML o JavaScript del navegador.
- Guarda `GEMINI_API_KEY` únicamente como variable de entorno en el servidor.
- Mantén los archivos de reservaciones fuera de la carpeta pública.
- Utiliza HTTPS en todas las páginas publicadas.
- Limita las solicitudes a `proxy.php` y `leads.php` desde el servidor, CDN o proxy inverso.
- Sustituye las credenciales temporales antes de publicar el sitio.
- No utilices información real de clientes en el entorno de pruebas.
- Agrega un aviso de privacidad y solicita consentimiento antes de guardar datos de contacto.
- Realiza una copia de seguridad del sitio y las reservaciones antes de actualizar.
- Revisa el menú, alérgenos, precios, horarios y medios de contacto antes del lanzamiento.
