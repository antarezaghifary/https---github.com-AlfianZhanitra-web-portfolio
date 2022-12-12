@extends('admin.layouts.template')
@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>{{ $pagetitle }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dahsboard</a></li>
                    <li class="breadcrumb-item active">{{ $pagetitle }}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">
                        <div class="pb-3">
                            <a href="javascrip:void(0)" data-bs-toggle="modal" data-bs-target="#create"
                                class="btn btn-primary"><i class="bi bi-plus"></i> Tambah</a>
                        </div>
                        <div class="col-md-12">
                            <div class="card recent-sales overflow-auto">
                                <div class="card-body">
                                    <div class="pt-3">
                                        <table class="table table-borderless datatable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Kelas</th>
                                                    <th scope="col">Keterangan</th>
                                                    <th scope="col">Dibuat</th>
                                                    <th scope="col">Diperbarui</th>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($kelas as $no => $item)
                                                    <tr>
                                                        <th scope="row">{{ $no + 1 }}</th>
                                                        <td>{{ $item->kelas }}</td>
                                                        <td>{{ $item->keterangan }}</td>
                                                        <td>{{ $item->created_at }}</td>
                                                        <td>{{ $item->updated_at }}</td>
                                                        <td>
                                                            <div class="d-flex justify-content-center gap-2">
                                                                <a href="javascript:void(0);" class="btn btn-warning btn-sm"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#edit-{{ $item->id }}"><i
                                                                        class="bi bi-pencil"></i> Ubah</a>
                                                                <a href="javascript:void(0);" class="btn btn-danger btn-sm"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#delete-{{ $item->id }}"><i
                                                                        class="bi bi-trash"></i> Hapus</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="create" data-bs-backdrop="static" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title">Tambah {{ $pagetitle }}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ url('create-data-kelas') }}" method="post">
                                        @method('post')
                                        @csrf
                                        <div class="modal-body">
                                            <div class="pt-2">
                                                <label for="kelas" class="form-label">Kelas</label>
                                                <input type="text"
                                                    class="form-control @error('name') is-invalid @enderror" name="kelas"
                                                    id="kelas" placeholder="Masukan Nama Kelas">
                                                @error('kelas')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="pt-2">
                                                <label for="keterangan" class="form-label">Keterangan</label>
                                                <input type="text"
                                                    class="form-control @error('keterangan') is-invalid @enderror"
                                                    name="keterangan" id="keterangan" placeholder="Keterangan">
                                                @error('keterangan')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @foreach ($kelas as $item)
                            <div class="modal fade" id="delete-{{ $item->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Hapus {{ $pagetitle }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ url('delete-data-kelas/' . $item->id) }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <div class="modal-body">
                                                Hapus {{ $pagetitle }} <b>{{ $item->kelas }}</b>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Tutup</button>
                                                <button type="submit"class="btn btn-danger">Hapus</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="edit-{{ $item->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit {{ $pagetitle }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ url('update-data-kelas/' . $item->id) }}" method="post">
                                            @method('put')
                                            @csrf
                                            <div class="modal-body">
                                                <div class="pt-2">
                                                    <label for="kelas" class="form-label">Kelas</label>
                                                    <input type="text"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        name="kelas" id="kelas" value="{{ $item->kelas }}"
                                                        placeholder="Masukan Nama Kelas">
                                                    @error('kelas')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="pt-2">
                                                    <label for="keterangan" class="form-label">Keterangan</label>
                                                    <input type="text"
                                                        class="form-control @error('keterangan') is-invalid @enderror"
                                                        name="keterangan" id="keterangan"
                                                        value="{{ $item->keterangan }}" placeholder="Keterangan">
                                                    @error('keterangan')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <!-- End Left side columns -->

            </div>
        </section>

    </main><!-- End #main -->
@endsection
@section('js')
@endsection
