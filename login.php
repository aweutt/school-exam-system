<?php
session_start();

// تحقق من البيانات
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $email = $_POST['email'];
  $role = $_POST['role'];
  $stage = $_POST['stage'];
  $grade = $_POST['grade'];

  // تحقق من صيغة البريد
  if (!preg_match('/^[st]\w+@mkhg\.moe\.gov\.sa$/', $email)) {
    echo "<script>alert('البريد غير صحيح! يجب أن يكون من نطاق مدرستي.'); window.history.back();</script>";
    exit();
  }

  // استخراج اسم المستخدم من البريد
  $username = explode("@", $email)[0];

  // حفظ البيانات في session
  $_SESSION['username'] = $username;
  $_SESSION['email'] = $email;
  $_SESSION['role'] = $role;
  $_SESSION['stage'] = $stage;
  $_SESSION['grade'] = $grade;

  // التوجيه إلى الصفحة الرئيسية
  header("Location: home.php");
  exit();
} else {
  header("Location: index.php");
  exit();
}
