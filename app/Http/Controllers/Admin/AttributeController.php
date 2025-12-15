<?php

namespace App\Http\Controllers\Admin;

use App\Models\Attribute;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeRequest;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attributes = Attribute::paginate(10);

        return view('admin.attributes.index', compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.attributes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AttributeRequest $request)
    {
        Attribute::addAttribute($request->validated());

        return to_route('attribute.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $attribute = Attribute::selectAttribute($id);
        return view('admin.attributes.edit', compact('attribute'));   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AttributeRequest $request, $id)
    {
        Attribute::updateAttribute($request->validated(), $id);

        return to_route('attribute.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Attribute::deleteAttribute($id);

        return to_route('attribute.index');
    }
}
