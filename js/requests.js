let requests = [];
let requestsArea = document.getElementById("requests");
function setRequests() {
    if (requests.length) {
        requests.forEach((request) => {
            requestsArea.innerHTML +=
                `
                <div class="card my-2" style="width: 18rem;">
                    <div class="card-header bg-danger text-white">
                        User Name : <strong>${request['username']}</strong>
                        <button class="btn btn-primary m-1" onclick='showdetails("${request['username']}","${request['phoneno']}","${request['city']}","${request['vaccinename']}","${request['slotdate']}")'>View Details</button>
                    </div>
                    <div class="card-body">
                        Vaccine Name : <p class="card-text">${request['vaccinename']}</p>
                        Date For Vaccine : <h5 class="card-text">${request['slotdate']}</h5>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-outline-warning" onclick='accept("${request['username']}","${request['slotdate']}")'>Accept</button>
                    </div>
                </div>
        `;
        })
    }
    else {
        requestsArea.innerHTML = "<h4>No requests for slots</h4>";
    }
}
$(document).ready(function () {
    $.ajax({
        url: "../backend/requests.php",
        success: function (data) {
            if(data['status'] === 1 ){
                requests = data['data'];
                setRequests();
                Swal.fire(
                    'Success',
                    "Slots Fetched Successfully",
                    'success'
                );
            }
            else{
                requests = [];
                setRequests();
                Swal.fire(
                    'Success',
                    data['data'],
                    'success'
                );
            }

        },
        error: function () {
            setRequests();
            Swal.fire(
                'Error',
                "Error in Fetching Slots",
                'error'
            );
        },
        dataType: "json"
    }
    );
});

function accept(username, slotdate) {
    $.ajax({
        url: "../backend/accept.php",
        type: 'POST',
        data: {
            username,
            slotdate
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
}

function showdetails(username,phoneno,city,vaccinename,slotdate) {
    Swal.fire(
        'User Details?',
        'Name : '+username+'<br>'+'Phone no : '+phoneno+'<br>'+'City : '+city+'<br>'+'Vaccine Name : '+vaccinename +'<br>'+ 'Slot Date : '+slotdate,
        'question'
      )
    console.log(username,phoneno,city,vaccinename,slotdate);
}