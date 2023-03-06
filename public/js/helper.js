function convertDateToDateTime(date) {
    let m = new Date(date);
    return ("0" + m.getUTCDate()).slice(-2) + "/" +
        ("0" + (m.getUTCMonth() + 1)).slice(-2) + "/" +
        m.getUTCFullYear() + " " +
        ("0" + m.getUTCHours()).slice(-2) + ":" +
        ("0" + m.getUTCMinutes()).slice(-2);
}

function renderPagination(links) {
    links.forEach(function (each) {
        $('#pagination').append($('<li>').attr('class', `page-item ${each.active ? 'active' : ''}`)
            .append(`<a class="page-link" >${each.label}</a>`));
    })
}

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

const locationApi = location.protocol + "//" + location.host+'/location/index.json';
const handleLocation = {
    getProvinces: function () {
        const _this = this;
        fetch(locationApi)
            .then(function (response) {
                return response.json();
            })
            .then(function (provinces) {
                _this.renderLocations(provinces)
            });
    },
    renderLocations: function (provinces) {
        let selectProvince = document.getElementById('select-provinces');
        let selectCityForModal = document.getElementById('city');
        let htmls = Object.keys(provinces).map(function (key) {
            return `<option data-path="${provinces[key].file_path}" >${key}</option> `;
        }).join('');
        (selectProvince) ? selectProvince.innerHTML = htmls : undefined;
        (selectCityForModal) ? selectCityForModal.innerHTML = htmls : undefined;
        this.loadDistrict('#select-provinces', '#select-district');
    },
    loadDistrict: function (el, rs) {
        let x = $(el).find(':selected');
        let path = x.attr('data-path');
        let districtApi = location.protocol + "//" + location.host+'/location/' + path;
        fetch(districtApi)
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                const selectedValue = $("#select-district").val();
                let htmls = data.district.map(function (k) {
                    let selected = (selectedValue === k.name) ? 'selected' : '';
                    return `<option ${selected}>${k.name}</option>`;
                }).join('');
                (rs) ? document.querySelector(rs).innerHTML = htmls : undefined;
            });
    },
    handleEvent: function () {
        const _this = this;
        $('#select-provinces').change(function () {
            _this.loadDistrict('#select-provinces', '#select-district');
        });
        $('#city').change(function () {
            _this.loadDistrict('#city', '#district');
        });
    },
    start: function () {
        this.getProvinces()
        this.handleEvent()
    }
}

function handlerEditNameButton(element, text, icon = null) {
    element.innerHTML = `${text} ${icon ? icon : ''}`;
}


