jQuery(document).ready(function ($) {

  let dateToday = new Date();
  $(".past-days-disabled-date-field").datepicker({
    dateFormat: 'dd-mm-yy',
    minDate: dateToday,
  });
});
