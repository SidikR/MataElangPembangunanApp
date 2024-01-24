<?php

namespace App\Http\Controllers\Admin;

use App\Models\Desa;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $desa = Desa::all();
        $data = [
            'header_name' => "Data Desa",
            'page_name' => "Daftar Desa"
        ];
        return view('admin-page.pages.data_desa.index', compact('desa', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'header_name' => "Data Desa",
            'page_name' => "Tambah Data Desa"
        ];

        return view('admin-page.pages.data_desa.create', compact('data'));
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
                'id_desa' => 'nullable',
                'id_kecamatan' => 'nullable',
                'name' => 'required',
            ]);

            $desa = Desa::create([
                'id_desa' => $validatedData['id_desa'],
                'id_kecamatan' => $validatedData['id_kecamatan'],
                'name' => $validatedData['name']
            ]);
            Session::flash('success', 'Data desa berhasil ditambahkan');
            return redirect()->route('data-desa.index');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menambahkan data desa baru ' . $e->getMessage());
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($id_desa, Request $request)
    {
        $data_desa = Desa::firstWhere('id_desa', $id_desa);

        $data = [
            'header_name' => "Data Desa",
            'page_name' => "Detail data desa " . $data_desa->name
        ];
        return view('admin-page.pages.data_desa.read', compact('data_desa', 'data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_desa)
    {
        try {
            $data_desa = Desa::where('id_desa', $id_desa)->firstOrFail();
            $data = [
                'header_name' => "Data Desa",
                'page_name' => "Edit Data Desa " . $data_desa->name
            ];
            return view('admin-page.pages.data_desa.edit', compact('data_desa', 'data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengambil data desa ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_desa)
    {
        try {
            $data_desa = Desa::where('id_desa', $id_desa)->first();

            $validatedData = $request->validate([
                'name' => 'required',
            ]);

            $data_desa->where('id_desa', $id_desa)->update([
                'name' => $validatedData['name'],
            ]);
            Session::flash('success', 'Data desa (' . $data_desa->name . ') berhasil diubah');
            return redirect()->route('data-desa.show', ['data_desa' => $data_desa->id_desa]);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal memperbarui data desa. ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_desa, Request $request)
    {
        try {
            $data_desa = Desa::where('id_desa', $id_desa)->first();

            // Soft delete data
            $data_desa->where('id_desa', $id_desa)->delete();


            return redirect()->route('data-desa.index')->with('success', 'Data desa (' . $data_desa->name . ') dipindahkan ke kotak sampah (trash)');
        } catch (\Exception $e) {

            return redirect()->back()
                ->with('error', 'Gagal memindahkan ke kotak sampah (Trash) data desa. ' . $e->getMessage());
        }
    }

    public function trash(Request $request)
    {
        try {
            $trashedDesa = Desa::onlyTrashed()->get();

            $data = [
                'header_name' => "Data Desa",
                'page_name' => "Kotak Sampah Data Desa"
            ];

            return view('admin-page.pages.data_desa.trash', compact('trashedDesa', 'data'));
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal mendapatkan data trash desa ' . $e->getMessage());
        }
    }

    public function restoreFromTrash($id_desa, Request $request)
    {
        try {
            $restoredDesa = Desa::onlyTrashed()->where('id_desa', $id_desa)->first();
            $restoredDesa->where('id_desa', $id_desa)->restore();
            return redirect()->back()->with('success', 'Data desa (' . $restoredDesa->name . ')  berhasil dikembalikan dari trash.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengembalikan data instansi dari trash. ' . $e->getMessage());
        }
    }

    public function deletePermanently($id_desa, Request $request)
    {
        try {
            $deletedDesa = Desa::withTrashed()->where('id_desa', $id_desa)->first();

            // Permanently delete data
            $deletedDesa->where('id_desa', $id_desa)->forceDelete();


            return redirect()->route('data-desa.index')->with('success', 'Data desa (' . $deletedDesa->name . ') berhasil dihapus permanen.');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Gagal menghapus data desa permanen. ' . $e->getMessage());
        }
    }
}
