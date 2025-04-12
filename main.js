function populateGrades() {
  const stage = document.getElementById("stage").value;
  const gradeSelect = document.getElementById("grade");
  gradeSelect.innerHTML = '<option value="">-- اختر الصف --</option>';

  let grades = [];

  if (stage === "ابتدائي") grades = ["أولى", "ثانية", "ثالثة", "رابعة", "خامسة", "سادسة"];
  if (stage === "متوسط") grades = ["أولى", "ثانية", "ثالثة"];
  if (stage === "ثانوي") grades = ["أولى", "ثانية", "ثالثة"];

  grades.forEach(g => {
    const option = document.createElement("option");
    option.value = g;
    option.textContent = `${g} ${stage}`;
    gradeSelect.appendChild(option);
  });
}

function login() {
  const stage = document.getElementById("stage").value;
  const grade = document.getElementById("grade").value;
  const role = document.getElementById("role").value;
  const username = document.getElementById("username").value;

  if (!stage || !grade || !username) {
    alert("يرجى تعبئة جميع الحقول");
    return;
  }

  // حفظ معلومات المستخدم مؤقتاً
  localStorage.setItem("userStage", stage);
  localStorage.setItem("userGrade", grade);
  localStorage.setItem("userRole", role);
  localStorage.setItem("username", username);

  // التوجيه حسب الدور
  if (role === "معلم") {
    window.location.href = "teacher.html";
  } else {
    window.location.href = "student.html";
  }
}
