// Only allows positive integer
$('.custom-num-only').on('input', function(e) {
    $(this).val($(this).val().replace(/[^0-9]/g, ''));
});