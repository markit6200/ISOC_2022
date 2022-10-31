<?php namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $DBGroup = ('usermanager');
    protected $table      = 'login';
	protected $primaryKey = 'runid';
    protected $allowedFields = ['runid','idcard','username','pwd','private_key','id','prename_th','name_th','surname_th','prename_en','name_en','surname_en','office','office_short','office_refid','position_name','pri1','updatetime','ampid','org_id','address','telno','email','flag_admin','reset_status','login_image','owner_department_id','gid','comment','sex','birthday','status','refid_info','staff_type','group_secter','moc_id','minitry_id','subminitry_id','flag_autoload','meeting_room_owner','reset_uniqid','pass_change_date',];
    protected $updatedField  = 'updatetime';
}
