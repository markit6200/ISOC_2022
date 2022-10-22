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
                            <a href="<?php echo base_url('PersonalManagementPRMN/form') ?>" class="btn btn-outline-light"><i class="mdi mdi-plus-circle-outline"></i> เพิ่มข้อมูล</a>
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
                                            $i=1+(($currentPage-1) * $perPage);
                                            foreach ($personalData as $key => $value): 
                                                $preName = isset($prefix[$value['codePrefix']])?$prefix[$value['codePrefix']]:'';
                                                $fname = $value['firstName'];
                                                $lname = $value['lastName'];
                                                $fullname = $preName.$fname.' '.$lname;
                                                $positionCiviliain = isset($positionCivilianList[$value['positionCivilianID']])?$positionCivilianList[$value['positionCivilianID']]:'';
                                                $positionCiviliain .= isset($positionCivilianGroupList[$value['positionCivilianGroupID']])?" ".$positionCivilianGroupList[$value['positionCivilianGroupID']]:'';
                                                if ($value['statusPackingRate'] == 2) {
                                                    $position = '<span class="btn btn-outline-danger btn-rounded btn-sm">พ้นหน้าที่เมื่อ '.dayThai($value['dateOffPackingRate']).'</span>';
                                                } else if ($value['statusPackingRate'] == 3) {
                                                    $position = isset($positionList[$value['positionID']])?$positionList[$value['positionID']]:'';
                                                    $position .= isset($positionGroupList[$value['positionGroupID']])?" ".$positionGroupList[$value['positionGroupID']]:'';;
                                                } else {
                                                    $position = '<span class="btn btn-outline-success btn-rounded btn-sm">รอบรรจุ</span>';
                                                }
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
                                                                <a href="<?php echo base_url('PersonalManagementPRMN/form/'.$value['fid']) ?>" class="btn  btn-warning  text-dark">
                                                                    <i class="mdi mdi-pencil"></i>&nbsp;แก้ไข
                                                                </a>
                                                                <button data-bs-toggle="modal" data-bs-target="#myModal" onclick="showModal('<?php echo $value['fid'] ?>','<?php echo $fullname ?>','<?php echo $positionCiviliain ?> ')" class="btn  btn-danger">&nbsp;
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
<script>
    function showModal(id,name,position){
        var textConfirm = 'ท่านต้องการจำหน่ายข้อมูล'+name+' ตำแหน่งและสังกัดปกติ '+position+' หรือไม่?';
        $("#myModal").find('.modal-body #fid').val(id);
        $("#myModal").find('.modal-body #textConfirm').html(textConfirm);
    }

    function removePersonal(){
        var id = $("#myModal").find('.modal-body #fid').val();
        location.href = '<?php echo base_url("PersonalManagementPRMN/delete"); ?>/'+id;
    }
</script>

<?= $this->endSection() ?>