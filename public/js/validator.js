// define object validator
function Validator(options) {
    let selectorRules = {}

    function getParentElement(element, selector) {
        while (element.parentElement) {
            if (element.parentElement.matches(selector)) {
                return element.parentElement;
            }
            element = element.parentElement;
        }
    }

    function validate(inputElement, rule) {
        // get rule of input element with selector

            let rules = selectorRules[rule.selector];
            let parentElement = getParentElement(inputElement, options.formGroupSelector);
            let errorElement = parentElement.querySelector(options.errorSelector);
            let errorMessage;

            for (let i = 0; i < rules.length; ++i) {
                switch (inputElement.type) {
                    case 'checkbox':
                    case 'radio':
                        errorMessage = rules[i](formElement.querySelector(rule.selector + ':checked'))
                        break;
                    default:
                        errorMessage = rules[i](inputElement.value);
                }
                if (errorMessage) break;
            }

            if (errorMessage) {
                errorElement.innerText = errorMessage;
                parentElement.classList.add('invalid');
            } else {
                errorElement.innerText = '';
                parentElement.classList.remove('invalid');
            }
            return !errorMessage;
    }

    let formElement = document.querySelector(options.form);
    if (formElement) {
        formElement.onsubmit = (e) => {
            e.preventDefault();

            let isFormValid = true;
            options.rules.forEach((rule) => {
                let inputElements = formElement.querySelectorAll(rule.selector);
                let isValid;
                Array.from(inputElements).forEach((inputElement)=>{
                    isValid = validate(inputElement, rule);
                })

                if (!isValid) {
                    isFormValid = false;
                }
            });

            // validated form data
            if (isFormValid) {
                if (typeof options.onSubmit == 'function') {
                    let enableInputs = formElement.querySelectorAll('[name]');
                    let formData = Array.from(enableInputs).reduce((values, input) => {
                        switch (input.type) {
                            case 'radio':
                                values[input.name] = formElement.querySelector('input[name="' + input.name + '"]:checked').value;
                                break;
                            case 'checkbox':
                                if (!input.matches(':checked')) {
                                    values[input.name] = '';
                                    return values;
                                }
                                if (!Array.isArray(values[input.name])) {
                                    values[input.name] = [];
                                }
                                values[input.name].push(input.value);
                                break;
                            case 'file':
                                values[input.name] = input.files;
                                break;
                            default:
                                values[input.name] = input.value;
                        }
                        return values;
                    }, {});
                    options.onSubmit(formData);
                } else {
                    formElement.submit();
                }
            }
        };

        // loop through rules and handler even on element
        options.rules.forEach((rule) => {
            // each select can have many rules.
            // save rules in object with key is selector name.
            if (Array.isArray(selectorRules[rule.selector])) {
                selectorRules[rule.selector].push(rule.test)
            } else {
                selectorRules[rule.selector] = [rule.test]
            }

            let inputElements = formElement.querySelectorAll(rule.selector);
            Array.from(inputElements).forEach((inputElement) => {
                inputElement.onblur = () => validate(inputElement, rule);
                inputElement.oninput = () => {
                    let parentElement = getParentElement(inputElement, options.formGroupSelector);
                    let errorElement = parentElement.querySelector(options.errorSelector);
                    errorElement.innerText = '';
                    parentElement.classList.remove('invalid')
                }
            })
        })


    }

}

// define rules

Validator.isRequired = (selector, message) => {
    return {
        selector: selector,
        test: (value) => value ? undefined : message || 'Trường này bắt buộc nhập',
    }
}

Validator.isTextNonWhitespace = (selector, message) => {
    return {
        selector: selector,
        test: (value) => {
            const regex = /^\S+$/;
            return regex.test(value) ? undefined : message || 'Trường này không chấp nhận dấu khoảng trắng (non-whitespace)';
        }
    }
}

Validator.isPhoneNumber = (selector, message) => {
    return {
        selector: selector,
        test: (value) => {
            const regex = /^(?:0|\+(?:[1-9]+))[1-9][0-9]{8,10}$/;
            return regex.test(value) ? undefined : message || 'Vui lòng nhập số điện thoại hợp lệ';
        }
    }
}

Validator.isEmail = (selector, message) => {
    return {
        selector: selector,
        test: (value) => {
            const regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            return regex.test(value) ? undefined : message || 'Vui lòng nhập email hợp lệ';
        },
    }
}

Validator.isPassWord = (selector, message) => {
    return {
        selector: selector,
        test: (value) => {
            const regex = /^(?=.*\d)(?=.*[a-zA-Z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/;
            return regex.test(value) ? undefined : message || 'Mật khẩu tối thiểu 8 kí tự và có tối thiểu một chữ cái in hoa và tối thiểu một chữ số';
        }
    }
}

Validator.minLength = (selector, min, message) => {
    return {
        selector: selector,
        test: (value) => value.length >= min ? undefined : message || `Vui lòng nhập tối thiểu ${min} ký tự`
    }
}

Validator.isConfirmed = (selector, getConfirmValue, message) => {
    return {
        selector: selector,
        test: (value) => value === getConfirmValue() ? undefined : message || 'Giá trị nhập vào không chính xác'
    }
}
