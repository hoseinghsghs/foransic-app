<?php

namespace App\Livewire\Admin\Dossiers;
use Livewire\Component;
use App\Models\Dossier;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class ArchiveDossier extends Component
{
    use WithFileUploads, WithPagination;

    public $dossier;

    protected $paginationTheme = 'bootstrap';
    public $title = '';
    public $company_user = '';
    public $is_active = '';

    public function updatingTitle()
    {
        $this->resetPage();
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function updatingIsActive()
    {
        $this->resetPage();
    }

    protected $listeners = [
        'sweetAlertConfirmed', // only when confirm button is clicked
    ];

    public function mount(Dossier $dossier)
    {

    }


    public function ChangeActive_dossier(Dossier $dossier)
    {
        $dossier->update([
            "is_active" => !$dossier->is_active
        ]);
    }

    public function ChangeArchive_dossier(Dossier $dossier)
    {
        $dossier->update([
            "is_archive" => false
        ]);
    }

       public function export()
    {
        return Storage::disk('exports')->download('export.csv');
    }
    public function render()
    {
        $company_users = User::Role('company')->get();
        $dossiers = Dossier::where('is_archive',true)->whereAny(['name', 'number_dossier'], 'like', '%' . $this->title . '%')
            ->when($this->company_user != '', function ($query) {
                $query->where('user_category_id', $this->company_user);
            })
            ->when($this->is_active != '', function ($query) {
                $query->where('is_active', $this->is_active);
            })->latest()->paginate(10);

        return view('livewire.admin.dossiers.archive-dossier', compact(['dossiers', 'company_users']));
    }
}
