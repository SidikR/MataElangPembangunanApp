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
                    <a href="{{ route('instansi.trash') }}" class="align-items-center">
                        <button class="btn btn-sm btn-danger"><i class="bi bi-trash3-fill"></i> Trash</button>
                    </a>
                    <div class="button-create">
                        <a href={{ route('instansi.create') }}>
                            <button type="button" class="btn btn-sm btn-primary">Tambah Instansi</button>
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>Nomor</th>
                                <th>Nama Instansi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $index = 1;
                            @endphp
                            @foreach ($instansi as $item)
                                <tr>
                                    <td>{{ $index++ }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>
                                        <a href={{ route('instansi.show', ['instansi' => $item->id]) }}><button
                                                type="button" class="btn btn-sm btn-primary">Read</button></a>
                                        <a href={{ route('instansi.edit', ['instansi' => $item->id]) }}><button
                                                class="btn btn-sm btn-success">Edit</button></a>
                                        <button type="button" data-bs-toggle="modal"
                                            data-bs-target="#modalDelete{{ $item->id }}"
                                            class="btn btn-sm btn-danger">Delete</button>
                                    </td>
                                </tr>
                                @include('admin-page.pages.instansi.delete')
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
