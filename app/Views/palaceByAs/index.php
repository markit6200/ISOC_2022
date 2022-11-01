<?= $this->extend('theme/admin') ?>
<?= $this->section('content') ?>
<link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
<link href="assets/css/custom.css" rel="stylesheet" type="text/css" />

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <span class="h2"><?php echo $title; ?></span>
            </div>
        </div>
    </div>
</div>

    <style>
        .custom-code {
            border-left: 4px solid #04AA6D;
        }

        .custom-section,
        .custom-code {
            /* margin-top: 16px!important;
      margin-bottom: 16px!important; */
        }

        .custom-code {
            width: auto;
            background-color: #fff;
            color: #000;
            /* padding: 8px 12px; */
            padding: 11px 12px;
            /* border-left: 4px solid #4CAF50 !important; */
            /* border: 1px solid #e5e5e5; */
            word-wrap: break-word;
            border: 0px;
        }

        .float-left {
            float: left;
            margin-top: 3px;
            margin-right: 10px;
        }

        .dhx_demo-active {
            width: 100px;
            border: 1px solid;
            border-radius: 20px;
            text-align: center;
            text-transform: capitalize;
            font-weight: 500;
            line-height: 20px;
            border-color: rgba(10, 177, 105, .5);
            color: #0ab169;
        }

        .dhx_demo-danger {
            width: 100px;
            border: 1px solid;
            border-radius: 20px;
            text-align: center;
            text-transform: capitalize;
            font-weight: 500;
            line-height: 20px;
            border-color: red;
            color: red;
        }

        .dhx_button:hover {
            background-color: rgba(91, 108, 191, .9);
        }

        .dhx_button {
            color: #fff;
            overflow: visible;
            position: relative;
            text-decoration: none;
            background-image: none;
            border: 0;
            touch-action: manipulation;
            -webkit-appearance: none;
            -webkit-user-select: none;
            -ms-user-select: none;
            user-select: none;
            white-space: nowrap;
            cursor: pointer;
            background-color: rgba(91, 108, 191, .9);
            border-radius: 28px;
            padding: 4px 12px;
        }
    
        /* .dtHorizontalVerticalExampleWrapper {
            max-width: 600px;
            margin: 0 auto;
        }
        #dtHorizontalVerticalExample th, td {
            white-space: nowrap;
        } */

        .dtHorizontalVerticalWrapper {
            max-width: 600px;
            margin: 0 auto;
        }
        .dtHorizontalVertical th, td {
            white-space: nowrap;
        }
        table.dataTable thead .sorting:after,
        table.dataTable thead .sorting:before,
        table.dataTable thead .sorting_asc:after,
        table.dataTable thead .sorting_asc:before,
        table.dataTable thead .sorting_asc_disabled:after,
        table.dataTable thead .sorting_asc_disabled:before,
        table.dataTable thead .sorting_desc:after,
        table.dataTable thead .sorting_desc:before,
        table.dataTable thead .sorting_desc_disabled:after,
        table.dataTable thead .sorting_desc_disabled:before {
            bottom: .5em;
        }

    </style>

    <div class="row">
        <div class="col-md-12">
            <div class="bg-white rounded shadow-sm p-4 py-4 d-flex flex-column">
                <div class="row form-group align-items-baseline">
                    <div class="table-responsive">
                        <table class="table table-bordered dtHorizontalVertical" id="">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 25rem;" class="text-dark fw-bold text-center">ลำดับ</th>
                                    <th scope="col" class="text-dark fw-bold text-center" style="width: 152rem;">ชื่อตำแหน่งใน กอ.รมน./<br>ชื่อตำแหน่งในการบริหาร</th>
                                    <th scope="col" class="text-dark fw-bold text-center">ประเภทกำลังพล</th>
                                    <th scope="col" class="text-dark fw-bold text-center">ชั้นยศ</th>
                                    <th scope="col" class="text-dark fw-bold text-center" style="width: 30rem;">ตำแหน่ง<br>เลขที่</th>
                                    <th scope="col" class="text-dark fw-bold " style="width: 16rem;">ยศ</th>
                                    <th scope="col" class="text-dark fw-bold text-center" style="width: 60rem;">ชื่อ-สกุล</th>
                                    <th scope="col" class="text-dark fw-bold text-center">ตำแหน่งและสังกัดปกติ</th>
                                    <th scope="col" class="text-dark fw-bold text-center">คำสั่งปฏิบัติ</th>
                                    <th scope="col" class="text-dark fw-bold text-center">วันที่ปฏิบัติ</th>
                                    <th scope="col" class="text-dark fw-bold text-center">วันที่สิ้นสุด</th>
                                    <th scope="col" class="text-dark fw-bold text-center">คำสั่งพ้น</th>
                                    <th scope="col" class="text-dark fw-bold text-center">วันที่พ้น</th>
                                    <th scope="col" class="text-dark fw-bold text-center" style="width: -10rem;">เครื่องมือ</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                echo $table_content;
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?= $this->include('palaceByAs/view') ?>

