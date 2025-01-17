<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;
use Illuminate\Support\Arr;

class Helper
{
    public static function shout(string $string)
    {
        return strtoupper($string);
    }
	
	public static function debug($array=array())
    {
       echo "<pre>";print_r($array);echo "<pre>"; exit;
    }

    	//generate alpha numeric code
	static function generateAlphaNumeric($limit = 0)
	{

		$num = '';
		for ($i = 0; $i < $limit; $i++) {
			$d = rand(1, 30) % 2;
			$num .= $d ? chr(rand(48, 57)) : chr(rand(97, 122));
		}
		return $num;

	}

	static function generateRandomCapitalAlphabets($limit = 0)
	{

		$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < $limit; $i++) {
            $randstring.= $characters[rand(0, strlen($characters)-1)];
        }
        return $randstring;

	}

	#check file extension is exist in file_extension_for_icon
	static function isFileExtensionForIcon($fileName=''){
		$fileExtensionForIcon = config('constants.file_extension_for_icon');
		$explodedFileName = explode('.', $fileName);
		$fileExtension = end($explodedFileName);
		if(in_array($fileExtension,$fileExtensionForIcon))
        {
			return $fileExtension.'.png';
		}	
		
		return false;
	}

	
   //Replace underscore with space and upper case first character in array
   public static function replaceUnderscoreWithSpaceAndUpperCaseFirstCharacter($str) 
   {
	return ucwords(str_replace("_", " ", $str));
   }

    public static function sluggify($str, $limit = null)
	{
		$str = strtolower($str);
		$str = strip_tags($str);
		$str = stripslashes($str);

		if ($limit) {
			$str = mb_substr($str, 0, $limit, "utf-8");
		}
		$text = html_entity_decode($str, ENT_QUOTES, 'UTF-8');
		// replace non letter or digits by -
		$text = preg_replace('~[^\\pL\d]+~u', '-', $text);
		// trim
		$text = trim($text, '-');
		return $text;
	}

	    #check number is zero then return one else return number
	public static function retunOneIfzero($number='')
	{
	
		if($number==0 && !is_null($number))
		{
			$number = 1;
		}
		return $number;
	}

	public static function replaceHomeContent($homeContent=array(),$userData=array())
	{
		$pattern =  config('constants.home_page_content_pattern');
		$replace = array(
							ucwords( Arr::get($userData, 'full_name')  )
						);
		return $view = str_replace($pattern, $replace, Arr::get($homeContent, 'content'));
	}

	public static function time_elapsed_string($datetime, $full = false) {
		$now = new \DateTime;
		$ago = new \DateTime($datetime);
		$diff = $now->diff($ago);
	
		$diff->w = floor($diff->d / 7);
		$diff->d -= $diff->w * 7;
	
		$string = array(
			'y' => 'year',
			'm' => 'month',
			'w' => 'week',
			'd' => 'day',
			'h' => 'hour',
			'i' => 'minute',
			's' => 'second',
		);
		foreach ($string as $k => &$v) {
			if ($diff->$k) {
				$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
			} else {
				unset($string[$k]);
			}
		}
	
		if (!$full) $string = array_slice($string, 0, 1);
		return $string ? implode(', ', $string) . ' ago' : 'just now';
	}


	public static function getApplicationId($candidateId=0)
	{
		$applicationId = 0;
		if(!empty($candidateId))
		{
			$applicantPrefix    = config('constants.applicant_prefix'); //IDS
        	$applicantYear      = date('y');
        	$applicantSerialNo  = str_pad($candidateId, 6, '0', STR_PAD_LEFT);

			#Applicant Id with New Format.
			$applicationId = $applicantPrefix.'-'.$applicantYear.'-'.$applicantSerialNo;

		}
		
		return $applicationId;
	} 


	#get data as array w.r.t month number if there is no data then 0 
    public static function monthDataMergeWithDefaultMonthArray($param=array())
    {
        $result = array();
        for($i=1; $i<=12; $i++)
        {
            if(!empty($param) && !empty($param[$i]))
            {
                $result[] = $param[$i];
            }
            else
            {
                $result[] = 0;
            }
           
        }

        return $result;
    }
	public static function defaultRemainingDocumentName($defaultDocumentArray=array())
	{
		$defaultDocuments = config('constants.default_document');

		if(!empty($defaultDocuments))
		{
			foreach ($defaultDocumentArray as $item) 
			{
				if (($key = array_search($item['document_name'], $defaultDocuments)) !== false) {
					unset($defaultDocuments[$key]);
				}
			}
		}
		return $defaultDocuments;
	}


	public static function getDateByFilterValue($filterValue='')
    {
        $dateArray = array();

        $startDate =  date("Y-m-d 00:00:00");
        $endDate = date("Y-m-d 23:59:59");

        if($filterValue == 'day')
        {
            $startDate =  date("Y-m-d 00:00:00");
        }
        else if($filterValue == 'week')
        {
            $startDate =  date("Y-m-d 00:00:00", strtotime('-7 days'));
        }
        else if($filterValue == 'month')
        {
            $startDate =  date("Y-m-d 00:00:00", strtotime('-1 month'));
        }
        else if($filterValue == '3-months')
        {
            $startDate =  date("Y-m-d 00:00:00", strtotime('-3 month'));;
        }

        $dateArray['startDate']    = $startDate;
        $dateArray['endDate']      = $endDate;
        return $dateArray;
    }

	public static function select2Fields($data=null,$errors=null,$params=array())
	{
		$fieldName = Arr::get($params,'name');
		$fieldLabel  = Helper::replaceUnderscoreWithSpaceAndUpperCaseFirstCharacter($fieldName);

		$html = 
		'    <div class="row mb-3">
				<label for="'.$fieldName.'" class="col-sm-3 col-form-label col-form-label-sm text-left">'.$fieldLabel.'<span style="color: red"> * </span></label>
				<div class="col-sm-9 text-left">
					<select class="form-control form-control '.$fieldName.'" id="'.$fieldName.'" name="'.$fieldName.'">';
					
					$select2FieldName ='';	
					if(!empty($data) && empty(old('_token')))
							{
								$select2FieldName = Arr::get($data,$fieldName);
								
							}
							
							else if(!empty(old($fieldName)))
							{
								$select2FieldName = old($fieldName);
							}

							$html.= '<option value="'.$select2FieldName.'" selected="selected">'.$select2FieldName.'</option>';
							
					$html.= '</select>';
					if($errors->has($fieldName))
					{
						$html.= '<div class="text-danger">'.$errors->first($fieldName).'</div>';
					}
			$html.='</div>
    		</div>';

		return $html;
	}
}

