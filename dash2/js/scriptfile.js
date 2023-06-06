function myFunction() {
    /* Get the text field */
    var copyText = document.getElementById("reflink");
    /* Select the text field */
    copyText.select();
    copyText.setSelectionRange(0, 99999); /* For mobile devices */
    /* Copy the text inside the text field */
    document.execCommand("copy");
    //document.getElementById('cpresponse').textContent = 'copied to clipboard';
    /* Alert the copied text */
    $.notify(
        {
            // options
            icon: "flaticon-alarm-1",
            title: "Success",
            message: "copied to clipboard",
        },
        {
            // settings
            type: "success",
            allow_dismiss: true,
            newest_on_top: false,
            placement: {
                from: "top",
                align: "right",
            },
            offset: 20,
            spacing: 10,
            z_index: 1031,
            delay: 5000,
            timer: 1000,
            animate: {
                enter: "animated fadeInDown",
                exit: "animated fadeOutUp",
            },
        }
    );
}

$(document).ready(function () {
    $("#ShipTable").DataTable({
        order: [[0, "desc"]],
        dom: "Bfrtip",
        buttons: ["copy", "csv", "print", "excel", "pdf"],
    });
});

$(document).ready(function () {
    $("#OthersTable").DataTable({
        order: [],
    });
});

$(document).ready(function () {
    $("#WithdrawTbl").DataTable({
        order: [],
    });
});

$(document).ready(function () {
    $("#DeposTbl").DataTable({
        order: [],
    });
});

$("#usernameinput").on("keypress", function (e) {
    return e.which !== 32;
});

$(document).ready(function () {
    $(".UserTable").DataTable({
        order: [[0, "desc"]],
    });
});

function googleTranslateElementInit() {
    new google.translate.TranslateElement(
        { pageLanguage: "en" },
        "google_translate_element"
    );
}
