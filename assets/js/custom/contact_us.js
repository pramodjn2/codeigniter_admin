var Login = function () {
    // function to initiate Validation Sample 2
    var runValidator = function () {
        var form = $('#contactForm');
        var errorHandler2 = $('.errorHandler', form);
        var successHandler2 = $('.successHandler', form);
        
        form.validate({
            errorElement: "span", // contain the error msg in a small tag
            errorClass: 'help-block',
            errorPlacement: function (error, element) { // render error placement for each input type
                if (element.attr("type") == "radio" || element.attr("type") == "checkbox") { // for chosen elements, need to insert the error after the chosen container
                    error.insertAfter($(element).closest('.form-group').children('div').children().last());
                } else if (element.hasClass("ckeditor")) {
                    error.appendTo($(element).closest('.form-group'));
                } else {
                    error.insertAfter(element);
                    // for other inputs, just perform default behavior
                }
            },
            ignore: "",
            rules: {
				name: {
                    required: true,
					minlength:2,
					maxlength:40
                },
                email: {					
                    required: true
                },
                subject: {
                    required: true,
					maxlength:150
                },
				message: {
                    required: true,
					maxlength:3000
                }
            },
            messages: {
                //property_name: "Please Enter property name"
            },
            invalidHandler: function (event, validator) { //display error alert on form submit
                successHandler2.hide();
                errorHandler2.show();
            },
            highlight: function (element) {

                $(element).closest('.help-block').removeClass('valid');
                // display OK icon
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error').find('.symbol').removeClass('ok').addClass('required');
                // add the Bootstrap error class to the control group
            },
            unhighlight: function (element) { // revert the change done by hightlight
                $(element).closest('.form-group').removeClass('has-error');
                // set error class to the control group
            },
            success: function (label, element) {
                label.addClass('help-block valid');
                // mark the current input as valid and display OK icon
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success').find('.symbol').removeClass('required').addClass('ok');
            },
            submitHandler: function (form) {
                successHandler2.show();
                errorHandler2.hide();
                // submit form
                form.submit();
            }
        });
        /*$('.about_us').summernote({
            height: 300,
            tabsize: 2
        });*/
        //CKEDITOR.disableAutoInline = true;
        //$('textarea.ckeditor').ckeditor();
    };
    return {
        //main function to initiate template pages
        init: function () {           
            runValidator();
        }
    };
}();