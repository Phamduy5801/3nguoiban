<?php include('partials/header.php'); ?>
<!-- Start main -->
<div class="main-content">
    <div class="wrapper">
        <h1 style="color:#a83232">Danh sách lớp đăng ký học tập</h1>
        <br><br>
        <table class="table table-bordered" style="border: solid;">
            <thead>
                <tr>
                    <th scope="col">Mã môn</th>
                    <th scope="col">Tên Môn</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Đã đăng ký</th>
                    <th scope="col">Khoa</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <form action="process/search-subject.php" method="POST">
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
                            <select class="form-select" aria-label="Default select example">
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
                    </form>
                </tr>
            </tbody>
        </table>
        <div class="container-fluid clear">
            <div class="d-flex justify-content-center d-flex align-items-center" style="height: 200px;">
                <p class="h1">Danh sách lớp học</p>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Mã môn</th>
                        <th scope="col">Mã khoa</th>
                        <th scope="col">Tên giáo viên</th>
                        <th scope="col">Môn</th>
                        <th scope="col">Ngày bắt đầu</th>
                        <th scope="col">Ngày kết thúc</th>
                        <th scope="col">Thời gian</th>
                        <th scope="col">Số tín chỉ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include_once('../../config/config.php');
                    $sql = "select sb_id, db_subject.ma_khoa, db_teacher.tea_ten, sb_ten, ngay_batdau, ngay_ketthuc, thoigian_hoc, sb_tinchi 
                from db_subject, db_teacher 
                where db_subject.tea_id = db_teacher.tea_id";
                    $result = mysqli_query($conn, $sql);

                    if ($result == true) {
                        if (mysqli_num_rows($result) > 0)
                            while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                            <tr>
                                <th scope="row"><?php echo $row['sb_id']; ?> </th>
                                <td><?php echo $row['ma_khoa']; ?></td>
                                <td><?php echo $row['tea_ten']; ?></td>
                                <td><?php echo $row['sb_ten']; ?></td>
                                <td><?php echo $row['ngay_batdau']; ?></td>
                                <td><?php echo $row['ngay_ketthuc']; ?></td>
                                <td><?php echo $row['thoigian_hoc']; ?></td>
                                <td><?php echo $row['sb_tinchi']; ?></td>
                            </tr>
                    <?php
                            }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="clearfix"></div>

    </div>
</div>
<!-- End main -->
<?php include('partials/footer.php'); ?>