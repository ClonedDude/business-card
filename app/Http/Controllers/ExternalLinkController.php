<?php

namespace App\Http\Controllers;

use App\Models\ExternalLink;
use App\Services\ExternalLinkService;
use Illuminate\Http\Request;

class ExternalLinkController extends Controller
{
    public function index()
    {
        return view("welcome");
    }

    public function show($id)
    {
        $external_link = ExternalLink::findOrFail($id);

        return view("welcome", compact("external_link"));
    }

    public function create()
    {
        return view("welcome");
    }

    public function store(Request $request, ExternalLinkService $externalLinkService)
    {
        $external_link = $externalLinkService->createExternalLink($request->all());

        return redirect(route("external-link-types.index"))
            ->with("success", "external-link-types created successfully");
    }

    public function edit()
    {
        return view("welcome");
    }

    public function update(Request $request, ExternalLinkService $externalLinkService, int $id)
    {
        $external_link = $externalLinkService->updateExternalLink($id, $request->all());

        return redirect(route("external-link-types.index"))
            ->with("success", "external-link-types updated successfully");
    }

    public function delete(Request $request, ExternalLinkService $externalLinkService, int $id)
    {
        $externalLinkService->deleteExternalLink($id);

        return redirect(route("external-link-types.index"))
            ->with("success", "external-link-types deleted successfully");
    }
}
