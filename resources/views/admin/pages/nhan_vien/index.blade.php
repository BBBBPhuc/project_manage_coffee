@extends('admin.shares.master')
@section('noi_dung')
    <div id="app">
        <div class="container">
            <h3 class="mb-2 text-secondary">Danh Sách Nhân Viên</h3>
            <hr>
            <div class="d-flex mb-3">
                <div data-bs-toggle="modal" data-bs-target="#CreateModal" class="btn btn-primary ms-auto p-2">Thêm Mới</div>
            </div>
            <div class="modal fade" id="CreateModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Thêm Mới Nhân Viên</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-2">
                                <label>Tên Nhân Viên</label>
                                <input v-model="them_moi.ten_nhan_vien" type="text" class="form-control"
                                    placeholder="Nhập vào tên nhân viên">
                            </div>
                            <div class="mb-2">
                                <label>Email</label>
                                <input v-model="them_moi.email" type="email" class="form-control"
                                    placeholder="Nhập vào email">
                            </div>
                            <div class="mb-2">
                                <label>Password</label>
                                <input v-model="them_moi.password" type="password" class="form-control"
                                    placeholder="Nhập vào mật khẩu">
                            </div>
                            <div class="mb-2">
                                <label>Số Điện Thoại</label>
                                <input v-model="them_moi.so_dien_thoai" type="tel" class="form-control"
                                    placeholder="Nhập vào số điện thoại">
                            </div>
                            <div class="mb-2">
                                <label>Giới Tính</label>
                                <select v-model="them_moi.gioi_tinh" class="form-control">
                                    <option value="">--- Chọn Giới Tính ---</option>
                                    <option value="0">Nam</option>
                                    <option value="1">Nữ</option>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label>Chức Vụ</label>
                                <select v-model="them_moi.chuc_vu" class="form-select">
                                    <option value=""></option>
                                    <option value="0">Admin</option>
                                    <option value="1">Thu Ngân</option>
                                    <option value="2">Nhân Viên</option>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label>Ngày Vào Làm</label>
                                <input v-model="them_moi.ngay_vao_lam" type="date" class="form-control">
                            </div>
                            <div class="mb-2">
                                <label>Ca Làm</label>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <template v-for="(v, k) in dataCaLam">
                                                    <div class="col">
                                                        <div class="form-check form-switch">
                                                            <input v-model="v.check" class="form-check-input" type="checkbox" role="switch"
                                                                id="flexSwitchCheckDefault">
                                                            <label class="form-check-label"
                                                                for="flexSwitchCheckDefault">@{{ v.ten_ca_lam }}</label>
                                                        </div>
                                                    </div>
                                            </template>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button v-on:click="addNew()" type="button" class="btn btn-primary">Tạo Mới</button>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center align-middle">#</th>
                                            <th class="text-center align-middle">Tên Nhân Viên</th>
                                            <th class="text-center align-middle">Số Điện Thoại</th>
                                            <th class="text-center align-middle">Giới Tính</th>
                                            <th class="text-center align-middle">Chức Vụ</th>
                                            <th class="text-center align-middle">Ngày Vào Làm</th>
                                            <th class="text-center align-middle">Ca Làm</th>
                                            <th class="text-center align-middle">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template v-for="(v, k) in listData">
                                            <tr>
                                                <th class="text-center align-middle">@{{ k + 1 }}</th>
                                                <td class="text-center align-middle">@{{ v.ten_nhan_vien }}</td>
                                                <td class="text-center align-middle">@{{ v.so_dien_thoai }}</td>
                                                <td class="text-center align-middle">@{{ v.gioi_tinh }}</td>
                                                <td class="text-center align-middle">@{{ v.chuc_vu }}</td>
                                                <td class="text-center align-middle">@{{ v.ngay_vao_lam }}</td>
                                                <td class="text-center align-middle">
                                                        <template v-for="(v1, k1) in v.ds">
                                                            <span>- @{{ v1.ten_ca_lam }}</span>
                                                            <br>
                                                        </template>
                                                </td>
                                                <td class="text-center align-middle no-wrap">
                                                    <button v-on:click="them_moi = v" data-bs-toggle="modal"
                                                        data-bs-target="#RepairModal" class="btn btn-primary">Edit</button>
                                                    <button v-on:click="deleteData = v" data-bs-toggle="modal"
                                                        data-bs-target="#DeleteModal" class="btn btn-danger">Erase</button>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                                <div class="modal fade" id="DeleteModal" tabindex="-1"
                                    aria-labelledby="DeleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body bg-warning">
                                                <p>Bạn Có Chắc Muốn Xóa Nhân Viên <b>@{{ deleteData.ten_nhan_vien }}</b> này không!!!
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button v-on:click="eraseData()" type="button" class="btn btn-danger">
                                                    Xóa Nhân Viên</button>
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
                                                    <label>Tên Nhân Viên</label>
                                                    <input v-model="them_moi.ten_nhan_vien" type="text"
                                                        class="form-control" placeholder="Nhập vào tên nhân viên">
                                                </div>
                                                <div class="mb-2">
                                                    <label>Số Điện Thoại</label>
                                                    <input v-model="them_moi.so_dien_thoai" type="tel"
                                                        class="form-control" placeholder="Nhập vào số điện thoại">
                                                </div>
                                                <div class="mb-2">
                                                    <label>Giới Tính</label>
                                                    <select v-model="them_moi.gioi_tinh" class="form-control">
                                                        <option value="">--- Chọn Giới Tính ---</option>
                                                        <option value="0">Nam</option>
                                                        <option value="1">Nữ</option>
                                                    </select>
                                                </div>
                                                <div class="mb-2">
                                                    <label>Chức Vụ</label>
                                                    <select v-model="them_moi.chuc_vu" class="form-control">
                                                        <option value=""></option>
                                                        <option value="0">Admin</option>
                                                        <option value="1">Thu Ngân</option>
                                                        <option value="2">Nhân Viên</option>
                                                    </select>
                                                </div>
                                                <div class="mb-2">
                                                    <label>Ngày Vào Làm</label>
                                                    <input v-model="them_moi.ngay_vao_lam" type="date"
                                                        class="form-control">
                                                </div>
                                                <div class="mb-2">
                                                    <label>Ca Làm</label>
                                                    <select v-model="them_moi.chuc_vu" class="form-control">
                                                        <option value=""></option>
                                                        <template v-for="(v, k) in dataCaLam">
                                                            <option v-bind:value="v.id">@{{ v.ten_ca_lam }}</option>
                                                        </template>
                                                    </select>
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
        $(document).ready(function() {
            $('title')[0].innerText = 'LC - ADMIN Nhân Viên';
        })
    </script>
    <script>
        new Vue({
            el: '#app',
            data: {
                them_moi: {},
                listData: [],
                deleteData: {},
                count: {},
                dataCaLam: [],
                number: 0
            },
            created() {
                this.loadData();
            },
            methods: {
                addNew() {
                    var data = {
                        'dataNew' : this.them_moi,
                        'dataCaLam' : this.dataCaLam
                    }
                    axios
                        .post('http://127.0.0.1:8000/api/admin/nhan-vien/create', data)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message, 'Success');
                                $('#CreateModal').modal('hide');
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
                        .post('{{ route('dataNhanVien') }}')
                        .then((res) => {
                            this.listData = res.data.data;
                            this.dataCaLam = res.data.dataCaLam;
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0], 'Error');
                            });
                        });
                },
                repairData() {
                    axios
                        .post('http://127.0.0.1:8000/api/admin/nhan-vien/update', this.them_moi)
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
                        .post('http://127.0.0.1:8000/api/admin/nhan-vien/delete', this.deleteData)
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
            },
        });
    </script>
@endsection
