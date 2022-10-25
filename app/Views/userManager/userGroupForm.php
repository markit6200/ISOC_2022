<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <span class="h4">เพิ่มข้อมูลกลุ่มผู้ใช้งาน</span>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="col-md-12">
                    <div class="row mt-2">
                        <label for="" class="col-md-4 form-label"> ชื่อกลุ่มงาน</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="NLABEL" />
                        </div>
                    </div>
                    <div class="row mt-2">
                        <label for="" class="col-md-4 form-label">หน่วยงาน</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="department_name" />
                        </div>
                    </div>
                    <div class="row mt-2">
                        <label for="" class="col-md-4 form-label">ชื่อกลุ่มงาน (ภาษาอังกฤษ) </label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="NLABEL_ENG" />
                        </div>
                    </div>
                    <div class="row mt-2">
                        <label for="" class="col-md-4 form-label">หน่วยงาน (ภาษาอังกฤษ) </label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="department_name_eng" />
                        </div>
                    </div>
                    <div class="row mt-2">
                        <label for="" class="col-md-4 form-label">ที่ตั้ง (ภาษาไทย)</label>
                        <div class="col-md-8">
                            <textarea class="form-control" name="address"></textarea>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <label for="" class="col-md-4 form-label">ที่ตั้ง (ภาษาอังกฤษ)</label>
                        <div class="col-md-8">
                            <textarea class="form-control" name="address_en"></textarea>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <label for="" class="col-md-4 form-label">เบอร์โทรศัพท์</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="tel1" />
                        </div>
                    </div>
                    <div class="row mt-2">
                        <label for="" class="col-md-4 form-label">อีเมล</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="email" />
                        </div>
                    </div>
                    <div class="row mt-2">
                        <label for="" class="col-md-4 form-label">เว็บไซต์</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="website" />
                        </div>
                    </div>
                    <div class="row mt-2">
                        <label for="" class="col-md-4 form-label">สถานะการอนุญาตให้เข้าใช้ระบบ</label>
                        <div class="col-md-8">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status_login" id="active" value="1" checked>
                                <label class="form-check-label" for="active">
                                    ใช้งาน
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status_login" id="deactive" value="0">
                                <label class="form-check-label" for="deactive">
                                    ไม่ใช้งาน
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <label for="" class="col-md-4 form-label">วัน/เดือน/ปี เริ่มต้น การเข้าใช้งานระบบ</label>
                        <div class="col-md-8">
                            <input type="date" class="form-control" name="date_start" />
                        </div>
                    </div>
                    <div class="row mt-2">
                        <label for="" class="col-md-4 form-label">วัน/เดือน/ปี สิ้นสุด การเข้าใช้งานระบบ</label>
                        <div class="col-md-8">
                            <input type="date" class="form-control" name="date_end" />
                        </div>
                    </div>
                    <div class="row mt-2">
                        <label for="" class="col-md-4 form-label">เวลา เริ่มต้น</label>
                        <div class="col-md-8">
                            <input type="time" class="form-control" name="time_start"/>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <label for="" class="col-md-4 form-label">เวลา สิ้นสุด</label>
                        <div class="col-md-8">
                            <input type="time" class="form-control" name="time_end"/>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <label for="" class="col-md-4 form-label">รูปสัญลักษณ์ประจำหน่วยงาน</label>
                        <div class="col-md-8">
                            <input type="file" class="form-control" name="banner" />
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12 text-center">
                            <input type="submit" value="บันทึก" class="btn btn-success">
                            <a class="btn btn-danger">ยกเลิก</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>