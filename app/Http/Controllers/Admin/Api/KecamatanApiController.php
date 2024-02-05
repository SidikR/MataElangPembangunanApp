<?php

namespace App\Http\Controllers\Admin\Api;

use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class KecamatanApiController extends Controller
{
    // Handling Get All Data
    public function index(Request $request)
    {
        $data_kecamatan = Kecamatan::all();
        if ($data_kecamatan->isEmpty()) {
            return $this->respondWithError('Tidak ada data kecamatan', null, Response::HTTP_NOT_FOUND);
        }
        return $this->respondWithSuccess('Data kecamatan berhasil dimuat.', $data_kecamatan);
    }

    // Handling Create Data
    public function store(Request $request)
    {
        try {
            $data = $request->all();

            if (isset($data[0]) && is_array($data[0])) {
                // Handling multiple data entries
                $validatedData = $request->validate([
                    '*.id_kecamatan' => 'nullable',
                    '*.id_kabupaten' => 'nullable',
                    '*.name' => 'required',
                ]);
                $kecamatanArray = [];
                foreach ($validatedData as $entry) {
                    $kecamatan = Kecamatan::create([
                        'id_kecamatan' => $entry['id_kecamatan'],
                        'id_kabupaten' => $entry['id_kabupaten'],
                        'name' => $entry['name']
                    ]);

                    $kecamatanArray[] = $kecamatan;
                }
            } else {
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
                $kecamatanArray = [$kecamatan];
            }
            return response()->json([
                'success' => true,
                'message' => 'Data kecamatan berhasil ditambahkan',
                'data' => $kecamatanArray,
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return $this->respondWithError('Gagal menambahkan data kecamatan baru', $e->getMessage());
        }
    }

    // Handling Get By Id Data
    public function show($id_kecamatan, Request $request)
    {
        $data_kecamatan = Kecamatan::firstWhere('id_kecamatan', $id_kecamatan);
        if (!$data_kecamatan) {
            return $this->respondWithError("Data dengan ID $id_kecamatan tidak tersedia", null, Response::HTTP_NOT_FOUND);
        }
        return $this->respondWithSuccess("Data kecamatan ($data_kecamatan->name) berhasil dimuat.", $data_kecamatan);
    }

    // Handling Data Update
    public function update(Request $request, $id_kecamatan)
    {
        try {
            $data_kecamatan = Kecamatan::where('id_kecamatan', $id_kecamatan)->first();
            $validatedData = $request->validate([
                'name' => 'required',
            ]);
            $data_kecamatan->where('id_kecamatan', $id_kecamatan)->update(['name' => $validatedData['name'],]);
            return $this->respondWithSuccess("Data kecamatan ($data_kecamatan->name) berhasil diubah", $data_kecamatan);
        } catch (\Exception $e) {
            return $this->respondWithError('Gagal memperbarui data kecamatan.', $e->getMessage());
        }
    }

    // Handling SoftDelete Data
    public function destroy($id_kecamatan, Request $request)
    {
        try {
            $data_kecamatan = Kecamatan::where('id_kecamatan', $id_kecamatan)->first();
            // Soft delete data
            $data_kecamatan->where('id_kecamatan', $id_kecamatan)->delete();
            return $this->respondWithSuccess("Data data_kecamatan ($data_kecamatan->name) dipindahkan ke kotak sampah (trash)");
        } catch (\Exception $e) {
            return $this->respondWithError('Gagal memindahkan ke kotak sampah (Trash) data data_kecamatan.', $e->getMessage());
        }
    }

    // Handling Get All Data Trash
    public function trash(Request $request)
    {
        try {
            $trashedKecamatan = Kecamatan::onlyTrashed()->get();
            return $this->respondWithSuccess('Berhasil memuat data trash data_kecamatan', $trashedKecamatan);
        } catch (\Exception $e) {
            return $this->respondWithError('Gagal mendapatkan data trash data_kecamatan.', $e->getMessage());
        }
    }

    // Handling Restore Data From Trash
    public function restoreFromTrash($id_kecamatan, Request $request)
    {
        try {
            $restoredKecamatan = Kecamatan::onlyTrashed()->where('id_kecamatan', $id_kecamatan)->first();
            $restoredKecamatan->where('id_kecamatan', $id_kecamatan)->restore();
            return $this->respondWithSuccess("Data data_kecamatan ($restoredKecamatan->name) berhasil dikembalikan dari trash.", $restoredKecamatan);
        } catch (\Exception $e) {
            return $this->respondWithError('Gagal mengembalikan data data_kecamatan dari trash, tidak ada data tersebut', $e->getMessage());
        }
    }

    // Handling Delete Permanent Data
    public function deletePermanently($id_kecamatan, Request $request)
    {
        try {
            $deletedKecamatan = Kecamatan::withTrashed()->where('id_kecamatan', $id_kecamatan)->first();
            $deletedKecamatan->where('id_kecamatan', $id_kecamatan)->forceDelete();
            return $this->respondWithSuccess("Data data_kecamatan ($deletedKecamatan->name) berhasil dihapus permanen.");
        } catch (\Exception $e) {
            return $this->respondWithError('Gagal menghapus data data_kecamatan permanen.', $e->getMessage());
        }
    }
}
