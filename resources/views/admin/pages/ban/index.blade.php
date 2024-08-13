@extends('admin.shares.master')
@section('noi_dung')
    <div id="app">
        <div class="row">
            <div class="col-9">
                <div class="card">
                    <div class="card-header">
                        Bàn
                    </div>
                    <div class="card-body">
                        <template v-for="row in rows">
                            <div class="row">
                                <template v-for="(v, k) in listData">
                                    <template v-if="k < row * 8 && k >= (row * 8 - 8)">
                                        <template v-if="v.id_khu_vuc == floor">
                                            <div class="col">
                                                <div v-if="v.tinh_trang == 0" class="card bg-success">
                                                    <div class="card-body text-center">
                                                        <span class="text-white">@{{ v.ten_ban }}</span>
                                                    </div>
                                                </div>
                                                <div v-if="v.tinh_trang == -1" class="card bg-danger">
                                                    <div class="card-body text-center">
                                                        <span class="text-white">@{{ v.ten_ban }}</span>
                                                    </div>
                                                </div>
                                                <div v-if="v.tinh_trang == 1" class="card bg-warning">
                                                    <div class="card-body text-center">
                                                        <span class="text-white">@{{ v.ten_ban }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </template>
                                    </template>
                                </template>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-start">
                            <button v-on:click="loadData()" class="btn btn-primary mx-1"><i
                                    class="fa-solid fa-spinner"></i></button>
                            <button v-on:click="floor = 1" class="btn btn-primary mx-1">Tầng 1</button>
                            <button v-on:click="floor = 2" class="btn btn-primary mx-1">Tầng 2</button>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">

                    </div>
                    <div class="card-body">
                        <div class="mb-2">
                            <label>Tên Bàn</label>
                            <input v-model="them_moi.ten_ban" type="text" class="form-control"
                                placeholder="Nhập vào tên khu vực ...">
                        </div>
                        <div class="mb-2">
                            <label>Số Bàn</label>
                                <select v-model="them_moi.id_khu_vuc" class="form-control">
                                    <option selected value="">--- Mời Chọn Tình Trạng ---</option>
                                    <template v-for="(v, k) in dataKhuVuc">
                                        <option v-bind:value="v.id">@{{ v.ten_khu_vuc }}</option>
                                    </template>
                                </select>
                        </div>
                        <div class="mb-2">
                            <label>Tình Trạng</label>
                            <select v-model="them_moi.tinh_trang" class="form-control">
                                <option selected value="">--- Mời Chọn Tình Trạng ---</option>
                                <option value="1"> Đã Đặt </option>
                                <option value="-1"> Chưa Sẵn Sàng </option>
                                <option value="0"> Sẵn Sàng </option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button v-on:click="themmoi()" class="btn btn-primary">Thêm Mới</button>
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
            el: '#app',
            data: {
                listData: [],
                cols: [],
                rows: 0,
                floor: 1,
                dataKhuVuc: [],
                them_moi: {}
            },
            created() {
                this.loadData();
            },
            methods: {
                themmoi() {
                    axios
                        .post('{{ Route('createBan') }}', this.them_moi)
                        .then((res) => {
                            if(res.data.status) {
                                toastr.success(res.data.message, 'Success');
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
                        .post('{{ Route('dataBan') }}')
                        .then((res) => {
                            this.listData = res.data.data;
                            this.rows = Math.ceil(this.listData.length / 8);
                            this.dataKhuVuc = res.data.dataKhuVuc;
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
