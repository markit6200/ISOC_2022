<!-- sample modal content -->
<div id="duplicateModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="duplicateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="duplicateModalLabel">คัดลอก</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form id="duplicateProfileFrm" method="POST">
                <input type="hidden" id="org_profile_id" name="org_profile_id">
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
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal">ยกเลิก</button>
                <button type="button" onclick="saveDuplicateProfile()" class="btn btn-success waves-effect waves-light">บันทึก</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->