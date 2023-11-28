<div>
    @if(!$selectedOrigin)
        <div class="py-6">
            <!-- row -->
            <div class="row">
                <div class="col-12">
                    <!-- card -->
                    <div class="card">
                        <!-- card body -->
                        <div class="card-body">

                            <div
                                class="p-4 bg-light border rounded-1 m-5 text-muted fs-4 d-flex align-items-center justify-content-center">
                                Nenhuma origem selecionada
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else

        <div class="py-6">
            <!-- row -->
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-4 col-12 mb-6">
                    <!-- card -->
                    <div class="card">
                        <!-- card body -->
                        <div class="card-body">

                            <div class="d-flex mb-4 align-items-center">
                                <div class="fs-4">
                                    {{$selectedOrigin->name}}
                                </div>
                                <div class="dropdown ms-auto">
                                    <a class="btn btn-light" href="#" role="button" data-bs-toggle="dropdown"
                                       aria-expanded="false">
                                        <i class="fal fa-ellipsis-v-alt"></i>
                                    </a>

                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                               data-bs-target="#originFormModal"
                                               wire:click="$emit('global__editOriginClicked','{{$selectedOrigin->id}}')">
                                                <i class="fal fa-edit me-2"></i> Editar Origem
                                            </a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#" wire:click="askForOriginRemove">
                                                <i class="far fa-trash-alt me-2"></i> Remover Origem
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div>
                                <label>
                                    Endpoint:
                                </label>
                                <input class="form-control" type="url" readonly
                                       value="{{route('capture',['origin' => $selectedOrigin->id])}}"/>
                            </div>
                            <div class="row mt-3">
                                <div class="col-6">
                                    <div class="fs-6">
                                        Criado em:
                                    </div>
                                    <div class="fs-6 text-muted">
                                        {{$selectedOrigin->created_at->format('d/n/Y H:i:s')}}
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="fs-6">
                                        Atualizado em:
                                    </div>
                                    <div class="fs-6 text-muted">
                                        {{$selectedOrigin->updated_at->format('d/n/Y H:i:s')}}
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                @if($selectedOrigin->auth_type == 'user_password')
                                    <b>Autenticação por Usuário e Senha</b>
                                    <table class="table table-striped mt-2">
                                        <tr>
                                            <td>Usuário:</td>
                                            <td>{{$selectedOrigin->auth_config['user']}}</td>
                                        </tr>
                                        <tr>
                                            <td>Senha:</td>
                                            <td>{{$selectedOrigin->auth_config['password']}}</td>
                                        </tr>
                                    </table>
                                @elseif($selectedOrigin->auth_type == 'domain_user_password')
                                    <b>Autenticação por Domínio, Usuário e Senha</b>
                                    <table class="table table-striped mt-2">
                                        <tr>
                                            <td>Domínio:</td>
                                            <td>{{$selectedOrigin->auth_config['domain']}}</td>
                                        </tr>
                                        <tr>
                                            <td>Usuário:</td>
                                            <td>{{$selectedOrigin->auth_config['user']}}</td>
                                        </tr>
                                        <tr>
                                            <td>Senha:</td>
                                            <td>{{$selectedOrigin->auth_config['password']}}</td>
                                        </tr>
                                    </table>
                                @elseif($selectedOrigin->auth_type == 'bearer_token')
                                    <b>Autenticação por Bearer Token</b>
                                    <table class="table table-striped mt-2">
                                        <tr>
                                            <td>Bearer Token:</td>
                                        </tr>
                                        <tr>
                                            <td>{{$selectedOrigin->auth_config['bearer']}}</td>
                                        </tr>
                                    </table>
                                @elseif($selectedOrigin->auth_type == 'other')
                                    <b>Cabeçalhos Requeridos</b>
                                    <table class="table table-striped mt-2">
                                        @foreach(json_decode($selectedOrigin->auth_config['headersJson'],true) as $key => $value)
                                            <tr>
                                                <td>
                                                    {{$key}}
                                                </td>
                                                <td>
                                                    {{$value}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                @else
                                    <b>Nenhuma Autenticação Necessária</b>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-9 col-md-8 col-12 mb-6">
                    <!-- card -->
                    <div class="card">
                        <!-- card body -->
                        <div class="card-body">
                            <!-- card title -->
                            <div class="d-flex mb-4 align-items-center">
                                <div class="fs-4 d-flex align-items-center">
                                    Requests Recebidos
                                    <button class="btn btm-sm btn-outline-primary ms-3" wire:click="refreshData">
                                        <i class="fas fa-sync me-2"></i> Atualizar
                                    </button>
                                </div>
                                <div class="dropdown ms-auto">
                                    <a class="btn btn-light" href="#" role="button" data-bs-toggle="dropdown"
                                       aria-expanded="false">
                                        <i class="fal fa-ellipsis-v-alt"></i>
                                    </a>

                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                               data-bs-target="#filtersModal">
                                                <i class="fal fa-filter me-2"></i> Filtros
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="modal fade" id="filtersModal" wire:ignore.self>
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Aplicar Filtros</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div>
                                                <label>
                                                    Método:
                                                </label>
                                                <select class="form-control" wire:model="filterMethod">
                                                    <option value="any">TODOS</option>
                                                    @foreach(array_keys(config('hooks.request_methods_color')) as $method)
                                                        <option value="{{$method}}">{{$method}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mt-3">
                                                <label>
                                                    Registros Anteriores a:
                                                </label>
                                                <input type="date" class="form-control" wire:model="filterOlderThan"/>
                                            </div>
                                            <div class="mt-3">
                                                <label>
                                                    IP:
                                                </label>
                                                <input type="text" class="form-control"
                                                       wire:model.debounce.500ms="filterIp"/>
                                            </div>
                                            <div class="mt-3">
                                                <label>
                                                    Aceitação:
                                                </label>
                                                <select class="form-control" wire:model="filterStatus">
                                                    <option value="any">TODOS</option>
                                                    <option value="authorized">Autorizados</option>
                                                    <option value="unauthorized">Não Autorizados</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
                                                Concluido
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <table class="table table-hover">
                                <thead class="bg-dark text-white">
                                <td>
                                    Método
                                </td>
                                <td>
                                    Data Hora
                                </td>
                                <td>
                                    IP
                                </td>
                                <td>
                                    Aceitação
                                </td>
                                <td>
                                    Ações
                                </td>
                                </thead>
                                @forelse($requests as $item)
                                    <tr>
                                        <td valign="middle">
                                            <span
                                                style="color:{{config('hooks.request_methods_color.'.$item->request_method)}}">
                                                {{$item->request_method}}
                                            </span>
                                        </td>
                                        <td valign="middle" class="text-muted">
                                            {{$item->created_at->format('d/m/Y H:i:s')}}
                                        </td>
                                        <td valign="middle" class="text-muted">
                                            {{$item->request_ip}}
                                        </td>
                                        <td valign="middle">
                                            <span
                                                style="color:{{config('hooks.request_status_info.'.$item->status.'.color')}}">
                                                {{config('hooks.request_status_info.'.$item->status.'.text')}}
                                            </span>
                                        </td>
                                        <td>
                                            <button class="btn btn-outline-primary" data-bs-toggle="modal"
                                                    data-bs-target="#requestDetailsModal"
                                                    wire:click="selectRequest('{{$item->id}}')">
                                                Mais detalhes
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">
                                            <div class="p-4 border rounded bg-light fs-6 text-center">
                                                Nenhum request capturado.
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </table>

                            <div class="d-flex justify-content-center">
                                {{ $requests->links() }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="requestDetailsModal" wire:ignore.self>
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">
                            <span
                                style="color:{{config('hooks.request_methods_color.'.$selectedRequest->request_method)}}">
                                                {{$selectedRequest->request_method}}
                            </span>
                            &nbsp;-&nbsp;
                            <span>
                                {{$selectedRequest->created_at ? $selectedRequest->created_at->format('d/m/Y H:i:s') : ''}}
                            </span>
                            &nbsp;-&nbsp;
                            <span
                                style="color:{{config('hooks.request_status_info.'.$selectedRequest->status.'.color')}}">
                                                {{config('hooks.request_status_info.'.$selectedRequest->status.'.text')}}
                                            </span>
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <ul class="nav nav-tabs" id="requestData" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="data-tab" data-bs-toggle="tab"
                                        data-bs-target="#data-pane" type="button" role="tab">Request Data
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="raw-data-tab" data-bs-toggle="tab"
                                        data-bs-target="#raw-data-pane" type="button" role="tab">Raw Data
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="headers-tab" data-bs-toggle="tab"
                                        data-bs-target="#headers-pane" type="button" role="tab">Headers
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="body-tab" data-bs-toggle="tab" data-bs-target="#body-pane"
                                        type="button" role="tab">Body
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="query-string-tab" data-bs-toggle="tab"
                                        data-bs-target="#query-string-pane" type="button" role="tab">Query String
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="details-tab" data-bs-toggle="tab"
                                        data-bs-target="#details-pane" type="button" role="tab">Server Details
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content" id="requestDataContent">
                            <div class="tab-pane fade show active border-end border-start border-bottom pt-3"
                                 id="data-pane" role="tabpanel" tabindex="0">
                                <div class="text-start ps-3 pe-3">
                                    <div class="d-flex">
                                        <div class="w-50">
                                            <button class="btn btn-outline-primary" onclick="document.querySelector('#json-data-viewer').expandAll()">
                                                <i class="far fa-caret-square-down"></i>
                                            </button>
                                            <button class="btn btn-outline-primary" onclick="document.querySelector('#json-data-viewer').collapseAll()">
                                                <i class="far fa-caret-square-up"></i>
                                            </button>
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="text" placeholder="Filtrar Chave" class="form-control" id="requestDataJsonFilter">
                                            <button class="btn btn-outline-secondary" type="button" onclick="document.querySelector('#json-data-viewer').filter(document.getElementById('requestDataJsonFilter').value)">
                                                <i class="far fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="overflow-scroll w-100" style="max-height: 500px;">
                                        <json-viewer id="json-data-viewer"></json-viewer>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade border-end border-start border-bottom pt-3"
                                 id="raw-data-pane" role="tabpanel" tabindex="0">
                                <div class="text-start ps-3 pe-3">
                                    <div class="d-flex">
                                    <div class="overflow-scroll w-100" style="max-height: 500px;">
                                        {{$selectedRequest->body_raw ?? "No Data"}}
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="tab-pane fade border-end border-start border-bottom pt-3" id="headers-pane" role="tabpanel" tabindex="0">

                                <div class="overflow-scroll w-100" style="max-height: 500px;">

                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">Chave</th>
                                            <th scope="col">Valor</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($selectedRequest->request_headers ?? [] as $headerKey => $headerValue)
                                            <tr>
                                                <td>{{$headerKey}}</td>
                                                <td class="text-wrap text-break">{{$headerValue}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>

                            </div>
                            <div class="tab-pane fade border-end border-start border-bottom pt-3" id="body-pane" role="tabpanel" tabindex="0">
                                <div class="text-start ps-3 pe-3">
                                    <div class="d-flex">
                                        <div class="w-50">
                                            <button class="btn btn-outline-primary" onclick="document.querySelector('#json-body-viewer').expandAll()">
                                                <i class="far fa-caret-square-down"></i>
                                            </button>
                                            <button class="btn btn-outline-primary" onclick="document.querySelector('#json-body-viewer').collapseAll()">
                                                <i class="far fa-caret-square-up"></i>
                                            </button>
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="text" placeholder="Filtrar Chave" class="form-control" id="requestBodyJsonFilter">
                                            <button class="btn btn-outline-secondary" type="button" onclick="document.querySelector('#json-body-viewer').filter(document.getElementById('requestBodyJsonFilter').value)">
                                                <i class="far fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="overflow-scroll w-100" style="max-height: 500px;">
                                        <json-viewer id="json-body-viewer"></json-viewer>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade border-end border-start border-bottom pt-3" id="query-string-pane" role="tabpanel" tabindex="0">
                                <div class="overflow-scroll w-100" style="max-height: 500px;">

                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">Chave</th>
                                            <th scope="col">Valor</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($selectedRequest->request_query_string ?? [] as $key => $value)
                                            <tr>
                                                <td>{{$key}}</td>
                                                <td class="text-wrap text-break">{{$value}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                            <div class="tab-pane fade border-end border-start border-bottom pt-3" id="details-pane" role="tabpanel" tabindex="0">
                                <div class="overflow-scroll w-100" style="max-height: 500px;">

                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">Chave</th>
                                            <th scope="col">Valor</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($selectedRequest->request_detail ?? [] as $key => $value)
                                            <tr>
                                                <td>{{$key}}</td>
                                                <td class="text-wrap text-break">{{$value}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>

    @endif
</div>
