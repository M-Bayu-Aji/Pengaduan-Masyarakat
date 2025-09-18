<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Comment;
use App\Models\ResponseProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.report.create', [
            'title' => 'Create Report'
        ]);
    }

    public function getAllReports()
    {
        $reports = Report::all();
        return response()->json($reports);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function reportUser()
    {
        $reports = Report::all();
        $progress = ResponseProgress::all();
        return view('dashboard.guest.laporan_user', compact('reports', 'progress'), [
            'title' => 'Laporan User Anda'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'province' => 'required',
            'regency' => 'required',
            'district' => 'required',
            'village' => 'required',
            'type' => 'required',
            'description' => 'required',
            'image' => 'required|image',
            'statement' => 'accepted',
        ]);

        $provinceName = $this->getNameFromApi('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json', $request->province);
        $regencyName = $this->getNameFromApi("https://www.emsifa.com/api-wilayah-indonesia/api/regencies/{$request->province}.json", $request->regency);
        $districtName = $this->getNameFromApi("https://www.emsifa.com/api-wilayah-indonesia/api/districts/{$request->regency}.json", $request->district);
        $villageName = $this->getNameFromApi("https://www.emsifa.com/api-wilayah-indonesia/api/villages/{$request->district}.json", $request->village);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        Report::create([
            'user_id' => auth()->user()->id,
            'province' => $provinceName,
            'regency' => $regencyName,
            'district' => $districtName,
            'village' => $villageName,
            'type' => $request->type,
            'description' => $request->description,
            'image' => $imageName,
            'voting' => json_encode(0),
            'statement' => false,
        ]);

        return redirect()->route('report.you')->with('success', 'Report created successfully.');
    }

    // Helper function to fetch name from API
    private function getNameFromApi($url, $id)
    {
        $data = json_decode(file_get_contents($url), true);
        $item = collect($data)->firstWhere('id', $id);
        return $item['name'] ?? 'Unknown';
    }

    public function comment($id)
    {
        $report = Report::findOrFail($id);

        $comments = Comment::all();
        return view('pages.article.comments', compact('report', 'comments'), [
            'title' => 'Comment'
        ]);
    }

    public function viewer($id)
    {
        $report = Report::findOrFail($id);
        $comments = Comment::all();
        $report->increment('viewers', 1);

        return view('pages.article.comments', compact('report', 'comments'), [
            'title' => 'Article'
        ]);
    }

    public function commentProses(Request $request)
    {
        $request->validate([
            'comment' => 'required'
        ]);

        $report = Report::findOrFail($request->id);
        Comment::create([
            'user_id' => Auth::id(),
            'comment' => $request->comment,
            'report_id' => $report->id,
        ]);

        return redirect()->back()->with('success', 'Berhasil Menambahkan Komentar!');
    }

    public function voteReport($id)
    {
        $report = Report::findOrFail($id); // Mencari laporan berdasarkan ID

        // Cek apakah user sudah memberikan vote sebelumnya
        $userId = Auth::id(); // Ambil ID user yang sedang login
        $voting = $report->voting ? json_decode($report->voting, true) : []; // Mendapatkan data voting yang sudah ada

        // Jika user sudah memberi vote, maka unvote (hapus vote)
        if (in_array($userId, $voting)) {
            // Hapus userId dari array voting untuk unvote
            $voting = array_filter($voting, function ($vote) use ($userId) {
                return $vote != $userId;
            });

            // Menyimpan kembali voting yang telah diubah
            $report->voting = json_encode(array_values($voting)); // Reindex array untuk menghindari indeks yang hilang
            $report->save();

            return redirect()->back()->with('success', 'Anda telah menghapus vote Anda pada laporan ini.');
        }

        // Jika user belum memberi vote, beri vote
        $voting[] = $userId;

        // Simpan kembali array voting ke database
        $report->voting = json_encode($voting);
        $report->save();

        return redirect()->back()->with('success', 'Terima kasih telah memberi vote!');
    }


    public function search(Request $request)
    {
        $province = $request->get('province'); // Ambil nilai dari form

        // Validasi input jika diperlukan
        if (!$province) {
            return redirect()->route('welcome_article')->with('error', 'Pilih provinsi terlebih dahulu.');
        }

        // Query laporan berdasarkan kolom province
        $reports = Report::where('province', $province)->get();

        // Kirim hasil pencarian ke view
        return view('pages.article.article', compact('reports'), [
            'title' => 'Searching Article'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Report::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Berhasil Menghapus Data Pengaduan!');
    }
}
