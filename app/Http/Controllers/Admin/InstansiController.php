<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Instansi;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class InstansiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $instansi = Instansi::all();
        $data = [
            'header_name' => "Instansi/OPD",
            'page_name' => "Daftar Instansi"
        ];
        return view('admin-page.pages.instansi.index', compact('instansi', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'header_name' => "Instansi/OPD",
            'page_name' => "Tambah Instansi"
        ];

        return view('admin-page.pages.instansi.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nama-instansi' => 'required|max:255',
                'telepon-instansi' => 'nullable',
                'alamat' => 'nullable',
                'deskripsi' => 'nullable',
            ]);

            $instansi = Instansi::create([
                'nama' => $validatedData['nama-instansi'],
                'telepon' => $validatedData['telepon-instansi'],
                'alamat' => $validatedData['alamat'],
                'deskripsi' => $validatedData['deskripsi']
            ]);
            Session::flash('success', 'Data instansi berhasil ditambahkan');
            return redirect()->route('instansi.index');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menambahkan data instansi baru ' . $e->getMessage());
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($id, Request $request)
    {
        $instansi = Instansi::firstWhere('id', $id);

        $data = [
            'header_name' => "Instansi/OPD",
            'page_name' => "Detail Instansi " . $instansi->nama
        ];
        return view('admin-page.pages.instansi.read', compact('instansi', 'data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $instansi = Instansi::findOrFail($id);
            $data = [
                'header_name' => "Instansi/OPD",
                'page_name' => "Edit Data Instansi " . $instansi->nama
            ];
            return view('admin-page.pages.instansi.edit', compact('instansi', 'data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengambil data instansi. ' . $e->getMessage());
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $instansi = Instansi::findOrFail($id);

            $validatedData = $request->validate([
                'nama-instansi' => 'required|max:255',
                'telepon-instansi' => 'required',
                'alamat' => 'required',
                'deskripsi' => 'required',
            ]);

            $instansi->update([
                'nama' => $validatedData['nama-instansi'],
                'telepon' => $validatedData['telepon-instansi'],
                'alamat' => $validatedData['alamat'],
                'deskripsi' => $validatedData['deskripsi']
            ]);


            Session::flash('success', 'Data instansi (' . $instansi->nama . ') berhasil diubah');
            return redirect()->route('instansi.show', ['instansi' => $instansi->id]);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal memperbarui data instansi. ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, Request $request)
    {
        try {
            $instansi = Instansi::withTrashed()->findOrFail($id);

            // Soft delete data
            $instansi->delete();

            return redirect()->route('instansi.index')->with('success', 'Data instansi (' . $instansi->nama . ') dipindahkan ke kotak sampah (trash)');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal memindahkan ke kotak sampah (Trash) data instansi. ' . $e->getMessage());
        }
    }

    public function trash(Request $request)
    {
        try {
            $trashedInstansi = Instansi::onlyTrashed()->get();

            $data = [
                'header_name' => "Instansi/OPD",
                'page_name' => "Kotak Sampah Data Instansi"
            ];
            return view('admin-page.pages.instansi.trash', compact('trashedInstansi', 'data'));
        } catch (\Exception $e) {

            return redirect()->back()
                ->with('error', 'Gagal mendapatkan data trash instansi. ' . $e->getMessage());
        }
    }

    public function restoreFromTrash($id, Request $request)
    {
        try {
            $restoredInstansi = Instansi::withTrashed()->findOrFail($id);
            $restoredInstansi->restore();
            return redirect()->back()->with('success', 'Data instansi (' . $restoredInstansi->nama . ')  berhasil dikembalikan dari trash.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengembalikan data instansi dari trash. ' . $e->getMessage());
        }
    }

    public function deletePermanently($id, Request $request)
    {
        try {
            $deletedInstansi = Instansi::withTrashed()->findOrFail($id);
            $deletedInstansi->forceDelete();
            return redirect()->route('instansi.index')->with('success', 'Data instansi (' . $deletedInstansi->nama . ') berhasil dihapus permanen.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data instansi permanen. ' . $e->getMessage());
        }
    }
}
