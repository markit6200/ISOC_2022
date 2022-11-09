<table class="table table-bordered">
    <thead class="table-light">
        <tr>
            <th scope="col" class="text-dark fw-bold text-center" colspan="7">บัญชีรายชื่อกำลังพล สังกัด <?php echo $orgName." ".$orderType;?> ใน กอ.รมน</th>
        </tr>
    </thead>
</table>

<table class="table table-bordered" border="1">
    <thead class="table-light">
        <tr>
            <th scope="col" class="text-dark fw-bold text-center" style="width:6rem;">ลำดับ</th>
            <th scope="col" class="text-dark fw-bold text-center" style="width:15rem;">ยศ ชื่อ สกุล</th>
            <th scope="col" class="text-dark fw-bold text-center" style="width:15rem;">ตำแหน่งหรือสังกัดปกติ</th>
            <th scope="col" class="text-dark fw-bold text-center" style="width:15rem;">หน่วยงานหรือตำแหน่งใน กอ.รมน.</th>
            <th scope="col" class="text-dark fw-bold text-center" style="width:10rem;">ตั้งแต่วันที่</th>
            <th scope="col" class="text-dark fw-bold text-center" style="width:10rem;">ถึงวันที่</th>
            <th scope="col" class="text-dark fw-bold text-center" style="width:10rem;">หมายเหตุ</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $html = '';
            if(!empty($DataReq)){
                foreach($DataReq AS $key=>$val){
        
                $html .='<tr>
                        <td scope="col" class="text-dark fw-bold text-center" style="width:6rem;vertical-align: top;">'.$val['runno'].'</td>
                        <td scope="col" class="text-dark fw-bold text-left" style="width:15rem;text-align: left;vertical-align: top;">'.$val['codePrefixTxt'].$val['fullName'].'<br>'.$val['hrNumber'].'</td>
                        <td scope="col" class="text-dark fw-bold text-left" style="width:15rem;text-align: left;vertical-align: top;">'.$val['originPosition'].'</td>
                        <td scope="col" class="text-dark fw-bold text-left" style="width:15rem;text-align: left;vertical-align: top;">'.$val['isocPosition'].'</td>
                        <td scope="col" class="text-dark fw-bold text-center" style="width:10rem;vertical-align: top;">'.$val['dateBegin'].'</td>
                        <td scope="col" class="text-dark fw-bold text-center" style="width:10rem;vertical-align: top;">'.$val['dateEnd'].'</td>
                        <td scope="col" class="text-dark fw-bold text-center" style="width:10rem;vertical-align: top;"></td>
                    </tr>';
                
                }
            }

            echo $html;
        ?>
    </tbody>
</table>

<!---ส่วนท้าย-->
<table class="table table-bordered">
    <thead class="table-light">
        <tr>
            <th scope="col" class="text-dark fw-bold text-center" colspan="4"></th>
            <th scope="col" class="text-dark fw-bold" colspan="3" style="text-align: left;"></th>
        </tr>
        <tr>
            <th scope="col" class="text-dark fw-bold text-center" colspan="4"></th>
            <th scope="col" class="text-dark fw-bold" colspan="3" style="text-align: left;"></th>
        </tr>
        <tr>
            <th scope="col" class="text-dark fw-bold text-center" colspan="4"></th>
            <th scope="col" class="text-dark fw-bold" colspan="3" style="text-align: left;"></th>
        </tr>
        <tr>
            <th scope="col" class="text-dark fw-bold text-center" colspan="4"></th>
            <th scope="col" class="text-dark fw-bold" colspan="3" style="text-align: left;">ตรวจสอบถูกต้อง</th>
        </tr>
        <tr>
            <th scope="col" class="text-dark fw-bold text-center" colspan="4"></th>
            <th scope="col" class="text-dark fw-bold text-center" colspan="3"></th>
        </tr>
        <tr>
            <th scope="col" class="text-dark fw-bold text-center" colspan="4"></th>
            <th scope="col" class="text-dark fw-bold text-center" colspan="3">(........................................)</th>
        </tr>
        <tr>
            <th scope="col" class="text-dark fw-bold text-center" colspan="4"></th>
            <th scope="col" class="text-dark fw-bold text-center" colspan="3"><?php echo $datePrint;?></th>
        </tr>
    </thead>
</table>