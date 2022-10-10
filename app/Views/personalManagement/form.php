<?= $this->extend('theme/admin') ?>
<?= $this->section('content') ?>
<?php 
    $action = isset($save_data['fid'])?base_url('PersonalManagement/update/'.$save_data['fid']):base_url('PersonalManagement/save');
?>
<form  class="needs-validation" novalidate action="<?php echo $action ?>" method="POST" id="strForm">
    <input type="hidden" name="id" value="<?php echo isset($save_data['fid'])?$save_data['fid']:'' ?>"/>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body d-inline">
                    <span class="h2"><?php echo $title; ?></span>
                    <div class="float-end">
                        <a href="<?php echo base_url('PersonalManagement') ?>" class="btn btn-default"><i class="fas fa-chevron-left"></i> ย้อนกลับ</a>
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
                            <div class="col-12 col-md-6">
                                <input type="text" class="form-control"  id="cardID" name="cardID" value="<?php echo isset($save_data['cardID'])?$save_data['cardID']:'' ?>"/>
                                <div class="invalid-feedback">
                                    กรุณาระบุเลขประจำตัวประชาชน
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-12 col-md-3 form-label">คำนำหน้าชื่อ/ยศ</label>
                            <div class="col-12 col-md-6">
                                <select class="form-select" name="codePrefix" id="codePrefix" >
                                    <option value="">---- คำนำหน้าชื่อ/ยศ ----</option>
                                    <?php if (isset($codePrefix))
                                        foreach ($codePrefix as $key => $value) {
                                            $sel = '';
                                            if(isset($save_data['codePrefix'])){
                                                $sel = $save_data['codePrefix'] == $key ? 'selected': '';
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
                            <label for="" class="col-12 col-md-3 form-label">ชื่อ</label>
                            <div class="col-12 col-md-6">
                                <input type="text" class="form-control"  id="firstName" name="firstName" value="<?php echo isset($save_data['firstName'])?$save_data['firstName']:'' ?>"/>
                                <div class="invalid-feedback">
                                    กรุณาระบุชื่อ
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-12 col-md-3 form-label">นามสกุล</label>
                            <div class="col-12 col-md-6">
                                <input type="text" class="form-control"  id="lastName" name="lastName" value="<?php echo isset($save_data['lastName'])?$save_data['lastName']:'' ?>"/>
                                <div class="invalid-feedback">
                                    กรุณาระบุนามสกุล
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-12 col-md-3 form-label">ประเภทกำลังพล</label>
                            <div class="col-12 col-md-6">
                                <select class="form-select" name="hrTypeID" id="hrTypeID" >
                                    <option value="">---- เลือกประเภทกำลังพล ----</option>
                                    <?php if (isset($hrType))
                                        foreach ($hrType as $key => $value) {
                                            $sel = '';
                                            if(isset($save_data['hrTypeID'])){
                                                $sel = $save_data['hrTypeID'] == $key? 'selected':'';
                                            }
                                        ?>
                                            <option value="<?php echo $key ?>" <?php echo $sel ?>><?php echo $value ?></option>
                                        <?php 
                                        }
                                    ?>
                                </select>
                                <div class="invalid-feedback">
                                    กรุณาเลือกประเภทกำลังพล
                                </div>
                            </div>
                        </div>
                    
                        <div class="mb-3 row">
                            <label for="" class="col-12 col-md-3 form-label">ตำแหน่งและสายงานในสังกัดปกติ</label>
                            <div class="col-12 col-md-3">
                                <select class="form-select" name="positionCivilian" id="positionCivilian" >
                                    <option value="">---- เลือกตำแหน่งในสายงานปกติ ----</option>
                                    <?php if (isset($positionCivilian))
                                        foreach ($positionCivilian as $key => $value) {
                                            $sel = '';
                                            if(isset($save_data['positionCivilianID'])){
                                                $sel = $save_data['positionCivilianID'] == $value->id? 'selected':'';
                                            }
                                        ?>
                                            <option value="<?php echo $value->id ?>" <?php echo $sel ?>><?php echo $value->position_civilian_name ?></option>
                                        <?php 
                                        }
                                    ?>
                                </select>
                                <div class="invalid-feedback">
                                    กรุณาเลือกตำแหน่งในสายงานปกติ
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <select class="form-select" name="positionCivilianGroup" id="positionCivilianGroup" >
                                    <option value="">---- เลือกสายงานในสังกัดปกติ ----</option>
                                    <?php if (isset($positionCivilianGroup))
                                        foreach ($positionCivilianGroup as $key => $value) {
                                            $sel = '';
                                            if(isset($save_data['positionCivilianGroupID'])){
                                                $sel = $save_data['positionCivilianGroupID'] == $value->id? 'selected':'';
                                            }
                                        ?>
                                            <option value="<?php echo $value->id ?>" <?php echo $sel ?>><?php echo $value->position_civilian_group_name ?></option>
                                        <?php 
                                        }
                                    ?>
                                </select>
                                <div class="invalid-feedback">
                                    กรุณาเลือกสายงานในสังกัดปกติ
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-12 col-md-3 form-label">ตำแหน่งและสายงานในสังกัด กอ.รมน.</label>
                            <div class="col-12 col-md-3">
                                <select class="form-select select2"  name="position" id="position">
                                    <option value="">---- เลือกตำแหน่งใน กอ.รมน.----</option>
                                    <?php if (isset($position))
                                        foreach ($position as $key => $value) {
                                            $sel = '';
                                            if(isset($save_data['positionID'])){
                                                $sel = $save_data['positionID'] == $value->id? 'selected':'';
                                            }
                                        ?>
                                            <option value="<?php echo $value->id ?>" <?php echo $sel ?>><?php echo $value->position_name ?></option>
                                        <?php 
                                        }
                                    ?>
                                </select>
                                <div class="invalid-feedback">
                                    กรุณาเลือกตำแหน่งใน กอ.รมน.
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <select class="form-select" name="positionGroup" id="positionGroup" >
                                    <option value="">---- เลือกสายงานใน กอ.รมน. ----</option>
                                    <?php if (isset($positionGroup))
                                        foreach ($positionGroup as $key => $value) {
                                            $sel = '';
                                            if(isset($save_data['positionGroupID'])){
                                                $sel = $save_data['positionGroupID'] == $value->id? 'selected':'';
                                            }
                                        ?>
                                            <option value="<?php echo $value->id ?>" <?php echo $sel ?>><?php echo $value->position_group_name ?></option>
                                        <?php 
                                        }
                                    ?>
                                </select>
                                <div class="invalid-feedback">
                                    กรุณาเลือกสายงานใน กอ.รมน.
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
            // $('#strForm').submit(function(e) {

            //     e.preventDefault();
            // })
            // $('form').on('submit', function(e){
            //     // validation code here
            //     // if(!valid) {
            //     e.preventDefault();
            //     // }
            // });
        })
    </script>
        
<?= $this->endSection() ?>