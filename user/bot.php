<div class="chatbot-container">
    <div class="chatbot-wrapper">
        <div class="chatbot-title">Simple Online Chatbot</div>
        <div class="chatbot-form">
            <div class="chatbot-inbox">
                <div class="chatbot-icon">
                    <i class="fas fa-user"></i>
                </div>
                <div class="chatbot-msg-header">
                    <p>Hello there, how can I help you?</p>
                </div>
            </div>
        </div>
        <div class="chatbot-typing-field">
            <div class="chatbot-input-data">
                <input id="chatbot-data" type="text" placeholder="Type something here.." required>
                <button id="chatbot-send-btn">Send</button>
            </div>
        </div>
    </div>
</div>

<style>

		*{
			font-family: 'Open Sans', sans-serif;
		}
	
    .chatbot-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh; 
        width: 100%;
    }
    .chatbot-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh; /* Căn giữa theo chiều cao của viewport */
    width: 100%;
    position: fixed; /* Giữ chatbot cố định trên màn hình */
    bottom: 0; /* Đặt chatbot ở phía dưới màn hình */
    right: 20px; /* Điều chỉnh vị trí nếu muốn */
    z-index: 1000; /* Đảm bảo hiển thị trên cùng */
}

/* Thiết kế khung chatbot */
.chatbot-wrapper {
    width: 370px;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    border: 1px solid #ddd;
    overflow: hidden;
}

/* Tiêu đề chatbot */
.chatbot-title {
    background: #007bff;
    color: #fff;
    font-size: 18px;
    font-weight: bold;
    text-align: center;
    padding: 15px;
    border-radius: 10px 10px 0 0;
}

/* Khu vực chat */
.chatbot-form {
    padding: 15px;
    max-height: 400px;
    overflow-y: auto;
    background: #f9f9f9;
}

/* Tin nhắn */
.chatbot-inbox {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

.chatbot-icon {
    width: 40px;
    height: 40px;
    background: #007bff;
    color: white;
    text-align: center;
    line-height: 40px;
    border-radius: 50%;
    font-size: 16px;
    margin-right: 10px;
}

.chatbot-msg-header p {
    background: #007bff;
    color: #fff;
    padding: 8px 12px;
    border-radius: 10px;
    max-width: 70%;
    word-break: break-word;
}

.chatbot-user-inbox {
    justify-content: flex-end;
}

.chatbot-user-inbox .chatbot-msg-header p {
    background: #efefef;
    color: #333;
}

/* Ô nhập tin nhắn */
.chatbot-typing-field {
    display: flex;
    align-items: center;
    padding: 10px;
    background: #efefef;
    border-top: 1px solid #d9d9d9;
    border-radius: 0 0 10px 10px;
}

.chatbot-input-data {
    flex-grow: 1;
    position: relative;
}

.chatbot-input-data input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    outline: none;
}

.chatbot-input-data button {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    background: #007bff;
    color: #fff;
    border: none;
    padding: 8px 15px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
}

.chatbot-input-data button:hover {
    background: #0056b3;
}

</style>
