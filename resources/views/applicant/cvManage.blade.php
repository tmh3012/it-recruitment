@extends('layout.master')
@section('content')
    <div class="block-content">
        <div class="row">
            <div class="col-12">
                <div class="upload-cv bg-white rounded p-3 mb-3" id="block-upload-cv">
                    <h3 class="mb-3">Update your CV</h3>
                    <form id="profile-upload-cv" class="profile-upload-cv">
                        <div class="box-wrap row align-items-center">
                            <div class="col-6 area-upload">
                                <div class="add-file-upload d-flex align-items-center">
                                    <div class="form-group mb-0">
                                        <input type="file" class="file-upload-cv d-none" id="input-upload-cv"
                                               name="cv" accept=".doc,.docx,.pdf,.jpg ,jpeg">
                                        <label for="input-upload-cv" class="btn-upload-cv font-24">
                                            <i class="fa-solid fa-plus"></i>
                                        </label>
                                        <span class="form-message"></span>
                                    </div>
                                    <div class="box-wrap">
                                        <div class="file-preview d-none mb-1">
                                            <span class="file-name"></span>
                                        </div>
                                        <button class="btn btn-primary">{{ __('frontPage.formUploadFileBtn') }}</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="handler-del-file ml-3 ">
                                    @if (!empty($file))
                                        <div class="handler-item d-flex align-items-center">
                                            <span class="file-name d-block mr-2">{{ $file->name }}</span>
                                            <a href="{{ asset('storage/' . $file->link) }}" target="_bank"
                                               class="text-primary p-1 mr-2">
                                                <ins>View</ins>
                                            </a>
                                            <a href="javascript:void(0)" onclick="deleteFileCv({{ $file->id }})"
                                               class="text-danger p-1 del-item">
                                                <ins>Delete</ins>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="bg-white rounded p-3 mb-3" id="education-block">
                    <h3 class="mb-3"><i class="mdi mdi-school-outline mdi-24px text-primary mr-2"></i> Education</h3>
                    <div class="box-wrap w-75">
                        <div class="box-handler mb-5">
                            <form id="form-create-edu">
                                <div class="form-group">
                                    <label for="edu--type">Type (*)</label>
                                    <select name="type" id="edu--type" class="form-control">
                                        <option value="">Select Value</option>
                                        <option value="0">Course</option>
                                        <option value="1">Cấp 3</option>
                                        <option value="2">Đại học</option>
                                    </select>
                                    <span class="form-message"></span>
                                </div>
                                <div class="form-row mb-2">
                                    <div class="form-group col-12 col-md-6">
                                        <label for="epx--start_date">From (*)</label>
                                        <input type="date" name="start_date" id="epx--start_date" class="form-control">
                                        <span class="form-message"></span>
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label for="epx--end_date">To (*)</label>
                                        <input type="date" name="end_date" id="epx--end_date" class="form-control">
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
                                <button class="btn btn-primary mt-1">Submit</button>
                            </form>
                        </div>
                        <div class="box-timeline education">

                        </div>
                    </div>
                </div>
                <div class="bg-white rounded p-3 mb-3" id="experience-block">
                    <h3 class="mb-3"><i class="mdi mdi-briefcase-check-outline mdi-24px text-primary mr-2"></i> Work and
                        Experience</h3>
                    <div class="box-wrap w-75">
                        <div class="box-handler mb-5">
                            <form id="form-create-exp">
                                <div class="form-row mb-2">
                                    <div class="form-group col-12 col-md-6">
                                        <label for="epx--start_date">From (*)</label>
                                        <input type="date" name="start_date" id="epx--start_date" class="form-control">
                                        <span class="form-message"></span>
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label for="epx--end_date">To (*)</label>
                                        <input type="date" name="end_date" id="epx--end_date" class="form-control">
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
                                <button class="btn btn-primary mt-1">Submit</button>
                            </form>
                        </div>
                        <div class="box-timeline experience">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modal')
    <div class="modal fade" id="modal-main" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="configModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header align-items-center bg-primary">
                    <div class="modal-header__left">
                        <h4 class="modal-title text-dark text-uppercase" id="configModalLabel">
                            Form edit data</h4>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <style>
        /*profile*/
        form.profile-upload-cv .area-upload {
            border: 2px dashed #B4C0E0;
            padding: 20px 0 20px 20px;
            border-radius: 5px;
        }

        .add-file-upload input.file-upload-cv {
            border: 1px solid #B4C0E0;
            border-radius: 10px;
        }

        .add-file-upload label.btn-upload-cv {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 90px;
            height: 90px;
            padding: 10px;
            margin-right: 20px;
            background-color: var(--white);
            border: 1px solid #E0E6F6;
            border-radius: 5px;
            cursor: pointer;
        }

        /*box-timeline*/
        .box-timeline .timeline-items {
            display: flex;
            width: 100%;
            margin-bottom: 30px;
        }

        .box-timeline .timeline-items .timeline-year {
            position: relative;
            padding-right: 24px;
            margin-right: 25px;
        }

        .box-timeline .timeline-items .timeline-year::before {
            content: "";
            position: absolute;
            top: 0px;
            right: 0px;
            height: 100%;
            width: 1px;
            border-right: 1px solid #E0E6F7;
        }

        .timeline-items .timeline-year > span {
            border-radius: 30px;
            background-color: #EFF2FB;
            padding: 10px 15px 10px 15px;
            min-width: 160px;
            color: var(--primary);
            text-align: center;
            display: inline-block;
        }

        .timeline-items .timeline-content {
            padding-left: 10px;
        }

        .timeline-items .timeline-action {
            display: flex;
        }

        .timeline-items .timeline-action > .btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            font-size: 18px;
        }
    </style>
