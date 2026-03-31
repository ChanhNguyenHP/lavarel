@extends('admin.layouts.admin')

@section('content')
    <div class="page-header">
        <h3 class="page-title"> {{ isset($orders) ? 'Sửa Đơn hàng' : 'Thêm Đơn hàng' }} </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href=""> Quản lý Đơn hàng </a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ isset($orders) ? 'Sửa đơn hàng' : 'Thêm đơn hàng' }}</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">    
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th> Tên sản phẩm </th>
                                    <th> Giá </th>
                                    <th> Số lượng </th>
                                    <th> Tổng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($productsOrder as $item)
                                    <tr>
                                        <td>{{ $item->product_name }}</td>
                                        <td>{{ number_format($item->price) }} đ</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ number_format($item->total_price) }} đ</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <form action="{{ isset($orders) ? route('admin.orders.update', $orders->id) : route('admin.orders.store') }}" enctype="multipart/form-data" method="POST" class="forms-sample">
                    @csrf
                    @if(isset($orders))
                        @method('PUT')
                    @endif
                    
                    <div class="form-group row">
                        <label class="col-sm-3">Mã đơn hàng</label>
                        <div class="col-sm-9">
                            <label> {{ $orders->order_code ?? '' }} </label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 ">Tổng tiền</label>
                        <div class="col-sm-9">
                            <label>{{ number_format($orders->total_amount) }} đ  </label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3">Ngày đăng</label>
                        <div class="col-sm-9">
                            <label> {{ $orders->created_at->format('d/m/Y H:i') }} </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Trạng thái</label>
                        <select class="form-control" name="status">
                            <option value="pending">pending</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-primary mr-2">{{ isset($orders) ? 'Cập nhật' : 'Thêm mới' }}</button>
                </form>
                </div>
            </div>
        </div>
    </div>
    
@endsection
