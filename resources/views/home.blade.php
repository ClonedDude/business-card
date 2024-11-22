@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center px-4">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        {{ __('Dashboard') }}
                    </div>
                </div>

                <div class="card-body">
                    {{  $user->name }}
                    {{  $user->id }}
                    @foreach ($companyUsers as $companyUser)
                    <li>
                        Company id: {{ $companyUser->id }} - User id: {{ $companyUser->user_id ?? 'N/A' }}
                    </li>
                     @endforeach
                     <p>
                   {{ $user->roles }}
                     </p>
                   @can('contacts.view')
                       Can
                   @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
