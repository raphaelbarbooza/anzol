<?php

namespace App\Http\Livewire\Services;

use App\Models\Origin;
use Livewire\Component;

class OriginList extends Component
{

    public $service;
    public $selectedOriginId;

    protected $listeners = [
        'global__forceOriginsReload' => 'render',
        'scoped__removeOrigin' => 'removeOrigin',
        'scoped__unselectOrigin' => 'unselectOrigin'
    ];

    public function render()
    {
        return view('livewire.services.origin-list');
    }

    public function selectOrigin($originId){
        // Select
        $this->selectedOriginId = $originId;
        // Emit Event
        $this->emit('scoped__openOriginDashboard',$originId);
    }

    public function removeOrigin($originId){
        // Remove Origin
        $origin = Origin::find($originId);
        $origin->delete();
        // Remove selected origin
        $this->selectedOriginId = false;
        // Reload Service
        $this->service->refresh();
        // Close Dashboard
        $this->emit('scoped__closeOriginDashboard');
    }

    public function unselectOrigin(){
        $this->selectedOriginId = false;
    }

}
