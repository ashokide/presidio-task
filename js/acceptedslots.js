let availableslots = document.getElementById('availableslots');
availableslots.onclick = () => {
    location.href = './user.html'
}

function addDays(date, days) {
    let parts = date.split('-');
    let d = new Date(parts[2], parts[1] - 1, parts[0]);
    d.setDate(d.getDate() + days);
    return d.toDateString();
}

let slots = [];
let acceptedslots = document.getElementById("acceptedslots");
function setSlots() {
    if (slots.length) {
        slots.forEach((slot) => {
            acceptedslots.innerHTML +=
                `
                <div class="card my-2" style="width: 18rem;">
                    <div class="card-header bg-danger text-white">
                        SNO : <strong>${slot['sno']}</strong>
                    </div>
                    <div class="card-body">
                        Vaccine Name : <p class="card-text">${slot['vaccinename']}</p>
                        Date For Vaccine : <h5 class="card-text">${slot['slotdate']}</h5>
                        Date For Next Vaccine : <h5 class="card-text">${addDays(slot['slotdate'], 45)}</h5>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-outline-warning" onclick='cancel("${slot['vaccinename']}","${slot['slotdate']}")'>Cancel Slot</button>
                    </div>
                </div>
        `;
        })
    }
    else {
        acceptedslots.innerHTML = "<h4>No Slots Available</h4>";
    }
}
$(document).ready(function () {
    $.ajax({
        url: "../backend/acceptedslots.php",
        success: function (data) {
            if (data['status'] === 1) {
                slots = data['data'];
                setSlots();
                Swal.fire(
                    'Success',
                    "Slots Fetched Successfully",
                    'success'
                );
            }
            else {
                requests = [];
                setSlots();
                Swal.fire(
                    'Success',
                    data['data'],
                    'success'
                );
            }

        },
        error: function () {
            setSlots();
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

function cancel(vaccinename, slotdate) {
    $.ajax({
        url: "../backend/cancelslot.php",
        type: 'POST',
        data: {
            username: localStorage.getItem('username'),
            vaccinename,
            slotdate
        },
        success: function (data) {
            if (data['status'] == 1) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: data['msg'],
                    didClose: () => {
                        location.href = "./acceptedslots.html";
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