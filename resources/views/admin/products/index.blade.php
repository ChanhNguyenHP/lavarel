@extends('admin.layouts.admin')

@section('title', 'Quản lý sản phẩm')

@section('content')
    <div class="page-header">
        <h3 class="page-title"> Quản lý sản phẩm </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Quản lý sản phẩm</a></li>
                <li class="breadcrumb-item active" aria-current="page">Danh sách sản phẩm</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="page-header">
                        <h4 class="card-title">Sản phẩm</h4>
                        <div class="add-item">
                            <a href="{{ route('admin.products.create') }}" type="button" class="btn btn-outline-primary btn-icon-text" fdprocessedid="qihwbt">
                                <i class="mdi mdi-plus"></i> Thêm mới 
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th> Ảnh </th>
                                    <th> Tên sản phẩm </th>
                                    <th> Mô tả </th>
                                    <th> Giá </th>
                                    <th> Trạng thái </th>
                                    <th> action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td class="py-1">
                                            <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('/admin/assets/images/varta-default.jpg') }}" alt="image" style="width:50px; height:auto; border-radius: 0;" /> 
                                        </td>
                                        <td> {{ $product->name }} </td>
                                        <td> {{ $product->description }} </td>
                                        <td> {{ number_format($product->price) }} đ </td>
                                        <td> {{ $product->show ? "Hiển thị" : "Ẩn"}} </td>
                                        <td class="td-action">
                                            <a href="{{ route('admin.products.edit', $product->id) }}" type="button" class="btn btn-outline-secondary btn-icon-text btn-sm" fdprocessedid="48k5mr"> 
                                                Sửa
                                            </a>

                                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-icon-text btn-sm">Xóa</button>
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
        <div class="col-lg-12">
            {{ $products->links() }}
        </div>
    </div>
    
@endsection
