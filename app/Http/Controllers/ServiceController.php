<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the services.
     */
    public function index()
    {
        $services = Service::all();
        return view('pages.services-index', compact('services'));
    }

    /**
     * Display the specified service.
     */
    public function show($slug)
    {
        $service = Service::findBySlug($slug);
        if (! $service) {
            abort(404);
        }
        
        $viewName = "pages.services.{$slug}";
        if (view()->exists($viewName)) {
            return view($viewName, compact('service'));
        }
        
        return view('pages.service-detail', compact('service'));
    }
}