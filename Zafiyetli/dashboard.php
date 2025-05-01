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

$searchTerm = $_GET['search'] ?? '';

$query = "SELECT * FROM data WHERE title LIKE '%$searchTerm%'";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }
        .search-box {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        button {
            padding: 5px 10px;
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #c82333;
        }
        .actions {
            display: flex;
            gap: 10px;
        }
        .actions a {
            text-decoration: none;
            padding: 5px 10px;
            background-color: #007bff;
            color: white;
            border-radius: 4px;
        }
        .actions a:hover {
            background-color: #0056b3;
        }
        .logout-button {
            text-decoration: none;
            padding: 5px 10px;
            background-color: #dc3545;
            color: white;
            border-radius: 4px;
        }
        .logout-button:hover {
            background-color: #c82333;
        }
    </style>
    <script>
        function deleteData(id) {
            if (confirm("Bu veriyi silmek istediğinizden emin misiniz?")) {
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "delete.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        alert("Veri başarıyla silindi!");
                        location.reload();
                    }
                };
                xhr.send("id=" + id);
            }
        }

        function searchTable() {
            const input = document.getElementById("searchInput");
            const filter = input.value.toLowerCase();
            const table = document.getElementById("dataTable");
            const tr = table.getElementsByTagName("tr");

            for (let i = 1; i < tr.length; i++) {
                const td = tr[i].getElementsByTagName("td");
                let found = false;
                for (let j = 0; j < td.length; j++) {
                    if (td[j]) {
                        const txtValue = td[j].textContent || td[j].innerText;
                        if (txtValue.toLowerCase().indexOf(filter) > -1) {
                            found = true;
                            break;
                        }
                    }
                }
                tr[i].style.display = found ? "" : "none";
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Veri Listesi</h2>
            <div>
                
                    <a href="add_data.php" class="add-button">Veri Ekle</a>
                
                <a href="logout.php" class="logout-button">Çıkış Yap</a>
            </div>
        </div>

        <div class="search-box">
            <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Arama yap...">
        </div>

        <table id="dataTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Başlık</th>
                    <th>İçerik</th>
                    <th>Oluşturulma Tarihi</th>
                    
                        <th>İşlemler</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo $row['content']; ?></td>
                        <td><?php echo $row['created_at']; ?></td>
                        
                            <td class="actions">
                                <a href="edit_data.php?id=<?php echo $row['id']; ?>">Güncelle</a>
                                <button onclick="deleteData(<?php echo $row['id']; ?>)">Sil</button>
                            </td>
                        
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>

