<?= $this->extend('theme/admin') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <span class="h2"><?php echo $title; ?></span>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="row form-group align-items-baseline">
                                        Organize Tree
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="row form-group align-items-baseline">
                                        <?php echo view('userManager/userGroupView') ?>
                                    </div>
                                    <div class="row form-group align-items-baseline">
                                        <?php echo view('userManager/userGroupForm') ?>
                                    </div>
                                    <div class="row form-group align-items-baseline">
                                        <?php echo view('userManager/userGroupInfo') ?>
                                    </div>
                                    <div class="row form-group align-items-baseline">
                                        <?php echo view('userManager/view') ?>
                                    </div>
                                    <div class="row form-group align-items-baseline">
                                        <?php echo view('userManager/form') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('cssTopContent')?>
<link href="<?php echo base_url() ?>/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
<!-- DataTables -->
<link href="<?php echo base_url('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')?>" rel="stylesheet" type="text/css" />
<!-- End DataTables -->
<?= $this->endSection() ?>
<?= $this->section('jsContent')?>
<script src="<?php echo base_url() ?>/assets/libs/sweetalert2/sweetalert2.min.js"></script>
<!-- Data table -->
<script src="<?php echo base_url('assets/libs/datatables.net/js/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<!-- End Data table -->
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
                location.href = '<?php echo base_url("StructureByAssistRate/delete"); ?>/'+id;
            }
        });
    }
    $(document).ready(function() {
        $('.datatable').DataTable({
            "searching": false,
            "lengthChange": false,
            language: {
                info: "หน้าที่ _PAGE_ จาก _PAGES_",
                paginate: {
                    first:    '«',
                    previous: '‹',
                    next:     '›',
                    last:     '»'
                },
                aria: {
                    paginate: {
                        first:    'First',
                        previous: 'Previous',
                        next:     'Next',
                        last:     'Last'
                    }
                }
            }

        });
    } );
</script>

<?= $this->endSection() ?>
