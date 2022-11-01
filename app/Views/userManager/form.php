<?= $this->extend('theme/admin') ?>
<?= $this->section('content') ?>
<?php
$action = isset($save_data['runid'])?base_url('userManager/updateUser/'.$save_data['runid']):base_url('userManager/saveUser');
$readonly = isset($save_data['runid'])?'readonly=""':'';
?>
<form  class="needs-validation" novalidate action="<?php echo $action ?>" method="POST" id="strForm">
    <input type="hidden" name="id" value="<?php echo isset($save_data['runid'])?$save_data['runid']:'' ?>"/>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body d-inline">
                <span class="h2"><?php echo $title; ?></span>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <span class="h4">เพิ่มข้อมูลผู้ใช้งาน</span>
                <div class="float-end">
                    <a href="<?php echo base_url('userManager/index') ?>" class="btn btn-default"><i class="fas fa-chevron-left"></i> ย้อนกลับ</a>
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
                    <div class="row mt-2">
                        <label for="" class="col-md-4 form-label"> ผู้ใช้งาน</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="username" value="<?php echo isset($save_data['username'])?$save_data['username']:'' ?>" <?php echo $readonly?> />
                        </div>
                    </div>
                    <?php if (empty($save_data['runid'])){ ?>
                    <div class="row mt-2">
                        <label for="" class="col-md-4 form-label">รหัสผ่าน</label>
                        <div class="col-md-8">
                            <input type="password" class="form-control" name="pwd" />
                        </div>
                    </div>
                    <?php } ?>
                    <div class="row mt-2">
                        <label for="" class="col-md-4 form-label">เลขประจำตัวประชาชน</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="idcard" value="<?php echo isset($save_data['idcard'])?$save_data['idcard']:'' ?>" />
                        </div>
                    </div>
                    <div class="row mt-2">
                        <label for="" class="col-md-4 form-label">คำนำหน้าชื่อ</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="prename_th" value="<?php echo isset($save_data['prename_th'])?$save_data['prename_th']:'' ?>" />
<!--                            <select class="form-select select2" name="prename_th">-->
<!--                                <option value="">---- คำนำหน้าชื่อ/ยศ ----</option>-->
<!--                                --><?php //if (isset($codePrefix))
//                                    foreach ($codePrefix as $key => $value) {
//                                        $sel = '';
//                                        if(isset($save_data['prename_th'])){
//                                            $sel = $save_data['prename_th'] == $key ? 'selected': '';
//                                        }
//                                        ?>
<!--                                        <option value="--><?php //echo $key ?><!--" --><?php //echo $sel ?><?php //echo $value ?><!--</option>-->
<!--                                        --><?php
//                                    }
//                                ?>
<!--                            </select>-->
<!--                            <div class="invalid-feedback">-->
<!--                                กรุณาเลือกคำนำหน้าชื่อ/ยศ-->
<!--                            </div>-->
                        </div>
                    </div>
                    <div class="row mt-2">
                        <label for="" class="col-md-4 form-label">ชื่อ (ไทย)</label>
                        <div class="col-md-8">
                            <input type="text" name="name_th" id="" class="form-control" value="<?php echo isset($save_data['name_th'])?$save_data['name_th']:'' ?>">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <label for="" class="col-md-4 form-label">นามสกุล (ไทย)</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="surname_th" value="<?php echo isset($save_data['surname_th'])?$save_data['surname_th']:'' ?>" />
                        </div>
                    </div>
                    <div class="row mt-2">
                        <label for="" class="col-md-4 form-label">ชื่อ (อังกฤษ)</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="name_en" value="<?php echo isset($save_data['name_en'])?$save_data['name_en']:'' ?>" />
                        </div>
                    </div>
                    <div class="row mt-2">
                        <label for="" class="col-md-4 form-label">นามสกุล (อังกฤษ)</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="surname_en" value="<?php echo isset($save_data['surname_en'])?$save_data['surname_en']:'' ?>" />
                        </div>
                    </div>
                    <div class="row mt-2">
                        <label for="" class="col-md-4 form-label">สังกัดหน่วยงาน</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="office" value="<?php echo isset($save_data['office'])?$save_data['office']:'' ?>" />
                        </div>
                    </div>
                    <div class="row mt-2">
                        <label for="" class="col-md-4 form-label">เพศ</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="sex" value="<?php echo isset($save_data['sex'])?$save_data['sex']:'' ?>" />
                        </div>
                    </div>
                    <div class="row mt-2">
                        <label for="" class="col-md-4 form-label">วัน/เดือน/ปี เกิด</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="birthday" value="<?php echo isset($save_data['birthday'])?$save_data['birthday']:'' ?>" />
                        </div>
                    </div>
