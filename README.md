
```bash
# Levantar en segundo plano
docker compose -f docker_compose.yml up -d
```

Acceder a PHP en el navegador en http://localhost:8080

La carpeta `php` está montada en el contenedor, así que cualquier cambio local se refleja automáticamente.

Nombres de servicios y credenciales (definidos en `docker_compose.yml`):

- Servicio web: `web-catchly`
- Servicio MySQL: `mysql-catchly`
- Usuario: `catchly`
- Contraseña: `catchly_secret`
- Base de datos: `catchly`
- Root: `catchly_rootpassword`
