<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        $request->validate(['alamat_pengiriman' => 'required|string']);

        $carts = Cart::with('book')->where('user_id', auth()->id())->get();
        if ($carts->isEmpty()) {
            return back()->with('error', 'Keranjang belanja masih kosong.');
        }

        $totalHarga = $carts->sum(fn($item) => $item->book->harga * $item->jumlah);
        $kodeInvoice = 'INV-' . time() . '-' . auth()->id();

        $order = Order::create([
            'user_id' => auth()->id(),
            'kode_invoice' => $kodeInvoice,
            'total_harga' => $totalHarga,
            'status_pembayaran' => 'pending',
            'alamat_pengiriman' => $request->alamat_pengiriman,
        ]);

        foreach ($carts as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'book_id' => $item->book_id,
                'jumlah' => $item->jumlah,
                'harga_satuan' => $item->book->harga,
            ]);
        }

        // Kosongkan keranjang belanja
        Cart::where('user_id', auth()->id())->delete();

        // Redirect ke detail pesanan untuk simulasi bayar
        return redirect()->route('orders.show', $order->id)
                         ->with('success', 'Pesanan berhasil dibuat! Silakan konfirmasi simulasi pembayaran.');
    }

    public function show(Order $order)
    {
        abort_if($order->user_id !== auth()->id(), 403);
        return view('user.payment', compact('order'));
    }

    public function pay(Order $order)
    {
        return $this->show($order);
    }

    public function simulatePay(Order $order)
    {
        abort_if($order->user_id !== auth()->id(), 403);

        if ($order->status_pembayaran !== 'paid') {
            $order->update(['status_pembayaran' => 'paid']);
            foreach ($order->items as $item) {
                $item->book->decrement('stok', $item->jumlah);
            }
        }

        return redirect()->route('orders.show', $order->id)
                         ->with('success', 'Simulasi Pembayaran Berhasil! Status pesanan kini LUNAS / PAID dan stok buku telah berkurang.');
    }

    public function success(Order $order)
    {
        return $this->simulatePay($order);
    }

    public function myOrders()
    {
        $orders = Order::with('items.book')->where('user_id', auth()->id())->latest()->get();
        return view('user.orders', compact('orders'));
    }
}
