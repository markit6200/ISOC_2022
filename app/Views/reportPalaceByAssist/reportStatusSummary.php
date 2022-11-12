<?= $this->extend('theme/admin') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body d-inline">
                <span class="h2"><?php echo $title; ?></span>
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
                                        <th scope="col" class="text-dark fw-bold text-center col-2">หน่วย</th>
                                        <th scope="col" class="text-dark fw-bold text-center col-2">อัตราบรรจุ</th>
                                        <th scope="col" class="text-dark fw-bold text-center col-2">บรรจุจริง</th>
                                        <th scope="col" class="text-dark fw-bold text-center col-2">อัตราว่าง</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if (isset($positionData)){
                                            $i=1+(($currentPage-1) * $perPage);
                                            foreach ($positionData as $key => $value){
                                    ?>
                                                <tr>
                                                    <td class="text-center" style="width:6rem;"><?php echo $i++; ?></td>
                                                    <td class="text-left"><?php echo $value['org_full_name']; ?></td>
                                                    <td class="text-center"><?php echo (@$value['c_num_all'] !='')?@number_format(@$value['c_num_all'], 0, '.', ''):'0'; ?></td>
                                                    <td class="text-center"><?php echo (@$value['c_num_palace'] !='')?@number_format(@$value['c_num_palace'], 0, '.', ''):'0'; ?></td>
                                                    <td class="text-center"><?php echo (@$value['c_num_free'] !='')?@number_format(@$value['c_num_free'], 0, '.', ''):'0'; ?></td>
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

<?= $this->endSection() ?>