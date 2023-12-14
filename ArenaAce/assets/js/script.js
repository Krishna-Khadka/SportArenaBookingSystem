

// Get references to the button and container
const chatbotButton = document.getElementById("chatbot-button");
const chatbotContainer = document.getElementById("chatbot-container");

// Function to toggle the chatbot container visibility
function toggleChatbot() {
    chatbotContainer.style.display = chatbotContainer.style.display === "none" ? "block" : "none";
}

// Attach a click event listener to the chatbot button
chatbotButton.addEventListener("click", toggleChatbot);


// **********************  chat bot box ajax  ***********************
$(document).ready(function () {
    $("#send-btn").on("click", function () {
        $value = $("#data").val();
        $msg = '<div class="user-inbox inbox"><div class="msg-header"><p style="color:white;background-color:black;">' + $value + '</p></div></div>';
        $(".form").append($msg);
        $("#data").val('');

        // start ajax code
        $.ajax({
            url: 'message.php',
            type: 'POST',
            data: 'text=' + $value,
            success: function (result) {
                $replay = '<div class="bot-inbox inbox"><div class="icon"><i class="fas fa-robot"></i></div><div class="msg-header"><p>' + result + '</p></div></div>';
                $(".form").append($replay);
                // when chat goes down the scroll bar automatically comes to the bottom
                $(".form").scrollTop($(".form")[0].scrollHeight);
            }
        });
    });
});



