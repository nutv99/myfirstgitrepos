<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>



 
<?php

$access_token = 'N0IzKf3n/tuu23eKxvUEkAY6Afzj8nu+lQYp+FyOAZXSVofsrCArcwRBOJKEbssASNnN5S35vUE5yiQ3dPcvlRqu9G0IVPHVxUHUHW63dUUUdxfcWpbZUj7iu8ImPFKK8LnAdy5wGDxvMhUD1A1fugdB04t89/1O/w1cDnyilFU='; 


$sValue= getInputMessage() ;
$MessageInput = $sValue[0];  
$replyToken =  $sValue[1];  
$userID = $sValue[2] ;



$contact9 = $sValue[0] ;
$result = getPortImageURL($contact9,$userID) ;
$str    = getPortDataString($contact9) ;
$resultAr = explode("|",$result); 



if (trim($resultAr[0]) == "Fail") {
  pushMessage($resultAr[1],$access_token,$replyToken) ; 
  return;
}  else {
  $ImageFileName = $result ; 
  pushImage($ImageFileName,$access_token,$replyToken);
  
  pushMessage($str,$access_token,$replyToken) ; 
}

//pushMessage($result,$access_token,$replyToken) ; 
echo " Curl Result-->" . $result ;
return;
$text = "งง ???? " .$sValue[0]; 
$text .= " พิมพ์  P123456789 เพื่อดู ใบ Port งาน--->" . $resp; 
//echo $text ;


$ImageFileName = "https://images.pexels.com/photos/5834/nature-grass-leaf-green.jpg?auto=compress&cs=tinysrgb&h=350" ;
//pushMessage($text,$access_token,$replyToken) ; 
//pushImage($ImageFileName,$access_token,$replyToken);

pushMessage($text,$access_token,$replyToken) ; 

//return;

//pushMessage($resp,$access_token,$replyToken) ;  

if ($ActionType == "C1" ) {

   $resp = getData($MessageInput) ;    
   pushMessage($resp,$access_token,$replyToken) ; 
   $ImageFileName = "https://images.pexels.com/photos/5834/nature-grass-leaf-green.jpg?auto=compress&cs=tinysrgb&h=350" ;
   pushImage($ImageFileName,$access_token,$replyToken);
   return;
}

if ($ActionType == "P" || $ActionType == "p" ) {

   $resp = getData($MessageInput) ;    
   //pushMessage($resp,$access_token,$replyToken) ; 
   $ImageFileName = $resp  ;
   pushImage($ImageFileName,$access_token,$replyToken);
   return;
} 



//$resp = getData($MessageInput) ;

$text = "งง ???? " .$sValue[0]; 
$text .= " พิมพ์  P123456789 เพื่อดู ใบ Port งาน--->" . $resp; 
pushMessage($text,$access_token,$replyToken) ; 
//return;
//$ImageFileName = $resp  ;
//$ImageFileName ="https://www.talonplus.co.th/port/images/portimages/port_20524_609263650.png";
//pushImage($ImageFileName,$access_token,$replyToken);

return;



// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];

			// Build message to reply back

			$text = getData() ;

			$messages = [
				'type' => 'text',
				'text' => $text
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];

			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}
echo "OK";



function getData($MessageInput) { 

 $field_string = $MessageInput ; 
 $url = 'https://www.talonplus.co.th/port/class/recivecurl.php?sval='. $field_string;
// echo $url. "<br/>";
 $curl = curl_init();
 curl_setopt_array($curl, array(
                        CURLOPT_RETURNTRANSFER => 1,
                        CURLOPT_URL => $url,
                        CURLOPT_USERAGENT => 'Thai Prosperous IT co.,Ltd.'
                   ));
 $resp = curl_exec($curl);
 curl_close($curl);
// echo $resp ;
 return $resp;
    
} // end func


function getInputMessage() { 


$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'] ;  
		
			$sValue[] = $text;
			$sValue[] = $replyToken ;  
			$sValue[] = $event['source']['userId'];  
			return $sValue;
			
		}
	}
}
    
} // end func 




function pushMessage($text,$access_token,$replyToken) {


	// Make a POST Request to Messaging API to reply to sender


	        $messages = [
				'type' => 'text',
				'text' => $text
			];

			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];

			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";




}



function pushImage($ImageFileName,$access_token,$replyToken) {


	// Make a POST Request to Messaging API to reply to sender


	       

			$messages = [
				'type' => "image",
				 "originalContentUrl"=>$ImageFileName,
                 "previewImageUrl"=> $ImageFileName
			];

			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];

			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";

} 



