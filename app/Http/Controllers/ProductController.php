<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        $productos = Product::all();
        return view('products', compact('productos'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('productcreate', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'image' => 'required',
            'category_id' => 'required'
        ]);

        Product::create($request->all());

        return redirect()->route('products.index');
    }

    public function edit($id)
    {
        $producto = Product::findOrFail($id);
        $categories = Category::all();
        dump($producto);
    dump($id);
        return view('productedit', compact('producto', 'categories'));
    }
    

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'image' => 'required',
            'category_id' => 'required'
        ]);
    
        $producto = Product::findOrFail($id);
        $producto->update($request->all());
        return redirect()->route('products.index')->with('success', 'Producto actualizado exitosamente');
    }
    

public function destroy($id)
{
    $producto = Product::findOrFail($id);
    $producto->delete();
    return redirect()->route('products.index')->with('success', 'Producto eliminado exitosamente');
}


}
