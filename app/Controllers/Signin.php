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
                $ses_data = [
                    'id' => $data['runid'],
                    'prename' => $data['prename_th'],
                    'name' => $data['name_th'],
                    'surname' => $data['surname_th'],
                    'email' => $data['email'],
                    'office' => $data['office'],
                    'isLoggedIn' => TRUE
                ];

                $session->set($ses_data);
                return redirect()->to('/OrganizeProfile');
            
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
