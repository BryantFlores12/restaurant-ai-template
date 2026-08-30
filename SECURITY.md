# Deployment Security Checklist

- Revoke any API key that has previously appeared in browser-side HTML or JavaScript.
- Store `GEMINI_API_KEY` only as a server environment variable.
- Keep reservation files outside the public web root.
- Use HTTPS on all production pages.
- Add rate limiting at the host, CDN, or reverse proxy for `proxy.php` and `leads.php`.
- Replace temporary deployment credentials after delivery.
- Do not use real customer data in staging.
- Add a privacy notice and obtain consent before storing reservation contact information.
- Back up the site and lead storage before updates.
- Review menu, allergen, price, opening-hour, and contact claims with the restaurant owner before launch.

