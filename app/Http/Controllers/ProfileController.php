<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Suppliers;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barcodes = Profile::all();
        $suppliers = Suppliers::all();
        return view('pages.profile.index', compact('barcodes', 'suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fratijProfile = new Profile();
        $fratijProfile->company = $request->company;
        $fratijProfile->part = $request->part;

        // Generate product code using parts of company name and part
        $company = 'FS';
        $companyCode = substr($fratijProfile->company, 0, 3); // Get the first 3 characters of the company name
        $partCode = substr($fratijProfile->part, 0, 6); // Get the first 3 characters of the part
        $productCode = strtoupper($company . '-' . $companyCode . '-' . $partCode); // Combine the codes and convert to uppercase
        $fratijProfile->barcode = $productCode;
        $fratijProfile->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profile $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
