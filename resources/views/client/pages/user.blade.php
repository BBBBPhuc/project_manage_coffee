@extends('client.share.master')
@section('noi_dung')
    <div class="contact-page-section">
        <div class="auto-container">
            <div class="contact-boxed">
                <div class="title-box">
                    <h3>TÀI KHOẢN CÁ NHÂN</h3>
                    <div class="text">Cập Nhật Những Thông Tin Tài Khoản Của Bạn <i style="color: red"
                            class="fa-solid fa-face-kiss-wink-heart"></i></div>
                </div>
                <div class="modal" id="passwordModal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Xác Minh Đây Chính Là Bạn</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-2">
                                    <label> Nhập Mật Khẩu Hiện Tại </label>
                                    <input type="password" name="passcurr" class="form-control rounded-0">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" name="btnSave" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="contact-form">
                    <div style="width: 1000px" class="col-lg-6 col-md-6 col-sm-12 form-group">
                        <div class="row">
                            <div class="col-md-11">
                                <label>Đặt Lại Mật Khẩu Mới</label>
                                <input type="password" name="userpassword" class="input"
                                    placeholder="Enter Your New Password..." readonly required="">
                            </div>
                            <div class="col-md-1 mt-4">
                                <i style="margin-top: 25px" class="fa-solid fa-pen-to-square fa-2xl"></i>
                            </div>
                        </div>
                    </div>
                    <div style="width: 1000px" class="col-lg-6 col-md-6 col-sm-12 form-group">
                        <div class="row">
                            <div class="col-md-11">
                                <label>Họ Và Tên</label>
                                <input type="text" name="userfullname" class="input"
                                    placeholder="Enter Your Full Name..." readonly required="">
                            </div>
                            <div class="col-md-1 mt-4">
                                <i style="margin-top: 25px" class="fa-solid fa-pen-to-square fa-2xl"></i>
                            </div>
                        </div>
                    </div>
                    <div style="width: 1000px" class="col-lg-6 col-md-6 col-sm-12 form-group">
                        <div class="row">
                            <div class="col-md-11">
                                <label>Địa Chỉ</label>
                                <input type="text" name="useraddress" class="input" placeholder="Enter Your Address..."
                                    readonly required="">
                            </div>
                            <div class="col-md-1 mt-4">
                                <i style="margin-top: 25px" class="fa-solid fa-pen-to-square fa-2xl"></i>
                            </div>
                        </div>
                    </div>
                    <div style="width: 1000px" class="col-lg-6 col-md-6 col-sm-12 form-group">
                        <div class="row">
                            <div class="col-md-11">
                                <label>Số Điện Thoại</label>
                                <input type="tel" name="userphone" class="input"
                                    placeholder="Enter Your NumberPhone..." readonly required="">
                            </div>
                            <div class="col-md-1 mt-4">
                                <i style="margin-top: 25px" class="fa-solid fa-pen-to-square fa-2xl"></i>
                            </div>
                        </div>
                    </div>
                    <div style="width: 1000px" class="col-lg-6 col-md-6 col-sm-12 form-group">
                        <div class="row">
                            <div class="col-md-11">
                                <label>Ngày Sinh</label>
                                <input style="height: 55px; text-indent: 5px; background-color: rgb(253, 250, 250)"
                                    type="date" class="form-control rounded-0 input" name="userdate"
                                    placeholder="Enter Your Birthday..." readonly required="">
                            </div>
                            <div class="col-md-1 mt-4">
                                <i style="margin-top: 25px" class="fa-solid fa-pen-to-square fa-2xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                        <div class="buttons-box">
                            <button data-bs-toggle="modal" data-bs-target="#passwordModal" class="theme-btn btn-style-one">
                                Lưu Thay Đổi
                            </button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('js')
    <script>
        const $ = document.querySelector.bind(document);
        const $$ = document.querySelectorAll.bind(document);
        const inputPassword = $('input[name="userpassword"]');
        const inputBirth = $('input[type="date"]');
        const inputPhone = $('input[type="tel"]');
        const inputAddress = $('input[name="useraddress"]');
        const inputFullName = $('input[name="userfullname"]');
        const iconEdit = $$('.fa-solid.fa-pen-to-square.fa-2xl');
        const input = $$('.input');
        const btnSave = $('button[name="btnSave"]');
        const passcurr = $('input[name="passcurr"]');
        const modal = $('#passwordModal');
        const myModal = new bootstrap.Modal(modal);
        const app = {
            is_animation: false,
            data: {},
            passCurrent: {},
            loadData: function() {
                axios
                    .post('{{ Route('dataUser') }}')
                    .then((res) => {
                        this.data = res.data.dataUser;
                        this.setValueInput();
                    })
                    .catch((res) => {
                        $.each(res.response.data.errors, function(k, v) {
                            toastr.error(v[0], 'Error');
                        });
                    });
            },
            handleEvent: function() {
                // mouse event icon
                for (let i = 0; i < iconEdit.length; i++) {
                    iconEdit[i].onmouseenter = function() {
                        if (!app.is_animation) {
                            iconEdit[i].classList.add('fa-beat');
                            app.is_animation = true;
                        }
                    };
                    iconEdit[i].onmouseleave = function() {
                        if (app.is_animation) {
                            iconEdit[i].classList.remove('fa-beat');
                            app.is_animation = false;
                        }
                    }
                };
                // onclick icon
                for (let i = 0; i < iconEdit.length; i++) {
                    iconEdit[i].onclick = function() {
                        input[i].removeAttribute("readonly");
                        input[i].focus();
                    };
                };
                // onclick save modal
                btnSave.onclick = function() {
                    app.passCurrent.pass = passcurr.value;
                    app.passCurrent.password = inputPassword.value;
                    app.passCurrent.dia_chi = inputAddress.value;
                    app.passCurrent.so_dien_thoai = inputPhone.value;
                    app.passCurrent.ngay_sinh = inputBirth.value;
                    app.passCurrent.ho_va_ten = inputFullName.value;
                    axios
                        .post('{{Route('checkUser')}}', app.passCurrent)
                        .then((res) => {
                            if(res.data.status) {
                                toastr.success(res.data.message, 'Success');
                                myModal.hide();
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
            setValueInput: function() {
                inputBirth.value = this.data.ngay_sinh;
                inputPhone.value = this.data.so_dien_thoai;
                inputAddress.value = this.data.dia_chi;
                inputFullName.value = this.data.ho_va_ten;
            },
            render: function() {
                this.loadData();
                this.handleEvent();
            }
        };
        app.render();
    </script>
@endsection
