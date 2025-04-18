<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $student = $_POST['username'];
  $program = $_POST['program'];
  $code = $_POST['code'];

  // الاتصال بقاعدة البيانات
  $conn = new mysqli("localhost", "root", "", "labcode");
  if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
  }

  $stmt = $conn->prepare("INSERT INTO submissions (student, program, code, submitted_at) VALUES (?, ?, ?, NOW())");
  $stmt->bind_param("sss", $student, $program, $code);

  if ($stmt->execute()) {
    echo "تم تسليم الإجابة بنجاح!";
  } else {
    echo "حدث خطأ أثناء التسليم.";
  }

  $stmt->close();
  $conn->close();
}
?>
