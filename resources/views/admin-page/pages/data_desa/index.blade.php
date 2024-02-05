@extends('admin-page.layouts.main')
@section('content')
    <nav aria-label="breadcrumb mt-0 mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $data['page_name'] }}</li>
        </ol>
    </nav>
    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5 class="card-title">
                    {{ $data['page_name'] }}
                </h5>
                <div class="d-flex justify-content-end gap-2 align-items-center">
                    <a href="{{ route('data-desa.trash') }}" class="align-items-center"><button
                            class="btn btn-sm btn-danger"><i class="bi bi-trash3-fill"></i> Trash</button></a>
                    <div class="button-create">
                        <a href={{ route('data-desa.create') }}>
                            <button type="button" class="btn btn-sm btn-primary">
                                Tambah Desa
                            </button>
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="tabel_desa">
                        <thead>
                            <tr>
                                <th>Nomor</th>
                                <th>Id</th>
                                <th>Nama</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $index = 1;
                            @endphp
                            @foreach ($desa as $item)
                                <tr>
                                    <td>{{ $index++ }}</td>
                                    <td>{{ $item->id_desa }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        <a href={{ route('data-desa.show', ['data_desa' => $item->id_desa]) }}><button
                                                type="button" class="btn btn-sm btn-primary">Read</button></a>
                                        <a href={{ route('data-desa.edit', ['data_desa' => $item->id_desa]) }}><button
                                                class="btn btn-sm btn-success">Edit</button></a>
                                        <button type="button" data-bs-toggle="modal"
                                            data-bs-target="#modalDelete{{ $index }}"
                                            class="btn btn-sm btn-danger">Delete</button>
                                    </td>
                                </tr>
                                @include('admin-page.pages.data_desa.delete')
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
