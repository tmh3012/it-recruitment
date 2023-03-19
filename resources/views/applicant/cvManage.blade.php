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
                                        <input type="file" class="file-upload-cv d-none" id="input-upload-cv" name="cv"
                                               accept=".doc,.docx,.pdf,.jpg ,jpeg">
                                        <label for="input-upload-cv" class="btn-upload-cv font-24">
                                            <i class="fa-solid fa-plus"></i>
                                        </label>
                                        <span class="form-message"></span>
                                    </div>
                                    <div class="box-wrap">
                                        <div class="file-preview d-none mb-1">
                                            <span class="file-name"></span>
                                        </div>
                                        <button class="btn btn-primary">{{__('frontPage.formUploadFileBtn')}}</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="handler-del-file ml-3 ">
                                    @if(!empty($file))
                                        <div class="handler-item d-flex align-items-center">
                                            <span class="file-name d-block mr-2">{{$file->name}}</span>
                                            <a href="{{asset('storage/'.$file->link)}}" target="_bank"
                                               class="text-primary p-1 mr-2">
                                                <ins>View</ins>
                                            </a>
                                            <a href="javascript:void(0)" onclick="deleteFileCv({{$file->id}})"
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
                                <div class="form-row mb-3">
                                    <div class="form-group col-6">
                                        <label for="form-ed__time-start">From</label>
                                        <input type="month" class="form-control" id="form-ed__time-start"
                                               name="start_date">
                                        <span class="form-message"></span>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="form-ed__time-end">To</label>
                                        <input type="month" class="form-control" id="form-ed__time-end" name="end_date">
                                        <span class="form-message"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="form-ed__title">School's name</label>
                                    <input type="text" class="form-control" id="form-ed__title" name="title"
                                           placeholder="School's name">
                                    <span class="form-message"></span>
                                </div>
                                <div class="form-group">
                                    <label for="form-ed__desc">Description</label>
                                    <textarea type="date" class="form-control" rows="4" id="form-ed__desc"
                                              name="description"
                                              placeholder="More information about the above time period "></textarea>
                                    <span class="form-message"></span>
                                </div>
                                <input type="hidden" name="type" value="{{$timeLineType['EDUCATION']}}">
                                <div class="form-group">
                                    <button class="btn btn-primary">Add Timeline</button>
                                </div>
                            </form>
                        </div>
                        <div class="box-timeline education">
                            <div class="timeline-items">
                                <div class="timeline-year"><span>2018-2022</span></div>
                                <div class="timeline-content">
                                    <h5 class="title mb-3">E-commerce - Danang University of Economics</h5>
                                    <p class="description">
                                        Lorem ipsum dolor sit amet, consectetur dipiscing elit. Proin a ipsum tellus.
                                        Interdum et malesuada fames ac ante ipsum primis in faucibus.
                                    </p>
                                </div>
                                <div class="timeline-action">
                                    <a href="javascript:void(0)" class="btn btn-sm btn-edit btn-outline-primary mr-1"
                                       data-id="2">
                                        <i class="mdi mdi-square-edit-outline"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-sm btn-del btn-outline-danger"
                                       data-id="21">
                                        <i class="mdi mdi-delete-outline"></i>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="bg-white rounded p-3 mb-3" id="experience-block">
                    <h3 class="mb-3"><i class="mdi mdi-briefcase-check-outline mdi-24px text-primary mr-2"></i> Work and
                        Experience</h3>
                    <div class="box-wrap w-75">
                        <div class="box-handler mb-5">
                            <form id="form-create-exp">
                                <div class="form-row mb-3">
                                    <div class="form-group col-6">
                                        <label for="form-exp__time-start">From</label>
                                        <input type="month" class="form-control" id="form-exp__time-start"
                                               name="time-start">
                                        <span class="form-message"></span>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="form-exp__time-end">To</label>
                                        <input type="month" class="form-control" id="form-exp__time-end"
                                               name="time-end">
                                        <span class="form-message"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="form-exp__title">Company name</label>
                                    <input type="text" class="form-control" id="form-exp__title" name="title"
                                           placeholder="Company name">
                                    <span class="form-message"></span>
                                </div>
                                <div class="form-group">
                                    <label for="form-exp__desc">Description</label>
                                    <textarea type="date" class="form-control" rows="4" id="form-exp__desc"
                                              name="description"
                                              placeholder="More information about the above time period "></textarea>
                                    <span class="form-message"></span>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary">Add Timeline</button>
                                </div>
                            </form>
                        </div>
                        <div class="box-timeline experience">
                            <div class="timeline-items">
                                <div class="timeline-year"><span>2018-2022</span></div>
                                <div class="timeline-content">
                                    <h5 class="title mb-3">E-commerce - Danang University of Economics</h5>
                                    <p class="description">
                                        Lorem ipsum dolor sit amet, consectetur dipiscing elit. Proin a ipsum tellus.
                                        Interdum et malesuada fames ac ante ipsum primis in faucibus.
                                    </p>
                                </div>
                                <div class="timeline-action">
                                    <a href="javascript:void(0)" class="btn btn-sm btn-edit btn-outline-primary mr-1"
                                       data-id="2">
                                        <i class="mdi mdi-square-edit-outline"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-sm btn-del btn-outline-danger"
                                       data-id="21">
                                        <i class="mdi mdi-delete-outline"></i>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
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
            padding: 1px 15px 2px 15px;
            min-width: 130px;
            color: var(--primary);
            text-align: center;
            display: inline-block;
        }

        .timeline-items .timeline-content {
            padding-left: 20px;
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

            const url = "{{route('applicant.cv.destroyFileCv')}}" + `/${fileId}`;
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

        function submitForm(url, options, callback = null) {

            fetch(url, options)
                .then(response => response.json())
                .then(callback)
                .catch(function (error) {
                    console.log(error);
                });
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

        function renderError(errors, formSelector, formGroupSelector = '.form-group', errorSelector = '.form-message') {
            if (errors !== null && typeof errors === 'object') {
                Object.keys(errors).forEach(key => {
                    const formElement = document.querySelector(formSelector);
                    let errorMessage = errors[key];
                    let errorElement = formElement.querySelector(`[name="${key}"] ~ ${errorSelector}`);
                    getParentElement(errorElement, formGroupSelector).classList.add('invalid');
                    errorElement.innerHTML = errorMessage;
                })
            } else {
                console.log(errors)
                notifyError(`System error <br/> Try again !`);
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

        // validator form
        document.addEventListener('DOMContentLoaded', function () {

            // form update CV
            Validator({
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
                    url = "{{route('applicant.cv.updateFileCv')}}";
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

            Validator({
                form: "#form-create-edu",
                formGroupSelector: '.form-group',
                errorSelector: '.form-message',
                rules: [
                    Validator.isRequired('#form-ed__time-start'),
                    Validator.isRequired('#form-ed__time-end'),
                    Validator.isRequired('#form-ed__title'),
                    Validator.isRequired('#form-ed__desc'),
                ],
                onSubmit: function (data) {
                    console.log(data);
                    let options = {
                        method: 'POST',
                        headers:{
                            'Content-Type': 'application/json'
                        },
                        body:  JSON.stringify(data),
                    }
                    url = "{{route('applicant.cv.timeline-store')}}";
                    fetch(url, options)
                        .then(response => response.json())
                        .then((response) => {
                           console.log(response)
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                }
            })
        });
    </script>
@endpush
