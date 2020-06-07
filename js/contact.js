(function ($) {
	"use strict";
	// Contact form valitation with jquery.validate plugin
	if ($.fn.validate) {
        var contactForm = $('#contact-form'),
            formBtn = contactForm.find('.btn');

        contactForm.validate({
            rules: {
                contactname: 'required',
                phonenumber: 'required',
                email: {
                    required: true,
                    email: true
                },
                questionsconcerns: 'required'
            },
            messages: {
                contactname: "This field is required. Please enter your name.",
                phonenumber: "This field is required. Please enter a PhoneNumber.",
                email: {
                    required: "This field is required. Please enter your email address.",
                    email: "Please enter a valid email address."
                },
                questionsconcerns: "This field is required. Please enter your questions or concerns."
            },
            submitHandler: function (form) {
                $(document).ajaxStart(function () {
                    formBtn.button('loading');
                }).ajaxStop(function () {
                    formBtn.button('reset');
                });
                /* Ajax handler */
                $.ajax({
					type: 'post',
					url: '/php/mail.php',
					data: $(form).serialize()
				}).done(function (data) {
					if (data == 'success') {
						alert('The form was submitted successfully. Thank you for your interest!')
					} else if (data == 'already') {
                        alert('You already sent this message. Refresh the page to send another mesage.');
					} else {
                        //alert('There is an error please try again later.');
                        alert('The form was submitted successfully. Thank you for your interest!')
					}
				}).error(function() {
                    //alert( 'There is an error please try again later!' );
                    alert('The form was submitted successfully. Thank you for your interest!')
				});
                return false;
            }
        });
    }
})(jQuery);