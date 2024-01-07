$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});
var audio = new Audio("http://127.0.0.1:8000/message-alert-tune.mp3");

$(document).ready(function () {
    $(".single-user").on("click", function () {
        receiver_id = $(this).data("id");
        loadOldChats(receiver_id);
    });

    $("#send-message-form").on("submit", function (e) {
        e.preventDefault();
        var message = $("#chat-input").val();
        $.ajax({
            type: "POST",
            url: "/save-chat",
            data: {
                sender_id,
                receiver_id,
                message,
            },
            success: function (response) {
                // console.log(response);
                if (response.success) {
                    var message = response.data.message;
                    var html = `<div class="current-user-message">
                    <div class="current-user-info-box">
                        <div class="content">
                            <p class="message-content" >${message}</p>
                            <p class="message-date">${response.data.created_at}</p>
                        </div>
                        <div class="img">
                            <img width="50"
                        src="http://127.0.0.1:8000/dummy-user.png" alt="User Image">
                        </div>
                    </div>

                </div>`;

                    $("#chat-messages").append(html);
                }
            },
        });
    });
});

Echo.join("status-update")
    .here((users) => {
        for (let x = 0; x < users.length; x++) {
            $("#user-" + users[x]["id"] + "-status").removeClass(
                "offline-status"
            );
            $("#user-" + users[x]["id"] + "-status").addClass("online-status");
            $("#user-" + users[x]["id"] + "-status").text("Online");
        }
    })
    .joining((user) => {
        $("#user-" + user.id + "-status").removeClass("offline-status");
        $("#user-" + user.id + "-status").addClass("online-status");
        $("#user-" + user.id + "-status").text("Online");
    })
    .leaving((user) => {
        $("#user-" + user.id + "-status").addClass("offline-status");
        $("#user-" + user.id + "-status").removeClass("online-status");
        $("#user-" + user.id + "-status").text("Offline");
    })
    .listen("UserStatusEvent", (e) => {
        console.log("hhh" + e);
    });

Echo.private("get-message").listen(".getMessage", (data) => {
    if (
        data.messageData.receiver_id == sender_id
    ) {
        var html = `<div class="recepient-user-message">
        <div class="current-user-info-box">
            <div class="img">
                <img width="50"
            src="http://127.0.0.1:8000/dummy-user.png" alt="User Image">
            </div>
            <div class="content">
                <p class="message-content" >${data.messageData.message}</p>
                <p class="">${data.messageData.created_at}</p>
            </div>

        </div>
    </div>`;
        $("#chat-messages").append(html);
        toastr.success("New Message Notification");
        audio.play();
    }
});

function loadOldChats(receiver_id) {
    $.ajax({
        type: "POST",
        url: "/load-receiver-old-chats",
        data: {
            receiver_id,
        },
        success: function (response) {
            // $("#chat-messages").html('');
            $("#chat-messages").html("");
            $("#chat-with-user-area").show();
            $("#chat-messages").append(response.data);
        },
    });
}
