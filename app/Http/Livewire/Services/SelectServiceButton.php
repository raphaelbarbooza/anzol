<?php

namespace App\Http\Livewire\Services;

use App\Models\Service;
use Livewire\Component;

class SelectServiceButton extends Component
{

    public $filter = '';

    protected $listeners = [
        'global__reloadServiceSelectionList' => 'render'
    ];

    public function render()
    {
        return view('livewire.services.select-service-button',[
            'services' => Service::where('name','LIKE','%'.$this->filter.'%')->limit(5)->get()
        ]);
    }

    public function select($id){
        $this->emit('global__selectService', $id);
    }
}
