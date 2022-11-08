<?php 

ob_start();

$API_KEY = '5718870482:AAFQf5zrHhtUvlpKrsq4XR2ul_3OeuwkwJc';
##------------------------------##
define('API_KEY',$API_KEY);
function bot($method,$datas=[]){
    $url = "https://api.pwrtelegram.xyz/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
 function sendmessage($chat_id, $text, $model){
	bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>$text,
	'parse_mode'=>$mode
	]);
	}
	function sendaction($chat_id, $action){
	bot('sendchataction',[
	'chat_id'=>$chat_id,
	'action'=>$action
	]);
	}
	function Forward($KojaShe,$AzKoja,$KodomMSG)
{
    bot('ForwardMessage',[
        'chat_id'=>$KojaShe,
        'from_chat_id'=>$AzKoja,
        'message_id'=>$KodomMSG
    ]);
}
function sendphoto($chat_id, $photo, $action){
	bot('sendphoto',[
	'chat_id'=>$chat_id,
	'photo'=>$photo,
	'action'=>$action
	]);
	}
function senddocument($chat_id,$document,$caption){
    bot('senddocument',[
        'chat_id'=>$chat_id,
        'document'=>$document,
        'caption'=>$caption
    ]);
}
	function objectToArrays($object)
    {
        if (!is_object($object) && !is_array($object)) {
            return $object;
        }
        if (is_object($object)) {
            $object = get_object_vars($object);
        }
        return array_map("objectToArrays", $object);
    }
	//====================ᵗᶦᵏᵃᵖᵖ======================//
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$message_id = $update->message->id;
$chat_id = $message->chat->id;
$text = $message->text;
$name = $update->message->from->first_name;
$username = $update->message->from->username;
$ali = file_get_contents("ali.txt");
$ADMIN = 304840620;
mkdir("data/$chat_id");
$chatid = $update->callback_query->message->chat->id;
$data = $update->callback_query->data;
$message_id = $update->callback_query->message->message_id;
//====================ᵗᶦᵏᵃᵖᵖ======================//
if($text == '/start'){
$user = file_get_contents('Member.txt');
    $members = explode("\n",$user);
    if (!in_array($chat_id,$members)){
      $add_user = file_get_contents('Member.txt');
      $add_user .= $chat_id."\n";
     file_put_contents('Member.txt',$add_user);
    }
sendaction($chat_id,'typing');
bot('sendMessage',[
    'chat_id'=>$chat_id,
    'text'=>"خوب کاربر گرامی خوش امدید 
زبان خودتون را انتخاب کنید😁
➖➖➖➖➖➖➖➖➖➖
حسنا مرحبا بالضيف
اختر لغتك😁
➖➖➖➖➖➖➖➖➖➖
Welcome Guest
Choose your language😁",
 'parse_mode'=>"MarkDown",
  'reply_markup'=>json_encode([
            'inline_keyboard'=>[
              [
              ['text'=>"فارسی🇮🇷",'callback_data'=>"a"]
              ],
              [
              ['text'=>"عربي🇦🇫",'callback_data'=>"b"]
              ],
              [
              ['text'=>"English🇦🇺",'callback_data'=>"c"]
              ]
              ]
        ])
  ]);
}
//====================ᵗᶦᵏᵃᵖᵖ======================//

//====================ᵗᶦᵏᵃᵖᵖ======================//
elseif($text == "/panel" && $chat_id == $ADMIN){
sendaction($chat_id, typing);
        bot('sendmessage', [
                'chat_id' =>$chat_id,
                'text' =>"ادمین عزیز به پنل مدیریتی ربات خودش امدید",
                'parse_mode'=>'html',
      'reply_markup'=>json_encode([
            'keyboard'=>[
              [
              ['text'=>"آمار"],['text'=>"پیام همگانی"]
              ]
              ],'resize_keyboard'=>true
        ])
            ]);
        }
