<?php
// Filnamn: index.php

// Konfiguration
$pushoverUserKey = 'u6jzRU2YbEaKwuN9Xf6kgKjFUEf3bH';
$pushoverApiToken = 'ax176xhjvd7xfuon54kpcucknh7sv2';

// Funktion för att hämta geo-info baserat på IP
function getGeoInfo($ip) {
    $url = "http://ip-api.com/json/" . urlencode($ip) . "?fields=status,country,regionName,city,query";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if ($httpcode === 200 && $response) {
        $data = json_decode($response, true);
        if (isset($data['status']) && $data['status'] === 'success') {
            return $data; 
        }
    }
    return null;
}

// Om formuläret skickas
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = trim($_POST['message'] ?? '');
    $userIp = $_SERVER['REMOTE_ADDR'] ?? 'Okänd IP';
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'Okänd klient';

    if (!empty($message)) {
        // Skicka notisen via Pushover
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.pushover.net/1/messages.json");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, [
            'token' => $pushoverApiToken,
            'user' => $pushoverUserKey,
            'message' => $message
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpcode === 200) {
            $status = "Notisen skickades!";
        } else {
            $status = "Kunde inte skicka notisen. Kolla dina API-nycklar och internetanslutning.";
        }

        // Hämta geoinfo
        $geoInfo = getGeoInfo($userIp);

        // Spara logginfo
        // Log-format: [datum-tid] IP, Land, Region, Stad, User-agent, Meddelande
        $logData = [
            'time' => date('Y-m-d H:i:s'),
            'ip' => $userIp,
            'country' => $geoInfo['country'] ?? 'Okänt land',
            'region' => $geoInfo['regionName'] ?? 'Okänd region',
            'city' => $geoInfo['city'] ?? 'Okänd stad',
            'user_agent' => $userAgent,
            'message' => $message
        ];

        $logLine = sprintf(
            "[%s] IP: %s | Land: %s | Region: %s | Stad: %s | UA: %s | Meddelande: %s\n",
            $logData['time'],
            $logData['ip'],
            $logData['country'],
            $logData['region'],
            $logData['city'],
            $logData['user_agent'],
            $logData['message']
        );

        file_put_contents(__DIR__ . '/log.txt', $logLine, FILE_APPEND | LOCK_EX);

    } else {
        $status = "Meddelandet får inte vara tomt.";
    }
}
?>
<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skicka Pushnotis</title>
    <style>
        body { font-family: sans-serif; max-width: 400px; margin: 50px auto; }
        label, textarea { display: block; width: 100%; margin-bottom: 10px; }
        textarea { height: 100px; }
        button { padding: 10px 20px; }
        .status { margin-top: 20px; color: green; font-weight: bold; }
        .error { margin-top: 20px; color: red; font-weight: bold; }
    </style>
</head>
<body>
    <h1>Skicka en pushnotis</h1>
    <?php if (!empty($status)) : ?>
        <div class="status"><?= htmlspecialchars($status, ENT_QUOTES, 'UTF-8'); ?></div>
    <?php endif; ?>

    <form action="" method="post">
        <label for="message">Meddelande:</label>
        <textarea name="message" id="message"></textarea>
        <button type="submit">Skicka</button>
    </form>
</body>
</html>
