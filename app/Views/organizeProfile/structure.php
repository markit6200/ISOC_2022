<?= $this->extend('theme/admin') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body d-inline">
                <span class="h2"><?php echo $title; ?></span>
                <div class="float-end">
                <a href="<?php echo base_url('OrganizeProfile') ?>" class="btn btn-default"><i class="fas fa-chevron-left"></i> ย้อนกลับ</a>
                    <a href="<?php echo base_url('OrganizeProfile/form') ?>" class="btn btn-outline-light mb-2"><i class="mdi mdi-plus-circle-outline"></i> เพิ่มหน่วยงาน</a>
                    <!-- <a href="<?php //echo base_url('OrganizeProfile/form') ?>" class="btn btn-outline-light"><i class="mdi mdi-plus-circle-outline"></i> </a> -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <h1>AJAX demo</h1>
                <div id="ajax" class="demo"></div>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card">
            <div class="card-body"></div>
        </div>
    </div>
</div> -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <?= view('partials/flash_message') ?>
                <div class="col-md-12">
                    <div class="row form-group align-items-baseline">
                        <div class="table-responsive">
<!--                            <div class="float-end">-->
<!--                                <a href="--><?php //echo base_url('OrganizeProfile/form') ?><!--" class="btn btn-outline-light mb-2"><i class="mdi mdi-plus-circle-outline"></i> เพิ่มหน่วยงาน</a>-->
<!--                            </div>-->
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" class="text-dark fw-bold text-center" style="width:15rem;">ชื่อหน่วยงาน</th>
                                        <th scope="col" class="text-dark fw-bold text-center" style="width: 14rem;">เครื่องมือ</th>
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
    </div>
</div>
<?= $this->include('organizeProfile/modal') ?>
<?= $this->endSection() ?>
<?= $this->section('cssTopContent')?>
<link href="<?php echo base_url() ?>/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url() ?>/assets/libs/jstree/themes/default/style.min.css" rel="stylesheet" type="text/css"/>
<?= $this->endSection() ?>
<?= $this->section('jsContent')?>
<script src="<?php echo base_url() ?>/assets/libs/sweetalert2/sweetalert2.min.js"></script>
<script src="<?php echo base_url() ?>/assets/libs/jstree/jstree.min.js"></script>
<script>
    function confirmDelete(id){
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
                location.href = '<?php echo base_url("OrganizeProfile/delete"); ?>/'+id;
            }
        });
    }

    function showModal(id){
        // var textConfirm = 'ท่านต้องการจำหน่ายข้อมูล'+name+' ตำแหน่งและสังกัดปกติ '+position+' หรือไม่?';
        // $("#myModal").find('.modal-body #fid').val(id);
        // $("#myModal").find('.modal-body #textConfirm').html(textConfirm);
    }
    
    // $(document).ready(function(){
    //     // ajax demo
    //     $('#ajax').jstree({
    //         'core' : {
    //             'data' : {
    //                 'url' : function (node) {
    //                     return node.id === '#' ?
    //                     '<?php //echo base_url("OrganizeProfile/ajax_org_list"); ?>' : '<?php //echo base_url("OrganizeProfile/ajax_org_list_child"); ?>';
    //                 },
    //                 'data' : function (node) {
    //                     return { 'id' : node.id };
    //                 },
    //                 "dataType" : "json" // needed only if you do not supply JSON headers
    //             },
    //         }
    //     });
    //     $('#ajax').on("select_node.jstree", function (e, data) { 
    //         alert("node_id: " + data.node.id); 
    //     });
    // })
</script>

<?= $this->endSection() ?>
