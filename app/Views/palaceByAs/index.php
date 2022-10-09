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
            /* padding: 8px 12px; */
            padding: 11px 12px;
            /* border-left: 4px solid #4CAF50 !important; */
            /* border: 1px solid #e5e5e5; */
            word-wrap: break-word;
            border: 0px;
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
    .line_bar{
        padding-bottom: 0;padding-left:0 !important;padding-right: 0 !important;
    }
    .bar-1{
        border-left: 4px solid #0048B3 !important;background-color: white;
    }
    .bar-2{
        border-left: 4px solid #38CB89 !important;background-color: white;
    }

    .bar-2 .btn {
        padding: 0px 0px;
    }

    .line_bar-2{
        padding-bottom: 0;padding-left:0 !important;padding-right: 0 !important;
    }

    .bar-3{
        border-left: 4px solid #FFA600 !important;background-color: white;
    }

    .line_bar-3{
        padding-top: 4px !important;padding-bottom: 4px !important;padding-left:0px !important;padding-right: 0px !important;
    }

    .bar-4{
        border-left: 4px solid #f46a6a !important;background-color: white;
    }

    .line_bar-4{
        padding-top: 4px !important;padding-bottom: 4px !important;padding-left:0px !important;padding-right: 0px !important;
    }

    .bar-5{
        border-left: 4px solid #6f42c1 !important;background-color: white;
    }

    .line_bar-5{
        padding-top: 4px !important;padding-bottom: 4px !important;padding-left:0px !important;padding-right: 0px !important;
    }

    .bar-6{
        border-left: 4px solid #c4e67f !important;background-color: white;
    }

    .line_bar-6{
        padding-top: 4px !important;padding-bottom: 4px !important;padding-left:0px !important;padding-right: 0px !important;
    }

    .bar-7{
        border-left: 4px solid #e83e8c !important;background-color: white;
    }

    .line_bar-7{
        padding-top: 4px !important;padding-bottom: 4px !important;padding-left:0px !important;padding-right: 0px !important;
    }
    
    </style>

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
                                    <th scope="col" class="text-dark fw-bold text-center" style="width: 30rem;">ตำแหน่ง<br>เลขที่</th>
                                    <th scope="col" class="text-dark fw-bold " style="width: 16rem;">ยศ</th>
                                    <th scope="col" class="text-dark fw-bold text-center" style="width: 60rem;">ชื่อ-สกุล</th>
                                    <th scope="col" class="text-dark fw-bold text-center">ตำแหน่งและสังกัดปกติ</th>
                                    <th scope="col" class="text-dark fw-bold text-center" style="width: -10rem;">เครื่องมือ</th>
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
<?= $this->include('palaceByAs/view') ?>
<?= $this->include('palaceByAs/confirm') ?>

<!-- Sweet Alerts js -->
<script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
<script src="assets/libs/jquery/jquery.min.js"></script>
<script>
function checkDistribute(mId,rankTxt,fullName,isocPosition,typeForce){
    var textConfirm = rankTxt+' '+fullName+' ตำแหน่งและสังกัดปกติ '+isocPosition+' หรือไม่?';
    $("#distributeModal").find('.modal-body #mId').val(mId);
    $("#distributeModal").find('.modal-body #typeForceM').val(typeForce);
    $("#distributeModal").find('.modal-body #textConfirm').html(textConfirm);
}

function checkSearch(positionID,typeForce){
    $("#searchModal").find('.modal-body #positionID').val(positionID);
    $("#searchModal").find('.modal-body #typeForce').val(typeForce);
}
</script>
<?= $this->endSection() ?>