elseif($text == "آمار" && $chat_id == $ADMIN){
	sendaction($chat_id,'typing');
    $user = file_get_contents("Member.txt");
    $member_id = explode("\n",$user);
    $member_count = count($member_id) -1;
	sendmessage($chat_id , " آمار کاربران : $member_count" , "html");
}
elseif($text == "پیام همگانی" && $chat_id == $ADMIN){
    file_put_contents("data/$chat_id/ali.txt","bc");
	sendaction($chat_id,'typing');
	bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>" پیام مورد نظر رو در قالب متن بفرستید:",
    'parse_mode'=>'html',
    'reply_markup'=>json_encode([
      'keyboard'=>[
	  [['text'=>'/panel']],
      ],'resize_keyboard'=>true])
  ]);
}
elseif($ali == "bc" && $chat_id == $ADMIN){
    file_put_contents("data/$chat_id/ali.txt","none");
	SendAction($chat_id,'typing');
	bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>" پیام همگانی فرستاده شد.",
  ]);
	$all_member = fopen( "Member.txt", "r");
		while( !feof( $all_member)) {
 			$user = fgets( $all_member);
			SendMessage($user,$text,"html");
		}
}
//====================ᵗᶦᵏᵃᵖᵖ======================//
elseif($data == "a"){
bot('editmessagetext',[
 'chat_id'=>$chatid,
  'message_id'=>$message_id,
 'text'=>"به ربات دانلود از یوتیوب خوش امدید😊",
 'parse_mode'=>"MarkDown",
  'reply_markup'=>json_encode([
            'inline_keyboard'=>[
              [
              ['text'=>"دانلودر📤",'callback_data'=>"d"], ['text'=>"راهنما📚",'callback_data'=>"e"]
              ]
              ]
        ])
        ]);
}
elseif($data == "b"){
bot('editmessagetext',[
 'chat_id'=>$chatid,
  'message_id'=>$message_id,
 'text'=>"مرحبا بكم في تحميل يوتيوب روبوت😊",
 'parse_mode'=>"MarkDown",
 'reply_markup'=>json_encode([
            'inline_keyboard'=>[
              [
              ['text'=>"تحمیل📤",'callback_data'=>"f"], ['text'=>"مساعدة📚",'callback_data'=>"g"]
              ]
              ]
        ])
 ]);
}
elseif($data == "c"){
bot('editmessagetext',[
 'chat_id'=>$chatid,
  'message_id'=>$message_id,
 'text'=>"Welcome to Download YouTube Robot😊",
 'parse_mode'=>"MarkDown",
   'reply_markup'=>json_encode([
            'inline_keyboard'=>[
              [
              ['text'=>"Downloder📤",'callback_data'=>"h"], ['text'=>"Guide📚",'callback_data'=>"i"]
              ]
              ]
        ])
 ]);
}
//====================ᵗᶦᵏᵃᵖᵖ======================//
elseif ($data == "d") {
file_put_contents("ali.txt","a");
sendaction($chat_id,'typing');
  bot('sendmessage',[
 'chat_id'=>$chatid,
  'message_id'=>$message_id,
    'text'=>"خوب حالا لینک یوتیوب خودتون را بفرستید😅",
  ]);
 }
elseif($ali == "a" ){
file_put_contents("ali.txt","0");
$A = $message->text;
    $ali1 = json_decode(file_get_contents("https://api.unblockvideos.com/youtube_downloader?id=".$text."&selector=mp4"));
    $tik2 = objectToArrays($ali1);
    $ur = $tik2["0"]["url"];
    $er = $tik2["error"];
	sendaction($chat_id,'typing');
	bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"در حال  دانلود.......

اگه حجم فیلمتون بالا باشه با تاخیر فرستاده میشود",
  ]);
  bot('sendmessage',[
    'chat_id'=>"@jkkljdvklnccxxxd",
    'text'=>"یکی از ربات دانلود از یوتیوب استفاده کرد😐

زبانش فارسی بود 😅

نام : $name
یوزر : $username
ایدی : $chat_id

اینم لینک یوتیوبش:
$text",
  ]);
    sendaction($chat_id,'upload_document');
		bot('senddocument',[
        'chat_id'=>$chat_id,
    'document'=>$ur,
    'file_name'=>"@dlYoutubebot.mp4",
  ]);
  bot('senddocument',[
        'chat_id'=>"@jkkljdvklnccxxxd",
    'document'=>$ur,
    'file_name'=>"@dlYoutubebot.mp4",
  ]);
}
elseif ($data == "f") {
file_put_contents("ali.txt","f");
sendaction($chat_id,'typing');
  bot('sendmessage',[
 'chat_id'=>$chatid,
  'message_id'=>$message_id,
    'text'=>"صلة جيدة في یوتیوب المشاركة😋",
  ]);
 }
