@extends('client.share.master')
@section('noi_dung')
    <div class="container">
        <div class="row">
            <div id="firstCol" class="col-12">
                <div class="card">
                    <div class="card-header">

                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle">#</th>
                                    <th class="text-center align-middle">Mã Đơn Hàng</th>
                                    <th class="text-center align-middle">Ngày Đặt Hàng</th>
                                    <th class="text-center align-middle">Số Tiền</th>
                                    <th class="text-center align-middle">Chi tiết Hóa Đơn</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div id="secondCol" class="col-4 d-none">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex">
                            <div class="p-2">Flex item</div>
                            <div class="ms-auto p-2"><i class="fa-solid fa-circle-xmark fa-lg"></i></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="order-totals">
                            <li>Subtotal<span>$345.00</span></li>
                            <li>Shipping Fee<span>$34.00</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        var firstCol = document.querySelector('.row #firstCol');
        var secondCol = document.querySelector('.row #secondCol');
        var iconX = document.querySelector('.fa-solid.fa-circle-xmark');
        var tbody = document.querySelector('tbody');
        const app = {
            data: [],
            HanleEvent: function() {
                var show = document.querySelectorAll('tbody .show');
                for (let i = 0; i < show.length; i++) {
                    show[i].onclick = function() {

                        firstCol.classList.remove('col-12');
                        firstCol.classList.add('col-8');
                        secondCol.classList.remove('d-none');
                    }
                }
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

            renderHTML: function() {
                const html = this.data.map((value) => {
                    let statusText;
                    if (value.is_thanh_toan) {
                        statusText = 'Đã thanh toán';
                    } else {
                        statusText = 'Chưa thanh toán';
                    }
                    return `
                        <tr>
                            <th class="text-center align-middle">#</th>
                            <th class="text-center align-middle">${value.ma_hoa_don}</th>
                            <th class="text-center align-middle">${value.created_at}</th>
                            <th class="text-center align-middle">${value.tong_tien}</th>
                            <th class="text-center align-middle">${statusText}</th>
                            <th class="text-center align-middle">
                                <button class="btn btn-primary show">Thông Tin</button>
                            </th>
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
