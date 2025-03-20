// teacher.js
function loginTeacher() {
  const name = document.getElementById('teacherName').value;
  if (name.trim() !== '') {
    document.getElementById('teacherPanel').style.display = 'block';
  }
}

function addExam() {
  const name = document.getElementById('examName').value;
  const code = document.getElementById('examCode').value;
  const duration = document.getElementById('examDuration').value;

  if (name && code && duration) {
    const li = document.createElement('li');
    li.textContent = `الاختبار: ${name} - الكود: ${code} - المدة: ${duration} دقيقة`;
    document.getElementById('examList').appendChild(li);

    // تفريغ الحقول
    document.getElementById('examName').value = '';
    document.getElementById('examCode').value = '';
    document.getElementById('examDuration').value = '';
  }
}
