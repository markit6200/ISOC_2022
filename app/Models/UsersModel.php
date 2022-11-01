<?php namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $DBGroup = ('usermanager');
    protected $table      = 'login';
	protected $primaryKey = 'runid';
    protected $allowedFields = ['runid','idcard','username','pwd','private_key','id','prename_th','name_th','surname_th','prename_en','name_en','surname_en','office','office_short','office_refid','position_name','pri1','updatetime','ampid','org_id','address','telno','email','flag_admin','reset_status','login_image','owner_department_id','gid','comment','sex','birthday','status','refid_info','staff_type','group_secter','moc_id','minitry_id','subminitry_id','flag_autoload','meeting_room_owner','reset_uniqid','pass_change_date',];
    protected $updatedField  = 'updatetime';

    public function getPermission($id){
        $builder = $this->table('login');
        $builder->select('login.runid, usr_main_menu.NLABEL, usr_groupmember.gid, usr_main_menu.date_start, usr_main_menu.date_end, usr_main_menu.time_start, usr_main_menu.time_end, app_authority.appid, app_authority.authority, app_authority.permission, app_list.appname');
        $builder->join('usr_groupmember','usr_groupmember.staffid = login.runid');
        $builder->join('app_authority','app_authority.gid = usr_groupmember.gid');
        $builder->join('app_list','app_list.id = app_authority.appid');
        $builder->join('usr_main_menu','usr_main_menu.NID = usr_groupmember.gid');
        $builder->where('login.runid',$id);
        $builder->orderBy('app_list.app_orderby','ASC');
        $data = array();
        $data = $builder->get()->getResult();
//        $sql = $builder->getCompiledSelect();

        return $data;
    }
}
