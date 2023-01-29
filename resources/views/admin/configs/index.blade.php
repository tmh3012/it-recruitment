@extends('layout.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="m-0">Config text in website</h4>
                </div>
                <div class="card-body">
                    <div id="accordion">
                        <button class="btn btn-primary btn-md-config" data-bs-toggle="modal"
                                data-bs-target="#config-modal">
                            Create new
                        </button>

                        <table class="table table-striped mt-3" id="table-config">
                            <thead>
                            <tr>
                                <th>Key</th>
                                <th>Value</th>
                                <th>Value2</th>
                                <th>Description</th>
                                <th>Edit</th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                        </table>

                        <div class="modal fade" id="config-modal" data-backdrop="static" tabindex="-1" role="dialog"
                             aria-labelledby="configModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header align-items-center bg-primary">
                                        <div class="modal-header__left">
                                            <h4 class="modal-title text-dark text-uppercase" id="configModalLabel">
                                                Form config data</h4>
                                        </div>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="frm-create-config">
                                            @csrf
                                            <div class="form-row">
                                                <div class="form-group col-12">
                                                    <label for="cf-key">Key</label>
                                                    <input type="text" class="form-control" id="cf-key" name="key">
                                                    <span class="form-message"></span>
                                                </div>
                                                <div class="form-group col-6">
                                                    <label for="cf-value">Value</label>
                                                    <input type="text" class="form-control ck-editor" id="cf-value"
                                                           name="value"
                                                           placeholder="value for main app">
                                                    <span class="form-message"></span>
                                                </div>
                                                <div class="form-group col-6">
                                                    <label for="cf-value2">Value 2</label>
                                                    <input type="text" class="form-control ck-editor" id="cf-value2"
                                                           name="value2" placeholder="value for lang (en)">
                                                    <span class="form-message"></span>
                                                </div>
                                                <div class="form-group col-12">
                                                    <label for="cf-des">Short description</label>
                                                    <textarea type="text" class="form-control" id="cf-des" rows="3"
                                                              name="description"
                                                              placeholder="Description about config Ex: meaning, position use config"></textarea>
                                                    <span class="form-message"></span>
                                                </div>
                                                <button class="btn btn-success">Create</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>

        const app = {
            config: function () {
                getConfigs(renderList);
            },
            handlerEditConfig: function (key) {
                const _this = this;
                let option = {
                    method: 'GET',
                    header: {
                        'Content-Type': 'application/json',
                    },
                };
                _this.openModal('#config-modal');
                const apiEditUrl = '{{route('api.config.text.edit')}}' + '/' + key;
                fetch(apiEditUrl, option)
                    .then((response) => response.json())
                    .then(renderFormEdit);
            },
            openModal: function (id) {
                $(id).modal()
            },
            handlerCloseModal: function (id) {
                $(id).modal('hide');
                const modalElement = document.querySelector(id);
                const formElement = modalElement.querySelector('form#frm-create-config');
                const btnSubmit = formElement.querySelector('button');
                formElement.getAttribute('form-handler') ? formElement.removeAttribute('form-handler') : undefined;
                btnSubmit.innerText = 'Create';
                btnSubmit.removeAttribute('disabled');

                const elInvalids = modalElement.querySelectorAll('.invalid');
                if (elInvalids.length > 0) {
                    Array.from(elInvalids).forEach(function (invalid) {
                        invalid.classList.remove('invalid');
                    })
                }
                formElement.reset();
            },
            handlerEvents: function () {
                const _this = this;
                document.querySelector('.btn-md-config').onclick = function () {
                    _this.openModal('#config-modal');
                }
                document.querySelector('.modal .modal-header button.close').onclick = function () {
                    _this.handlerCloseModal('#config-modal');
                }
            },
            start: function () {
                this.config();
                this.handlerEvents();
            }
        }
        app.start();

        function renderFormEdit(response) {
            const data = response.data;
            const dataKey = Object.keys(data);
            const formElement = document.querySelector('form#frm-create-config');
            formElement.setAttribute('form-handler', 'form-edit');
            const btnSubmit = formElement.querySelector('button')
            btnSubmit.innerText = 'Update';
            btnSubmit.setAttribute('disabled', '');
            formElement.onchange = function () {
                btnSubmit.removeAttribute('disabled');
            }
            dataKey.forEach(function (dKey, index) {
                let el = formElement.querySelector(`[name="${dKey}"]:not([type="hidden"])`);
                if (el) {
                    el.value = data[dKey];
                }
            })
        }

        // load api list config
        function getConfigs(callback) {
            fetch('{{route('api.config.text.index')}}')
                .then((response) => response.json())
                .then(callback)
        }

        function renderList(response) {
            const listConfigResult = document.querySelector("#table-config tbody");
            let html = response.data.map(function (config) {
                return `
                    <tr>
                        <td>${config.key}</td>
                        <td>${config.value}</td>
                        <td>${config.value2 !== null ? config.value2 : ''}</td>
                        <td>${config.description !== null ? config.description : ''}</td>
                        <td> <div class="btn btn-info btn-edit-config" onclick="app.handlerEditConfig('${config.key}')" >Edit</div></td>
                    </tr>
                `;
            });
            listConfigResult.innerHTML = html.join('');
        }

        Validator({
            form: '#frm-create-config',
            formGroupSelector: '.form-group',
            errorSelector: '.form-message',
            rules: [
                Validator.isRequired('#cf-key'),
                Validator.isTextNonWhitespace('#cf-key'),
                Validator.isRequired('#cf-value'),
                Validator.isRequired('#cf-des'),
            ],
            onSubmit: function (data) {
                const formElement = document.querySelector(this.form);
                let formHandler = formElement.getAttribute('form-handler');
                if (formHandler) {
                    updateConfig(data);
                } else {
                    createConfig(data);
                }

                function createConfig(data) {
                    let options = {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(data)
                    }
                    fetch("{{route('api.config.text.store')}}", options)
                        .then((response) => {
                            return response.json();
                        })
                        .then((response) => {
                            notifySuccess('Successfully created new config');
                            formElement.reset();
                            getConfigs(renderList)
                        })
                        .catch((response) => {
                            notifyError('Error! Try again later');
                            console.log(response)
                        });
                }

                function updateConfig(data) {
                    let options = {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(data)
                    };
                    fetch("{{route('api.config.text.update')}}",options)
                        .then((response) => response.json())
                        .then((response) =>{
                            notifySuccess("Update completed");
                            formElement.reset();
                            getConfigs(renderList)
                        })
                        .catch((response) =>{
                            console.log(response);
                            notifyError("Error updating config");
                        })
                }
            }
        })
    </script>
@endpush
