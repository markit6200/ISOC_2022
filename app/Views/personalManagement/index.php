<?= $this->extend('theme/admin') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body d-inline">
                <span class="h2"><?php echo $title; ?></span>
                <div class="float-end">
                    <form>
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" title="คำค้น เลขประจำตัวประชาชนมชื่อ-สกุล,ตำแหน่ง"  placeholder="ป้อนคำที่ต้องการค้นหา" value="<?php echo isset($_GET['search'])?$_GET['search']:'' ?>">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-success">ค้นหา</button>
                            </div>
                            &nbsp;&nbsp;&nbsp;
                            <a href="<?php echo base_url('PersonalManagement/form') ?>" class="btn btn-outline-light"><i class="mdi mdi-plus-circle-outline"></i> เพิ่มข้อมูล</a>
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
                                        <th scope="col" class="text-dark fw-bold text-center col-2">เลชประจำตัวประชาชน</th>
                                        <th scope="col" class="text-dark fw-bold text-center col-2">ยศ-ชื่อ-สกุล</th>
                                        <th scope="col" class="text-dark fw-bold text-center col-2">ตำแหน่งและสังกัด<br/>ในสายงานปกติ</th>
                                        <th scope="col" class="text-dark fw-bold text-center col-3">ตำแหน่งและสังกัด<br/>ในสายงาน กอ.รมน.</th>
                                        <th scope="col" class="text-dark fw-bold text-center col-2">เครื่องมือ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if (isset($personalData)):
                                            $i=1;
                                            foreach ($personalData as $key => $value): 
                                                $rank = '';
                                                $fname = $value['firstName'];
                                                $lname = $value['lastName'];
                                                $fullname = $rank.$fname.' '.$lname;
                                                $positionCiviliain = '';
                                                $position = $value['isocPosition'];
                                    ?>
                                                <tr>
                                                    <td class="text-center" style="width:6rem;"><?php echo $i++; ?></td>
                                                    <td class="text-center"><?php echo isset($value['cardID'])?$value['cardID']:'' ?></td>
                                                    <td class="text-left"><?php echo $fullname ?></td>
                                                    <td class="text-center"><?php echo $positionCiviliain ?></td>
                                                    <td class="text-center"><?php echo $position; ?></td>
                                                    <td class="text-center">
                                                        <div class="col-auto pe-md-0 ">
                                                            <div class="form-group mb-0">
                                                                <button class="btn  btn-warning">
                                                                    <i class="mdi mdi-pencil"></i>&nbsp;แก้ไข
                                                                </button>
                                                                <button data-bs-toggle="modal" data-bs-target="#myModal" class="btn  btn-danger">&nbsp;
                                                                    <i class="mdi mdi-close-circle-outline"></i>&nbsp;พ้น
                                                                </button>
                                                            </div>
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
                    <div class="col-8">
                        <?php echo $pager->links('bootstrap', 'bootstrap_pagination') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- sample modal content -->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">จำหน่ายข้อมูล</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <p>ท่านต้องการจำหน่ายข้อมูล ตำแหน่งงและสังกัด หรือไม่?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">ปิด</button>
                <button type="button" class="btn btn-danger waves-effect waves-light">ลบ</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?= $this->endSection() ?>
<?= $this->section('jsContent')?>
<script src="<?php echo base_url() ?>/assets/libs/sweetalert2/sweetalert2.min.js"></script>
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
</script>

<?= $this->endSection() ?>