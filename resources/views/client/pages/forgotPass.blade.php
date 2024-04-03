<!DOCTYPE html>
<html lang="en">
<head>
    @include('client.share.css')
</head>
<body>
    <div style="margin-top: 300px" class="container">
        <div class="card">
            <div class="card-header bg-danger">
                <h4 class="text-center text-light">QUÊN MẬT KHẨU ?</h4>
            </div>
            <div class="card-body">
                <div class="mb-2">
                    <label class="mb-2" style="margin-left: 10px"><h5>Email</h5></label>
                    <input style="height: 50px;" type="text" class="form-control rounded-pill" placeholder="Nhập vào email">
                </div>
                <hr style="width: 500px;margin-left: 380px;color: red;">
                <button class="btn btn-danger" style="width: 1000px; margin-left: 120px">SEND</button>
                <div class="d-flex mb-3">
                    <div class="p-2"><button class="btn btn-danger"></button></div>
                    <div class="p-2">Flex item</div>
                    <div class="ms-auto p-2">Flex item</div>
                  </div>
            </div>
        </div>
    </div>
</body>
</html>
