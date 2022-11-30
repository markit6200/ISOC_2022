<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="/" class="logo logo-dark">
            <span class="logo-sm">
                <img src="<?php echo base_url() ?>/assets/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?php echo base_url() ?>/assets/images/logo-dark.png" alt="" height="20">
                
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
            <div class="dropdown d-inline-block">
            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class="rounded-circle header-profile-user" src="<?php echo base_url() ?>/assets/images/users/avatar-4.jpg" alt="Header Avatar">
                <span class="d-none d-xl-inline-block ms-1 fw-medium font-size-15">Marcus</span>
                <i class="uil-angle-down d-none d-xl-inline-block font-size-15"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <!-- item-->
                <a class="dropdown-item" href="<?php echo base_url() ?>/auth/log_out"><i class="uil uil-sign-out-alt font-size-18 align-middle me-1 text-muted"></i> <span class="align-middle"><?= lang('Files.Sign out') ?></span></a>
            </div>
            </div>
            <div class="dropdown d-inline-block">
            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="uil-bell"></i>
                        <span class="badge bg-danger rounded-pill">3</span>
                    </button>
            <div class="dropdown-menu dropdown-menu-lg p-0 mb-5"
                 aria-labelledby="page-header-notifications-dropdown">
                <div class="p-3">
                    <div class="row align-items-center">
                        <div class="col">
                            <h5 class="m-0 font-size-16"> <?= lang('Files.Notifications') ?> </h5>
                        </div>
                        <div class="col-auto">
                            <a href="#!" class="small"> <?= lang('Files.Mark all as read') ?></a>
                        </div>
                    </div>
                </div>
                <div data-simplebar style="max-height: 230px;">
                    <a href="" class="text-reset notification-item">
                        <div class="d-flex align-items-start">
                            <div class="avatar-xs me-3">
                                    <span class="avatar-title bg-primary rounded-circle font-size-16">
                                        <i class="uil-shopping-basket"></i>
                                    </span>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mt-0 mb-1"><?= lang('Files.Your order is placed') ?></h6>
                                <div class="font-size-12 text-muted">
                                    <p class="mb-1"><?= lang('Files.If several languages coalesce the grammar') ?></p>
                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <?= lang('Files.3 min ago') ?></p>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="" class="text-reset notification-item">
                        <div class="d-flex align-items-start">
                            <img src="/assets/images/users/avatar-3.jpg"
                                 class="me-3 rounded-circle avatar-xs" alt="user-pic">
                            <div class="flex-grow-1">
                                <h6 class="mt-0 mb-1">James Lemire</h6>
                                <div class="font-size-12 text-muted">
                                    <p class="mb-1"><?= lang('Files.It will seem like simplified English') ?></p>
                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <?= lang('Files.1 hours ago') ?></p>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="" class="text-reset notification-item">
                        <div class="d-flex align-items-start">
                            <div class="avatar-xs me-3">
                                    <span class="avatar-title bg-success rounded-circle font-size-16">
                                        <i class="uil-truck"></i>
                                    </span>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mt-0 mb-1"><?= lang('Files.Your item is shipped') ?></h6>
                                <div class="font-size-12 text-muted">
                                    <p class="mb-1"><?= lang('Files.If several languages coalesce the grammar') ?></p>
                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <?= lang('Files.3 min ago') ?></p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="p-2 border-top d-grid">
                    <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                        <i class="uil-arrow-circle-right me-1"></i> <?= lang('Files.View More') ?>
                    </a>
                </div>
            </div>
            </div>
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
                    <a href="<?php echo base_url('OrganizeProfile') ?>" class="waves-effect">
                        <i class="uil-calender"></i>
                        <span>ระบบโครงสร้างตามอัตราช่วยราชการ กอ.รมน.</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url('PalaceByAssist?typeForce=1') ?>" class="waves-effect">
                        <i class="uil-calender"></i>
                        <span>ระบบทำเนียบกำลังพลตามอัตราช่วยราชการ กอ.รมน.</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url('PersonalManagement') ?>" class="waves-effect">
                        <i class="uil-calender"></i>
                        <span>ข้อมูลกำลังพล</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url('ReportPalaceByAssist') ?>" class="waves-effect">
                        <i class="uil-calender"></i>
                        <span>รายงานคำสั่ง/ขอช่วยราชการ</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url('ReportPalaceByAssist/reportStatusSummary') ?>" class="waves-effect">
                        <i class="uil-calender"></i>
                        <span>รายงานข้อมูลสรุปสถานภาพกำลังพล</span>
                    </a>
                </li>

                <li class="menu-title">ระบบย่อย</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-calender"></i>
                        <span>ระบบทำเนียบกำลังพลตามอัตรา  สง.ปรมน.ทบ., สน.ปรมน.จว.</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="<?php echo base_url('StructureByAssistRatePRMN') ?>" class="waves-effect">
                                <i class="uil-calender"></i>
                                <span>ระบบโครงสร้างตามอัตราช่วยราชการ สง.ปรมน.ทบ., สน.ปรมน.จว.</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('PalaceByAssistPRMN') ?>" class="waves-effect">
                                <i class="uil-calender"></i>
                                <span>ระบบทำเนียบกำลังพลตามอัตรา  สง.ปรมน.ทบ., สน.ปรมน.จว.</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('PersonalManagementPRMN') ?>" class="waves-effect">
                                <i class="uil-calender"></i>
                                <span>ข้อมูลกำลังพล</span>
                            </a>
                        </li>
                    </ul>
                </li>

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
                        <li><a href="<?php echo base_url('OfficerRecords') ?>">ระบบทำเนียบรายชื่อข้าราชการพลเรือน/ลูกจ้างชั่วคราว/พนักงานราชการ</a></li>
                        <li><a href="<?php echo base_url('OfficerManagement') ?>">ข้อมูลข้าราชการพลเรือน</a></li>
                        <li><a href="<?php echo base_url('OfficerManagement') ?>">ข้อมูลลูกจ้างชั่วคราว</a></li>
                        <li><a href="<?php echo base_url('OfficerManagement') ?>">ข้อมูลพนักงานราชการ</a></li>
                    </ul>
                </li>

                <li ><a href="javascript: void(0);" class="waves-effect">บันทึกข้อมูลบำเหน็จ ข้าราชการทหาร ตำรวจ</a></li>
                <li ><a href="javascript: void(0);" class="waves-effect">บันทึกข้อมูลบำเหน็จ ข้าราชการพลเรือน</a></li>
                <li ><a href="javascript: void(0);" class="waves-effect">บันทึกเครื่องราชอิสริยาภรณ์ของข้าราชการพลเรือน และพนักงานราชการ</a></li>
                <li ><a href="javascript: void(0);" class="waves-effect">ขอรับสิทธิตามระเบียบ บ.ท.ช.</a></li>
                <li ><a href="javascript: void(0);" class="waves-effect">บันทึกเหรียญพิทักษ์เสรีชน</a></li>
                <li ><a href="<?php echo base_url('PersonalWaitrecruit') ?>" class="waves-effect">บันทึกรายชื่อผู้รอบรรจุ</a></li>
                <li ><a href="javascript: void(0);" class="waves-effect">บันทึกการทำบัตรผ่าน (สขว.กอ.รมน.)</a></li>

                <li class="menu-title"><i class="fas fa-layer-group"></i> บริหารจัดการระบบ</li>
                <li><a href="<?php echo base_url('UserManager') ?>" class="waves-effect">กำหนดสิทธิเข้าใช้งานระบบ</a></li>
                <li><a href="#" class="waves-effect">บัญชีอัตราเงินเดือน</a></li>
                <li><a href="javascript: void(0);" class="has-arrow waves-effect">จัดการข้อมูลพื้นฐาน</a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="/OrganizeProfile">โปรไฟล์โครงสร้างผังองค์กร</a></li>
                    </ul>
                </li>
                <li><a href="#" class="waves-effect">คู่มือการใช้งาน</a></li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
