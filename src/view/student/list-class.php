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
        <div class="container-fluid clear">
        <div class="d-flex justify-content-center d-flex align-items-center" style="height: 200px;">
            <p class="h1">Danh sách lớp học</p>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Details</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once ('../../config/config.php');
                $sql = "select * from db_subject";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <tr>
                            <th scope="row"><?php echo $row['id']; ?> </th>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['quantity']; ?></td>
                            <td><?php echo $row['quantity']; ?></td>
                            <td><?php echo $row['quantity']; ?></td>
                            <td><?php echo $row['quantity']; ?></td>
                            <td><?php echo $row['quantity']; ?></td>

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