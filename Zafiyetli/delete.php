<?php
session_start();
if (!isset($_SESSION['username'])) {
    exit("Erişim reddedildi.");
}

$conn = new mysqli("localhost", "root", "", "security_db");
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $query = "DELETE FROM data WHERE id='$id'";
    $conn->query($query);
    echo "Veri silindi.";
}
?>
