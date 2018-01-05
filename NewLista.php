<?php
ob_start();
$API_KEY = 'توكن';
define('API_KEY',$API_KEY);
function bot($method,$datas=[]){
$url = "https://api.telegram.org/bot".API_KEY."/".$method;
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
mkdir("bots");
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$chat_id = $message->chat->id;
$text = $message->text;
$from_id = $message->from->id;
$msg = $message->message_id;
$username = $message->from->username;
$from_name = $message->from->first_name;
$host = "رابط الاستضاقة";
$admin = "ايدي";
$time = time() + (979 * 11 + 1 + 30);
$bots = explode("\n",file_get_contents("bots/bots.json"));
if(isset($update->callback_query)){
$callbackMessage = '';
var_dump(bot('answerCallbackQuery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>$callbackMessage
]));
$data = $update->callback_query->data;
$chat_id = $update->callback_query->message->chat->id;
$msg = $update->callback_query->message->message_id;
$from_id = $update->callback_query->from->id;
function sendAction($chat_id, $action){
bot('sendChataction',[
'chat_id'=>$chat_id,
'action'=>$action]);
}
bot('answerInlineQuery', [
'inline_query_id' => $update->inline_query->id,
'results' => json_encode([[
'type' => 'article',
'id' => base64_encode(rand(5, 555)),
'title' => 'اضغط هنا 😗',
'input_message_content' => ['parse_mode' => 'MarkDown', 'message_text' => "

- اهلا بك في بوت صنع بوتات لستات ☑️ •

- البوت متطور جداً يمكنك استخدامة بسلاسة 🚫 •

- يمكنك الان دعم القنوات بسهوله تامة 🗣 •

- اترككم معه تجربت البوت ⏬ •
"],
'reply_markup' => [
'inline_keyboard' => [
[['text' => "دخول الى البوت", 'url' => 'https://telegram.me/TPListBot']],
[['text'=>'شارك البوت 🚹', 'switch_inline_query'=>""]],
]]
]])
]);
//قسم الخانات الكيبورد
if($data == "back"){
bot('editmessagetext',[
'chat_id'=>$chat_id,
'text'=>"`
- اهلا بك في بوت صنع بوتات لستات ☑️ •

- البوت متطور جداً يمكنك استخدامة بسلاسة 🚫 •

- يمكنك الان دعم القنوات بسهوله تامة 🗣 •

➗➖➖➖➖➖➖➖➖➖➖➖➗`
⏰┊*Time ::* `".date('g', $time).":".date('i', $time)."`
📆┊*Date ::* `".date("Y")."/".date("n")."/".date("d")."`
",
'message_id'=>$msg,
'parse_mode'=>'MARKDOWN',
'disable_web_page_preview'=>'true',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"صنع بوت 💡",'callback_data'=>"start"],['text'=>"حذف بوت 🗑",'callback_data'=>"dele"]],
[['text'=>"هل لديك مشكله❓",'callback_data'=>"erorr"]],
[['text'=>"حـول الـبـوت ℹ",'callback_data'=>"about"],['text'=>"ℹ️ مساعدة",'callback_data'=>"help"]],
[['text'=>"Channel 📡",'url'=>"https://t.me/dev_kasper"]],
]])
]);
}
}
if($text == "/start"){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"`
- اهلا بك في بوت صنع بوتات لستات ☑️ •

- البوت متطور جداً يمكنك استخدامة بسلاسة 🚫 •

- يمكنك الان دعم القنوات بسهوله تامة 🗣 •

➗➖➖➖➖➖➖➖➖➖➖➖➗`
⏰┊*Time ::* `".date('g', $time).":".date('i', $time)."`
📆┊*Date ::* `".date("Y")."/".date("n")."/".date("d")."`
",
'message_id'=>$msg,
'parse_mode'=>'MARKDOWN',
'disable_web_page_preview'=>'true',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"صنع بوت 💡",'callback_data'=>"start"],['text'=>"حذف بوت 🗑",'callback_data'=>"dele"]],
[['text'=>"هل لديك مشكله❓",'callback_data'=>"erorr"]],
[['text'=>"حـول الـبـوت ℹ",'callback_data'=>"about"],['text'=>"ℹ️ مساعدة",'callback_data'=>"help"]],
[['text'=>"Channel 📡",'url'=>"https://t.me/dev_kasper"]],
]])
]);
}
if($data == "about"){
bot('editmessagetext',[
'chat_id'=>$chat_id,
'text'=>"`👾┊مهمة البوت صنع بوتات لستات ♻️`

`☠┊تم صنع البوت من قبل المطور` [Kasper](t.me/kasper_dev) 👻

`📡┊تابع فريق` [TP Team](t.me/dev_kasper) 🔌

`ℹ️┊اصدار البوت` :: *V1*",
'message_id'=>$msg,
'parse_mode'=>'MARKDOWN',
'disable_web_page_preview'=>'true',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"رجوع 🔙",'callback_data'=>"back"]],
]])
]);
}
if($data == "erorr"){
bot('editmessagetext',[
'chat_id'=>$chat_id,
'text'=>"`✔️┊يرجئ مراسلة المطور وطرح مشكلتك عليه
🔰┊وان شاء الله سيتم حل المشكله الخاصه بك `",
'message_id'=>$msg,
'parse_mode'=>'MARKDOWN',
'disable_web_page_preview'=>'true',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"المطور",'url'=>"https://t.me/kasper_dev"]],
[['text'=>"رجوع 🔙",'callback_data'=>"back"]],
]])
]);
}
if($data == "help"){
bot('editmessagetext',[
'chat_id'=>$chat_id,
'text'=>"`🤷‍♂┊كيف تصنع توكن خاص بك ؟؟ 
💞┊اليك الشرح المفصل تابع الى الاخير`
`1⃣┊الذهاب الى بوت` > @botfather
`2⃣┊ارسال له امر` */start*
`3⃣┊ثمه ارسال له امر التالي` */newbot*
`4⃣┊ثمه ارسال له اسم البوت الذي تريده كمثال شهد
5⃣┊ثمه اليوزر ينتهي بكلمة` *bot* `مثلا` *hddhbot*
`6⃣┊هنا سيضهر لك توكن البوت هاكذا ↙️`
*272727272:jsjsjsnsbsgduznsnsbbsbs*
`اجلبه الى البوت`",
'message_id'=>$msg,
'parse_mode'=>'MARKDOWN',
'disable_web_page_preview'=>'true',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"رجوع 🔙",'callback_data'=>"back"]],
]])
]);
}
if($data == "start"){
bot('editmessagetext',[
'chat_id'=>$chat_id,
'text'=>"`📤┊ارسل التوكن الخاص بك...`",
'message_id'=>$msg,
'parse_mode'=>'MARKDOWN',
'disable_web_page_preview'=>'true',
]);
}
//قسم التحقق من الوكن ولمعلومات وصنع
$token = json_decode(file_get_contents('https://api.telegram.org/bot'. $text .'/getme'));
function objectToArrays( $object ) {
	if( !is_object( $object ) && !is_array( $object ) )
{
return $object;
}
if( is_object( $object ) )
{
$object = get_object_vars( $object );
}
return array_map( "objectToArrays", $object );
}
$resultb = objectToArrays($token);
$namebot = $resultb["result"]["first_name"];
$idbot = $resultb["result"]["id"];
$user = $resultb["result"]["username"];
$ok = $resultb["ok"];
if($ok != 1 and !$data and $text and $text !== '/start' and !in_array($from_id, $bots)) {
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"`🚫┊عذراً التوكن غلط`",
'message_id'=>$msg,
'parse_mode'=>'MARKDOWN',
]);
}
if($ok and !$data and $text and $text !== '/start' and !in_array($from_id, $bots)) {
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"`
⏳┊جاري صنع بوت خاص بك...⌛️
`",
'parse_mode'=>'MARKDOWN',
]);
$ss = file_get_contents("bot.php");
$ss = str_replace("--token--",$text,$ss);
$ss = str_replace("--id--",$from_id,$ss);
$ss = str_replace("--userbot--",$user,$ss);
$ss = str_replace("--name--",$from_name,$ss);
$ss = str_replace("--user--",$username,$ss);
mkdir("bots/$from_id");
file_put_contents("bots/$from_id/bot.php",$ss);	
file_get_contents("http://api.telegram.org/bot".$text."/setwebhook?url=$host/bots/$from_id/bot.php");
file_put_contents("bots/bots.json", "$from_id\n", FILE_APPEND);
bot('editmessagetext',[
'chat_id'=>$chat_id,
'text'=>"`
✔️┊تم صنع البوت الخاص بك بنجاح
`",
"message_id"=>$msg+1,
'parse_mode'=>'MARKDOWN',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"$namebot",'url'=>"https://t.me/$user"]],
]])
]);
bot('sendmessage',[
'chat_id'=>$admin,
'text'=>"🔋 تم صنع بوت 🎩
✨ معرف المستخدم - @$username
☑️ معرف البوت - @$user",
]);
}
if($ok and !$data and in_array($from_id, $bots)){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"`❗️┊عذراً لايمكن صنع بوتين ❤️`",
'parse_mode'=>'MARKDOWN',
]);
}
//حذف البوت
if($data == "dele" and in_array($from_id, $bots)){
bot('editmessagetext',[
'chat_id'=>$chat_id,
'text'=>"`💡┊اضغط ع كلمة بوت للاحذف...🗑`",
'message_id'=>$msg,
'parse_mode'=>'MARKDOWN',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"بوت",'callback_data'=>"delete"]],
[['text'=>"رجوع 🔙",'callback_data'=>"back"]],
]])
]);
}
if($data == "dele" and !in_array($from_id, $bots)){
bot('editmessagetext',[
'chat_id'=>$chat_id,
'text'=>"`🚫┊لا يوجد بوتات لك ❌`",
'message_id'=>$msg,
'parse_mode'=>'MARKDOWN',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"رجوع 🔙",'callback_data'=>"back"]],
]])
]);
}
if($data == "delete"){
$files = scandir("bots/$from_id/code");
$fil = scandir("bots/$from_id/data");
$file = scandir("bots/$from_id/start");
$fle = scandir("bots/$from_id");
for($o=0;$o<count($fil);$o++){
unlink("bots/$from_id/data/$fil[$o]");
for($l=0;$l<count($file);$l++){
unlink("bots/$from_id/start/$file[$l]");
for($i=0;$i<count($files);$i++){
unlink("bots/$from_id/code/$files[$i]/code.php");
unlink("bots/$from_id/code/$files[$i]/lista.php");
unlink("bots/$from_id/code/$files[$i]/file_id.txt");
unlink("bots/$from_id/code/$files[$i]/textlist.txt");
unlink("bots/$from_id/code/$files[$i]/text.txt");
unlink("bots/$from_id/code/$files[$i]/txt.txt");
Rmdir("bots/$from_id/code/$files[$i]");
for($oo=0;$oo<count($fle);$oo++){
unlink("bots/$from_id/$fle[$oo]");
Rmdir("bots/$from_id/$fle[$oo]");
Rmdir("bots/$from_id");
}
}
}
}
$uu = file_get_contents("bots/bots.json");
$uu = str_replace("$from_id"," ",$uu);
$uu = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $uu);
file_put_contents('bots/bots.json', $uu);
bot('editmessagetext',[
'chat_id'=>$chat_id,
'text'=>"`🗑┊تم حذف البوت بنجاح ✔️`",
'message_id'=>$msg,
'parse_mode'=>'MARKDOWN',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"رجوع 🔙",'callback_data'=>"back"]],
]])
]);
}
?>