<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Report;
use Illuminate\Http\Request;
use App\Exports\ReportExport;
use App\Models\Response;
use App\Models\ResponseProgress;
use App\Models\StaffProvince;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class StaffProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Check if user has staffProvince relationship
        if (!auth()->user()->staffProvince) {
            return redirect()->back()->with('error', 'Staff province information not found. Please contact administrator.');
        }

        $reports = Report::all();
        $responseProgress = Response::whereHas('report', function ($query) {
            $query->where('province', auth()->user()->staffProvince->province);
        })->get();
        $response_status = Response::all();

        $reports_count = count($reports->where('province', auth()->user()->staffProvince->province));
        $responseProgress_count = count($responseProgress);

        if (auth()->user()->role == 'staff') {
            return view('dashboard.staff.dash_staff', compact('reports', 'response_status'), [
                'title' => 'Dashboard Staff'
            ]);
        } else {
            return view('dashboard.head_staff.dahs_head', compact('reports_count', 'responseProgress_count'), [
                'title' => 'Dashboard Head Staff'
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createAccount()
    {
        // Check if user has staffProvince relationship
        if (!auth()->user()->staffProvince) {
            return redirect()->back()->with('error', 'Staff province information not found. Please contact administrator.');
        }

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
        // Check if user has staffProvince relationship
        if (!auth()->user()->staffProvince) {
            return redirect()->back()->with('error', 'Staff province information not found. Please contact administrator.');
        }

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
     * Update the specified resource in storage.
     */
    public function resetPassword($id)
    {
        // Cari user berdasarkan ID
        $user = User::findOrFail($id);

        // Reset password berdasarkan 4 kata pertama email
        $emailPrefix = explode('@', $user->email)[0];
        $words = preg_split('/[._]/', $emailPrefix); // Pisahkan berdasarkan titik atau underscore
        $passwordWords = array_slice($words, 0, 4);
        $newPassword = implode('', $passwordWords);

        // Simpan password baru
        $user->password = Hash::make($newPassword);
        $user->save();

        return redirect()->back()->with('success', 'Password reset successfully!');
    }

    public function exportExcel(Request $request)
    {
        if ($request->date) {
            $date = $request->date;
            $reports = Report::with('responses')->whereDate('created_at', $date)->get();
        } else {
            $reports = Report::with('responses')->get();
        }

        return Excel::download(new ReportExport($request->date), 'laporan-' . ($request->date ?? 'seluruh') . '.xlsx');
    }

    public function responseDetail(Request $request, $id)
    {
        $reports = Report::with('user', 'responses')->findOrFail($id); // Eager load user
        $progress = ResponseProgress::all();
        // return $progress;
        return view('dashboard.staff.response', compact('reports', 'progress'), [
            'title' => 'Response Report'
        ]);
    }

    public function response(Request $request, $id)
    {
        $request->validate([
            'responses' => 'required'
        ]);

        if (Response::where('report_id', $id)->exists()) {
            Response::where('report_id', $id)->update([
                'report_id' => $id,
                'response_status' => $request->responses,
                'staff_id' => auth()->user()->id
            ]);

            return $request->responses === 'ON_PROCESS'
                ? redirect()->route('staff.response.detail', $id)->with('success', 'Successfully updated report response')
                : redirect()->back()->with('success', 'Successfully updated report response');
        }

        Response::create([
            'report_id' => $id,
            'response_status' => $request->responses,
            'staff_id' => auth()->user()->id
        ]);


        $reports = Report::with('user', 'responses')->findOrFail($id); // Eager load user
        // return view('dashboard.staff.response', compact('reports', 'progress'), [
        //     'title' => 'Response Report'
        // ]);
        return redirect()->route('staff.response.detail', $id)->with('success', 'Successfully updated report response');
    }

    public function addProgress(Request $request)
    {
        $response = Response::where('report_id', $request->report_id)->firstOrFail();
        $responseProgress = new ResponseProgress();
        $responseProgress->response_id = $response->id;

        $history = [
            'history' => $request->history,
            'user_id' => auth()->user()->id,
        ];

        $responseProgress->history = $history;
        $responseProgress->save();
        return redirect()->route('staff.response.detail', $request->report_id)->with('success', 'Successfully added report progress');
    }

    public function done($id)
    {
        $response = Response::where('report_id', $id)->first();
        // $response->response_status = 'DONE';
        // $response->save();

        $response->update([
            'response_status' => 'DONE'
        ]);

        return redirect()->route('staff.response.detail', $id)->with('success', 'Report has been marked as done!');
    }

    public function deleteProgress($id)
    {
        ResponseProgress::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Successfully deleted report progress');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Berhasil Menghapus Data Akun!');
    }
}
