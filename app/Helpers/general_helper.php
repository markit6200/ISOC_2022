<?php

// class General
// {

     function getDayOfWeek($shot_eng='')
    {
        $shorDayOfWeekTH = array(
                                        'Mon'=>'จ.',
                                        'Tue'=>'อ.',
                                        'Wed'=>'พ.',
                                        'Thu'=>'พฤ.',
                                        'Fri'=>'ศ.',
                                        'Sat'=>'ส.',
                                        'Sun'=>'อา.',
                                );

        return @$shorDayOfWeekTH[$shot_eng] ;
    }

      function DBtoThaiDate($d)
    {
        if ($d == "0000-00-00" || $d == "00-00-0000" || $d == "" || is_null($d))
            return "";
        $x = explode("-", $d);
        return ($x[2] . "/" . $x[1] . "/" . (intval($x[0]) + 543));
    }

      function DBtoThaiDateDath($d)
    {
        if ($d == "0000-00-00" || $d == "00-00-0000" || $d == "" || is_null($d))
            return "";
        $x = explode("-", $d);
        return ($x[2] . "-" . $x[1] . "-" . (intval($x[0]) + 543));
    }

      function dateToDB($d)
    {
        if ($d == "")
            return "";
        $x = explode("/", $d);
        return ((intval($x[2])) . "-" . $x[1] . "-" . $x[0]);
    }

      function dateToDBDath($d)
    {
        if ($d == "")
            return "";
        $x = explode("-", $d);
        return ((intval($x[2])) . "-" . $x[1] . "-" . $x[0]);
    }


      function DBToDate($d)
    {
        if ($d == "")
            return "";
        $x = explode("-", $d);
        return ($x[2] . "/" . $x[1] . "/" . ($x[0]));
    }

      function DBToDateDath($d)
    {
        if ($d == "")
            return "";
        $x = explode("-", $d);
        return ($x[2] . "-" . $x[1] . "-" . ($x[0]));
    }


      function ThaitoDBDate($d)
    {
        if ($d == "")
            return "";
        $x = explode("/", $d);
        return ((intval($x[2]) - 543) . "-" . $x[1] . "-" . $x[0]);
    }

      function ThaitoDBDateDath($d)
    {
        if ($d == "")
            return "";
        $x = explode("-", $d);
        return ((intval($x[2]) - 543) . "-" . $x[1] . "-" . $x[0]);
    }


      function dayThai($temp)
    {
        if ($temp != "0000-00-00" && $temp > "") {
            # วัน จ - ศุกร์
            
            $month = array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
            $num = explode("-", $temp);
            if ($num[0] == "0000") {
                $date = "ไม่ระบุ";
            } else {
                if ($num[0] < 2400)
                    $num[0] += 543;
                $date = intval($num[2]) . " " . $month[$num[1] - 1] . " " . $num[0];
            }
        } else {
            $date = "ไม่ระบุ";
        }
        return $date;
    }


      function dayThai2($temp)
    {
        $date = "ไม่ระบุ";

        if ($temp != "0000-00-00" && $temp != '') {
            # วัน จ - ศุกร์
            $dayOfweek = date("D",strtotime($temp));
            $textDayOfWeek = getDayOfWeek($dayOfweek);

            $month = array("ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
            $num = explode("-", $temp);
            if ($num[0] == "0000") {
                $date = "ไม่ระบุ";
            } else {
                if ($num[0] < 2200)
                    $num[0] += 543;
                @$date = $textDayOfWeek." ".intval($num[2]) . " " . $month[$num[1] - 1] . " " . $num[0];
            }
        } else {
            $date = "ไม่ระบุ";
        }
        return $date;
    }


      function dayThai3($temp)
    {
        if ($temp != "0000/00/00" && $temp != '') {
            $month = array("ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
            $num = explode("/", $temp);
            if ($num[2] == "0000") {
                $date = "ไม่ระบุ";
            } else {
                if ($num[2] < 2200)
                    $num[2] += 543;
                $date = intval($num[0]) . " " . $month[$num[1] - 1] . " " . $num[2];
            }
        } else {
            $date = "ไม่ระบุ";
        }
        return $date;
    }

      function dayThai4($temp)
    {
        if ($temp != "0000-00-00" && $temp > "") {
            $month = array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
            $num = explode("-", $temp);
            if ($num[0] == "0000") {
                $date = "ไม่ระบุ";
            } else {
                if ($num[0] < 2400)
                    $num[0] += 543;
                $date = intval($num[2]) . " " . $month[$num[1] - 1] . " พ.ศ. " . $num[0];
            }
        } else {
            $date = "ไม่ระบุ";
        }
        return $date;
    }

      function dayThai5($temp)
    {
        if ($temp != "0000-00-00" && $temp > "") {
            $month = array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
            $num = explode("-", $temp);
            if ($num[0] == "0000") {
                $date = "ไม่ระบุ";
            } else {
                if ($num[0] < 2400)
                    $num[0] += 543;
                $date = $month[$num[1] - 1] . " พ.ศ. " . $num[0];
            }
        } else {
            $date = "ไม่ระบุ";
        }
        return $date;
    }

      function dayThai6($temp)
    {
        $date = "ไม่ระบุ";

        if ($temp != "0000-00-00" && $temp != '') {
            # วัน จ - ศุกร์
            $dayOfweek = date("D",strtotime($temp));
            $textDayOfWeek = getDayOfWeek($dayOfweek);

            $month = array("ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
            $num = explode("-", $temp);
            if ($num[0] == "0000") {
                $date = "ไม่ระบุ";
            } else {
                if ($num[0] < 2200)
                    $num[0] += 543;
                @$date = intval($num[2]) . " " . $month[$num[1] - 1] . " " . $num[0];
            }
        } else {
            $date = "ไม่ระบุ";
        }
        return $date;
    }

      function dayEng($temp)
    {
        if ($temp != "0000-00-00" && $temp != '') {
            $month = array("Jan", "Feb", "Mar", "Apr", "MAy", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
            $num = explode("-", $temp);
            if ($num[0] == "0000") {
                $date = "No Time";
            } else {
                if ($num[0] < 2200)
                    $num[0];
                $date = intval($num[2]) . " " . $month[$num[1] - 1] . " " . $num[0];
            }
        } else {
            $date = "ไม่ระบุ";
        }
        return $date;
    }

       function dayEngFull($temp)
    {
        if ($temp != "0000-00-00" && $temp != '') {
            $month = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
            $num = explode("-", $temp);
            if ($num[0] == "0000") {
                $date = "No Time";
            } else {
                if ($num[0] < 2200)
                    $num[0];
                $date = intval($num[2]) . " " . $month[$num[1] - 1] . " " . $num[0];
            }
        } else {
            $date = "ไม่ระบุ";
        }
        return $date;
    }


      function dateTimeThai($temp)
    {
        if ($temp == "0000-00-00 00:00:00" || $temp == '') {
            return 'ไม่ระบุ';
        } else {

            $tmp_arr = explode(' ', $temp);
            return dayThai2($tmp_arr[0]) . ' / ' . substr($tmp_arr[1], 0, -3) . ' น.';
        }
    }


      function dateTimeThaiFull($temp)
    {

        if ($temp == "0000-00-00 00:00:00" || $temp == '') {
            return 'ไม่ระบุ';
        } else {

            $tmp_arr = explode(' ', $temp);
            return dayThai($tmp_arr[0]) . ' / ' . substr($tmp_arr[1], 0, -3) . ' น.';
        }
    }


      function timeThai($temp)
    {
        return substr($temp, 0, -3) . ' น.';
    }


      function dateTime_th($temp)
    {
        $tmp_arr = explode(' ', $temp);
        return dayThai2($tmp_arr[0]) . ' / ' . substr($tmp_arr[1], 0, -3) . ' น.';
    }


      function dateTime_en($temp)
    {
        $tmp_arr = explode(' ', $temp);
        return dayEng($tmp_arr[0]) . ' at  ' . substr($tmp_arr[1], 0, -3) . ' .';
    }


    /**
     * ฟังชั่น Set ปี พ.ศ
     */
      function set_year_thai($year)
    {
        if ($year == '') {
            return 'ไม่ระบุ';
        }


        if ($year > 0 && $year <= date('Y')) {
            return $year = $year + 543;
        } else {
            return thainumDigit($year);
        }

    }

      function thainumDigit($num)
    {
        return str_replace(
            array("o", "๑", "๒", "๓", "๔", "๕", "๖", "๗", "๘", "๙"),
            array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9'),
            $num);
    }


      function getSiteName($site)
    {
        $tmp = explode(('/'), $site);
        return $tmp['0'];
    }


    function set_mount($mount = false)
    {
        if ($mount != false) {
            $mount = date('Y-' . $mount . '-' . '01');
            $strMonth = date("n", strtotime($mount));
            $strMonthCut = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
            $strMonthThai = $strMonthCut[$strMonth];
            return " $strMonthThai ";
        } else {
            return " - ";
        }
    }


      function getMonthName($num)
    {
        $strMonthCut = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
        return $strMonthCut[intval($num)];
    }
// }