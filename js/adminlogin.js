let loginbtn = document.getElementById("login");
loginbtn.onclick = () => {
    let username = document.getElementById("username").value.trim();
    let password = document.getElementById("password").value.trim();
    if (username != "" || password != "") {
        $.ajax({
            url: "../backend/adminlogin.php",
            type: 'POST',
            data: {
                username,
                password
            },
            success: function (data) {
                if (data['status'] == 1) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: data['msg'],
                        didClose: () => {
                            location.href = "./admin.html";
                        }
                    });
                }
                else {
                    Swal.fire(
                        'Failure',
                        data['msg'],
                        'error'
                    );
                }
            },
            error: function () {
                Swal.fire(
                    'Error',
                    "Something Went Wrong, Try Again",
                    'error'
                );
            },
            dataType: "json"
        }
        );
        document.getElementById("username").value = "";
        document.getElementById("password").value = "";
    }
    else {
        Swal.fire(
            'Warning',
            'Both Input Fields Are Required',
            'warning'
        );
    }
}