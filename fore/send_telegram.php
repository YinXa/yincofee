<?php
// Token bot dan chat ID kamu
$botToken = '7555241561:AAGJ91VDzpmF-6GnWTVKm-rwTusfF8bCWcQ';
$chatId = '6473529850';

// Ambil data dari POST
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$message = $_POST['message'] ?? '';

// Format pesan yang akan dikirim ke Telegram
$text = "📩 *Pesan Baru dari Website*\n"
      . "👤 *Nama*: $name\n"
      . "📧 *Email*: $email\n"
      . "📝 *Pesan*: $message";

// Buat URL Telegram API
$url = "https://api.telegram.org/bot{$botToken}/sendMessage";

// Data yang akan dikirim ke Telegram
$data = [
    'chat_id' => $chatId,
    'text' => $text,
    'parse_mode' => 'Markdown' // untuk format tebal dll
];

// Kirim request POST ke Telegram
$options = [
    'http' => [
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data),
    ]
];
$context  = stream_context_create($options);
$response = file_get_contents($url, false, $context);

// Beri respon ke browser
if ($response) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error"]);
}
?>
