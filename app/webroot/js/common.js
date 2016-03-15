$(function() {
    // datetime
    $("#updateDateStart").datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 1,
        dateFormat : "yy-mm-dd",
        onClose: function(selectedDate) {
            $("#updateDateEnd").datepicker("option", "minDate", selectedDate);
        }
    });
    $("#updateDateEnd").datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 1,
        dateFormat : "yy-mm-dd",
        onClose: function(selectedDate) {
            $("#updateDateStart").datepicker("option", "maxDate", selectedDate);
        }
    });
    
    $("#registDateStart").datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 1,
        dateFormat : "yy-mm-dd",
        onClose: function(selectedDate) {
            $("#registDateEnd").datepicker("option", "minDate", selectedDate);
        }
    });
    $("#registDateEnd").datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 1,
        dateFormat : "yy-mm-dd",
        onClose: function(selectedDate) {
            $("#registDateStart").datepicker("option", "maxDate", selectedDate);
        }
    });

    // delete buttom
    $(".deleteButton").bind('click', function() {
        if (confirm('本当に削除しますか?')) {} else {
            return false;
        }
    });
});
