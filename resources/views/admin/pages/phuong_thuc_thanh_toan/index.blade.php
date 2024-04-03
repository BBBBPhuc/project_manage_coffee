@extends('admin.shares.master')
@section('noi_dung')
    <div id="app">
        <div class="row">
            <div class="col-4">
                <div class="container">
                    <div class="card">
                        <div class="card-header">
                            <strong>Thêm Mới Phương Thức Thanh Toán</strong>
                        </div>
                        <div class="card-body">
                            <label class="mt-1">Tên Phương Thức</label>
                            <input v-model="moi.ten_phuong_thuc" type="text" class="form-control">
                            <label class="mt-1">Tình Trạng</label>
                            <select v-model="moi.tinh_trang" class="form-select">
                                <option value="1">Hiển Thị</option>
                                <option value="0">Tạm Tắt</option>
                            </select>
                        </div>
                        <div class="card-footer text-end">
                            <button v-on:click="addPhuongThuc()" class="btn btn-primary">Thêm Mới</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="container">
                    <div class="card">
                        <div class="card-header">
                            <strong>Danh Sách Phương Thức Thanh Toán</strong>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="align-middle text-nowrap text-center">
                                        <tr>
                                            <th>#</th>
                                            <th>Tên Phương Thức</th>
                                            <th>Tình Trạng</th>
                                            <th>Tác Vụ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template v-for="(v, k) in list_phuong_thuc">
                                            <tr class="text-nowrap align-middle">
                                                <th class="text-center">@{{ (k + 1) }}</th>
                                                <td class="text-center">@{{ v.ten_phuong_thuc }}</td>
                                                <td class="text-center">
                                                    <button v-on:click="statusPhuongThuc(v)" v-if="v.tinh_trang"
                                                        class="btn btn-success">Hiển Thị</button>
                                                    <button v-on:click="statusPhuongThuc(v)" v-else
                                                        class="btn btn-secondary">Tạm Tắt</button>
                                                </td>
                                                <td class="text-center">
                                                    <button class="btn btn-outline-primary">Edit</button>
                                                    <button v-on:click="choose = v" data-bs-toggle="modal"
                                                    data-bs-target="#DeleteModal" class="btn btn-outline-danger">Delete</button>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="DeleteModal" tabindex="-1" aria-labelledby="DeleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    </div>
                    <div class="modal-body bg-warning">
                        <p>Bạn Có Chắc Muốn Xóa PTTT <b>@{{ choose.ten_phuong_thuc }}</b> này không!!!</p>
                    </div>
                    <div class="modal-footer">
                        <button v-on:click="delPhuongThuc()" type="button" class="btn btn-danger">Xóa</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $('title')[0].innerText = 'LC - ADMIN Phương Thức Thanh Toán';
        })
    </script>
    <script>
        new Vue({
            el: '#app',
            data: {
                list_phuong_thuc: [],
                moi: {},
                choose: {},
            },
            created() {
                this.loadData();
            },
            methods: {
                loadData() {
                    axios
                        .post('{{ Route('dataPhuongThuc') }}')
                        .then((res) => {
                            this.list_phuong_thuc = res.data.data;
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0], 'Error');
                            });
                        });
                },
                addPhuongThuc() {
                    axios
                        .post('{{ route('createPhuongThuc') }}', this.moi)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message, 'Success');
                                this.loadData();
                            } else {
                                toastr.error(res.data.message, 'Error');
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0], 'Error');
                            });
                        });
                },
                statusPhuongThuc(payload) {
                    axios
                        .post('{{ route('statusPhuongThuc') }}', payload)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message, 'Success');
                                this.loadData();
                            } else {
                                toastr.error(res.data.message, 'Error');
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0], 'Error');
                            });
                        });
                },
                delPhuongThuc() {
                    axios
                        .post('{{ route('destroyPhuongThuc') }}', this.choose)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message, 'Success');
                                this.loadData();
                                $("#DeleteModal").modal('hide');
                            } else {
                                toastr.error(res.data.message, 'Error');
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0], 'Error');
                            });
                        });
                },
            },
        });
    </script>
@endsection
