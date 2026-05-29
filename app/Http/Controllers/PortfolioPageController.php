<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;

class PortfolioPageController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::latest()->get();

        return view('pages.portfolio', compact('portfolios'));
    }
}
