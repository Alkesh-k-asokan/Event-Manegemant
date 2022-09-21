$( "#datepicker-normal" ).datepicker({ dateFormat: 'dd M yy'});
$( "#datepicker-multiple" ).datepicker({
  numberOfMonths: 3,
  showButtonPanel: true,
  dateFormat: 'dd M yy'
});	
$( "#datepicker-from" ).datepicker({
  defaultDate: "+1w",
  dateFormat: 'dd M yy',
  changeMonth: true,
  numberOfMonths: 3,
  onClose: function( selectedDate ) {
  $( "#to" ).datepicker( "option", "minDate", selectedDate );
  }
});
$( "#datepicker-to" ).datepicker({
  defaultDate: "+1w",
  dateFormat: 'dd M yy',
  changeMonth: true,
  numberOfMonths: 3,
  onClose: function( selectedDate ) {
  $( "#from" ).datepicker( "option", "maxDate", selectedDate );
  }
});	
$( "#datepicker-icon" ).datepicker({ 
  dateFormat: 'yy-mm-dd',
  minDate: new Date()  
});
$( '[data-datepicker]' ).click(function(e){ 
  var data=$(this).data('datepicker');
  $(data).focus();
});
$( "#datepicker-restrict" ).datepicker({ minDate: -20, maxDate: "+1M +10D" });	
$( "#datepicker-widget" ).datepicker();	


$('#datepicker-daterangepicker').daterangepicker(
  {
    ranges: {
     'Today': [moment(), moment()],
     'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
     'Last 7 Days': [moment().subtract('days', 6), moment()],
     'Last 30 Days': [moment().subtract('days', 29), moment()],
     'This Month': [moment().startOf('month'), moment().endOf('month')],
     'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
    },
    startDate: moment().subtract('days', 29),
    endDate: moment()
  },
  function(start, end) {
    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
  }
);	

$('#datepicker-datetime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' });