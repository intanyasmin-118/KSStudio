<?php

namespace App\Http\Controllers;

use App\Models\Package;

class PackageController extends Controller
{
    // Customer: view packages
    public function index()
    {
        if (!session()->has('user_id')) {
            return redirect('/login');
        }

        $packages = Package::where('is_active', 1)->get();

        return view('package.index', compact('packages'));
    }

    // Customer: select package
    public function select($id)
    {
        if (!session()->has('user_id')) {
            return redirect('/login');
        }

        $package = Package::findOrFail($id);

        session([
            'selected_package_id' => $package->id,
            'selected_package_name' => $package->name,
            'selected_package_price' => $package->price,
            'selected_package_duration' => $package->duration_minutes,
        ]);

        return redirect('/sessions')->with('success', 'Package selected: ' . $package->name);
    }
}
