import Validator from "./validator.js";
import {
    hideLoading,
    loadDataForForm,
    loadDataForSelect2, notifyError,
    notifySuccess,
    renderError,
    scrollIntroElement,
    showLoading,
} from "./extendFunction.js";

let configs = {};
let formId = "form-create-exp";
const submitForm = async (url, options = null) => (await fetch(url, options)).json();
const education = {
    renderForm:  function (category, result) {
        return `
              <form id="form-create-exp" class="form-handler is-store">
                <div class="form-row">
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
                    <label for="epx--title">Organization (*)</label>
                    <select type="text" name="title" id="epx--title" class="form-control select2"
                            data-toggle="select2"
                            data-placeholder='Short information about your School or Organization/Company'></select>
                    <span class="form-message"></span>
                </div>
                <div class="form-group mb-2">
                    <label for="epx--position">Position (*)</label>
                    <input type="text" name="position" id="epx--position" class="form-control"
                           placeholder='Working position'>
                    <span class="form-message"></span>
                </div>
                <div class="form-group mb-2">
                    <label for="epx--description">Description (*)</label>
                    <textarea type="text" name="description" rows="4" id="epx--description"
                              class="form-control"
                              placeholder='More information about the above time period'></textarea>
                    <span class="form-message"></span>
                </div>
                <div class="form-action">
                    <button type="submit" class="btn btn-store btn-primary ">Submit</button>
                    <button type="submit" class="btn btn-update btn-primary" disabled>Update</button>
                    <button type="button" class="btn btn-cancel btn-danger">Cancel</button>
                </div>
              </form>`;
    },
    renderTemplate: function (rs, data) {
        rs.innerHTML = `
             <div class="bg-white rounded p-3 mb-3 ">
                    <div class="block-head mb-1 d-flex align-items-center justify-content-between">
                        <h3>
                            <i class="mdi mdi-briefcase-check-outline mdi-24px text-primary mr-2"></i>
                            Experience
                        </h3>
                        <!--  <a href="javascript:void(0)" class="btn-add-category"><i class="fa-solid fa-plus fa-xl"></i></a>-->
                    </div>
                    <div class="box-handler w-75 mb-5">
                        ${this.renderForm()}
                    </div>
                    <div class="box-wrap w-75">
                        <div class="box-timeline experience">${this.renderList(data)}</div>
                    </div>
            </div>`;
        loadDataForSelect2('/api/companies', '#epx--title')
    },
    renderList: function (data) {
        let template = '';
        if (data) {
            template = data.map((each) => {
              return `
                 <div class="timeline-items" data-id="${each.id}">
                    <div class="timeline-year">
                        <span class="h5 my-0"> ${each.start_date} - ${each.end_date}</span>
                    </div>
                    <div class="timeline-separation">
                        <i class="mdi mdi-circle timeline-icon"></i>
                    </div>
                    <div class="timeline-content">
                        <h5 class="title mb-3">${each.position}</h5>
                        ${renderBlockCompany(each.title, each.company)}
                        <p class="description">${each.description}</p>
                    </div>
                    <div class="timeline-action ml-auto">
                        <a href="javascript:void(0)" data-id="${each.id}"
                        class="btn btn-sm btn-edit btn-outline-primary mr-1">
                           <i class="mdi mdi-square-edit-outline"></i>
                        </a>
                        <a href="javascript:void(0)" data-id="${each.id}"
                        class="btn btn-sm btn-del btn-outline-danger">
                            <i class="mdi mdi-delete-outline"></i>
                        </a>
                    </div>
                 </div>
              `;
            }).join('');
            function renderBlockCompany(title, company) {
                let companyTemplate = `
                     <div class="job-company d-flex mb-2">
                        <div class="block-left mr-2">
                            <i class="fa-regular fa-building fa-2xl"></i>
                        </div>
                        <div class="block-left">
                            <h5 class="text-capitalize m-0 text-vertical l-1">${title}</h5>
                        </div>
                     </div>`;
                if (company){
                    companyTemplate = `
                        <div class="job-company d-flex">
                            <div class="block-left mr-2">
                                <a class="text-dark" href="">
                                    <div class="job-company__logo img-box">
                                        <img src="${company.logo}">
                                    </div>
                                </a>
                            </div>
                            <div class="block-left">
                                <a class="text-dark"
                                   href="">
                                    <h5 class="text-capitalize m-0 text-vertical l-1">${company.name}</h5>
                                </a>
                                <p class="mt-1"><i class="mdi mdi-map-marker-outline"> </i>
                                    ${company.location} </p>
                            </div>
                        </div>`
                }
                return companyTemplate;
            }
            return template;
        }
    },
    handlerEvents: function () {
        const _this = this;
        const formExpe = document.querySelector(`#${formId}`);
        const btnEdits = configs.rs.querySelectorAll('.btn.btn-edit');
        const btnDestroys = configs.rs.querySelectorAll('.btn.btn-del');

        Array.from(btnEdits).forEach((each) => {
            each.onclick = async () => {
                showLoading();
                const id = each.getAttribute('data-id');
                const url = configs.indexUrl + `/${id}`;
                const response = await submitForm(url);
                if (response) {
                    loadDataForForm(formExpe, response);
                }
                formExpe.classList.remove('is-store');
                hideLoading();
                scrollIntroElement(formExpe);
                formExpe.querySelector('.btn.btn-cancel').onclick = function () {
                    _this.cancelledHandlerUpdateForm(formExpe);
                }
                formExpe.onchange = () => {
                    formExpe.querySelector('.form-action .btn.btn-update').disabled = false;
                }
            }
        });

        Array.from(btnDestroys).forEach((each)=>{
            const _this = this;
            each.onclick = async () => {
                const id = each.getAttribute('data-id');
                await _this.handlerDel(id);
            };
        });
    },
    cancelledHandlerUpdateForm: function (form) {
        const inputId = form.querySelector('input[name="id"]');
        form.classList.add('is-store');
        if (inputId) inputId.remove();
        form.querySelector('.btn.btn-store').disabled = false;
        const select2 = form.querySelectorAll('select[data-toggle="select2"]');
        if (select2) {
            select2.forEach((option) => {
                option.value = null;
                option.dispatchEvent(new Event('change'));
            })
        }
        form.reset();
    },
    validate: function (category = null) {
        const _this = this;
        Validator({
            form: "#form-create-exp",
            formGroupSelector: '.form-group',
            errorSelector: '.form-message',
            rules: [
                Validator.isRequired('input[name="start_date"]'),
                // Validator.isRequired('input[name="end_date"]'),
                Validator.isRequired('#epx--title'),
                Validator.isRequired('#epx--position'),
                Validator.isRequired('#epx--description'),
            ],
            onSubmit: async function (data) {
                const form = document.querySelector(this.form);
                const formAction = form.classList.contains('is-store');
                if (formAction) {
                    await _this.handlerStore(data, this.form);
                } else {
                    await _this.handlerUpdate(data, this.form);
                }
            }
        });
    },
    handlerStore: async function (data, formSelect) {
        const _this = this;
        const form = document.querySelector(formSelect);
        showLoading();
        let options = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data),
        }
        const response = await submitForm(configs.storeUrl, options);
        if (response.success) {
            await hideLoading();
            await _this.cancelledHandlerUpdateForm(form);
            const el = configs.rs.querySelector('.box-timeline.experience');
            el.innerHTML = _this.renderList(response.data);
            await scrollIntroElement(el);
            await notifySuccess();
        } else {
            await hideLoading();
            await renderError(response.message, formSelect);
        }
        this.handlerEvents();
    },
    handlerUpdate: async function (data, formSelect) {
        const _this = this;
        const form = document.querySelector(formSelect);
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
        if (response.success) {
            const el = configs.rs.querySelector('.box-timeline.experience');
            el.innerHTML = _this.renderList(response.data);
            await _this.cancelledHandlerUpdateForm(form);
            await scrollIntroElement(el);
            hideLoading();
            notifySuccess();
        } else {
            hideLoading();
            renderError(response.message, formSelect);
        }
        this.handlerEvents();
    },
    handlerDel: async function (id) {
        const children = configs.rs.querySelector(`.box-timeline.experience`).children;
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
        this.renderTemplate(configs.rs, response.data);
        this.validate();
        this.handlerEvents();
    },
}
export default education;
