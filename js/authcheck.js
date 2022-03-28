$(window).ready(function () {
    console.log("readyyyyyy");
    //Check User Session Status
    $.ajax({
        url: "/covid/backend/sessioncheck.php",
        type: 'POST',
        success: function (data) {
            if (data['status'] == 1) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: "User Logged In Successfully",
                    didClose: () => {
                        location.href = '/covid/pages/user.html';
                    }
                });
            }
            else if(data['status'] == 2) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: "Admin Logged In Successfully",
                    didClose: () => {
                        location.href = '/covid/pages/admin.html';
                    }
                });
            }
        },
        error: function () {
            console.log("Error in Server Request");
        },
        dataType: "json"
    }
    );
});