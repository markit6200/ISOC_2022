<?= $this->extend('theme/admin') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body d-inline">
                <span class="h2"><?php echo $title; ?></span>
                <div class="float-end">
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .card-body.content-history {
        background: #525659;
        min-height: 100vh;
        display: flex;
        flex-direction: row;
    }

    .page-content{
        padding: 1cm;
        margin: auto;
        height: 445.5mm;
        width: 315mm;
        background: #FFFFFF;
        box-shadow: #2b2929;
    }
    .pre-table {
        width: 100%;
        border: #2c2b2b 1px solid !important;
        font-size: 12pt;
        font-family: TH Sarabun;
    }
    .pre-table tr td {
        height: 1.5rem;
    }
    .gray{
        background: #d3d3d3;
    }

    .table, .table thead, .table tbody, .table td,
    .table th, .table tr, .table thead tr, .table thead tr th,
    .table tbody tr td, .table tbody tr, .table>tbody, .table>thead
    {
        border: #0b0b0b 1px solid !important;
        border-collapse: collapse;
        margin-bottom: 0 !important;
        height: 1rem !important;
    }
    .table>thead>tr>th{
        text-align: center !important;
        padding: 4px 0 4px !important;
    }
    .frame{
        height: 6cm;
        width: 4.5cm;
        border: #0b0b0b 1px solid !important;
        margin: 6px !important;
        background: #d9d6d6;
    }
    .title{
        font-weight: 700 !important;
        font-size: 16pt;
    }
    .column-1{
        width: 15%;
    }
    .column-2{
        width: 30%;
    }
    .column-3{
        width: 20%;
    }
    .column-4{
        width: 15%;
    }
    .column-5{
        width: 20%;
    }
    input.text {
        width: 100%;
    }
    .sh-text{
        display: inline-block;
        width: 90%;
        padding: 0;
    }
    .pencil {
        display: none;
    }

    .sh-text:hover + .pencil {
        display: inline-block;
        cursor: auto;
    }

</style>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body content-history">
                <div class="page-content">
                    <table class="pre-table">
                        <tr>
                            <td colspan="7" class="text-center gray">
                                <span class="title">แบบประวัติย่อข้าราชการพลเรือนประจำ กอ.รมน.</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="column-1">ยศ-คำนำหน้า-ชื่อ-สกุล</td>
                            <td class="column-2 edit" colspan="2">
                                <span class="sh-text">dddddddd  dddddddddd</span>
                                <input type="hidden" class="text" value="dddddddd  dddddddddd"/>
                            </td>
                            <td class="column-3" rowspan="5">
                                <div class="frame">
                                </div>
                            </td>
                            <td class="column-4">วันเดือนปี</td>
                            <td class="column-5" colspan="2">
                                <span class="sh-text">&nbsp;</span>
                                <input type="hidden" class="text"/>
                            </td>
                        </tr>
                        <tr>
                            <td>ประเภท-ตำแหน่ง-ระดับ</td>
                            <td colspan="2">
                                <span class="sh-text">&nbsp;</span>
                                <input type="hidden" class="text"/>
                            </td>
                            <td>วันเดือนปีเกษียณ</td>
                            <td colspan="2">
                                <span class="sh-text">&nbsp;</span>
                                <input type="hidden" class="text"/>
                            </td>
                        </tr>
                        <tr>
                            <td>สังกัด</td>
                            <td colspan="2">
                                <span class="sh-text">&nbsp;</span>
                                <input type="hidden" class="text"/>
                            </td>
                            <td>เงินเดือน</td>
                            <td colspan="2">
                                <div>
                                    <span class="sh-text">&nbsp;</span>
                                    <input type="hidden" class="text"/>
                                </div>
                                <span class="text-static">(ณ วันที่</span>
                                <span class="sh-text">&nbsp;</span>
                                <input type="hidden" class="text"/>
                                <span class="text-static">)</span>
                            </td>
                        </tr>
                        <tr>
                            <td>เลขประจำตัวประชาชน</td>
                            <td colspan="2">
                                <span class="sh-text">&nbsp;</span>
                                <input type="hidden" class="text"/>
                            </td>
                            <td>เงินเพิ่ม</td>
                            <td colspan="2">
                                <span class="sh-text">&nbsp;</span>
                                <input type="hidden" class="text"/>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="2"></td>
                            <td></td>
                            <td colspan="2"></td>
                        </tr>
                    </table>
                    <table class="table star">
                        <thead>
                            <tr>
                                <th>ปี พ.ศ</th>
                                <th>เครื่องราชอิสริยาภรณ์ / เหรียญตรา</th>
                                <th>ราชกิจจานุเบกษา (ลงวันที่)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="edu table">
                        <thead>
                        <tr>
                            <th colspan="5">การศึกษา</th>
                        </tr>
                        <tr>
                            <th>คุณวุฒิ</th>
                            <th>สาขา</th>
                            <th>สถานศึกษา</th>
                            <th>พ.ศ</th>
                            <th>ประเทศ</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                    <table class="table training">
                        <thead>
                            <tr>
                                <th colspan="4">การฝึกอบรม/สัมมนา/ดูงาน ฯลฯ</th>
                            </tr>
                            <tr>
                                <th>สถานที่การฝึกอบรม ดูงาน</th>
                                <th>ตั้งแต่ - ถึง</th>
                                <th>โครงการ, หลักสูตร</th>
                                <th>หน่วนที่จัด</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table history">
                        <thead>
                            <tr>
                                <th colspan="3">รายการแสดงการรับราชการ</th>
                            </tr>
                            <tr>
                                <th>เลขที่</th>
                                <th>ตำแหน่ง</th>
                                <th>วันเดือนปี</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table taint">
                        <thead>
                            <tr>
                                <th colspan="3">การได้รับโทษทางวินัย</th>
                            </tr>
                            <tr>
                                <th>พ.ศ</th>
                                <th>รายการ</th>
                                <th>เอกสารอ้างอิง</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table gauge">
                        <thead>
                        <tr>
                            <th colspan="3">ผลการประเมินย้อนหลัง 3 ปี</th>
                        </tr>
                        <tr>
                            <th>พ.ศ</th>
                            <th>รายการ</th>
                            <th>เอกสารอ้างอิง</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('jsContent') ?>
<script type="application/javascript">
    $(document).ready(function(){
        $(".sh-text").after("<i class='fa fa-pencil-alt pencil'></i>")
    })
    $(document).on("click", ".sh-text", function(){
        const elems = $(this).closest("td").find(".text");
        elems.attr("type","input");
        elems.addClass("editor");
        elems.focus();
        $(this).hide();
    })

    $(document).on("blur", ".editor", function(){
        const elems = $(this);
        const txt = elems.closest("td").find(".sh-text");
        if(elems.val() === "" ){
            txt.html("&nbsp;")
        }else{
            txt.text(elems.val());
        }
        elems.attr("type","hidden");
        txt.show();
        elems.removeClass("editor");
    })

    $(document).on("blur", ".table tr", function(){
        const elems = $(this);
        const txt = elems.closest("td").find(".sh-text");
        if(elems.val() === "" ){
            txt.html("&nbsp;")
        }else{
            txt.text(elems.val());
        }
        elems.attr("type","hidden");
        txt.show();
        elems.removeClass("editor");
    })
</script>
<?= $this->endSection() ?>