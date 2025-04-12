<?php
// بيانات المستخدمين الوهمية (يمكنك ربطها بقاعدة بيانات حقيقية)
$validUsers = [
    "student1" => ["password" => "studentpass", "role" => "student"],
    "teacher1" => ["password" => "teacherpass", "role" => "teacher"]
];

// استلام البيانات من AJAX
$username = $_POST['username'];
$password = $_POST['password'];
$role = $_POST['role'];

// التحقق من صحة بيانات المستخدم
if (isset($validUsers[$username]) && $validUsers[$username]['password'] === $password && $validUsers[$username]['role'] === $role) {
    // تسجيل الدخول بنجاح
    echo json_encode(["success" => true]);
} else {
    // بيانات غير صحيحة
    echo json_encode(["success" => false, "message" => "البيانات المدخلة غير صحيحة."]);
}
?>
