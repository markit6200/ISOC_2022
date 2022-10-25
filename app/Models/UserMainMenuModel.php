<?php namespace App\Models;

use CodeIgniter\Model;

class UserMainMenuModel extends Model
{
    protected $DBGroup = ('usermanager');
    protected $table      = 'usr_main_menu';
	protected $primaryKey = 'NID';
    protected $allowedFields = ['NID','PARENT_ID','POSITION','NLABEL','department_name','NVALUE','MTYPE','NLABEL_ENG','department_name_eng','username','pwd','pri1','address','address_eng','url','tel1','tel2','fax','email','website','banner','map','area_id','date_start','date_end','time_start','time_end','status_login','flag_report','group_type','permission_id'];
}
