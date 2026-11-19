<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with('book')->where('user_id', auth()->id())->get();
        return view('user.cart', compact('carts'));
    }

    public function store(Request $request, Book $book)
    {
        $cart = Cart::where('user_id', auth()->id())
                    ->where('book_id', $book->id)
                    ->first();

        if ($cart) {
            $cart->increment('jumlah');
        } else {
            Cart::create([
                'user_id' => auth()->id(),
                'book_id' => $book->id,
                'jumlah' => 1,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Buku ditambahkan ke keranjang.');
    }

    public function destroy(Cart $cart)
    {
        if ($cart->user_id === auth()->id()) {
            $cart->delete();
        }
        return back()->with('success', 'Item dihapus dari keranjang.');
    }
}