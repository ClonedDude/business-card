<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\ExternalLinkType;

class ExternalLinkTypeTable extends DataTableComponent
{
    protected $model = ExternalLinkType::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->useComputedPropertiesDisabled();
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Name", "name")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
            Column::make('Action', 'id')
                ->format(
                    function ($value, $row, Column $column) {
                        $edit_button
                            = '<a href="'.route('external-link-types.edit', $row->id).'" class="btn btn-sm btn-info me-2 mb-4">
                                <i class="fas fa-edit"></i>
                                Edit
                            </a>';

                        $delete_button
                            = '<form class="delete-training-form" action="'.route('external-link-types.delete', $row->id).'" method="POST">
                                '.csrf_field().'
                                <button type="submit" class="btn btn-sm btn-danger me-2 mb-4"> 
                                <i class="fas fa-trash"></i>
                                Delete</button>
                            </form>';

                        $html = "<div class='d-flex flex-row'>
                            $edit_button
                            $delete_button
                        </div>";

                        return $html;
                    }
                )
                ->html(),
        ];
    }
}
