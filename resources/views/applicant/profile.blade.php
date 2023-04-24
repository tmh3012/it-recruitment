@extends('layout.master')
@section('content')
    <div class="block-content">
        <div class="row">
            <div class="col-sm-12 col-md-7">
                <div class="upload-profile bg-white rounded p-3 ">
                    <h4 class="text-title bg-light p-2 mb-3">Update your profile</h4>
                    <div class="box-wrap">
                        <div class="box-profile box-information mb-3">
                            <div class="box-content">
                                <div class="box-profile box-image row mb-3">
                                    <div class="col-12">
                                        <div class="box-update-avatar">
                                            <div class="box-top d-flex align-items-center justify-content-between">
                                                <div class="box-text"><h5 class="text-black-50">Avatar</h5></div>
                                                <div class="box-handler">
                                                    <a href="javascript:void(0)"
                                                       class="btn btn-edit text-primary">Edit</a>
                                                </div>

                                            </div>
                                            <div class="box-content box-image-preview mx-auto text-center">
                                                @if($user->avatar)
                                                    <img src="{{$user->avatar}}" alt="{{$user->name.'-avatar'}}"
                                                         class="rounded-circle  w-100">
                                                @else
                                                    <img src="{{asset('img/profile_avatar.svg')}}" alt=""
                                                         class="rounded-circle w-100">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="box-update-cover">
                                            <div class="box-top d-flex align-items-center justify-content-between">
                                                <div class="box-text"><h5 class="text-black-50">Wall</h5></div>
                                                <div class="box-handler">
                                                    <a href="javascript:void(0)"
                                                       class="btn btn-edit text-primary">Edit</a>
                                                </div>
                                            </div>
                                            <div class="box-content box-image-preview w-100 mx-auto text-center">
                                                @if($user->cover)
                                                    <img src="{{$user->cover}}" alt="{{$user->name.'-wall'}}"
                                                         class=" w-75">
                                                @else
                                                    <img src="{{asset('img/profile_wall.svg')}}" alt=""
                                                         class="w-75">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form id="short-info">
                                    <div class="form-group mb-2">
                                        <label for="s-info__full-name">{{__('frontPage.formFullName')}}
                                            (*)</label>
                                        <input type="text" class="form-control" id="s-info__full-name"
                                               placeholder="{{__('auth.enterName')}}"
                                               name="name"
                                               @if(isApplicant() && !empty($user->name)) value="{{$user->name}}"@endif >
                                        <span class="form-message"></span>
                                    </div>
                                    <div class="form-row mb-2">
                                        <div class="form-group col-6">
                                            <label for="s-info__phone">{{__('frontPage.formPhoneNumber')}} (*)</label>
                                            <input type="text" class="form-control" id="s-info__phone"
                                                   placeholder="{{__('frontPage.placeholderYourPhone')}}"
                                                   name="phone"
                                                   @if(isApplicant() && !empty($user->phone)) value="{{$user->phone}}"@endif >
                                            <span class="form-message"></span>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="s-info__city">{{__('frontPage.formAddress')}} (*)</label>
                                            <input type="text" class="form-control" id="s-info__city"
                                                   placeholder="{{__('frontPage.placeholderAddress')}}"
                                                   name="city"
                                                   @if(isApplicant() && !empty($user->city)) value="{{$user->city}}"@endif >
                                            <span class="form-message"></span>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label for="s-info__website">{{__('frontPage.formUserLink')}}</label>
                                            <input type="text" class="form-control" id="s-info__website"
                                                   placeholder="{{__('frontPage.placeholderPersonalWebsite')}}"
                                                   name="link"
                                                   @if(isApplicant() && !empty($user->link)) value="{{$user->link}}"@endif >
                                            <span class="form-message"></span>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="s-info__position">{{__('frontPage.formPosition')}}</label>
                                            <input type="text" class="form-control" id="s-info__position"
                                                   placeholder="{{__('frontPage.placeholderPosition')}}"
                                                   name="position"
                                                   @if(isApplicant() && !empty($user->position)) value="{{$user->position}}"@endif >
                                            <span class="form-message"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="s-info__bio">{{__('frontPage.bio')}}</label>
                                        <textarea class="form-control ckeditor" id="s-info__bio" rows="4" name="bio"
                                                  placeholder="{{__('frontPage.placeholderBio')}}">
                                            @if(isApplicant() && !empty($user->link))
                                                {{$user->bio}}
                                            @endif
                                        </textarea>
                                        <span class="form-message"></span>
                                    </div>
                                    <button type="submit" disabled
                                            class="btn btn-primary btn-update">{{__('frontPage.formUpdateBtn')}}
                                    </button>

                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-sm-12 col-md-5">
                <div class="upload-profile">
                    <div class="bg-white rounded p-3 ">
                        <h4 class="text-title bg-light p-2 mb-3">Social Network</h4>
                        <div class="box-profile box-content">
                            <div class="box-social-network">
                                <form id="profile-social">
                                    <div class="form-new">
                                        <div class="form-group mb-3">
                                            <h5 class="text-black-50 mb-3">Update social network</h5>
                                            <div class="form-row">
                                                <div class="col-12 form-group">
                                                    <label class="text-capitalize" for="ps-item-name">Name</label>
                                                    <select type="text" id="ps-item-name" name="key"
                                                            class="form-control">
                                                        <option value="">Select social network</option>
                                                        <option class="text-capitalize" value="facebook">facebook
                                                        </option>
                                                        <option class="text-capitalize" value="instagram">instagram
                                                        </option>
                                                        <option class="text-capitalize" value="linkedin">linkedin
                                                        </option>
                                                        <option class="text-capitalize" value="google">Email</option>
                                                        <option class="text-capitalize" value="skype">skype</option>
                                                        <option class="text-capitalize" value="github">github</option>
                                                        <option class="text-capitalize" value="gitlab">gitlab</option>
                                                    </select>
                                                    <span class="form-message"></span>
                                                </div>
                                                <div class="form-group col-12">
                                                    <label class="text-capitalize" for="ps-item-uri">Uri</label>
                                                    <input type="text" id="ps-item-uri" name="value"
                                                           class="form-control" placeholder="Uri">
                                                    <span class="form-message"></span>
                                                </div>
                                            </div>
                                            <button
                                                class="btn btn-primary btn-ps-update">{{__('frontPage.formUpdateBtn')}}
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-data">
                                        @foreach($socials as $social)
                                            <div class="form-group mb-3" key="{{$social->key}}">
                                                <label class="text-capitalize"
                                                       for="ps-{{$social->key}}">{{$social->key}}</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"> <i
                                                            class="fa-brands fa-{{$social->key}}"></i></span>
                                                    <div class="form-control overflow-auto"
                                                         id="ps-{{$social->key}}">{{$social->value}}</div>
                                                    <div class="input-action d-flex align-content-center">
                                                        <a href="javascript:void(0)"
                                                           class="btn btn-sm btn-edit btn-outline-primary mx-1"
                                                           onclick="editSocialNetworkItem('{{$social->key}}')">
                                                            <i class="mdi mdi-square-edit-outline"></i>
                                                        </a>
                                                        <a href="javascript:void(0)"
                                                           class="btn btn-sm btn-del btn-outline-danger"
                                                           onclick="destroySocialNetwork('{{$social->key}}')">
                                                            <i class="mdi mdi-delete-outline"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded p-3 mt-3 ">
                        <h4 class="text-title bg-light p-2 mb-3">My Skill</h4>
                        <div class="box-profile box-content">
                            <div class="box-skill">
                                <form id="applicant-skill">
                                    <div class="form-group">
                                        <select class="select2 form-control select2-multiple" name="skills[]"
                                                id="select-skills"
                                                data-toggle="select2" multiple="multiple"
                                                data-placeholder="NodeJs, C++, PHP, ...">
                                        </select>
                                        <span class="form-message"></span>
                                    </div>
                                    <button class="btn btn-primary mt-1">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('modal')
    <div class="modal fade" id="modal-main" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="modal-main-title" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header align-items-center text-cl-main border-0">
                    <div class="modal-header__left">
                        <h4 class="modal-title text-uppercase" id="modal-main-title"> Edit Avatar </h4>
                    </div>
                    <button type="button" class="close font-weight-bold" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="upload-file">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <style>
        .box-update-avatar .box-image-preview {
            display: flex;
            justify-content: center;
            width: 200px !important;
            height: 200px !important;
        }

        .box-update-avatar .box-image-preview img {
            object-fit: cover;
        }

        .dropzone.main {
            padding: 0 !important;
            border: none !important;
            /* background: #5256ad !important; */
        }

        .modal-content {
            border-radius: 12px;
        }

        .btn-upload {
            border-color: var(--dropzone-color);
            color: var(--dropzone-color);
            transition: all 0.3s ease-in-out;
        }

        .btn-upload:hover {
            background-color: var(--dropzone-color);
            color: #fff;
        }

        .input-group:not(.has-validation) > .dropdown-toggle:nth-last-child(n+3), .input-group:not(.has-validation) > .form-floating:not(:last-child) > .form-control, .input-group:not(.has-validation) > .form-floating:not(:last-child) > .form-select, .input-group:not(.has-validation) > :not(:last-child):not(.dropdown-toggle):not(.dropdown-menu):not(.form-floating) {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }

        .form-data .input-action .btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: auto;
            font-size: 18px;
        }
        .select2-results .select2-results__option[aria-selected="true"] {

        }
    </style>
