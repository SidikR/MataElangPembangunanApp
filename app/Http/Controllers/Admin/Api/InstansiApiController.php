<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\Instansi;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InstansiApiController extends Controller
{
    private function validateInstansiData(Request $request)
    {
        return $request->validate([
            '*.nama-instansi' => 'required|max:255',
            '*.telepon-instansi' => 'nullable',
            '*.alamat' => 'nullable',
            '*.deskripsi' => 'nullable',
        ]);
    }

    private function createInstansi($entry)
    {
        return Instansi::create([
            'nama' => $entry['nama-instansi'],
            'telepon' => $entry['telepon-instansi'],
            'alamat' => $entry['alamat'],
            'deskripsi' => $entry['deskripsi'],
        ]);
    }

    // Handling Get All Data
    public function index(Request $request)
    {
        $instansi = Instansi::all();
        if ($instansi->isEmpty()) {
            return $this->respondWithError('Tidak ada instansi', null, Response::HTTP_NOT_FOUND);
        }
        return $this->respondWithSuccess('Data instansi berhasil dimuat.', $instansi);
    }

    // Handling Create Data
    public function store(Request $request)
    {
        try {
            $this->validateInstansiData($request);

            $data = $request->all();
            $instansiArray = [];

            foreach ($data as $entry) {
                $instansi = $this->createInstansi($entry);
                $instansiArray[] = $instansi;
            }

            return $this->respondWithSuccess('Data instansi berhasil ditambahkan', $instansiArray);
        } catch (\Exception $e) {
            return $this->respondWithError('Gagal menambahkan data instansi baru', $e->getMessage());
        }
    }

    // Handling Get By Id Data
    public function show($id, Request $request)
    {
        $instansi = Instansi::find($id);

        if (!$instansi) {
            return $this->respondWithError("Data dengan ID $id tidak tersedia", null, Response::HTTP_NOT_FOUND);
        }

        return $this->respondWithSuccess("Data instansi ($instansi->nama) berhasil dimuat.", $instansi);
    }

    // Handling Data Update
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

            $instansi->update($validatedData);

            return $this->respondWithSuccess("Data instansi ($instansi->nama) berhasil diubah", $instansi);
        } catch (\Exception $e) {
            return $this->respondWithError('Gagal memperbarui data instansi.', $e->getMessage());
        }
    }

    // Handling SodfDelete Data
    public function destroy($id, Request $request)
    {
        try {
            $instansi = Instansi::withTrashed()->findOrFail($id);

            // Soft delete data
            $instansi->delete();

            return $this->respondWithSuccess("Data instansi ($instansi->nama) dipindahkan ke kotak sampah (trash)");
        } catch (\Exception $e) {
            return $this->respondWithError('Gagal memindahkan ke kotak sampah (Trash) data instansi.', $e->getMessage());
        }
    }

    // Handling Get All Data Trash
    public function trash(Request $request)
    {
        try {
            $trashedInstansi = Instansi::onlyTrashed()->get();

            return $this->respondWithSuccess('Berhasil memuat data trash instansi', $trashedInstansi);
        } catch (\Exception $e) {
            return $this->respondWithError('Gagal mendapatkan data trash instansi.', $e->getMessage());
        }
    }

    // Handling Restore Data From Trash
    public function restoreFromTrash($id, Request $request)
    {
        try {
            $restoredInstansi = Instansi::onlyTrashed()->findOrFail($id);
            $restoredInstansi->restore();
            return $this->respondWithSuccess("Data instansi ($restoredInstansi->nama) berhasil dikembalikan dari trash.", $restoredInstansi);
        } catch (\Exception $e) {
            return $this->respondWithError('Gagal mengembalikan data instansi dari trash, tidak ada data tersebut', $e->getMessage());
        }
    }

    // Handling Delete Permanent Data
    public function deletePermanently($id, Request $request)
    {
        try {
            $deletedInstansi = Instansi::withTrashed()->findOrFail($id);

            // Permanently delete data
            $deletedInstansi->forceDelete();

            return $this->respondWithSuccess("Data instansi ($deletedInstansi->nama) berhasil dihapus permanen.");
        } catch (\Exception $e) {
            return $this->respondWithError('Gagal menghapus data instansi permanen.', $e->getMessage());
        }
    }
}
