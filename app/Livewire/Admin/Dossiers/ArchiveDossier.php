<?php

namespace App\Livewire\Admin\Dossiers;

use Illuminate\Support\Facades\Gate;
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
        if (auth()->user()->hasRole('company')) {
            $this->company_user = auth()->user()->id;
        }
    }


    public function ChangeActive_dossier(Dossier $dossier)
    {
        Gate::authorize('dossier-active-status');

        $dossier->update([
            "is_active" => !$dossier->is_active
        ]);
    }

    public function ChangeArchive_dossier(Dossier $dossier)
    {
        Gate::authorize('dossier-archive-status');

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
        $company_users = User::Role('company')->when(auth()->user()->hasRole('company'), function ($query) {
            $query->where('id', auth()->user()->id);
        })->get();

        $dossiers = Dossier::where('is_archive', true)->whereAny(['name', 'number_dossier'], 'like', '%' . $this->title . '%')->when(!auth()->user()->hasRole(['Super Admin', 'company']), function ($query) {
            $query->where('laboratory_id', auth()->user()->laboratory_id);
        })->when($this->company_user != '', function ($query) {
            $query->where('user_category_id', $this->company_user);
        })->when(auth()->user()->hasRole('company'), function ($query) {
            $query->where('user_category_id', auth()->user()->id);
        })->when($this->is_active != '', function ($query) {
            $query->where('is_active', $this->is_active);
        })->latest()->paginate(10);

        return view('livewire.admin.dossiers.archive-dossier', compact(['dossiers', 'company_users']))->extends('admin.layout.MasterAdmin')->section('Content');
    }
}
