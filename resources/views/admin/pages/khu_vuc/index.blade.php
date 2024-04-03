@extends('admin.shares.master');
@section('noi_dung')
    <div id="app">
        <div class="container">
                <div class="row">
                <div class="col-4">
                    <div class="card">
                        <div class="card-header bg-primary text-center">
                            <b class="text-light">Thêm Mới Khu Vực</b>
                        </div>
                        <div class="card-body">
                            <div class="mb-2">
                                <label>Tên Khu Vực</label>
                                <input v-model="them_moi.ten_khu_vuc" type="text" class="form-control"
                                    placeholder="Nhập vào tên khu vực ...">
                            </div>
                            <div class="mb-2">
                                <label>Số Bàn</label>
                                <input v-model="them_moi.so_ban" type="number" class="form-control"
                                    placeholder="Nhập vào số bàn ...">
                            </div>
                            <div class="mb-2">
                                <label>Tình Trạng</label>
                                <select v-model="them_moi.tinh_trang" class="form-select">
                                    <option selected value="">--- Mời Chọn Tình Trạng ---</option>
                                    <option value="1"> Mở </option>
                                    <option value="0"> Đóng </option>
                                </select>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button v-on:click="creates()" class="btn btn-primary">Thêm Mới</button>
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <div class="card">
                        <div class="card-header bg-primary text-center">
                            <b class="text-light">Danh Sách Khu Vực</b>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center align-middle">ID</th>
                                            <th class="text-center align-middle">Tên Khu Vực</th>
                                            <th class="text-center align-middle">Số Bàn</th>
                                            <th class="text-center align-middle">Tình Trạng</th>
                                            <th class="text-center align-middle">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template v-for="(v, k) in listData">
                                            <tr>
                                                <th class="text-center align-middle">@{{ k + 1 }}</th>
                                                <td class="text-center align-middle">@{{ v.ten_khu_vuc }}</td>
                                                <td class="text-center align-middle">@{{ v.so_ban }}</td>
                                                <td class="text-center align-middle">
                                                    <button v-on:click="changStatus(v)" v-if="v.tinh_trang"
                                                        class="btn btn-success">Mở</button>
                                                    <button v-on:click="changStatus(v)" v-else class="btn btn-warning">Đóng</button>
                                                </td>
                                                <td class="text-center align-middle text-nowrap">
                                                    <button v-on:click="deleteData = v" data-bs-toggle="modal"
                                                        data-bs-target="#RepairModal" class="btn btn-primary">Edit</button>
                                                    <button v-on:click="deleteData = v" data-bs-toggle="modal"
                                                        data-bs-target="#DeleteModal" class="btn btn-danger">Delete</button>
                                                    <button class="btn btn-dark">Bàn</button>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                                <div class="modal fade" id="DeleteModal" tabindex="-1" aria-labelledby="DeleteModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body bg-warning">
                                                <p>Bạn Có Chắc Muốn Xóa Khu Vực <b>@{{ deleteData.ten_khu_vuc }}</b> này không!!!
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button v-on:click="eraseData()" type="button" class="btn btn-danger">Xóa
                                                    Khu Vực</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="RepairModal" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Modal title</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-2">
                                                    <label>Tên Khu Vực</label>
                                                    <input v-model="deleteData.ten_khu_vuc" type="text"
                                                        class="form-control" placeholder="Nhap vao Tên Khu Vực ...">
                                                </div>
                                                <div class="mb-2">
                                                    <label>Số Bàn</label>
                                                    <input v-model="deleteData.so_ban" type="number"
                                                        class="form-control" placeholder="Nhap vao Số Bàn ...">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button v-on:click="repairData()" type="button"
                                                    class="btn btn-primary">Lưu Lại</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $('title')[0].innerText = 'LC - ADMIN Khu Vực';
        })
    </script>
    <script>
        new Vue({
            el: '#app',
            data: {
                them_moi: {},
                listData: [],
                deleteData: {},
                count: {}
            },
            created() {
                this.loadData();
            },
            methods: {
                creates() {
                    axios
                        .post('http://127.0.0.1:8000/api/admin/khu-vuc/create', this.them_moi)
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
                loadData() {
                    axios
                        .post('http://127.0.0.1:8000/api/admin/khu-vuc/data')
                        .then((res) => {
                            this.listData = res.data.data;
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0], 'Error');
                            });
                        });
                },
                repairData() {
                    axios
                        .post('http://127.0.0.1:8000/api/admin/khu-vuc/update', this.deleteData)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message, 'Success');
                                $('#RepairModal').modal('hide');
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
                eraseData() {
                    axios
                        .post('http://127.0.0.1:8000/api/admin/khu-vuc/delete', this.deleteData)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message, 'Success');
                                $('#DeleteModal').modal('hide');
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
                changStatus(payLoad) {
                    axios
                        .post('http://127.0.0.1:8000/api/admin/khu-vuc/status', payLoad)
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
                }
            },
        });
    </script>
@endsection
