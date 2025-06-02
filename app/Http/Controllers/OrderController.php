<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order; 
use App\Models\Menu; 

class OrderController extends Controller {

    // Fungsi untuk Read (All) Data Order
    public function index()
    {
        $order = Order::orderBy('created_at', 'DESC')->get();
        return view('order.index', compact('order'));
    }

    // Fungsi untuk Create Order (By $menu_code)
    public function create($menu_code)
    {
        $menu = Menu::where('menu_code', $menu_code)->firstOrFail();
        return view('order.create', compact('menu'));
    }

    // Fungsi untuk Save Data Order
    public function store(Request $request)
    {
        $request->validate([
            'menu_code' => 'required|exists:menus,menu_code',
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string',
        ]);

        $menu = Menu::where('menu_code', $request->menu_code)->first();

        Order::create([
            'menu_code' => $menu->menu_code,
            'name' => $menu->name,
            'price' => $menu->price,
            'quantity' => $request->quantity,
            'notes' => $request->notes,
        ]);

        Feedback::create([
        'order_id' => $order->id,
        'rating' => null,
        'comment' => null,
        ]);
        
        return redirect()->route('menu')->with('success', 'Menu berhasil dipesan!');
    }

    // Fungsi untuk Read Data Order (By $id)
    public function show(string $id)
    {
        $order = Order::findOrFail($id);
        return view('order.show', compact('order'));
    }

    // Fungsi untuk Edit Data Order (By $id)
    public function edit(string $id)
    {
        $order = Order::findOrFail($id);
        return view('order.edit', compact('order'));
    }

    // Fungsi untuk Simpan Perubahasn Data Order
    public function update(Request $request, string $id)
    {
        $order = Order::findOrFail($id);
        $order->update($request->all());
        
        return redirect()->route('order')->with('success', 'Order berhasil diperbarui!');
    }

    // Fungsi untuk Delete Data Order (By $id)
    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('order')->with('success', 'Order berhasil dihapus!');
    }
}
