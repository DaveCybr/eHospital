$(document).ready(function() {
  $(".angkasaja").keypress(function(data) {
    if (data.which != 8 && data.which != 0 && (data.which < 48 || data.which > 57)) {
      return false;
    }
  });
  $(".hurufsaja").keypress(function(data) {
    if (data.which != 8 && data.which != 0 && (data.which <= 65 || data.which == 32 || data.which >= 90) && (data.which <= 97 || data.which >= 122)) {
      return false;
    }
  });
});




/* global $ */
/* this is an example for validation and change events */
$.fn.numericInputExample = function() {
  'use strict';
  var element = $(this),
    footer = element.find('tfoot tr'),
    dataRows = element.find('tbody tr'),
    initialTotal = function() {
      var column, total;
      for (column = 1; column < footer.children(); column++) {
        total = 0;
        dataRows.each(function() {
          var row = $(this);
          total += parseFloat(row.children().eq(column).text());
        });
        footer.children().eq(column).text(total);
      };
    };
  element.find('td').on('change', function(evt) {
    // var cell = $(this),
    // 	column = cell.index(),
    // 	total = 0;
    // if (column === 0) {
    // 	return false;
    // }
    element.find('tbody tr').each(function() {
      var row = $(this);
      total += parseFloat(row.children().eq(column).text());
    });
    if (column === 0) {
      $('.alert').show();
      return false; // changes can be rejected
    } else {
      $('.alert').hide();
      footer.children().eq(column).text(total);
    }
  }).on('validate', function(evt, value) {
    var cell = $(this),
      column = cell.index();
    if (column === 0) {
      return !!value && value.trim().length > 0;
    } else {
      return !isNaN(parseFloat(value)) && isFinite(value);
    }
  });
  initialTotal();
  return this;
};