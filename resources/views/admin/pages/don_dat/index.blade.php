@extends('admin.shares.master');
@section('noi_dung')
    <div id="app">
        <div class="d-flex mb-3">
            <div class="p-2">
                <h6>DANH SÁCH ĐƠN ĐẶT</h6>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-7">
                <div id="grub" class="card">
                    <div class="card-header bg-primary text-center align-middle">
                        <b class="text-light">Danh Sách Đơn Đặt</b>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center align-middle">#</th>
                                        <th class="text-center align-middle">Tên Sản Phẩm</th>
                                        <th class="text-center align-middle">Giá tiền</th>
                                        <th class="text-center align-middle">Số Lượng</th>
                                        <th class="text-center align-middle">Action</th>
                                        <th class="text-center align-middle">Thành Tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-for = "(v, k) in listGrub">
                                        <tr>
                                            <th v-on:click="deleteItem(v.id_don_dat, k)" class="text-center align-middle"><i
                                                    style="color: red" class="fa-solid fa-calendar-xmark"></i></th>
                                            <td class="text-center align-middle">@{{ v.ten_hang_hoa }}</td>
                                            <td class="text-center align-middle">@{{ vnd(v.gia_hang_hoa) }}</td>
                                            <td class="text-center align-middle">@{{ v.so_luong }}</td>
                                            <td class="text-center align-middle">
                                                <button v-on:click="tru2(k)" class="btn btn-primary">-</button>
                                                <button v-on:click="cong2(k)" class="btn btn-primary">+</button>
                                            </td>
                                            <td id="thanhtien" class="text-center align-middle">@{{ vnd(v.gia_hang_hoa * v.so_luong) }}</td>
                                        </tr>
                                    </template>
                                </tbody>
                                <div class="card-footer">
                                    <button id="choosePttt" class="btn btn-outline-primary">Chọn Phương Thức Thanh Toán
                                        Thanh Toán</button>
                                    <button @click="huyDon()" style="margin-left: 300px" class="btn btn-danger">Hủy Đặt
                                        Đơn</button>
                                </div>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <h6>Tổng Tiền: <b>@{{ total }}</b></h6>
                    </div>
                </div>
                <div id="pttt" class="card d-none">
                    <div class="card-header bg-primary">
                        Phương Thức Thanh Toán
                    </div>
                    <div class="card-body">
                        <div id="tienmat" class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-2">
                                        <i style="color: green;" class="fa-solid fa-money-check-dollar fa-6x"></i>
                                    </div>
                                    <div class="col-4">
                                        <h6>Thanh Toán Bằng Tiền Mặt</h6>
                                        <p>Loại Tiền Tệ: <b>VNĐ</b></p>
                                    </div>
                                    <div class="col-4"></div>
                                    <div class="col-2">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="chuyenkhoang" class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-2">
                                        <i class="fa-solid fa-building-columns fa-6x"></i>
                                    </div>
                                    <div class="col-4">
                                        <h6>Thanh Toán Bằng Tài Khoản Ngân Hàng Nội Địa</h6>
                                        <p>Chấp Nhận Mọi Ngân Hàng Nội Địa</p>
                                    </div>
                                    <div class="col-4"></div>
                                    <div class="col-2">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button id="prevGrub" class="btn  btn-secondary">Xem Lại Đơn Hàng</button>
                        <button v-on:click="pay()" style="margin-left: 500px" class="btn btn-primary">Thanh Toán <i
                                class="fa-solid fa-spinner fa-spin-pulse d-none"></i></button>
                    </div>
                </div>
            </div>
            <div id="modalQR" class="modal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-5">
                <div class="card">
                    <div style="height: 38px" class="card-header bg-primary text-center align-middle">
                        <h6><b>ĐƠN ĐẶT</b></h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-2">
                            <label>Tên Hàng Hóa</label>
                            <select v-model="chooseId" v-on:change="chooseSelect()" class="form-control">
                                <option value="-1">--- Sản Phẩm ---</option>
                                <template v-for="(v, k) in listHangHoa">
                                    <option v-bind:value="v.id">@{{ v.ten_hang_hoa }}</option>
                                </template>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-2">
                                    <label>Giá Tiền</label>
                                    <input type="text" disabled id="inputPrice" class="form-control">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-2">
                                    <label style="margin-left: 80px">Số Lượng</label>
                                    <div class="d-flex justify-content-center">
                                        <button v-on:click="tru()" style="margin-right: 5px"
                                            class="btn btn-outline-danger">--</button>
                                        <input style="width: 50px" type="text" ref="soluong" value="1"
                                            class="form-control text-center align-middle">
                                        <button v-on:click="cong()" style="margin-left: 5px"
                                            class="btn btn-outline-danger">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-2">
                                    <label>Thành Tiền</label>
                                    <input v-model="money" type="text" disabled class="form-control">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-2">
                                    <label>Số Điện Thoại</label>
                                    <div autocomplete="off">
                                        <div class="autocomplete" style="width:300px;">
                                            <input id="myInput" class="form-control" type="text" name="myCountry" placeholder="Country">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button v-on:click="createGrub()" class="btn btn-primary">Tạo 1 Sản Phẩm</button>
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
            $('title')[0].innerText = 'LC - ADMIN Đơn Đặt';
            $('#tienmat').on('click', function(e) {
                $('#tienmat').addClass('bg-success');
                $('#tienmat .col-2')[1].innerHTML = '<i class="fa-regular fa-circle-check fa-6x"></i>';
                $('#chuyenkhoang .col-2')[1].innerHTML = '';
                $('#chuyenkhoang').removeClass('bg-success');
            })
            $('#chuyenkhoang').on('click', function(e) {
                $('#chuyenkhoang').addClass('bg-success');
                $('#chuyenkhoang .col-2')[1].innerHTML = '<i class="fa-regular fa-circle-check fa-6x"></i>';
                $('#tienmat .col-2')[1].innerHTML = '';
                $('#tienmat').removeClass('bg-success');
            })
            $('#prevGrub').on('click', function() {
                $('#grub').removeClass('d-none');
                $('#pttt').addClass('d-none');
            })
            $('#choosePttt').on('click', function() {
                $('#grub').addClass('d-none');
                $('#pttt').removeClass('d-none');
            })


        })
    </script>
    <script>
        new Vue({
            el: '#app',
            data: {
                listGrub: [],
                listHangHoa: [],
                choose: -1,
                chooseId: -1,
                money: 0,
                tt: 0,
                listSDT: [],
                total: 0,
                isCheckSame: false,
            },
            created() {
                this.loadData();
            },
            methods: {
                huyDon() {
                    axios
                        .post('{{ Route('xoaAllLenDon') }}', this.listGrub)
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
                pay() {
                    var cardChoose = $('#pttt .card-body .card');
                    var isNotChoose = false;
                    for (let i = 0; i < cardChoose.length; i++) {
                        if (i == 0 && cardChoose[i].classList.contains('bg-success')) {
                            axios
                                .post('{{ Route('creatHoaDon') }}', [this.listGrub, 0])
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
                            break;
                        } else if (i == 1 && cardChoose[i].classList.contains('bg-success')) {
                            // $('#pttt .card-footer i').eq(0).addClass('fa-solid').addClass('fa-spinner').addClass('fa-spin-pulse');
                            $('#pttt .card-footer .btn-primary i').eq(0).removeClass('d-none')
                            var maHoaDon;
                            axios
                                .post('{{ Route('creatHoaDon') }}', [this.listGrub, 1])
                                .then((res) => {
                                    $('#pttt .card-footer .btn-primary i').eq(0).addClass('d-none')
                                    if (res.data.status) {
                                        return maHoaDon = res.data.ma_hoa_don;
                                    } else {
                                        return toastr.error(res.data.message, 'Error');
                                    }
                                })
                                .then((res) => {
                                    $('#modalQR .modal-body')[0].innerHTML = '';
                                    var tongTien = 0;
                                    for (var j = 0; j < this.listGrub.length; j++) {
                                        tongTien += (this.listGrub[j].so_luong * this.listGrub[j].gia_hang_hoa);
                                    };
                                    // $('#modalQR a')[0].href =
                                    //     `https://img.vietqr.io/image/agribank-4502281004484-compact.jpg?amount=${tongTien}&addInfo=${res}&accountName=Nguyen%20Thai%20Bao%20Phuc`;
                                    // $('#modalQR a')[0].addEventListener('click', function(event) {
                                    // event.preventDefault();
                                    var urlPageQr =
                                        `https://img.vietqr.io/image/agribank-4502281004484-compact.jpg?amount=${tongTien}&addInfo=${res}&accountName=Nguyen%20Thai%20Bao%20Phuc`;
                                    fetch(urlPageQr)
                                        .then(response => response.blob())
                                        .then(blob => {
                                            var imageUrl = URL.createObjectURL(blob);
                                            var imgElement = $('<img>').attr('src', imageUrl);
                                            $('#modalQR .modal-body').html(imgElement);
                                            $('#modalQR .modal-body img')[0].style.marginLeft =
                                                '110px';
                                            $('#modalQR').modal('show');
                                        })
                                        .catch(error => {
                                            console.error('Không thể tải ảnh từ trang khác.',
                                                error);
                                        });
                                    // });
                                })
                                .catch((res) => {
                                    $.each(res.response.data.errors, function(k, v) {
                                        toastr.error(v[0], 'Error');
                                    });
                                });
                            break;
                        } else {
                            if (i != 0) {
                                if (isNotChoose) {
                                    isNotChoose = false;
                                    break;
                                } else {
                                    toastr.error('Chưa Chọn Phương Thức Thanh Toán', 'Error');
                                    isNotChoose = true;
                                }
                            }
                        }
                    }
                },
                deleteItem(id, k) {
                    var id = {
                        'id': id
                    };
                    axios
                        .post('{{ Route('xoaLenDon') }}', id)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message, 'Success');
                                this.listGrub.splice(k, 1);
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
                    return new Intl.NumberFormat('vi-VN', {
                        style: 'currency',
                        currency: 'VND'
                    }).format(number)
                },
                cong2(k) {
                    this.listGrub[k].so_luong++;
                    this.totalItems();
                },
                tru2(k) {
                    if (this.listGrub[k].so_luong > 1) {
                        this.listGrub[k].so_luong--;
                        this.totalItems();
                    } else {
                        toastr.error('Số Lượng Đặt Đã Ở Mức Tối Thiểu', 'Error');
                    }
                },
                totalItems() {
                    this.total = 0;
                    for (var i = 0; i < this.listGrub.length; i++) {
                        this.total += (this.listGrub[i].so_luong * this.listGrub[i].gia_hang_hoa);
                    }
                },
                loadData() {
                    axios
                        .post('{{ Route('dataLenDon') }}')
                        .then((res) => {
                            this.listHangHoa = res.data.dataHangHoa;
                            this.listGrub = res.data.dataGrub;
                            this.totalItems();
                            this.listSDT = res.data.listSDT;
                            for (let i = 0; i < this.listSDT.length; i++) {
                                this.listSDT[i] = this.listSDT[i].so_dien_thoai
                            }
                        })
                        .then((res) => {
                            this.autocomplete();
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0], 'Error');
                            });
                        });
                },
                chooseSelect() {
                    for (var i = 0; i < this.listHangHoa.length; i++) {
                        if (this.listHangHoa[i].id == this.chooseId) {
                            this.choose = i;
                            this.$refs.soluong.value = 1;
                            break;
                        }
                    }
                    if (this.choose != -1) {
                        var inputPrice = document.getElementById('inputPrice');
                        var price = this.listHangHoa[this.choose].gia_hang_hoa;
                        inputPrice.value = price;
                        this.money = price * this.$refs.soluong.value;
                        this.$refs.soluong.value = 1;
                    }
                },
                cong() {
                    this.$refs.soluong.value++;
                    this.money = this.listHangHoa[this.choose].gia_hang_hoa * this.$refs.soluong.value;
                },
                tru() {
                    if (this.$refs.soluong.value >= 2) {
                        this.$refs.soluong.value--;
                        this.money = this.listHangHoa[this.choose].gia_hang_hoa * this.$refs.soluong.value;
                    } else {
                        toastr.error('Số Lượng Đặt Đã Ở Mức Tối Thiểu', 'Error');
                    }
                },
                createGrub() {
                    this.listGrub.forEach(element => {
                        if (element.id == this.chooseId) {
                            this.isCheckSame = true;
                            toastr.error('Đã Tạo Đơn Với Hàng Hóa Này!', 'Error');
                        } else {
                            this.isCheckSame = false;
                        }
                    });
                    if (this.isCheckSame) {
                        return;
                    } else {
                        var tt = {
                            'id': this.chooseId,
                            'so_luong': this.$refs.soluong.value,
                        }
                        axios
                            .post('{{ Route('createLenDon') }}', tt)
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
                    }
                },
                autocomplete() {
                    var arr = this.listSDT;
                    console.log(arr);
                    var inp = document.getElementById("myInput")
                    /*the autocomplete function takes two arguments,
                    the text field element and an array of possible autocompleted values:*/
                    var currentFocus;
                    /*execute a function when someone writes in the text field:*/
                    inp.addEventListener("input", function(e) {
                        var a, b, i, val = this.value;
                        /*close any already open lists of autocompleted values*/
                        closeAllLists();
                        if (!val) {
                            return false;
                        }
                        currentFocus = -1;
                        /*create a DIV element that will contain the items (values):*/
                        a = document.createElement("DIV");
                        a.setAttribute("id", this.id + "autocomplete-list");
                        a.setAttribute("class", "autocomplete-items");
                        /*append the DIV element as a child of the autocomplete container:*/
                        this.parentNode.appendChild(a);
                        /*for each item in the array...*/
                        for (i = 0; i < arr.length; i++) {
                            /*check if the item starts with the same letters as the text field value:*/
                            if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                                /*create a DIV element for each matching element:*/
                                b = document.createElement("DIV");
                                /*make the matching letters bold:*/
                                b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                                b.innerHTML += arr[i].substr(val.length);
                                /*insert a input field that will hold the current array item's value:*/
                                b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                                /*execute a function when someone clicks on the item value (DIV element):*/
                                b.addEventListener("click", function(e) {
                                    /*insert the value for the autocomplete text field:*/
                                    inp.value = this.getElementsByTagName("input")[0].value;
                                    /*close the list of autocompleted values,
                                    (or any other open lists of autocompleted values:*/
                                    closeAllLists();
                                });
                                a.appendChild(b);
                            }
                        }
                    });
                    /*execute a function presses a key on the keyboard:*/
                    inp.addEventListener("keydown", function(e) {
                        var x = document.getElementById(this.id + "autocomplete-list");
                        if (x) x = x.getElementsByTagName("div");
                        if (e.keyCode == 40) {
                            /*If the arrow DOWN key is pressed,
                            increase the currentFocus variable:*/
                            currentFocus++;
                            /*and and make the current item more visible:*/
                            addActive(x);
                        } else if (e.keyCode == 38) { //up
                            /*If the arrow UP key is pressed,
                            decrease the currentFocus variable:*/
                            currentFocus--;
                            /*and and make the current item more visible:*/
                            addActive(x);
                        } else if (e.keyCode == 13) {
                            /*If the ENTER key is pressed, prevent the form from being submitted,*/
                            e.preventDefault();
                            if (currentFocus > -1) {
                                /*and simulate a click on the "active" item:*/
                                if (x) x[currentFocus].click();
                            }
                        }
                    });

                    function addActive(x) {
                        /*a function to classify an item as "active":*/
                        if (!x) return false;
                        /*start by removing the "active" class on all items:*/
                        removeActive(x);
                        if (currentFocus >= x.length) currentFocus = 0;
                        if (currentFocus < 0) currentFocus = (x.length - 1);
                        /*add class "autocomplete-active":*/
                        x[currentFocus].classList.add("autocomplete-active");
                    }

                    function removeActive(x) {
                        /*a function to remove the "active" class from all autocomplete items:*/
                        for (var i = 0; i < x.length; i++) {
                            x[i].classList.remove("autocomplete-active");
                        }
                    }

                    function closeAllLists(elmnt) {
                        /*close all autocomplete lists in the document,
                        except the one passed as an argument:*/
                        var x = document.getElementsByClassName("autocomplete-items");
                        for (var i = 0; i < x.length; i++) {
                            if (elmnt != x[i] && elmnt != inp) {
                                x[i].parentNode.removeChild(x[i]);
                            }
                        }
                    }
                    /*execute a function when someone clicks in the document:*/
                    document.addEventListener("click", function(e) {
                        closeAllLists(e.target);
                    });
                }
            },
        });
    </script>
@endsection
