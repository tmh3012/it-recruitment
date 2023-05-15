function notifySuccess(message = '') {
    $.toast({
        heading: 'Success',
        text: message,
        showHideTransition: 'slide',
        position: 'bottom-right',
        icon: 'success'
    });
}

function notifyError(message = '') {
    $.toast({
        heading: 'Error',
        text: message,
        showHideTransition: 'slide',
        position: 'bottom-right',
        icon: 'error'
    });
}

function scrollIntroElement(element, options = {
    behavior: 'smooth',
    block: 'center'
}) {
    if (typeof (element) === 'undefined' && element === null) {
        element = document.querySelector(`${element}`);
    }
    element.scrollIntoView(options)
}

function showLoading() {
    $("#spinner").addClass("loading");
}

function hideLoading() {
    $("#spinner").removeClass("loading");
}

function renderError(errors, formSelector, formGroupSelector = '.form-group', errorSelector = '.form-message') {
    if (errors !== null && typeof errors === 'object') {
        notifyError();
        Object.keys(errors).forEach(key => {
            const formElement = document.querySelector(formSelector);
            const item = formElement.querySelector(`[name="${key}"]`);
            const parentElement = getParentElement(item, formGroupSelector);
            if (item && parentElement) {
                let errorElement = parentElement.querySelector(`${errorSelector}`);
                let errorMessage = errors[key];
                parentElement.classList.add('invalid');
                errorElement.innerHTML = errorMessage;
            }
        });
    } else {
        console.error(errors)
        notifyError(`System error <br/> Please contact the administrator!`);
    }
}

function getParentElement(element, selector) {
    while (element.parentElement) {
        if (element.parentElement.matches(selector)) {
            return element.parentElement;
        }
        element = element.parentElement;
    }
}

function loadDataForForm(form, data) {
    if (typeof data === 'object' && data !== null) {
        for (const [key, value] of Object.entries(data)) {
            const item = form.querySelector(`[name="${key}"]`);
            if (key === 'id' && !item) {
                const itemId = document.createElement('input')
                itemId.name = 'id';
                itemId.type = 'hidden';
                itemId.value = `${value}`;
                form.appendChild(itemId);
            }
            if (item) {
                if (item.tagName === 'SELECT' && item.getAttribute('data-toggle') === 'select2') {
                    item.append(new Option(data.title, data.title, true, true));
                } else {
                    item.value = value;
                }
                item.dispatchEvent(new Event('blur'));
            }
        }
    }
}

function loadDataForSelect2(companyListUri, selectorId) {
    $(selectorId).select2({
        tags: true,
        ajax: {
            url:companyListUri,
            data: function (params) {
                return {
                    q: params.term
                };
            },
            processResults: function (data) {
                return {
                    results: $.map(data.data, function (item) {
                        return {
                            text: item.name,
                            id: item.name
                        }
                    })
                };
            }
        }
    });
}

export {
    scrollIntroElement,
    loadDataForSelect2,
    getParentElement,
    loadDataForForm,
    renderError,
    showLoading,
    hideLoading,
    notifySuccess,
    notifyError,
}
