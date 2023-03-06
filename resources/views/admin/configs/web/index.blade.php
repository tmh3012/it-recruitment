@extends('layout.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="m-0">Config information in website</h4>
                </div>
                <div class="card-body">
                    <table class="table table-centered mt-3" id="table-config">
                        <thead>
                        <tr class="category bg-secondary text-center h5">
                            <th>#</th>
                            <th class="text-left">Chuyên mục</th>
                            <th>Sắp xếp</th>
                            <th>Hiển thị</th>
                            <th>Nổi bật</th>
                            <th>Chức năng</th>
                        </tr>
                        </thead>
                        @foreach($configs as $index => $config)
                            <tbody category="{{$config->key}}">
                            <tr>
                                <td class="font-weight-bold text-center">#{{$index+1}}</td>
                                <td colspan="4" class="font-weight-bold">{{$config->value}}</td>
                                <td class="font-weight-bold text-center">
                                    <div class="table-action">
                                        <a href="javascript:void(0);" cate-key="{{$config->key}}"
                                           class="action-icon add-items text-primary"><i
                                                class="mdi-24px mdi mdi-plus"></i></a>
                                    </div>
                                </td>
                            </tr>
                            @foreach($config->configsWeb as $key=>$value)
                                <tr class="text-center" data-id="{{$value->id}}">
                                    <td class="pl-4">{{$value->id}}</td>
                                    <td class="text-left pl-4">{{$value->name}}</td>
                                    <td>
                                        <select class="form-control" name="" id="">
                                            @for($i=1; $i <= $counts[$value->key]; $i++)
                                                <option @if($value->sort === $i) selected
                                                        @endif value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                    </td>
                                    <td>
                                        <input type="checkbox" id="display-{{$value->id}}" data-switch="success"/>
                                        <label class="m-0" for="display-{{$value->id}}" data-on-label="On"
                                               data-off-label="Off"></label>
                                    </td>
                                    <td>
                                        <input type="checkbox" id="pin-{{$value->id}}" data-switch="success"/>
                                        <label class="m-0" for="pin-{{$value->id}}" data-on-label="On"
                                               data-off-label="Off"></label>
                                    </td>
                                    <td class="table-action">
                                        <a href="javascript: void(0);" class="action-icon text-success">
                                            <i class="mdi mdi-arrow-top-left-bottom-right"></i>
                                        </a>
                                        <a href="javascript: void(0);" class="action-icon text-info">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>
                                        <a href="javascript: void(0);"
                                           onclick="app.handlerDestroyConfig('{{$value->key}}', {{$value->id}})"
                                           class="action-icon text-danger">
                                            <i class="mdi mdi-delete"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="config-modal" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="configModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header align-items-center bg-primary">
                    <div class="modal-header__left">
                        <h4 class="modal-title text-dark text-uppercase" id="configModalLabel">
                            Form config web
                        </h4>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm-create-config" enctype="multipart/form-data">
                        <div class="form-body">
                            @csrf
                        </div>

                        <div class="form-footer">
                            <div class="d-flex">
                                <button type="button" class="btn btn-primary btn-insert-form mr-2">Insert form</button>
                                <button class="btn btn-success btn-add">Create</button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        {{--const url = '{{route('admin.config.report.store')}}';--}}
        const url = '{{route('admin.config.report.store')}}';
        const btnAddItems = document.querySelectorAll('.action-icon.add-items');
        const btnAddItem = document.querySelector('form .btn.btn-add');
        const btnInsertForm = document.querySelector('form .btn.btn-insert-form');
        const btnCloseModal = document.querySelector('.modal .modal-header button.close');
        const fileInput = document.querySelectorAll('input[type="file"]');
        const app = {
            openModal: function (id) {
                $(id).modal()
            },
            closeModal: function (id) {
                $(id).hide()
            },
            handlerAction: function () {
                let _this = this;
                let num = 0;

                Array.from(btnAddItems).forEach(function (el) {
                    el.onclick = function () {
                        _this.openModal('#config-modal');
                        let cateKey = el.getAttribute('cate-key')
                        handlerActionAddForm('#frm-create-config', cateKey, num);
                        btnInsertForm.onclick = function () {
                            num++;
                            handlerActionAddForm('#frm-create-config', cateKey, num);
                        }
                    }
                });

                btnCloseModal.onclick = function () {
                    _this.closeModal('#config-modal');
                    num = 0;
                };

                function handlerActionAddForm(formSelect, cateKey, num) {
                    renderFormItem('#frm-create-config', '.form-body', cateKey, num);
                    fileInputPreview(formSelect, 'input[type="file"].image', `.img-preview`);
                    Validator({
                        form: formSelect,
                        formGroupSelector: '.form-group',
                        errorSelector: '.form-message',
                        rules: [
                            // Validator.isRequired('input.form-control.key'),
                            Validator.isRequired('input.form-control.name'),
                            // Validator.isRequired('input.form-control.image'),
                            Validator.isRequired('textarea.form-control.description'),
                        ],
                        onSubmit: function () {
                            submitForm(this.form, renderList);
                        }
                    });
                }

                function fileInputPreview(formSelect, fileInputSelector, imagePreviewSelector) {
                    const formElement = document.querySelector(formSelect);
                    let inputFiles = formElement.querySelectorAll(fileInputSelector);
                    let imgPreviews = formElement.querySelectorAll(imagePreviewSelector);
                    Array.from(inputFiles).forEach(function (el, index) {
                        const imagePreview = imgPreviews[index]
                        el.onchange = function (evt) {
                            if (evt.target.files.length) {
                                imagePreview.src = URL.createObjectURL(evt.target.files[0]);
                                imagePreview.classList.remove('d-none');
                            } else {
                                imagePreview.classList.add('d-none');
                            }
                        }
                    })

                }

                async function submitForm(selectorForm, callback) {
                    const form = document.querySelector(selectorForm);
                    let formData = new FormData(form);
                    let options = {
                        method: "POST",
                        body: formData,
                    }
                    await fetch(url, options)
                        .then((response) => response.json())
                        .then(callback)
                        .catch(showError)
                }

                function renderList(response) {
                    console.log(response)
                    const data = response.data;
                    data.forEach(function (value) {
                        const htmls =
                            `
                             <tr class="text-center">
                                    {{--<td class="pl-4">{{$value->id}}</td>--}}
                            <td class="text-left pl-4">${value.key}</td>
                                    <td>
                                        {{--<select class="form-control" name="" id="">--}}
                            {{--    @for($i=1; $i <= $counts[$value->key]; $i++)--}}
                            {{--        <option @if($value->sort === $i) selected@endif value="{{$i}}">--}}
                            {{--            {{$i}}--}}
                            {{--        </option>--}}
                            {{--    @endfor--}}
                            {{--</select>--}}
                            </td>
                            <td>
{{--<input type="checkbox" id="display-{{$key+1}}" data-switch="success"/>--}}
                            {{--            <label class="m-0" for="display-{{$key+1}}" data-on-label="On"--}}
                            {{--                   data-off-label="Off"></label>--}}
                            </td>
                            <td>
{{--<input type="checkbox" id="pin-{{$key+1}}" data-switch="success"/>--}}
                            {{--<label class="m-0" for="pin-{{$key+1}}" data-on-label="On"--}}
                            {{--       data-off-label="Off"></label>--}}
                            </td>
                            <td class="table-action">
                                <a href="javascript: void(0);" class="action-icon text-success">
                                    <i class="mdi mdi-arrow-top-left-bottom-right"></i>
                                </a>
                                <a href="javascript: void(0);" class="action-icon text-info">
                                    <i class="mdi mdi-pencil"></i>
                                </a>
                                <a href="javascript: void(0);" class="action-icon text-danger">
                                    <i class="mdi mdi-delete"></i>
                                </a>
                            </td>
                        </tr>
`;
                        let rs = document.querySelector(`tbody[category="${value.key}"]`);
                        rs.insertAdjacentHTML('beforeend', htmls);
                    });
                }

                function showError(response) {
                    console.log('.catch');
                    console.log(response);
                }

                function renderFormItem(formSelector, resultSelector, cateKey, num) {
                    const form = document.querySelector(formSelector);
                    const result = form.querySelector(resultSelector);
                    const htmls =
                        `<div class="form-row mb-3">
                             <div class="form-group col-12">
                                  <h5>create new ${cateKey} - ${num + 1}</h5>
                               </div>
                               <input type="hidden" readonly class="form-control key border-primary" value="${cateKey}" name="${cateKey}[${num}][key]">
                               <div class="form-group col-12">
                                    <label for="form-label">Name</label>
                                    <input type="text" class="form-control name" name="${cateKey}[${num}][name]"
                                           placeholder="value for main app">
                                    <span class="form-message"></span>
                               </div>
                               <div class="form-group col-12">
                                    <label class="form-label">Image</label>
                                    <input type="file" class="form-control image" name="${cateKey}[${num}][image]"  accept="image/*">
                                    <span class="form-message"></span>
                                    <img class="img-preview d-none" alt="img-preview" src="" />
                               </div>
                               <div class="form-group col-12">
                                    <label for="form-label">Description</label>
                                    <textarea class="form-control description" name="${cateKey}[${num}][description]"></textarea>
                                    <span class="form-message"></span>
                               </div>
                               <div class="form-row col-12">
                                    <div class="form-group col-4">
                                        <label class="label-form">Sort</label>
                                        <input type="number" class="form-control sort" value="${num + 1}" name="${cateKey}[${num}][sort]">
                                        <span class="form-message"></span>
                                    </div>
                                    <div class="form-group col-4">
                                        <div class="d-flex flex-column">
                                            <label class="label-form">Pin</label>
                                            <div class="wrap">
                                                <input type="checkbox" id="${cateKey}-${num}-pin" name="${cateKey}[${num}][pin]"
                                                       data-switch="success"/>
                                                <label class="m-0" for="${cateKey}-${num}-pin" data-on-label="On"
                                                       data-off-label="Off"></label>
                                            </div>
                                            <span class="form-message"></span>
                                        </div>
                                    </div>
                                    <div class="form-group col-4">
                                        <div class="d-flex flex-column">
                                            <label class="label-form">Display</label>
                                            <div class="wrap">
                                                <input type="checkbox" id="${cateKey}-${num}-display" checked name="${cateKey}[${num}][is_display]"
                                                       data-switch="success"/>
                                                <label class="m-0" for="${cateKey}-${num}-display" data-on-label="On"
                                                       data-off-label="Off"></label>
                                            </div>
                                            <span class="form-message"></span>
                                        </div>
                                    </div>
                               </div>
                        </div>`;
                    if (num === 0) {
                        result.innerHTML = htmls;
                    } else {
                        result.insertAdjacentHTML('beforeend', htmls)
                    }
                }
            },
            handlerDestroyConfig: function (category, id) {
                const urlDestroy = '{{route('admin.config.report.destroy')}}' + `/${category}/${id}`;
                let options = {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(id)
                }
                const confirmMess = 'This will remove this config from the system. Are you sure delete it?';
                if (confirm(confirmMess) === true) {
                    fetch(urlDestroy, options)
                        .then(response => response.json())
                        .then((response) => {
                            if (response.success) {
                                removeConfig(category, id)
                            } else {
                                console.log(response)
                            }
                        })
                        .catch((response) =>{
                            console.log(response);
                        })
                }

                function removeConfig(category, id) {
                    const el = document.querySelector(`tbody[category="${category}"] tr[data-id="${id}"]`);
                    el.remove();
                }
            },
            start: function () {
                this.handlerAction();
            }
        }
        app.start();
        function testGetIdAndKey(key, id) {
            console.log(key,'<br/>', id)
        }
    </script>
@endpush
