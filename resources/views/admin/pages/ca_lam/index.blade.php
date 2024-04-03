@extends('admin.shares.master')
@section('noi_dung')
    <div id="app">
        <div class="container">
            <div class="row">
                <div class="col-4">
                    <div class="card">
                        <div class="card-header">
                            <strong>Thêm Mới Ca Làm</strong>
                        </div>
                        <div class="card-body">
                            <label>Tên Ca Làm</label>
                            <input v-model="them_moi.ten_ca_lam" type="text" class="form-control">
                            <label class="mt-2">Giờ Bắt Đầu</label>
                            <input v-model="them_moi.gio_bat_dau" type="time" class="form-control">
                            <label class="mt-2">Giờ Kết Thúc</label>
                            <input v-model="them_moi.gio_ket_thuc" type="time" class="form-control">
                        </div>
                        <div class="card-footer text-end">
                            <button v-on:click="themCaLam()" class="btn btn-primary">Thêm Mới</button>
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <div class="card">
                        <div class="card-header">Danh Sách Các Ca Làm Trong Ngày</div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="text-center text-nowrap align-middle">
                                        <tr>
                                            <th>#</th>
                                            <th>Tên Ca</th>
                                            <th>Giờ Bắt Đầu</th>
                                            <th>Giờ Kết Thúc</th>
                                            <th>Tình Trạng</th>
                                            <th>Tác Vụ</th>
                                        </tr>
                                    </thead>
                                    <tbody class="align-middle">
                                        <template v-for="(v, k) in ds_ca_lam">
                                            <tr>
                                                <th class="text-center">@{{ (k + 1) }}</th>
                                                <td class="text-center">@{{ v.ten_ca_lam }}</td>
                                                <td class="text-center">@{{ v.gio_bat_dau }}</td>
                                                <td class="text-center">@{{ v.gio_ket_thuc }}</td>
                                                <td class="text-center">
                                                    <button v-on:click="doiTrangThai(v)" v-if="v.tinh_trang == 1"
                                                        class="btn btn-success">Mở</button>
                                                    <button v-on:click="doiTrangThai(v)" v-if="v.tinh_trang == 0"
                                                        class="btn btn-secondary">Đóng</button>
                                                </td>
                                                <td class="text-center text-nowrap">
                                                    <button v-on:click="edit = Object.assign({}, v)" data-bs-toggle="modal" data-bs-target="#updateModal"
                                                        class="btn btn-primary">Edit</button>
                                                    <button v-on:click="xoaCaLam(v)" class="btn btn-danger">Delete</button>
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
        <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="DeleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cập Nhật Ca Làm</h5>
                    </div>
                    <div class="modal-body">
                        <label>Tên Ca Làm</label>
                        <input v-model="edit.ten_ca_lam" type="text" class="form-control">
                        <label class="mt-2">Giờ Bắt Đầu</label>
                        <input v-model="edit.gio_bat_dau" type="time" class="form-control">
                        <label class="mt-2">Giờ Kết Thúc</label>
                        <input v-model="edit.gio_ket_thuc" type="time" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button v-on:click="updateCaLam()" type="button" class="btn btn-success">Submit</button>
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
            $('title')[0].innerText = 'LC - ADMIN Ca Làm';
        })
    </script>
    <script>
        new Vue({
            el: '#app',
            data: {
                them_moi: {},
                ds_ca_lam: [],
                edit: {},
            },
            created() {
                this.loadData();
            },
            methods: {
                themCaLam() {
                    axios
                        .post('{{ route('themCaLam') }}', this.them_moi)
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
                        .post('{{ route('dataCaLam') }}')
                        .then((res) => {
                            this.ds_ca_lam = res.data.data;
                            document.querySelector('title').innerText = 'LC - Ca Làm';
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0], 'Error');
                            });
                        });
                },
                doiTrangThai(payload) {
                    axios
                        .post('{{ route('statusCaLam') }}', payload)
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
                xoaCaLam(v) {
                    axios
                        .post('{{ route('xoaCaLam') }}', v)
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
                updateCaLam() {
                    axios
                        .post('{{ route('updateCaLam') }}', payload)
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
