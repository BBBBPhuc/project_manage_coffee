@extends('admin.shares.master');
@section('noi_dung')
    <div id="app">
        <div class="d-flex mb-3">
            <div class="p-2"><h6>DANH SÁCH HÓA ĐƠN</h6></div>
            <div style="margin-bottom: 5px" class="ms-auto p-2"><button class="btn btn-primary">THÊM MỚI</button></div>
        </div>
        <hr>
        <div class="container">
           <div class="row">
            <div class="col-7">
                <div class="card">
                    <div class="card-header bg-primary text-center align-middle">
                        <b class="text-light">Danh Sách Hóa Đơn</b>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th></th>
                                        <th>Khách Hàng</th>
                                        <th>1</th>
                                        <th>1</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-5">
                <div class="card">
                    <div class="card-header bg-primary">

                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
           </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        new Vue({
            el      :   '#app',
            data    :   {

            },
            created()   {

            },
            methods :   {

            },
        });
    </script>
@endsection
