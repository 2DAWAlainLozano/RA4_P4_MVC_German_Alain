# Sistema Web con PHP, MVC, Docker y TailwindCSS

## Descripción General

El sistema debe ejecutarse completamente dentro de contenedores Docker, utilizando servicios independientes para el servidor web, base de datos y phpMyAdmin. La estructura del proyecto debe ser modular, siguiendo las mejores prácticas de separación de responsabilidades mediante el patrón MVC.

## Objetivos Técnicos

1. Implementar un backend organizado utilizando **arquitectura MVC**.
2. Gestionar usuarios mediante **registro, login, sesiones y roles**.
3. Crear un **CRUD completo para publicaciones (posts)**.
4. Crear un **sistema de comentarios** vinculado a cada post.
5. Diseñar un **panel administrativo** para el control global de usuarios, posts y comentarios.
6. Integrar **TailwindCSS** como sistema principal de estilos.
7. Asegurar el sistema mediante validación, sanitización, SQL seguro y control de acceso.
8. Ejecutar todo el entorno utilizando **Docker Compose**.

---

## Requerimientos Funcionales

### 3.1 Usuarios

* Registro con validación y almacenamiento seguro de contraseñas (`password_hash`).
* Login mediante sesiones nativas de PHP.
* **Roles:** `admin`, `writer`, `subscriber`.
* Permisos diferenciados basados en el rol.

### 3.2 Publicaciones (Posts)

* Listar todas las publicaciones.
* Ver una publicación individual junto con sus comentarios.
* Crear nuevas publicaciones (solo `admin` y `writer`).
* Editar y eliminar publicaciones (solo `admin` y el autor del post).

### 3.3 Comentarios

* Crear comentarios en las publicaciones (solo usuarios autenticados).
* Eliminar comentarios (el autor del comentario o `admin`).

### 3.4 Panel de Administración

* Listado global de usuarios.
* Cambio de roles de usuario.
* Listado global de posts.
* Listado global de comentarios.
* Acciones reservadas estrictamente para `admin`.

---

## Requerimientos Técnicos

### 4.1 PHP + MVC

* Archivos separados para Controladores, Modelos y Vistas.
* Archivo de entrada único (`index.php`) para el enrutamiento.
* Métodos en controladores para cada acción.

### 4.2 MySQL

* **Tablas:** `users`, `posts`, `comments`.
* Relaciones mediante claves foráneas (Foreign Keys).

### 4.3 Docker

* **Contenedores:**
* Servidor Web con PHP (Apache o FPM).
* MySQL.
* phpMyAdmin.


* `Dockerfile` para construir la imagen de PHP con extensiones necesarias (pdo_mysql).
* `docker-compose` para levantar el entorno.

---

## Estructura de Carpetas y Archivos

Estructura base recomendada, limpia de módulos de IA y automatización:

```text
/project-root
│
├── config/
│   └── Database.php
│
├── controllers/
│   ├── PostController.php
│   ├── CommentController.php
│   ├── UserController.php
│   └── AdminController.php
│
├── models/
│   ├── User.php
│   ├── Post.php
│   └── Comment.php
│
├── views/
│   ├── layout/
│   │   ├── header.php
│   │   └── footer.php
│   │
│   ├── posts/
│   │   ├── index.php
│   │   ├── show.php
│   │   ├── create.php
│   │   ├── edit.php
│   │   └── delete.php
│   │
│   ├── comments/
│   │   ├── create.php
│   │   └── delete.php
│   │
│   ├── auth/
│   │   ├── login.php
│   │   └── register.php
│   │
│   ├── admin/
│   │   ├── dashboard.php
│   │   ├── users.php
│   │   ├── posts.php
│   │   └── comments.php
│
├── public/
│   ├── css/
│   │   └── app.css
│   ├── js/
│   └── index.php (si se usa como front controller público)
│
├── assets/
│   └── css/
│       └── input.css
│
├── scripts/
│   ├── create_seed_users.php
│   ├── create_seed_comments.php
│   └── create_seed_posts.php
│
├── docker/
│   └── php.ini (opcional)
│
├── docker-compose.yml
├── Dockerfile
├── tailwind.config.js
├── database.sql
├── README.md
└── index.php (front controller principal)

```

---

## Detalles de Arquitectura Backend

### Backend con PHP, MVC y Docker

