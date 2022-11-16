<?= $this->extend('theme/admin') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body d-inline">
                <span class="h2"><?php echo $title; ?></span>
                <div class="float-end">
                    <a href="<?php echo base_url('OrganizeProfile') ?>" class="btn btn-default"><i class="fas fa-chevron-left"></i> ย้อนกลับ</a>
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
                        <div class="col-md-12 mb-2">
                            <div class="d-inline">
                                <div class="float-end">
                                    <a href="#" title="นำเข้าข้อมูล" class="btn btn-default btn-warning"><i class="fas fa-file-import"></i></a>
                                    <a href="<?php echo base_url('StructureByAssistRate/import')?>" title="ส่งออกข้อมูล" class="btn btn-default btn-success"><i class="fas fa-file-excel"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <?php 
                                       if (isset($previewData) && !empty($previewData)) {
                                        foreach ($previewData as $index => $row) {
                                            if ($index == 1) {
                                            ?>
                                            <tr>
                                                <?php 
                                                foreach($row as $key => $col){
                                                    ?>
                                                    <td><?php echo $col ?></td>
                                                    <?php
                                                }
                                            ?>
                                            </tr>
                                            <?php 
                                            }
                                        }
                                        
                                       }
                                    ?>
                                </thead>
                                <tbody>
                                    <?php 
                                       if (isset($previewData) && !empty($previewData)) {
                                        foreach ($previewData as $index => $row) {
                                            if ($index >=2) {
                                            ?>
                                            <tr>
                                                <?php 
                                                foreach($row as $key => $col){
                                                    ?>
                                                    <td><?php echo $col ?></td>
                                                    <?php
                                                }
                                            ?>
                                            </tr>
                                            <?php 
                                            }
                                        }
                                        
                                       }
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
                location.href = '<?php echo base_url("StructureByAssistRate/delete"); ?>/'+id;
            }
        });
    }
</script>

<?= $this->endSection() ?>
