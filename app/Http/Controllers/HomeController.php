<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Tamu (belum login) → tampilkan halaman landing/welcome
        if (!auth()->check()) {
            return view('welcome');
        }

        $query = Book::with('category');

        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%')
                  ->orWhere('penulis', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $books = $query->latest()->get();
        $categories = Category::all();

        return view('user.home', compact('books', 'categories'));
    }

    public function about()
    {
        return view('user.about');
    }
}