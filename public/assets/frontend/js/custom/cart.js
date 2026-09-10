"use strict"

//notyf init
let cartNotyf = new Notyf();

$(function () {
  $('.add-to-cart').on('click', function (e) {
    e.preventDefault();
    const id = $(this).data('id');

    $.ajax({
      method: 'POST',
      url: route('cart.store', id),
      data: {
        _token: csrfToken
      },
      beforeSend: function () {
        $(`#cart-btn-${id}`).text('Adding...');
      },
      success: function (data) {
        if (data.status == 'success') {
          $('#cart-count').text(data.cartCount);
          cartNotyf.success(data.message);
          $(`#cart-btn-${id}`).text('Added to cart');
        }
      },
      error: function (xhr, status, error) {
        let errorMessage = xhr.responseJSON?.message || 'Something went wrong!';
        $(`#cart-btn-${id}`).text('Add to cart');
        cartNotyf.error(errorMessage);
      }
    })
  })

  /* remove cart items*/
  $('.cart-item-remove').on('click', function (e) {
    e.preventDefault();
    const id = $(this).data('id');
    $.ajax({
      method: 'DELETE',
      url: route('cart.destroy', id),
      data: {
        _token: csrfToken
      },
      success: function (data) {
        if (data.status == 'success') {
          window.location.reload();
        }
      },
      error: function (xhr, status, error) {
        console.log(error);
      }
    })
  })
})
