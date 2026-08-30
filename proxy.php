<?php
declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

$apiKey = getenv('GEMINI_API_KEY') ?: '';
$model = getenv('GEMINI_MODEL') ?: 'gemini-2.5-flash';

if ($apiKey === '') {
    http_response_code(503);
    echo json_encode(['error' => 'AI service is not configured']);
    exit;
}

$raw = file_get_contents('php://input');
if ($raw === false || strlen($raw) > 131072) {
    http_response_code(413);
    echo json_encode(['error' => 'Request is too large']);
    exit;
}

$payload = json_decode($raw, true);
if (!is_array($payload) || !isset($payload['contents']) || !is_array($payload['contents'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid request']);
    exit;
}

$allowed = array_intersect_key($payload, array_flip([
    'contents', 'system_instruction', 'generationConfig'
]));

$url = sprintf(
    'https://generativelanguage.googleapis.com/v1beta/models/%s:generateContent?key=%s',
    rawurlencode($model),
    rawurlencode($apiKey)
);

$ch = curl_init($url);
if ($ch === false) {
    http_response_code(500);
    echo json_encode(['error' => 'AI service initialization failed']);
    exit;
}

curl_setopt_array($ch, [
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode($allowed, JSON_UNESCAPED_UNICODE),
    CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CONNECTTIMEOUT => 8,
    CURLOPT_TIMEOUT => 25,
]);

$response = curl_exec($ch);
$status = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if (!is_string($response) || $status < 200 || $status >= 300) {
    http_response_code(502);
    echo json_encode(['error' => 'AI service is temporarily unavailable']);
    exit;
}

http_response_code(200);
echo $response;
