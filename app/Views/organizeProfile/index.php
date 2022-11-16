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
                                        <th scope="col" class="text-dark fw-bold text-center col-4">โปรไฟล์</th>
                                        <th scope="col" class="text-dark fw-bold text-center col-1">ปี</th>
                                        <th scope="col" class="text-dark fw-bold text-center col-2">สถานะการใช้งาน</th>
                                        <th scope="col" class="text-dark fw-bold text-center col-2">วันที่ประกาศใช้</th>
                                        <th scope="col" class="text-dark fw-bold text-center col-2">เครื่องมือ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($profile) && !empty($profile)) :
                                        $no = 0;
                                        foreach ($profile as $key => $value) :
                                            $no++
                                    ?>
                                            <tr>
                                                <td class="text-center o"><?php echo $no ?></td>
<<<<<<< HEAD
                                                <td class="text-left"><a href="<?php echo base_url('StructureByAssistRate/view/'.$value['org_profile_id']) ?>"><?php echo $value['org_profile_name'] ?></a></td>
=======
                                                <td class="text-left"><a href="<?php echo base_url() . '/StructureByAssistRate/index/' . $value['org_profile_id'] ?>"><?php echo $value['org_profile_name'] ?></a></td>
>>>>>>> f6f32f402bf74db0d01371b155dc5ee4dee7f430
                                                <td class="text-center"><?php echo $value['org_profile_year'] != '' ? $value['org_profile_year'] + 543 : '-' ?></td>
                                                <td class="text-center"><?php echo $value['org_profile_status'] == 1 ? 'ใช้งาน' : 'ไม่ใช้งาน' ?></td>
                                                <td class="text-center"><?php echo dayThai($value['org_date_announce']) ?></td>
                                                <td class="text-center">
                                                    <a href="<?php echo base_url('OrganizeProfile/structure/' . $value['org_profile_id']) ?>" title="โครงสร้าง" class="btn btn-primary btn-sm btn-block mb-2"><i class="mdi mdi-sitemap"></i>&nbsp;</a>
                                                    <a href="<?php echo base_url('OrganizeProfile/form/' . $value['org_profile_id']) ?>" title="แก้ไข" class="btn btn-sm btn-block btn-warning mb-2"><i class="mdi mdi-pencil"></i>&nbsp;</a>
                                                    <button data-bs-toggle="modal" data-bs-target="#duplicateModal" onclick="duplicateProfile('<?php echo $value['org_profile_id'] ?>')" title="คัดลอก" class="btn btn-info btn-sm btn-block mb-2"><i class="mdi mdi-content-copy"></i>&nbsp;</button>
                                                    <button onclick="confirmDelete('<?php echo $value['org_profile_id'] ?>')" title="ลบ" class="btn btn-danger btn-sm btn-block mb-2"><i class="mdi mdi-close-circle-outline"></i>&nbsp;</button>

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
<?= $this->section('cssTopContent') ?>
<link href="<?php echo base_url() ?>/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
<?= $this->endSection() ?>
<?= $this->section('jsContent') ?>
<script src="<?php echo base_url() ?>/assets/libs/sweetalert2/sweetalert2.min.js"></script>
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: "ท่านต้องการลบข้อมูลใช่หรือไม่?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#f46a6a",
            cancelButtonText: "ยกเลิก",
            confirmButtonText: "ลบข้อมูล",
            reverseButtons: true
        }).then(function(result) {
            if (result.value) {
                location.href = '<?php echo base_url("OrganizeProfile/delete"); ?>/' + id;
            }
        });
    }

    function duplicateProfile(id) {
        $("#duplicateModal").find('.modal-body #org_profile_id').val(id);
    }

    function saveDuplicateProfile(){
       var dataString = $('#duplicateProfileFrm').serialize();
       $.ajax({
		  type: "POST",
		  url: "<?php echo base_url("OrganizeProfile/duplicateProfile"); ?>",
		  data: dataString,
		  success: function(data)
		  {
            if (data == 'success') {
                
                alert('Success!');
                $('#duplicateModal').modal('toggle');
                // window.location.reload();
            } else {

                alert('Failed!');
                $('#duplicateModal').modal('toggle');
                // window.location.reload();
            }
			// $("#serializeForm")[0].reset();
		  }
		});

    }
</script>

<?= $this->endSection() ?>
