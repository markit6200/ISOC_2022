<!-- sample modal content -->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">เพิ่มข้อมูล</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="org_id" name="org_id">
                <input type="hidden" id="org_parent" name="org_parent">
                <div class="row mb-2">
                    <label for="" class="label-control col-md-3">ชื่อหน่วยงาน</label>
                    <div class="col-md-8">
                        <input type="text" id="org_name" name="org_name" class="form-control" value=""/>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="" class="label-control col-md-3">ชื่อย่อ</label>
                    <div class="col-md-8">
                        <input type="text" id="org_short_name" name="org_short_name" class="form-control" value=""/>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal">ยกเลิก</button>
                <button type="button" onclick="saveOrg()" class="btn btn-success waves-effect waves-light">บันทึก</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->