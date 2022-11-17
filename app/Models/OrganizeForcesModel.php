<?php namespace App\Models;

use CodeIgniter\Model;
use App\Models\GeneralModel;

class OrganizeForcesModel extends Model
{
	protected $DBGroup = ('usermanager');
    protected $table      = 'organize_to_profile';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
	
		
		$this->generalModel = new GeneralModel();
		$this->num = 0;
	}

	public function getOrganizeDetail($org_id)
	{
		$typeForce = @$_GET['typeForce'];

		$db = db_connect();
		$builder = $db->table('DataPositionMapOrganize AS t1');
		$builder->select('t1.*,t2.mId,t3.firstName,t3.lastName,t3.isocPosition,t3.codePrefix,t3.positionCivilianID AS personalPositionCivilianID,t2.statusPackingRate,t4.directiveNo AS directiveBegin,t2.dateBegin,t2.dateEnd,t5.directiveNo AS directiveRetire,t2.dateRetire');
		$builder->join("DataPersonalForcesMap AS t2","t1.positionMapID = t2.positionMapID AND t2.typeForce = '{$typeForce}' AND t2.statusPackingRate != '2'","left");
		$builder->join("DataPersonalForces AS t3","t2.fid= t3.fid","left");
		$builder->join("DataPersonalForcesMapHead AS t4","t2.hID = t4.id AND t4.directiveType = 1","left");
		$builder->join("DataPersonalForcesMapHead AS t5","t2.hIDRetire = t5.id AND t5.directiveType = 2","left");
		$builder->where("t1.org_id = '{$org_id}' AND t1.profileType = 1");
		$builder->orderBy("t1.org_id ASC,t1.positionMapID ASC");
		$result = $builder->get()->getResult();
		// echo $db->getLastQuery(); exit;
		$html = '';
		$position = $this->generalModel->getPositionList();
        $personalType = $this->generalModel->getPersonalType();
		$positionGroup = $this->generalModel->getPositionGroupList();
		$positionCivilian = $this->generalModel->getPositionCivilianList();
		$positionCivilianGroup = $this->generalModel->getPositionCivilianGroupList();
		$rank = $this->generalModel->getPositionRankList();
		$rankShort = $this->generalModel->getPositionRankShortList();
		$codePrefixShort = $this->generalModel->getcodePrefixShort();
		
		if(count($result)>0){
			foreach( $result as $key => $value ){
				$this->num++;
				$positionTxt = $position[$value->positionID];
                $personalTypeTxt = $personalType[$value->positionType];
				$positionGroupTxt = !empty($value->positionGroupID)?$positionGroup[$value->positionGroupID]:'-';
				$positionCivilianTxt = !empty($value->positionCivilianID)?$positionCivilian[$value->positionCivilianID]:'-- --';
				$positionCivilianGroupTxt = !empty($value->positionCivilianGroupID)?$positionCivilianGroup[$value->positionCivilianGroupID]:'-';
				$rankTxt = !empty($value->rankID)?$rankShort[$value->rankID]:'-';
				$rankToTxt = !empty($value->rankIDTo)?' - '.$rankShort[$value->rankIDTo]:'';
				$positionNumberTxt = $value->positionNumber;
				$fullName = $value->firstName.' '.$value->lastName;
				$personalPositionCivilianTxt = !empty($value->personalPositionCivilianID)?$positionCivilian[$value->personalPositionCivilianID]:'';

				$arr_color = array('1'=>'#ffffff','2'=>'#ffffff','3'=>'yellow','4'=>'#81d4fa','5'=>'#81d4fa','6'=>'#f46a6a','7'=>'#f46a6a');
				$css_bg = "background:".@$arr_color[$value->statusPackingRate];
				$html .= '	<tr class="collapseExample'.$value->org_id.' show" style="vertical-align: middle;'.$css_bg.'"> ';
				$html .= '	<td class="text-center" style="width:6rem;">'.$this->num.'</td>';
				$html .= '	<td scope="row"> '.$positionTxt.'</td>'; //ชื่อตำแหน่งใน กอ.รมน./>ชื่อตำแหน่งในการบริหาร
                $html .= '	<td>'.$personalTypeTxt.'</td>';
				$html .= '	<td><div class="dhx_demo-active">'.$rankTxt.$rankToTxt.'</div></td>'; //ชั้นยศ
				$html .= '	<td class="text-center">'.$positionNumberTxt.'</td>'; //ตำแหน่งเลขที่

				if($value->mId != ''){
					$codePrefixTxt = !empty($value->codePrefix)?$codePrefixShort[$value->codePrefix]:'-';
					$html .= '	<td>'.$codePrefixTxt.'</td>';//ยศ
					$html .= '	<td>';
					$html .= $fullName;
					$html .= '	</td>';//ชื่อ-สกุล
					$html .= '	<td>'.$personalPositionCivilianTxt.'</td>';//ตำแหน่งและสังกัดปกติ
					
				}else{
					$html .= '	<td></td>';//ยศ
					$html .= '	<td>';
					$html .= '		<div class="dhx_demo-danger">-- ว่าง --</div>';
					$html .= '	</td>';//ชื่อ-สกุล
					$html .= '	<td></td>';//ตำแหน่งและสังกัดปกติ
				}
				$html .= '	<td style="width: 13rem;text-align:center;">'.@$value->directiveBegin.'</td>';
				$html .= '	<td style="width: 13rem;text-align:center;">'.$this->ConvertToThaiDate(@$value->dateBegin,0,0).'</td>';
				$html .= '	<td style="width: 13rem;text-align:center;">'.$this->ConvertToThaiDate(@$value->dateEnd,0,0).'</td>';
				$html .= '	<td style="width: 13rem;text-align:center;">'.@$value->directiveRetire.'</td>';
				$html .= '	<td style="width: 13rem;text-align:center;">'.$this->ConvertToThaiDate(@$value->dateRetire,0,0).'</td>';
				$html .= '	<td style="width: 13rem;text-align:center;">';
				// $html .= $value->statusPackingRate;

				if($value->mId != ''){
					//รออกคำสั่ง
					if($value->statusPackingRate == '3'){
						$html .= '			<div class="col-auto pe-md-0">';
						$html .= '				<div class="form-group mb-0">';
						$html .= '					<input type="checkbox" class="custom-control-input" data-line="'.$value->mId.'" id="checkBoxReq'.$value->mId.'" name="checkBoxReq" value="'.$value->mId.'">';
						$html .= '					</button>';
						$html .= '				</div>';
						$html .= '			</div>';
					}

					if($value->statusPackingRate == '1'){
						$html .= '			<div class="col-auto pe-md-0">';
						$html .= '				<div class="form-group mb-0">';
						// $html .= '					<button class="btn  btn-danger w-xs btn_distribute" data-bs-toggle="modal" data-bs-target="#distributeModal" onclick="checkDistribute(\''.$value->mId.'\',\''.$rankTxt.'\',\''.$fullName.'\',\''.$personalPositionCivilianTxt.'\',\''.$typeForce.'\')">';
						// $html .= '					<button class="btn  btn-danger w-xs" onclick="checkRetire(\''.$value->mId.'\')">';
						// $html .= '						<i class="mdi mdi-close-circle-outline"></i>&nbsp;พ้น';
						// $html .= '					</button>';
						$html .= '					<input type="checkbox" class="custom-control-input" data-line="'.$value->mId.'" id="checkBoxRetire'.$value->mId.'" name="checkBoxRetire" value="'.$value->mId.'">';
						$html .= '				</div>';
						$html .= '			</div>';
					}

					if($value->statusPackingRate == '2'){
						$html .= '			<div class="col-auto pe-md-0">';
						$html .= '				<div class="form-group mb-0">';
						$html .= '					<button class="btn  btn-primary w-md btn_search" data-bs-toggle="modal" data-bs-target="#searchModal" onclick="checkSearch('.$value->positionMapID.','.$typeForce.')">';
						$html .= '						<i class="mdi mdi-plus-circle-outline"></i>&nbsp;บรรจุอัตรา';
						$html .= '					</button>';
						$html .= '				</div>';
						$html .= '			</div>';
					}
				}else{
					$html .= '			<div class="col-auto pe-md-0">';
					$html .= '				<div class="form-group mb-0">';
					$html .= '					<button class="btn  btn-primary w-md btn_search" data-bs-toggle="modal" data-bs-target="#searchModal" onclick="checkSearch('.$value->positionMapID.','.$typeForce.')">';
					$html .= '						<i class="mdi mdi-plus-circle-outline"></i>&nbsp;บรรจุอัตรา';
					$html .= '					</button>';
					$html .= '				</div>';
					$html .= '			</div>';
				}
				$html .= '	</td>';
				$html .= '</tr>';
			}
		}
		return $html;
	}

    public function loopTreeListSub($org_id,$org_profile_id,$html,$root){
        
		$this->select('*');
		$this->where('org_profile_id',$org_profile_id);
		$this->where('org_parent',$org_id);
		$this->orderBy('order_no','ASC');
		$root+=1;
		$data = $this->get()->getResult();
		// echo '<pre>'; print_r($data); echo '</pre>'; exit;
			if(count($data)>0){
				foreach( $data as $key => $value ){
					
					$name = $value->org_name;
					$detail = $this->getOrganizeDetail($value->org_id);
					$hasParent = $this->hasParent($value->org_id,$org_profile_id);
					$icon = ($detail != '')?'<i class="fas fa-angle-down"></i>':'';
					$cls = 'collapseExample'.$value->org_id;
					$html .= '<tr>';
					$html .= '	<td colspan="14" class="line_bar-'.$root.'">';
					$html .= '		<div class="ms-0 d-inline custom-code bar-'.$root.'">';
					$html .= '<a class="btn btn-default" data-bs-toggle="collapse"
									href=".'.$cls.'" aria-expanded="false" aria-controls="'.$cls.'">
									'.str_repeat('&nbsp;&nbsp;',$root).$icon.'&nbsp;&nbsp;'.$name.'
								</a>';

					$html .= '			<div class="float-end">';
					
					if($detail != ''){
						$html .= '				<button class="btn  btn-danger w-xs" onclick="checkRetire(\''.$value->org_id.'\')">';
						$html .= '					<i class="mdi mdi-close-circle-outline"></i>&nbsp;ร้องขออกคำสั่งพ้น';
						$html .= '				</button>';

						$html .= '				<button class="btn btn-success w-md btn_search" onclick="checkRequest(\''.$value->org_id.'\')">';
						$html .= '					<i class="mdi mdi-plus-circle-outline"></i>&nbsp;ร้องขออกคำสั่ง';
						$html .= '				</button>';
					}
					
					$html .= '			</div>';
					$html .= '		</div>';
					$html .= '	</td>';
					$html .= '</tr>';
					$html .=  $detail;
					$html .= $this->loopTreeListSub($value->org_id,$org_profile_id,'',$root);
				}
		}
		return $html;
	}

	public function hasParent($org_id,$org_profile_id)
	{
		$this->selectCount('org_id');
		$this->where('org_profile_id',$org_profile_id);
		$this->where('org_parent',$org_id);
		if ($this->countAllResults() > 0) {
			return true;
		  } else {
			return false;
		  } 
	}

	public function getTreeList($org_profile_id,$org_id,$html)
	{
		$this->select('*');
		$this->where('org_profile_id',$org_profile_id);
		$this->where('org_parent',$org_id);
		$this->where('profileType','1');  // 1=กอ.รมน.
		// $this->from('tree');
		$this->orderBy('order_no','ASC');
		$data = $this->get()->getResult();

		foreach( $data as $key => $value ){
			$name = $value->org_name;
			$html .= '<tr>';
			$html .= '	<td colspan="14" class="line_bar">';
			$html .= '		<div class="ms-0 d-inline custom-code bar-1">';
			$html .= ' 			<span>'.$name.'</span>';
			$html .= '			<div class="float-end">';
			$html .= '			</div>';
			$html .= '		</div>';
			$html .= '	</td>';
			$html .= '</tr>';
			$html .= $this->loopTreeListSub($value->org_id,$org_profile_id,'',1);
		}

		return $html;
	}

	function ConvertToThaiDate($value,$short='1',$need_time='1',$need_time_second='0') {
		$date_arr = explode(' ', $value);
		$date = $date_arr[0];
		if(isset($date_arr[1])){
			$time = $date_arr[1];
		}else{
			$time = '';
		}

		$value = $date;
		if($value!="0000-00-00" && $value !='') {
			$x=explode("-",$value);
			if($short==false)
				$arrMM=array(1=>"มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
			else
				$arrMM=array(1=>"ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
			if($need_time=='1'){
				if($need_time_second == '1'){
					$time_format = $time!=''?date('H:i:s น.',strtotime($time)):'';
				}else{
					$time_format = $time!=''?date('H:i น.',strtotime($time)):'';
				}
			}else{
				$time_format = '';
			}

			return (int)$x[2]." ".$arrMM[(int)$x[1]]." ".($x[0]>2500?$x[0]:$x[0]+543)." ".$time_format;
		} else
			return "";
	}

	public function org_full_name($org_id,$org_profile_id,$set_split=''){
		$text_split = ($set_split == '')?" ":$set_split;
		$this->select('*');
		$this->where('org_profile_id',$org_profile_id);
		$this->where('org_id',$org_id);
		$this->orderBy('order_no','ASC');
		$data = $this->get()->getResult();
		$name = '';
			if(count($data)>0){
				foreach( $data as $key => $value ){
					$org_name = ($value->org_short_name != '')?$value->org_short_name:$value->org_name;
					$name .= $org_name.$text_split;
					$name .= $this->org_full_name($value->org_parent,$org_profile_id,$set_split);
				}
		}
		return $name;
	}

    public function getOfficerTreeList($org_profile_id,$org_id,$html, $profileType = '1')
    {
        $this->select('*');
        $this->where('org_profile_id',$org_profile_id);
        $this->where('org_parent',$org_id);
        $this->where('profileType',$profileType);  // 3=สบค.กอ.รมน.
        // $this->from('tree');
        $this->orderBy('order_no','ASC');
        $data = $this->get()->getResult();

        foreach( $data as $key => $value ){
            $name = $value->org_name;
            $html .= '<tr>';
            $html .= '	<td colspan="14" class="line_bar">';
            $html .= '		<div class="ms-0 d-inline custom-code bar-1">';
            $html .= ' 			<span>'.$name.'</span>';
            $html .= '			<div class="float-end">';
            $html .= '			</div>';
            $html .= '		</div>';
            $html .= '	</td>';
            $html .= '</tr>';
            $html .= $this->loopOfficerTreeListSub($value->org_id,$org_profile_id,'',1, $profileType);
        }

        return $html;
    }

    private function loopOfficerTreeListSub($org_id,$org_profile_id,$html,$root, $profileType = '1'){

        $this->select('*');
        $this->where('org_profile_id',$org_profile_id);
        $this->where('org_parent',$org_id);
        $this->orderBy('order_no','ASC');
        $root+=1;
        $data = $this->get()->getResult();
        // echo '<pre>'; print_r($data); echo '</pre>'; exit;
        if(count($data)>0){
            foreach( $data as $key => $value ){

                $name = $value->org_name;
                $detail = $this->getOfficerOrganizeDetail($value->org_id, $profileType);
                $hasParent = $this->hasParent($value->org_id,$org_profile_id);
                $icon = ($detail != '')?'<i class="fas fa-angle-down"></i>':'';
                $cls = 'collapseExample'.$value->org_id;
                $html .= '<tr>';
                $html .= '	<td colspan="14" class="line_bar-'.$root.'">';
                $html .= '		<div class="ms-0 d-inline custom-code bar-'.$root.'">';
                $html .= '<a class="btn btn-default" data-bs-toggle="collapse"
									href=".'.$cls.'" aria-expanded="false" aria-controls="'.$cls.'">
									'.str_repeat('&nbsp;&nbsp;',$root).$icon.'&nbsp;&nbsp;'.$name.'
								</a>';

                $html .= '			<div class="float-end">';

                if($detail != ''){
                    $html .= '				<button class="btn  btn-danger w-xs" onclick="checkRetire(\''.$value->org_id.'\')">';
                    $html .= '					<i class="mdi mdi-close-circle-outline"></i>&nbsp;ร้องขออกคำสั่งพ้น';
                    $html .= '				</button>';

                    $html .= '				<button class="btn btn-success w-md btn_search" onclick="checkRequest(\''.$value->org_id.'\')">';
                    $html .= '					<i class="mdi mdi-plus-circle-outline"></i>&nbsp;ร้องขออกคำสั่ง';
                    $html .= '				</button>';
                }

                $html .= '			</div>';
                $html .= '		</div>';
                $html .= '	</td>';
                $html .= '</tr>';
                $html .=  $detail;
                $html .= $this->loopOfficerTreeListSub($value->org_id,$org_profile_id,'',$root);
            }
        }
        return $html;
    }

    private function getOfficerOrganizeDetail($org_id, $profileType = '3')
    {
        $typeForce = 2;

        $db = db_connect();
        $builder = $db->table('DataPositionMapOrganize AS t1');
        $builder->select('t1.*,t2.mId,t3.firstName,t3.lastName,t3.isocPosition,t3.codePrefix,t3.positionCivilianID AS personalPositionCivilianID,t2.statusPackingRate,t4.directiveNo AS directiveBegin,t2.dateBegin,t2.dateEnd,t5.directiveNo AS directiveRetire,t2.dateRetire');
        $builder->join("DataPersonalForcesMap AS t2","t1.positionMapID = t2.positionMapID AND t2.typeForce = '{$typeForce}' AND t2.statusPackingRate != '2'","left");
        $builder->join("DataPersonalForces AS t3","t2.fid= t3.fid","left");
        $builder->join("DataPersonalForcesMapHead AS t4","t2.hID = t4.id AND t4.directiveType = 1","left");
        $builder->join("DataPersonalForcesMapHead AS t5","t2.hIDRetire = t5.id AND t5.directiveType = 2","left");
        $builder->where("t1.org_id = '{$org_id}' AND t1.profileType = '{$profileType}'");
        $builder->orderBy("t1.org_id ASC,t1.positionMapID ASC");
        $result = $builder->get()->getResult();
        // echo $db->getLastQuery(); exit;
        $html = '';
        $position = $this->generalModel->getPositionList();
        $personalType = $this->generalModel->getPersonalType();
        $positionGroup = $this->generalModel->getPositionGroupList();
        $positionCivilian = $this->generalModel->getPositionCivilianList();
        $positionCivilianGroup = $this->generalModel->getPositionCivilianGroupList();
        $rank = $this->generalModel->getPositionRankList();
        $rankShort = $this->generalModel->getPositionRankShortList();
        $codePrefixShort = $this->generalModel->getcodePrefixShort();

        if(count($result)>0){
            foreach( $result as $key => $value ){
                $this->num++;
                $positionTxt = $position[$value->positionID];
                $personalTypeTxt = $personalType[$value->positionType];
                $positionGroupTxt = !empty($value->positionGroupID)?$positionGroup[$value->positionGroupID]:'-';
                $positionCivilianTxt = !empty($value->positionCivilianID)?$positionCivilian[$value->positionCivilianID]:'-- --';
                $positionCivilianGroupTxt = !empty($value->positionCivilianGroupID)?$positionCivilianGroup[$value->positionCivilianGroupID]:'-';
                $rankTxt = !empty($value->rankID)?$rankShort[$value->rankID]:'-';
                $rankToTxt = !empty($value->rankIDTo)?' - '.$rankShort[$value->rankIDTo]:'';
                $positionNumberTxt = $value->positionNumber;
                $fullName = $value->firstName.' '.$value->lastName;
                $personalPositionCivilianTxt = !empty($value->personalPositionCivilianID)?$positionCivilian[$value->personalPositionCivilianID]:'';

                $arr_color = array('1'=>'#ffffff','2'=>'#ffffff','3'=>'yellow','4'=>'#81d4fa','5'=>'#81d4fa','6'=>'#f46a6a','7'=>'#f46a6a');
                $css_bg = "background:".@$arr_color[$value->statusPackingRate];
                $html .= '	<tr class="collapseExample'.$value->org_id.' show" style="vertical-align: middle;'.$css_bg.'"> ';
                $html .= '	<td class="text-center">'.$positionNumberTxt.'</td>'; //ตำแหน่งเลขที่
                //$html .= '	<td class="text-center" style="width:6rem;">'.$this->num.'</td>';
                $html .= '	<td scope="row"> '.$positionTxt.'</td>'; //ชื่อตำแหน่งใน กอ.รมน./>ชื่อตำแหน่งในการบริหาร
                //$html .= '	<td><div class="dhx_demo-active">'.$rankTxt.$rankToTxt.'</div></td>'; //ชั้นยศ


                if($value->mId != ''){
                    $codePrefixTxt = !empty($value->codePrefix)?$codePrefixShort[$value->codePrefix]:'-';
                    //$html .= '	<td>'.$codePrefixTxt.'</td>';//ยศ
                    $html .= '	<td>';
                    $html .= $fullName;
                    $html .= '	</td>';//ชื่อ-สกุล
                    $html .= '	<td>'.$personalPositionCivilianTxt.'</td>';//ตำแหน่งและสังกัดปกติ

                }else{
                    //$html .= '	<td></td>';//ยศ
                    $html .= '	<td>';
                    $html .= '		<div class="dhx_demo-danger">-- ว่าง --</div>';
                    $html .= '	</td>';//ชื่อ-สกุล
                    $html .= '	<td></td>';//ตำแหน่งและสังกัดปกติ
                }
                $html .= '	<td>'.$personalTypeTxt.'</td>';
                $html .= '	<td style="width: 13rem;text-align:center;">'.@$value->directiveBegin.'</td>';
                //$html .= '	<td style="width: 13rem;text-align:center;">'.$this->ConvertToThaiDate(@$value->dateBegin,0,0).'</td>';
                //$html .= '	<td style="width: 13rem;text-align:center;">'.$this->ConvertToThaiDate(@$value->dateEnd,0,0).'</td>';
                //$html .= '	<td style="width: 13rem;text-align:center;">'.@$value->directiveRetire.'</td>';
                //$html .= '	<td style="width: 13rem;text-align:center;">'.$this->ConvertToThaiDate(@$value->dateRetire,0,0).'</td>';
                 $html .= '	<td style="width: 13rem;text-align:center;">';
                 $html .= $value->statusPackingRate;

                if($value->mId != ''){
                    //รออกคำสั่ง
                    if($value->statusPackingRate == '3'){
                        $html .= '			<div class="col-auto pe-md-0">';
                        $html .= '				<div class="form-group mb-0">';
                        $html .= '					<input type="checkbox" class="custom-control-input" data-line="'.$value->mId.'" id="checkBoxReq'.$value->mId.'" name="checkBoxReq" value="'.$value->mId.'">';
                        $html .= '					</button>';
                        $html .= '				</div>';
                        $html .= '			</div>';
                    }

                    if($value->statusPackingRate == '1'){
                        $html .= '			<div class="col-auto pe-md-0">';
                        $html .= '				<div class="form-group mb-0">';
                        // $html .= '					<button class="btn  btn-danger w-xs btn_distribute" data-bs-toggle="modal" data-bs-target="#distributeModal" onclick="checkDistribute(\''.$value->mId.'\',\''.$rankTxt.'\',\''.$fullName.'\',\''.$personalPositionCivilianTxt.'\',\''.$typeForce.'\')">';
                        // $html .= '					<button class="btn  btn-danger w-xs" onclick="checkRetire(\''.$value->mId.'\')">';
                        // $html .= '						<i class="mdi mdi-close-circle-outline"></i>&nbsp;พ้น';
                        // $html .= '					</button>';
                        $html .= '					<input type="checkbox" class="custom-control-input" data-line="'.$value->mId.'" id="checkBoxRetire'.$value->mId.'" name="checkBoxRetire" value="'.$value->mId.'">';
                        $html .= '				</div>';
                        $html .= '			</div>';
                    }

                    if($value->statusPackingRate == '2'){
                        $html .= '			<div class="col-auto pe-md-0">';
                        $html .= '				<div class="form-group mb-0">';
                        $html .= '					<button class="btn  btn-primary w-md btn_search" data-bs-toggle="modal" data-bs-target="#searchModal" onclick="checkSearch('.$value->positionMapID.','.$typeForce.')">';
                        $html .= '						<i class="mdi mdi-plus-circle-outline"></i>&nbsp;บรรจุอัตรา';
                        $html .= '					</button>';
                        $html .= '				</div>';
                        $html .= '			</div>';
                    }
                }else{
                    $html .= '			<div class="col-auto pe-md-0">';
                    $html .= '				<div class="form-group mb-0">';
                    $html .= '					<button class="btn  btn-primary w-md btn_search" data-bs-toggle="modal" data-bs-target="#searchModal" onclick="checkSearch('.$value->positionMapID.','.$typeForce.')">';
                    $html .= '						<i class="mdi mdi-plus-circle-outline"></i>&nbsp;บรรจุอัตรา';
                    $html .= '					</button>';
                    $html .= '				</div>';
                    $html .= '			</div>';
                }
                $html .= '	</td>';
                $html .= '</tr>';
            }
        }
        return $html;
    }

}
