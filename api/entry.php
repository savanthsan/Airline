<?php
// Single-entry serverless function router for Vercel Hobby Plan (1 Function Limit Solution)

$uri = $_SERVER['REQUEST_URI'] ?? '/';
$path = parse_url($uri, PHP_URL_PATH);

// Serve static assets directly if requested
if (preg_match('/\.(?:css|js|jpg|jpeg|png|gif|ico|svg)$/', $path)) {
    $file = __DIR__ . '/..' . $path;
    if (file_exists($file) && is_file($file)) {
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        $mimeTypes = [
            'css' => 'text/css',
            'js' => 'application/javascript',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'ico' => 'image/x-icon',
            'svg' => 'image/svg+xml'
        ];
        header('Content-Type: ' . ($mimeTypes[$ext] ?? 'text/plain'));
        readfile($file);
        exit();
    }
}

// Clean up path
$path = ltrim($path, '/');

if ($path === '' || $path === 'index.php' || $path === 'api/index.php') {
    require __DIR__ . '/index.php';
    exit();
}

// Check direct file path in api directory
$target = __DIR__ . '/../' . $path;
if (file_exists($target) && is_file($target)) {
    require $target;
    exit();
}

$apiTarget = __DIR__ . '/' . $path;
if (file_exists($apiTarget) && is_file($apiTarget)) {
    require $apiTarget;
    exit();
}

// Fallback to index.php
require __DIR__ . '/index.php';
