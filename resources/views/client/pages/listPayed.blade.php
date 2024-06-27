@extends('client.share.master')
@section('noi_dung')
    <div class="container" style="margin-bottom: 250px">
        <div class="row">
            <div id="firstCol" class="col-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>LỊCH SỬ THANH TOÁN</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center align-middle">#</th>
                                        <th class="text-center align-middle">Mã Đơn Hàng</th>
                                        <th class="text-center align-middle">Tên Sản Phẩm</th>
                                        <th class="text-center align-middle">Số Tiền</th>
                                        <th class="text-center align-middle">Trạng Thái Đơn Hàng</th>
                                        <th class="text-center align-middle">Chi tiết Hóa Đơn</th>
                                        <th class="text-center align-middle">Ngày Đặt Hàng</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div id="secondCol" class="col-4 d-none">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex">
                            <div class="p-2">Đơn Hàng: <span id="titleCardDetail"></span></div>
                            <div class="ms-auto p-2"><i class="fa-solid fa-circle-xmark fa-lg"></i></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="order-totals">
                            <li>Số Lượng<span id="quantity"></span></li>
                            <li>Giá Tiền/ 1 Đơn Vị<span id="price"></span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
            $('title')[0].innerText = 'LC - ADMIN LỊCH SỬ THANH TOÁN';
            var firstCol = document.querySelector('.row #firstCol');
            var secondCol = document.querySelector('.row #secondCol');
            var iconX = document.querySelector('.fa-solid.fa-circle-xmark');
            var tbody = document.querySelector('tbody');
            var quantity = document.getElementById('quantity');
            var price = document.getElementById('price');
            var titleCardDetail = document.getElementById('titleCardDetail');
            const app = {
                obj: {},
                data: [],
                HanleEvent: function() {
                    iconX.onclick = function() {
                        secondCol.classList.add('d-none');
                        firstCol.classList.remove('col-8');
                        firstCol.classList.add('col-12');
                    }
                },

                loadData: function() {
                    axios
                        .post('{{ Route('dataHistoryPay') }}')
                        .then((res) => {
                            this.data = res.data.data;
                            this.renderHTML();
                        })
                        .catch((res) => {
                            $.each(res.data, function(k, v) {
                                toastr.error(v[0], 'Error');
                            });
                        });
                },
                showDetailPay: function(number, gia, title) {
                    firstCol.classList.remove('col-12');
                    firstCol.classList.add('col-8');
                    secondCol.classList.remove('d-none');
                    quantity.textContent = number;
                    price.textContent = gia;
                    titleCardDetail.textContent = title;
                },
                renderHTML: function() {
                    const html = this.data.map((value, key) => {
                        let statusText;
                        if (value.is_thanh_toan) {
                            statusText = 'Đã thanh toán';
                        } else {
                            statusText = 'Chưa thanh toán';
                        }
                        return `
                        <tr>
                            <th class="text-center align-middle">${key + 1}</th>
                            <th class="text-center align-middle">${value.ma_hoa_don}</th>
                            <th class="text-center align-middle">${value.ten_hang_hoa}</th>
                            <th class="text-center align-middle">${value.tong_tien}</th>
                            <th class="text-center align-middle">${statusText}</th>
                            <th class="text-center align-middle">
                                <button onclick="app.showDetailPay(${value.so_luong}, ${value.gia_hang_hoa}, ${value.ma_hoa_don})" class="btn btn-primary show">Thông Tin</button>
                            </th>
                            <th class="text-center align-middle">${value.created_at}</th>
                        </tr>
                    `
                    })
                    tbody.innerHTML = html.join('');
                    this.HanleEvent();
                },

                renderApp: function() {
                    this.loadData();
                }
            }
            app.renderApp();
    </script>
@endsection
