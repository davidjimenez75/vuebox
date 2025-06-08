<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

include 'config.php';

if (!isset($_GET['project'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Project parameter is required']);
    exit;
}

$project = $_GET['project'];

// Security: prevent directory traversal
if (strpos($project, '..') !== false || strpos($project, '/') !== false || strpos($project, '\\') !== false) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid project name']);
    exit;
}

$project_path = __DIR__ . '/' . $project;

if (!is_dir($project_path)) {
    http_response_code(404);
    echo json_encode(['error' => 'Project not found']);
    exit;
}

$found_files = [];

foreach ($viewed_files as $file) {
    $file_path = $project_path . '/' . $file;
    if (file_exists($file_path) && is_file($file_path)) {
        $found_files[] = $file;
    }
}

echo json_encode(['files' => $found_files]);
?>
