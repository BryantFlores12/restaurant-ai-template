# AI Restaurant Website Template

A responsive restaurant website starter with reservation capture, event-menu configuration, a local knowledge-base chatbot, and optional Gemini responses through a server-side PHP proxy.

## Highlights

- Responsive, single-page dining experience.
- Menu, venue, events, testimonials, and reservation sections.
- Configurable event-menu builder.
- Chat assistant with a no-network fallback knowledge base.
- Optional Gemini integration that keeps the API key on the server.
- Optional reservation lead storage outside the public web root.
- Security checklist and customer intake form for repeatable delivery.

## Requirements

- Static hosting for demonstration mode.
- PHP 8.1+ with cURL for server-side Gemini responses.
- `GEMINI_API_KEY` configured in the server environment.
- An optional writable location outside the public directory through `LEADS_STORAGE_PATH`.

## Local preview

For the static experience, serve the directory with any local web server:

```bash
php -S localhost:8080
```

Open `http://localhost:8080`. The chatbot continues to answer common questions from its built-in knowledge base when Gemini is not configured.

## Secure deployment

1. Upload the project to a staging environment.
2. Configure `GEMINI_API_KEY` only in the server environment.
3. Configure `LEADS_STORAGE_PATH` outside the public web root if lead storage is enabled.
4. Add rate limiting for `proxy.php` and `leads.php` at the host, CDN, or reverse proxy.
5. Replace every placeholder restaurant detail, price, testimonial, contact value, and image.
6. Add privacy and consent language before collecting customer information.
7. Review `SECURITY.md` before launch.

## Files

| Path | Purpose |
| --- | --- |
| `index.html` | Website, styling, configuration, and browser-side behavior |
| `proxy.php` | Server-side Gemini proxy |
| `leads.php` | Optional reservation lead storage |
| `img/` | Demonstration imagery to replace for production |
| `INTAKE_FORM.md` | Customer customization questionnaire |
| `SERVICE_SCOPE.md` | Suggested delivery boundaries |
| `SECURITY.md` | Production security checklist |

## Asset and license notice

The included photos are demonstration assets and must be replaced with images the deploying restaurant owns or is licensed to use. This project is proprietary commercial software under `LICENSE.txt`; review those terms before sharing or deploying the source.
