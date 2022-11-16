<?php 
    $action = isset($save_data['positionMapID'])?base_url('StructureByAssistRate/update/'.$save_data['positionMapID']):base_url('StructureByAssistRate/importFile');
    $prefix = isset($save_data['positionMapID'])?'แก้ไข':'';
?>
<?= $this->extend('theme/admin') ?>
<?= $this->section('content') ?>

<form  class="needs-validation" novalidate action="<?php echo $action ?>" method="POST" id="strForm" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo isset($save_data['positionMapID'])?$save_data['positionMapID']:'' ?>"/>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body d-inline">

                    <span class="h2"><?php echo $prefix.$title; ?></span>
                    <div class="float-end">
                        <a href="<?php echo base_url('StructureByAssistRate') ?>" class="btn btn-default"><i class="fas fa-chevron-left"></i> ย้อนกลับ</a>
                        <button class="btn btn-default" type="submit"><i class="fas fa-save"></i> อัพโหลด</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="mb-3 row">
                            <label for="" class="col-12 col-md-3 form-label">แถวที่เริ่มข้อมูล</label>
                            <div class="col-12 col-md-6">
                                <input type="hidden" name="profileId" id="" class="form-control" value="<?php echo $profileId ?>">
                                <input type="number" name="rowStart" id="" class="form-control" >
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-12 col-md-3 form-label">ไฟล์อัพโหลด</label>
                            <div class="col-12 col-md-6">
                                <input type="file" name="uploadFile" id="" class="form-control" required>
                                <div class="invalid-feedback">
                                    กรุณาอัพโหลดไฟล์
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<?= $this->endSection() ?>
<?= $this->section('jsContent') ?>
    <script src="<?php echo base_url() ?>/assets/libs/parsleyjs/parsley.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/js/pages/form-validation.init.js"></script>
    <script>
        $(document).ready(function(){
            $(".select2").select2();
        })
    </script>
        
<?= $this->endSection() ?>