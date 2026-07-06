<?php

namespace App\Http\Controllers;

use App\Models\Pharmacy;
use Illuminate\Http\Request;

namespace App\Http\Controllers;

use App\Models\Pharmacy;
use Illuminate\Http\Request;

class PharmacyController extends Controller
{
    // ---------------------------
    // Setup page
    // ---------------------------
    public function create()
    {
        if (auth()->user()->pharmacy_id) {
            return redirect()->route('dashboard');
        }

        return view('pharmacy.setup');
    }

    // ---------------------------
    // Store pharmacy (first time)
    // ---------------------------
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'license_number' => 'nullable|string|max:255',
            'logo' => 'nullable|image|max:2048',
        ]);

        $logoPath = null;

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('pharmacy_logos', 'public');
        }

        $pharmacy = Pharmacy::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'email' => $request->email,
            'license_number' => $request->license_number,
            'logo' => $logoPath,
            'owner_id' => auth()->id(),
            'owner_name' => auth()->user()->name,
            'status' => 'active',
        ]);

        auth()->user()->update([
            'pharmacy_id' => $pharmacy->id,
            'role' => 'admin',
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Pharmacy created successfully');
    }

    // ---------------------------
    // Settings page
    // ---------------------------
    public function edit()
    {
        $pharmacy = auth()->user()->pharmacy;

        return view('pharmacy.settings', compact('pharmacy'));
    }

    // ---------------------------
    // Update settings
    // ---------------------------
    public function update(Request $request)
    {
        $pharmacy = auth()->user()->pharmacy;

        if (!$pharmacy) {
            abort(404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'license_number' => 'nullable|string|max:255',
            'logo' => 'nullable|image|max:2048',
        ]);

        // update logo if exists
        if ($request->hasFile('logo')) {
            $pharmacy->logo = $request->file('logo')->store('pharmacy_logos', 'public');
        }

        $pharmacy->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'email' => $request->email,
            'license_number' => $request->license_number,
        ]);

        return redirect()->route('pharmacy.settings')
            ->with('success', 'Pharmacy updated successfully');
    }

    // ---------------------------
    // Optional list page
    // ---------------------------
    public function index()
    {
        $pharmacy = auth()->user()->pharmacy;

        return view('pharmacy.settings', [
            'pharmacy' => $pharmacy,
        ]);
    }
}
