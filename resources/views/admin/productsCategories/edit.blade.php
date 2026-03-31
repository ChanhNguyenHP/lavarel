@extends('admin.layouts.admin')

@section('content')
    <div class="page-header">
        <h3 class="page-title"> {{ isset($productsCategories) ? 'Sửa danh mục' : 'Thêm danh mục' }} </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href=""> Quản lý sản phẩm </a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ isset($productsCategories) ? 'Sửa sản phẩm' : 'Thêm sản phẩm' }}</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <form action="{{ isset($productsCategories) ? route('admin.productsCategories.update', $productsCategories->id) : route('admin.productsCategories.store') }}" enctype="multipart/form-data" method="POST" class="forms-sample">
                    @csrf
                    @if(isset($productsCategories))
                        @method('PUT')
                    @endif
                    <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                        <input type="text" value="{{ $productsCategories->name ?? '' }}" name="name"  class="form-control" id="exampleInputName1" placeholder="Name">
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="show" value="1" {{ isset($productsCategories) ? ($productsCategories->show ? 'checked' : '') : 'checked' }}   > Hiển thị <i class="input-helper"></i></label>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary mr-2">{{ isset($productsCategories) ? 'Cập nhật' : 'Thêm mới' }}</button>
                </form>
                </div>
            </div>
        </div>
    </div>
    
@endsection
