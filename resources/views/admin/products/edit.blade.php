@extends('admin.layouts.admin')

@section('content')
    <div class="page-header">
        <h3 class="page-title"> {{ isset($product) ? 'Sửa sản phẩm' : 'Thêm sản phẩm' }} </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href=""> Quản lý sản phẩm </a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ isset($product) ? 'Sửa sản phẩm' : 'Thêm sản phẩm' }}</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <form action="{{ isset($product) ? route('admin.products.update', $product->id) : route('admin.products.store') }}" enctype="multipart/form-data" method="POST" class="forms-sample">
                    @csrf
                    @if(isset($product))
                        @method('PUT')
                    @endif
                    <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                        <input type="text" value="{{ $product->name ?? '' }}" name="name"  class="form-control" id="exampleInputName1" placeholder="Name">
                    </div>

                    <div class="form-group">
                        <label for="exampleTextarea1">Mô tả</label>
                        <textarea class="form-control" name="description" id="exampleTextarea1" rows="4"> {{ $product->description ?? '' }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="examplePrice">Giá bán</label>
                        <input type="text" class="form-control" value="{{ $product->price ?? '' }}" name="price" id="examplePrice" placeholder="Price">
                    </div>
                    
                    <div class="form-group">
                        <label>Danh mục</label>
                        <select class="form-control" name="category_id">
                            <option value="">Chọn danh mục</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ (isset($product) && $product->category_id == $category->id) ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>File upload</label>
                        <input type="file" name="image" class="file-upload-default">
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                          </span>
                            
                        </div>
                        <div class="input-group col-xs-12">
                            @if(isset($product) && $product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid mt-2" style="max-width:100px;" alt="Thumbnail">
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <label class="form-check-label">
                            @if(isset($product))
                                @if($product->show)
                                    <input type="checkbox" class="form-check-input" name="show" value="1" checked> Hiển thị <i class="input-helper"></i>
                                @else
                                    <input type="checkbox" class="form-check-input" name="show" value="1"> Hiển thị <i class="input-helper"></i>
                                @endif
                            @else
                                {{-- Thêm mới: mặc định tick --}}
                                <input type="checkbox" class="form-check-input" name="show" value="1" checked> Hiển thị <i class="input-helper"></i>
                            @endif
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary mr-2">{{ isset($product) ? 'Cập nhật' : 'Thêm mới' }}</button>
                </form>
                </div>
            </div>
        </div>
    </div>
    
@endsection
