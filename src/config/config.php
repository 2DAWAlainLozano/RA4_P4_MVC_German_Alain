<?php
define('DB_HOST', getenv('MYSQL_HOST') ?: 'db');
define('DB_NAME', getenv('MYSQL_DATABASE') ?: 'blog_db');
define('DB_USER', getenv('MYSQL_USER') ?: 'blog_user');
define('DB_PASS', getenv('MYSQL_PASSWORD') ?: 'blog_pass');
define('DB_CHARSET', 'utf8mb4');
