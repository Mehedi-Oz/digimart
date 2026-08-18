"use strict";

$(function () {
  $data('add-to-cart').on('click', function (e) {
    e.preventDefault();
    const id = $(this).data('id');

    $.ajax({
      method: 'POST',
      url: '',
      data: {},
      beforeSend: function () {

      },
      success: function () {

      },
      error: function (xhr, status, error) {

      }
    })
  })
})
