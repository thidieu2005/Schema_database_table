<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    function getIndex()
    {
        return view('page.trangchu');
    }
    public function getLogin()
    {
        return view('page.login');
    }
    public function getShop()
    {
        return view('page.shop');
    }

    public function geDetail()
    {
        return view('page.detail');
    }

    public function getContact()
    {
        return view('page.contact');
    }
    public function getCheckout()
    {
        return view('page.checkout');
    }
    public function getCart()
    {
        return view('page.cart');
    }
    public function getBlog()
    {
        return view('page.blog');
    }
    public function getBlogsingle()
    {
        return view('page.blog_single');
    }
}
