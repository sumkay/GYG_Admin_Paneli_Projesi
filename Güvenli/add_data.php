<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
if ($_SESSION['role'] !== 'admin') {
    die("Erişim reddedildi.");
}

$conn = new mysqli("localhost", "root", "", "security_db");
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

if (isset($_POST['add'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];

    
    $stmt = $conn->prepare("INSERT INTO data (title, content) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $content);
    $stmt->execute();
    $stmt->close();

    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Veri Ekle</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
        form {
            margin-top: 20px;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
        }
        button {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
        }
        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Veri Ekle</h2>

        <form action="" method="post">
            <input type="text" name="title" placeholder="Başlık" required>
            <textarea name="content" placeholder="İçerik" required></textarea>
            <button type="submit" name="add">Ekle</button>
        </form>
    </div>
</body>
</html>
