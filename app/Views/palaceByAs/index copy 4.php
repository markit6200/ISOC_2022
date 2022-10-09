<?= $this->extend('theme/admin') ?>
<?= $this->section('content') ?>
<link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <span class="h2"><?php echo $title; ?></span>
            </div>
        </div>
    </div>
</div>

    <style>
        .custom-code {
            border-left: 4px solid #04AA6D;
        }

        .custom-section,
        .custom-code {
            /* margin-top: 16px!important;
      margin-bottom: 16px!important; */
        }

        .custom-code {
            width: auto;
            background-color: #fff;
            color: #000;
            padding: 8px 12px;
            border-left: 4px solid #4CAF50 !important;
            border: 1px solid #e5e5e5;
            word-wrap: break-word;
        }

        .float-left {
            float: left;
            margin-top: 3px;
            margin-right: 10px;
        }

        .dhx_demo-active {
            width: 100px;
            border: 1px solid;
            border-radius: 20px;
            text-align: center;
            text-transform: capitalize;
            font-weight: 500;
            line-height: 20px;
            border-color: rgba(10, 177, 105, .5);
            color: #0ab169;
        }

        .dhx_demo-danger {
            width: 100px;
            border: 1px solid;
            border-radius: 20px;
            text-align: center;
            text-transform: capitalize;
            font-weight: 500;
            line-height: 20px;
            border-color: red;
            color: red;
        }

        .dhx_button:hover {
            background-color: rgba(91, 108, 191, .9);
        }

        .dhx_button {
            color: #fff;
            overflow: visible;
            position: relative;
            text-decoration: none;
            background-image: none;
            border: 0;
            touch-action: manipulation;
            -webkit-appearance: none;
            -webkit-user-select: none;
            -ms-user-select: none;
            user-select: none;
            white-space: nowrap;
            cursor: pointer;
            background-color: rgba(91, 108, 191, .9);
            border-radius: 28px;
            padding: 4px 12px;
        }
    .bar-1{
        border-left: 4px solid #0048B3 !important;background-color: white;
    }
    .bar-2{
        border-left: 4px solid #38CB89 !important;background-color: white;
    }
    .bar-3{
        border-left: 4px solid #FFA600 !important;background-color: white;
    }
    </style>
<?php 
// echo '<pre>'; print_r($personal); echo '</pre>'; exit; 
// echo '<pre>'; print_r($personal); echo '</pre>'; exit;
// foreach($personal as $key => $value ){

