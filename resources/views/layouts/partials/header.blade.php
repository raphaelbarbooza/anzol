<div class="header">
    <!-- navbar -->
    <nav class="navbar-classic navbar navbar-expand-lg">
        <a id="nav-toggle" href="#"><i
                data-feather="menu"

                class="nav-icon me-2 icon-xs"></i></a>
        <!--Navbar nav -->
        <ul class="navbar-nav navbar-right-wrap ms-auto d-flex nav-top-wrap">

            <livewire:services.add-service-button></livewire:services.add-service-button>

            <livewire:services.select-service-button></livewire:services.select-service-button>

            <li class="dropdown stopevent">
                <a class="btn btn-light btn-icon rounded-circle indicator
          indicator-primary text-muted" href="#" role="button"
                   id="dropdownNotification" data-bs-toggle="dropdown" aria-haspopup="true"
                   aria-expanded="false">
                    <i class="fad fa-browser"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end"
                     aria-labelledby="dropdownNotification">
                    <div>
                        <div class="border-bottom px-3 pt-2 pb-3 d-flex
              justify-content-between align-items-center">
                            <p class="mb-0 text-dark fw-medium fs-4">Últimos Requests</p>
                            <a href="#" class="text-muted">
                <span>
                  <i class="me-1 icon-xxs" data-feather="settings"></i>
                </span>
                            </a>
                        </div>
                        <!-- List group -->
                        <ul class="list-group list-group-flush notification-list-scroll">

                            @foreach(\App\Models\Request::orderBy('created_at','DESC')->limit(5)->get() as $item)

                                <li class="list-group-item list-group-item-action">


                                    <a href="#" class="text-muted">
                                        <h5 class=" mb-1">
                                            {{$item->forceOrigin->forceService->name}}
                                        </h5>
                                        <p class="mb-0">
                                            <span style="color: {{config('hooks.request_methods_color.'.$item->request_method)}}">
                                                {{$item->request_method}}
                                            </span>
                                            -
                                            <span class="text-muted">
                                                {{$item->created_at->format('d/m/Y H:i:s')}}
                                            </span>
                                        </p>
                                    </a>


                                </li>

                            @endforeach


                        </ul>
                    </div>
                </div>
            </li>
            <!-- List -->
            <li class="dropdown ms-2">
                <a class="rounded-circle" href="#" role="button" id="dropdownUser"
                   data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="avatar avatar-md avatar-indicators avatar-online">
                        <img alt="avatar" src="https://placekitten.com/{{implode("/",array_fill(0,1,rand(200,300)))}}"
                             class="rounded-circle"/>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end"
                     aria-labelledby="dropdownUser">
                    <div class="px-4 pb-0 pt-2">


                        <div class="lh-1 ">
                            <h5 class="mb-1">
                                {{\Illuminate\Support\Facades\Auth::user()->name}}
                            </h5>
                        </div>
                        <div class=" dropdown-divider mt-3 mb-2"></div>
                    </div>

                    <ul class="list-unstyled">
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="me-2 icon-xxs dropdown-item-icon"
                                   data-feather="power"></i>Sair
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>

                </div>
            </li>
        </ul>
    </nav>
</div>
