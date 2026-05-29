<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Portfolio;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;

class AdminPortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::latest()->get();
        return view('admin.portofolios.index', compact('portfolios'));
    }

    public function create()
    {
        return view('admin.portofolios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'nullable|in:wedding,photobooth,birthday,brand',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:10240',
            'description' => 'required',
        ]);

        $imagePath = $request->file('image')->store('portfolios', 'public');
        $payload = [
            'title' => $request->title,
            'description' => $request->description,
        ];

        if (Schema::hasColumn('portfolios', 'category')) {
            $payload['category'] = $request->category;
        }

        if (Schema::hasColumn('portfolios', 'image_path')) {
            $payload['image_path'] = $imagePath;
        }

        if (Schema::hasColumn('portfolios', 'image')) {
            $payload['image'] = $imagePath;
        }

        try {
            Portfolio::create($payload);
        } catch (\Throwable $e) {
            report($e);
            return back()->withErrors(['save_error' => $e->getMessage()])->withInput();
        }

        return redirect()->route('admin.portfolios.index')->with('success', 'Portofolio berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        return view('admin.portofolios.edit', compact('portfolio'));
    }

    public function show($id)
    {
        return redirect()->route('admin.portfolios.edit', $id);
    }

    public function update(Request $request, $id)
    {
        $portfolio = Portfolio::findOrFail($id);
        
        $request->validate([
            'title' => 'required',
            'category' => 'nullable|in:wedding,photobooth,birthday,brand',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'description' => 'required',
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete([$portfolio->image_path, $portfolio->image]);
            $stored = $request->file('image')->store('portfolios', 'public');

            if (Schema::hasColumn('portfolios', 'image_path')) {
                $portfolio->image_path = $stored;
            }
            if (Schema::hasColumn('portfolios', 'image')) {
                $portfolio->image = $stored;
            }

            $portfolio->save();
        }

        $updateData = [
            'title' => $request->title,
            'description' => $request->description,
        ];

        if (Schema::hasColumn('portfolios', 'category')) {
            $updateData['category'] = $request->category;
        }

        $portfolio->update($updateData);

        return redirect()->route('admin.portfolios.index')->with('success', 'Portofolio berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        
        Storage::disk('public')->delete([$portfolio->image_path, $portfolio->image]);
        
        $portfolio->delete();
        
        return redirect()->route('admin.portfolios.index')->with('success', 'Portofolio berhasil dihapus!');
    }
}