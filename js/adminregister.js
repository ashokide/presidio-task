let adminregister = document.getElementById("adminregister");
adminregister.onclick = () => {
    let phoneno = document.getElementById("phoneno").value.trim();
    let city = document.getElementById("city").value.trim();
    let username = document.getElementById("username").value.trim();
    let password = document.getElementById("password").value.trim();
    let adminid = document.getElementById("adminid").value.trim();
    if (phoneno === "" || city === "" || username === "" || password === "" || adminid === "") {
        Swal.fire(
            'Error',
            'Invalid Field Values',
            'error'
        )
    }
    else {
        let admindetails = {
            phoneno, city, username, password, adminid
        }
        $.ajax({
            url: "../backend/adminregister.php",
            type: 'POST',
            data: admindetails,
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
        document.getElementById("phoneno").value = "";
        document.getElementById("city").value = "";
        document.getElementById("username").value = "";
        document.getElementById("password").value = "";
        document.getElementById("adminid").value = "";
    }
};