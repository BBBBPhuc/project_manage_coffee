@extends('admin.shares.master');
@section('noi_dung')
<div class="container" id="app">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <h6 class="mb-0 text-uppercase">DANH SÁCH TÀI KHOẢN</h6>
        </div>
        {{-- Nút Thêm Acc --}}
        <div class="ms-auto">
            <button data-bs-toggle="modal" data-bs-target="#themAccModal" type="button" class="btn btn-primary">Tài Khoản
                Mới</button>
            <div class="modal fade" id="themAccModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Thêm Tài Khoản Mới</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <label class="mb-2">Email</label>
                                    <input v-model="themmoi.email" type="email" class="form-control mb-2"
                                        placeholder="Nhập vào Email">
                                </div>
                                <div class="col">
                                    <label class="mb-2">Mật Khẩu</label>
                                    <input v-model="themmoi.password" type="text" class="form-control mb-2"
                                        placeholder="Nhập vào mật khẩu">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label class="mb-2">Họ Và Tên</label>
                                    <input v-model="themmoi.ho_va_ten" type="text" class="form-control mb-2"
                                        placeholder="Nhập vào họ và tên">
                                </div>
                                <div class="col">
                                    <label class="mb-2">Số Điện Thoại</label>
                                    <input v-model="themmoi.so_dien_thoai" type="tel" class="form-control mb-2"
                                        placeholder="Nhập vào số điện thoại">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label class="mb-2">Ngày Sinh</label>
                                    <input v-model="themmoi.ngay_sinh" type="date" class="form-control mb-2"
                                        placeholder="Nhập vào ngày sinh">
                                </div>
                                <div class="col">
                                    <label class="mb-2">Địa chỉ</label>
                                    <textarea v-model="themmoi.dia_chi" rows="1" class="form-control mb-2" placeholder="Nhập vào địa chỉ"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label class="mb-2">Is Block</label>
                                    <select v-model="themmoi.is_block" class="form-control mb-2">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label class="mb-2">Tình Trạng</label>
                                    <select v-model="themmoi.tinh_trang"  class="form-control mb-2">
                                        <option value="1">Đang Hoạt Động</option>
                                        <option value="0">Dừng Hoạt Động</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">đóng</button>
                            <button v-on:click="them_moi()" type="button" class="btn btn-primary">thêm mới </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr />
        <div class="row">
          <div class="col">
            <div class="card">
                <div class="card-header">
                    Danh Sách Tài Khoản
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <div class="input-group mb-3">
                                <input v-on:keyup="timkiemthongtin()"  type="text" v-model="searchoke.tt" class="form-control" placeholder="tìm kiếm thông tin" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <button v-on:click="timkiemthongtin()"  class="btn btn-primary">search!</button>
                            </div>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">họ và tên</th>
                                <th class="text-center">email</th>
                                <th class="text-center">số điện thoại</th>
                                <th class="text-center">ngày sinh</th>
                                <th class="text-center">địa chỉ</th>
                                <th class="text-center">is_block</th>
                                <th class="text-center">tình trạng</th>
                                <th class="text-center">option</th>
                            </tr>
                        </thead>
                        <tbody>
                           <template v-for="(v,k) in list_taikhoan">
                            <tr>
                                <th class="text-nowrap text-center align-middle">@{{k+1}}</th>
                                <td class="text-nowrap text-center align-middle">@{{v.ho_va_ten}}</td>
                                <td class="text-nowrap text-center align-middle">@{{v.email}}</td>
                                <td class="text-nowrap text-center align-middle">@{{v.so_dien_thoai}}</td>
                                <td class="text-nowrap text-center align-middle">@{{v.ngay_sinh}}</td>
                                <td class="text-nowrap text-center align-middle">@{{v.dia_chi}}</td>
                                <td class="text-nowrap text-center align-middle">@{{v.is_block}}</td>
                                <td class="text-nowrap text-center align-middle">
                                    <button v-on:click="status(v)" v-if="v.tinh_trang==1" class="btn btn-primary">Đang Hoạt Động</button>
                                    <button  v-on:click="status(v)" v-else class="btn btn-warning">Dừng Hoạt Động</button>
                                </td>
                                <td class="text-nowrap text-center">
                                    <button v-on:click="edit = v" data-bs-toggle="modal" data-bs-target="#capnhat" class="btn btn-info">Cập Nhập</button>
                                    <button v-on:click="xoabo=v" data-bs-toggle="modal" data-bs-target="#xoabo" class="btn btn-danger">Xóa Bỏ</button>
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
        {{-- xóa bỏ --}}
        <div class="modal fade" id="xoabo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa Bỏ</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                            <div class="alert alert-danger" role="alert">
                                bạn có chắc muốn xóa <b><span class="text-danger">@{{xoabo.email}}</span></b> này không?
                              </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">đóng</button>
                  <button v-on:click="xoadi()" type="button" class="btn btn-primary">xóa bỏ</button>
                </div>
              </div>
            </div>
          </div>

          {{-- cập nhật  --}}
          <div class="modal fade" id="capnhat" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cập Nhập</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <label class="mb-2">Email</label>
                                <input v-model="edit.email"  type="email" class="form-control mb-2"
                                    placeholder="Nhập vào Email">
                            </div>
                            <div class="col">
                                <label class="mb-2">Mật Khẩu</label>
                                <input v-model="edit.password" type="text" class="form-control mb-2"
                                    placeholder="Nhập vào mật khẩu">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label class="mb-2">Họ Và Tên</label>
                                <input v-model="edit.ho_va_ten"  type="text" class="form-control mb-2"
                                    placeholder="Nhập vào họ và tên">
                            </div>
                            <div class="col">
                                <label class="mb-2">Số Điện Thoại</label>
                                <input v-model="edit.so_dien_thoai"  type="tel" class="form-control mb-2"
                                    placeholder="Nhập vào số điện thoại">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label class="mb-2">Ngày Sinh</label>
                                <input v-model="edit.ngay_sinh"  type="date" class="form-control mb-2"
                                    placeholder="Nhập vào ngày sinh">
                            </div>
                            <div class="col">
                                <label class="mb-2">Địa chỉ</label>
                                <textarea v-model="edit.dia_chi" rows="1" class="form-control mb-2" placeholder="Nhập vào địa chỉ"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label class="mb-2">Is Block</label>
                                <select v-model="edit.is_block" class="form-control mb-2">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div class="col">
                                <label  class="mb-2">Tình Trạng</label>
                                <select v-model="edit.tinh_trang" class="form-control mb-2">
                                    <option value="1">Đang Hoạt Động</option>
                                    <option value="0">Dừng Hoạt Động</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button v-on:click="update()" type="button" class="btn btn-primary">cập nhật</button>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $('title')[0].innerText = 'LC - ADMIN Danh Sách Tài Khoản';
        })
    </script>
    <script>
        new Vue({
            el      :   '#app',
            data    :   {
                themmoi : {} ,
                xoabo : {} ,
                edit : {},
                searchoke : {},
                list_taikhoan : [] ,
            },
            created()   {
                this.loaDdata();
            },
            methods :   {
                them_moi(){
                    axios
                        .post('{{Route("create")}}', this.themmoi)
                        .then((res) => {
                            if(res.data.status) {
                                toastr.success(res.data.message, 'Success');
                                this.loaDdata();
                                $('#themAccModal').modal('hide');
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
                loaDdata(){
                    axios
                        .post('{{Route("datataikhoan")}}')
                        .then((res) => {
                            this.list_taikhoan = res.data.data;
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0], 'Error');
                            });
                        });
                },
                xoadi(){
                    axios
                        .post('{{Route("xoabo")}}', this.xoabo)
                        .then((res) => {
                            if(res.data.status) {
                                this.loaDdata();
                                toastr.success(res.data.message, 'Success');
                                $('#xoabo').modal('hide');
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
                update(){
                    axios
                        .post('{{Route("capnhat")}}', this.edit)
                        .then((res) => {
                            if(res.data.status) {
                                this.loaDdata();
                                toastr.success(res.data.message, 'Success');
                                $('#capnhat').modal('hide');
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
                status(payload){
                    axios
                        .post('{{Route("doitrangthai")}}', payload)
                        .then((res) => {
                            if(res.data.status) {
                                this.loaDdata();
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
                timkiemthongtin(){
                    axios
                        .post('{{Route("search")}}', this.searchoke)
                        .then((res) => {
                            this.list_taikhoan = res.data.xxx;
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
