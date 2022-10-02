<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="/" class="logo logo-dark">
            <span class="logo-sm">
                <img src="<?php echo base_url() ?>assets/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?php echo base_url() ?>assets/images/logo-dark.png" alt="" height="20">
                
            </span>
        </a>

        <a href="/" class=" logo-light">
            <!-- <span class="logo-sm">
                <img src="assets/images/logo-sm.png" alt="" height="22">
            </span> -->
            <span class="logo-lg">
                <!-- <img src="assets/images/logo-light.png" alt="" height="20"> -->
                ระบบบริหารจัดการกำลังพล กอ.รมน.
            </span>
        </a>
        <div>
        
            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class="rounded-circle header-profile-user" src="<?php echo base_url() ?>/assets/images/users/avatar-4.jpg" alt="Header Avatar">
                <span class="d-none d-xl-inline-block ms-1 fw-medium font-size-15">Marcus</span>
                <i class="uil-angle-down d-none d-xl-inline-block font-size-15"></i>
            </button>
            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="uil-bell"></i>
                        <span class="badge bg-danger rounded-pill">3</span>
                    </button>
        </div>
    </div>

    <!-- <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
        <i class="fa fa-fw fa-bars"></i>
    </button> -->
    

    <div data-simplebar class="sidebar-menu-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
               

                <li class="menu-title"><i class="fas fa-layer-group"></i> ระบบหลัก</li>

                <li>
                    <a href="<?php echo base_url('StructureByAssistRate') ?>" class="waves-effect">
                        <i class="uil-calender"></i>
                        <span>ระบบโครงสร้างตามอัตราช่วยราชการ กอ.รมน.</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="waves-effect">
                        <i class="uil-calender"></i>
                        <span>ระบบทำเนียบกำลังพลตามอัตราช่วยราชการ กอ.รมน.</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="waves-effect">
                        <i class="uil-calender"></i>
                        <span>ระบบทำเนียบกำลังพลตามอัตรา  สง.ปรมน.ทบ., สน.ปรมน.จว.</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="waves-effect">
                        <i class="uil-calender"></i>
                        <span>ข้อมูลกำลังพล</span>
                    </a>
                </li>

                <li class="menu-title">ระบบย่อย</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-user-circle"></i>
                        <span>การออกคำสั่ง</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="#">ออกคำสั่งปฏิบัติหน้าที่</a></li>
                        <li><a href="#">ออกคำสั่งพ้นจากหน้าที่</a></li>
                        <li><a href="#">ออกคำสั่งปฏิบัติ/พ้นหน้าที่</a></li>
                        <li><a href="#">แก้ไขคำสั่ง</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-file-alt"></i>
                        <span>หนังสือรับรองเวลาราชการทวีคูณ</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="#">หนังสือรับรองวันทวีคูณ</a></li>
                        <li><a href="#">อัพโหลดสำเนาหนังสือรับรองฯ</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-file-alt"></i>
                        <span>สำเนาหนังสือรับรองเวลาราชการทวีคูณ</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="#">หนังสือรับรองวันทวีคูณ</a></li>
                        <li><a href="#">อัพโหลดสำเนาหนังสือรับรองฯ</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-file-alt"></i>
                        <span>ข้อมูลข้าราชการพลเรือน ลูกจ้างชั่วคราว พนักงานราชการ</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="#">ระบบทำเนียบรายชื่อข้าราชการพลเรือน/ลูกจ้างชั่วคราว/พนักงานราชการ</a></li>
                        <li><a href="#">ข้อมูลข้าราชการพลเรือน</a></li>
                        <li><a href="#">ข้อมูลลูกจ้างชั่วคราว</a></li>
                        <li><a href="#">ข้อมูลพนักงานราชการ</a></li>
                    </ul>
                </li>

                <li ><a href="javascript: void(0);" class="waves-effect">บันทึกข้อมูลบำเหน็จ ข้าราชการทหาร ตำรวจ</a></li>
                <li ><a href="javascript: void(0);" class="waves-effect">บันทึกข้อมูลบำเหน็จ ข้าราชการพลเรือน</a></li>
                <li ><a href="javascript: void(0);" class="waves-effect">บันทึกเครื่องราชอิสริยาภรณ์ของข้าราชการพลเรือน และพนักงานราชการ</a></li>
                <li ><a href="javascript: void(0);" class="waves-effect">ขอรับสิทธิตามระเบียบ บ.ท.ช.</a></li>
                <li ><a href="javascript: void(0);" class="waves-effect">บันทึกเหรียญพิทักษ์เสรีชน</a></li>
                <li ><a href="javascript: void(0);" class="waves-effect">บันทึกรายชื่อผู้รอบรรจุ</a></li>
                <li ><a href="javascript: void(0);" class="waves-effect">บันทึกการทำบัตรผ่าน (สขว.กอ.รมน.)</a></li>

                <li class="menu-title"><i class="fas fa-layer-group"></i> บริหารจัดการระบบ</li>
                <li><a href="#" class="waves-effect">กำหนดสิทธิเข้าใช้งานระบบ</a></li>
                <li><a href="#" class="waves-effect">บัญชีอัตราเงินเดือน</a></li>
                <li><a href="#" class="waves-effect">จัดการข้อมูลพื้นฐาน</a></li>
                <li><a href="#" class="waves-effect">คู่มือการใช้งาน</a></li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->