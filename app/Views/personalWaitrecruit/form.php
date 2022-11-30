<?= $this->extend('theme/admin') ?>
<?= $this->section('content') ?>
<?php
$action = isset($save_data['pid']) ? base_url('PersonalWaitrecruit/update/' . $save_data['pid']) : base_url('PersonalWaitrecruit/save');

if (isset($save_data['cardID'])) {
    $head = $save_data['cardID'];
    $s1 = substr($head, 0, 1); //1
    $s2 = substr($head, 1, 4); //5601
    $s3 = substr($head, 5, 5); //01525
    $s4 = substr($head, 10, 2); //76
    $s5 = substr($head, 12, 1); // 5
    $save_data['cardID'] = "$s1-$s2-$s3-$s4-$s5";
}

?>
<script>
    function autoTab(obj) {
        var pattern = new String("_-____-_____-__-_"); // กำหนดรูปแบบในนี้
        var pattern_ex = new String("-"); // กำหนดสัญลักษณ์หรือเครื่องหมายที่ใช้แบ่งในนี้
        var returnText = new String("");
        var obj_l = obj.value.length;
        var obj_l2 = obj_l - 1;
        for (i = 0; i < pattern.length; i++) {
            if (obj_l2 == i && pattern.charAt(i + 1) == pattern_ex) {
                returnText += obj.value + pattern_ex;
                obj.value = returnText;
            }
        }
        if (obj_l >= pattern.length) {
            obj.value = obj.value.substr(0, pattern.length);
        }
    }
</script>

<form class="needs-validation" novalidate action="<?php echo $action ?>" method="POST" id="strForm">
    <input type="hidden" name="id" value="<?php echo isset($save_data['pid']) ? $save_data['pid'] : '' ?>" />
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body d-inline">
                    <span class="h2"><?php echo $title; ?></span>
                    <div class="float-end">
                        <a href="<?php echo base_url('PersonalWaitrecruit') ?>" class="btn btn-default"><i class="fas fa-chevron-left"></i> ย้อนกลับ</a>
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
                        <div class="mb-3 row">
                            <label for="" class="col-12 col-md-3 form-label">เลขประจำตัวประชาชน</label>
                            <div class="col-12 col-md-3">
                                <input type="text" class="form-control" onkeyup="autoTab(this)" minlength="13" maxlength="20" id="cardID" name="cardID" value="<?php echo isset($save_data['cardID']) ? $save_data['cardID'] : '' ?>" />
                                <div class="invalid-feedback">
                                    กรุณาระบุเลขประจำตัวประชาชน
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-12 col-md-3 form-label">คำนำหน้าชื่อ/ยศ</label>
                            <div class="col-12 col-md-3">
                                <select class="form-select select2" name="codePrefix" id="codePrefix">
                                    <option value="">---- คำนำหน้าชื่อ/ยศ ----</option>
                                    <?php if (isset($codePrefix))
                                        foreach ($codePrefix as $key => $value) {
                                            $sel = '';
                                            if (isset($save_data['codePrefix'])) {
                                                $sel = $save_data['codePrefix'] == $key ? 'selected' : '';
                                            }
                                    ?>
                                        <option value="<?php echo $key ?>" <?php echo $sel ?>><?php echo $value ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                                <div class="invalid-feedback">
                                    กรุณาเลือกคำนำหน้าชื่อ/ยศ
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-12 col-md-3 form-label">เพศ</label>
                            <div class="col-12 col-md-3">
                                <select class="form-select select2" name="gender" id="gender">
                                    <option value="">---- เพศ ----</option>
                                    <?php
                                    $gender = array('ชาย', 'หญิง');
                                    if (isset($gender))
                                        foreach ($gender as $key => $value) {
                                            $sel = '';
                                            if (isset($gender)) {
                                                $sel = $gender == $key ? 'selected' : '';
                                            }
                                            if (isset($save_data['gender'])) {
                                                $sel = $save_data['gender'] == $key ? 'selected' : '';
                                            }
                                    ?>
                                        <option value="<?php echo $key ?>" <?php echo $sel ?>><?php echo $value ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                                <div class="invalid-feedback">
                                    กรุณาเลือกเพศ
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-12 col-md-3 form-label">ชื่อ - นามสกุล</label>
                            <div class="col-12 col-md-3">
                                <input type="text" class="form-control" id="firstName" name="firstName" placeholder="ชื่อ" value="<?php echo isset($save_data['firstName']) ? $save_data['firstName'] : '' ?>" />
                                <div class="invalid-feedback">
                                    กรุณาระบุชื่อ
                                </div>
                            </div>
                            <!-- <label for="" class="col-12 col-md-3 form-label">นามสกุล</label> -->
                            <div class="col-12 col-md-3">
                                <input type="text" class="form-control" id="lastName" name="lastName" placeholder="นามสกุล" value="<?php echo isset($save_data['lastName']) ? $save_data['lastName'] : '' ?>" />
                                <div class="invalid-feedback">
                                    กรุณาระบุนามสกุล
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-12 col-md-3 form-label">ตำแหน่งและสังกัด</label>
                            <div class="col-12 col-md-6">
                                <input type="text" class="form-control" id="originPosition" name="originPosition" value="<?php echo isset($save_data['originPosition']) ? $save_data['originPosition'] : '' ?>" />
                                <div class="invalid-feedback">
                                    กรุณาระบุตำแหน่ง
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
<?= $this->section('cssTopContent') ?>
<link href="<?php echo base_url() ?>/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<?= $this->endSection() ?>
<?= $this->section('jsContent') ?>
<script src="<?php echo base_url() ?>/assets/libs/parsleyjs/parsley.min.js"></script>
<script src="<?php echo base_url() ?>/assets/js/pages/form-validation.init.js"></script>
<script src="<?php echo base_url() ?>/assets/libs/select2/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $(".select2").select2();
    })
</script>

<?= $this->endSection() ?>