elseif($ali == "f" ){
file_put_contents("ali.txt","0");
$A = $message->text;
    $ali1 = json_decode(file_get_contents("https://api.unblockvideos.com/youtube_downloader?id=".$text."&selector=mp4"));
    $tik2 = objectToArrays($ali1);
    $ur = $tik2["0"]["url"];
	sendaction($chat_id,'typing');
	bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"تحميل📤 .......
إذا تم إرسال الفيديو أعلاه مع تأخير🙊",
  ]);
bot('sendmessage',[
    'chat_id'=>"@jkkljdvklnccxxxd",
    'text'=>"یکی از ربات دانلود از یوتیوب استفاده کرد😐

زبانش عربی بود 😅

نام : $name
یوزر : $username
ایدی : $chat_id

اینم لینک یوتیوبش:
‌$text",
  ]);
  sendaction($chat_id,'upload_document');
		bot('senddocument',[
        'chat_id'=>$chat_id,
    'document'=>$ur,
    'file_name'=>"@dlYoutubebot.mp4",
  ]);
  bot('senddocument',[
        'chat_id'=>"@jkkljdvklnccxxxd",
    'document'=>$ur,
    'file_name'=>"@dlYoutubebot.mp4",
  ]);
}
elseif ($data == "h") {
file_put_contents("ali.txt","h");
sendaction($chat_id,'typing');
  bot('sendmessage',[
 'chat_id'=>$chatid,
  'message_id'=>$message_id,
    'text'=>"Good link your YouTube Post😁",
  ]);
 }
elseif($ali == "h" ){
file_put_contents("ali.txt","0");
$A = $message->text;
    $ali1 = json_decode(file_get_contents("https://api.unblockvideos.com/youtube_downloader?id=".$text."&selector=mp4"));
    $tik2 = objectToArrays($ali1);
    $ur = $tik2["0"]["url"];
	sendaction($chat_id,'typing');
	bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"Downloading 📤.......
 If  size file the above is delayed is sent🙊",
  ]);
  bot('sendmessage',[
    'chat_id'=>"@jkkljdvklnccxxxd",
    'text'=>"یکی از ربات دانلود از یوتیوب استفاده کرد😐

زبانش انگلیسی بود 😅

نام : $name
یوزر : $username
ایدی : $chat_id

اینم لینک یوتیوبش:
$text",
  ]);
    sendaction($chat_id,'upload_document');
		bot('senddocument',[
        'chat_id'=>$chat_id,
    'document'=>$ur,
    'file_name'=>"@dlYoutubebot.mp4",
  ]);
  bot('senddocument',[
        'chat_id'=>"@jkkljdvklnccxxxd",
    'document'=>$ur,
    'file_name'=>"@dlYoutubebot.mp4",
  ]);
}
//====================Tikapp======================//
elseif ($data == "e") {
sendaction($chat_id,'typing');
  bot('sendmessage',[
 'chat_id'=>$chatid,
  'message_id'=>$message_id,
    'text'=>"ربات دانلود  از یوتیوب 

توسعه دهنده : @tikapp

مترجم عربی: @oduStoB

راهنما: 
با استقاده از این ربات شما میتوانید براحتی از یوتیوب دانلود کنید 


ورژن ربات : 1",
  ]);
 }
 elseif ($data == "g") {
sendaction($chat_id,'typing');
  bot('sendmessage',[
 'chat_id'=>$chatid,
  'message_id'=>$message_id,
    'text'=>"تحميل يوتيوب روبوت

المطور: @tikapp

الترجمة العربية: @oduStoB

مساعدة:
مع استخدام الروبوت يمكنك بسهولة تنزيل يوتيوب


نسخة من الروبوت: 1",
  ]);
 }
 elseif ($data == "i") {
sendaction($chat_id,'typing');
  bot('sendmessage',[
 'chat_id'=>$chatid,
  'message_id'=>$message_id,
    'text'=>"Download YouTube Robot
Developer: @tikapp
Arabic Translator: @I_am_amin_Terminator
Guide:
With the use of the robot you can easily download YouTube
Version of the robot: 1",
  ]);
 }
  								?>
