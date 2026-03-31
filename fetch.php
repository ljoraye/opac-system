<?php
$url = "https://qjpykutncwzeenhgjyuk.supabase.co";
$apiKey = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6InFqcHlrdXRuY3d6ZWVuaGdqeXVrIiwicm9sZSI6ImFub24iLCJpYXQiOjE3NzQ4ODMwMDksImV4cCI6MjA5MDQ1OTAwOX0.UON9IAxYENQwGeMirY8friPzeQQKgLYy17F2Gr7JumE";

$headers = [
    "Content-Type: application/json",
    "apikey: $apiKey",
    "Authorization: Bearer $apiKey"
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

echo $response;
?>
