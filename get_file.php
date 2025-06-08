<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

if (!isset($_GET['project']) || !isset($_GET['file'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Project and file parameters are required']);
    exit;
}

$project = $_GET['project'];
$file = $_GET['file'];

// Security: prevent directory traversal
if (strpos($project, '..') !== false || strpos($project, '/') !== false || strpos($project, '\\') !== false ||
    strpos($file, '..') !== false || strpos($file, '/') !== false || strpos($file, '\\') !== false) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid project or file name']);
    exit;
}

$file_path = __DIR__ . '/' . $project . '/' . $file;

if (!file_exists($file_path) || !is_file($file_path)) {
    http_response_code(404);
    echo json_encode(['error' => 'File not found']);
    exit;
}

// Read file content
$content = file_get_contents($file_path);

if ($content === false) {
    http_response_code(500);
    echo json_encode(['error' => 'Could not read file']);
    exit;
}

echo json_encode(['content' => $content]);
?>
