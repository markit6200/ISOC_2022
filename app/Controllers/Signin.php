<?php 

namespace App\Controllers;  
use CodeIgniter\Controller;
use App\Models\UsersModel;
  

class Signin extends Controller
{
    public function index()
    {
        helper(['form']);
        echo view('auth');
    } 
  
    public function loginAuth()
    {
        $session = session();

        $userModel = new UsersModel();

        $username = $this->request->getVar('username');
        $password = $this->request->getVar('userpassword');
        
        $data = $userModel->where('username', $username)->first();
        
        if($data){
            $pass = $data['pwd'];
            $passw = md5($password);
//            $authenticatePassword = password_verify($passw, $pass);
            $authenticatePassword = FALSE;
            if($pass == $passw){
                $authenticatePassword = TRUE;
            }
            if($authenticatePassword){
                $data2 = $userModel->getPermission($data['runid']);
                $data_app = array();
                $data_group_permission = array();
                $date_now = date('Y-m-d');
                foreach($data2 as $key => $val){
                    if($val->date_start <= $date_now && $val->date_end >= $date_now){
                        $data_app[$val->appid]['appname'] = $val->appname;
                        $data_app[$val->appid]['group'][$val->gid]['group_name'] = $val->NLABEL;
                        $data_app[$val->appid]['group'][$val->gid]['permission'] = $val->permission;
                        $data_app[$val->appid]['group'][$val->gid]['date_start'] = $val->date_start;
                        $data_app[$val->appid]['group'][$val->gid]['date_end'] = $val->date_end;
                        $data_app[$val->appid]['group'][$val->gid]['time_start'] = $val->time_start;
                        $data_app[$val->appid]['group'][$val->gid]['time_end'] = $val->time_end;
                    }
                }
                $ses_data = [
                    'userId' => $data['runid'],
                    'prename' => $data['prename_th'],
                    'name' => $data['name_th'],
                    'surname' => $data['surname_th'],
                    'email' => $data['email'],
                    'office' => $data['office'],
                    'data_app' => $data_app,
                    'isLoggedIn' => TRUE
                ];

                $session->set($ses_data);

                return redirect()->to('/OrganizeProfile');
//                echo '<pre>';print_r($ses_data);echo '</pre>';
            }else{
                $session->setFlashdata('msg', 'รหัสผ่านไม่ถูกต้อง');
                return redirect()->to('/auth');
            }

        }else{
            $session->setFlashdata('msg', 'ชื่อผู้ใช้นี้ไม่มีในระบบ');
            return redirect()->to('/auth');
        }
    }
}
