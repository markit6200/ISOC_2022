<?php 
namespace App\Libraries;
class CompareText {

    public function __construct(){

    }

    //function สำหรับค้นหาข้อมูล txt ที่กใล้เคียงรับค่า $txt_input = "ข้อความที่ต้องการค้นหา" / $data_search = array('ชื่อ key' => 'ค่า text') / $debug = 0:ปิด, 1:เปิด sql และ ผลลัพท์, 2:เปิดทั้งหมด
    public static function compareText($txt_input = '', $data_search = array(), $debug = 0){
        $similar_gain = 80;//--- percent การเหมือนที่รับได้
        $arr_tmp = array();
        $result = null;
        if($txt_input != '' && !empty($data_search)){
            if($debug >= 1){ echo '<hr><h3><font color="magenta">checkTxtSimilar</font></h3>'; }//--- DEBUG = 1
            if(!empty($data_search)){
                foreach($data_search as $k => $v){
                    $percent = similar_text::similarText($txt_input, $v, 2, true);
                    $arr_tmp[$k] = $percent;
                }
                if($debug >= 2){ echo '<pre><font color="red">$arr_search</font>'; print_r($data_search); echo '</pre>'; }//--- DEBUG = 2
                unset($data_search);
            }
            if(!empty($arr_tmp)){
                arsort($arr_tmp);
                foreach($arr_tmp as $k => $v){
                    if($v >= $similar_gain){
                        $result = $k;
                        break;
                    }
                }
                if($debug >= 2){ echo '<pre><font color="red">$arr_tmp</font>'; print_r($arr_tmp); echo '</pre>'; }//--- DEBUG = 2
                unset($arr_tmp);
            }
            if($debug >= 1){ echo '<br><font color="blue">RESULT</font> : '.$result.' / '.$data_search[$result].'<hr>'; }//--- DEBUG = 1
        }
        return $result;
    }
}

function SimilarText(
						$firstString,
						$secondString,
						$round=2,
						$insensitive=true,
						&$stats=false,
						&$difference=false
					)
{
	$difference=$difference;
	$stats=$stats;
	return similar_text::similarText(
										$firstString,
										$secondString,
										$round,
										$insensitive,
										$stats,
										$difference
									);
}





class similar_text {
	