<!--                    <div class="row mt-2">-->
<!--                        <label for="" class="col-md-4 form-label">ประเภทผู้ใช้</label>-->
<!--                        <div class="col-md-8">-->
<!--                            <div class="form-check">-->
<!--                                <input class="form-check-input" type="radio" name="active" id="active" value="1" checked>-->
<!--                                <label class="form-check-label" for="active">-->
<!--                                    ใช้งาน-->
<!--                                </label>-->
<!--                            </div>-->
<!--                            <div class="form-check">-->
<!--                                <input class="form-check-input" type="radio" name="active" id="deactive" value="0">-->
<!--                                <label class="form-check-label" for="deactive">-->
<!--                                    ไม่ใช้งาน-->
<!--                                </label>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="row mt-2">-->
<!--                        <label for="" class="col-md-4 form-label">ประเภท</label>-->
<!--                        <div class="col-md-8">-->
<!--                            <div class="form-check">-->
<!--                                <input class="form-check-input" type="radio" name="active" id="active" value="1" checked>-->
<!--                                <label class="form-check-label" for="active">-->
<!--                                    ใช้งาน-->
<!--                                </label>-->
<!--                            </div>-->
<!--                            <div class="form-check">-->
<!--                                <input class="form-check-input" type="radio" name="active" id="deactive" value="0">-->
<!--                                <label class="form-check-label" for="deactive">-->
<!--                                    ไม่ใช้งาน-->
<!--                                </label>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="row mt-2">-->
<!--                        <label for="" class="col-md-4 form-label">สังกัดหน่วยงาน</label>-->
<!--                        <div class="col-md-8">-->
<!--                            <input type="text" class="form-control" name="org_id"/>-->
<!--                        </div>-->
<!--                    </div>-->
                    <div class="row mt-2">
                        <label for="" class="col-md-4 form-label">ที่อยู่</label>
                        <div class="col-md-8">
                            <textarea class="form-control" name="address" value="<?php echo isset($save_data['address'])?$save_data['address']:'' ?>"></textarea>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <label for="" class="col-md-4 form-label">หมายเลขโทรศัพท์</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="telno" value="<?php echo isset($save_data['telno'])?$save_data['telno']:'' ?>" />
                        </div>
                    </div>
                    <div class="row mt-2">
                        <label for="" class="col-md-4 form-label">อีเมล์</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control input-mask" name="email" value="<?php echo isset($save_data['email'])?$save_data['email']:'' ?>" data-inputmask="'alias': 'email'"/>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <label for="" class="col-md-4 form-label">รูปประจำตัว</label>
                        <div class="col-md-8">
                            <input type="file" class="form-control" name="login_image" value="<?php echo isset($save_data['login_image'])?$save_data['login_image']:'' ?>" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
<?= $this->endSection() ?>
<?= $this->section('cssTopContent') ?>
    <link href="<?php echo base_url() ?>/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<?= $this->endSection() ?>
<?= $this->section('jsContent') ?>
    <script src="<?php echo base_url() ?>/assets/libs/parsleyjs/parsley.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/js/pages/form-validation.init.js"></script>
    <script src="<?php echo base_url() ?>/assets/libs/select2/js/select2.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/libs/inputmask/min/jquery.inputmask.bundle.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/js/pages/form-mask.init.js"></script>
    <script>
        $(document).ready(function(){
            $(".select2").select2();
        })
    </script>
<?= $this->endSection() ?>
