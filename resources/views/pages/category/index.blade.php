@extends('layouts.app')

@section('title', 'Daftar Kategori')

@section('page-header')
<div class="row">
    <div class="col-12">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Daftar Buku</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active"><i class="fas fa-book mr-1"></i> Buku</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('category.create') }}" class="btn btn-primary"><i class="fas fa-plus mr-1"></i>Tambah Kategori</a>
                </div>
                <div class="card-body">
                    <table table id="booksTable" class="table table-bordered table-striped dataTable dtr-inline">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kategori</th>
                                <th>Jumlah Buku</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $categories)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $categories->name }}</td>
                                    <td>{{ $categories->books_count }}</td>
                                    <td>
                                        <div class="btn-group dropleft">
                                            <button type="button" class="btn btn-secondary btn-sm">Pilih</button>
                                            <button type="button" class="btn btn-secondary btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-left">
                                                <a class="dropdown-item" href="{{ route('category.edit', $categories->id) }}">Edit</a>
                                                <a class="dropdown-item" href="#" onclick="confirmDelete({{ $categories->id }}, '{{ $categories->name }}')">Hapus</a>
                                            </div>
                                        </div>
                                        <form id="delete-form-{{ $categories->id }}" action="{{ route('category.destroy', $categories->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
@endsection

@section('js')
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    $('#booksTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
});

function confirmDelete(categoryId, categoryName) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Setelah dihapus, Anda tidak dapat memulihkan buku \"" + categoryName + "\"!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + categoryId).submit();
        }
    })
}

@if(session('success'))
    $(document).Toasts('create', {
        class: 'bg-success',
        title: 'Berhasil',
        autohide: true, // Enable auto hide
        delay: 3000,    // Auto close after 3 seconds
        body: '{{ session('success') }}'
    });
@endif
</script>
@endsection
