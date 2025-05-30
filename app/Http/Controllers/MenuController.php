<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    /**
         * Display a listing of the resource.
         */
    public function index()
    {
        $menu = Menu::orderBy('created_at', 'DESC')->get();

        return view('menu.index', compact('menu'));
    }

    /**
         * Show the form for creating a new resource.
         */
    public function create()
    {
        return view('menu.create');
    }

    /**
         * Store a newly created resource in storage.
         */
    public function store(Request $request)
    {
        Menu::create($request->all());
        
        return redirect()->route('menu')->with('success', 'Menu added successfully');
    }

    /**
         * Display the specified resource.
         */
    public function show(string $id)
    {
        $menu = Menu::findOrFail($id);

        return view('menu.show', compact('menu'));
    }

    /**
         * Show the form for editing the specified resource.
         */
    public function edit(string $id)
    {
        $menu = Menu::findOrFail($id);

        return view('menu.edit', compact('menu'));
    }

    /**
         * Update the specified resource in storage.
         */
    public function update(Request $request, string $id)
    {
        $menu = Menu::findOrFail($id);

        $menu->update($request->all());
        
        return redirect()->route('menu')->with('success', 'Menu updated successfully');
    }

    /**
         * Remove the specified resource from storage.
         */
    public function destroy(string $id)
    {
        $menu = Menu::findOrFail($id);

        $menu->delete();

        return redirect()->route('menu')->with('success', 'Menu deleted successfully');
    }
}
