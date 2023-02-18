<?php

namespace App\Http\Controllers;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('home.index');
    }

    public function about(): View
    {
        $data1 = "About us - Online Store"; 
        $data2 = "About us"; 
        $description = "This is an about page ..."; 
        $author = "Developed by: Juan Manuel"; 
        return view('home.about')
            ->with("title", $data1) 
            ->with("subtitle", $data2) 
            ->with("description", $description) 
            ->with("author", $author); 
    }

    public function contact(): View
    {
        $data1 = "Contact us - Online Store"; 
        $data2 = "Contact us"; 
        $email = "contact@gmail.com";
        $phone = "+573147786648";
        $address = "Crra. 50 FF #5 Sur 23 - Andorra, Cañamos";
        return view('home.contact')
            ->with("title", $data1) 
            ->with("subtitle", $data2) 
            ->with("email", $email) 
            ->with("phone", $phone) 
            ->with("address", $address); 
    }
}