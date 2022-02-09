// Only allows positive integer
$('.custom-num-only').on('input', function(e) {
    $(this).val($(this).val().replace(/[^1-9]/g, ''));
});

// Defaults the value to 1 if empty input
$(`.quantity-textbox`).blur(function() {
    if ($(this).val().trim().length === 0) {
        $(this).val(1);
    }
})

// $('.plus').click(function() {
//     let inputElem = $(this).parent().find('input');
//     let quantity = parseInt(inputElem.val()) + 1;

//     inputElem.val(quantity);
// })

// $('.minus').click(function() {
//     let inputElem = $(this).parent().find('input');
//     let quantity = parseInt(inputElem.val()) - 1;

//     quantity = quantity < 1 ? 1 : quantity
//     inputElem.val(quantity);
// })