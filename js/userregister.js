let registerBtn = document.getElementById("registerbtn");
registerBtn.onclick = () => {
    let username = document.getElementById("username").value.trim();
    let password = document.getElementById("password").value.trim();
    let city = document.getElementById("city").value.trim();
    let phoneno = document.getElementById("phoneno").value.trim();
    if (username != "" || password != "" || city != "" || phoneno != "") {
        $.ajax({
            url: "../backend/userregister.php",
            type: 'POST',
            data: {
                username,
                password,
                city,
                phoneno
            },
            success: function (data) {
                if (data['status'] == 1) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: data['msg'],
                        didClose: () => {
                            location.href = "./user.html";
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
                    "Something Went Wrong",
                    'error'
                );
            },
            dataType: "json"
        }
        );
        document.getElementById("username").value = "";
        document.getElementById("password").value = "";
        document.getElementById("city").value = "";
        document.getElementById("phoneno").value = "";
    }
    else {
        Swal.fire(
            'Warning',
            'Both Input Fields Are Required',
            'warning'
        );
    }
}