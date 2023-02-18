<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    public static $products = [
        ["id"=>"1", "name"=>"TV",         "description"=>"Best TV",         "price"=>400],
        ["id"=>"2", "name"=>"iPhone",     "description"=>"Best iPhone",     "price"=>1100],
        ["id"=>"3", "name"=>"Chromecast", "description"=>"Best Chromecast", "price"=>56],
        ["id"=>"4", "name"=>"Glasses",    "description"=>"Best Glasses",    "price"=>10]
    ];

    public function index(): View
    {
        $viewData = [];
        $viewData["title"] = "Products - Online Store";
        $viewData["subtitle"] = "List of products";
        $viewData["products"] = ProductController::$products;

        return view('product.index')->with("viewData", $viewData);
    }

    public function show(string $id) : View  | RedirectResponse
    {

        // Checks if $id is an intenger
        if (filter_var($id, FILTER_VALIDATE_INT) == true) {      
            // Checks if $id is on bounds  
            if($id > 0 && $id <= count(ProductController::$products)){
                $viewData = [];
                $product = ProductController::$products[$id-1];
                $viewData["title"] = $product["name"]." - Online Store";
                $viewData["subtitle"] = $product["name"]." - Product information";
                $viewData["product"] = $product;

                return view('product.show')->with("viewData", $viewData);
            }
        }

        return redirect()->route('home.index');
    }

    public function create(): View
    {
        $viewData = []; //to be sent to the view
        $viewData["title"] = "Create product";

        return view('product.create')->with("viewData",$viewData);
    }

    public function save(Request $request) : View
    {
        $request->validate([
            "name" => "required",
            "price" => "gt:0"      // Greater than 0
        ]);

        $viewData = [];
        $viewData["title"]    = "Successfull - Online Store";
        $viewData["subtitle"] = "Product created successfully";
        $viewData["name"]     = $request["name"];
        $viewData["price"]    = $request["price"];

      
        return view('product.save')->with("viewData", $viewData);
    }
}
