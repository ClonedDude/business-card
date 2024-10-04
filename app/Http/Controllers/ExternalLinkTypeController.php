<?php

namespace App\Http\Controllers;

use App\Models\ExternalLinkType;
use App\Services\ExternalLinkTypeService;
use Illuminate\Http\Request;

class ExternalLinkTypeController extends Controller
{
    public function index()
    {
        return view("pages.external-link-type.index");
    }

    public function show($id)
    {
        $external_link_type = ExternalLinkType::findOrFail($id);

        return view("pages.external-link-type.show", compact("external_link_type"));
    }

    public function create()
    {
        return view("pages.external-link-type.create");
    }

    public function store(Request $request, ExternalLinkTypeService $externalLinkTypeService)
    {
        $external_link_type = $externalLinkTypeService->createExternalLinkType($request->all());

        return redirect(route("external-link-types.index"))
            ->with("success", "external-link-types created successfully");
    }

    public function edit(int $id)
    {
        $external_link_type = ExternalLinkType::find($id);

        return view("pages.external-link-type.edit", compact("external_link_type"));
    }

    public function update(Request $request, ExternalLinkTypeService $externalLinkTypeService, int $id)
    {
        $external_link_type = $externalLinkTypeService->updateExternalLinkType($id, $request->all());

        return redirect(route("external-link-types.index"))
            ->with("success", "external-link-types updated successfully");
    }

    public function delete(Request $request, ExternalLinkTypeService $externalLinkTypeService, int $id)
    {
        $externalLinkTypeService->deleteExternalLinkType($id);

        return redirect(route("external-link-types.index"))
            ->with("success", "external-link-types deleted successfully");
    }
}
