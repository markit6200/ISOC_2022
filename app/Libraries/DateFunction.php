<?php
namespace App\Libraries;
class DateFunction
{
    public function changeThainum($num){
		return str_replace(array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9'),
			array("๐", "๑", "๒", "๓", "๔", "๕", "๖", "๗", "๘", "๙"), $num);
	}

	function ConvertToThaiDate($value,$shortm='1',$shorty='1',$need_time='0',$need_time_second='0') {
		$date_arr = explode(' ', $value);
		$date = $date_arr[0];
		if(isset($date_arr[1])){
			$time = $date_arr[1];
		}else{
			$time = '';
		}

		$value = $date;
		if($value!="0000-00-00" && $value !='') {
			$x=explode("-",$value);
			if($shortm==false){
				$arrMM=array(1=>"มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
			}else{
				$arrMM=array(1=>"ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
			}

			$yyyy = ($x[0] + 543);
			if($shorty==false){
				$yy=$yyyy;
			}else{
				$yy=substr($yyyy,2,2);
			}
			
			if($need_time=='1'){
				if($need_time_second == '1'){
					$time_format = $time!=''?date('H:i:s น.',strtotime($time)):'';
				}else{
					$time_format = $time!=''?date('H:i น.',strtotime($time)):'';
				}
			}else{
				$time_format = '';
			}

			return (int)$x[2]." ".$arrMM[(int)$x[1]]." ".$yy." ".$time_format;
		} else
			return "";
	}

	function mydate2date($date, $time = false, $lang = "th") {
		if ($date != '') {
			if ($lang == "th") {
				$tmp = explode(" ", $date);
				if ($tmp[0] != "" && $tmp[0] != "0000-00-00") {
					$d = explode("-", $tmp[0]);
					$str = $d[2] . "/" . $d[1] . "/" . ($d[0] > 2500 ? $d[0] : $d[0] + 543);
					if ($time) {
						$t = strtotime($date);
						$str .= " " . date("H:i", $t);
					}
				}
			} else {
				$str = empty($date) || $date == "0000-00-00 00:00:00" || $date == "0000-00-00" ? "" : date("d/m/Y" . ($time ? " H:i" : ""), strtotime($date));
			}

			return $str;
		} else {
			return '';
		}
	}

	function ConvertToSQLDate($date,$type='en') {
		if(!empty($date)) {
			if(strpos($date, "/")!==false) {
				$x = explode("/", $date);
				if($type=='th'){
					$x[2] = ($x[2] - 543);
				}else{
					$x[2] = ($x[2]);
				}
				$x[1] = sprintf("%02d", (int)$x[1]);
				$return = "{$x[2]}-{$x[1]}-{$x[0]}";
				
			} elseif(strpos($date, "-")!==false) {
				$x = explode("-", $date);
				$x[0] = ($x[0] - 543);
				$x[1] = sprintf("%02d", (int)$x[1]);
				$return = "{$x[0]}-{$x[1]}-{$x[2]}";
			} else $return = "0000-00-00";
		} else $return = "";
		return $return;
	}
}
?>
