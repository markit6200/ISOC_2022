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
                            <input type="text" class="form-control" title="คำค้น เลขประจำตัวประชาชนมชื่อ-สกุล,ตำแหน่ง"  placeholder="ป้อนคำที่ต้องการค้นหา" >
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-success">ค้นหา</button>
                            </div>
                            &nbsp;&nbsp;&nbsp;
                            <a href="<?php echo base_url('StructureByAssistRate') ?>" class="btn btn-outline-light"><i class="mdi mdi-plus-circle-outline"></i> เพิ่มข้อมูล</a>
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
                                        <th scope="col" class="text-dark fw-bold text-center" style="width:6rem;">ลำดับ</th>
                                        <th scope="col" class="text-dark fw-bold text-center" style="width:15rem;">
                                            ชื่อตำแหน่งใน กอ.รมน./<br>ชื่อตำแหน่งในการบริหาร</th>
                                        <th scope="col" class="text-dark fw-bold text-center" style="width:9rem;">
                                            ตำแหน่งประเภท</th>
                                        <th scope="col" class="text-dark fw-bold text-center" style="width:11rem;">
                                            ชื่อตำแหน่งใน<br>สายงานพลเรือน</th>
                                        <th scope="col" class="text-dark fw-bold text-center" style="width:7rem;">
                                            ระดับพลเรือนหรือเทียบเท่า</th>
                                        <th scope="col" class="text-dark fw-bold text-center" style="width:6rem;">ชั้นยศ</th>
                                        <th scope="col" class="text-dark fw-bold text-center" style="width: 5rem;">
                                            ตำแหน่ง<br>เลขที่</th>
                                        <th scope="col" class="text-dark fw-bold text-center" style="width: 14rem;">
                                            เครื่องมือ</th>

                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                        <td class="text-center" style="width:6rem;">1</td>
                                        <td scope="row"> ผู้อำนวยการสำนัก</td>
                                        <td>บริหาร</td>
                                        <td><button class="btn btn-primary btn-rounded">-- --</button></td>
                                        <td>สูง</td>
                                        <td>
                                            <div class="dhx_demo-active">พ.อ.(พ.)</div>
                                        </td>

                                        <td></td>
                                        <td style="width: 13rem;text-align:center;">

                                            <div class="col-auto pe-md-0 ">
                                                <div class="form-group mb-0">


                                                    <button class="btn  btn-warning">


                                                        <i class="mdi mdi-pencil"></i>&nbsp;แก้ไข
                                                    </button>
                                                    <button data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="btn  btn-danger">&nbsp;


                                                        <i class="mdi mdi-close-circle-outline"></i>&nbsp;ลบ
                                                    </button>

                                                </div>



                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>