@endpush
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        const bodyOffset = document.body.getBoundingClientRect(),
            boxAvatar = document.querySelector('.box-update-avatar'),
            btnEditAvatar = boxAvatar.querySelector('.btn.btn-edit'),
            boxCover = document.querySelector('.box-update-cover'),
            btnEditCover = boxCover.querySelector('.btn.btn-edit'),
            fmUpdateSocial = document.querySelector('#profile-social'),
            fmSocialKey = fmUpdateSocial.querySelector('select[name="key"]');


        const modalOpen = function () {
            $('#modal-main').modal('show');
        };
        const modalClose = () => {
            $('#modal-main').modal('hide');
        }
        formShortInfo.onchange = () => {
            formShortInfo.querySelector('.btn.btn-update').disabled = false;
        }

        btnEditAvatar.onclick = () => {
            setUpFormModal('Edit Avatar', 'update-avatar', 'avatar', '.box-update-avatar');
        }

        btnEditCover.onclick = () => {
            setUpFormModal('Edit Cover', 'update-cover', 'cover', '.box-update-cover');
        }

        function viewItemUpdate(select) {
            let element = document.querySelector(select);
            let elemOffset = element.getBoundingClientRect();
            let offset = elemOffset.top - bodyOffset.top;
            window.scrollTo({
                top: offset,
                behavior: 'smooth',
            })
        }

        fmSocialKey.onchange = async (ent) => {
            const _this = ent.target;
            let key = _this.options[_this.selectedIndex].value;
            if (key) {
                let url = '{{Route("api.user.social-network.get", $user->id)}}' + `/${key}`;
                const response = await submitForm(url);
                const inputFmUpdate = fmUpdateSocial.querySelector('input[name="value"]');
                if (response.success && response.data) {
                    const data = response.data;
                    _this.value = data.key;
                    inputFmUpdate.value = data.value;
                } else {
                    inputFmUpdate.value = '';
                }
            } else {
                fmUpdateSocial.reset();
            }
        }

        function editSocialNetworkItem(key) {
            fmSocialKey.value = key;
            fmSocialKey.dispatchEvent(new Event('change'));
            fmSocialKey.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            })
        }

        async function destroySocialNetwork(key) {
            const url = '{{route('api.user.social-network.destroy', $user->id)}}' + `/${key}`;
            let options = {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: null
            }
            const confirmMess = `This will remove ${key} from your profile. Are you sure delete it?`;
            const children = document.querySelector('.box-social-network .form-data').children;
            const element = Array.from(children).find((el) => el.getAttribute('key') === key);
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


        function setUpFormModal(modalConfigTitle, formContentId, inputTypeName, rsElementUpdate = null) {
            const modal = document.querySelector('#modal-main');
            const modalTitle = modal.querySelector('.modal-title');
            modalTitle.innerHTML = modalConfigTitle;
            const modalContent = modal.querySelector('.modal-content .modal-body');
            modalContent.innerHTML = renderFormEditUserImage(formContentId, inputTypeName);
            const formContentSelect = '#' + formContentId;
            modalOpen();
            fileInputPreview(formContentSelect, 'input[type="file"]', '.form-preview .image-preview');
            Validator({
                form: formContentSelect,
                formGroupSelector: '.form-group',
                errorSelector: '.form-message',
                rules: [
                    Validator.isRequired('input[type="file"]'),
                ],
                onSubmit: async function () {
                    const form = document.querySelector(this.form)
                    const formData = new FormData(form);
                    formData.append('_method', 'PUT');
                    let options = {
                        method: 'POST',
                        body: formData,
                    }
                    url = "{{ route('api.user.update-file-image', $user->id) }}";
                    const response = await submitForm(url, options);

                    if (response.success) {
                        const data = response.data;
                        if (rsElementUpdate !== null) updateUserImagePreview(rsElementUpdate, data);
                        modalClose();
                        notifySuccess();
                    } else {
                        console.log(response);
                        renderError(response.message, this.form);
                    }
                }
            });
        }

        function renderFormEditUserImage(formId, inputTypeName) {
            return `
                <form id="${formId}">
                    <div class="form-group mb-3">
                        <div class="dropzone main">
                            <div class="dd-area">
                                <span class="icon d-block"><i class="fas fa-cloud-upload-alt"></i></span>
                                <h4 class="m-0 dz-message">Drop files here to upload.</h4>
                                <span class="my-2">Or</span>
                                <button type="button" class="btn btn-primary btn-browser-file mt-1 rounded">Browse
                                    File</button>
                                <input type="file" hidden name="${inputTypeName}" id="input-file" accept="image/*">
                            </div>
                            <div class="dd-preview"></div>
                        </div>
                        <span class="form-message"></span>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-upload btn-sm">Upload</button>
                    </div>
                </form>`
        }

        function fileInputPreview(formSelect, fileInputSelector, imagePreviewSelector) {
            const dropzones = document.querySelectorAll('.dropzone.main .dd-area');
            const fileInputs = document.querySelectorAll('.dropzone.main .dd-area input');
            const dzMessages = document.querySelectorAll('.dropzone.main .dd-area .dz-message');
            const btnBrowseFiles = document.querySelectorAll('.dropzone.main .btn.btn-browser-file');


            Array.from(btnBrowseFiles).forEach((button, index) => {
                button.onclick = () => {
                    fileInputs[index].value = null;
                    fileInputs[index].click();
                }
            })
            Array.from(fileInputs).forEach((input, index) => {
                input.onchange = () => {
                    if (input.files.length > 0) {
                        handlerShowFile(input.files[0], input);
                    } else {
                        console.log("chưa chọn file kìa ml")
                    }
                }
            })
            Array.from(dropzones).forEach((dz, index) => {
                let counter = 0;
                let dzMessage = dzMessages[index];

                //If user Drag File Over dropzone
                dz.ondragenter = (event) => {
                    event.preventDefault();
                    counter++;
                    dz.classList.add('dd-active');
                    dzMessage.textContent = "Release to Upload File.";
                }

                dz.ondragover = (event) => {
                    event.preventDefault();
                }

                //If user leave dragged File from dropzone
                dz.ondragleave = (event) => {
                    // event.preventDefault();
                    counter--;
                    if (counter === 0) {
                        dz.classList.remove('dd-active');
                        dzMessage.textContent = "Drop files here to upload.";
                    }
                }

                //If user drop File on dropzone
                dz.ondrop = (event) => {
                    event.preventDefault();
                    counter = 0;
                    dz.classList.remove('dd-active');
                    dzMessage.textContent = "Drop files here to change file upload.";
                    let file = event.dataTransfer.files;
                    fileInputs[index].files = file;
                    handlerShowFile((file[0]), dz);
                }
            })

            function handlerShowFile(file, element) {
                const formGroup = getParentElement(element, '.form-group');
                const fileType = file.type.split('/').shift();

                if (formGroup.classList.contains('invalid')) {
                    formGroup.classList.remove('invalid');
                    formGroup.querySelector('.form-message').textContent = '';
                }
                const fileSizeKb = Math.floor(file.size / 1024);
                let fileSize = (fileSizeKb < 1024) ? fileSizeKb + 'KB' : (fileSizeKb / 1000).toFixed(2) + 'MB';
                let fileName = file.name;
                if (fileName.length >= 25) {
                    let splitName = fileName.split('.');
                    fileName = splitName[0].substring(0, 13) + "... ." + splitName[1];
                }

                const ddPreview = formGroup.querySelector('.dd-preview');
                const fileAction = formGroup.querySelector('input[type="file"]').getAttribute('name');
                const htmls = `
                    <div class="card mt-1 mb-0 border">
                        <div class="p-2 file ${fileType}">
                            <div class="item">
                                <div class="file-head">
                                    <div class="image-preview ${fileAction}"></div>
                                </div>
                                <div class="file-main mt-2">
                                    <div class="file-name"><span class="h5">${fileName}<span></div>
                                    <div class="file-size"><span>${fileSize}</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;

                ddPreview.innerHTML = htmls;
                if (fileType === 'image') {
                    const reader = new FileReader();
                    const image = new Image();
                    reader.onload = () => {
                        image.src = reader.result;
                    };
                    if (file) {
                        reader.readAsDataURL(file);
                    }
                    ddPreview.querySelector(`.image-preview.${fileAction}`).appendChild(image);
                } else {
                    ddPreview.querySelector(`.image-preview.${fileAction}`).innerHTML = '<i class="fa-regular fa-file text-primary"></i>';
                }
            }
        }

        function updateUserImagePreview(parentElementSelector, data) {
            const parentElement = document.querySelector(parentElementSelector);
            const imagePreview = parentElement.querySelector('img')
            if (imagePreview) imagePreview.src = data;
        }

        async function submitForm(url, options) {
            return (await fetch(url, options)).json();
        }

        async function loadSkillForApplication()
        {
            const response = await submitForm('{{route("applicant.profile.get-skills", $user->id)}}');
            if (response.success){
                const skills = response.data;
                jQuery.each(skills, function(id, value){
                    $('#select-skills').append(new Option(value, value, true, true));
                });
            }
        }


        $(document).ready(function () {
            //load skill
            $('#select-skills').select2({
                tags: true,
                ajax: {
                    url: '{{ route('api.languages') }}',
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
            $("#select-skills").on('change', function () {
                const form = getParentElement($(this)[0], '#applicant-skill')
                form.querySelector('button.btn').disabled = false;
                $("#select-skills :selected").each(function (i, v) {
                    if (v) {
                        const formGroup = form.querySelector('.form-group');
                        if (formGroup.classList.contains('invalid')) {
                            formGroup.classList.remove('invalid');
                            formGroup.querySelector('.form-message').textContent = '';
                        }
                    }
                });
            })
            loadSkillForApplication();
        })

        document.addEventListener('DOMContentLoaded', function () {

            Validator({
                form: '#short-info',
                formGroupSelector: '.form-group',
                errorSelector: '.form-message',
                rules: [
                    Validator.isRequired('#s-info__full-name'),
                    Validator.isRequired('#s-info__phone'),
                    Validator.isPhoneNumber('#s-info__phone'),
                    Validator.isRequired('#s-info__city'),
                    Validator.isRequired('#s-info__website'),
                    Validator.isRequired('#s-info__position'),
                    Validator.isRequired('#s-info__bio'),
                ],
                onSubmit: async function (data) {
                    let url = '{{route("api.user.update-info",$user->id)}}';
                    const options = {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(data)
                    }
                    const response = await submitForm(url, options);
                    const form = document.querySelector(this.form);
                    if (response.success) {
                        const data = response.data;
                        if (typeof data === 'object' && data !== null) {
                            for (const [key, value] of Object.entries(data)) {
                                const item = form.querySelector(`[name="${key}"]:not(input[type="hidden"])`);
                                console.log(item, value)
                                if (item) item.value = value;
                            }
                        }
                        notifySuccess();
                        form.querySelector('.btn.btn-update').disabled = true;
                        // form.reset();
                    } else {
                        renderError(response.message, this.form);
                    }
                }
            });
            Validator({
                form: '#profile-social',
                formGroupSelector: '.form-group',
                errorSelector: '.form-message',
                rules: [
                    Validator.isRequired('#ps-item-name'),
                    Validator.isRequired('#ps-item-uri'),
                ],
                onSubmit: async function (data) {
                    const form = document.querySelector(this.form);
                    url = '{{route("api.user.social-network.update-or-create",$user->id)}}';
                    const options = {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(data)
                    }
                    const response = await submitForm(url, options);
                    if (response.success) {
                        const data = response.data;
                        if (typeof data === 'object' && data !== null) {
                            let isExist = false;
                            const itemElement = form.querySelector(`.form-data #ps-${data.key}`);
                            if (itemElement) {
                                isExist = true;
                                itemElement.innerText = data.value;
                            }
                            if (!isExist) {
                                renderSocialElement(form, data);
                            }

                            function renderSocialElement(form, data) {
                                const rs = form.querySelector('.form-data');
                                const htmls = `
                                    <div class="form-group mb-3" key="${data.key}">
                                        <label class="text-capitalize" for="ps-google">${data.key}</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa-brands fa-${data.key}"></i></span>
                                            <div class="form-control" id="ps-${data.key}">${data.value}</div>
                                            <div class="input-action d-flex align-content-center">
                                                <a href="javascript:void(0)" class="btn btn-sm btn-edit btn-outline-primary mx-1"
                                                    onclick="editSocialNetworkItem('${data.key}')">
                                                    <i class="mdi mdi-square-edit-outline"></i>
                                                </a>
                                                <a href="javascript:void(0)" class="btn btn-sm btn-del btn-outline-danger"
                                                    onclick="destroySocialNetwork('${data.key}')">
                                                    <i class="mdi mdi-delete-outline"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>`;
                                rs.insertAdjacentHTML('beforeend', htmls);
                            }
                        }
                        const successhtml = `<button class="btn btn-link text-white" onclick="viewItemUpdate('${this.form} .form-data')">View data update <i class="mdi mdi-chevron-triple-down"></i></button>`;
                        notifySuccess(successhtml);
                        form.reset();
                    } else {
                        renderError(response.message, this.form);
                    }
                }
            });
            Validator({
                form: '#applicant-skill',
                formGroupSelector: '.form-group',
                errorSelector: '.form-message',
                rules: [
                    Validator.isRequired('#select-skills'),
                ],
                onSubmit: async function () {
                    const form = document.querySelector(`${this.form}`);
                    const formData = new FormData(form);
                    formData.append('user_id', '{{$user->id}}');
                    const url = '{{route("applicant.profile.update-skills")}}';
                    let options = {
                        method: 'POST',
                        body: formData
                    }
                    const response = await submitForm(url, options);

                    if(response.success) {
                        form.querySelector('button.btn').disabled =  true;
                        notifySuccess();
                    }
                }
            });
        })
    </script>
@endpush
