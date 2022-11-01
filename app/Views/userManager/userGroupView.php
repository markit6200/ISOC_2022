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
            <div class="card-body d-inline">
                <span class="h4">กลุ่มผู้ใช้งานระบบ</span>
                <div class="float-end">
                    <form>
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" title="คำค้น เลขประจำตัวประชาชนมชื่อ-สกุล,ตำแหน่ง"  placeholder="ป้อนคำที่ต้องการค้นหา" value="<?php echo isset($_GET['search'])?$_GET['search']:'' ?>">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-success">ค้นหา</button>
                            </div>
                            &nbsp;&nbsp;&nbsp;
                            <a href="<?php echo base_url('userManager/index') ?>" class="btn btn-default"><i class="fas fa-chevron-left"></i> ย้อนกลับ</a>
                            <a href="<?php echo base_url('UserManager/userGroupForm') ?>" class="btn btn-outline-light"><i class="mdi mdi-plus-circle-outline"></i> เพิ่มข้อมูล</a>
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
                            <table class="table table-bordered datatable">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" class="text-dark fw-bold text-center col-1">ลำดับ</th>
                                        <th scope="col" class="text-dark fw-bold text-center col-8">กลุ่มผู้ใช้งาน</th>
                                        <th scope="col" class="text-dark fw-bold text-center col-3">เครื่องมือ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if(isset($user_group) && !empty($user_group)):
                                    $no = 0;
                                    foreach ($user_group as $key => $user_group):
                                        $no++;
                                        ?>
                                        <tr>
                                            <td class="text-center"><?php echo $no ?></td>
                                            <td class="text-left"><?php echo $user_group['NLABEL']?></td>
                                            <td class="text-center">
                                                <div class="form-group mb-0">
                                                    <a href="<?php echo base_url('userManager/userGroupForm/'.$user_group['NID']) ?>" class="btn  btn-warning  text-dark">
                                                        <i class="mdi mdi-pencil"></i>&nbsp;แก้ไข
                                                    </a>
                                                    <button data-bs-toggle="modal" data-bs-target="#myModal" class="btn  btn-danger">&nbsp;
                                                        <i class="mdi mdi-close-circle-outline"></i>&nbsp;ลบ
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                    endforeach;
                                endif;
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
                            <!-- <span class=""><?php //'หน้าที่ '.$currentPage.' จาก '.$totalPages; ?></span> -->
                        </div>
                    </div>
                    <div class="col-8">
                        <?php //echo $pager->links('bootstrap', 'bootstrap_pagination') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('cssTopContent') ?>
    <link href="<?php echo base_url() ?>/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')?>" rel="stylesheet" type="text/css" />
<?= $this->endSection() ?>
<?= $this->section('jsContent') ?>
    <script src="<?php echo base_url() ?>/assets/libs/parsleyjs/parsley.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/js/pages/form-validation.init.js"></script>
    <script src="<?php echo base_url('assets/libs/datatables.net/js/jquery.dataTables.min.js')?>"></script>
    <script src="<?php echo base_url('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
    <script src="<?php echo base_url() ?>/assets/libs/select2/js/select2.min.js"></script>
    <script>
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
