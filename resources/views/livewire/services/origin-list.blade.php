
<div>

    <ul class="nav nav-lt-tab px-4" id="pills-tab" role="tablist">
        @forelse($service->origins as $origin)
            <li class="nav-item" wire:click="selectOrigin('{{$origin->id}}')">
                <a class="nav-link {{($origin->id == $selectedOriginId ? 'active' : '')}}" href="#" wire:key="nav-{{$origin->id}}">
                    {{$origin->name}}
                </a>
            </li>
        @empty
            <li class="d-flex align-items-center text-muted me-3">
                <i class="fal fa-empty-set me-2"></i> Nenhuma origem cadastrada
            </li>
        @endforelse

        <li class="btn btn-light rounded-0">
            <a class="nav-link" href="#" wire:click="$emit('global__newOriginClicked')" data-bs-toggle="modal" data-bs-target="#originFormModal">
                <i class="fas fa-plus me-2"></i>
                Adicionar Origem
            </a>
        </li>
    </ul>

    <div class="modal fade" id="originFormModal" tabindex="-1" wire:ignore.self>
        <livewire:services.origin-form service-id="{{$service->id}}"></livewire:services.origin-form>
    </div>
</div>
