
$(document).ready(function () {
    var date = new Date();
    var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul",
        "Aug", "Sep", "Oct", "Nov", "Dec"];
    var val = date.getDate() + " " + months[date.getMonth()] + ", " + date.getFullYear();
    $("#date").text(val);

});