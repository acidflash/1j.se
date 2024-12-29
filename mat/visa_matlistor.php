<?php
require_once("config.php");

$result = $mysqli->query("SELECT * FROM matlistor");
?>

<html>
<head>
    <title>Visa Matlistor</title>
</head>
<body>
    <h1>Tidigare matlistor</h1>
    <ul>
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<li>Vecka " . $row["vecka"] . ": " . $row["matratter"] . "</li>";
        }
        ?>
    </ul>
</body>
</html>