@endpush
@push('js')
    <script>
        const elUploadCv = document.querySelector('#block-upload-cv');
        const formUploadCv = elUploadCv.querySelector('#profile-upload-cv');
        const inputFileUpLoadCv = formUploadCv.querySelector('input[type="file"]');
        const filePreview = elUploadCv.querySelector('.file-preview');
        const fileName = filePreview.querySelector('.file-name');
        const elIconTypeFile = formUploadCv.querySelector('label[for="input-upload-cv"]');
        const educationBlock = document.querySelector('#education-block');
        const experienceBlock = document.querySelector('#experience-block');

        function handlerEventModal(formModalSelect, formElement) {
            const btnCloseModal = document.querySelector(formModalSelect + ' .modal-header button.close');

            document.onkeydown = function (evt) {
                evt = evt || event;
                let isEscape = false;
                if ("key" in evt) {
                    isEscape = (evt.key === "Escape" || evt.key === "Esc");
                } else {
                    isEscape = (evt.keyCode === 27);
                }
                if (isEscape) {
                    handlerCloseModal(formModalSelect);
                }
            }
            btnCloseModal.onclick = () => {
                handlerCloseModal(formModalSelect)
            };
        }

        function handlerCloseModal(formModalSelect) {
            console.log(true)
            const modalContent = document.querySelector(formModalSelect + ' .modal-content .modal-body');
            $(formModalSelect).modal('hide');

            while (modalContent.hasChildNodes()) {
                modalContent.removeChild(modalContent.firstChild);
            }

        }

        inputFileUpLoadCv.onchange = () => {
            if (inputFileUpLoadCv.files.length > 0) {
                const curFiles = inputFileUpLoadCv.files[0];
                if (curFiles.size > 0) {
                    showTypeFileCv(curFiles.type, elIconTypeFile)
                    fileName.innerText = curFiles.name;
                    if (filePreview.classList.contains('d-none')) {
                        filePreview.classList.remove('d-none')
                    }
                    filePreview.classList.add('d-block')
                } else {
                    filePreview.classList.add('d-none')
                }
            } else {
                resetInputFilePreview();
            }
        }

        function deleteFileCv(fileId) {
            const fileDeleteElement = document.querySelector('.handler-del-file');
            const fileDeleteElementWrap = fileDeleteElement.querySelector('.handler-item');
            const fileItemElement = fileDeleteElement.querySelector('a.del-item');

            const url = "{{ route('applicant.cv.destroyFileCv') }}" + `/${fileId}`;
            let options = {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(fileId)
            }
            const confirmMess = 'This will remove this your file CV from the system. Are you sure delete it?';
            if (confirm(confirmMess) === true) {
                fetch(url, options)
                    .then((response) => response.json())
                    .then((response) => {
                        delElementFileCv(response, fileDeleteElementWrap);
                    });
            }
        }

        function resetInputFilePreview() {
            fileName.innerText = '';
            elIconTypeFile.innerHTML = '<i class="fa-solid fa-plus"></i>';
            filePreview.classList.remove('d-block')
            filePreview.classList.add('d-none');
        }

        function showTypeFileCv(typeFile, rs) {
            let icon;
            switch (typeFile) {
                case 'application/pdf':
                    icon = '<i class="fa-solid fa-file-pdf text-danger"></i>'
                    break;
                case 'image/jpeg':
                    icon = '<i class="fa-regular fa-file-image text-success"></i>'
                    break;
                case 'image/jpg':
                    icon = '<i class="fa-regular fa-file-image text-success"></i>'
                    break;
                default:
                    icon = '<i class="fa-regular fa-file-word text-primary"></i>';
            }
            rs.innerHTML = icon;
        }

        function renderFileCv(response, formElement) {
            if (response.success) {
                const data = response.data;

                formElement.reset();
                resetInputFilePreview();
                notifySuccess('Update Cv successfully');
                const rs = formElement.querySelector('.handler-del-file');
                const html = ` <div class="handler-item d-flex align-items-center">
                                        <span class="file-name d-block mr-2">${data.name}</span>
                                         <a href="${data.link}" target="_bank" class="text-primary p-1 mr-2">
                                                <ins>View</ins>
                                         </a>
                                        <a href="javascript:void(0)"  class="text-danger del-item p-1" onclick="deleteFileCv(${data.id})">
                                            <ins>Delete</ins>
                                        </a>
                                    </div>`;
                rs.innerHTML = html;
            } else {
                renderError(response.message, '#profile-upload-cv');
            }
        }

        function delElementFileCv(response, fileElement) {
            if (response.success) {
                notifySuccess('Delete file successfully');
                fileElement.remove();
            }
        }

        async function renderTimeline(url, element) {
            const response = await submitForm(url);
            const contentWrap = document.querySelector(element);
            const rs = contentWrap.querySelector('.box-timeline')
            const data = response.data;
            const htmls = data.map((each) =>
                `
                 <div class="timeline-items" data-id="${each.id}">
                    <div class="timeline-year">
                        <span> ${each.timelineStart} - ${each.timelineEnd}</span></div>
                    <div class="timeline-content">
                        <h5 class="title mb-3">${each.title}</h5>
                        <p class="description">${each.description}</p>
                    </div>
                    <div class="timeline-action ml-auto">
                        <a href="javascript:void(0)"
                           class="btn btn-sm btn-edit btn-outline-primary mr-1"
                          onclick="handlerEditTimeline('${each.type}', ${each.id})">
                            <i class="mdi mdi-square-edit-outline"></i>
                        </a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-del btn-outline-danger"
                            onclick="handlerDestroyTimeline('${each.type}', ${each.id})">
                            <i class="mdi mdi-delete-outline"></i>
                        </a>
                    </div>
                 </div>`
            );
            rs.innerHTML = htmls.join('');
        }


        async function loadTimeline() {
            await loadListCompanyForSelect2('{{route('api.companies')}}', '#epx--title');
            await renderTimeline('{{ route('api.user.getTimeline', 'education') }}', '#education-block');
            {{--await renderTimeline('{{ route('api.user.getTimeline', 'experience') }}', '#experience-block');--}}
        }

        function cloneForm(formSelect, resultSelect, formCloneId = null) {
            const form = document.querySelector(formSelect);
            const rsElement = document.querySelector(resultSelect);
            const clone = form.cloneNode(true);
            if (formCloneId) {
                clone.id = formCloneId;
            }
            rsElement.appendChild(clone);
        }

        async function handlerEditTimeline(timelineCate, timelineId) {
            $('#modal-main').modal('show');
            const dataTimeline = timelineCate === 'education' ? dataTimeline1 : dataTimeline2;
            const formElement = 'fm-update-' + timelineCate;
            url = "{{ route('api.user.getTimeline') }}" + `/${timelineCate}` + `?id=${timelineId}`;
            cloneForm('', '#modal-main .modal-content .modal-body');

            const response = await submitForm(url);
            const form = document.getElementById(formElement);
            if (response.success) {
                const data = response.data;
                if (typeof data === 'object' && data !== null) {
                    for (const [key, value] of Object.entries(data)) {
                        const item = form.querySelector(`[name="${key}"]:not(input[type="hidden"])`);
                        if (item) item.value = value;
                    }
                }
            }

            function handlerRenderItemUpdated(category, id, data) {
                const boxTimeline = document.querySelector('.box-timeline.' + category);
                const children = boxTimeline.children;
                const element = Array.from(children).find((el) => el.getAttribute('data-id') == id);
                const htmls = `
                    <div class="timeline-year"><span> ${data.timelineStart} - ${data.timelineEnd}</span></div>
                    <div class="timeline-content">
                        <h5 class="title mb-3">${data.title}</h5>
                        <p class="description">${data.description}</p>
                    </div>
                    <div class="timeline-action ml-auto">
                        <a href="javascript:void(0)"
                           class="btn btn-sm btn-edit btn-outline-primary mr-1"
                          onclick="handlerEditTimeline('${data.type}', ${data.id})">
                            <i class="mdi mdi-square-edit-outline"></i>
                        </a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-del btn-outline-danger">
                            <i class="mdi mdi-delete-outline"></i>
                        </a>
                    </div>
               `;
                element.innerHTML = htmls;
            }

            handlerEventModal('#modal-main', formElement);
            Validator({
                form: '#' + formElement,
                formGroupSelector: '.form-group',
                errorSelector: '.form-message',
                rules: [
                    Validator.isRequired('#start_date'),
                    Validator.isRequired('#end_date'),
                    Validator.isRequired('#title'),
                    Validator.isRequired('#description'),
                ],
                onSubmit: async function (data) {
                    const url = "{{route('api.user.updateTimeline')}}" + `/${timelineCate}/${timelineId}`;
                    let options = {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(data),
                    }
                    const response = await submitForm(url, options);

                    if (response.success) {
                        handlerRenderItemUpdated(timelineCate, timelineId, response.data);
                        notifySuccess();
                        form.reset();
                    } else {
                        renderError(response.message, this.form)
                    }
                }
            })
        }

        async function handlerDestroyTimeline(category, timelineId) {
            const url = '{{route('api.user.destroyTimeline')}}' + `/${category}/${timelineId}`;
            let options = {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(timelineId)
            }
            const confirmMess = 'This will remove this timeline from the system. Are you sure delete it?';
            const children = document.querySelector('.box-timeline.' + category).children;
            const element = Array.from(children).find((el) => el.getAttribute('data-id') == timelineId);
            if (confirm(confirmMess) === true) {
                const response = await submitForm(url, options);
                if (response.success) {
                    element.remove();
                    notifySuccess();
                } else {
                    notifyError('Try again later !!!')
                }
            }

        }

        // validator form
        document.addEventListener('DOMContentLoaded', async function () {
            await loadTimeline();
            // form update CV
            await Validator({
                form: '#profile-upload-cv',
                formGroupSelector: '.form-group',
                errorSelector: '.form-message',
                rules: [
                    Validator.isRequired('#input-upload-cv'),
                ],
                onSubmit: function () {
                    const formElement = document.querySelector(this.form);
                    const formData = new FormData(formElement);
                    let options = {
                        method: 'POST',
                        body: formData,
                    }
                    url = "{{ route('applicant.cv.updateFileCv') }}";
                    fetch(url, options)
                        .then(response => response.json())
                        .then((response) => {
                            renderFileCv(response, formElement);
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                }
            });

            await Validator({
                form: "#form-create-edu",
                formGroupSelector: '.form-group',
                errorSelector: '.form-message',
                rules: [
                    Validator.isRequired('#edu--type'),
                    Validator.isRequired('#edu--start_date'),
                    Validator.isRequired('#edu--end_date'),
                    Validator.isRequired('#edu--title'),
                    Validator.isRequired('#edu--major'),
                    Validator.isRequired('#edu--description'),
                ],
                onSubmit: async function (data) {
                    let options = {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(data),
                    }
                    url = "{{ route('api.user.storeTimeline') }}";
                    const response = await submitForm(url, options);

                    if (response.success) {
                        document.querySelector(this.form).reset();
                        await renderTimeline('{{ route('api.user.getTimeline', 'education') }}',
                            '#education-block');
                        notifySuccess();
                    } else {
                        renderError(response.message, this.form);
                    }
                }
            });

            await Validator({
                form: "#form-create-exp",
                formGroupSelector: '.form-group',
                errorSelector: '.form-message',
                rules: [
                    Validator.isRequired('#epx--start_date'),
                    Validator.isRequired('#epx--end_date'),
                    Validator.isRequired('#epx--title'),
                    Validator.isRequired('#epx--position'),
                    Validator.isRequired('#epx--description'),
                ],
                onSubmit: async function (data) {
                    let options = {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(data),
                    }
                    const uriCheck = '{{route("api.companies.check")}}' + `/${data.title}`;
                    const isExit = checkCompanyExist(uriCheck);
                    if (!isExit) {

                    } else {
                        url = "{{ route('applicant.experience.store')}}";
                        const response = await submitForm(url, options);
                        if (response.success) {
                            const data = response.data;
                            renderException(data);
                            notifySuccess();
                        } else {
                            renderError(response.message, this.form);
                        }
                    }
                }
            });
        });

        function renderException(data) {
            console.log(data);
        }
    </script>
@endpush
