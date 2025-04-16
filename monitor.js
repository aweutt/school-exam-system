// بيانات الطلاب الوهمية - تقدر تستبدلها بقاعدة بيانات لاحقًا
const students = [
  {
    name: "أحمد علي",
    code: "STU123",
    program: "مقدمة في البرمجة",
    submitTime: "10:45 ص",
    answer: "console.log('Hello')"
  },
  {
    name: "سارة محمد",
    code: "STU456",
    program: "مقدمة في البرمجة",
    submitTime: "",
    answer: ""
  },
  {
    name: "خالد ناصر",
    code: "STU789",
    program: "بايثون",
    submitTime: "11:02 ص",
    answer: "print('مرحبا')"
  }
];

// عرض البيانات في جدول الصفحة
function populateTable() {
  const tableBody = document.querySelector("#students-table tbody");
  tableBody.innerHTML = ""; // تصفير الجدول قبل إعادة تعبئته

  students.forEach(student => {
    const row = document.createElement("tr");

    row.innerHTML = `
      <td>${student.name}</td>
      <td>${student.code}</td>
      <td>${student.program}</td>
      <td>${student.submitTime || "لم يُسلّم"}</td>
      <td><pre style="margin:0;">${student.answer || "لا توجد إجابة"}</pre></td>
    `;

    tableBody.appendChild(row);
  });
}

// تصدير البيانات كـ CSV
function exportToCSV() {
  const rows = students.map(student => [
    student.name,
    student.code,
    student.program,
    student.submitTime || "لم يُسلّم",
    JSON.stringify(student.answer || "")
  ]);

  let csvContent = "اسم الطالب,رمز الطالب,البرنامج,وقت التسليم,الإجابة\n" +
    rows.map(e => e.join(",")).join("\n");

  downloadFile("students_export.csv", csvContent);
}

// تصدير البيانات كـ TXT
function exportToTXT() {
  let txtContent = students.map(student => 
    `الاسم: ${student.name}\nالرمز: ${student.code}\nالبرنامج: ${student.program}\nوقت التسليم: ${student.submitTime || "لم يُسلّم"}\nالإجابة: ${student.answer || "لا توجد"}\n\n`
  ).join("------------\n");

  downloadFile("students_export.txt", txtContent);
}

// تحميل الملف
function downloadFile(filename, content) {
  const blob = new Blob([content], { type: "text/plain;charset=utf-8;" });
  const link = document.createElement("a");
  link.href = URL.createObjectURL(blob);
  link.setAttribute("download", filename);
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
}

// تشغيل عند تحميل الصفحة
window.onload = populateTable;
