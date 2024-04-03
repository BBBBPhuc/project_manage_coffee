<!doctype html>
<html lang="en">

<head>
	@include('admin.shares.css')
</head>

<body class="bg-login">
	<!--wrapper-->
	<div id="app_login">
        <div class="wrapper">
            <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
                <div class="container-fluid">
                    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                        <div class="col mx-auto">
                            <div class="mb-4 text-center">
                                <img src="/assets_admin/assets/images/logo-img.png" width="180" alt="" />
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="border p-4 rounded">
                                        <div class="text-center">
                                            <h3 class="">Sign in</h3>
                                        </div>
                                        <div class="form-body">
                                            <div class="row g-3">
                                                <div class="col-12">
                                                    <label for="inputEmailAddress" class="form-label">Email</label>
                                                    <input v-model="dangnhap.email" id="inputEmail" type="email" class="form-control" placeholder="Email Address">
                                                </div>
                                                <div class="col-12">
                                                    <label for="inputChoosePassword" class="form-label">Enter Password</label>
                                                    <div class="input-group" id="show_hide_password">
                                                        <input v-on:keydown.enter="dangNhap()" v-model="dangnhap.password" type="password" class="form-control border-end-0" id="inputPassword" placeholder="Enter Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                                                        <label class="form-check-label" for="flexSwitchCheckChecked">Remember Me</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 text-end">	<a href="authentication-forgot-password.html">Forgot Password ?</a>
                                                </div>
                                                <div class="col-12">
                                                    <div class="d-grid">
                                                        <button v-on:click="dangNhap()" class="btn btn-primary"><i class="bx bxs-lock-open"></i>Sign in</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </div>
            </div>
        </div>
    </div>
	@include('admin.shares.js')
	<script>
		$(document).ready(function () {
            $('title')[0].innerText = 'LC - ADMIN Đăng Nhập';
            $('#inputEmail').focus();
			$("#show_hide_password a").on('click', function (event) {
				event.preventDefault();
				if ($('#show_hide_password input').attr("type") == "text") {
					$('#show_hide_password input').attr('type', 'password');
					$('#show_hide_password i').addClass("bx-hide");
					$('#show_hide_password i').removeClass("bx-show");
				} else if ($('#show_hide_password input').attr("type") == "password") {
					$('#show_hide_password input').attr('type', 'text');
					$('#show_hide_password i').removeClass("bx-hide");
					$('#show_hide_password i').addClass("bx-show");
				}
			});
            $('#inputEmail').on('keydown', function (e) {
                if (e.which == 13) {
                    if (e.target.value == "") {
                        var valueEmail = prompt('Vui Lòng Nhập Đầy Đủ Địa Chỉ Email');
                        this.value = valueEmail;
                    } else {
                        $('#inputPassword').focus();
                    }
                }
            });
		});
	</script>
    <script>
        new Vue({
            el      :   '#app_login',
            data    :   {
                dangnhap: {}
            },
            created()   {

            },
            methods :   {
                dangNhap() {
                    var inputPassword = $('#inputPassword')[0];
                    if (inputPassword.value == "") {
                        alert('Vui Lòng Nhập Thông Tin Vào Ô Này!');
                    } else {
                        axios
                        .post('{{Route('adminlogin')}}', this.dangnhap)
                        .then((res) => {
                            if(res.data.status) {
                                toastr.success(res.data.message, 'Success');
                                window.location.href = '/admin/khu-vuc'
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

                }
            },
        });
    </script>
</body>

</html>
