<?php

namespace App\Http\Livewire\Services;

use App\Models\Origin;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class OriginForm extends Component
{
    public $newOrigin = true;
    public $originObject;
    public $modalStatus = '';
    public $serviceId;

    public $authConfig = [
        'domain',
        'user',
        'password',
        'bearer',
        'jsonHeaders'
        ];

    protected $listeners = [
        'global__newOriginClicked' => 'handleOriginForm',
        'global__editOriginClicked' => 'handleOriginForm',
        'local__validateOriginForm' => 'validateFields'
    ];

    protected $rules = [
        'originObject.name' => 'required|string|min:3',
        'originObject.auth_type' => 'required',
        'originObject.auth_config.domain' => [
            'required_if:originObject.auth_type,domain_user_password',
            'nullable',
            'string'
        ],
        'originObject.auth_config.user' => [
            'required_if:originObject.auth_type,domain_user_password',
            'required_if:originObject.auth_type,user_password',
            'nullable',
            'string'
        ],
        'originObject.auth_config.password' => [
            'required_if:originObject.auth_type,domain_user_password',
            'required_if:originObject.auth_type,user_password',
            'nullable',
            'string'
        ],
        'originObject.auth_config.bearer' => [
            'required_if:originObject.auth_type,bearer_token',
            'nullable',
            'string'
        ],
        'originObject.auth_config.headersJson' => [
            'required_if:originObject.auth_type,other',
            'nullable',
            'json'
        ]
    ];

    public function mount(){
        $this->originObject = new Origin();
    }

    public function render()
    {
        return view('livewire.services.origin-form');
    }


    public function handleOriginForm($selectedOrigin = false){
        if(!$selectedOrigin){
            // New Origin
            $this->originObject = new Origin();
            $this->originObject->auth_type = 'none';
            $this->newOrigin = true;
            $this->modalStatus = 'show';
        }else{
            // Select a Origin
            $this->originObject = Origin::findOrFail($selectedOrigin);
            $this->newOrigin = false;
            $this->modalStatus = 'show';
        }
    }

    public function validateFields(){
        $validatedData = $this->validate();
        $this->createOrUpdate($validatedData);
    }

    public function createOrUpdate($validatedData){
        DB::beginTransaction();
        try {
            $this->originObject->fill($validatedData);
            $this->originObject->service_id = $this->serviceId;
            $this->originObject->save();
            DB::commit();
            // Select this created origin
            $this->emit('scoped__openOriginDashboard',$this->originObject->id);
            // Reload Origin List
            $this->emit('global__forceOriginsReload');
            // Dispatch Alert
            $this->dispatchBrowserEvent('alert',['title' => 'Feito!','text' => 'A Origem foi criada com sucesso','type' => 'success','click' => 'local__origin_form_save_button']);
            return true;
        }catch (\Exception $e){
            $this->dispatchBrowserEvent('alert',['title' => 'Ops!','text' => $e->getMessage(),'type' =>'error']);
            DB::rollBack();

            return false;
        }
    }
}
