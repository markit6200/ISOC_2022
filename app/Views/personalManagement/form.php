<?= $this->extend('theme/admin') ?>
<?= $this->section('content') ?>
<?php 
    $action = isset($save_data['fid'])?base_url('PersonalManagement/update/'.$save_data['positionMapID']):base_url('PersonalManagement/save');
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
                            <label for="" class="col-12 col-md-3 form-label">หน่วยงาน</label>
                            <div class="col-12 col-md-6">
                                <select class="form-select" name="positionRank" id="positionRank" required>
                                    <option value="">---- เลือกหน่วยงาน ----</option>
                                    <?php if (isset($positionRank))
                                        foreach ($positionRank as $key => $value) {
                                        ?>
                                            <option value="<?php echo $value->id ?>"><?php echo $value->rank_name ?></option>
                                        <?php 
                                        }
                                    ?>
                                </select>
                                <div class="invalid-feedback">
                                    กรุณาเลือกหน่วยงาน
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-12 col-md-3 form-label">เลขประจำตัวประชาชน</label>
                            <div class="col-12 col-md-6">
                                <input type="text" class="form-control" required id="cardID" name="cardID" value="<?php echo isset($save_data['cardID'])?$save_data['cardID']:'' ?>"/>
                                <div class="invalid-feedback">
                                    กรุณาระบุเลขประจำตัวประชาชน
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-12 col-md-3 form-label">ชั้นยศ</label>
                            <div class="col-12 col-md-6">
                                <select class="form-select" name="positionRank" id="positionRank" required>
                                    <option value="">---- เลือกชั้นยศ ----</option>
                                    <?php if (isset($positionRank))
                                        foreach ($positionRank as $key => $value) {
                                        ?>
                                            <option value="<?php echo $value->id ?>"><?php echo $value->rank_name ?></option>
                                        <?php 
                                        }
                                    ?>
                                </select>
                                <div class="invalid-feedback">
                                    กรุณาเลือกชั้นยศ
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-12 col-md-3 form-label">ชื่อ</label>
                            <div class="col-12 col-md-6">
                                <input type="text" class="form-control" required id="cardID" name="cardID" value="<?php echo isset($save_data['cardID'])?$save_data['cardID']:'' ?>"/>
                                <div class="invalid-feedback">
                                    กรุณาระบุชื่อ
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-12 col-md-3 form-label">นามสกุล</label>
                            <div class="col-12 col-md-6">
                                <input type="text" class="form-control" required id="cardID" name="cardID" value="<?php echo isset($save_data['cardID'])?$save_data['cardID']:'' ?>"/>
                                <div class="invalid-feedback">
                                    กรุณาระบุนามสกุล
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-12 col-md-3 form-label">ตำแหน่งและสายงานในสังกัดปกติ</label>
                            <div class="col-12 col-md-6">
                                <select class="form-select" name="positionCivilian" id="positionCivilian" required>
                                    <option value="">---- เลือกชื่อตำแหน่งในสายงานพลเรือน ----</option>
                                    <?php if (isset($positionCivilian))
                                        foreach ($positionCivilian as $key => $value) {
                                        ?>
                                            <option value="<?php echo $value->id ?>"><?php echo $value->position_civilian_name ?></option>
                                        <?php 
                                        }
                                    ?>
                                </select>
                                <div class="invalid-feedback">
                                    กรุณาเลือกตำแหน่งและสายงานในสังกัดปกติ
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-12 col-md-3 form-label">ตำแหน่งและสายงานในสังกัด กอ.รมน.</label>
                            <div class="col-12 col-md-6">
                                <select class="form-select" name="positionCivilianGroup" id="positionCivilianGroup" required>
                                    <option value="">---- เลือกระดับพลเรือนหรือเทียบเท่า ----</option>
                                    <?php if (isset($positionCivilianGroup))
                                        foreach ($positionCivilianGroup as $key => $value) {
                                        ?>
                                            <option value="<?php echo $value->id ?>"><?php echo $value->position_civilian_group_name ?></option>
                                        <?php 
                                        }
                                    ?>
                                </select>
                                <div class="invalid-feedback">
                                    กรุณาเลือกตำแหน่งและสายงานในสังกัด กอ.รมน.
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