<?= $this->include('palaceByAs/requestAlert') ?>
<?= $this->include('palaceByAs/requestDirective') ?>

<?= $this->include('palaceByAs/requestRetire') ?>    


<!-- Sweet Alerts js -->
<script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
<script src="assets/libs/jquery/jquery.min.js"></script>


<!-- plugin css -->
<link href="assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
<link rel="stylesheet" href="assets/libs/@chenfengyuan/datepicker/datepicker.min.css">

<!-- datepicker css -->
<link rel="stylesheet" href="assets/libs/flatpickr/flatpickr.min.css">

<script src="assets/libs/jquery/jquery.min.js"></script>
<!-- plugins -->
<script src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="assets/libs/@chenfengyuan/datepicker/datepicker.min.js"></script>

<script>
function checkSearch(positionMapID,typeForce){
    $("#searchModal").find('.modal-body #positionMapID').val(positionMapID);
    $("#searchModal").find('.modal-body #typeForce').val(typeForce);
}

function checkRequest(org_id){
    var chk_arr =  $("input:checkbox[name=checkBoxReq]:checked");
    var chklength = chk_arr.filter(':checked').length;

    var chkRetire_arr =  $("input:checkbox[name=checkBoxRetire]:checked");
    var chkRetireLength = chkRetire_arr.filter(':checked').length;

    if(chklength > 0 && chkRetireLength >0){
        $("#text_alert").html("กรุณาเลือกรายการใหม่ เนื่องไม่สามารถเลือกคำสั่งที่ต่างกันได้");
        $('#requestAlertModal').modal("show");
    }else{
        
        if(chklength > 0){
            $("#requestDirectiveModal").find('.modal-body #rOrgId').val(org_id);

            var ReqD = [];
            $("input:checkbox[name=checkBoxReq]:checked").each(function(){
                ReqD.push($(this).val());
            });

            $.ajax({
                url:  "PalaceByAssist/dataPersonalForces",
                method: "post",
                data: {ReqD: ReqD,org_id:org_id},
                dataType: "text",
                success: function (data) {
                    
                    if(data == 'error'){
                        $("#text_alert").html("กรุณาเลือกรายการใหม่ เนื่องจากรายการที่เลือกไม่ตรงหน่วยงาน");
                        $('#requestAlertModal').modal("show");
                    }else{
                        $("#directiveBegin").val('');
                        $("#hID").val('');
                        $("#orderTypeID").val('');

                        $("#loadPData").html(data);
                        $('#requestDirectiveModal').modal("show");
                    }
                }
            });
        }else{
            $.ajax({
                url:  "PalaceByAssist/chkRequestDirective",
                method: "post",
                data: {org_id: org_id},
                dataType: "text",
                success: function (data) {
                    if(data == 'success'){
                        $('#requestDirectiveModal').modal("show");

                        $.ajax({
                            url:  "PalaceByAssist/dataForcesReq",
                            method: "post",
                            data: {org_id: org_id},
                            // dataType: "text",
                            success: function (msg) {
                                var obj = JSON.parse(msg);
                                
                                $("#directiveBegin").val(obj.directiveBegin);
                                $("#hID").val(obj.hID);
                                $("#orderTypeID").val(obj.orderTypeID);
                                $("#requestDirectiveModal").find('.modal-body #rOrgId').val(obj.org_id);

                                $("#loadPData").html(obj.html);

                                $('#requestDirectiveModal .controlData').append(`${obj.input}`);
                            }
                        });
                    }else{
                        $("#text_alert").html("กรุณาเลือกรายการร้องขออกคำสั่ง");
                        $('#requestAlertModal').modal("show");
                    }
                }
            });
        }
    }
}

