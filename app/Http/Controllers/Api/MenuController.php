<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Menu;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::with('children')->whereNull('parent_id')->get();
        return response()->json(['menus' => $menus], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'icon' => 'required|string',
            'route' => 'nullable|string',
            'parent_id' => 'nullable|exists:menus,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $menu = Menu::create($request->all());
        return response()->json(['menu' => $menu], 201);
    }

    public function show($id)
    {
        $menu = Menu::with('children')->find($id);
        if (!$menu) {
            return response()->json(['error' => 'Menu not found'], 404);
        }
        return response()->json(['menu' => $menu], 200);
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::find($id);
        if (!$menu) {
            return response()->json(['error' => 'Menu not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'icon' => 'required|string',
            'route' => 'nullable|string',
            'parent_id' => 'nullable|exists:menus,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $menu->update($request->all());
        return response()->json(['menu' => $menu], 200);
    }

    public function destroy($id)
    {
        $menu = Menu::find($id);
        if (!$menu) {
            return response()->json(['error' => 'Menu not found'], 404);
        }

        $menu->delete();
        return response()->json(['message' => 'Menu deleted successfully'], 200);
    }
}
