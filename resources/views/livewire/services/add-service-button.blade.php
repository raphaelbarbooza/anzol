<div>
    <li class="me-3">
        <a class="btn btn-light text-muted" data-bs-toggle="modal" data-bs-target="#serviceForm" wire:click="$emit('global__newServiceClicked')">
            <i class="fal fa-plus me-2"></i>
            Adicionar Serviço
        </a>
    </li>

    <div class="modal fade" id="serviceForm" wire:ignore.self>
        <livewire:services.service-form></livewire:services.service-form>
    </div>

</div>
