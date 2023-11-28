<div class="container-fluid p-6">
    @if($selectedService)
        <div class="row align-items-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                <!-- Bg -->
                <div class="pt-20 rounded-top animated-gradient-bg">
                </div>
                <div class="bg-white rounded-bottom smooth-shadow-sm ">
                    <div class="d-flex align-items-center justify-content-between
                  pt-4 pb-6 px-4">
                        <div class="d-flex align-items-center">
                            <!-- avatar -->
                            <div class="avatar-xxl me-2
                      position-relative d-flex justify-content-end
                      align-items-end mt-n10">
                                <img src="{{$selectedService->image_url}}" class="avatar-xxl
                        rounded-circle border border-4 border-white-color-40 bg-white" alt="">
                            </div>
                            <!-- text -->
                            <div class="lh-1">
                                <h2 class="mb-0">
                                    {{$selectedService->name}}
                                    <button data-bs-toggle="modal" data-bs-target="#serviceForm" class="btn btn-outline-primary ms-3" wire:click="$emit('global__editServiceClicked','{{$selectedService->id}}')">
                                        <i class="fal fa-edit"></i>
                                    </button>
                                </h2>
                                <div class="accordion accordion-flush" id="descriptionAccordion">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingOne">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-description" aria-expanded="false">
                                                Descrição
                                            </button>
                                        </h2>
                                        <div id="flush-description" class="accordion-collapse collapse" data-bs-parent="#descriptionAccordion">
                                            <div class="accordion-body">
                                                {{$selectedService->description}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <a href="#" class="btn btn-outline-danger" wire:click="askForRemoveService">
                                <i class="far fa-trash me-2"></i>
                                Remover Serviço
                            </a>
                        </div>
                    </div>
                    <!-- nav -->
                    <livewire:services.origin-list wire:key="services-{{$selectedService->id}}" :service="$selectedService"></livewire:services.origin-list>
                </div>
            </div>
        </div>
        <!-- content -->
        <livewire:services.origin.dashboard></livewire:services.origin.dashboard>
    @else
        <div class="bg-light fs-4 p-4 border rounded text-center">
            Selecione um Serviço
        </div>
    @endif
</div>
