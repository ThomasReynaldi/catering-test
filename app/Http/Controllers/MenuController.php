<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::where('merchant_id', Auth::id())->get();
        return view('menus.index', compact('menus'));
    }

    public function create()
    {
        return view('menus.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'photo' => 'required|image',
            'price' => 'required|numeric',
        ]);

        $path = $request->file('photo')->store('public/menus');

        Menu::create([
            'merchant_id' => Auth::id(),
            'name' => $request->name,
            'description' => $request->description,
            'photo' => $path,
            'price' => $request->price,
        ]);

        return redirect()->route('menus.index')->with('success', 'Menu created successfully.');
    }

    public function edit(Menu $menu)
    {
        $this->authorize('update', $menu);
        return view('menus.edit', compact('menu'));
    }

    public function update(Request $request, Menu $menu)
    {
        $this->authorize('update', $menu);

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'photo' => 'image',
            'price' => 'required|numeric',
        ]);

        if ($request->hasFile('photo')) {
            Storage::delete($menu->photo);
            $menu->photo = $request->file('photo')->store('public/menus');
        }

        $menu->update($request->only('name', 'description', 'photo', 'price'));

        return redirect()->route('menus.index')->with('success', 'Menu updated successfully.');
    }

    public function destroy(Menu $menu)
    {
        $this->authorize('delete', $menu);

        Storage::delete($menu->photo);
        $menu->delete();

        return redirect()->route('menus.index')->with('success', 'Menu deleted successfully.');
    }
}
