<style>
    .scoll-tree{
        overflow-x: auto;
        min-height: 300px;
    }
</style>
<!-- Modal -->
<div class="modal fade" id="requestRetireModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">คำสั่งพ้น</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body" style="padding:22px;">
                <div class="card">
                    <div class="card-body">
                        <form action="<?php echo base_url('PalaceByAssist/saveRequestRetire'); ?>" method="POST" id="forRetire">

                            <input type="hidden" class="form-control" id="statusPackingRate" name="statusPackingRate">
                            <input type="hidden" class="form-control" id="rOrgId" name="rOrgId">
                            <input type="hidden" class="form-control" id="hIDRetire" name="hIDRetire">
                            <input type="hidden" class="form-control" id="statusDirective" name="statusDirective">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3 row">
                                        <label for="" class="col-12 col-md-12 form-label text-center" id="textOrgName"></label>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="" class="col-12 col-md-2 form-label"></label>
                                        <label for="directiveRetire" class="col-12 col-md-2 form-label text-end">คำสั่งพ้น</label>
                                        <div class="col-12 col-md-5">
                                            <input type="text" class="form-control"  id="directiveRetire" name="directiveRetire" value="">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="" class="col-12 col-md-2 form-label"></label>
                                        <label for="orderTypeID" class="col-12 col-md-2 form-label text-end">ประเภทคำสั่ง</label>
                                        <div class="col-12 col-md-5">
                                            <select class="form-select select2" name="orderTypeID" id="orderTypeID" >
                                                <option value="">---- ประเภทคำสั่ง ----</option>
                                                <?php 
                                                    if (isset($orderType)){
                                                        foreach ($orderType as $key => $value) {
                                                ?>
                                                            <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                                <?php 
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="controlData"></div>
                            <div class="table-responsive scoll-tree">
                                <table id="myTable" class="table  table-bordered" style="width: max-content;">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" class="text-center text-dark" width="60px">ลำดับ</th>
                                            <th rowspan="2" class="text-center text-dark sort-column" width="200px">ชื่อตำแหน่งใน กอ.รมน./<br>ชื่อตำแหน่งในการบริหาร</th>
                                            <th rowspan="2" class="text-center text-dark sort-column" width="100px">ชั้นยศ</th>
                                            <th rowspan="2" class="text-center text-dark sort-column" width="100px">ตำแหน่ง<br>เลขที่</th>
                                            <th rowspan="2" class="text-center text-dark sort-column" width="100px">ยศ</th>
                                            <th rowspan="2" class="text-center text-dark sort-column">ชื่อ-สกุล</th>
                                            <th rowspan="2" class="text-center text-dark sort-column" width="200px">ตำแหน่งและสังกัดปกติ</th>
                                            <th rowspan="2" class="text-center text-dark sort-column" width="200px">วันที่พ้น</th>
                                            <th class="text-center text-dark" style="width: 80px;">เครื่องมือ</th>
                                        </tr>

                                    </thead>
                                    <tbody id="loadRetireData">
                                    
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="text-center">
                                <button type="submit" class="btn btn-success bt_save" onclick="checkRetireSave()">บันทึก</button>
                                <button type="submit" class="btn btn-primary bt_send" onclick="checkRetireSend()">ส่งไปคำสั่งพ้น</button>
                                <button type="button" class="btn btn-info" onclick="checkPrint()">พิมพ์</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- plugin css -->
<link href="assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
<link rel="stylesheet" href="assets/libs/@chenfengyuan/datepicker/datepicker.min.css">

<!-- datepicker css -->
<link rel="stylesheet" href="assets/libs/flatpickr/flatpickr.min.css">

<script src="assets/libs/jquery/jquery.min.js"></script>
<!-- plugins -->
<script src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="assets/libs/@chenfengyuan/datepicker/datepicker.min.js"></script>

<!-- datepicker js -->
<script src="assets/libs/flatpickr/flatpickr.min.js"></script>

<!-- parsleyjs -->

<script src="assets/js/pages/form-validation.init.js"></script>
<script src="assets/js/app.js"></script>

<script>

function checkRetireSave(){
    $("#requestRetireModal").find('.modal-body #statusPackingRate').val(6);
    $("#requestRetireModal").find('.modal-body #statusDirective').val(0);
}

function checkRetireSend(){
    $("#requestRetireModal").find('.modal-body #statusPackingRate').val(7);
    $("#requestRetireModal").find('.modal-body #statusDirective').val(1);
}

function delRowRetire(mId,hIDRetire){
    //update status
    $.ajax({
        url:  "PalaceByAssist/saveDelRequestRetire",
        method: "post",
        data: {mId: mId,hIDRetire:hIDRetire},
        dataType: "text",
        success: function (data) {
            if(data=='success'){
                $("#R"+mId).closest('tr').remove();
                $("#cReq"+mId).closest('input').remove();
            }
        }
    });
}

</script>
