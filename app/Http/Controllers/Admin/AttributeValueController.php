<?php

namespace App\Http\Controllers\Admin;

use App\Models\Attribute;
use Illuminate\Http\Request;
use App\Models\AttributeValue;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeValueRequest;

class AttributeValueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $values = AttributeValue::with('attribute')->paginate(20);
        return view('admin.attribute_values.index', compact('values'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $attributes = Attribute::all();
        return view('admin.attribute_values.create', compact('attributes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AttributeValueRequest $request)
    {
        AttributeValue::createValue($request->validated());

        return to_route('attribute_values.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AttributeValue $attributeValue)
    {
        $attributes = Attribute::all();
        return view('admin.attribute_values.edit', compact('attributeValue', 'attributes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AttributeValueRequest $request, AttributeValue $attributeValue)
    {
        $attributeValue->updateValue($request->validated());

        return to_route('attribute_values.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AttributeValue $attributeValue)
    {
        $attributeValue->delete();
        return to_route('attribute_values.index');
    }
}
