@extends('admin.shares.master');
@section('noi_dung')
    <div id="app">
        <div class="row">
            <div class="col-9">
                <div class="row">
                    <div class="input-group">
                        <input v-model="search.tt" v-on:keyup="searchHangHoa()" type="text" class="form-control" placeholder="Nhập Từ Khóa Tìm Kiếm">
                    </div>
                </div>
            </div>
            <div class="col-3 text-end">
                <button data-bs-toggle="modal" data-bs-target="#ThemMoiModal" class="btn btn-primary">Thêm Mặt Hàng</button>
            </div>
        </div>
        <hr>
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header bg-primary text-center">
                            <b class="text-light">Danh Sách Hàng Hóa</b>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center align-middle">ID</th>
                                            <th class="text-center align-middle">Hàng Hóa</th>
                                            <th class="text-center align-middle">Tình Trạng</th>
                                            <th class="text-center align-middle">Loại Hàng</th>
                                            <th class="text-center align-middle">Mô Tả</th>
                                            <th class="text-center align-middle">Hình Ảnh</th>
                                            <th class="text-center align-middle">Giá Hàng Hóa</th>
                                            <th class="text-center align-middle">Đơn Vị</th>
                                            <th class="text-center align-middle">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template v-for="(v, k) in listData">
                                            <tr>
                                                <th class="text-center align-middle">@{{ (k + 1) }}</th>
                                                <td class="text-center align-middle">@{{ v.ten_hang_hoa }}</td>
                                                <td class="text-center align-middle text-nowrap">
                                                    <button v-on:click="changStatus(v)" v-if="v.tinh_trang == 1" class="btn btn-success">Hiển
                                                        Thị</button>
                                                    <button v-on:click="changStatus(v)" v-else class="btn btn-warning">Tạm Tắt</button>
                                                </td>
                                                <template v-for="(v1, k1) in loai_hang_hoa">
                                                    <td v-if="v1.id == v.id_loai_hang_hoa" class="text-center align-middle">@{{ v.ten_loai_hang }}</td>
                                                </template>
                                                <td class="text-center align-middle">
                                                    <i v-on:click="chi_tiet = Object.assign({}, v)" data-bs-toggle="modal"
                                                        data-bs-target="#MoTaModal" class="fa-2x fa-solid fa-circle-info"
                                                        style="color: #0dd91a;"></i>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <img v-bind:src="v.hinh_anh"  class="img-thumbnail"
                                                        style="height: 100px; width: 150px; object-fit: cover">
                                                </td>
                                                <td class="text-center align-middle">@{{ vnd(v.gia_hang_hoa) }}</td>
                                                <td class="text-center align-middle">@{{ v.ten_don_vi }}</td>
                                                <td class="text-center align-middle text-nowrap">
                                                    <button v-on:click="deleteData = Object.assign({}, v)" data-bs-toggle="modal" data-bs-target="#RepairModal"
                                                        class="btn btn-primary">
                                                        Edit
                                                    </button>
                                                    <button v-on:click="deleteData = Object.assign({}, v)" data-bs-toggle="modal" data-bs-target="#DeleteModal"
                                                        class="btn btn-danger">
                                                        Del
                                                    </button>
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
                                                <h5 class="modal-title" id="exampleModalLabel">Xóa Hàng Hóa</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body bg-warning">
                                                <p>Bạn Có Chắc Muốn Xóa Sản Phẩm <b>@{{ deleteData.ten_hang_hoa }}</b> này không!!!
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button v-on:click="eraseData()" type="button"
                                                    class="btn btn-danger">Xóa</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="RepairModal" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Cập Nhật</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-2">
                                                    <label>Tên Hàng Hóa</label>
                                                    <input v-model="deleteData.ten_hang_hoa" type="text"
                                                        class="form-control"
                                                        placeholder="Nhap vao Ten Hang Hoa ...">
                                                </div>
                                                <div class="mb-2">
                                                    <label>Loại Hàng Hóa</label>
                                                    <select class="form-select" v-model="deleteData.id_loai_hang_hoa">
                                                        <template v-for="(v, k) in loai_hang_hoa" v-if="v.tinh_trang == 1">
                                                            <option v-bind:value="v.id">@{{ v.ten_loai_hang }}</option>
                                                        </template>
                                                    </select>
                                                </div>
                                                <div class="mb-2">
                                                    <label>Hình Ảnh</label>
                                                    <input v-model="deleteData.hinh_anh" type="text"
                                                        class="form-control"
                                                        placeholder="Nhap vao Hinh Anh ...">
                                                </div>
                                                <div class="mb-2">
                                                    <label>Giá Hàng Hóa</label>
                                                    <input v-model="deleteData.gia_hang_hoa" type="text"
                                                        class="form-control"
                                                        placeholder="Nhap vao Gia Hang Hoa ...">
                                                </div>
                                                <div class="mb-2">
                                                    <label>Mô Tả</label>
                                                    <textarea v-model="deleteData.mo_ta" cols="30" rows="5" class="form-control"
                                                        placeholder="Nhập vào Mo Ta"></textarea>
                                                </div>
                                                <div class="mb-2">
                                                    <label>Đơn Vị</label>
                                                    <select class="form-select" v-model="deleteData.id_don_vi">
                                                        <template v-for="(v, k) in don_vi" v-if="v.tinh_trang == 1">
                                                            <option v-bind:value="v.id">@{{ v.ten_don_vi }}</option>
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
                                <div class="modal fade" id="MoTaModal" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Mô Tả</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-2">
                                                    "@{{ chi_tiet.mo_ta }}"
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
                                <div class="modal fade" id="ThemMoiModal" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Thêm Hàng Hóa</h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-2">
                                                    <label>Tên Hàng Hóa</label>
                                                    <input v-model="them_moi.ten_hang_hoa" type="text"
                                                        class="form-control"
                                                        placeholder="Nhap vao Ten Hang Hoa ...">
                                                </div>
                                                <div class="mb-2">
                                                    <label>Loại Hàng Hóa</label>
                                                    <select class="form-select" v-model="them_moi.id_loai_hang_hoa">
                                                        <template v-for="(v, k) in loai_hang_hoa" v-if="v.tinh_trang == 1">
                                                            <option v-bind:value="v.id">@{{ v.ten_loai_hang }}</option>
                                                        </template>
                                                    </select>
                                                </div>
                                                <div class="mb-2">
                                                    <label>Hình Ảnh</label>
                                                    <input v-model="them_moi.hinh_anh" type="text"
                                                        class="form-control"
                                                        placeholder="Nhap vao Hinh Anh ...">
                                                </div>
                                                <div class="mb-2">
                                                    <label>Giá Hàng Hóa</label>
                                                    <input v-model="them_moi.gia_hang_hoa" type="text"
                                                        class="form-control"
                                                        placeholder="Nhap vao Gia Hang Hoa ...">
                                                </div>
                                                <div class="mb-2">
                                                    <label>Mô Tả</label>
                                                    <textarea v-model="them_moi.mo_ta" cols="30" rows="5" class="form-control"
                                                        placeholder="Nhập vào Mo Ta"></textarea>
                                                </div>
                                                <div class="mb-2">
                                                    <label>Đơn Vị</label>
                                                    <select class="form-select" v-model="them_moi.id_don_vi">
                                                        <template v-for="(v, k) in don_vi" v-if="v.tinh_trang == 1">
                                                            <option v-bind:value="v.id">@{{ v.ten_don_vi }}</option>
                                                        </template>
                                                    </select>
                                                </div>
                                                <div class="mb-2">
                                                    <label>Tình Trạng</label>
                                                    <select v-model="them_moi.tinh_trang"
                                                        class="form-select" aria-label="Default select example">
                                                        <option selected>--- Mời chọn tình trạng ---
                                                        </option>
                                                        <option value="1"> Hiển Thị </option>
                                                        <option value="0"> Không Hiển Thị</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button v-on:click="creates()" type="button"
                                                    class="btn btn-primary" data-bs-dismiss="modal">Lưu Lại</button>
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
            $('title')[0].innerText = 'LC - ADMIN Hàng Hóa';
        })
    </script>
    <script>
        new Vue({
            el: '#app',
            data: {
                them_moi: {},
                listData: [],
                deleteData: {},
                chi_tiet: {},
                don_vi: [],
                loai_hang_hoa: [],
                search: {},
            },
            created() {
                this.loadData();
            },
            methods: {
                creates() {
                    axios
                        .post('{{ Route('createHangHoa') }}', this.them_moi)
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
                vnd(number) {
                    return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(number)
                },
                loadData() {
                    axios
                        .post('{{ route('dataHangHoa') }}')
                        .then((res) => {
                            this.listData = res.data.data;
                            this.don_vi = res.data.don_vi;
                            this.loai_hang_hoa = res.data.loai_hang_hoa;
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0], 'Error');
                            });
                        });
                },
                repairData() {
                    axios
                        .post('{{ Route('updateHangHoa') }}', this.deleteData)
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
                        .post('{{ Route('deleteHangHoa') }}', this.deleteData)
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
                        .post('{{ Route('statusHangHoa') }}', payLoad)
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
                searchHangHoa() {
                    axios
                        .post('{{ route("searchHangHoa") }}', this.search)
                        .then((res) => {
                            this.listData = res.data.data;
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
