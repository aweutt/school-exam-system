<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== "student") {
  header("Location: index.php");
  exit();
}

$username = $_SESSION['username'];
$stage = $_SESSION['stage'];
$grade = $_SESSION['grade'];
$program = $_SESSION['selected_program'] ?? 'HTML'; // يجي من home.php
$examCode = $_SESSION['exam_code'] ?? 'EX001';
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <title>صفحة الاختبار</title>
  <style>
    body { font-family: Tahoma, sans-serif; background: #f0f8ff; padding: 30px; }
    .exam-box {
      background: white;
      padding: 20px;
      max-width: 1000px;
      margin: auto;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .info-bar { display: flex; justify-content: space-between; flex-wrap: wrap; margin-bottom: 20px; }
    .code-editor {
      width: 100%;
      height: 300px;
      border: 1px solid #ccc;
      border-radius: 8px;
      padding: 10px;
      font-family: monospace;
      font-size: 14px;
      direction: ltr;
      margin-bottom: 10px;
    }
    iframe {
      width: 100%;
      height: 200px;
      border: 1px solid #007bff;
      border-radius: 8px;
      margin-bottom: 15px;
      background: white;
    }
    button {
      padding: 10px 20px;
      border: none;
      background-color: #0b5394;
      color: white;
      border-radius: 6px;
      cursor: pointer;
      margin-left: 10px;
    }
    button:hover { background-color: #063971; }
    #timer { font-weight: bold; color: #d62828; }
  </style>
</head>
<body>

  <div class="exam-box">
    <div class="info-bar">
      <div>الطالب: <strong><?= $username ?></strong></div>
      <div>المرحلة: <?= $stage ?> | الصف: <?= $grade ?></div>
      <div>البرنامج: <?= $program ?></div>
      <div>الرمز: <?= $examCode ?></div>
      <div>الوقت المتبقي: <span id="timer">--:--</span></div>
    </div>

    <textarea class="code-editor" id="codeInput" placeholder="ابدأ هنا..."></textarea>
    <iframe id="previewFrame"></iframe>

    <div style="text-align: left;">
      <button onclick="previewCode()">معاينة</button>
      <button onclick="submitExam()">تسليم الاختبار</button>
    </div>
  </div>

  <script>
    const editor = document.getElementById("codeInput");
    const frame = document.getElementById("previewFrame");
    const programType = "<?= strtolower($program) ?>";

    // استرجاع الكود
    const saved = localStorage.getItem("draftCode_<?= $username ?>");
    if (saved) editor.value = saved;

    // حفظ تلقائي
    editor.addEventListener("input", () => {
      localStorage.setItem("draftCode_<?= $username ?>", editor.value);
    });

    // المعاينة
    function previewCode() {
      const code = editor.value;
      frame.srcdoc = code;
    }

    // التحقق من نوع الكود
    function checkCodeType(code) {
      if (programType.includes("html") && code.includes("<script>")) {
        return false;
      }
      if (programType.includes("css") && !code.includes("{")) {
        return false;
      }
      if (programType.includes("js") && !code.includes("function") && !code.includes("console")) {
        return false;
      }
      return true;
    }

    // تسليم
    function submitExam() {
      const code = editor.value;
      if (!checkCodeType(code)) {
        alert("تحقق من نوع الكود المدخل. قد لا يتوافق مع نوع البرنامج.");
        return;
      }

      fetch("submit_exam.php", {
        method: "POST",
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: "username=<?= $username ?>&program=<?= $program ?>&code=" + encodeURIComponent(code)
      })
      .then(response => response.text())
      .then(msg => {
        localStorage.removeItem("draftCode_<?= $username ?>");
        alert(msg);
        location.href = "home.php";
      });
    }

    // مؤقت 20 دقيقة
    let timeLeft = 20 * 60;
    const timerEl = document.getElementById("timer");
    function updateTimer() {
      const min = Math.floor(timeLeft / 60);
      const sec = timeLeft % 60;
      timerEl.textContent = `${min}:${sec < 10 ? '0' : ''}${sec}`;
      if (timeLeft > 0) timeLeft--;
      else submitExam();
    }
    setInterval(updateTimer, 1000);
  </script>

</body>
</html>
