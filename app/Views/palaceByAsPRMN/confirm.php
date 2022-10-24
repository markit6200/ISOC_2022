<!-- Modal -->
<div class="modal fade" id="distributeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">จำหน่ายข้อมูล</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding:22px;">
                <input type="hidden" class="form-control" id="mId" name="mId">
                <input type="hidden" class="form-control" id="typeForceM" name="typeForce">
                ท่านต้องการจำหน่ายข้อมูล 
                <span id="textConfirm"></sapn>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">ปิด</button>
                <button type="button" class="btn btn-danger" onclick="updateDistribute()">ลบ</button>
            </div>
        </div>
    </div>
</div>

<script>
function updateDistribute() {
    var mId = $('#mId').val();
    var typeForce = $('#typeForceM').val();
    mId
    $.ajax({
        url:  "PalaceByAssistPRMN/updateDistribute",
        method: "post",
        data: {mId: mId},
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
                $('#distributeModal').modal('hide');
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
