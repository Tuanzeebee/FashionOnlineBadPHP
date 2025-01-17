const form = document.querySelector('.login form');
const submitBtn = document.querySelector('.button input');
const errorText = document.querySelector('.error-text');

form.onsubmit = (e) => {
	e.preventDefault();
}

function validateField(input) {
	if (!input.value.trim()) {
		input.classList.add('input-error');
		return false;
	} else {
		input.classList.remove('input-error');
		return true;
	}
}

submitBtn.onclick = () => {
	const emailField = form.querySelector("input[name='email']");
	const passwordField = form.querySelector("input[name='password']");
	const turnstileResponse = document.querySelector('.cf-turnstile input[name="cf-turnstile-response"]')?.value;

	let isEmailValid = validateField(emailField);
	let isPasswordValid = validateField(passwordField);

	if (!isEmailValid || !isPasswordValid) {
		errorText.style.display = "block";
		errorText.textContent = "Vui lòng điền đầy đủ thông tin.";
		return;
	}
	// Kiểm tra CAPTCHA
	if (!turnstileResponse) {
		errorText.style.display = "block";
		errorText.textContent = "Vui lòng tích CAPTCHA trước khi đăng nhập.";
		return;
	}

	// Gửi yêu cầu AJAX nếu không có lỗi
	let xhr = new XMLHttpRequest();
	xhr.open("POST", "api/login.php", true);
	xhr.onload = () => {
		if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
			let data = xhr.response;
			if (data === "success") {
				location.href = "index.php";
			} else {
				errorText.style.display = "block";
				errorText.textContent = data;
			}
		}
	};

	let formData = new FormData(form);
	formData.append("cf_turnstile", turnstileResponse);
	xhr.send(formData);
};

