<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Order;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalBuku' => Book::count(),
            'totalKategori' => Category::count(),
            'totalUser' => User::where('role', 'user')->count(),
            'totalOrder' => Order::count(),
        ]);
    }

    public function users()
    {
        $users = User::where('role', 'user')->latest()->get();
        return view('admin.users', compact('users'));
    }

    public function orders()
    {
        $orders = Order::with(['user', 'items.book'])->latest()->get();
        return view('admin.orders', compact('orders'));
    }

    public function contacts()
    {
        $contacts = Contact::latest()->get();
        return view('admin.contacts', compact('contacts'));
    }
}