<?php

namespace App\Http\Livewire\Services\Origin;

use App\Models\Origin;
use App\Models\Request;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{
    public $selectedOrigin = false;
    use WithPagination;

    public $filterMethod = 'any';
    public $filterIp = '';
    public $filterStatus = 'any';
    public $filterOlderThan;

    public $selectedRequest;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'scoped__openOriginDashboard' => 'loadOrigin',
        'global__forceOriginsReload' => 'refreshData',
        'scoped__closeOriginDashboard' => 'closeDashboard'
    ];

    public function render()
    {
        // Filter
        if ($this->selectedOrigin) {
            $requests = $this->selectedOrigin->requests();

            // Filter by Methods
            if (in_array($this->filterMethod, ['POST', 'GET', 'PATCH', 'PUT', 'DELETE', 'OPTIONS']))
                $requests->where('request_method', $this->filterMethod);

            // Filter by Date
            $requests->where('created_at', '<=', $this->filterOlderThan);

            // Filter by Status
            if ($this->filterStatus != 'any')
                $requests->where('status', $this->filterStatus);

            // Filter by IP
            if ($this->filterIp)
                $requests->where('request_ip', 'LIKE', '%' . $this->filterIp . '%');

            // Paginate
            $requests = $requests->orderBy('created_at','DESC')->paginate(10);

        } else {
            $requests = [];
        }
        return view('livewire.services.origin.dashboard', [
            'requests' => $requests
        ]);
    }

    public function loadOrigin($originId)
    {
        $this->selectedOrigin = Origin::find($originId);
        // Reset Filters
        $this->resetFilters();
        // Select a Empty Request
        $this->selectedRequest = new Request();
    }

    public function refreshData()
    {
        $this->selectedOrigin->refresh();
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->filterIp = '';
        $this->filterMethod = 'any';
        $this->filterStatus = 'any';
        $this->filterOlderThan = Carbon::now()->addDay(1)->format('Y-m-d');
    }

    public function selectRequest($requestId)
    {
        $this->selectedRequest = Request::find($requestId);
        $this->dispatchBrowserEvent('updateJsonViewer', [
            'jsonData' => json_encode($this->selectedRequest->request_data),
            'jsonBody' => json_encode($this->selectedRequest->request_body)
        ]);
    }

    public function askForOriginRemove()
    {
        $this->dispatchBrowserEvent('confirmOriginRemove', [
            'title' => $this->selectedOrigin->name,
            'id' => $this->selectedOrigin->id
        ]);
    }

    public function closeDashboard(){
        $this->selectedOrigin = false;
        // Unselect a Origin
        $this->emit('scoped__unselectOrigin');
    }

}
