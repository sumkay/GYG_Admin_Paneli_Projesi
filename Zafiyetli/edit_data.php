<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "security_db");
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

$id = $_GET['id'];
$query = "SELECT * FROM data WHERE id='$id'";
$result = $conn->query($query);
$data = $result->fetch_assoc();


if (isset($_POST['update'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $title = str_replace("'", "\'", $title);
    $content = str_replace("'", "\'", $content);
    $query = "UPDATE data SET title='$title', content='$content' WHERE id='$id'";
    $conn->query($query);
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
            <input type="text" name="title" value="<?php echo $data['title']; ?>" required>
            <textarea name="content" required><?php echo $data['content']; ?></textarea>
            <button type="submit" name="update">Güncelle</button>
        </form>
    </div>
</body>
</html>
