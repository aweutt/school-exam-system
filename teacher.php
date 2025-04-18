<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== "teacher") {
  header("Location: index.php");
  exit();
}

$username = $_SESSION['username'];
$stage = $_SESSION['stage'];
$grade = $_SESSION['grade'];

// الاتصال بقاعدة البيانات
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
  <title>لوحة المعلم</title>
  <style>
    body {
      font-family: Tahoma, sans-serif;
      background-color: #f5faff;
      padding: 30px;
    }

    .header {
      text-align: center;
      margin-bottom: 20px;
    }

    .header h2 {
      color: #0b5394;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      background: white;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 10px;
      text-align: center;
    }

    th {
      background-color: #0b5394;
      color: white;
    }

    .code-box {
      font-family: monospace;
      background: #f0f0f0;
      text-align: left;
      padding: 10px;
      border-radius: 6px;
      max-height: 200px;
      overflow: auto;
    }
  </style>
</head>
<body>

  <div class="header">
    <h2>أهلاً أ. <?= $username ?></h2>
    <p>المرحلة: <?= $stage ?> - الصف: <?= $grade ?></p>
  </div>

  <h3>الاختبارات المستلمة من الطلاب:</h3>

  <table>
    <thead>
      <tr>
        <th>الطالب</th>
        <th>البرنامج</th>
        <th>الوقت</th>
        <th>كود الطالب</th>
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
