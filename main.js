// بيانات وهمية
const users = {
  "student1": { password: "1234", role: "student" },
  "teacher1": { password: "abcd", role: "teacher" }
};

// عند إرسال نموذج الدخول
document.getElementById("loginForm").addEventListener("submit", function(e) {
  e.preventDefault();

  const username = document.getElementById("username").value;
  const password = document.getElementById("password").value;
  const role = document.getElementById("role").value;
  const errorEl = document.getElementById("error");

  if (users[username] && users[username].password === password && users[username].role === role) {
    // حفظ البيانات في التخزين المحلي
    localStorage.setItem("username", username);
    localStorage.setItem("role", role);

    // تحويل حسب الدور
    if (role === "student") {
      window.location.href = "student.html";
    } else {
      window.location.href = "teacher.html";
    }
  } else {
    errorEl.textContent = "بيانات الدخول غير صحيحة!";
  }
});
