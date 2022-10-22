<select class="form-select" name="positionRankTo" id="positionRankTo" >
    <option value="">---- เลือกชั้นยศ ----</option>
    <?php if (isset($positionRank))
        foreach ($positionRank as $key => $value) {
            $sel = '';
            if(isset($save_data['rankIDTo'])){
                $sel = $save_data['rankIDTo'] == $value->id? 'selected':'';
            }
        ?>
            <option value="<?php echo $value->id ?>" <?php echo $sel ?>><?php echo $value->rank_name ?></option>
        <?php 
        }
    ?>
</select>