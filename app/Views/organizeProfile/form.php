<?php 
    $action = isset($save_data['org_profile_id'])?base_url('OrganizeProfile/updateProfile/'.$save_data['org_profile_id']):base_url('OrganizeProfile/saveProfile');
    $prefix = isset($save_data['org_profile_id'])?'แก้ไข':'เพิ่ม';
?>
<?= $this->extend('theme/admin') ?>
<?= $this->section('content') ?>

<form  class="needs-validation" novalidate action="<?php echo $action ?>" method="POST" id="strForm">
    <input type="hidden" name="org_profile_id" value="<?php echo isset($save_data['org_profile_id'])?$save_data['org_profile_id']:'' ?>"/>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body d-inline">

                    <span class="h2"><?php echo $prefix.$title; ?></span>
                    <div class="float-end">
                        <a href="<?php echo base_url('OrganizeProfile') ?>" class="btn btn-default"><i class="fas fa-chevron-left"></i> ย้อนกลับ</a>
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
                                <label for="" class="col-12 col-md-3 form-label">ชื่อโปรไฟล์</label>
                                <div class="col-12 col-md-6">
                                    <input type="text" class="form-control" required name="org_profile_name" value="<?php echo isset($save_data['org_profile_name'])?$save_data['org_profile_name']:'' ?>"/>
                                    <div class="invalid-feedback">
                                        กรุณาระบุชื่อโปรไฟล์
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="" class="col-12 col-md-3 form-label">ปี</label>
                                <div class="col-12 col-md-6">
                                    <select class="form-select" name="org_profile_year" id="org_profile_year" >
                                        <option value="">---- เลือกปี ----</option>
                                        <?php if (isset($year))
                                            foreach ($year as $key => $value) {
                                                $sel = '';
                                                if(isset($save_data['org_profile_year'])){
                                                    $sel = $save_data['org_profile_year'] == $key? 'selected':'';
                                                }
                                            ?>
                                                <option value="<?php echo $key ?>" <?php echo $sel ?>><?php echo $value ?></option>
                                            <?php 
                                            }
                                        ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        กรุณาเลือกปี
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="" class="col-12 col-md-3 form-label">สถานะการใช้งาน</label>
                                <div class="col-12 col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="org_profile_status" id="active" value="1" checked>
                                        <label class="form-check-label" for="active">
                                            ใช้งาน
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="org_profile_status" id="deactive" value="0">
                                        <label class="form-check-label" for="deactive">
                                            ไม่ใช้งาน
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="" class="col-12 col-md-3 form-label">วันที่ประกาศใช้</label>
                                <div class="col-12 col-md-6">
                                    <input type="date" class="form-control" name="org_date_announce"  value="<?php echo isset($save_data['org_date_announce'])?$save_data['org_date_announce']:''; ?>"/>
                                    <div class="invalid-feedback">
                                        กรุณาระบุวันที่ประกาศใช้
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
        function selectRank(id){
            if (id != ''){
                $('.selectRankTo').html('<div class="spinner-border text-secondary m-1" role="status"><span class="sr-only">Loading...</span> </div>');
                $.ajax({
                    url: "<?php echo base_url('OrganizeProfile/ajaxGetRank/') ?>/"+id,
                    type: 'get',
                    contentType: false,
                    processData: false,
                    success: function( result ) {
                        if(result != 'fail'){
                            $('.selectRankTo').html(result)
                        }
                    }
                });
            } else {
                $('.selectRankTo').html('');
            }
        }
        $(document).ready(function(){
            $(".select2").select2();
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