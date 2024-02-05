<?php

namespace App\Http\Controllers\Admin\Api;

use App\Models\Desa;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class DesaApiController extends Controller
{
    // Handling Get All Data
    public function index(Request $request)
    {
        $dataDesa = Desa::all();

        if ($dataDesa->isEmpty()) {
            return $this->respondWithError('Tidak ada data desa', null, Response::HTTP_NOT_FOUND);
        }

        return $this->respondWithSuccess('Data kecamatan berhasil dimuat.', $dataDesa);
    }

    // Handling Get Data by id Kecamatann
    public function getByKecamatan(Request $request)
    {
        $idKecamatan = $request->input('id_kecamatan');

        // Menggunakan eloquent query untuk mengambil data desa berdasarkan id kecamatan
        $dataDesa = Desa::where('id_kecamatan', $idKecamatan)->get();

        // Memeriksa apakah data desa ditemukan
        if ($dataDesa->isEmpty()) {
            return $this->respondWithError('Tidak ada data desa untuk kecamatan dengan ID ' . $idKecamatan, null, Response::HTTP_NOT_FOUND);
        }

        return $this->respondWithSuccess('Data desa untuk kecamatan dengan ID ' . $idKecamatan . ' berhasil dimuat.', $dataDesa);
    }


    // Handling Create Data
    public function store(Request $request)
    {
        try {
            $data = $request->all();

            if (isset($data[0]) && is_array($data[0])) {
                // Handling multiple data entries
                $validatedData = $request->validate([
                    '*.id_desa' => 'nullable',
                    '*.id_kecamatan' => 'nullable',
                    '*.name' => 'required',
                ]);

                $kecamatanArray = [];

                foreach ($validatedData as $entry) {
                    $kecamatan = Desa::create([
                        'id_desa' => $entry['id_desa'],
                        'id_kecamatan' => $entry['id_kecamatan'],
                        'name' => $entry['name']
                    ]);

                    $kecamatanArray[] = $kecamatan;
                }
            } else {
                // Handling single data entry
                $validatedData = $request->validate([
                    'id_desa' => 'nullable',
                    'id_kecamatan' => 'nullable',
                    'name' => 'required',
                ]);

                $kecamatan = Desa::create([
                    'id_desa' => $validatedData['id_desa'],
                    'id_kecamatan' => $validatedData['id_kecamatan'],
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
            return $this->respondWithError('Gagal menambahkan data desa baru', $e->getMessage());
        }
    }

    // Handling Get Data By Id
    public function show($id_desa, Request $request)
    {
        $dataDesa = Desa::firstWhere('id_desa', $id_desa);

        if (!$dataDesa) {
            return $this->respondWithError("Data dengan ID $id_desa tidak tersedia", null, Response::HTTP_NOT_FOUND);
        }

        return $this->respondWithSuccess("Data kecamatan ($dataDesa->name) berhasil dimuat.", $dataDesa);
    }

    // Handling Data Update
    public function update(Request $request, $id_desa)
    {
        try {
            $dataDesa = Desa::where('id_desa', $id_desa)->first();

            $validatedData = $request->validate([
                'name' => 'required',
            ]);

            $dataDesa->where('id_desa', $id_desa)->update(['name' => $validatedData['name'],]);
            $dataDesa = Desa::where('id_desa', $id_desa)->first();
            return $this->respondWithSuccess("Data kecamatan ($dataDesa->name) berhasil diubah", $dataDesa);
        } catch (\Exception $e) {
            return $this->respondWithError('Gagal memperbarui data desa.', $e->getMessage());
        }
    }

    // Handling SoftDelete Data
    public function destroy($id_desa, Request $request)
    {
        try {
            $dataDesa = Desa::where('id_desa', $id_desa)->first();

            // Soft delete data
            $dataDesa->where('id_desa', $id_desa)->delete();

            return $this->respondWithSuccess("Data dataDesa ($dataDesa->name) dipindahkan ke kotak sampah (trash)");
        } catch (\Exception $e) {
            return $this->respondWithError('Gagal memindahkan ke kotak sampah (Trash) data dataDesa.', $e->getMessage());
        }
    }

    // Handling Get All Data Trash
    public function trash(Request $request)
    {
        try {
            $trashedDesa = Desa::onlyTrashed()->get();

            return $this->respondWithSuccess('Berhasil memuat data trash dataDesa', $trashedDesa);
        } catch (\Exception $e) {
            return $this->respondWithError('Gagal mendapatkan data trash dataDesa.', $e->getMessage());
        }
    }

    // Handling Restore Data From Trash
    public function restoreFromTrash($id_desa, Request $request)
    {
        try {
            $restoredDesa = Desa::onlyTrashed()->where('id_desa', $id_desa)->first();
            $restoredDesa->where('id_desa', $id_desa)->restore();
            return $this->respondWithSuccess("Data dataDesa ($restoredDesa->name) berhasil dikembalikan dari trash.", $restoredDesa);
        } catch (\Exception $e) {
            return $this->respondWithError('Gagal mengembalikan data dataDesa dari trash, tidak ada data tersebut', $e->getMessage());
        }
    }

    // Handling Delete Permanent Data
    public function deletePermanently($id_desa, Request $request)
    {
        try {
            $deletedDesa = Desa::withTrashed()->where('id_desa', $id_desa)->first();
            $deletedDesa->where('id_desa', $id_desa)->forceDelete();
            return $this->respondWithSuccess("Data dataDesa ($deletedDesa->name) berhasil dihapus permanen.");
        } catch (\Exception $e) {
            return $this->respondWithError('Gagal menghapus data dataDesa permanen.', $e->getMessage());
        }
    }
}
