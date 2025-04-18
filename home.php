<?php
session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
  header("Location: index.php");
  exit();
}

$username = $_SESSION['username'];
$role = $_SESSION['role'];
$stage = $_SESSION['stage'];
$grade = $_SESSION['grade'];

// البرامج حسب المرحلة والصف
$programs = [];

if ($stage === "ابتدائي" && in_array($grade, ["رابع", "خامس", "سادس"])) {
  $programs = ["سكراتش", "تينكر كارد", "إكسل", "فايل ميكر", "مختبر", "كودو"];
} elseif ($stage === "متوسط") {
  $programs = ["وورد", "إكسل", "بوربوينت", "VEXcode VR", "Shotcut"];
} elseif ($stage === "ثانوي") {
  $programs = ["Visual Studio Code", "Gantt Project", "MIT App Inventor", "GIMP", "Pencil2D", "Scribus", "Cisco", "Micro:bit", "Inkscape"];
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>الرئيسية | <?= $username ?></title>
  <style>
    body {
      font-family: 'Tahoma', sans-serif;
      background-color: #eef4fc;
      padding: 30px;
      direction: rtl;
    }

    .container {
      background-color: white;
      max-width: 700px;
      margin: auto;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .logo-text {
      text-align: center;
      font-size: 24px;
      font-weight: bold;
      color: #0b5394;
      margin-bottom: 20px;
    }

    .info {
      text-align: center;
      margin-bottom: 20px;
    }

    .programs {
      margin-top: 30px;
    }

    .programs h3 {
      margin-bottom: 10px;
      color: #0b5394;
    }

    .program-list {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
    }

    .program-list button {
      padding: 10px 15px;
      border: none;
      background-color: #0b5394;
      color: white;
      border-radius: 6px;
      cursor: pointer;
    }

    .program-list button:hover {
      background-color: #063971;
    }

    .action {
      text-align: center;
      margin-top: 30px;
    }

    .action a {
      text-decoration: none;
      background-color: #0b5394;
      color: white;
      padding: 10px 20px;
      border-radius: 6px;
    }

    .action a:hover {
      background-color: #063971;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="logo-text">LabCode | لاب كود</div>

    <div class="info">
      <p>مرحبا <strong><?= $username ?></strong></p>
      <p>المرحلة: <?= $stage ?> | الصف: <?= $grade ?></p>
    </div>

    <div class="programs">
      <h3>البرامج المتاحة لك:</h3>
      <div class="program-list">
        <?php foreach ($programs as $p): ?>
          <button onclick="selectProgram('<?= $p ?>')"><?= $p ?></button>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="action" id="nextAction" style="display: none;">
      <a id="nextLink" href="#">الانتقال</a>
    </div>
  </div>

  <script>
    function selectProgram(program) {
      localStorage.setItem("selectedProgram", program);
      const role = "<?= $role ?>";
      const next = document.getElementById("nextLink");

      if (role === "student") {
        next.href = "exam.php";
        next.textContent = "ابدأ الاختبار";
      } else {
        next.href = "teacher.php";
        next.textContent = "اذهب للوحة المعلم";
      }

      document.getElementById("nextAction").style.display = "block";
    }
  </script>
</body>
</html>
