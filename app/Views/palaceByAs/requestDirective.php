<style>
.scoll-tree{
   /* max-width: 400px; */
   /* height:80px; */
   overflow-x: auto;
   min-height: 300px;
}
</style>

<!-- Modal -->
 <div class="modal fade" id="requestDirectiveModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">ร้องขอออกคำสั่ง</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body" style="padding:22px;">
                <div class="card">
                    <div class="card-body">
                        <!-- <form class="needs-validation" novalidate action="<?php echo base_url('PalaceByAssist/saveRequestDirective'); ?>" method="POST" id="forReq"> -->
                        <form action="<?php echo base_url('PalaceByAssist/saveRequestDirective'); ?>" method="POST" id="forReq">
                            <input type="hidden" class="form-control" id="statusPackingRate" name="statusPackingRate">
                            <input type="hidden" class="form-control" id="rOrgId" name="rOrgId">
                            <input type="hidden" class="form-control" id="hID" name="hID">
                            <input type="hidden" class="form-control" id="statusDirective" name="statusDirective">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3 row">
                                        <label for="" class="col-12 col-md-3 form-label"></label>
                                        <label for="directiveBegin" class="col-12 col-md-1 form-label">คำสั่งปฏิบัติ</label>
                                        <div class="col-12 col-md-5">
                                            <input type="text" class="form-control"  id="directiveBegin" name="directiveBegin" value="<?php echo isset($save_data['directiveBegin'])?$save_data['directiveBegin']:'' ?>">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="" class="col-12 col-md-3 form-label"></label>
                                        <label for="directiveBegin" class="col-12 col-md-1 form-label">ประเภทคำสั่ง</label>
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

                                    <!-- <div class="mb-3 row">
                                        <label for="" class="col-12 col-md-3 form-label"></label>
                                        <label for="dateBegin" class="col-12 col-md-1 form-label">วันที่ปฏิบัติ</label>
                                        <div class="col-12 col-md-5">
                                            <div class="input-group" id="datepicker2">
                                                <input type="text" class="form-control" placeholder="dd/mm/yyyy" data-date-format="dd/mm/yyyy" data-date-container='#datepicker2' data-provide="datepicker" data-date-autoclose="true" id="dateBegin" name="dateBegin">
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="" class="col-12 col-md-3 form-label"></label>
                                        <label for="dateEnd" class="col-12 col-md-1 form-label">วันที่สิ้นสุด</label>
                                        <div class="col-12 col-md-5">
                                            <div class="input-group" id="datepicker2">
                                                <input type="text" class="form-control" placeholder="dd/mm/yyyy" data-date-format="dd/mm/yyyy" data-date-container='#datepicker2' data-provide="datepicker" data-date-autoclose="true" id="dateEnd" name="dateEnd">
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                            <div class="controlData"></div>
                            <div class="table-responsive scoll-tree">
                                <table id="myTable" class="table table-bordered" style="width: max-content;">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" class="text-center text-dark" width="60px">ลำดับ</th>
                                            <th rowspan="2" class="text-center text-dark sort-column" width="200px">ชื่อตำแหน่งใน กอ.รมน./<br>ชื่อตำแหน่งในการบริหาร</th>
                                            <th rowspan="2" class="text-center text-dark sort-column" width="100px">ชั้นยศ</th>
                                            <th rowspan="2" class="text-center text-dark sort-column" width="100px">ตำแหน่ง<br>เลขที่</th>
                                            <th rowspan="2" class="text-center text-dark sort-column" width="100px">ยศ</th>
                                            <th rowspan="2" class="text-center text-dark sort-column">ชื่อ-สกุล</th>
                                            <th rowspan="2" class="text-center text-dark sort-column" width="200px">ตำแหน่งและสังกัดปกติ</th>
                                            <th rowspan="2" class="text-center text-dark sort-column" width="200px">วันที่ปฏิบัติ</th>
                                            <th rowspan="2" class="text-center text-dark sort-column" width="200px">วันที่สิ้นสุด</th>
                                            <th class="text-center text-dark" style="width: 80px;">เครื่องมือ</th>
                                        </tr>

                                    </thead>
                                    <tbody id="loadPData">
                                    
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="text-center">
                                <button type="submit" class="btn btn-success" onclick="checkSave()">บันทึก</button>
                                <button type="submit" class="btn btn-primary" onclick="checkSend()">ส่งไปออกคำสั่ง</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="checkClose()">ปิด</button>
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
$( document ).ready(function() {
   
});

function checkSave(){
    $("#statusPackingRate").val(4);
    $("#statusDirective").val(0);
}

function checkSend(){
    $("#statusPackingRate").val(5);
    $("#statusDirective").val(1);
}

function delRow(mId){
    // console.log('mId==>');
    // console.log(mId);
    //update status
    $.ajax({
        url:  "PalaceByAssist/saveDelRequest",
        method: "post",
        data: {mId: mId},
        dataType: "text",
        success: function (data) {
            // $("#directiveBegin").val('');
            // $("#dateBegin").val('');
            // $("#dateEnd").val('');

            // $("#loadPData").html(data);
            console.log(data);
            if(data=='success'){
                $("#R"+mId).closest('tr').remove();
                $("#cReq"+mId).closest('input').remove();
            }
        }
    });
    // $("#R"+mId).closest('tr').remove();
    // $("#cReq"+mId).closest('input').remove();
}

</script>