// } 
?>
    <div class="row">
        <div class="col-md-12">
            <div class="bg-white rounded shadow-sm p-4 py-4 d-flex flex-column">
                <div class="row form-group align-items-baseline">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 25rem;" class="text-dark fw-bold text-center">ลำดับ</th>
                                    <th scope="col" class="text-dark fw-bold text-center" style="width: 152rem;">ชื่อตำแหน่งใน กอ.รมน./<br>ชื่อตำแหน่งในการบริหาร</th>
                                    <th scope="col" class="text-dark fw-bold text-center">ชั้นยศ</th>
                                    <th scope="col" class="text-dark fw-bold text-center" style="width: 117rem;">ตำแหน่ง<br>เลขที่</th>
                                    <th scope="col" class="text-dark fw-bold " style="width: 15rem;">ยศ</th>
                                    <th scope="col" class="text-dark fw-bold text-center" style="width: 30rem;">ชื่อ-สกุล</th>
                                    <th scope="col" class="text-dark fw-bold text-center">ตำแหน่งและสังกัดปกติ</th>
                                    <th scope="col" class="text-dark fw-bold text-center" style="width: -10rem;">เครื่องมือ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="12" style="padding-bottom: 0;padding-left:0 !important;padding-right: 0 !important;">
                                        <div class="custom-code notranslate htmlHigh bar-1">
                                            สง.ปรมน.ทบ.
                                        </div>
                                        <div class="custom-code notranslate htmlHigh bar-2">
                                            &nbsp;&nbsp;สำนักงานปฏิบัติภารกิจรักษาความมั่นคงภายในกองทัพบก
                                        </div>
                                        <div class="custom-code notranslate htmlHigh bar-3">
                                           &nbsp;ส่วนบังคับบัญชา
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">1</td>
                                    <td scope="row">รอง ผอ.สง.ปรมน.ทบ. (2)</td>
                                    <td>
                                        <div class="dhx_demo-active">พล.อ.</div>
                                    </td>
                                    <td>504300000003</td>
                                    <td>พล.อ.</td>
                                    <td>สิทธิพร มุสิกะสิน</td>
                                    <td></td>
                                    <td style="width: 13rem;text-align:center;">
                                        <div class="col-auto pe-md-0">
                                            <div class="form-group mb-0">
                                                <button class="btn  btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#distributeModal">
                                                    <i class="mdi mdi-close-circle-outline"></i>&nbsp;พ้น
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">2</td>
                                    <td scope="row">เสธ.สง.ปรมน.ทบ.</td>
                                    <td>
                                        <div class="dhx_demo-active">พล.ท.</div>
                                    </td>
                                    <td>504300000004</td>
                                    <td>พล.ท</td>
                                    <td>ยุทธชัย เทียรทอง</td>
                                    <td></td>
                                    <td style="width: 13rem;text-align:center;">
                                        <div class="col-auto pe-md-0">
                                            <div class="form-group mb-0">
                                                <button class="btn  btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#distributeModal">
                                                    <i class="mdi mdi-close-circle-outline"></i>&nbsp;พ้น
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">3</td>
                                    <td scope="row">ทส.ผอ.สง.ปรมน.ทบ.</td>
                                    <td>
                                        <div class="dhx_demo-active">พ.ท.</div>
                                    </td>
                                    <td>504300000013</td>
                                    <td>พ.ท.</td>
                                    <td>ปรียาภรณ์ บุนนาค</td>
                                    <td></td>
                                    <td style="width: 13rem;text-align:center;">
                                        <div class="col-auto pe-md-0">
                                            <div class="form-group mb-0">
                                                <button class="btn  btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#distributeModal">
                                                    <i class="mdi mdi-close-circle-outline"></i>&nbsp;พ้น
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">4</td>
                                    <td scope="row">ทส.ผอ.สง.ปรมน.ทบ.</td>
                                    <td>
                                        <div class="dhx_demo-active">พ.ท.</div>
                                    </td>
                                    <td></td>
                                    <td>พ.ท.</td>
                                    <td>
                                        <div class="dhx_demo-danger">-- ว่าง --</div>
                                    </td>
                                    <td></td>
                                    <td style="width: 13rem;text-align:center;">
                                        <div class="col-auto pe-md-0">
                                            <div class="form-group mb-0">
                                                <button class="btn  btn-primary w-md" data-bs-toggle="modal"
                                                    data-bs-target="#staticBackdrop">
                                                    <i class="mdi mdi-plus-circle-outline"></i>&nbsp;บรรจุอัตรา
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="12" style="padding-bottom: 0;padding-left:0 !important;padding-right: 0 !important;">
                                        <div class="custom-code notranslate htmlHigh bar-2">
                                            &nbsp;&nbsp;สำนักบูรณาการและขับเคลื่อนการปฏิบัติ
                                        </div>
                                        <div class="custom-code notranslate htmlHigh bar-3">
                                            &nbsp;
                                            ส่วนบังคับบัญชา
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">4</td>
                                    <td scope="row">ผอ.สบข.ปรมน.ทบ.</td>
                                    <td>
                                        <div class="dhx_demo-active">พล.ท.</div>
                                    </td>
                                    <td>504300000118</td>
                                    <td>พล.ท.</td>
                                    <td>ศักดา คล้ำมีศรี</td>
                                    <td></td>
                                    <td style="width: 13rem;text-align:center;">
                                        <div class="col-auto pe-md-0">
                                            <div class="form-group mb-0">
                                                <button class="btn  btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#distributeModal">
                                                    <i class="mdi mdi-close-circle-outline"></i>&nbsp;พ้น
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">5</td>
                                    <td scope="row">ผอ.สบข.ปรมน.ทบ.</td>
                                    <td>
                                        <div class="dhx_demo-active">พล.ท.</div>
                                    </td>
                                    <td>504300000118</td>
                                    <td>พล.ท.</td>
                                    <td>ศักดา คล้ำมีศรี</td>
                                    <td></td>
                                    <td style="width: 13rem;text-align:center;">
                                        <div class="col-auto pe-md-0">
                                            <div class="form-group mb-0">
                                                <button class="btn  btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#distributeModal">
                                                    <i class="mdi mdi-close-circle-outline"></i>&nbsp;พ้น
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
<?= $this->include('palaceByAs/view') ?>
<?= $this->include('palaceByAs/confirm') ?>

<!-- Sweet Alerts js -->
<script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>

<?= $this->endSection() ?>