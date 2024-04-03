<div id="app2">
    <section class="products-section mt-4">
        <div class="auto-container">
            <!-- Sec Title -->
            <div class="sec-title">
                <h4><span>Populer</span> Products For You !</h4>
            </div>
            <div class="four-item-carousel owl-carousel owl-theme">
                <template v-for="(v, k) in listItems" >
                    <div class="shop-item">
                        <div class="inner-box">
                            <div class="image">
                                <a v-bind:href="'/detail/' + v.id"><img style="height: 270px" v-bind:src="v.hinh_anh"
                                        alt="" /></a>
                                <div class="cart-box text-center">
                                    <a v-on:click="themgio(v.id, k)" class="cart">
                                        <i style="margin-right: 8px" class="fa-solid fa-cart-arrow-down fa-beat"></i>THÊM VÀO GIỎ</a>
                                </div>
                            </div>
                            <div class="lower-content">
                                <h6><a v-bind:href="'/detail/' + v.id">@{{ v.ten_hang_hoa }}</a></h6>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="price">@{{ vnd(v.gia_hang_hoa) }}</div>
                                    <div class="d-flex justify-content-end">
                                        <button v-on:click="tru(k)" class="btn btn-outline-secondary" style="margin-right: 2px"><i
                                                class="fa-solid fa-minus"></i></button>
                                        <input v-bind:data-index='k' class="form-control text-center" disabled
                                            value="1" style="width:40px;" type="text" ref="inputRefs">
                                        <button v-on:click="cong(k)" class="btn btn-outline-secondary" style="margin-left: 2px"><i
                                                class="fa-solid fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </section>
</div>
<script>
    new Vue({
            el      :   '#app2',
            data    :   {
                listItems: [],
                listTypes: [],
            },
            created()   {
                this.loadData();
            },
            methods :   {
                loadData() {
                    axios
                        .post('{{Route('dataHomePage')}}')
                        .then((res) => {
                            this.listItems = res.data.items;
                            this.listTypes = res.data.types;
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0], 'Error');
                            });
                        });
                },
                vnd(number) {
                    return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(number)
                },
                cong(stt) {
                    var input = this.$refs.inputRefs[stt];
                    if (input) {
                        input.value++;
                    }
                },
                tru(stt) {
                    var input = this.$refs.inputRefs[stt];
                    if (input) {
                        input.value > 1 ? input.value-- : 0;
                    }
                },
                themgio(payload, stt) {
                    var input = this.$refs.inputRefs[stt];
                    if (input) {
                        var post = {
                            'id': payload,
                            'so_luong': input.value
                        }
                        axios
                            .post('{{ Route('taoDonDatMon') }}', post)
                            .then((res) => {
                                if (res.data.status) {
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
                    }
                }
            },
        });
</script>
