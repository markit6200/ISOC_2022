<!-- Modal -->
<div class="modal fade " id="searchModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">เพิ่มข้อมูล</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding:22px;">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body d-inline">
                                <div class="">
                                    <!-- <form> -->
                                        <div class="input-group">
                                            <input type="text" class="form-control" title="คำค้น เลขประจำตัวประชาชนมชื่อ-สกุล,ตำแหน่ง"  placeholder="ป้อนคำที่ต้องการค้นหา" >
                                            <div class="input-group-append">
                                                <button type="buttom" class="btn btn-success">ค้นหา</button>
                                            </div>
                                        </div>
                                    <!-- </form> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <input type="text" class="form-control" id="positionID" name="positionID">
                    <input type="text" class="form-control" id="typeForce" name="typeForce">
                    <table id="myTable" class="table  table-bordered">
                        <thead>
                            <tr>
                                <th rowspan="2" class="text-center text-dark" width="4%">ลำดับ</th>
                                <th rowspan="2" class="text-center text-dark sort-column" width="23%">
                                    เลขประจำตัวประชาชน</th>
                                <th rowspan="2" class="text-center text-dark sort-column" width="24%">ยศ-ชื่อ-สกุล
                                </th>
                                <th rowspan="2" class="text-center text-dark sort-column" width="38%">
                                    ตำแหน่งและสังกัด<br>ในสายงานปกติ
                                </th>

                                <th class="text-center text-dark" style="width: 13rem;">เครื่องมือ</th>
                            </tr>

                        </thead>
                        <tbody>
                        <?php 
                            $runno = 0;
                            foreach($personal AS $value){
                                $runno++;
                                $fId = $value->fid;
                                echo '<tr>
                                    <td class="text-center" rowspan="">'.$runno.'</td>
                                    <td class="text-center" rowspan="">'.$value->cardID.' </td>
                                    <td class="text-left" rowspan="">'.$value->firstName.' '.$value->lastName.'</td>
                                    <td class="text-center">'.$value->isocPosition.'</td>
                                    <td class="text-center">
                                        <div class="col-auto pe-md-0">
                                            <div class="form-group mb-0">
                                                <button class="btn btn-primary" onclick="addPalace('.$fId.')">
                                                    <x-orchid-icon path="fa.plus" />&nbsp;เพิ่ม
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>';
                            } 

                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>

<script>
function addPalace(fId) {
    var positionID = $('#positionID').val();
    var typeForce = $('#typeForce').val();
    // alert(positionID);
    $.ajax({
        url:  "PalaceByAssist/savePalace",
        method: "post",
        data: {fId: fId,positionID:positionID,typeForce:typeForce},
        dataType: "text",
        success: function (data) {
            console.log(data);
            if(data == 'success'){
                Swal.fire({
                    icon: 'success',
                    title: 'บันทึกข้อมูลเรียบร้อย',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location = "PalaceByAssist?typeForce="+typeForce;
                });
                $('#searchModal').modal('hide');
            }else{
                Swal.fire({
                    title: 'ไม่สามารถบันทึกข้อมูลได้',
                    text: '',
                    icon: 'error'
                })
            }
        }
    });
}
</script>
