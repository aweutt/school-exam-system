<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== "teacher") {
  header("Location: index.php");
  exit();
}

$username = $_SESSION['username'];

$conn = new mysqli("localhost", "root", "", "labcode");
if ($conn->connect_error) {
  die("فشل الاتصال: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM submissions ORDER BY submitted_at DESC");
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>لوحة الإشراف | المعلم</title>
  <style>
    body {
      font-family: Tahoma, sans-serif;
      background-color: #f4f8fb;
      padding: 20px;
    }

    h2 {
      color: #0b5394;
      text-align: center;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      background: white;
    }

    th, td {
      padding: 10px;
      border: 1px solid #ccc;
      text-align: center;
    }

    th {
      background-color: #007bff;
      color: white;
    }

    tr:hover {
      background-color: #f1f1f1;
    }

    .code-box {
      font-family: monospace;
      background-color: #f9f9f9;
      padding: 10px;
      border-radius: 6px;
      text-align: left;
      white-space: pre-wrap;
      max-height: 200px;
      overflow: auto;
    }
  </style>
  <meta http-equiv="refresh" content="60">
</head>
<body>

  <h2>لوحة إشراف المعلم - التحديث كل دقيقة</h2>

  <table>
    <thead>
      <tr>
        <th>اسم الطالب</th>
        <th>البرنامج</th>
        <th>وقت التسليم</th>
        <th>الإجابة</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= $row['student'] ?></td>
          <td><?= $row['program'] ?></td>
          <td><?= $row['submitted_at'] ?></td>
          <td><div class="code-box"><?= htmlspecialchars($row['code']) ?></div></td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

</body>
</html>
