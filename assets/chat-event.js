const form = document.querySelector('.typing-area');
const inputField = form.querySelector('.input-field');
const sendBtn = form.querySelector('button');
const chatBox = document.querySelector('.chat-box');
const fileInput = form.querySelector('.file-input');
const incoming_id = form.querySelector('.incoming_id').value;

// Ngừng gửi form nếu chưa nhập tin nhắn
form.onsubmit = (e) => {
    e.preventDefault();
}

inputField.focus();
inputField.onkeyup = () => {
    // Kiểm tra nếu có tin nhắn hoặc file, kích hoạt nút gửi
    if (inputField.value !== "" || fileInput.files.length > 0) {
        sendBtn.classList.add("active");
    } else {
        sendBtn.classList.remove("active");
    }
}

sendBtn.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", 'api/insert-chat.php', true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            inputField.value = "";  // Reset input field
            fileInput.value = "";   // Reset file input sau khi gửi
            scrollToBottom();       // Cuộn xuống cuối để xem tin nhắn mới

            // Đợi một chút trước khi tải lại chat
            setTimeout(() => {
                loadChat();
            }, 500);
        }
    }

    // Tạo đối tượng FormData để gửi cả tin nhắn và file
    let formData = new FormData(form);
    xhr.send(formData);
}

function loadChat() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", 'api/get-chat.php', true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            chatBox.innerHTML = xhr.response;
            if (!chatBox.classList.contains('active')) {
                scrollToBottom();  // Cuộn xuống nếu không đang ở chế độ active
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send('incoming_id=' + incoming_id);
}

// Tải lại chat mỗi 500ms
setInterval(loadChat, 500);

// Đảm bảo chatBox luôn cuộn xuống cuối khi người dùng không di chuột vào
chatBox.onmouseenter = () => {
    chatBox.classList.add('active');
}

chatBox.onmouseleave = () => {
    chatBox.classList.remove('active');
}

function scrollToBottom() {
    chatBox.scrollTop = chatBox.scrollHeight;
}
