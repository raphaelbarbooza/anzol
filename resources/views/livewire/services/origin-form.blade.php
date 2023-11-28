<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                <i class="fal fa-keyboard me-2"></i>{{$newOrigin ? 'Nova Origem' : 'Alterar Origem'}}
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div wire:loading.class="d-none" wire:loading.class.remove="d-block" wire:target="handleOrigin"
             class="modal-body">
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
                <input type="text" class="form-control" wire:model.debounce.500ms="originObject.name"/>
            </div>
            <div class="mt-2">
                <label>
                    Tipo de Autenticação:
                </label>
                <select class="form-control" wire:model="originObject.auth_type">
                    <option value="none">Nenhuma</option>
                    <option value="user_password">Usuário e Senha</option>
                    <option value="domain_user_password">Domínio, Usuário e Senha</option>
                    <option value="bearer_token">Bearer Token</option>
                    <option value="other">Outros</option>
                </select>
            </div>
            <div class="mt-2">
                <div class="border-top border-1">
                    <table class="table">
                        <tbody>
                        @if($originObject->auth_type == 'user_password')
                            <tr>
                                <td valign="middle">
                                    Usuário:
                                </td>
                                <td>
                                    <input type="text" class="form-control" wire:model.debounce.500ms="originObject.auth_config.user"/>
                                </td>
                            </tr>
                            <tr>
                                <td valign="middle">
                                    Senha:
                                </td>
                                <td>
                                    <input type="text" class="form-control" wire:model.debounce.500ms="originObject.auth_config.password"/>
                                </td>
                            </tr>
                        @elseif($originObject->auth_type == 'domain_user_password')
                            <tr>
                                <td valign="middle">
                                    Domínio:
                                </td>
                                <td>
                                    <input type="text" class="form-control" wire:model.debounce.500ms="originObject.auth_config.domain"/>
                                </td>
                            </tr>
                            <tr>
                                <td valign="middle">
                                    Usuário:
                                </td>
                                <td>
                                    <input type="text" class="form-control" wire:model.debounce.500ms="originObject.auth_config.user"/>
                                </td>
                            </tr>
                            <tr>
                                <td valign="middle">
                                    Senha:
                                </td>
                                <td>
                                    <input type="text" class="form-control" wire:model.debounce.500ms="originObject.auth_config.password"/>
                                </td>
                            </tr>
                        @elseif($originObject->auth_type == 'bearer_token')
                            <tr>
                                <td valign="middle">
                                    Bearer Token:
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <textarea class="form-control" wire:model.debounce.500ms="originObject.auth_config.bearer"></textarea>
                                </td>
                            </tr>
                        @elseif($originObject->auth_type == 'other')
                            <tr>
                                <td valign="middle">
                                    JSON Headers Esperados:
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <textarea class="form-control" wire:model.debounce.500ms="originObject.auth_config.headersJson"></textarea>
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td valign="middle" class="text-muted">
                                    Nada para configurar
                                </td>
                            </tr>
                        @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center p-4 d-none" wire:loading.class="d-block"
             wire:loading.class.remove="d-none" wire:target="handleOrigin">
            <i class="fal fa-spinner-third fa-spin"></i>
        </div>
        <div class="modal-footer">
            <button id="local__origin_form_save_button" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-primary" wire:click="validateFields">Salvar Alterações</button>
        </div>
    </div>
</div>
