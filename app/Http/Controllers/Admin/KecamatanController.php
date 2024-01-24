<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kecamatan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kecamatan = Kecamatan::all();
        $data = [
            'header_name' => "Data Kecamatan",
            'page_name' => "Daftar Kecamatan"
        ];
        return view('admin-page.pages.data_kecamatan.index', compact('kecamatan', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'header_name' => "Data Kecamatan",
            'page_name' => "Tambah Data Kecamatan"
        ];

        return view('admin-page.pages.data_kecamatan.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->all();

            // Handling single data entry
            $validatedData = $request->validate([
                'id_kecamatan' => 'nullable',
                'id_kabupaten' => 'nullable',
                'name' => 'required',
            ]);

            $kecamatan = Kecamatan::create([
                'id_kecamatan' => $validatedData['id_kecamatan'],
                'id_kabupaten' => $validatedData['id_kabupaten'],
                'name' => $validatedData['name']
            ]);
            Session::flash('success', 'Data kecamatan berhasil ditambahkan');
            return redirect()->route('data-kecamatan.index');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menambahkan data kecamatan baru ' . $e->getMessage());
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($id_kecamatan, Request $request)
    {
        $data_kecamatan = Kecamatan::firstWhere('id_kecamatan', $id_kecamatan);

        $data = [
            'header_name' => "Data Kecamatan",
            'page_name' => "Detail data kecamatan " . $data_kecamatan->name
        ];
        return view('admin-page.pages.data_kecamatan.read', compact('data_kecamatan', 'data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_kecamatan)
    {
        try {
            $data_kecamatan = Kecamatan::where('id_kecamatan', $id_kecamatan)->firstOrFail();
            $data = [
                'header_name' => "Data Kecamatan",
                'page_name' => "Edit Data Kecamatan " . $data_kecamatan->name
            ];
            return view('admin-page.pages.data_kecamatan.edit', compact('data_kecamatan', 'data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengambil data kecamatan ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_kecamatan)
    {
        try {
            $data_kecamatan = Kecamatan::where('id_kecamatan', $id_kecamatan)->first();

            $validatedData = $request->validate([
                'name' => 'required',
            ]);

            $data_kecamatan->where('id_kecamatan', $id_kecamatan)->update([
                'name' => $validatedData['name'],
            ]);
            Session::flash('success', 'Data kecamatan (' . $data_kecamatan->name . ') berhasil diubah');
            return redirect()->route('data-kecamatan.show', ['data_kecamatan' => $data_kecamatan->id_kecamatan]);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal memperbarui data kecamatan. ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_kecamatan, Request $request)
    {
        try {
            $data_kecamatan = Kecamatan::where('id_kecamatan', $id_kecamatan)->first();

            // Soft delete data
            $data_kecamatan->where('id_kecamatan', $id_kecamatan)->delete();


            return redirect()->route('data-kecamatan.index')->with('success', 'Data kecamatan (' . $data_kecamatan->name . ') dipindahkan ke kotak sampah (trash)');
        } catch (\Exception $e) {

            return redirect()->back()
                ->with('error', 'Gagal memindahkan ke kotak sampah (Trash) data kecamatan. ' . $e->getMessage());
        }
    }

    public function trash(Request $request)
    {
        try {
            $trashedKecamatan = Kecamatan::onlyTrashed()->get();

            $data = [
                'header_name' => "Data Kecamatan",
                'page_name' => "Kotak Sampah Data Kecamatan"
            ];

            return view('admin-page.pages.data_kecamatan.trash', compact('trashedKecamatan', 'data'));
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal mendapatkan data trash kecamatan ' . $e->getMessage());
        }
    }

    public function restoreFromTrash($id_kecamatan, Request $request)
    {
        try {
            $restoredKecamatan = Kecamatan::onlyTrashed()->where('id_kecamatan', $id_kecamatan)->first();
            $restoredKecamatan->where('id_kecamatan', $id_kecamatan)->restore();
            return redirect()->back()->with('success', 'Data kecamatan (' . $restoredKecamatan->name . ')  berhasil dikembalikan dari trash.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengembalikan data instansi dari trash. ' . $e->getMessage());
        }
    }

    public function deletePermanently($id_kecamatan, Request $request)
    {
        try {
            $deletedKecamatan = Kecamatan::withTrashed()->where('id_kecamatan', $id_kecamatan)->first();

            // Permanently delete data
            $deletedKecamatan->where('id_kecamatan', $id_kecamatan)->forceDelete();


            return redirect()->route('data-kecamatan.index')->with('success', 'Data kecamatan (' . $deletedKecamatan->name . ') berhasil dihapus permanen.');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Gagal menghapus data kecamatan permanen. ' . $e->getMessage());
        }
    }
}
