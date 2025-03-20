function login() {
  const name = document.getElementById('student-name').value;
  const id = document.getElementById('student-id').value;

  if (name && id) {
    document.getElementById('login-section').style.display = 'none';
    document.getElementById('code-section').style.display = 'block';
  } else {
    alert("يرجى إدخال الاسم ورقم الطالب");
  }
}

function startExam() {
  const code = document.getElementById('exam-code').value;
  if (code === "1234") { // كود تجريبي للاختبار
    document.getElementById('code-section').style.display = 'none';
    document.getElementById('exam-section').style.display = 'block';
    startCountdown(5 * 60); // 5 دقائق
  } else {
    alert("كود غير صحيح!");
  }
}

function startCountdown(duration) {
  let timer = duration, minutes, seconds;
  const countdownEl = document.getElementById('countdown');

  const interval = setInterval(() => {
    minutes = Math.floor(timer / 60);
    seconds = timer % 60;

    countdownEl.textContent = `${minutes}:${seconds < 10 ? '0' + seconds : seconds}`;

    if (--timer < 0) {
      clearInterval(interval);
      alert("انتهى الوقت!");
      submitAnswer();
    }
  }, 1000);
}

function submitAnswer() {
  const answer = document.getElementById('answer').value;
  alert("تم إرسال إجابتك:\n" + answer);
  // هنا مستقبلاً نرسل الإجابة للسيرفر أو نسوي حفظ محلي
}
