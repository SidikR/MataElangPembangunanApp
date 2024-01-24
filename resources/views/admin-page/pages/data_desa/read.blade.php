@extends('admin-page.layouts.main')
@section('content')
    <nav aria-label="breadcrumb mt-0 mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/data-desa">Data Desa</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $data['page_name'] }}</li>
        </ol>
    </nav>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    {{ $data['page_name'] }}
                </h5>
                <span><i class="bi bi-clock-history"></i> Updated : <span id="result"></span></span>
            </div>
            <div class="card-body">
                <form action={{ route('data-desa.edit', ['data_desa' => $data_desa->id_desa]) }}>
                    <fieldset disabled>
                        <div class="mb-3">
                            <label for="id_desa" class="form-label">ID Desa</label>
                            <input type="text" id="id_desa" class="form-control" placeholder="Masukkan id desa"
                                name="id_desa" value="{{ $data_desa->id_desa }}">
                        </div>
                        <div class="mb-3">
                            <label for="id_kecamatan" class="form-label">ID Kabupaten</label>
                            <input type="text" id="id_kecamatan" class="form-control" placeholder="Masukkan id kecamatan"
                                name="id_kecamatan" value="{{ $data_desa->id_kecamatan }}">
                        </div>
                        <div class="mb-3">
                            <label for="nama-data-desa" class="form-label">Nama Kecmatan</label>
                            <input type="text" id="nama-data-desa" class="form-control" placeholder="Nama Desa"
                                value="{{ $data_desa->name }}">
                        </div>
                    </fieldset>
                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-danger" onclick="goBack()">Kembali</button>
                        <button type="submit" class="btn btn-primary">Edit Data</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script script>
        var givenDate = '{{ $data_desa->updated_at }}';

        // Menggunakan fungsi calculateDaysAgo
        calculateDaysAgo(givenDate, 'result');
    </script>
@endsection
