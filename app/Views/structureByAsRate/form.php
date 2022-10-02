<?= $this->extend('theme/admin') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body d-inline">

                <span class="h2"><?php echo $title; ?></span>
                <div class="float-end">
                    <a href="<?php echo base_url('StructureByAssistRate') ?>" class="btn btn-default"><i class="fas fa-chevron-left"></i> ย้อนกลับ</a>
                    <button class="btn btn-default"><i class="fas fa-save"></i> บันทึก</button>
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
                    <form>
                        <div class="mb-3 row">
                            <label for="" class="col-12 col-md-3 form-label">ชื่อตำแหน่งใน กอ.รมน./ชื่อตำแหน่งในการบริหาร</label>
                            <div class="col-12 col-md-6">
                                <select class="form-control">
                                    <option>---- ----</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-12 col-md-3 form-label">ตำแหน่งประเภท</label>
                            <div class="col-12 col-md-6">
                                <select class="form-control">
                                    <option>---- ----</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-12 col-md-3 form-label">ชื่อตำแหน่งในสายงานพลเรือน</label>
                            <div class="col-12 col-md-6">
                                <select class="form-control">
                                    <option>---- ----</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-12 col-md-3 form-label">ระดับพลเรือนหรือเทียบเท่า</label>
                            <div class="col-12 col-md-6">
                                <select class="form-control">
                                    <option>---- ----</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-12 col-md-3 form-label">ชั้นยศ</label>
                            <div class="col-12 col-md-6">
                                <select class="form-control">
                                    <option>---- ----</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-12 col-md-3 form-label">ตำแหน่งเลขที่</label>
                            <div class="col-12 col-md-6">
                                <input type="text" class="form-control"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>