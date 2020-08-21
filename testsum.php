<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<button id="add-new-field">AddNewField</button>
<div class="container">
    <input type="text" class="price" value="0"><BR>
    <input type="text" class="price" value="0"><BR>

</div>
<input type="text" class="total">
<script>
$(document).ready(function() {

    $("#add-new-field").on('click', AddNewField);
    $("body").on('keyup', '.price', function() {
        calculateTotal();
    });

});

function calculateTotal() {
    var total = 0;
    $(".price").each(function(i, v) {
        if ($(v).val() != "")
            total += parseFloat($(v).val());
    })
    $(".total").val(total);
}

function AddNewField() {
    $(".container").append("<input class='price' value='0'><BR>");
}
</script>