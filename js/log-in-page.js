$(document).ready(function() {

  "use strict";

  $("#php_error_msg").fadeOut(10000);

  var form_register_2 = $('#login-form');
  var error_register_2 = $('.alert-danger', form_register_2);
  var success_register_2 = $('.alert-success', form_register_2);

  form_register_2.validate({
    errorElement: 'div', //default input error message container
    errorClass: 'vd_red', // default input error message class
    focusInvalid: false, // do not focus the last invalid input
    ignore: "",
    rules: {

      email: {
        required: true,
        email: true
      },
      password: {
        required: true,
        minlength: 6
      },

    },

    errorPlacement: function(error, element) {
      if (element.parent().hasClass("vd_checkbox") || element.parent().hasClass("vd_radio")) {
        element.parent().append(error);
      } else if (element.parent().hasClass("vd_input-wrapper")) {
        error.insertAfter(element.parent());
      } else {
        error.insertAfter(element);
      }
    },

    invalidHandler: function(event, validator) { //display error alert on form submit              
      success_register_2.hide();
      error_register_2.show();


    },

    highlight: function(element) { // hightlight error inputs
      $("#php_error_msg").hide();
      $(element).addClass('vd_bd-red');
      $(element).parent().siblings('.help-inline').removeClass('help-inline hidden');
      if ($(element).parent().hasClass("vd_checkbox") || $(element).parent().hasClass("vd_radio")) {
        $(element).siblings('.help-inline').removeClass('help-inline hidden');
      }

    },

    unhighlight: function(element) { // revert the change dony by hightlight
      $(element)
        .closest('.control-group').removeClass('error'); // set error class to the control group
    },

    success: function(label, element) {
      label
        .addClass('valid').addClass(
          'help-inline hidden') // mark the current input as valid and display OK icon
        .closest('.control-group').removeClass('error').addClass(
          'success'); // set success class to the control group
      $(element).removeClass('vd_bd-red');


    },


  });


});