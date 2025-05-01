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

$id = $_GET['id'] ?? 0;


$stmt = $conn->prepare("SELECT * FROM data WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();
$stmt->close();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $stmt = $conn->prepare("UPDATE data SET title = ?, content = ? WHERE id = ?");
    $stmt->bind_param("ssi", $title, $content, $id);
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
    <title>Veri Güncelle</title>
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
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Veri Güncelle</h2>

        <form action="" method="post">
            <input type="text" name="title" value="<?php echo htmlspecialchars($data['title'], ENT_QUOTES, 'UTF-8'); ?>" required>
            <textarea name="content" required><?php echo htmlspecialchars($data['content'], ENT_QUOTES, 'UTF-8'); ?></textarea>
            <button type="submit" name="update">Güncelle</button>
        </form>
    </div>
</body>
</html>
