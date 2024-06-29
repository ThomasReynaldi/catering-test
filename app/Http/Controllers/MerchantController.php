<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MerchantProfile;
use Illuminate\Support\Facades\Auth;

class MerchantController extends Controller
{
    public function dashboard()
    {
        return view('merchant.dashboard');
    }

    public function orders()
    {
        return view('merchant.orders');
    }

    public function profile()
    {
        $merchantProfile = MerchantProfile::where('user_id', Auth::id())->first();
        return view('merchant.profile', compact('merchantProfile'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $merchantProfile = MerchantProfile::where('user_id', Auth::id())->first();
        if ($merchantProfile) {
            $merchantProfile->update($request->all());
        } else {
            MerchantProfile::create([
                'user_id' => Auth::id(),
                'company_name' => $request->company_name,
                'address' => $request->address,
                'contact' => $request->contact,
                'description' => $request->description,
            ]);
        }

        return redirect()->route('merchant.profile')->with('success', 'Profile updated successfully.');
    }
}
