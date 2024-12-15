<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Report;
use Illuminate\Http\Request;
use App\Models\StaffProvince;
use Illuminate\Support\Facades\Hash;

class StaffProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reports = Report::all();
        if (auth()->user()->role == 'staff') {
            return view('dashboard.staff.dash_staff', compact('reports'), [
                'title' => 'Dashboard Staff'
            ]);
        } else {
            return view('dashboard.head_staff.dahs_head', compact('reports'), [
                'title' => 'Report'
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createAccount()
    {
        $accounts = User::where('role', 'staff')->get();
        $province = auth()->user()->staffProvince->province;
        return view('dashboard.head_staff.account', compact('accounts', 'province'), [
            'title' => 'Staff Accounts'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'role' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        User::create([
            'role' => $request->role,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        
        $user = User::where('email', $request->email)->first();

        $province = auth()->user()->staffProvince->province;

        StaffProvince::create([
            'user_id' => $user->id,
            'province' => $province
        ]);

        return redirect()->route('head.staff.account')->with('success', 'Successfully added staff account data!');
    }

    /**
     * Display the specified resource.
     */
    public function show() {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StaffProvince $staffProvince)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StaffProvince $staffProvince)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Berhasil Menghapus Data Pengaduan!');
    }
}
