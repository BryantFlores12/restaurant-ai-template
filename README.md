# Sitio web para restaurante con inteligencia artificial

[![CI](https://github.com/BryantFlores12/restaurant-ai-template/actions/workflows/ci.yml/badge.svg)](https://github.com/BryantFlores12/restaurant-ai-template/actions/workflows/ci.yml)

Este proyecto es un sitio web para restaurante que desarrollé para mostrar el menú, los eventos y la información del lugar, además de recibir reservaciones. También incluye un asistente que puede responder con información local o conectarse con Gemini desde un servidor en PHP.

## Funciones principales

- Diseño adaptable en una sola página.
- Secciones para menú, restaurante, eventos, testimonios y reservaciones.
- Configurador de menús para eventos.
- Asistente con respuestas locales cuando no hay conexión con la IA.
- Integración opcional con Gemini sin exponer la clave en el navegador.
- Almacenamiento opcional de reservaciones fuera de la carpeta pública.
- Guía de seguridad para preparar el despliegue.

## Requisitos

- Alojamiento estático para utilizar el modo de demostración.
- PHP 8.1 o superior con cURL para recibir respuestas de Gemini desde el servidor.
- `GEMINI_API_KEY` configurada como variable de entorno.
- Una ubicación con permiso de escritura fuera de la carpeta pública mediante `LEADS_STORAGE_PATH`, si se guardarán reservaciones.

## Vista previa local

Para probar el sitio, inicia un servidor local dentro de la carpeta:

```bash
php -S localhost:8080
```

Abre `http://localhost:8080`. Si Gemini no está configurado, el asistente seguirá respondiendo preguntas comunes con la información incluida en el proyecto.

## Despliegue seguro

1. Sube el proyecto primero a un entorno de pruebas.
2. Configura `GEMINI_API_KEY` únicamente en el servidor.
3. Si guardarás reservaciones, configura `LEADS_STORAGE_PATH` fuera de la carpeta pública.
4. Limita las solicitudes a `proxy.php` y `leads.php` desde el servidor, CDN o proxy inverso.
5. Sustituye los datos, precios, testimonios, medios de contacto e imágenes de demostración.
6. Agrega un aviso de privacidad y consentimiento antes de guardar información de clientes.
7. Revisa `SECURITY.md` antes de publicar el sitio.

## Archivos principales

| Archivo | Uso |
| --- | --- |
| `index.html` | Sitio web, estilos, configuración y comportamiento del navegador |
| `proxy.php` | Conexión con Gemini desde el servidor |
| `leads.php` | Almacenamiento opcional de reservaciones |
| `img/` | Imágenes de demostración |
| `SECURITY.md` | Lista de seguridad para el despliegue |

## Sobre el proyecto

Lo desarrollé para combinar el diseño de una página de restaurante con funciones que sí podrían utilizarse en un proyecto real. Trabajé el formulario de reservaciones, los menús configurables, el asistente local y la conexión segura con Gemini mediante PHP.

## Sobre las imágenes

Las fotografías incluidas son de demostración y deben sustituirse por imágenes propias o con permiso de uso antes de publicar el sitio para un restaurante real.
