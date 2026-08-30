<?php
declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

$storagePath = getenv('LEADS_STORAGE_PATH') ?: '';
if ($storagePath === '') {
    http_response_code(503);
    echo json_encode(['error' => 'Lead storage is not configured']);
    exit;
}

$raw = file_get_contents('php://input');
if ($raw === false || strlen($raw) > 32768) {
    http_response_code(413);
    echo json_encode(['error' => 'Request is too large']);
    exit;
}

$input = json_decode($raw, true);
if (!is_array($input)) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid request']);
    exit;
}

$allowedFields = [
    'tipo', 'nombre', 'tel', 'fecha', 'hora', 'personas', 'zona', 'notas',
    'ocasion', 'presupuesto', 'restricciones', 'notaTxt', 'mesas'
];
$lead = [];
foreach ($allowedFields as $field) {
    if (!array_key_exists($field, $input)) {
        continue;
    }
    $value = is_array($input[$field]) ? implode(', ', $input[$field]) : (string) $input[$field];
    $lead[$field] = mb_substr(trim(strip_tags($value)), 0, 500);
}
$lead['received_at'] = gmdate('c');

$directory = dirname($storagePath);
if (!is_dir($directory) || !is_writable($directory)) {
    http_response_code(503);
    echo json_encode(['error' => 'Lead storage is unavailable']);
    exit;
}

$line = json_encode($lead, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . PHP_EOL;
if (file_put_contents($storagePath, $line, FILE_APPEND | LOCK_EX) === false) {
    http_response_code(500);
    echo json_encode(['error' => 'Lead could not be saved']);
    exit;
}

http_response_code(201);
echo json_encode(['saved' => true]);
