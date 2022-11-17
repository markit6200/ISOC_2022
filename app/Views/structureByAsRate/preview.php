<?= $this->extend('theme/admin') ?>
<?= $this->section('content') ?>
<style>
    /* Absolute Center Spinner */
.loading {
  position: fixed;
  z-index: 999;
  height: 2em;
  width: 2em;
  overflow: show;
  margin: auto;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
}

/* Transparent Overlay */
.loading:before {
  content: '';
  display: block;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
    background: radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0, .8));

  background: -webkit-radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0,.8));
}

/* :not(:required) hides these rules from IE9 and below */
.loading:not(:required) {
  /* hide "loading..." text */
  font: 0/0 a;
  color: transparent;
  text-shadow: none;
  background-color: transparent;
  border: 0;
}

.loading:not(:required):after {
  content: '';
  display: block;
  font-size: 10px;
  width: 1em;
  height: 1em;
  margin-top: -0.5em;
  -webkit-animation: spinner 150ms infinite linear;
  -moz-animation: spinner 150ms infinite linear;
  -ms-animation: spinner 150ms infinite linear;
  -o-animation: spinner 150ms infinite linear;
  animation: spinner 150ms infinite linear;
  border-radius: 0.5em;
  -webkit-box-shadow: rgba(255,255,255, 0.75) 1.5em 0 0 0, rgba(255,255,255, 0.75) 1.1em 1.1em 0 0, rgba(255,255,255, 0.75) 0 1.5em 0 0, rgba(255,255,255, 0.75) -1.1em 1.1em 0 0, rgba(255,255,255, 0.75) -1.5em 0 0 0, rgba(255,255,255, 0.75) -1.1em -1.1em 0 0, rgba(255,255,255, 0.75) 0 -1.5em 0 0, rgba(255,255,255, 0.75) 1.1em -1.1em 0 0;
box-shadow: rgba(255,255,255, 0.75) 1.5em 0 0 0, rgba(255,255,255, 0.75) 1.1em 1.1em 0 0, rgba(255,255,255, 0.75) 0 1.5em 0 0, rgba(255,255,255, 0.75) -1.1em 1.1em 0 0, rgba(255,255,255, 0.75) -1.5em 0 0 0, rgba(255,255,255, 0.75) -1.1em -1.1em 0 0, rgba(255,255,255, 0.75) 0 -1.5em 0 0, rgba(255,255,255, 0.75) 1.1em -1.1em 0 0;
}

/* Animation */

@-webkit-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-moz-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-o-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
</style>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body d-inline">
                <span class="h2"><?php echo $title; ?></span>
                <div class="float-end">
                    <a href="<?php echo base_url('StructureByAssistRate/import/'.$profileId) ?>" class="btn btn-default"><i class="fas fa-chevron-left"></i> ย้อนกลับ</a>
                    <button class="btn btn-default" onclick="importData('<?php echo $profileId ?>','<?php echo $uploadId ?>')"><i class="fas fa-save"></i> อัพโหลด</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                
                <?= view('partials/flash_message') ?>
                <div class="col-md-12">
                    <div class="row form-group align-items-baseline">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <?php 
                                       if (isset($previewData) && !empty($previewData)) {
                                        foreach ($previewData as $index => $row) {
                                            if ($index == 1) {
                                            ?>
                                            <tr>
                                                <?php 
                                                foreach($row as $key => $col){
                                                    ?>
                                                    <td><?php echo $key ?></td>
                                                    <?php
                                                }
                                            ?>
                                            </tr>
                                            <?php 
                                            }
                                        }
                                        
                                       }
                                    ?>
                                </thead>
                                <tbody>
                                    <?php 
                                       if (isset($previewData) && !empty($previewData)) {
                                        foreach ($previewData as $index => $row) {
                                            ?>
                                            <tr>
                                                <?php 
                                                foreach($row as $key => $col){

                                                    ?>
                                                    <td><?php echo $key=='id' ? $index+1 : $col ?></td>
                                                    <?php
                                                }
                                            ?>
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
        </div>
    </div>
</div>
<div class="loading">Loading&#8230;</div>
<?= $this->endSection() ?>
<?= $this->section('cssTopContent')?>
<link href="<?php echo base_url() ?>/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
<?= $this->endSection() ?>
<?= $this->section('jsContent')?>
<script src="<?php echo base_url() ?>/assets/libs/sweetalert2/sweetalert2.min.js"></script>
<script>
    function importData(profieId,id){
        $('.loading').show();
        $.ajax({
            url: "<?php echo base_url('StructureByAssistRate/ajaxImportData/') ?>/"+profieId+'/'+id,
            type: 'post',
            contentType: false,
            processData: false,
            success: function( result ) {
                if (result == 'success'){
                    Swal.fire({
                        title: "นำเข้าข้อมูลสำเร็จ",
                        icon: "success",
                        showCancelButton: false,
                        confirmButtonText: "ตกลง",
                    }).then(function (result) {
                        if (result.value) {
                            // $(window).bind('beforeunload', undefined);
                            location.href = '<?php echo base_url("StructureByAssistRate/view"); ?>/'+profieId;
                        }
                    });
                } else {
                    $('.loading').hide();
                    Swal.fire({
                        title: "ไม่สามารนำเข้าข้อมูลได้ กรุณาตรวจสอบข้อมูล",
                        icon: "danger",
                        showCancelButton: false,
                        confirmButtonColor: "#f46a6a",
                        confirmButtonText: "ตกลง",
                    })
                }
            }
        });
    }
    // $(window).bind('beforeunload', function(){
    // // myfun();
    //     return 'Are you sure you want to leave?';
    // });

    $(document).ready(function(){
        $('.loading').hide();
    })
</script>

<?= $this->endSection() ?>
