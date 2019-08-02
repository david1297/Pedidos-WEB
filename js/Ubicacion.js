$(document).ready(function() {
    function changeNumber() {
        value = $('#value').text();
        $.ajax({
            type: "POST",
            url: "add.php",
            success: function(data) {
                $('#value').text(data);
            }
        });
    }
    setInterval(changeNumber, 3000);
});