<?php
session_start();
if (!isset($_SESSION['username'])) {
    die("Erişim reddedildi.");
}
if ($_SESSION['role'] !== 'admin') {
    die("Erişim reddedildi.");
}

$conn = new mysqli("localhost", "root", "", "security_db");
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    
    $stmt = $conn->prepare("DELETE FROM data WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    echo "Veri silindi.";
}
?>