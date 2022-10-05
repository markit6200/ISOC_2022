<?php namespace App\Models;

use CodeIgniter\Model;

class OrganizeModel extends Model
{
	protected $DBGroup = ('usermanager');
    protected $table      = 'organize_to_profile';
	protected $primaryKey = 'id';

	public function getOrganizeDetail($org_id)
	{
		$db = db_connect();
		$builder = $db->table('DataPositionMapOrganize');
		$builder->where('org_id',$org_id);
		$result = $builder->get()->getResult();
		$html = '';
		if(count($result)>0){
			foreach( $result as $key => $value ){
						$html .= '	<tr class="collapseExample'.$value->org_id.'">';
						$html .= '	<td class="text-center" style="width:6rem;">1</td>';
						$html .= '	<td scope="row"> ผู้อำนวยการสำนัก</td>';
						$html .= '	<td>บริหาร</td>';
						$html .= '	<td><button class="btn btn-primary btn-rounded">-- --</button></td>';
						$html .= '	<td>สูง</td>';
						$html .= '	<td>';
						$html .= '		<div class="dhx_demo-active">พ.อ.(พ.)</div>';
						$html .= '	</td>';

						$html .= '	<td></td>';
						$html .= '	<td style="width: 13rem;text-align:center;">';

						$html .= '		<div class="col-auto pe-md-0 ">';
						$html .= '			<div class="form-group mb-0">';


						$html .= '				<a href="'.base_url('StructureByAssistRate/form/'.$value->org_id.'/'.$value->positionMapID).'" class="btn  btn-warning">';
						$html .= '					<i class="mdi mdi-pencil"></i>&nbsp;แก้ไข';
						$html .= '				</a>';
						$html .= '				<button data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="btn  btn-danger">&nbsp;';


						$html .= '					<i class="mdi mdi-close-circle-outline"></i>&nbsp;ลบ';
						$html .= '				</button>';

						$html .= '			</div>';

						$html .= '		</div>';
						$html .= '	</td>';
						$html .= '</tr>';
			}
		}

		return $html;
	}

    public function loopTreeListSub($org_id,$org_profile_id,$html,$number){
        
		$this->select('*');
		$this->where('org_profile_id',$org_profile_id);
		$this->where('org_parent',$org_id);
		$this->orderBy('order_no','ASC');
		$data = $this->get()->getResult();
			if(count($data)>0){
				foreach( $data as $key => $value ){
					$number = $number+1;
					$name = $value->org_name;
					$html .= '<tr>';
					$html .= '	<td colspan="9" >';
					$html .= '		<div class="ms-0 d-inline">';
					$html .= '<a class="btn btn-default" data-bs-toggle="collapse"
					href=".collapseExample'.$value->org_id.'" aria-expanded="false" aria-controls="collapseExample">
					<i class="fas fa-angle-down"></i>&nbsp;&nbsp;'.$name.'
				</a>';
					// $html .= ' 			<span>'.$name.'</span>';
					$html .= '			<div class="float-end">';
					$html .= "				<a class=\"btn btn-default\" href=\"".base_url('StructureByAssistRate/form/'.$value->org_id)."\">";
					$html .= "					<i class=\"mdi mdi-plus-circle-outline\"></i>&nbsp;เพิ่มตำแหน่ง";
					$html .= '				</a>';
					$html .= '			</div>';
					$html .= '		</div>';
					$html .= '	</td>';
					$html .= '</tr>';
					$html .= $this->getOrganizeDetail($value->org_id);
					$html .= $this->loopTreeListSub($value->org_id,$org_profile_id,'',$number);
				}
		}
		return $html;
	}


	public function getTreeList($org_profile_id,$org_id,$html)
	{
		$this->select('*');
		$this->where('org_profile_id',$org_profile_id);
		$this->where('org_parent',$org_id);
		// $this->from('tree');
		$this->orderBy('order_no','ASC');
		$data = $this->get()->getResult();

		foreach( $data as $key => $value ){
			$name = $value->org_name;
			$html .= '<tr>';
			$html .= '	<td colspan="9" >';
			$html .= '		<div class="ms-0 d-inline">';
			$html .= ' 			<span>'.$name.'</span>';
			$html .= '			<div class="float-end">';
			$html .= "				<a class=\"btn btn-default\" href=\"".base_url('StructureByAssistRate/form/'.$value->org_id)."\">";
			$html .= "					<i class=\"mdi mdi-plus-circle-outline\"></i>&nbsp;เพิ่มตำแหน่ง";
			$html .= '				</a>';
			$html .= '			</div>';
			$html .= '		</div>';
			$html .= '	</td>';
			$html .= '</tr>';
			$html .= $this->loopTreeListSub($value->org_id,$org_profile_id,'',1);
		}

		return $html;
	}

}
