<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        // Ambil semua order yang terkait dengan customer atau merchant yang sedang login
        $orders = Order::where('customer_id', Auth::id())
                       ->orWhere('merchant_id', Auth::id())
                       ->get();

        return view('orders.index', compact('orders'));
    }

    public function customerOrders()
    {
        // Ambil semua order yang terkait dengan customer yang sedang login
        $orders = Order::where('customer_id', Auth::id())->get();

        return view('orders.customer_orders', compact('orders'));
    }

    public function merchantOrders()
    {
        // Ambil semua order yang terkait dengan merchant yang sedang login
        $orders = Order::where('merchant_id', Auth::id())->get();

        return view('orders.merchant_orders', compact('orders'));
    }

    public function store(Request $request)
    {
        // Validasi input dari form order
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'quantity' => 'required|integer|min:1',
            'delivery_date' => 'required|date',
        ]);

        // Ambil data menu berdasarkan ID
        $menu = Menu::findOrFail($request->input('menu_id'));

        // Hitung total amount berdasarkan quantity dan harga menu
        $totalAmount = $menu->price * $request->input('quantity');

        // Simpan order baru ke dalam database
        $order = Order::create([
            'customer_id' => Auth::id(),
            'merchant_id' => $menu->merchant_id,
            'menu_id' => $menu->id,
            'quantity' => $request->input('quantity'),
            'total_amount' => $totalAmount,
            'delivery_date' => $request->input('delivery_date'),
            'status' => 'pending',
            'invoice_number' => 'INV-' . date('Ymd') . '-' . uniqid(),
            'invoice_date' => now(),
        ]);

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    public function show(Order $order)
    {
        if ($order->customer_id !== Auth::id() && $order->merchant_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        return view('orders.show', compact('order'));
    }

    public function showOrderForm(Menu $menu)
    {
        return view('catering.order_form', compact('menu'));
    }

    public function edit(Order $order)
    {
        // Logika untuk menampilkan form edit order (jika diperlukan)
    }

    public function update(Request $request, Order $order)
    {
        // Validasi input dari form update order
        $request->validate([
            'total_amount' => 'required|numeric|min:0',
        ]);

        // Simpan perubahan order ke dalam database
        $order->update([
            'total_amount' => $request->input('total_amount'),
        ]);

        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    public function destroy(Order $order)
    {
        // Hapus order dari database
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }
}
