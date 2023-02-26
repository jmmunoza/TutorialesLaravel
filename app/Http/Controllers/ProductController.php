<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = 'Products - Online Store';
        $viewData['subtitle'] = 'List of products';
        $viewData['products'] = Product::all();

        return view('product.index')->with('viewData', $viewData);
    }

    public function show(string $id): View|RedirectResponse
    {
        // Checks if $id is an intenger
        if (filter_var($id, FILTER_VALIDATE_INT) == true) {
            // Checks if $id is on bounds

            $viewData = [];
            $product = Product::findOrFail($id);
            $viewData['title'] = $product['name'].' - Online Store';
            $viewData['subtitle'] = $product['name'].' - Product information';
            $viewData['product'] = $product;

            return view('product.show')->with('viewData', $viewData);
        }

        return redirect()->route('home.index');
    }

    public function create(): View
    {
        $viewData = []; //to be sent to the view
        $viewData['title'] = 'Create product';

        return view('product.create')->with('viewData', $viewData);
    }

    public function save(Request $request): View|RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'price' => 'gt:0',      // Greater than 0
        ]);

        Product::create($request->only(['name', 'price']));

        return back();
    }
}
