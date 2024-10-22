var FormValidator = (function() {
    var instance;

    function init() {
        function checkIsJson(element_1, class_name, field_name) {
            if (element_1.val() !== ""
                && !isJson(element_1.val())
            ) {
                class_name.text(field_name + " must be json");
                element_1.addClass("border-red");

                return false;
            } else {
                class_name.text("");
                element_1.removeClass("border-red");
            }

            return true;
        }

        function checkIsLink(element_1, class_name, field_name) {
            if (element_1.val() != ''
                && !isLink(element_1.val())
            ) {
                class_name.text(field_name + " field is invalid.");
                element_1.addClass("border-red");
                return false;
            } else {
                class_name.text('');
                element_1.removeClass("border-red");
            }

            return true;
        }

        function requiredValueAndValueIsNumber(id, class_messages, field_name) {
            if (id.val() == '') {
                class_messages.text(field_name + ' field is required.');
                id.addClass("border-red");

                return false;
            } else if (!$.isNumeric(id.val())) {
                class_messages.text(field_name +  ' field is number.');
                id.addClass("border-red");

                return false;
            } else {
                class_messages.text('');
                id.removeClass("border-red");
            }

            return true;
        }

        function compareValue(element_1, element_2) {
            if (element_1.val() != ''
                &&  element_1.val() != null
                && element_2.val() != ''
                &&  element_2.val() != null
            ) {
                if (parseInt(element_1.val()) > parseInt(element_2.val())) {
                    $('.msg-txtEndAge').text('The txt end age must be greater than or equal to ' + $('#txtStartAge').val());
                    $('#txtEndAge').addClass("border-red");

                    return false;
                } else {
                    $('.msg-txtEndAge').text('');
                    $('#txtEndAge').removeClass("border-red");
                }
            }

            return true;
        }

        function requiredValue(id, class_messages, field_name) {
            if (id.val() == '') {
                class_messages.text(field_name + ' field is required.');
                id.addClass("border-red");

                return false;
            } else {
                class_messages.text('');
                id.removeClass("border-red");
            }

            return true;
        }

        function select(id, class_messages, field_name) {
            if (id.val() == null || id.val() == '') {
                class_messages.text(field_name + ' field is required.');
                id.addClass("border-red");

                return false;
            } else {
                class_messages.text('');
                id.removeClass("border-red");
            }

            return true;
        }

        function select2(id, class_messages, field_name) {
            if (id.val() == null || id.val() == '') {
                class_messages.text(field_name + ' field is required.');
                id.siblings(".select2-container").css('border', '1px solid red');

                return false;
            } else {
                class_messages.text('');
                id.siblings(".select2-container").css('border', '');
            }

            return true;
        }

        function validateAge(id, class_messages, field_name) {
            if (id.val() == '') {
                class_messages.text(field_name + ' field is required.');
                id.addClass("border-red");

                return false;
            } else if (id.val() != '' && !$.isNumeric(id.val())) {
                class_messages.text(field_name + ' field is number.');
                id.addClass("border-red");

                return false;
            } else if($.isNumeric($('#txtEndAge').val())
                && parseInt(id.val()) > 100 || parseInt(id.val()) < 0
            ) {
                class_messages.text(field_name + 'must not be greater than 100 and must be at least 1.');
                id.addClass("border-red");

                return false;
            } else {
                class_messages.text('');
                id.removeClass("border-red");
            }

            return true;
        }

        function validateEmail(id, class_messages, field_name) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

            if (id.val() == '') {
                class_messages.text(field_name + ' field is required.');
                id.addClass("border-red");

                return false;
            } else if  (!regex.test(id.val())) {
                class_messages.text(field_name + ' field is invalid.');
                id.addClass("border-red");

                return false;
            } else {
                class_messages.text('');
                id.removeClass("border-red");
            }

            return true;
        }

        function validatePhone(id, class_messages, field_name) {
            var regex = /^\+?(\d[\d-. ]+)?$/;

            if (id.val() == '') {
                class_messages.text(field_name + ' field is required.');
                id.addClass("border-red");

                return false;
            } else if  (!regex.test(id.val())) {
                class_messages.text(field_name + ' field is invalid.');
                id.addClass("border-red");

                return false;
            } else {
                class_messages.text('');
                id.removeClass("border-red");
            }

            return true;
        }

        return {
            validateJson : function (element_1, class_name, field_name) {
                return checkIsJson(element_1, class_name, field_name)
            },
            validateLink : function (element_1, class_name, field_name) {
                return checkIsLink(element_1, class_name, field_name)
            },
            validateRequiredValueAndValueIsNumber : function (element_1, class_name, field_name) {
                return requiredValueAndValueIsNumber(element_1, class_name, field_name)
            },
            validateCompareValue : function (element_1, element_2) {
                return compareValue(element_1, element_2)
            },
            validateSelect2 : function (id, class_messages, field_name) {
                return select2(id, class_messages, field_name)
            },
            validateSelect : function (id, class_messages, field_name) {
                return select(id, class_messages, field_name)
            },
            validateValidateAge : function (id, class_messages, field_name) {
                return validateAge(id, class_messages, field_name)
            },
            validateRequiredValue : function (id, class_messages, field_name) {
                return requiredValue(id, class_messages, field_name)
            },
            validateRequiredEmail : function (id, class_messages, field_name) {
                return validateEmail(id, class_messages, field_name)
            },
            validateRequiredPhone : function (id, class_messages, field_name) {
                return validatePhone(id, class_messages, field_name)
            }
        };
    }

    return {
        getInstance: function() {
            if (!instance) {
                instance = init();
            }
            return instance;
        }
    };
})();

