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
                                                    <th scope="col">Type</th>
                                                    <th scope="col">Merk</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Dibuat</th>
                                                    <th scope="col">Diperbarui</th>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($alat_berat as $no => $item)
                                                    <tr>
                                                        <th scope="row">{{ $no + 1 }}</th>
                                                        <td>{{ $item->type }}</td>
                                                        <td>{{ $item->merk }}</td>
                                                        <td>{!! $item->status == 'Tersedia' ? '<span class="badge bg-success">Tersedia</span>' : '<span class="badge bg-danger">Tidak Tersedia</span>'  !!}</td>
                                                        <td>{{ $item->created_at }}</td>
                                                        <td>{{ $item->updated_at }}</td>
                                                        <td>
                                                            <div class="d-flex justify-content-center gap-2">
                                                                <a href="javascript:void(0);" class="btn btn-info btn-sm"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#view-{{ $item->id }}"><i
                                                                        class="bi bi-eye"></i> Lihat</a>
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
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title">Tambah {{ $pagetitle }}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ url('create-data-alat-berat') }}" method="post"
                                        enctype="multipart/form-data">
                                        @method('post')
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row pt-2">
                                                <label for="type" class="col-sm-2 col-form-label">Type</label>
                                                <div class="col-sm-10">
                                                    <select name="type" id="type" class="form-select @error('type') is-invalid @enderror">
                                                        <option value="">--Pilih--</option>
                                                        @foreach ($type as $data)
                                                        <option value="{{ $data->type }}">{{ $data->type }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('type')
                                                        <div class="text-danger">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row pt-2">
                                                <label for="merk" class="col-sm-2 col-form-label">Merk</label>
                                                <div class="col-sm-10">
                                                    <input type="text"
                                                        class="form-control @error('merk') is-invalid @enderror"
                                                        name="merk" id="guru" placeholder="Masukan Merk">
                                                    @error('merk')
                                                        <div class="text-danger">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row pt-2">
                                                <label for="type" class="col-sm-2 col-form-label">Status</label>
                                                <div class="col-sm-10">
                                                    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                                                        <option value="">--Pilih--</option>
                                                        <option value="Tersedia">Tersedia</option>
                                                        <option value="Tidak Tersedia">Tidak Tersedia</option>
                                                    </select>
                                                    @error('status')
                                                        <div class="text-danger">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row pt-2">
                                                <label for="type" class="col-sm-2 col-form-label">Operator</label>
                                                <div class="col-sm-10">
                                                    <select name="operator" id="operator" class="form-select @error('operator') is-invalid @enderror">
                                                        <option value="">--Pilih--</option>
                                                        <option value="Tersedia">Tersedia</option>
                                                        <option value="Tidak Tersedia">Tidak Tersedia</option>
                                                    </select>
                                                    @error('operator')
                                                        <div class="text-danger">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row pt-2">
                                                <label for="type" class="col-sm-2 col-form-label">BBM</label>
                                                <div class="col-sm-10">
                                                    <select name="bbm" id="bbm" class="form-select @error('bbm') is-invalid @enderror">
                                                        <option value="">--Pilih--</option>
                                                        <option value="Tersedia">Tersedia</option>
                                                        <option value="Tidak Tersedia">Tidak Tersedia</option>
                                                    </select>
                                                    @error('bbm')
                                                        <div class="text-danger">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row pt-2">
                                                <label for="harga" class="col-sm-2 col-form-label">Harga Sewa</label>
                                                <div class="col-sm-10">
                                                    <input type="number" min="0"
                                                        class="form-control @error('harga') is-invalid @enderror"
                                                        name="harga" id="guru" placeholder="Masukan harga">
                                                    @error('harga')
                                                        <div class="text-danger">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row pt-2">
                                                <label for="type" class="col-sm-2 col-form-label">Durasi Sewa</label>
                                                <div class="col-sm-10">
                                                    <select name="durasi_sewa" id="durasi_sewa" class="form-select @error('durasi_sewa') is-invalid @enderror">
                                                        <option value="">--Pilih--</option>
                                                        <option value="per Jam">per Jam</option>
                                                        <option value="per Hari">per Hari</option>
                                                    </select>
                                                    @error('durasi_sewa')
                                                        <div class="text-danger">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row pt-2">
                                                <label for="gambar" class="col-sm-2 col-form-label">Gambar</label>
                                                <div class="col-sm-10">
                                                    <input type="file"
                                                        class="form-control @error('gambar') is-invalid @enderror"
                                                        name="gambar" id="gambar">
                                                    @error('gambar')
                                                        <div class="text-danger">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
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
                        @foreach ($alat_berat as $item)
                            <div class="modal fade" id="delete-{{ $item->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Hapus {{ $pagetitle }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ url('delete-data-alat-berat/' . $item->id) }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <div class="modal-body">
                                                Hapus {{ $pagetitle }} <b>{{ $item->merk }}</b>?
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
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit {{ $pagetitle }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ url('update-data-alat-berat/' . $item->id) }}" method="post" enctype="multipart/form-data">
                                            @method('put')
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row pt-2">
                                                    <label for="type" class="col-sm-2 col-form-label">Type</label>
                                                    <div class="col-sm-10">
                                                        <select name="type" id="type" class="form-select @error('type') is-invalid @enderror">
                                                            <option value="">--Pilih--</option>
                                                            @foreach ($type as $data)
                                                            <option {!! $item->type == $data->type ? 'selected' : '' !!} value="{{ $data->type }}">{{ $data->type }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('type')
                                                            <div class="text-danger">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row pt-2">
                                                    <label for="merk" class="col-sm-2 col-form-label">Merk</label>
                                                    <div class="col-sm-10">
                                                        <input type="text"
                                                            class="form-control @error('merk') is-invalid @enderror"
                                                            name="merk" value="{!! $item->merk !!}" id="merk" placeholder="Masukan Merk">
                                                        @error('merk')
                                                            <div class="text-danger">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row pt-2">
                                                    <label for="type" class="col-sm-2 col-form-label">Status</label>
                                                    <div class="col-sm-10">
                                                        <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                                                            <option value="">--Pilih--</option>
                                                            <option {!! $item->status == 'Tersedia' ? 'selected' : '' !!} value="Tersedia">Tersedia</option>
                                                            <option {!! $item->status == 'Tidak Tersedia' ? 'selected' : '' !!} value="Tidak Tersedia">Tidak Tersedia</option>
                                                        </select>
                                                        @error('status')
                                                            <div class="text-danger">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row pt-2">
                                                    <label for="type" class="col-sm-2 col-form-label">Operator</label>
                                                    <div class="col-sm-10">
                                                        <select name="operator" id="operator" class="form-select @error('operator') is-invalid @enderror">
                                                            <option value="">--Pilih--</option>
                                                            <option {!! $item->operator == 'Tersedia' ? 'selected' : '' !!} value="Tersedia">Tersedia</option>
                                                            <option {!! $item->operator == 'Tidak Tersedia' ? 'selected' : '' !!} value="Tidak Tersedia">Tidak Tersedia</option>
                                                        </select>
                                                        @error('operator')
                                                            <div class="text-danger">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row pt-2">
                                                    <label for="type" class="col-sm-2 col-form-label">BBM</label>
                                                    <div class="col-sm-10">
                                                        <select name="bbm" id="bbm" class="form-select @error('bbm') is-invalid @enderror">
                                                            <option value="">--Pilih--</option>
                                                            <option {!! $item->bbm == 'Tersedia' ? 'selected' : '' !!} value="Tersedia">Tersedia</option>
                                                            <option {!! $item->bbm == 'Tidak Tersedia' ? 'selected' : '' !!} value="Tidak Tersedia">Tidak Tersedia</option>
                                                        </select>
                                                        @error('bbm')
                                                            <div class="text-danger">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row pt-2">
                                                    <label for="harga" class="col-sm-2 col-form-label">Harga Sewa</label>
                                                    <div class="col-sm-10">
                                                        <input type="number" min="0"
                                                            class="form-control @error('harga') is-invalid @enderror"
                                                            name="harga" value="{{ $item->harga }}" id="harga" placeholder="Masukan Harga">
                                                        @error('harga')
                                                            <div class="text-danger">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row pt-2">
                                                    <label for="type" class="col-sm-2 col-form-label">Durasi Sewa</label>
                                                    <div class="col-sm-10">
                                                        <select name="durasi_sewa" id="durasi_sewa" class="form-select @error('durasi_sewa') is-invalid @enderror">
                                                            <option value="">--Pilih--</option>
                                                            <option {!! $item->durasi_sewa == 'per Jam' ? 'selected' : '' !!} value="per Jam">per Jam</option>
                                                            <option {!! $item->durasi_sewa == 'per Hari' ? 'selected' : '' !!} value="per Hari">per Hari</option>
                                                        </select>
                                                        @error('durasi_sewa')
                                                            <div class="text-danger">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row pt-2">
                                                    <label for="gambar" class="col-sm-2 col-form-label">Gambar</label>
                                                    <div class="col-sm-10">
                                                        <input type="file"
                                                            class="form-control @error('gambar') is-invalid @enderror"
                                                            name="gambar" id="gambar">
                                                        @error('gambar')
                                                            <div class="text-danger">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
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

                            <div class="modal fade" id="view-{{ $item->id }}" tabindex="-1">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Detail {{ $item->merk }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="card-body">
                                            <div class="m-3">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="d-flex align-items-center flex-column">
                                                            <img src="{{ url('assets/upload/images/alat_berat/' . $item->gambar) }}"
                                                                alt="" class="img-fluid"
                                                                style="height: 230px; border-radius: 10px">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 pt-3">
                                                        <table class="table">
                                                            <tr>
                                                                <th>Type</th>
                                                                <th>:</th>
                                                                <td>{{ $item->type }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Merk</th>
                                                                <th>:</th>
                                                                <td>{{ $item->merk }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Status</th>
                                                                <th>:</th>
                                                                <td>{!! $item->status == 'Tersedia' ? '<span class="badge bg-success">Tersedia</span>' : '<span class="badge bg-danger">Tidak Tersedia</span>' !!}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Operator</th>
                                                                <th>:</th>
                                                                <td>{!! $item->operator == 'Tersedia' ? '<span class="badge bg-success">Tersedia</span>' : '<span class="badge bg-danger">Tidak Tersedia</span>' !!}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>BBM</th>
                                                                <th>:</th>
                                                                <td>{!! $item->bbm == 'Tersedia' ? '<span class="badge bg-success">Tersedia</span>' : '<span class="badge bg-danger">Tidak Tersedia</span>' !!}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Harga Sewa</th>
                                                                <th>:</th>
                                                                <th>{{ 'Rp.'. number_format($item->harga) .'/'. $item->durasi_sewa  }}</th>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Tutup</button>
                                        </div>
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
