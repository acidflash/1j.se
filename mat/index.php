<?php
require_once("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $veckor = $_POST["veckor"];
    $har_barn = isset($_POST["har_barn"]) ? 1 : 0;

    for ($i = 0; $i < $veckor; $i++) {
        $vecka = date('W') + $i;
        $matratter = "Dina maträtter för vecka $vecka";

        $stmt = $mysqli->prepare("INSERT INTO matlistor (vecka, matratter, har_barn) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $vecka, $matratter, $har_barn);
        $stmt->execute();
    }
}
?>

<html>
<head>
    <title>Matlistor</title>
</head>
<body>
    <h1>Skapa matlistor</h1>
    <form method="post" action="">
        <label for="har_barn">Har du barn denna vecka?</label>
        <input type="checkbox" name="har_barn" id="har_barn">
        <br>
        <label for="veckor">Antal veckor framåt:</label>
        <select name="veckor" id="veckor">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
        </select>
        <br>
        <input type="submit" value="Generera matlistor">
    </form>
</body>
</html>
