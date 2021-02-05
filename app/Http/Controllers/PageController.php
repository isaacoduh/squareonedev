<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return view('pages.index');
    }

    public function getExtenal()
    {
        return view('pages.external');
    }

    public function about()
    {
        $title = 'Square Blog Code Test';

        $data = [];
        $data['title'] = $title;

        return view('pages.about', compact($data));
    }

    public function info()
    {
    }
}
