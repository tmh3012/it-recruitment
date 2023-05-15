import Validator from "./validator.js";
import {
    showLoading,
    hideLoading,
    renderError,
    scrollIntroElement,
    notifySuccess,
    notifyError,
    loadDataForForm,
} from "./extendFunction.js";

let configs = {};
let formId = "form-create-edu";
const submitForm = async (url, options = null) => (await fetch(url, options)).json();
const education = {
    loadValueType: async function (key) {
        key = key.charAt(0).toUpperCase() + key.slice(1);
        const options = await submitForm('/api/education/key-type');
        let value = options[key];
        return `<input type="hidden" name="type" value="${value}">`;
    },
    renderForm: async function (category, result) {
        const _this = this;
        result.innerHTML = `
             <form id="${formId}" class="form-handler is-store">
               ${await this.loadValueType(category)}
                <div class="form-row mb-2">
                     <div class="form-group col-md-6">
                        <!-- Month View -->
                        <div class="mb-1 position-relative" id="startDate">
                            <label class="form-label">From (*)</label>
                            <input type="text" name="start_date" class="form-control"
                                   placeholder="Date start" autocomplete="off"
                                   data-provide="datepicker" data-date-format="MM yyyy"
                                   data-date-min-view-mode="1" data-date-container="#startDate">
                        </div>
                        <span class="form-message"></span>
                    </div>
                    <div class="form-group col-md-6">
                        <!-- Month View -->
                        <div class="mb-1 position-relative" id="endDate">
                            <label class="form-label">To (*)</label>
                            <input type="text" name="end_date" class="form-control"
                                   placeholder="Date end" autocomplete="off"
                                   data-provide="datepicker" data-date-format="MM yyyy"
                                   data-date-min-view-mode="1" data-date-container="#endDate">
                        </div>
                        <span class="form-message"></span>
                    </div>
                </div>
                <div class="form-group mb-2">
                    <label for="edu--title">Organization (*)</label>
                    <input type="text" name="title" id="edu--title" class="form-control"
                           placeholder="Short information about your School or University/ Academy">
                    <span class="form-message"></span>
                </div>
                <div class="form-group mb-2">
                    <label for="edu--major">Major (*)</label>
                    <input type="text" name="major" id="edu--major" class="form-control"
                           placeholder='Working position'>
                    <span class="form-message"></span>
                </div>
                <div class="form-group mb-2">
                    <label for="edu--description">Description (*)</label>
                    <textarea type="text" name="description" rows="4" id="edu--description"
                              class="form-control"
                              placeholder='More information about the above time period'></textarea>
                    <span class="form-message"></span>
                </div>
                 <div class="form-action d-flex justify-content-between">
                    <button type="button" class="btn btn-del btn-outline-danger">Delete</button>
                    <button type="submit" class="btn btn-store btn-primary ">Submit</button>
                    <button type="submit" class="btn btn-update btn-primary" disabled>Update</button>
                </div>
            </form>
        `;
        this.validate(category);
    },
    renderTemplate: async function (rs, data) {
        const blockHtmls = Object.keys(data).map(key => {
            return `
                     <div class="bg-white rounded p-3 mb-3 " id="${key}-block">
                            <div class="block-head w-75 d-flex align-items-center justify-content-between">
                                <h3>
                                    <i class="mdi mdi-school-outline mdi-24px text-primary mr-2"></i>
                                    ${key}
                                </h3>
                                <a href="javascript:void(0)" class="btn-add-category" data-key="${key}"><i class="fa-solid fa-plus fa-xl"></i></a>
                            </div>
                            <div class="box-wrap w-75">
                                <div class="box-timeline ${key}">${this.renderList(key, data[key])}</div>
                            </div>
                    </div>`;
        });
        rs.innerHTML = blockHtmls.join('');
    },
    renderList: function (category, data) {
        let templates = `<p class="description">You can record outstanding short courses attended.</p>`;
        if (data && data !== 'null' && data.length > 0) {
            templates = data.map(
                (each) =>
                    `
                     <div class="timeline-items mt-2" data-id="${each.id}">
                        <div class="timeline-year">
                            <span class="h5 my-0"> ${each.start_date} - ${each.end_date}</span>
                        </div>
                        <div class="timeline-separation">
                            <i class="mdi mdi-circle timeline-icon"></i>
                        </div>
                        <div class="timeline-content pr-2">
                            <h5 class="title mb-3">
                                <span class="title-icon mr-1"> <i class="fa-solid fa-graduation-cap fa-xl"></i></span>
                                ${each.title}
                            </h5>
                            <div class="job-company mb-2">
                                <h5 class="text-capitalize m-0 text-vertical l-1">${each.major}</h5>
                            </div>
                            <p class="description"> ${each.description} </p>
                        </div>
                        <div class="timeline-action ml-auto my-auto">
                            <a href="javascript:void(0)" class="btn btn-outline-primary btn-edit" data-category="${category}" data-id="${each.id}">
                                <i class="mdi mdi-square-edit-outline"></i>
                            </a>
                        </div>
                    </div>
                `
            ).join('');
        }
        return templates;
    },
    showForm: async function (category) {
        const _this = this;
        $('#modal-main .modal-title').text(category);
        const result = document.querySelector('#modal-main .modal-body');
        await this.renderForm(category, result);
        $('#modal-main').modal('show');
    },
    loadFormEdit: async function (category, data) {
        const _this = this;
        await this.showForm(category);
        const form = document.querySelector(`#${formId}`)
        form.classList.remove('is-store');
        loadDataForForm(form, data);
        hideLoading();

        form.onchange = () => form.querySelector('.btn.btn-update').disabled = false;
        const btnDelEduItem = form.querySelector('.btn.btn-del');
        btnDelEduItem.onclick = () => this.handlerDelData(category, data.id);
    },
    handlerEvents: function () {
        const btnAddEduItem = document.querySelectorAll('a.btn-add-category');
        const btnEditEduItem = configs.rs.querySelectorAll('a.btn.btn-edit');
        Array.from(btnAddEduItem).forEach((each) => {
            each.onclick = async () => {
                await showLoading();
                const key = each.getAttribute('data-key');
                await this.showForm(key);
                await hideLoading();
            }
        })
        Array.from(btnEditEduItem).forEach((each) => {
            each.onclick = async () => {
                const category = each.getAttribute('data-category');
                const id = each.getAttribute('data-id');
                const response = await submitForm(configs.indexUrl + "?id=" + id);
                showLoading();
                await this.loadFormEdit(category, response.data);
            }
        })
    },
    validate: function (category = null) {
        const _this = this;
        Validator({
            form: "#form-create-edu",
            formGroupSelector: '.form-group',
            errorSelector: '.form-message',
            rules: [
                Validator.isRequired('input[name="start_date"]'),
                Validator.isRequired('#edu--title'),
                Validator.isRequired('#edu--major'),
                Validator.isRequired('#edu--description'),
            ],
            onSubmit: async function (data) {
                const form = document.querySelector(this.form);
                const formStore = form.classList.contains('is-store');
                if (formStore) {
                    await _this.handlerStoreData(data, category, this.form);
                } else {
                    await _this.handlerUpdateData(data, category, this.form);
                }
            }
        });
    },
    handlerStoreData: async function (data, category, formSelector) {
        const _this = this;
        const results = configs.rs.querySelector(`.box-timeline.${category}`);
        showLoading();
        let options = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data),
        }
        const response = await submitForm(configs.storeUrl, options);
        if (response.success && response.data) {
            hideLoading()
            results.innerHTML = _this.renderList(category, response.data);
            notifySuccess();
            $('#modal-main').modal('hide');
        } else {
            renderError(response.message, formSelector);
            hideLoading()
        }
        this.handlerEvents();
    },
    handlerUpdateData: async function (data, category, formSelector) {
        const _this = this;
        const results = configs.rs.querySelector(`.box-timeline.${category}`);
        showLoading();
        let options = {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data),
        }
        const url = configs.updateUrl + `/${data.id}`;
        const response = await submitForm(url, options);
        if (response.success && response.data) {
            results.innerHTML = _this.renderList(category, response.data);
            notifySuccess();
            hideLoading()
            $('#modal-main').modal('hide');
        } else {
            await renderError(response.message, formSelector);
            hideLoading()
        }
        this.handlerEvents();
    },
    handlerDelData: async function (category, id) {
        const children = configs.rs.querySelector(`.box-timeline.${category}`).children;
        const element = Array.from(children).find((el) => el.getAttribute('data-id') == id);
        const confirmMess = 'This action will delete this data from the system. Do you want to proceed ?';
        if (confirm(confirmMess) === true) {
            const response = await submitForm(
                configs.destroyUrl+`/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(id),
            });
            if (response.success) {
                element.remove();
                notifySuccess();
                $('#modal-main').modal('hide');
            }  else {
                notifyError(response.message);
            }
        }
    },
    configs(rs, indexUrl, storeUrl, updateUrl, destroyUrl) {
        return this.start({
            rs,
            indexUrl,
            storeUrl,
            updateUrl,
            destroyUrl
        });
    },
    start: async function (getConfig) {
        configs = getConfig;
        const response = await submitForm(configs.indexUrl);
        await this.renderTemplate(configs.rs, response.data);
        await this.handlerEvents();
    },
}
export default education;
