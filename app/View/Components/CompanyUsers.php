<?php

namespace App\View\Components;

use App\Models\Company;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CompanyUsers extends Component
{
    public $company;
    
    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    public function render(): View|Closure|string
    {
        return view('components.company-users');
    }
}
