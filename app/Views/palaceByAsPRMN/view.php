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
                                            <input type="text" class="form-control" name="search" id="search" title="คำค้น เลขประจำตัวประชาชนมชื่อ-สกุล,ตำแหน่ง"  placeholder="ป้อนคำที่ต้องการค้นหา" >
                                            <div class="input-group-append">
                                                <button type="buttom" class="btn btn-success" onclick="search();">ค้นหา</button>
                                            </div>
                                        </div>
                                    <!-- </form> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <input type="hidden" class="form-control" id="positionMapID" name="positionMapID">
                    <input type="hidden" class="form-control" id="typeForce" name="typeForce">
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
                        <tbody id="load_data">
                        
                        </tbody>
                    </table>
                </div>

                <div id="loadPage"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>

<script src="assets/libs/jquery/jquery.min.js"></script>
<script>
$( document ).ready(function() {
    search();
});

function addPalace(fId) {
    var positionMapID = $('#positionMapID').val();
    var typeForce = $('#typeForce').val();
    // alert(positionMapID);
    $.ajax({
        url:  "PalaceByAssistPRMN/savePalace",
        method: "post",
        data: {fId: fId,positionMapID:positionMapID,typeForce:typeForce},
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
                    window.location = "PalaceByAssistPRMN?typeForce="+typeForce;
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

function search() {
    var search = $('#search').val();
    $.ajax({
        url:  "PalaceByAssistPRMN/searchPersonal",
        method: "post",
        data: {search: search},
        dataType: "text",
        success: function (data) {
            // console.log(data);
            $("#load_data").html(data);
        }
    });
}

</script>
