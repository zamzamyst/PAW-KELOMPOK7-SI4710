<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Delivery;
use App\Models\Order;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deliveries = Delivery::with('order')->orderBy('created_at', 'DESC')->get();

        return view('delivery.index', compact('deliveries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($order_id)
    {
        $order = Order::findOrFail($order_id);
        
        // Check if delivery already exists for this order
        if ($order->delivery) {
            return redirect()->route('delivery.show', $order->delivery->id)
                ->with('info', 'Delivery sudah ada untuk order ini.');
        }

        return view('delivery.create', compact('order'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id|unique:deliveries,order_id',
            'delivery_address' => 'required|string',
            'delivery_status' => 'required|in:pending,in_transit,delivered,cancelled',
        ]);

        $delivery = Delivery::create($validated);

        return redirect()->route('delivery')->with('success', 'Delivery berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $delivery = Delivery::with(['order', 'tracking'])->findOrFail($id);

        return view('delivery.show', compact('delivery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $delivery = Delivery::with('order')->findOrFail($id);

        return view('delivery.edit', compact('delivery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $delivery = Delivery::findOrFail($id);

        $validated = $request->validate([
            'delivery_address' => 'required|string',
            'delivery_status' => 'required|in:pending,in_transit,delivered,cancelled',
        ]);

        $delivery->update($validated);
        
        return redirect()->route('delivery')->with('success', 'Delivery berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Check if user is admin
        if (!auth()->user()->hasRole('admin')) {
            return redirect()->route('delivery')->with('error', 'Hanya admin yang dapat menghapus delivery!');
        }

        $delivery = Delivery::findOrFail($id);
        $delivery->delete();

        return redirect()->route('delivery')->with('success', 'Delivery berhasil dihapus!');
    }
}
