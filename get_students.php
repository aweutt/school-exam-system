<?php
header('Content-Type: application/json');

// بيانات وهمية للطلاب
$studentsData = [
    ["id" => "s1", "name" => "طالب 1", "teacher" => "teacher1", "status" => "في الاختبار"],
    ["id" => "s2", "name" => "طالب 2", "teacher" => "teacher1", "status" => "في الانتظار"],
    ["id" => "s3", "name" => "طالب 3", "teacher" => "teacher2", "status" => "منسحب"]
];

// اسم المعلم المستلم من الواجهة
$teacherUsername = $_GET['teacher'];

// تصفية الطلاب حسب المعلم
$filtered = array_filter($studentsData, function($student) use ($teacherUsername) {
    return $student['teacher'] === $teacherUsername;
});

// إعادة البيانات بشكل JSON
echo json_encode(array_values($filtered));

