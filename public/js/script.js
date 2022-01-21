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

$('.plus').click(function() {
    let inputElem = $(this).parent().find('input');
    let quantity = parseInt(inputElem.val()) + 1;

    inputElem.val(quantity);

    let productId = inputElem.attr('id');
    updateTotalPrice(productId);
})

$('.minus').click(function() {
    let inputElem = $(this).parent().find('input');
    let quantity = parseInt(inputElem.val()) - 1;

    quantity = quantity < 1 ? 1 : quantity
    inputElem.val(quantity);
    let productId = inputElem.attr('id');
    updateTotalPrice(productId);
})

$('.dashboard-product-slider').slick({
    dots: false,
    arrows: false,
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 800,
    responsive: [{
        breakpoint: 1024,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
          infinite: true,
          dots: false
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
      // You can unslick at a given breakpoint now by adding:
      // settings: "unslick"
      // instead of a settings object
    ]
  });