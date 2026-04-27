<?php
header("Content-Type: text/plain; charset=utf-8");

include_once __DIR__ . "/service/PositionService.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo "Méthode non autorisée";
    exit;
}

if (
    empty($_POST["latitude"]) ||
    empty($_POST["longitude"]) ||
    empty($_POST["date_position"]) ||
    empty($_POST["imei"])
) {
    echo "Paramètres manquants\n\n";
    echo "POST reçu :\n";
    print_r($_POST);
    exit;
}

$latitude = $_POST["latitude"];
$longitude = $_POST["longitude"];
$datePosition = $_POST["date_position"];
$imei = $_POST["imei"];

$service = new PositionService();
$position = new Position(null, $latitude, $longitude, $datePosition, $imei);

if ($service->create($position)) {
    echo "Position enregistrée avec succès";
} else {
    echo "Erreur insertion";
}
?>