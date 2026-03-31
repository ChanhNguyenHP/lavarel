@extends('admin.layouts.admin')

@section('title', 'Quản lý danh mục')

@section('content')
    <div class="page-header">
        <h3 class="page-title"> Quản lý danh mục </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Quản lý danh mục</a></li>
                <li class="breadcrumb-item active" aria-current="page">Danh sách danh mục</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="page-header">
                        <h4 class="card-title">Danh mục</h4>
                        <div class="add-item">
                            <a href="{{ route('admin.productsCategories.create') }}" type="button" class="btn btn-outline-primary btn-icon-text" fdprocessedid="qihwbt">
                                <i class="mdi mdi-plus"></i> Thêm mới 
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th> Tên sản phẩm </th>
                                    <th> Trạng thái </th>
                                    <th class=""> action </th>
                                </tr> 
                            </thead>
                            <tbody>
                                @foreach($productsCategories as $itemCategories)
                                    <tr>
                                        <td> {{ $itemCategories->name }} </td>
                                        <td> {{ $itemCategories->show ? "Hiển thị" : "Ẩn"}} </td>
                                        <td class="td-action">
                                            <a href="{{ route('admin.productsCategories.edit', $itemCategories->id) }}" type="button" class="btn btn-outline-secondary btn-icon-text btn-sm" fdprocessedid="48k5mr"> 
                                                Sửa
                                            </a>

                                            <form action="{{ route('admin.productsCategories.destroy', $itemCategories->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này?');">
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
            {{ $productsCategories->links() }}
        </div>
    </div>
    
@endsection
