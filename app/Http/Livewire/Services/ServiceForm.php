<?php

namespace App\Http\Livewire\Services;

use App\Models\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ServiceForm extends Component
{

    use WithFileUploads;

    public $newService = true;
    public $serviceObject;

    public $image;

    protected $listeners = [
        'global__newServiceClicked' => 'handleServiceForm',
        'global__editServiceClicked' => 'handleServiceForm',
        'local__validateServiceForm' => 'validateFields'
    ];

    protected $rules = [
        'serviceObject.name' => 'required|string|min:3',
        'serviceObject.description' => 'sometimes|nullable|string',
        'image' => 'sometimes|nullable|image|max:512|dimensions:min_width=90,min_height=90,max_width=800,max_height=800'
    ];

    public function render()
    {
        return view('livewire.services.service-form');
    }

    public function handleServiceForm($selectedService = false){
        if(!$selectedService){
            // New Origin
            $this->serviceObject = new Service();
            $this->newService = true;
        }else{
            // Select a Origin
            $this->serviceObject = Service::findOrFail($selectedService);
            $this->newService = false;
        }
    }

    public function validateFields(){
        $validatedData = $this->validate();
        $this->createOrUpdate($validatedData);
    }

    public function createOrUpdate($validatedData){
        DB::beginTransaction();
        try {
            $this->serviceObject->fill($validatedData['serviceObject']);
            // Check image
            if(isset($validatedData['image']) && $validatedData['image']){
                // Upload the imagem
                $uploadedImage = $validatedData['image']->store('/images');
                // Get URL
                $this->serviceObject->image_url = url($uploadedImage);
            }
            $this->serviceObject->save();
            DB::commit();
            $this->dispatchBrowserEvent('alert',['title' => 'Feito!','text' => 'O serviço foi criado com sucesso.','type' => 'success','click' => 'local__service_form_save_button']);
            $this->emit('global__selectService',$this->serviceObject->id);
            return true;
        }catch (\Exception $e){
            $this->dispatchBrowserEvent('alert',['title' => 'Ops!','text' => $e->getMessage(),'type' =>'error']);
            DB::rollBack();

            return false;
        }
    }

}
