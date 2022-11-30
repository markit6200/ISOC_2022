<?= $this->extend('theme/admin') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body d-inline">
                <span class="h2"><?php echo $title; ?></span>
                <div class="float-end">
                    <form>
                        <div class="input-group col-12">
                            <input type="text" class="form-control" name="search" style="width: 60%;" placeholder="ป้อนชื่อจริง หรือ นามสกุล หรือ เลขบัตรปชช." value="<?php echo isset($_GET['search']) ? $_GET['search'] : '' ?>">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-success">ค้นหา</button>
                            </div>
                            &nbsp;&nbsp;&nbsp;
                            <a href="<?php echo base_url('PersonalWaitrecruit/form') ?>" class="btn btn-outline-light"><i class="mdi mdi-plus-circle-outline"></i> เพิ่มข้อมูล</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <?= view('partials/flash_message') ?>
                <div class="col-md-12">
                    <div class="row form-group align-items-baseline">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <div class="number row" style="margin-left: 8.5rem;">
                                    <div class="card bg-gradient-primary " style="width: 18rem;margin-right: 3rem;">
                                        <?php foreach ($number as $key => $value) :
                                            if ($value['male'] == 0)
                                                echo '<div class="card-body ">
                                            <i class="fas fa-male text-white" style="font-size:50px"></i>
                                        <h2 class="card-subtitle mb-2 text-white float-end">0 ราย</h2>
                                        </div>';
                                            elseif ($value['male'] >= 1)
                                                echo '<div class="card-body ">
                                                <i class="fas fa-male text-white" style="font-size:50px"></i>
                                            <h2 class="card-subtitle mb-2 text-white float-end">' . $value['male'] . ' ราย</h2>
                                            </div>';
                                        endforeach; ?>
                                    </div>
                                    <div class="card bg-gradient-success " style="width: 18rem;margin-right: 3rem;">
                                        <?php foreach ($number as $key => $value) :
                                            if ($value['female'] == 0)
                                                echo '<div class="card-body">
                                                <i class="fas fa-female text-white" style="font-size:50px"></i>
                                                <h2 class="card-subtitle mb-2 text-white float-end">0 ราย</h2>
                                                </div>';
                                            elseif ($value['female'] >= 1)
                                                echo '<div class="card-body">
                                            <i class="fas fa-female text-white" style="font-size:50px"></i>
                                            <h2 class="card-subtitle mb-2 text-white float-end">' . $value['female'] . ' ราย</h2>
                                            </div>';
                                        endforeach; ?>
                                    </div>

                                    <div class="card bg-gradient-secondary" style="width: 18rem;">
                                        <?php foreach ($number as $key => $value) :
                                            if ($value['total'] == 0)
                                                echo '<div class="card-body">
                                            <h1 class="card-title text-white">รวมทั้งหมด</h1>
                                            <h3 class="card-subtitle mb-2 text-white float-end">0 ราย</h3>
                                            </div>';
                                            elseif ($value['total'] >= 1)
                                                echo '<div class="card-body">
                                            <h1 class="card-title text-white">รวมทั้งหมด</h1>
                                            <h3 class="card-subtitle mb-2 text-white float-end">' . $value['total'] . ' ราย</h3>
                                            </div>';
                                        endforeach; ?>
                                    </div>


                                </div>
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" class="text-dark fw-bold text-center col-1">ลำดับ</th>
                                        <th scope="col" class="text-dark fw-bold text-center col-1">เลขประจำตัวประชาชน</th>
                                        <th scope="col" class="text-dark fw-bold text-center col-2">ยศ - ชื่อ - สกุล</th>
                                        <th scope="col" class="text-dark fw-bold text-center col-1">ตำแหน่งและสังกัด</th>
                                        <th scope="col" class="text-dark fw-bold text-center col-2">วันที่บันทึก</th>
                                        <th scope="col" class="text-dark fw-bold text-center col-2">เครื่องมือ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($personal)) :
                                        // echo var_dump($personal);
                                        $num = 0;
                                        foreach ($personal as $key => $value) :
                                            // echo var_dump($value['codeGender']);
                                            $preName = $value['titlePrefix'];
                                            $fname = $value['firstName'];
                                            $lname = $value['lastName'];
                                            $fullname = $preName . $fname . ' ' . $lname;
                                            $num++;
                                    ?>

                                            <tr>
                                                <td class="text-center o"><?php echo $num ?></td>
                                                <td class="text-center"><?php echo $value['cardID'] ?></td>
                                                <td class="text-center"><?php echo $fullname ?></td>
                                                <td class="text-center"><?php echo $value['originPosition'] ?></td>
                                                <td class="text-center"><?php echo dayThai($value['dateInsert']) ?></td>
                                                <td class="text-center">
                                                    <div class="col-auto pe-md-0 ">
                                                        <div class="form-group mb-0">
                                                            <a href="<?php echo base_url('PersonalWaitrecruit/form/' . $value['pid']) ?>" class="btn  btn-warning  text-dark">
                                                                <i class="mdi mdi-pencil"></i>&nbsp;แก้ไข
                                                            </a>
                                                            <button data-bs-toggle="modal" data-bs-target="#myModal" class="btn  btn-danger" onclick="showModal('<?php echo $value['pid'] ?>','<?php echo $fullname ?>')" class="btn btn-danger">&nbsp;
                                                                <i class="mdi mdi-close-circle-outline"></i>&nbsp;ลบ
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                    <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->include('PersonalWaitrecruit/modal') ?>
<?= $this->endSection() ?>
<?= $this->section('jsContent') ?>
<script src="<?php echo base_url() ?>/assets/libs/sweetalert2/sweetalert2.min.js"></script>
<script>
    function showModal(id, name) {
        var textConfirm = 'ท่านต้องการที่จะลบข้อมูลของ ' + name + ' หรือไม่';
        document.getElementById("pid").innerHTML = id;
        document.getElementById("name").innerHTML = textConfirm;
    }

    function removePersonal(pid) {
        var id = document.getElementById("pid").innerHTML;
        location.href = '<?php echo base_url("PersonalWaitrecruit/delete"); ?>/' + id;
    }
</script>

<?= $this->endSection() ?>