	public static function similarText(
										$firstString,
										$secondString,
										$round=2,
										$insensitive=true,
										&$stats=false,
										&$difference=false
									  )
	{ 
		if(!is_string($firstString)||!is_string($secondString))
		{
			return false;
		}
		$difference=['charsNotInFirstString'=>[],'charsNotInSecondString'=>[],];
		if($firstString===$secondString)
		{
			$stats['reallyContain']=true;
			$stats['contain']=true;
			$stats['percentageRc']=100;
			$difference=array();
			return 100.0;
		}
		if($insensitive)
		{
			
			$firstString=similar_text::strtolower($firstString);
			$secondString=similar_text::strtolower($secondString);
		}
			
		$usedCharsFirst=similar_text::count_chars($firstString);
		$usedCharsSecond=similar_text::count_chars($secondString);
		$countFirst=array_sum($usedCharsFirst);
		$countSecond=array_sum($usedCharsSecond);
		
		if($countFirst>$countSecond)
		{
			if(@preg_match('#'.quotemeta($secondString).'#',$firstString))
			{
				$stats['reallyContain']=true;
				$stats['percentageRc']=100;
			}
			else
			{
				$stats['reallyContain']=false;
				$stats['percentageRc']=0;
			}
			
			
			$found=0;
			foreach($usedCharsFirst as $octet=>$frequence){
				if(!isset($usedCharsSecond[$octet]))
				{
					while($frequence>0)
					{
						$difference['charsNotInSecondString'][]=$octet;
						$frequence--;
					}
				}
				else
				{
					$frequence=$usedCharsSecond[$octet]-$usedCharsFirst[$octet];
					
					if($frequence>=0)
					{
						$found+=$usedCharsFirst[$octet];
					}
					else
					{
						$found+=$usedCharsSecond[$octet];
					}
					while($frequence>0)
					{
						$difference['charsNotInFirstString'][]=$octet;
						$frequence--;
					}
					
				}								
			}
			foreach($usedCharsSecond as $octet=>$frequence)
			{
				if(!isset($usedCharsFirst[$octet]))
				{
					while($frequence)
					{
						$difference['charsNotInFirstString'][]=$octet;
						$frequence--;
					}
				}
				else
				{
					$frequence=$usedCharsFirst[$octet]-$usedCharsSecond[$octet];
					if($frequence>0)
					{

						while($frequence)
						{
							$difference['charsNotInSecondString'][]=$octet;
							$frequence--;
						}
					}
				}								
			}
			
			$similar=round($found/$countFirst*100,$round);
			$stats['contain']=(empty($difference['charsNotInFirstString']))?true:false;
			unset($usedCharsSecond,$usedCharsFirst,$found,$countFirst);
			
			if(
				(!$stats['reallyContain']&&$stats['contain'])||
				(!$stats['reallyContain']&&$similar>=50)
			  )
			{
				$real=0;
				$secondString=preg_split('#\s#',$secondString);
				foreach($secondString as $key=>$val){
					$firstString=
					@preg_replace('#'.quotemeta($val).'#','',$firstString,1,$count);
					if($count)
					{
						$real++;
					}
				}
				if($real===($split_count=count($secondString)))
				{
					$stats['reallyContain']=true;
				}
				$stats['percentageRc']=round(($real/$split_count*100),$round);
			}
			
			return $similar;
		}else{
			if(@preg_match('#'.quotemeta($firstString).'#',$secondString))
			{
				$stats['reallyContain']=true;
				$stats['percentageRc']=100;
			}
			else
			{
				$stats['reallyContain']=false;
				$stats['percentageRc']=0;
			}

	
			$found=0;
			foreach($usedCharsFirst as $octet=>$frequence){
				if(!isset($usedCharsSecond[$octet]))
				{
					while($frequence>0)
					{
						$difference['charsNotInSecondString'][]=$octet;
						$frequence--;
					}
				}
				else
				{
					$frequence=$usedCharsSecond[$octet]-$usedCharsFirst[$octet];
					if($frequence>0)
					{
						while($frequence)
						{
							$difference['charsNotInFirstString'][]=$octet;
							$frequence--;
						}
					}
				}								
			}
			foreach($usedCharsSecond as $octet=>$frequence)
			{
				if(!isset($usedCharsFirst[$octet]))
				{
					while($frequence>0)
					{
						$difference['charsNotInFirstString'][]=$octet;
						$frequence--;
					}
				}
				else
				{
					$frequence=$usedCharsFirst[$octet]-$usedCharsSecond[$octet];
					if($frequence>=0)
					{
						$found+=$usedCharsSecond[$octet];
					}
					else
					{
						$found+=$usedCharsFirst[$octet];
					}
						
					while($frequence>0)
					{
						$difference['charsNotInSecondString'][]=$octet;
						$frequence--;
					}
					
				}								
			}
	

			$similar=round($found/$countSecond*100,$round);	
			$stats['contain']=(empty($difference['charsNotInSecondString']))?true:false;
			unset($usedCharsSecond,$usedCharsFirst,$found,$countSecond);
			
			if((!$stats['reallyContain']&&$stats['contain'])
				||(!$stats['reallyContain']&&$similar>=50)
			)
			{
				$real=0;
				$firstString=preg_split('#\s#',$firstString);
				foreach($firstString as $key=>$val){
					$secondString=@preg_replace('#'.quotemeta($val).'#'
									,'',$secondString,1,$count);
					if($count)
					{
						$real++;
					}
				}
				if($real===($split_count=count($firstString)))
				{
					$stats['reallyContain']=true;
				}
				$stats['percentageRc']=round(($real/$split_count*100),$round);
			}
			
			return $similar;
			
		}
	}
	private static function count_chars($value)
	{
		return array_count_values(preg_split('//u', $value, -1, PREG_SPLIT_NO_EMPTY));
	}
	
	private static function is_ascii($str)//credit to  voku\PortableUTF8 
	{
		if ('' === $str) 
		{
		  return true;
		}

		return !preg_match('/[^\x09\x10\x13\x0A\x0D\x20-\x7E]/', $str);
	}
	
	private static function strtolower($str)
	{
		
		return join(array_map(
						function ($val)
						{
							if(similar_text::is_ascii($val)) 
							{
								return strtolower($val);
							}
							return $val;
						},
						preg_split('//u', $str, -1, PREG_SPLIT_NO_EMPTY)
					)
				   );
	}
}
