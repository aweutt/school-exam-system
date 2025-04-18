<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <title>تسجيل الدخول</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #e6f0ff;
      direction: rtl;
      padding: 40px;
    }

    .login-box {
      background: #fff;
      max-width: 500px;
      margin: auto;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      color: #0b5394;
    }

    label {
      display: block;
      margin-top: 15px;
      font-weight: bold;
    }

    select, input[type="email"], button {
      width: 100%;
      padding: 10px;
      margin-top: 8px;
      border-radius: 6px;
      border: 1px solid #ccc;
    }

    button {
      background-color: #0b5394;
      color: white;
      margin-top: 20px;
      cursor: pointer;
    }

    button:hover {
      background-color: #063971;
    }

    .logo {
      display: block;
      margin: 0 auto 20px auto;
      max-width: 100px;
    }
  </style>
</head>
<body>

  <div class="login-box">
    <img src="logo.png" class="logo" alt="شعار وزارة التعليم">
    <h2>تسجيل الدخول</h2>

    <form id="loginForm" action="login.php" method="POST" onsubmit="return validateForm();">
      <label>المرحلة الدراسية:</label>
      <select name="stage" id="stage" onchange="loadGrades()">
        <option value="">اختر المرحلة</option>
        <option value="ابتدائي">ابتدائي</option>
        <option value="متوسط">متوسط</option>
        <option value="ثانوي">ثانوي</option>
      </select>

      <label>الصف الدراسي:</label>
      <select name="grade" id="grade">
        <option value="">اختر الصف</option>
      </select>

      <label>الدور:</label>
      <select name="role" required>
        <option value="">اختر</option>
        <option value="student">طالب</option>
        <option value="teacher">معلم</option>
      </select>

      <label>بريد مدرستي:</label>
      <input type="email" name="email" id="email" placeholder="مثال: s123@mkhg.moe.gov.sa" required>

      <button type="submit">دخول</button>
    </form>
  </div>

  <script>
    function loadGrades() {
      const stage = document.getElementById("stage").value;
      const grade = document.getElementById("grade");
      grade.innerHTML = "";

      let options = [];
      if (stage === "ابتدائي") {
        options = ["رابع", "خامس", "سادس"];
      } else if (stage === "متوسط") {
        options = ["أول متوسط", "ثاني متوسط", "ثالث متوسط"];
      } else if (stage === "ثانوي") {
        options = ["أول ثانوي", "ثاني ثانوي", "ثالث ثانوي"];
      }

      options.forEach(g => {
        const opt = document.createElement("option");
        opt.value = g;
        opt.textContent = g;
        grade.appendChild(opt);
      });
    }

    function validateForm() {
      const email = document.getElementById("email").value;
      const pattern = /^[st]\w+@mkhg\.moe\.gov\.sa$/;

      if (!pattern.test(email)) {
        alert("يجب استخدام بريد مدرستي الصحيح!");
        return false;
      }
      return true;
    }
  </script>

</body>
</html>
