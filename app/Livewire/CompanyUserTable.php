<?php

namespace App\Livewire;

use App\Models\Company;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class CompanyUserTable extends DataTableComponent
{
    protected $model = User::class;
    public $company;

    public function mount(Company $company)
    {
        $this->company = $company;
    }

    public function builder(): Builder
    {
        $user_ids = $this->company->users()->pluck("users.id");

        return User::query()
            ->whereIntegerInRaw("id", $user_ids);
            // ->with() // Eager load anything
            // ->join() // Join some tables
            // ->select(); // Select some things
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Name", "name")
                ->sortable(),
            Column::make("Email", "email")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
