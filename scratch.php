<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== "student") {
  header("Location: index.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>برنامج سكراتش</title>
  <style>
    body {
      font-family: Tahoma, sans-serif;
      background-color: #f9faff;
      padding: 30px;
    }

    h2 {
      color: #0b5394;
      text-align: center;
    }

    .container {
      max-width: 1000px;
      margin: auto;
      background: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    iframe {
      width: 100%;
      height: 500px;
      border: none;
      border-radius: 8px;
      margin-bottom: 20px;
    }

    .commands {
      background-color: #f0f8ff;
      padding: 15px;
      border-radius: 10px;
    }

    .commands h3 {
      color: #0b5394;
    }

    .command {
      margin-bottom: 10px;
    }

    .command code {
      background-color: #eef;
      padding: 3px 6px;
      border-radius: 5px;
    }

  </style>
</head>
<body>
  <div class="container">
    <h2>تجربة برنامج سكراتش</h2>

    <!-- محاكاة البرنامج الفعلي -->
    <iframe src="https://scratch.mit.edu/projects/editor/" title="سكراتش"></iframe>

    <!-- أوامر جاهزة مع شرح -->
    <div class="commands">
      <h3>أوامر مفيدة في سكراتش:</h3>

      <div class="command">
        <strong>تحريك الكائن:</strong>
        <code>تحرك 10 خطوة</code> - يجعل الكائن يتحرك 10 خطوات في الاتجاه الحالي.
      </div>

      <div class="command">
        <strong>تكرار:</strong>
        <code>كرر 10 مرات</code> - ينفذ كتلة معينة 10 مرات.
      </div>

      <div class="command">
        <strong>عند النقر على العلم:</strong>
        <code>عند النقر على علم البداية</code> - يبدأ تنفيذ الكود عند بدء التشغيل.
      </div>
    </div>
  </div>
</body>
</html>
