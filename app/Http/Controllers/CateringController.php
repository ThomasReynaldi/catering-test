<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\MerchantProfile;
use Illuminate\Http\Request;

class CateringController extends Controller
{
    /**
     * Menampilkan semua menu dari semua merchant.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $menus = Menu::with('merchant')->get();

        return view('catering.index', compact('menus'));
    }
}
