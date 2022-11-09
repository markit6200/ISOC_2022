<?= $this->extend('theme/admin') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body d-inline">
                <span class="h2"><?php echo $title; ?></span>
            </div>
            <div class="card-body d-inline">
                <div class="">
                    <form>
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" title="คำค้น ประเภทคำสั่ง,หน่วยงาน,เลขที่คำสั่ง "  placeholder="ป้อนคำที่ต้องการค้นหา" value="<?php echo isset($_GET['search'])?$_GET['search']:'' ?>">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-success">ค้นหา</button>
                            </div>
                        </div>
                    </form>
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
                    <div class="row form-group align-items-baseline">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" class="text-dark fw-bold text-center col-1">ลำดับ</th>
                                        <th scope="col" class="text-dark fw-bold text-center col-2">ประเภทคำสั่ง</th>
                                        <th scope="col" class="text-dark fw-bold text-center col-2">หน่วยงาน</th>
                                        <th scope="col" class="text-dark fw-bold text-center col-2">เลขที่คำสั่ง</th>
                                        <th scope="col" class="text-dark fw-bold text-center col-2">จำนวนบัญชีแนบ</th>
                                        <th scope="col" class="text-dark fw-bold text-center col-2">เครื่องมือ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if (isset($headData)){
                                            $i=1+(($currentPage-1) * $perPage);
                                            foreach ($headData as $key => $value){
                                                $orderTypeText = isset($orderType[$value['orderTypeID']])?$orderType[$value['orderTypeID']]:'';
                                                $org_name = $value['org_name'];
                                    ?>
                                                <tr>
                                                    <td class="text-center" style="width:6rem;"><?php echo $i++; ?></td>
                                                    <td class="text-left"><?php echo $orderTypeText; ?></td>
                                                    <td class="text-left"><?php echo $org_name; ?></td>
                                                    <td class="text-center"><?php echo $value['directiveNo']; ?></td>
                                                    <td class="text-center"><?php echo (@$value['c_num'] !='')?@number_format(@$value['c_num'], 0, '.', ''):''; ?></td>
                                                    <td class="text-center">
                                                        <div class="col-auto pe-md-0 ">
                                                            <div class="form-group mb-0">
                                                                <?php
                                                                if($value['directiveType'] == '1'){
                                                                ?>
                                                                    <button class="btn btn-warning text-dark" onclick="checkRequest('<?php echo $value['orgID'];?>','<?php echo $value['id'];?>')">&nbsp;
                                                                        <i class="mdi mdi-pencil"></i>&nbsp;แก้ไข
                                                                    </button>
                                                                <?php
                                                                }else if($value['directiveType'] == '2'){
                                                                ?>
                                                                    <button class="btn btn-warning text-dark" onclick="checkRetire('<?php echo $value['orgID'];?>','<?php echo $value['id'];?>')">&nbsp;
                                                                        <i class="mdi mdi-pencil"></i>&nbsp;แก้ไข
                                                                    </button>
                                                                <?php
                                                                } 
                                                                ?>

                                                                <?php
                                                                $chk_disabled = ($value['statusDirective'] == '0')?"":"disabled";
                                                                ?>
                                                                <button class="btn btn-danger" <?php echo $chk_disabled;?> onclick="delByhID('<?php echo $value['hID'];?>')">&nbsp;
                                                                    <i class="mdi mdi-close-circle-outline"></i>&nbsp;ลบ
                                                                </button>

                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                     <?php 
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col-4">
                        <div class="pagination justify-content-start" role="group" aria-label="pager counts">
                            <span class=""><?= 'หน้าที่ '.$currentPage.' จาก '.$totalPages; ?></span>
                        </div>
                    </div>
                    <div class="col-8">
                        <?php echo $pager->links('bootstrap', 'bootstrap_pagination') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('personalManagement/modal') ?>
<?= $this->endSection() ?>
<?= $this->section('cssTopContent')?>
<link href="<?php echo base_url() ?>/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
<?= $this->endSection() ?>
<?= $this->section('jsContent')?>
<script src="<?php echo base_url() ?>/assets/libs/sweetalert2/sweetalert2.min.js"></script>

<?= $this->include('palaceByAs/requestDirective') ?>
<?= $this->include('palaceByAs/requestRetire') ?>   

<script>
    function checkRequest(org_id,hID){
       
        $('#requestDirectiveModal').modal("show");

        $.ajax({
            url:  "reportPalaceByAssist/dataForcesReq",
            method: "post",
            data: {org_id: org_id,hID:hID},
            // dataType: "text",
            success: function (msg) {
                var obj = JSON.parse(msg);
                console.log(obj);
                
                $("#textOrgName").html(obj.textOrgName);
                $("#directiveBegin").val(obj.directiveBegin);
                $("#hID").val(obj.hID);
                $("#orderTypeID").val(obj.orderTypeID);
                $("#requestDirectiveModal").find('.modal-body #rOrgId').val(obj.org_id);
                
                $("#loadPData").html(obj.html);

                $('#requestDirectiveModal .controlData').append(`${obj.input}`);

                //ซ่อนปุ่มเมื่อ 1 ส่งแล้ว,2=ออกคำสั้งเสร็จแล้ว
                if(obj.statusDirective == 1 || obj.statusDirective == 2){
                    $(".bt_save").hide();
                    $(".bt_send").hide();
                    $("#requestDirectiveModal .bt_del").hide();
                }else{
                    $(".bt_save").show();
                    $(".bt_send").show(); //การแสดงปุ่มส่ง
                    $(".bt_del").show();
                }

                $("#showSend").val(1);
            }
        });
    }

    function checkRetire(org_id,hID){
        
        $('#requestRetireModal').modal("show");

        $.ajax({
            url:  "reportPalaceByAssist/dataForcesReqRetire",
            method: "post",
            data: {org_id: org_id,hID:hID},
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
    }

    function delByhID(hID){
        Swal.fire({
            title: "ท่านต้องการลบข้อมูลใช่หรือไม่?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#f46a6a",
            cancelButtonText: "ยกเลิก",
            confirmButtonText: "ลบข้อมูล",
            reverseButtons: true
            }).then(function (result) {
            if (result.value) {
                //update status
                $.ajax({
                    url:  "reportPalaceByAssist/saveDelByhID",
                    method: "post",
                    data: {hID:hID},
                    dataType: "text",
                    success: function (data) {
                        if(data == 'success'){
                            Swal.fire({
                                icon: 'success',
                                title: 'ลบข้อมูลเรียบร้อย',
                                showConfirmButton: false,
                                timer: 1000
                            }).then(function() {
                                window.location = "reportPalaceByAssist";
                            });
                        }else{
                            Swal.fire({
                                title: 'ไม่สามารถลบข้อมูลได้',
                                text: '',
                                icon: 'error'
                            })
                        }
                    }
                });
            }
        });
    }
    
</script>

<?= $this->endSection() ?>