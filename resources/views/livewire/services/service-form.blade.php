<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5">
                {{$newService ? 'Adicionar Serviço' : 'Editar Serviço'}}
            </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            @if(count($errors))
                <div class="alert alert-danger">
                    @foreach ($errors->getBags() as $bag)
                        @foreach ($bag->getMessages() as $messages)
                            @foreach ($messages as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        @endforeach
                    @endforeach
                </div>
            @endif
            <div>
                <label>
                    Nome:
                </label>
                <input type="text" class="form-control" wire:model.debounce.500ms="serviceObject.name"/>
            </div>
            <div class="mt-3">
                <label>
                    Descrição:
                </label>
                <textarea class="form-control" wire:model.debounce.500ms="serviceObject.description"></textarea>
            </div>
            <div class="mt-3">
                <label>
                    Imagem:
                </label>
                @if($serviceObject && $serviceObject->image_url)
                    <div class="d-flex align-items-baseline">
                        <div class="w-25">
                            <img src="{{$serviceObject->image_url}}" class="w-100" />
                        </div>
                        <div class="w-75 ps-2">
                            <b>Alterar Imagem:</b>
                            <input type="file" class="form-control" wire:model="image"/>
                        </div>
                    </div>
                @else
                    <input type="file" class="form-control" wire:model="image"/>
                @endif
                <small class="text-muted mt-2">
                    *Máximo 512kb, entre 90x90 até 800x800
                </small>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" id="local__service_form_save_button" class="btn btn-secondary"
                    data-bs-dismiss="modal">Fechar
            </button>
            <button type="button" class="btn btn-primary" wire:click="validateFields">Salvar</button>
        </div>
    </div>
</div>
