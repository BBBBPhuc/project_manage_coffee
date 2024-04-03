<!DOCTYPE html>
<html>
<head>
@include('client.share.css')
</head>

<body>

<div class="page-wrapper">

 	<!-- Main Header / Header Style Four -->
    <header class="main-header header-style-four">

        <!-- Header Lower -->
        <div class="header-lower">

			<div class="auto-container">
				<div class="inner-container d-flex justify-content-between align-items-center">

					<div class="logo-box d-flex align-items-center">
						<!-- Logo -->
						<div class="logo"><a href="/    "><img src="/assets_client/images/logo.png" alt="" title=""></a></div>
					</div>
					<div class="nav-outer clearfix">

						<!-- Main Menu -->
						<nav class="main-menu show navbar-expand-md">
							<div class="navbar-header">
								<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
							</div>

							<div class="navbar-collapse collapse clearfix" id="navbarSupportedContent">
								<ul class="navigation clearfix">
									<li class="dropdown"><a href="/assets_client/#">Home</a>
										<ul>
											<li><a href="/assets_client/index.html">Homepage One</a></li>
											<li><a href="/assets_client/index-2.html">Homepage Two</a></li>
											<li><a href="/assets_client/index-3.html">Homepage Three</a></li>
											<li class="dropdown"><a href="/assets_client/#">Header Styles</a>
												<ul>
													<li><a href="/assets_client/index.html">Header Style One</a></li>
													<li><a href="/assets_client/index-2.html">Header Style Two</a></li>
													<li><a href="/assets_client/index-3.html">Header Style Three</a></li>
												</ul>
											</li>
										</ul>
									</li>
									<li><a href="/assets_client/about.html">About</a></li>
									<li class="dropdown"><a href="/assets_client/#">Shop</a>
										<ul>
											<li><a href="/assets_client/shop.html">Our Products</a></li>
											<li><a href="/assets_client/shop-detail.html">Product Single</a></li>
											<li><a href="/assets_client/cart.html">Shoping Cart</a></li>
											<li><a href="/assets_client/checkout.html">CheckOut</a></li>
											<li><a href="/assets_client/register.html">Register</a></li>
										</ul>
									</li>
									<li class="dropdown"><a href="/assets_client/#">Blog</a>
										<ul>
											<li><a href="/assets_client/blog.html">Our Blog</a></li>
											<li><a href="/assets_client/blog-detail.html">Blog Single</a></li>
											<li><a href="/assets_client/not-found.html">Not Found</a></li>
										</ul>
									</li>
									<li><a href="/assets_client/contact.html">Contact us</a></li>
								</ul>
							</div>

						</nav>
						<!-- Main Menu End-->

					</div>

				</div>

			</div>
        </div>
        <!-- End Header Lower -->

		<!-- Sticky Header  -->
        <div class="sticky-header">
            <div class="auto-container">
				<div class="d-flex justify-content-between align-items-center">
					<!-- Logo -->
					<div class="logo">
						<a href="/assets_client/index.html" title=""><img src="/assets_client/images/logo-small.png" alt="" title=""></a>
					</div>

					<!-- Right Col -->
					<div class="right-box">
						<!-- Main Menu -->
						<nav class="main-menu">
							<!--Keep This Empty / Menu will come through Javascript-->
						</nav>
						<!-- Main Menu End-->

						<!-- Mobile Navigation Toggler -->
						<div class="mobile-nav-toggler"><span class="icon flaticon-menu"></span></div>
					</div>

				</div>
            </div>
        </div>

    </header>
    <hr style="margin-top: 10px">
    <div id="app_login">
        <div class="register-section">
            <div class="auto-container">
                <div class="inner-container">
                    <div class="row clearfix">
                        <!-- Column -->
                        <div class="column col-lg-6 col-md-12 col-sm-12">
                            <!-- Login Form -->
                            <div class="styled-form">
                                <h4>Sign Up</h4>
                                <form method="post" action="index.html">
                                    <div class="form-group">
                                        <label>Your Name</label>
                                        <input v-model="themMoi.ho_va_ten" type="text" name="username" value="" placeholder="Enter your name*" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Email address</label>
                                        <input v-model="themMoi.email" type="email" name="emaill" value="" placeholder="Enter Email Adress" required>
                                    </div>
                                    <div class="form-group">
                                        <label>New Password</label>
                                        <input v-model="themMoi.password" type="password" name="password" value="" placeholder="Create password" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Số Điện Thoại</label>
                                        <input v-model="themMoi.so_dien_thoai" type="tel" name="tel" value="" placeholder="Create password" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Ngày Sinh</label>
                                        <input v-model="themMoi.ngay_sinh" style="height: 58px" class="form-control rounded-pill" type="date" name="date" value="" placeholder="Create password" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Địa chỉ</label>
                                        <input v-model="themMoi.dia_chi" type="text" name="text" value="" placeholder="Create password" required>
                                    </div>
                                    <div class="form-group">
                                        <button v-on:click="register()" type="button" class="theme-btn btn-style-one">
                                            Sign Up
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Column -->
                        <div class="column col-lg-6 col-md-12 col-sm-12">
                            <!-- Login Form -->
                            <div class="styled-form">
                                <h4>Login here</h4>
                                <form method="post" action="index.html">
                                    <div class="form-group">
                                        <label>Email address</label>
                                        <input v-on:keydown.enter="inputDown()" v-model="login.email" type="email" name="emaill" placeholder="Enter Email Adress" required>
                                    </div>
                                    <div class="form-group">
                                        <label>New Password</label>
                                        <input v-on:keydown.enter="loginClient()" v-model="login.password" type="password" name="password" value="" placeholder="Create password" required>
                                    </div>
                                    <div class="form-group">
                                        <button v-on:click="loginClient()" type="button" class="theme-btn btn-style-one">
                                            Login here
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<!-- End Register Section -->
</div>
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-arrow-up"></span></div>
@include('client.share.js')
    <script>
        $(document).ready(function () {
            $('title')[0].innerText = 'LC - Đăng nhập và đăng kí';
        })
    </script>
<script>
    new Vue({
        el      :   '#app_login',
        data    :   {
            themMoi: {},
            login: {},
        },
        created()   {

        },
        methods :   {
            inputDown() {
                if (this.login.email === undefined || document.getElementsByName('emaill')[1].value == '') {
                    const valEmail =  prompt('Please enter your email address');
                    document.getElementsByName('emaill')[1].value = valEmail;
                } else {
                    document.getElementsByName('password')[1].focus();
                }
            },
            register() {
                axios
                    .post('{{Route('register')}}', this.themMoi)
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
            loginClient() {
                axios
                    .post('{{Route('login')}}', this.login)
                    .then((res) => {
                        if(res.data.status) {
                            toastr.success(res.data.message, 'Success');
                            window.location.href = '/'
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
</body>
</html>
