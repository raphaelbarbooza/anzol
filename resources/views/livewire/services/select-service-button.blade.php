<div>
    <li class="me-3">
        <a class="btn btn-light text-muted" data-bs-toggle="modal" data-bs-target="#serviceSelectModal">
            <i class="fal fa-list me-2"></i>
            Selecionar Serviço
        </a>
    </li>

    <div class="modal fade" id="serviceSelectModal" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Selecione um serviço:</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <input wire:model.debounce.200ms="filter" type="text" class="form-control"
                               placeholder="Filtrar"/>
                    </div>
                    <div class="mt-2 pt-2 border-top">
                        <ul class="list-group">
                            @foreach($services as $service)
                                <li class="list-group-item list-group-item-action d-flex align-items-center">
                                    <div>
                                        <div class="avatar avatar-md avatar-indicators avatar-online">
                                            <img alt="avatar" src="{{$service->image_url}}"
                                                 class="rounded-circle"/>
                                        </div>
                                    </div>

                                    <div class="ms-3">
                                        <div class="fw-bold">
                                            {{$service->name}}
                                        </div>
                                        <div class="fs-6 text-muted">
                                            <b>
                                                {{$service->origins->sum(
                                                    function($origin){
                                                        return $origin->requests->count();
                                                    })
                                                }}
                                            </b> requests
                                        </div>
                                    </div>


                                    <div class="ms-auto">
                                        <button data-bs-dismiss="modal" class="btn-outline-primary btn" wire:click="select('{{$service->id}}')">
                                            <i class="fad fa-check me-2"></i>Selecionar
                                        </button>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

</div>