function getPortImageURL($contact9No,$userID) { 


       $data = array (
        'contact9No' => $contact9No,
        'key2' => 'value2',
        'key3' => 'value3',
	    'userid' => $userID       
        );
        
        $params = '';
        foreach($data as $key=>$value)
                $params .= $key.'='.$value.'&';
         
        $params = trim($params, '&'); 

	$params = "contact9No=" . $contact9No ;
	$params .= "&userid=" . $userID ;

    $url= "https://talonplus.co.th/port/class/clsCreatePortImageByCurl.php" ;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url.'?'.$params ); //Url together with parameters
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Return data instead printing directly in Browser
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT , 170); //Timeout after 7 seconds
    curl_setopt($ch, CURLOPT_USERAGENT , "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
    curl_setopt($ch, CURLOPT_HEADER, 0);
    
    $result = curl_exec($ch);
    curl_close($ch);

    if(curl_errno($ch))  //catch if curl error exists and show it
      $result =  'Curl error: ' . curl_error($ch);
    else
     echo $result;
         
    return $result ;

    
} // end func


function getPortDataString($contact9No,$userID) { 


       $data = array (
        'contact9No' => $contact9No,
        'key2' => 'value2',
        'key3' => 'value3',
        'userID' => $userID
        );
        
        $params = '';
        foreach($data as $key=>$value)
          $params .= $key.'='.$value.'&';
         
        $params = trim($params, '&'); 
	$params = "contact9No=" . $contact9No ;
	$params .= "&userid=" . $userID ;

    $url= "https://talonplus.co.th/port/class/clsCreatePortDataStringCurl.php" ;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url.'?'.$params ); //Url together with parameters
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Return data instead printing directly in Browser
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT , 170); //Timeout after 7 seconds
    curl_setopt($ch, CURLOPT_USERAGENT , "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
    curl_setopt($ch, CURLOPT_HEADER, 0);
    
    $result = curl_exec($ch);
    curl_close($ch);

    if(curl_errno($ch))  //catch if curl error exists and show it
      $result =  'Curl error: ' . curl_error($ch);
    else
     echo $result;
         
    return $result ;

    
}



function getDataString($contact9) {


  
     $sql = "select max(portTransKeyID) from portTransaction where contact9='" . $contact9."'"; 
     $portTransNo= getValue($sql);
     
    
    
    
	$sql = "select contact9,contact11,cusname,carregis,carprovince from  `viewportrenewalStaff` WHERE recno =" . $portTransNo;
    $row = getRowSet($sql) ; 

    $downloadFileName = "https://www.talonplus.co.th/port/images/portimages/port_". $portTransNo . "_". $row['contact9']  . ".png" ;
    $str = "\n"; //ข้อความที่ต้องการส่ง สูงสุด 1000 ตัวอักษร
    $str .= "เลขสัญญา  9 หลัก :".  $row['contact9'] . "\n" ;
    $str .= "ชื่อลูกค้า   :".  $row['cusname'] . "\n" ;
    $str .= "เลขทะเบียนรถ   :".  $row['carregis'] . ' ' . $row['carprovince'] .  "\n" ;
    $str .= "คลิกดูไฟล์รูป Port ---> " .$downloadFileName;
	return $str ;

    
} // end func

function getLINEProfile($datas) {
   $datasReturn = [];
   $curl = curl_init();
   curl_setopt_array($curl, array(
     CURLOPT_URL => $datas['url'],
     CURLOPT_RETURNTRANSFER => true,
     CURLOPT_ENCODING => "",
     CURLOPT_MAXREDIRS => 10,
     CURLOPT_TIMEOUT => 30,
     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
     CURLOPT_CUSTOMREQUEST => "GET",
     CURLOPT_HTTPHEADER => array(
       "Authorization: Bearer ".$datas['token'],
       "cache-control: no-cache"
     ),
   ));
   $response = curl_exec($curl);
   $err = curl_error($curl);
   curl_close($curl);
   if($err){
      $datasReturn['result'] = 'E';
      $datasReturn['message'] = $err;
   }else{
      if($response == "{}"){
          $datasReturn['result'] = 'S';
          $datasReturn['message'] = 'Success';
      }else{
          $datasReturn['result'] = 'E';
          $datasReturn['message'] = $response;
      }
   }
   return $datasReturn;
}

  ?>
