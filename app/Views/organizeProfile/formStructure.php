<?php 
    $action = isset($save_data['org_id'])?base_url('OrganizeProfile/updateStructure/'.$save_data['org_id']):base_url('OrganizeProfile/saveStructure');
    $prefix = isset($save_data['org_id'])?'แก้ไข':'เพิ่ม';
?>
<?= $this->extend('theme/admin') ?>
<?= $this->section('content') ?>

<form  class="needs-validation" novalidate action="<?php echo $action ?>" method="POST" id="strForm">
    <input type="hidden" id="org_profile_id" name="org_profile_id" value="<?php echo isset($save_data['org_profile_id'])?$save_data['org_profile_id']:$org_profile_id ?>">
    <input type="hidden" id="org_id" name="org_id" value="<?php echo isset($save_data['org_id'])?$save_data['org_id']:'' ?>">
    <input type="hidden" id="org_parent" name="org_parent" value="<?php echo isset($save_data['org_parent'])?$save_data['org_parent']:$org_parent ?>">
    <input type="hidden" id="org_profile_year" name="org_profile_year" value="<?php echo isset($parent_data['org_profile_year'])?$parent_data['org_profile_year']:$save_data['org_profile_year'] ?>">
    <input type="hidden" id="profileType" name="profileType" value="<?php echo isset($parent_data['profileType'])?$parent_data['profileType']:$save_data['profileType'] ?>">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body d-inline">
                    <span class="h2"><?php echo $prefix.$title; ?></span>
                    <div class="float-end">
                        <a href="<?php echo base_url('OrganizeProfile/structure/'.$org_profile_id) ?>" class="btn btn-default"><i class="fas fa-chevron-left"></i> ย้อนกลับ</a>
                        <button class="btn btn-default" type="submit"><i class="fas fa-save"></i> บันทึก</button>
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
                        <div class="row mb-2">
                            <label for="" class="label-control col-md-3">ชื่อหน่วยงาน</label>
                            <div class="col-md-6">
                                <input type="text" id="org_name" name="org_name" required class="form-control" value="<?php echo isset($save_data['org_name'])?$save_data['org_name']:'' ?>"/>
                            </div>
                            <div class="invalid-feedback">
                                กรุณาระบุชื่อหน่วยงาน
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="" class="label-control col-md-3">ชื่อย่อ</label>
                            <div class="col-md-6">
                                <input type="text" id="org_short_name" name="org_short_name" class="form-control" value="<?php echo isset($save_data['org_short_name'])?$save_data['org_short_name']:'' ?>"/>
                            </div>
                            <div class="invalid-feedback">
                                กรุณาระบุชื่อย่อหน่วยงาน
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
