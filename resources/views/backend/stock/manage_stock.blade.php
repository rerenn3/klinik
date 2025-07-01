@extends('admin.admin_master')

@section('admin')
    <div class="content">
        <h4 class="mb-4">Manajemen Stok</h4>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Stok</th>
                    <th>Satuan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($allProducts as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->stock }}</td>
                        <td>{{ $item->unit->name ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
