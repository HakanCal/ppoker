// SOURCE:
// https://www.cluemediator.com/add-or-remove-input-fields-dynamically-in-php-using-jquery


$(document).ready(function () {
// allowed maximum input fields
var max_input = 10;

// initialize the counter for textbox
var x = 1;

// handle click event on Add More button
$('.add-btn').click(function (e) {
    e.preventDefault();
    if (x < max_input) { // validate the condition
    x++; // increment the counter
    $('.wrapper').append(`
    <div class="input-group mb-1">
        <input class="form-control" type="email" name="emails[]">
        <a href="#" class="remove-lnk btn btn-danger">Entfernen</a>
    </div>
    `); // add input field
    }
});

// handle click event of the remove link
$('.wrapper').on("click", ".remove-lnk", function (e) {
    e.preventDefault();
    $(this).parent('div').remove();  // remove input field
    x--; // decrement the counter
}) 
});
