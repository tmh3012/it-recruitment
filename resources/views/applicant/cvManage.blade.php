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
                <div id="education-block">

                </div>
                <div id="experience-block">

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
                        <h4 class="modal-title text-white text-uppercase" id="configModalLabel">
                            Form </h4>
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

    </style>
@endpush
@push('js')
    <script type="module">
        const educationEl = document.querySelector('#education-block');
        const experienceEl = document.querySelector('#experience-block');
        import education from "{{asset('js/education.js')}}";
        education.configs(
            educationEl,
            '{{route("api.user.education.index", user()->id)}}',
            '{{route("applicant.education.store")}}',
            '{{route("applicant.education.update")}}',
            '{{route("applicant.education.destroy")}}',
        );

        import experience from "{{asset('js/experience.js')}}";
        // experience
        experience.configs(
            experienceEl,
            '{{route("applicant.experience.index")}}',
            '{{route("applicant.experience.store")}}',
            '{{route("applicant.experience.update")}}',
            '{{route("applicant.experience.destroy")}}',
        );
    </script>

    <script type="module">
        import Validator from "{{asset('js/validator.js')}}";
        import {
            scrollIntroElement,
            showLoading,
            hideLoading,
        } from "{{asset('js/extendFunction.js')}}";

        const elUploadCv = document.querySelector('#block-upload-cv');
        const formUploadCv = elUploadCv.querySelector('#profile-upload-cv');
        const inputFileUpLoadCv = formUploadCv.querySelector('input[type="file"]');
        const filePreview = elUploadCv.querySelector('.file-preview');
        const fileName = filePreview.querySelector('.file-name');
        const elIconTypeFile = formUploadCv.querySelector('label[for="input-upload-cv"]');
        const formExpe = document.querySelector('#form-create-exp');
        // const btnSubmitFormExpe = formExpe.querySelector('.btn.btn-primary');

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
                onSubmit: async function () {
                    const formElement = document.querySelector(this.form);
                    const formData = new FormData(formElement);
                    let options = {
                        method: 'POST',
                        body: formData,
                    }
                    url = "{{ route('applicant.cv.updateFileCv') }}";
                    const response = await submitForm(url, options);
                    renderFileCv(response, formElement);
                }
            });

        });
    </script>
@endpush
