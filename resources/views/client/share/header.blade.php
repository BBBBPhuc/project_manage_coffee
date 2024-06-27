<header class="main-header header-style-two">
    <div id="app_header">
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
                        <div class="logo"><a href="/"><img src="/assets_client/images/logo.png" alt=""
                                    title=""></a></div>
                    </div>
                    <div class="middle-box">
                        <div class="upper-box d-flex justify-content-between align-items-center flex-wrap">
                        </div>
                        <div class="nav-outer d-flex justify-content-between align-items-center flex-wrap">
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
                            <div class="options-box d-flex align-items-center">
                                <div class="search-box-two">
                                    <div autocomplete="off" class="form-group">
                                        <div class="autocomplete">
                                            <input id="myInput" type="text" name="myCountry" value=""
                                                placeholder="Search" required>
                                        </div>
                                    </div>
                                </div>
                                <a href="/tai-khoan-ca-nhan"><i style="color: black"
                                        class="fa-solid fa-user-gear fa-xl"></i></a>
                                <div class="cart-box-two">
                                    <a href="/order"><i class="fa-solid fa-warehouse fa-sm"></i></a>
                                    <span class="total-like">0</span>
                                </div>
                                <div class="mobile-nav-toggler"><span class="icon flaticon-menu"></span></div>
                            </div>
                        </div>
                    </div>
                    <div class="button-box text-center mt-2">
                        @if (Auth::guard('client')->check())
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
        <hr>
        <div class="sticky-header">
            <div class="auto-container">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="logo">
                        <a href="/assets_client/index.html" title=""><img
                                src="/assets_client/assets_client/images/logo-small.png" alt=""
                                title=""></a>
                    </div>
                    <div class="right-box">
                        <nav class="main-menu">
                        </nav>
                        <div class="mobile-nav-toggler"><span class="icon flaticon-menu"></span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mobile-menu">
            <div class="menu-backdrop"></div>
            <div class="close-btn"><span class="icon flaticon-multiply"></span></div>
            <nav class="menu-box">
                <div class="nav-logo"><a href="/assets_client/index.html"><img
                            src="/assets_client/assets_client/images/mobile-logo.png" alt="" title=""></a>
                </div>
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
                </div>
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
                .post('{{ Route('countDonDatMon') }}')
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
        autocomplete: function() {
            var arr = ['1', '2', '3', '4', '5', '6', '7', '8', '9'];
            console.log(arr);
            var inp = document.getElementById("myInput")
            var currentFocus;
            inp.addEventListener("input", function(e) {
                var a, b, i, val = this.value;
                closeAllLists();
                if (!val) {
                    return false;
                }
                currentFocus = -1;
                a = document.createElement("DIV");
                a.setAttribute("id", this.id + "autocomplete-list");
                a.setAttribute("class", "autocomplete-items");
                this.parentNode.appendChild(a);
                for (i = 0; i < arr.length; i++) {
                    if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                        b = document.createElement("DIV");
                        b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                        b.innerHTML += arr[i].substr(val.length);
                        b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                        b.addEventListener("click", function(e) {
                            inp.value = this.getElementsByTagName("input")[0].value;
                            closeAllLists();
                        });
                        a.appendChild(b);
                    }
                }
            });
            inp.addEventListener("keydown", function(e) {
                var x = document.getElementById(this.id + "autocomplete-list");
                if (x) x = x.getElementsByTagName("div");
                if (e.keyCode == 40) {
                    currentFocus++;
                    addActive(x);
                } else if (e.keyCode == 38) {
                    currentFocus--;
                    addActive(x);
                } else if (e.keyCode == 13) {
                    e.preventDefault();
                    if (currentFocus > -1) {
                        if (x) x[currentFocus].click();
                    }
                }
            });

            function addActive(x) {
                if (!x) return false;
                removeActive(x);
                if (currentFocus >= x.length) currentFocus = 0;
                if (currentFocus < 0) currentFocus = (x.length - 1);
                x[currentFocus].classList.add("autocomplete-active");
            }

            function removeActive(x) {
                for (var i = 0; i < x.length; i++) {
                    x[i].classList.remove("autocomplete-active");
                }
            }

            function closeAllLists(elmnt) {
                var x = document.getElementsByClassName("autocomplete-items");
                for (var i = 0; i < x.length; i++) {
                    if (elmnt != x[i] && elmnt != inp) {
                        x[i].parentNode.removeChild(x[i]);
                    }
                }
            }
            document.addEventListener("click", function(e) {
                closeAllLists(e.target);
            });
        },
        render: function() {
            this.handleEvent();
            this.loadData();
            this.autocomplete();
        }
    }
    app_header.render();
</script>
