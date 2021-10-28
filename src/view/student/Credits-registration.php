<?php
include("partials/header.php")
?>
<main>
    <!-- Start main -->
    <div class="main-content">
        <div class="wrapper">
            <h1 style="color:#a83232">Đăng ký Lớp</h1>
            <br><br>
            <div class="input-group mb-3" style="width: 300px;">
                <input type="text" class="form-control" placeholder="Mã Lớp" aria-label="Recipient's username" aria-describedby="button-addon2">
                <button class="btn btn-outline-secondary" type="button" id="button-addon2">Đăng ký</button>
            </div>
            <br><br>
            <h1 style="color:#a83232">Lớp đã đăng ký</h1>
            <br><br>
            <table class="table table-bordered" style="border: solid;">
                <thead>
                    <tr>
                        <th scope="col">Mã lớp</th>
                        <th scope="col">Mã môn</th>
                        <th scope="col">Tên Môn</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Đã đăng ký</th>
                        <th scope="col">Khoa</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <div class="clearfix"></div>

        </div>
    </div>
    <!-- End main -->
</main>
<?php
include("partials/footer.php")
?>