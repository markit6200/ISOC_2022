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
                                                                <button class="btn btn-danger">&nbsp;
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
                
                $("#directiveBegin").val(obj.directiveBegin);
                $("#hID").val(obj.hID);
                $("#orderTypeID").val(obj.orderTypeID);
                $("#requestDirectiveModal").find('.modal-body #rOrgId').val(obj.org_id);

                $("#loadPData").html(obj.html);

                $('#requestDirectiveModal .controlData').append(`${obj.input}`);
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
    
</script>

<?= $this->endSection() ?>