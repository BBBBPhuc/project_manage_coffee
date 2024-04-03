@extends('admin.shares.master');
@section('noi_dung')
    <div id="app">
        <div class="container">
            <div class="row">
                <div class="col-4">
                    <div class="card">
                        <div class="card-header bg-primary text-center">
                            <b class="text-light">Thêm Mới Loại Hàng Hóa</b>
                        </div>
                        <div class="card-body">
                            <div class="mb-2">
                                <label>Loại Hàng Hóa</label>
                                <input v-model="them_moi.ten_loai_hang" type="text" class="form-control"
                                    placeholder="Nhap vao Loai Hang Hoa ...">
                            </div>
                            <div class="mb-2">
                                <label>Tình Trạng</label>
                                <select v-model="them_moi.tinh_trang" class="form-control">
                                    <option value="">--- Mời Chọn Tình Trạng ---</option>
                                    <option value="1"> Hiển Thị </option>
                                    <option value="0"> Không Hiển Thị </option>
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
                            <b class="text-light" >Danh Sách Loại Hàng Hóa</b>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center align-middle">ID</th>
                                            <th class="text-center align-middle">Loại Hàng Hóa</th>
                                            <th class="text-center align-middle">Tình Trạng</th>
                                            <th class="text-center align-middle">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template v-for="(v, k) in listData">
                                            <tr>
                                                <th class="text-center align-middle">@{{ k + 1 }}</th>
                                                <td class="text-center align-middle">@{{ v.ten_loai_hang }}</td>
                                                <td class="text-center align-middle">
                                                    <button v-on:click="changStatus(v)" v-if="v.tinh_trang" class="btn btn-success">Hiển Thị</button>
                                                    <button v-on:click="changStatus(v)" v-else class="btn btn-warning">Tạm Tắt</button>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <button v-on:click="deleteData = v" data-bs-toggle="modal" data-bs-target="#RepairModal"
                                                        class="btn btn-primary">Edit</button>
                                                    <button v-on:click="deleteData = v" data-bs-toggle="modal"
                                                        data-bs-target="#DeleteModal" class="btn btn-danger">Dell</button>
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
                                                <p>Bạn Có Chắc Muốn Xóa Loại Hàng <b>@{{ deleteData.ten_loai_hang }}</b> này không!!!
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button v-on:click="eraseData()" type="button" class="btn btn-danger">Xóa Loại Hàng</button>
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
                                                    <label>Loại Hàng Hóa</label>
                                                    <input v-model="deleteData.ten_loai_hang" type="text"
                                                        class="form-control" placeholder="Nhap vao Loai Hang Hoa ...">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button v-on:click="repairData()" type="button" class="btn btn-primary">Lưu Lại</button>
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
            $('title')[0].innerText = 'LC - ADMIN Loại Hàng Hóa';
        })
    </script>
    <script>
        new Vue({
            el: '#app',
            data: {
                them_moi: {},
                listData: [],
                deleteData: {}
            },
            created() {
                this.loadData();
            },
            methods: {
                creates() {
                    axios
                        .post('{{ Route('createLoaiHangHoa') }}', this.them_moi)
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
                        .post('{{ Route('dataLoaiHangHoa') }}')
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
                        .post('{{Route('updateLoaiHangHoa')}}', this.deleteData)
                        .then((res) => {
                            if(res.data.status) {
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
                        .post('{{Route('destroyLoaiHangHoa')}}', this.deleteData)
                        .then((res) => {
                            if(res.data.status) {
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
                        .post('{{Route('statusLoaiHangHoa')}}', payLoad)
                        .then((res) => {
                            if(res.data.status) {
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
