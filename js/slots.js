let date;
$(function () {
    $("#datepicker").datepicker({
        minDate: new Date(),
        dateFormat: "dd-mm-yy",
        onSelect: function (selectedDate) {
            date = selectedDate;
        }
    });
});

let addslot = document.getElementById("addslot");
addslot.onclick = () => {
    console.log(date);
    let vaccinename = document.getElementById("vaccinename").value.trim();
    if (vaccinename === "" || date === "") {
        Swal.fire(
            'Error',
            'Invalid Field Values',
            'error'
        )
    }
    else {
        let vaccinedetails = {
            vaccinename, date
        }
        $.ajax({
            url: "../backend/addslots.php",
            type: 'POST',
            data: vaccinedetails,
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
        document.getElementById("vaccinename").value = "";
    }
};
