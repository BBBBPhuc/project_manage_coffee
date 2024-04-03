<header class="main-header header-style-two">
    <div id="app_header">
        <!-- Header Lower -->
        <div class="header-lower">

            <div class="auto-container">
                <div class="inner-container d-flex justify-content-between align-items-center">
                    <!-- Logo Box -->
                    <div class="logo-box d-flex align-items-center">
                        <div class="nav-toggle-btn a-nav-toggle navSidebar-button">
                            <span class="hamburger">
                                <span class="top-bun"></span>
                                <span class="meat"></span>
                                <span class="bottom-bun"></span>
                            </span>
                        </div>
                        <!-- Logo -->
                        <div class="logo"><a href="/"><img src="/assets_client/images/logo.png" alt=""
                                    title=""></a></div>
                    </div>
                    <div class="middle-box">
                        <div class="upper-box d-flex justify-content-between align-items-center flex-wrap">

                            <!-- Info List -->


                            <!-- Upper Right -->

                        </div>

                        <div class="nav-outer d-flex justify-content-between align-items-center flex-wrap">

                            <!-- Main Menu -->
                            <nav class="main-menu show navbar-expand-md">
                                <div class="navbar-header">
                                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                        aria-expanded="false" aria-label="Toggle navigation">
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
                                                        <li><a href="/assets_client/index.html">Header Style One</a>
                                                        </li>
                                                        <li><a href="/assets_client/index-2.html">Header Style Two</a>
                                                        </li>
                                                        <li><a href="/assets_client/index-3.html">Header Style Three</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li style="margin-left: 10px"><a href="/shop">SHOP</a></li>
                                        <li style="margin-left: 10px"><a href="/order">ORDER</a></li>
                                    </ul>
                                </div>

                            </nav>
                            <!-- Main Menu End-->

                            <!-- Options Box -->
                            <div class="options-box d-flex align-items-center">

                                <!-- Search Box -->
                                <div class="search-box-two">
                                    <form method="post" action="contact.html">
                                        <div class="form-group">
                                            <input type="search" name="search-field" value=""
                                                placeholder="Search" required>
                                            <button type="submit"><span class="icon flaticon-search"></span></button>
                                        </div>
                                    </form>
                                </div>

                                <!-- User Box -->
                                {{-- <a class="user-box flaticon-user-3" href="/tai-khoan-ca-nhan"></a> --}}
                                <a href="/tai-khoan-ca-nhan"><i style="color: black" class="fa-solid fa-user-gear fa-xl"></i></a>
                                <!-- Cart Box -->
                                <div class="cart-box-two">
                                    <a href="/order"><i class="fa-solid fa-warehouse fa-sm"></i></a>
                                    <span class="total-like">0</span>
                                </div>

                                <!-- Mobile Navigation Toggler -->
                                <div class="mobile-nav-toggler"><span class="icon flaticon-menu"></span></div>

                            </div>

                        </div>

                    </div>

                    <!-- Button Box -->
                        <div class="button-box text-center mt-2">
                            @if(Auth::guard('client')->check())
                            <a href="/logout" class="theme-btn btn-style-one">
                                LOG OUT <span class="icon flaticon-right-arrow"></span>
                            </a>
                        @else
                            <a href="/login&register" class="theme-btn btn-style-one">
                                Login / Sign Up <span class="icon flaticon-right-arrow"></span>
                            </a>
                        @endif
                        </div>

                </div>
            </div>
        </div>
        <!-- End Header Lower -->
        <hr>
        <!-- Sticky Header  -->
        <div class="sticky-header">
            <div class="auto-container">
                <div class="d-flex justify-content-between align-items-center">
                    <!-- Logo -->
                    <div class="logo">
                        <a href="/assets_client/index.html" title=""><img
                                src="/assets_client/assets_client/images/logo-small.png" alt=""
                                title=""></a>
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
        <!-- End Sticky Menu -->

        <!-- Mobile Menu  -->
        <div class="mobile-menu">
            <div class="menu-backdrop"></div>
            <div class="close-btn"><span class="icon flaticon-multiply"></span></div>
            <nav class="menu-box">
                <div class="nav-logo"><a href="/assets_client/index.html"><img
                            src="/assets_client/assets_client/images/mobile-logo.png" alt=""
                            title=""></a></div>
                <!-- Search -->
                <div class="search-box">
                    <form method="post" action="contact.html">
                        <div class="form-group">
                            <input type="search" name="search-field" value="" placeholder="SEARCH HERE"
                                required>
                            <button type="submit"><span class="icon flaticon-search-1"></span></button>
                        </div>
                    </form>
                </div>
                <div class="menu-outer">
                    <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
            </nav>
        </div>
    </div>
</header>
<script>
    const iconWarseHouse = $('.fa-solid.fa-warehouse.fa-sm')[0];
    const iconUser = $('.fa-solid.fa-user-gear')[0];
    const icon_count = $('.total-like')[0];
    const app_header = {
        is_beat: false,
        count: {},
        loadData: function() {
            axios
                .post('{{Route('countDonDatMon')}}')
                .then((res) => {
                    app_header.count = res.data.data;
                    icon_count.textContent = app_header.count.so_luong;
                })
                .catch((res) => {
                    $.each(res.response.data.errors, function(k, v) {
                        toastr.error(v[0], 'Error');
                    });
                });
        },
        handleEvent: function() {
            const _this = this;
            iconWarseHouse.onmouseenter = function() {
                if (!_this.is_beat) {
                    iconWarseHouse.classList.add('fa-beat-fade');
                    _this.is_beat = true;
                }
            };
            iconWarseHouse.onmouseleave = function() {
                if (_this.is_beat) {
                    iconWarseHouse.classList.remove('fa-beat-fade');
                    _this.is_beat = false;
                }
            }

            iconUser.onmouseenter = function() {
                if (!_this.is_beat) {
                    iconUser.classList.add('fa-beat-fade');
                    _this.is_beat = true;
                }
            };
            iconUser.onmouseleave = function() {
                if (_this.is_beat) {
                    iconUser.classList.remove('fa-beat-fade');
                    _this.is_beat = false;
                }
            }
        },
        render: function() {
            this.handleEvent();
            this.loadData();
        }
    }
    app_header.render();
</script>
