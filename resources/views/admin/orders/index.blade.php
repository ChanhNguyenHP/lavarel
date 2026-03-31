@extends('admin.layouts.admin')

@section('title', 'Quản lý Đơn hàng')

@section('content')
    <div class="page-header">
        <h3 class="page-title"> Quản lý Đơn hàng </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Quản lý Đơn hàng</a></li>
                <li class="breadcrumb-item active" aria-current="page">Danh sách Đơn hàng</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="page-header">
                        <h4 class="card-title">Đơn hàng</h4>
                        <div class="add-item">
                            <a href="{{ route('admin.orders.create') }}" type="button" class="btn btn-outline-primary btn-icon-text" fdprocessedid="qihwbt">
                                <i class="mdi mdi-plus"></i> Thêm mới 
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th> Mã đơn hàng </th>
                                    <th> Tổng tiền </th>
                                    <th> Trạng thái </th>
                                    <th> thời gian</th>
                                    <th> action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $itemOrder)
                                    <tr>
                                        <td> {{ $itemOrder->order_code }} </td>
                                        <td> {{ number_format($itemOrder->total_amount) }} đ</td>
                                        <td> {{ $itemOrder->status }} </td>
                                        <td> {{ $itemOrder->created_at->format('d/m/Y H:i') }} </td>
                                        <td class="td-action">
                                            <a href="{{ route('admin.orders.edit', $itemOrder->id) }}" type="button" class="btn btn-outline-secondary btn-icon-text btn-sm" fdprocessedid="48k5mr"> 
                                                Sửa
                                            </a>

                                            <form action="{{ route('admin.orders.destroy', $itemOrder->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này?');">
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
            {{ $orders->links() }}
        </div>
    </div>
    
@endsection