El backend corre sobre PHP (preferiblemente con Apache) y distribuye responsabilidades usando el **patrón MVC**. Los Modelos gestionan el acceso a la base de datos, los Controladores procesan las peticiones y coordinan la lógica, y las Vistas generan el HTML final.

**Ejemplo: Lógica del Controlador**

```php
// Fragmento de ejemplo
public function show($id) {
    $post = $this->postModel->find($id);
    return $this->render('posts/show.php', ['post' => $post]);
}

```

**Ejemplo: Lógica del Modelo**

```php
// Fragmento reducido
public function find($id) {
    $stmt = $this->db->prepare("SELECT * FROM posts WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

```

### Autenticación y Seguridad

La aplicación incorpora un sistema de usuarios con autenticación basada en sesiones y roles.

* **Verificación de Rol:**

```php
if ($_SESSION['role'] !== 'writer' && $_SESSION['role'] !== 'admin') {
    header("Location: index.php?action=login");
    exit;
}

```

---

## Ciclo: Petición-Respuesta y Lógica MVC

### Procesamiento de la Petición

El flujo básico pasa por un archivo de entrada único (`index.php`) que delega la ejecución basándose en parámetros de la URL.

```php
// index.php (simplificado)
$action = $_GET['action'] ?? 'posts';
$controller = new PostController();

// Router básico
switch ($action) {
    case 'create_post':
        $controller->create();
        break;
    default:
        $controller->index();
        break;
}

```

### Vistas con TailwindCSS

Las vistas reciben datos y renderizan HTML utilizando clases de utilidad de Tailwind.

```html
<div class="max-w-4xl mx-auto p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-bold text-gray-800"><?= htmlspecialchars($post['title']) ?></h1>
    <p class="mt-4 text-gray-600"><?= nl2br(htmlspecialchars($post['content'])) ?></p>
</div>

```

---

## Autenticación, Sesiones y Roles

### Flujo de Login

1. Recibir datos del formulario.
2. Verificar contraseña con `password_verify`.
3. Crear variables de sesión.

```php
// UserController.php
if ($user && password_verify($pass, $user['password_hash'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['role'] = $user['role'];
    header("Location: index.php?action=posts");
}

```

### Registro

Usa `password_hash` para asegurar que las contraseñas no se almacenen en texto plano.

```php
$hash = password_hash($password, PASSWORD_DEFAULT);
$this->userModel->create($username, $email, $hash);

```

---

## CRUD: Posts

### Lectura (List & Show)

Recupera datos del modelo y los pasa a la vista.

```php
$posts = $this->postModel->all();
return $this->render('posts/index.php', ['posts' => $posts]);

```

### Crear (Create)

Requiere rol de `writer` o `admin`.

```php
public function store() {
    // Validaciones aquí
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $this->postModel->store($title, $content, $_SESSION['user_id']);
    header("Location: index.php?action=posts");
}

```

### Actualizar y Eliminar

La eliminación borra el registro y los comentarios asociados (vía restricción `ON DELETE CASCADE` en la base de datos).

```php
$stmt = $this->db->prepare("DELETE FROM posts WHERE id = ?");
$stmt->execute([$id]);

```

---

## CRUD: Comentarios

### Estructura

Los comentarios están vinculados a `post_id` y `user_id`.

### Lógica

1. Verificar autenticación.
2. Validar texto (no vacío).
3. Insertar comentario en base de datos.
4. Redirigir al post original.

```php
// CommentController.php
public function store() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php?action=login");
        exit;
    }
    
    $postId = $_POST['post_id'];
    $text = $_POST['text'];
    
    $this->commentModel->create($postId, $_SESSION['user_id'], $text);
    header("Location: index.php?action=show_post&id=" . $postId);
}

```

---

## Panel de Administración

### Control de Acceso

Estrictamente para usuarios con `role === 'admin'`.

```php
private function requireAdmin() {
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        header("Location: index.php?action=posts");
        exit;
    }
}

```

### Dashboard

Proporciona vistas globales de Usuarios, Posts y Comentarios, permitiendo acciones de gestión (borrado masivo, cambio de roles) no disponibles para usuarios estándar.

```html
<div class="grid grid-cols-3 gap-4">
    <a href="index.php?action=admin_users" class="block p-6 bg-blue-100 rounded shadow text-center hover:bg-blue-200">
        <h2 class="text-lg font-semibold text-blue-800">Gestionar Usuarios</h2>
    </a>
    </div>

```