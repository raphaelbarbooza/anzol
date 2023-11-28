<?php

namespace App\Http\Livewire;

use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ServicePage extends Component
{
    public $selectedService = false;

    protected $listeners = [
        'global__selectService' => 'selectService',
        'scoped__removeService' => 'removeService'
    ];

    public function render()
    {
        // Get the selected service
        $this->selectedService = Service::find(Auth()->user()->selected_service);
        return view('livewire.service-page');
    }

    public function selectService($id){
        // Update Selected Service from user
        $user = Auth::user();
        $user->selected_service = $id;
        $user->save();
        // Close the dashboard
        $this->emit('scoped__closeOriginDashboard');
        // Let's the render flows...
    }

    public function askForRemoveService(){
        $this->dispatchBrowserEvent('confirmServiceRemove',[
            'title' => $this->selectedService->name,
            'id' => $this->selectedService->id
        ]);
    }

    public function removeService($id){
        // Delete
        $service = Service::find($id);
        $service->delete();
        // Unselect everything
        $this->selectedService = false;
        // Close Origin Dashboard
        $this->emit('scoped__closeOriginDashboard');
        // Reload Services Selection
        $this->emit('global__reloadServiceSelectionList');
        // Dispatch Alert
        $this->dispatchBrowserEvent('alert',[
            'title' => "Feito!",
            'text' => "Serviço removido / desativado com sucesso.",
            'type' => 'success'
        ]);
    }
}