function checkRetire(org_id){
    var chk_arr =  $("input:checkbox[name=checkBoxReq]:checked");
    var chklength = chk_arr.filter(':checked').length;

    var chkRetire_arr =  $("input:checkbox[name=checkBoxRetire]:checked");
    var chkRetireLength = chkRetire_arr.filter(':checked').length;

    if(chklength > 0 && chkRetireLength >0){
        $("#text_alert").html("กรุณาเลือกรายการใหม่ เนื่องไม่สามารถเลือกคำสั่งที่ต่างกันได้");
        $('#requestAlertModal').modal("show");
    }else{  
        if(chkRetireLength > 0){
            $("#requestRetireModal").find('.modal-body #rOrgId').val(org_id);

            var ReqD = [];
            $("input:checkbox[name=checkBoxRetire]:checked").each(function(){
                ReqD.push($(this).val());
            });

            $.ajax({
                url:  "PalaceByAssist/dataPersonalRetire",
                method: "post",
                data: {ReqD: ReqD,org_id:org_id},
                dataType: "text",
                success: function (data) {
                    
                    if(data == 'error'){
                        $("#text_alert").html("กรุณาเลือกรายการใหม่ เนื่องจากรายการที่เลือกไม่ตรงหน่วยงาน");
                        $('#requestAlertModal').modal("show");
                    }else{
                        $("#directiveBegin").val('');
                        $("#hID").val('');
                        $("#orderTypeID").val('');

                        $("#loadRetireData").html(data);
                        $('#requestRetireModal').modal("show");
                    }
                }
            });
        }else{
            $.ajax({
                url:  "PalaceByAssist/chkRequestRetire",
                method: "post",
                data: {org_id: org_id},
                dataType: "text",
                success: function (data) {
                    if(data == 'success'){
                        $('#requestRetireModal').modal("show");

                        $.ajax({
                            url:  "PalaceByAssist/dataForcesReqRetire",
                            method: "post",
                            data: {org_id: org_id},
                            // dataType: "text",
                            success: function (msg) {
                                var obj = JSON.parse(msg);
                                
                                $("#directiveRetire").val(obj.directiveRetire);
                                $("#hIDRetire").val(obj.hIDRetire);
                                $("#requestRetireModal").find('.modal-body #orderTypeID').val(obj.orderTypeID);
                                $("#requestRetireModal").find('.modal-body #rOrgId').val(obj.org_id);

                                $("#loadRetireData").html(obj.html);

                                $('#requestRetireModal .controlData').append(`${obj.input}`);
                            }
                        });
                    }else{
                        $("#text_alert").html("กรุณาเลือกรายการร้องขออกคำสั่งพ้น");
                        $('#requestAlertModal').modal("show");
                    }
                }
            });
        }   
    }
}

flatpickr('.datepicker-basic', {
    defaultDate: new Date()
});

$( document ).ready(function() {
    $("#requestDirectiveModal").on('hide.bs.modal', function(){
        $("input[name='checkBoxReq']:checkbox").prop('checked',false);
        $("input[name='checkBoxRetire']:checkbox").prop('checked',false);
    });

    $("#requestRetireModal").on('hide.bs.modal', function(){
        $("input[name='checkBoxReq']:checkbox").prop('checked',false);
        $("input[name='checkBoxRetire']:checkbox").prop('checked',false);
    });

    $("#requestAlertModal").on('hide.bs.modal', function(){
        $("input[name='checkBoxReq']:checkbox").prop('checked',false);
        $("input[name='checkBoxRetire']:checkbox").prop('checked',false);
    });
});

</script>
<?= $this->endSection() ?>
