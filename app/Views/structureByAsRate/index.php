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
                                        <td colspan="9" style="padding-bottom: 0;padding-left:0 !important;padding-right: 0 !important;">
                                            <div class="w3-code notranslate htmlHigh ms-0 bar-1">
                                                กอ.รมน.ภาค 4 สน.
                                                <div class="form-group mb-0">
                                                    <a style="    float: right;
                                            margin-top: -22px;
                                            margin-right: -7px;" href="<?php echo base_url('structure-assistant-rate/form') ?>" data-controller="button" data-turbo="true" class="btn  btn-default" type="submit" form="post-form" formaction="https://demo.orchid.software/example-fields/buttonClickProcessing">


                                                        <i class="mdi mdi-plus-circle-outline"></i>&nbsp;เพิ่มตำแหน่ง
                                                    </a>

                                                </div>
                                            </div>

                                            <div class="w3-code notranslate htmlHigh bar-2">
                                                &nbsp;&nbsp;สำนักบริหารงานบุคคล
                                                <div class="form-group mb-0">


                                                    <a style="    float: right;
                                            margin-top: -22px;
                                            margin-right: -7px;" href="<?php echo base_url('structure-assistant-rate/form') ?>" data-controller="button" data-turbo="true" class="btn  btn-default" type="submit" form="post-form" formaction="https://demo.orchid.software/example-fields/buttonClickProcessing">


                                                        <i class="mdi mdi-plus-circle-outline"></i>&nbsp;เพิ่มตำแหน่ง
                                                    </a>

                                                </div>
                                            </div>


                                            <div onclick="test()" class="w3-code notranslate htmlHigh bar-3">
                                                <x-orchid-icon path="fa.arrow-down" class="float-left" />&nbsp; ส่วนบังคับบัญชา
                                                <div class="form-group mb-0">


                                                    <a style="    float: right;
                                            margin-top: -22px;
                                            margin-right: -7px;" href="<?php echo base_url('structure-assistant-rate/form') ?>" data-controller="button" data-turbo="true" class="btn  btn-default" type="submit" form="post-form" formaction="https://demo.orchid.software/example-fields/buttonClickProcessing">


                                                        <i class="mdi mdi-plus-circle-outline"></i>&nbsp;เพิ่มตำแหน่ง
                                                    </a>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
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
                                    <tr>
                                        <td class="text-center" style="width:6rem;">2</td>
                                        <td scope="row"> รองผู้อำนวยการสำนัก</td>
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


                                                    <button data-controller="button" data-turbo="true" class="btn  btn-warning" type="submit" form="post-form" formaction="https://demo.orchid.software/example-fields/buttonClickProcessing">


                                                        <i class="mdi mdi-pencil"></i>&nbsp;แก้ไข
                                                    </button>
                                                    <button data-controller="button" data-turbo="true" class="btn  btn-danger" type="submit" form="post-form" formaction="https://demo.orchid.software/example-fields/buttonClickProcessing">&nbsp;


                                                        <i class="mdi mdi-close-circle-outline"></i>&nbsp;ลบ
                                                    </button>

                                                </div>



                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center" style="width:6rem;">3</td>
                                        <td scope="row"> นายทหารประจำ</td>
                                        <td></td>
                                        <td><button class="btn btn-primary btn-rounded">-- --</button></td>
                                        <td></td>
                                        <td>
                                            <div class="dhx_demo-active">พ.อ.(พ.)</div>
                                        </td>

                                        <td></td>
                                        <td style="width: 13rem;text-align:center;">

                                            <div class="col-auto pe-md-0 ">
                                                <div class="form-group mb-0">


                                                    <button data-controller="button" data-turbo="true" class="btn  btn-warning" type="submit" form="post-form" formaction="https://demo.orchid.software/example-fields/buttonClickProcessing">


                                                        <i class="mdi mdi-pencil"></i>&nbsp;แก้ไข
                                                    </button>
                                                    <button data-controller="button" data-turbo="true" class="btn  btn-danger" type="submit" form="post-form" formaction="https://demo.orchid.software/example-fields/buttonClickProcessing">&nbsp;


                                                        <i class="mdi mdi-close-circle-outline"></i>&nbsp;ลบ
                                                    </button>

                                                </div>



                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-center" style="width:6rem;">4</td>
                                        <td scope="row"> พลขับ</td>
                                        <td></td>
                                        <td><button class="btn btn-primary btn-rounded">-- --</button></td>
                                        <td></td>
                                        <td>
                                            <div class="dhx_demo-active">พ.อ.(พ.)</div>
                                        </td>

                                        <td></td>
                                        <td style="width: 13rem;text-align:center;">

                                            <div class="col-auto pe-md-0 ">
                                                <div class="form-group mb-0">


                                                    <button data-controller="button" data-turbo="true" class="btn  btn-warning" type="submit" form="post-form" formaction="https://demo.orchid.software/example-fields/buttonClickProcessing">


                                                        <i class="mdi mdi-pencil"></i>&nbsp;แก้ไข
                                                    </button>
                                                    <button data-controller="button" data-turbo="true" class="btn  btn-danger" type="submit" form="post-form" formaction="https://demo.orchid.software/example-fields/buttonClickProcessing">&nbsp;


                                                        <i class="mdi mdi-close-circle-outline"></i>&nbsp;ลบ
                                                    </button>

                                                </div>



                                            </div>
                                        </td>
                                    </tr>

                                    <tr>

                                        <td colspan="9" style="padding-bottom: 0; padding-top: 0;padding-left:0 !important;padding-right: 0 !important;">

                                            <div class="w3-code notranslate htmlHigh bar-2" style="position: relative">
                                                &nbsp;&nbsp;แผนกธุรการ/กรรมวิธีข้อมูล
                                                <div class="form-group mb-0">


                                                    <a style="    float: right;
                                            margin-top: -22px;
                                            margin-right: -7px;" href="<?php echo base_url('structure-assistant-rate/form') ?>" data-controller="button" data-turbo="true" class="btn  btn-default" type="submit" form="post-form" formaction="https://demo.orchid.software/example-fields/buttonClickProcessing">


                                                        <i class="mdi mdi-plus-circle-outline"></i>&nbsp;เพิ่มตำแหน่ง
                                                    </a>

                                                </div>
                                            </div>

                                            <div class="w3-code notranslate htmlHigh bar-3" style="position: relative;">
                                                <x-orchid-icon path="fa.arrow-down" class="float-left" />&nbsp;(ผธก./กข.)
                                                <div class="form-group mb-0">


                                                    <a style="    float: right;
                                            margin-top: -22px;
                                            margin-right: -7px;" href="<?php echo base_url('structure-assistant-rate/form') ?>" data-controller="button" data-turbo="true" class="btn  btn-default" type="submit" form="post-form" formaction="https://demo.orchid.software/example-fields/buttonClickProcessing">


                                                        <i class="mdi mdi-plus-circle-outline"></i>&nbsp;เพิ่มตำแหน่ง
                                                    </a>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center" style="width:6rem;">5</td>
                                        <td scope="row"> หน.แผนก</td>
                                        <td></td>
                                        <td><button class="btn btn-primary btn-rounded">-- --</button></td>
                                        <td></td>
                                        <td>
                                            <div class="dhx_demo-active">พ.อ.(พ.)</div>
                                        </td>

                                        <td></td>
                                        <td style="width: 13rem;text-align:center;">

                                            <div class="col-auto pe-md-0 ">
                                                <div class="form-group mb-0">


                                                    <button data-controller="button" data-turbo="true" class="btn  btn-warning" type="submit" form="post-form" formaction="https://demo.orchid.software/example-fields/buttonClickProcessing">


                                                        <i class="mdi mdi-pencil"></i>&nbsp;แก้ไข
                                                    </button>
                                                    <button data-controller="button" data-turbo="true" class="btn  btn-danger" type="submit" form="post-form" formaction="https://demo.orchid.software/example-fields/buttonClickProcessing">&nbsp;


                                                        <i class="mdi mdi-close-circle-outline"></i>&nbsp;ลบ
                                                    </button>

                                                </div>



                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center" style="width:6rem;">6</td>
                                        <td scope="row">รอง หน.แผนก</td>
                                        <td></td>
                                        <td><button class="btn btn-primary btn-rounded">-- --</button></td>
                                        <td></td>
                                        <td>
                                            <div class="dhx_demo-active">พ.อ.</div>
                                        </td>

                                        <td></td>
                                        <td style="width: 13rem;text-align:center;">

                                            <div class="col-auto pe-md-0 ">
                                                <div class="form-group mb-0">


                                                    <button data-controller="button" data-turbo="true" class="btn  btn-warning" type="submit" form="post-form" formaction="https://demo.orchid.software/example-fields/buttonClickProcessing">


                                                        <i class="mdi mdi-pencil"></i>&nbsp;แก้ไข
                                                    </button>
                                                    <button data-controller="button" data-turbo="true" class="btn  btn-danger" type="submit" form="post-form" formaction="https://demo.orchid.software/example-fields/buttonClickProcessing">&nbsp;


                                                        <i class="mdi mdi-close-circle-outline"></i>&nbsp;ลบ
                                                    </button>

                                                </div>



                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center" style="width:6rem;">7</td>
                                        <td scope="row">นายทหารธุรการ</td>
                                        <td></td>
                                        <td><button class="btn btn-primary btn-rounded">-- --</button></td>
                                        <td></td>
                                        <td>
                                            <div class="dhx_demo-active">พ.ต.-พ.ท.</div>
                                        </td>

                                        <td></td>
                                        <td style="width: 13rem;text-align:center;">

                                            <div class="col-autope-md-0">
                                                <div class="form-group mb-0">


                                                    <button data-controller="button" data-turbo="true" class="btn  btn-warning" type="submit" form="post-form" formaction="https://demo.orchid.software/example-fields/buttonClickProcessing">


                                                        <i class="mdi mdi-pencil"></i>&nbsp;แก้ไข
                                                    </button>
                                                    <button data-controller="button" data-turbo="true" class="btn  btn-danger" type="submit" form="post-form" formaction="https://demo.orchid.software/example-fields/buttonClickProcessing">&nbsp;


                                                        <i class="mdi mdi-close-circle-outline"></i>&nbsp;ลบ
                                                    </button>

                                                </div>



                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center" style="width:6rem;">8</td>
                                        <td scope="row">เจ้าหน้าที่ธุรการ</td>
                                        <td></td>
                                        <td><button class="btn btn-primary btn-rounded">-- --</button></td>
                                        <td></td>
                                        <td>
                                            <div class="dhx_demo-active">จ.ส.อ.(พ.)</div>
                                        </td>

                                        <td></td>
                                        <td style="width: 13rem;text-align:center;">

                                            <div class="col-autope-md-0">
                                                <div class="form-group mb-0">


                                                    <button data-controller="button" data-turbo="true" class="btn  btn-warning" type="submit" form="post-form" formaction="https://demo.orchid.software/example-fields/buttonClickProcessing">


                                                        <i class="mdi mdi-pencil"></i>&nbsp;แก้ไข
                                                    </button>
                                                    <button data-controller="button" data-turbo="true" class="btn  btn-danger" type="submit" form="post-form" formaction="https://demo.orchid.software/example-fields/buttonClickProcessing">&nbsp;


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