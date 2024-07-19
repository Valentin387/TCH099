<?php
require_once __DIR__.'/router.php';

// Home Routes
get('/', 'frontend/pages/index.html');
post('/', 'frontend/pages/index.html');

// Authentication Routes
get('/login', 'frontend/pages/login.html'); // GET
get('/signup', 'frontend/pages/signup.html'); // GET
post('/signup', 'frontend/pages/signup.html'); // POST

// Frontend Pages Routes
get('/hello-world', 'frontend/pages/hello-world.html'); // GET
get('/random-image', 'frontend/pages/random-image.html'); // GET

// Admin Route
get('/admin', function() {
    if (isAdmin()) {
        include_once __DIR__ . '/frontend/pages/admin.html';
    } else {
        include_once __DIR__ . "/frontend/pages/403.html";
    }
}); // GET

// API Routes
post('/api/login', 'api/login.php'); // POST
post('/api/signup', 'api/signup.php'); // POST
post('/api/logout', 'api/logout.php'); // POST
get('/api/user_details', 'api/user_details.php'); // GET
get('/api/clients', 'api/clients.php'); // GET

post('/api/hello-world/$langue', 'api/hello-world.php'); // POST
get('/api/hello-world/$langue', 'api/hello-world.php'); // GET
get('/api/random-image', 'api/random-image.php'); // GET

// 404 Route
any('/404', 'frontend/pages/404.html');
// 403 Route
any('/403', 'frontend/pages/403.html');

// Static File Routes
get('/css/*', function($path) {
    $filePath = __DIR__ . '/frontend/css/' . $path;
    if (file_exists($filePath)) {
        header('Content-Type: text/css');
        readfile($filePath);
    } else {
        include_once __DIR__ . '/frontend/pages/404.html';
    }
});

get('/js/*', function($path) {
    $filePath = __DIR__ . '/frontend/js/' . $path;
    if (file_exists($filePath)) {
        header('Content-Type: application/javascript');
        readfile($filePath);
    } else {
        include_once __DIR__ . '/frontend/pages/404.html';
    }
});

get('/images/*', function($path) {
    $filePath = __DIR__ . '/frontend/images/' . $path; // Corrected path to 'images'
    if (file_exists($filePath)) {
        $mimeType = mime_content_type($filePath);
        header('Content-Type: ' . $mimeType);
        readfile($filePath);
    } else {
        include_once __DIR__ . '/frontend/pages/404.html';
    }
});
?>
