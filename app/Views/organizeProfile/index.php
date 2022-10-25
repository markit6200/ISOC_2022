<?= $this->extend('theme/admin') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body d-inline">
                <span class="h2"><?php echo $title; ?></span>
                <div class="float-end">
                    <a href="<?php echo base_url('OrganizeProfile/form') ?>" class="btn btn-outline-light"><i class="mdi mdi-plus-circle-outline"></i> เพิ่มข้อมูล</a>
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
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" class="text-dark fw-bold text-center col-1">ลำดับ</th>
                                        <th scope="col" class="text-dark fw-bold text-center col-3">โปรไฟล์</th>
                                        <th scope="col" class="text-dark fw-bold text-center col-1">ปี</th>
                                        <th scope="col" class="text-dark fw-bold text-center col-1">สถานะการใช้งาน</th>
                                        <th scope="col" class="text-dark fw-bold text-center col-1">วันที่ประกาศใช้</th>
                                        <th scope="col" class="text-dark fw-bold text-center col-3">เครื่องมือ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(isset($profile) && !empty($profile)):
                                    $no = 0;
                                        foreach($profile as $key => $value):
                                            $no++
                                    ?>
                                    <tr>
                                        <td class="text-center o"><?php echo $no ?></td>
                                        <td class="text-left"><?php echo $value['org_profile_name'] ?></td>
                                        <td class="text-center"><?php echo $value['org_profile_year'] ?></td>
                                        <td class="text-center"><?php echo $value['org_profile_status'] ?></td>
                                        <td class="text-center"><?php echo $value['org_date_announce'] ?></td>
                                        <td class="text-center">
                                            <a href="" class="btn btn-primary mb-2"><i class="mdi mdi-sitemap"></i>&nbsp;ผังองค์กร</a>&nbsp;&nbsp;
                                            <a href="<?php echo base_url('OrganizeProfile/form/'.$value['org_profile_id']) ?>" class="btn btn-warning mb-2"><i class="mdi mdi-pencil"></i>&nbsp;แก้ไข</a>&nbsp;&nbsp;
                                            <button onclick="confirmDelete('<?php echo $value['org_profile_id'] ?>')" class="btn btn-danger mb-2"><i class="mdi mdi-close-circle-outline"></i>&nbsp;ลบ</button>
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
<?= $this->endSection() ?>
<?= $this->section('cssTopContent')?>
<link href="<?php echo base_url() ?>/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
<?= $this->endSection() ?>
<?= $this->section('jsContent')?>
<script src="<?php echo base_url() ?>/assets/libs/sweetalert2/sweetalert2.min.js"></script>
<script>
    function confirmDelete(id){
        Swal.fire({
            title: "ท่านต้องการลบข้อมูลใช่หรือไม่?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#f46a6a",
            cancelButtonText: "ยกเลิก",
            confirmButtonText: "ลบข้อมูล",
            reverseButtons: true
            }).then(function (result) {
            if (result.value) {
                location.href = '<?php echo base_url("OrganizeProfile/delete"); ?>/'+id;
            }
        });
    }
</script>

<?= $this->endSection() ?>
