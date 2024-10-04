<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view("welcome");
    }

    public function show($id)
    {
        $contact = Order::findOrFail($id);

        return view("welcome", compact("contact"));
    }

    public function create()
    {
        return view("welcome");
    }

    public function store(Request $request, OrderService $contactService)
    {
        $contact = $contactService->createOrder($request->all());

        return redirect(route("orders.index"))
            ->with("success", "contact created successfully");
    }

    public function edit()
    {
        return view("welcome");
    }

    public function update(Request $request, OrderService $contactService, int $id)
    {
        $contact = $contactService->updateOrder($id, $request->all());

        return redirect(route("orders.index"))
            ->with("success", "contact updated successfully");
    }

    public function delete(Request $request, OrderService $contactService, int $id)
    {
        $contactService->deleteOrder($id);

        return redirect(route("orders.index"))
            ->with("success", "contact deleted successfully");
    }
}
