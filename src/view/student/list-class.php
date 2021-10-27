<?php include('partials/header.php'); ?>
<!-- Start main -->
<div class="main-content">
    <div class="wrapper">
        <h1 style="color:#a83232">Danh sách lớp đăng ký học tập</h1>
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
                    <td scope="row" style="width: 200px;">
                        <div class="input-group input-group-sm mb-3" style="width: 100%;">
                            <input type="text" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                            <button class="btn btn-outline-secondary" type="button" id="button-addon1"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </td>
                    <td scope="row" style="width: 200px;">
                        <div class="input-group input-group-sm mb-3" style="width: 100%;">
                            <input type="text" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                            <button class="btn btn-outline-secondary" type="button" id="button-addon1"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </td>
                    <td scope="row" style="width: 200px;">
                        <div class="input-group input-group-sm mb-3" style="width: 100%;">
                            <input type="text" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                            <button class="btn btn-outline-secondary" type="button" id="button-addon1"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </td>
                    <td scope="row" style="width: 200px;">
                        <select class="form-select" aria-label="Default select example" >
                            <option selected></option>
                            <option value="1">Có thể đăng ký</option>
                            <option value="2">Đã đầy</option>
                        </select>
                    </td>
                    <td scope="row" style="width: 200px;">
                        <div class="input-group input-group-sm mb-3" style="width: 100%;">
                            <input type="text" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                            <button class="btn btn-outline-secondary" type="button" id="button-addon1"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </td>
                    </td>
                    <td scope="row" style="width: 200px;">
                        <div class="input-group input-group-sm mb-3" style="width: 100%;">
                            <input type="text" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                            <button class="btn btn-outline-secondary" type="button" id="button-addon1"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </td>

                </tr>
            </tbody>
        </table>
        <div class="clearfix"></div>

    </div>
</div>
<!-- End main -->
<?php include('partials/footer.php'); ?>