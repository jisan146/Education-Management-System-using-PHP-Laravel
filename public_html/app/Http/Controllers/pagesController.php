<?php
         
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use File;
use Response;
use Exception;

class pagesController extends Controller
{ 
  public function manAtt(Request $request)
  {
    $cls=-1;
     $cls=$request->class;

    if ($request->sv=='sv') {
     
     


for ($i=1; $i<=count($request->sl) ; $i++) { 
  $p='p'.$i;
  if ($request->$p=='1') {
   DB::insert("insert into attendance values (?,current_timestamp,null,?,?,null,null)",[$request->sl[$i],session('client_id'),session('branch')]);
  }
}

      
    }
    $cl=DB::select("select class,sl from class where client_id=? and branch=? order by sl",[session('client_id'),session('branch')]);
    $data=DB::select("select sl,name from student_information where sl not in (select user_id from attendance where date_format(entry_time,'%d%m%y')=date_format(current_timestamp,'%d%m%y')) and class=? and client_id=? and branch=? order by sl",[$cls,session('client_id'),session('branch')]);
    return view('pages.manAtt')->with('data',$data)->with('cl',$cl);

  }

  public function home()
  {

$stt=DB::select("select nvl(sum(ammount),0) tk,rt.description des from revenue r,revenue_type rt,revenue_expense_sector rs,stuff_information s
where r.client_id=? and r.branch=? and date_format(lmdate,'%d%m%y')=date_format(current_timestamp,'%d%m%y') 
and r.sector=rt.sl and rs.sl=rt.type and rs.operation=-1 and s.sl=r.lmby group by rt.description",[session('client_id'),session('branch')]);

$stm=DB::select("select nvl(sum(ammount),0) tk,rt.description des from revenue r,revenue_type rt,revenue_expense_sector rs,stuff_information s
where r.client_id=? and r.branch=? and date_format(lmdate,'%m')=date_format(current_timestamp,'%m') 
and r.sector=rt.sl and rs.sl=rt.type and rs.operation=-1 and s.sl=r.lmby group by rt.description",[session('client_id'),session('branch')]);

$sty=DB::select("select nvl(sum(ammount),0) tk,rt.description des from revenue r,revenue_type rt,revenue_expense_sector rs,stuff_information s
where r.client_id=? and r.branch=? and date_format(lmdate,'%y')=date_format(current_timestamp,'%y') 
and r.sector=rt.sl and rs.sl=rt.type and rs.operation=-1 and s.sl=r.lmby group by rt.description",[session('client_id'),session('branch')]);

    $todayCash=DB::select("select nvl(sum(ammount),0) tk from revenue r,revenue_type rt,revenue_expense_sector rs,stuff_information s
where r.client_id=? and r.branch=? and date_format(lmdate,'%d%m%y')=date_format(current_timestamp,'%d%m%y') 
and r.sector=rt.sl and rs.sl=rt.type and rs.operation=1 and s.sl=r.lmby ",[session('client_id'),session('branch')]);

     foreach ($todayCash as $key) {
      $todayCash=$key->tk;
    }

    $activeStudent=DB::select("select count(*) ts from student_information where class!=302 and client_id=? and branch=?",[session('client_id'),session('branch')]);

   foreach ($activeStudent as $key) {
      $activeStudent=$key->ts;
    }


    $activeStuff=DB::select("select count(*) ts from stuff_information where designation!=109 and   client_id=? and branch=?",[session('client_id'),session('branch')]);

   foreach ($activeStuff as $key) {
      $activeStuff=$key->ts;
    }

    $meal=DB::select("select nvl(sum(meal1),0)b,nvl(sum(meal2),0)l,nvl(sum(meal3),0)d from hostel where client_id=? and branch=? and date_format(idate,'%d%m%y')=date_format(current_timestamp,'%d%m%y');",[session('client_id'),session('branch')]);
$b;$d;$l;
   foreach ($meal as $key) {
      $b=$key->b;
      $d=$key->d;
      $l=$key->l;
    }


    $att=DB::select("select class,(select count(*) from student_information s where s.class=c.sl )total,
(select count(distinct user_id) from student_information s,attendance a where s.class=c.sl and a.user_id=s.sl 
and date_format(entry_time,'%d%m%y')=date_format(current_timestamp,'%d%m%y'))total_att,nvl(round(((select count(distinct user_id) from student_information s,attendance a where s.class=c.sl and a.user_id=s.sl and date_format(entry_time,'%d%m%y')=date_format(current_timestamp,'%d%m%y'))*100) /(select count(*) from student_information s where s.class=c.sl )),0) pers
 from class c where sl!=302 and client_id=? and branch=? order by sl",[session('client_id'),session('branch')]);

    $atts=DB::select("select designation,(select count(*) from stuff_information s where s.designation=c.sl )total,
(select count(distinct user_id) from stuff_information s,attendance a where s.designation=c.sl and a.user_id=s.sl 
and date_format(entry_time,'%d%m%y')=date_format(current_timestamp,'%d%m%y'))total_att,
nvl(round(((select count(distinct user_id) from stuff_information s,attendance a where s.designation=c.sl and a.user_id=s.sl and date_format(entry_time,'%d%m%y')=date_format(current_timestamp,'%d%m%y'))*100) /(select count(*) from stuff_information s where s.designation=c.sl )),0) pers
 from designation c where sl!=109 and client_id=? and branch=? order by sl",[session('client_id'),session('branch')]);

     $coll=DB::select("select sum(ammount) tk,concat('ID : ',s.sl,' Name : ',s.Name)name from revenue r,revenue_type rt,revenue_expense_sector rs,stuff_information s
where r.client_id=? and r.branch=? and date_format(lmdate,'%d%m%y')=date_format(current_timestamp,'%d%m%y') 
and r.sector=rt.sl and rs.sl=rt.type and rs.operation=1 and s.sl=r.lmby group by s.sl,s.name",[session('client_id'),session('branch')]);
     $colls=DB::select("select sum(ammount) tk,concat('ID : ',s.sl,' Name : ',s.Name)name from revenue r,revenue_type rt,revenue_expense_sector rs,stuff_information s
where r.client_id=? and r.branch=? and date_format(lmdate,'%d%m%y')=date_format(current_timestamp,'%d%m%y') 
and r.sector=rt.sl and rs.sl=rt.type and rs.operation=-1 and s.sl=r.lmby group by s.sl,s.name",[session('client_id'),session('branch')]);

     $abs=DB::select("select s.sl,name,father_name,c.class,phone_sms from student_information s,class c where c.sl=s.class and s.client_id=? and s.branch=? and s.class!=302 and s.sl not in (select user_id from attendance where date_format(entry_time,'%d%m%y')=date_format(current_timestamp,'%d%m%y')) order by s.class",[session('client_id'),session('branch')]);

     $abss=DB::select("select s.sl,name,father_name,d.designation,phone_sms from stuff_information s,designation d where d.sl=s.designation and s.client_id=? and s.branch=? and s.designation!=109 and s.sl not in (select user_id from attendance where date_format(entry_time,'%d%m%y')=date_format(current_timestamp,'%d%m%y')) order by d.designation",[session('client_id'),session('branch')]);

   

    
    
    return view('pages.deshboard')->with('stt',$stt)->with('sty',$sty)->with('stm',$stm)->with('todayCash',$todayCash)->with('activeStudent',$activeStudent)->with('activeStuff',$activeStuff)->with('att',$att)->with('coll',$coll)->with('colls',$colls)->with('abs',$abs)->with('b',$b)->with('d',$d)->with('l',$l)->with('abss',$abss)->with('atts',$atts);
  }
  public function ftp(Request $request)
{

  if (session('login')=='y') {


 
   if($request->hasFile('profile_image')) {
         
        //get filename with extension
        $filenamewithextension = $request->file('profile_image')->getClientOriginalName();

 
        //get filename without extension
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
 
        //get file extension
        $extension = $request->file('profile_image')->getClientOriginalExtension();
 
        //filename to store
        $filenametostore = $filename.'_'.uniqid().'.'.$extension;
        
        DB::insert("insert into ftp values (null,?,?,?,?,current_timestamp,?,0,28)",[$request->fn,$filenametostore,$request->type,$request->am,'pit-1']);
 
        //Upload File to external server
        Storage::disk('ftp')->put($filenametostore, fopen($request->file('profile_image'), 'r+'));
 
        //Store $filenametostore in the database
    }
   
  /*  $fileName='videoplayback_5e35c49f90069.mp4';
    
     $filecontent = Storage::disk('ftp')->get('videoplayback_5e35c49f90069.mp4'); // read file content 
           // download file.
           return Response::make($filecontent, '200', array(
                'Content-Type' => 'video/webm',
                'Content-Disposition' => 'inline; filename="'.$fileName.'"'
            ));*/
  return view('pages.ftp');
  }
 else
 {
   return view('pages.login');
 }
}

public function chpw(Request $request)
{
  if ($request->submit=='submit') {

    DB::update('update users set password=md5(?) where user_id=? and password=md5(?)',[$request->pwd1,session('user'),$request->username]);
  }


  

  return view('pages.chpw');
}

public function meal(Request $request)
{
  if ($request->sv=='sv') {
    

    for ($i=1; $i < 1001; $i++) { 
      $dm1='m1'.$i;
    $dm2='m2'.$i;
    $dm3='m3'.$i;
    $dsl='sl'.$i;
      DB::update("update hostel set meal1=?,meal2=?,meal3=? where sl=?",[
        $request->$dm1,
        $request->$dm2,
        $request->$dm3,
        $request->$dsl
      ]);
    }
  }
  if ($request->submit=='submit') {
      $chk=DB::select("select * from hostel where date_format(idate,'%Y-%m-%d')=? and client_id=? and branch=?",[$request->date,session('client_id'),session('branch')]);

  if (count($chk)==0) {
   DB::insert("insert into hostel select null,sl,?,null,null,null,?,? from student_information where class!=302 and  client_id=? and branch=? and HOSTEL_FEE>0",[$request->date,session('client_id'),session('branch'),session('client_id'),session('branch')]);
   DB::insert("insert into hostel select null,sl,?,null,null,null,?,? from stuff_information where designation!=109 and  client_id=? and branch=?",[$request->date,session('client_id'),session('branch'),session('client_id'),session('branch')]);

  }
  }

  $data=DB::select("select sl,sid,

case (select count(*) from student_information where sl=h.sid) 
    when 1 then 
    (select name from student_information where sl=h.sid)
    else 
    (select name from stuff_information where sl=h.sid) end name,

    case (select count(*) from student_information where sl=h.sid) 
    when 1 then 
    (select father_name from student_information where sl=h.sid)
    else 
    (select name from stuff_information where sl=h.sid) end father,

    case (select count(*) from student_information where sl=h.sid) 
    when 1 then 
    concat((select class from class where sl=(select class from student_information where sl=h.sid)),' - Student') 
    else concat((select designation from designation where sl=(select designation from stuff_information where sl=h.sid)),' - Stuff') end class,



     meal1,meal2,meal3,date_format(idate,'%d-%m-%y') idate from hostel h  where client_id=? and branch=? and date_format(idate,'%Y-%m-%d')=?",[session('client_id'),session('branch'),$request->date]);

  return view('pages.meal')->with('data',$data);;
}
  public function ftpv( $sl)
  {
    if (session('login')=='y') {
      $data=DB::select('select * from ftp where sl=?',[$sl]);
      foreach($data as $key)
      {
      $fileName=$key->filename;
    
     $filecontent = Storage::disk('ftp')->get($key->filename); // read file content 
           // download file.
           return Response::make($filecontent, '200', array(
                'Content-Type' => $key->filetype,
                'Content-Disposition' => $key->accessmode.'; filename="'.$fileName.'"'
            ));
          
      }
        }
 else
 {
   return view('pages.login');
 }
  }
  public function cardReg(Request $request)
  {
    
    if ($request->submit=='submit') {
      DB::update('update student_information set card_no=(select rfid from rfid_temp where client_id=?) where sl=?',[session('client_id'),$request->user_id]);

      DB::update('update stuff_information set card_no=(select rfid from rfid_temp where client_id=?) where sl=?',[session('client_id'),$request->user_id]);
    }
    return view ('pages.cardReg');
  }
public function att($p,$c,$id)
{
   
  
  if ($p==1) {
      $data=DB::select("SELECT date_format(now(),'%h:%i %p %d%b%y') t");
  foreach ($data as $key) {
    return $key->t;
  }
  }else
  {
    DB::delete("delete from rfid_temp where client_id=?",[$c]);
    DB::insert("insert into rfid_temp values(null,?,?)",[$id,$c]);
    $data=DB::select("SELECT sl,client_id,branch,PHONE_SMS FROM student_information where card_no=?",[$id]);

      if (count($data)==0) {
      $data=DB::select("SELECT sl,client_id,branch FROM stuff_information where card_no=?",[$id]);
  foreach ($data as $key) {

    //$da=DB::insert('insert into sms(phone,sms,status,client_id,branch) values (?,concat(?,DATE_FORMAT(now(), "%a, %d-%b-%y %h:%i %p")),?,?,?)',[$key->PHONE_SMS,'Your Child was Come at ',0,$key->client_id,$key->branch]);
      DB::insert('insert into attendance(USER_ID,ENTRY_TIME,CLIENT_ID,branch) values(?,CURRENT_TIME,?,?)',[$key->sl,$key->client_id,$key->branch]);
    return $key->sl;
  }
    }  
    if (count($data)==0) {
      $data=DB::select("SELECT rfid s FROM rfid_temp where rfid=?",[$id]);
  foreach ($data as $key) {
    return $key->s;
  }
    }



    foreach ($data as $key) {
      if ($c==14) {
        $da=DB::insert('insert into sms(phone,sms,status,client_id,branch) values (?,concat(?,DATE_FORMAT(now(), "%a, %d-%b-%y %h:%i %p")),?,?,?)',[$key->PHONE_SMS,'Your Child was Come at ',0,$key->client_id,$key->branch]);
      }
      
      DB::insert('insert into attendance(USER_ID,ENTRY_TIME,CLIENT_ID,branch) values(?,CURRENT_TIME,?,?)',[$key->sl,$key->client_id,$key->branch]);
    return $key->sl;

  }
    
  }

  
}
public function report_update($c)
{
  if ($c=='-1') {
    $data=DB::update("update client_information set report_update=1");
  }
$data=DB::update("update client_information set report_update=0 where client_id=".$c);
return 'ok';
}

public function reSendSms()
{
  
DB::update("update sms set STATUS=0 where lower(feedback)!='send' and client_id=".session('client_id'));
  return redirect('/list/sms');
}

public function clearSMS()
{
DB::delete("delete from sms where STATUS=1 and lower(feedback)='send' and client_id=".session('client_id'));
  return redirect('/list/sms');
}

public function smsPanel(Request $request,$tbl)
{

  session(['smstbl' => $tbl]);
  if ($request->submit=='submit') {
    foreach ($request->class as $key ) {
      if (session('smstbl')=='student_information') {
      DB::insert('insert into sms (phone,sms,status,client_id,branch) select PHONE_SMS,?,0,client_id,branch from '.$tbl.' where class=?',[$request->msg,$key]);
    }
      else{

        DB::insert('insert into sms (phone,sms,status,client_id,branch) select PHONE_SMS,?,0,client_id,branch from '.$tbl.' where designation=?',[$request->msg,$key]);

      }
    }
  }elseif (($request->submit1=='submit1')) {

      if (session('smstbl')=='student_information') {
      DB::insert('insert into sms (phone,sms,status,client_id,branch) select PHONE_SMS,?,0,client_id,branch from '.$tbl.' where sl=?',[$request->msg,$request->phone]);
    }
      else{

        DB::insert('insert into sms (phone,sms,status,client_id,branch) select PHONE_SMS,?,0,client_id,branch from '.$tbl.' where sl=?',[$request->msg,$request->phone]);

      }
    
  }
  DB::insert('insert into sms (phone,sms,status,client_id,branch) select ?,?,0,?,? ',[$request->phone,$request->msg,session('client_id'),session('branch')]);
  return view('pages.smsPanel');
}

public function resultEntry(Request $request)
{

  if ($request->get=='get') {
   session(['class' => $request->class]);
   session(['result' => '0']);
  }elseif($request->mlt=='mlt')
  {
    session(['class' => $request->class]);
    session(['p3' => $request->exam_name]);
    session(['ry' => $request->year]);
    session(['rcp' => '0']);
    
    echo "<body onload=".'"'."window.open('".url('/meritList')."','_blank')".'"'.">";
    //return redirect('/resultEntry');
  }
  elseif($request->rcp=='rcp')
  {
    session(['class' => $request->class]);
    session(['p3' => $request->exam_name]);
    session(['ry' => $request->year]);
    session(['rcp' => '1']);
    
    echo "<body onload=".'"'."window.open('".url('/meritList')."','_blank')".'"'.">";
    //return redirect('/resultEntry');
  }
  elseif($request->rsms=='rsms')
  {

    if ($request->id_!='0') {
      $ruid=DB::select("select phone_sms,s.sl sl,c.CLASS class,name from student_information s, class c where s.sl=? and c.sl=s.class",[$request->id_]);
    }
    else
    {
      $ruid=DB::select("select phone_sms,s.sl sl,c.CLASS class,name from student_information s, class c where s.class=? and c.sl=s.class",[$request->class]);
    }
    
    foreach ($ruid as $key ) {
       $d="select user_id, name, c.CLASS class,concat(sb.SHORT_NAME,'(', nvl(r.em".$request->exam_name.",' '),') : ', nvl(r.om".$request->exam_name.",'A')) mark from result r, student_information s, class c, subject sb where sb.sl=r.subject and  s.sl=r.USER_ID and r.class=".$request->class." and r.class=c.sl and date_format(idate,'%y')='".$request->year."' and user_id='".$key->sl."'";
    $data=DB::select($d);
    $msgRes="ID : ".$key->sl." Name :".$key->name." Class : ".$key->class;
    foreach ($data as $key1 ) {
      $msgRes=$msgRes." ".$key1->mark;
    }
    DB::insert("insert into sms values (null,?,?,0,?,?,null)",[$key->phone_sms,$msgRes,session('client_id'),session('branch')]);
    }
   
  }
  elseif($request->admit=='admit')
  {
    session(['p1' => 'admit1']);
session(['p2' => session('user')]);
session(['p3' => $request->exam_name]);

    DB::delete('delete from id_order where order_by='.session('user'));
    if ($request->id_=='0') {
  DB::insert("insert into id_order select null,sl,".session('user')." from student_information where class=".$request->class);
}else if ($request->id_>0)
{
DB::insert("insert into id_order select null,sl,".session('user')." from student_information where sl=".$request->id_);
}
    
   // echo "<body onload=".'"'."window.open('".url('/report')."','_blank')".'"'.">";
   return redirect('http://nazrif.com/report/'+'result'+'/'+'pdf'+'/'+'99'+'/'+'20'+'/'+'4'+'/b47145ac48477190d0c3bf116da9b141/4ae4a6fbd82a73f0ef4852638257c585/'+'result');
  }

  elseif ($request->entry=='entry') {

if ($this->chk_auth('listedit','result')==0 and session('user')!=99) {
  //return redirect('/login');
}
   
  $std=DB::select('select sl from student_information where class='.$request->class.' order by sl');


  foreach ($std as $key ) {
    $data=DB::select('select * from result where client_id='.session('client_id').' and branch='.session('branch').' and subject='.$request->subject.' and class='.$request->class." and DATE_FORMAT(idate,'%y')='20' and user_id=".$key->sl);


session(['result' => '1']);
    if (count($data)==0) {
      DB::insert(
        "
insert into result
select
null,
".$key->sl.",
CLASS,
sl,
EM1,
null,
EM2,
null,
EM3,
null,
EM4,
null,
EM5,
null,
EM6,
null,
EM7,
null,
EM8,
null,
EM9,
null,
EM10,
null,
EM11,
null,
EM12,
null,
null,
null,
null,
null,
now(),
null,
null,
".session('client_id').",
".session('branch')."
from subject where class=".$request->class." and sl=".$request->subject."
        "
      );
    }


  }
session(['exam_no' =>$request->exam_name ]);
   $data=DB::select('select em'.session('exam_no').' EM'.session('exam_no').',om'.session('exam_no').' OM'.session('exam_no').',(select concat(sl,'."' '".',name) from student_information where sl=r.user_id) USER_ID,uid  from result r where client_id='.session('client_id').' and branch='.session('branch').' and subject='.$request->subject.' and class='.$request->class." and DATE_FORMAT(idate,'%y')='20'");



   $col0=DB::select("SELECT * FROM application_item_lebel where table_name=? and column_name in ('om".session('exam_no')."','em".session('exam_no')."','user_id','uid') and input_type!=? order by column_position",['result','hidden']);
   $col1=$col0;
   $row=$col1;
   return view('pages.listtedit')->with('col0', $col0)->with('col1', $col1)->with('data', $data)->with('row', $row)->with('head', str_replace('_', ' ', 'result'));
 }else{return view('pages.resultEntry');}
 return view('pages.resultEntry');

  
}
public function chk_auth($p1,$p2)
{
$data=DB::select("select ap.url url from application_menu_pages p,application_menu m,application_pages ap where p.menu=m.id and ap.id=p.submenu and role=".session('page_role')." and lower(ap.url)=lower('/".$p1."/".$p2."')");

if (count($data)>0) {
   return 1;
 }else {

   
   return 0;
 } 
}

public function index()
{


 if (session('login')=='y') {

   $data=DB::select('select  * from stuff_information where sl=?',[session('user')]);

   $data1=DB::select('select  branch,sl from branch where client_id=?',[session('client_id')]);


   return view('pages.profile')->with('data', $data)->with('data1', $data1);
 }
 else
 {
   return view('pages.login');
 }
}




public function sms ($id)
{
  $u=DB::update("update sms s, student_information st set sms =concat('Dear ',name,', Your Admission process is successful. Your ID is : ',st.sl,' Thanks for being with us.'),s.phone=st.phone_sms where s.phone=st.sl and status=0 and sms='!@#$'
");
   $uu=DB::update("update sms set feedback='Send' where feedback like '%Ok: SMS Sent Successfully%' and status=1");
   $uuw=DB::update("delete from sms where feedback like '%invalid number%'" );
  $data1=DB::select('SELECT s.sl sl,s.phone phone,s.sms sms,u.CLIENT_ID client_id,c.sms_api sms_api FROM sms s, client_information c, users u where s.client_id=c.CLIENT_ID and u.CLIENT_ID=s.client_id and s.STATUS=0 and u.user_id=?  limit 1',[$id]);
  $data2=DB::select('SELECT s.sl sl,s.phone phone,s.sms sms,u.CLIENT_ID client_id,c.sms_api sms_api FROM sms s, client_information c, users u where s.client_id=c.CLIENT_ID and u.CLIENT_ID=s.client_id and s.STATUS=0 and u.user_id=?  ',[$id]);

  foreach ($data1 as $key ) {


$to = $key->phone;
$token = $key->sms_api;
$message = $key->sms;

$url = "http://api.greenweb.com.bd/api.php";


$data= array(
'to'=>"$to",
'message'=>"$message",
'token'=>"$token"
); // Add parameters in key value
$ch = curl_init(); // Initialize cURL
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_ENCODING, '');
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
$smsresult = curl_exec($ch);

$d=DB::update('UPDATE sms set status=1,feedback=? where sl=?',[$smsresult,$key->sl]);

    
  }
  return 'Total SMS : '.count($data2);
}

public function id($sms,$id)
{
 // return $id.'  '.$sms;

  $data=DB::select('select  client_id,name,image,(select institute from client_information where client_id=s.client_id) institute,(select client_domain from client_information where client_id=s.client_id) domain,(select designation from designation where sl=s.designation) tittle  from stuff_information s where sl=? or CARD_NO=?',[$id,$id]);
  if (count($data)>0) {

     
return view ('pages.id')->with('data',$data)->with('s','Stuff Identity')->with('i','stuffImage');

    
  }else
  {
    $data=DB::select('select  client_id,branch,name,image,(select institute from client_information where client_id=s.client_id) institute,(select client_domain from client_information where client_id=s.client_id) domain,(select class from class where sl=s.class) tittle,PHONE_SMS from student_information s where sl=? or CARD_NO=?',[$id,$id]);

    if ($sms=='1') {
     
    foreach ($data as $key ) {
      $da=DB::insert('insert into sms(phone,sms,status,client_id,branch) values (?,concat(?,DATE_FORMAT(now(), "%a, %d-%b-%y %h:%i %p")),?,?,?)',[$key->PHONE_SMS,'Your Child was Come at ',0,$key->client_id,$key->branch]);
      DB::insert('insert into attendance(USER_ID,ENTRY_TIME,CLIENT_ID,branch) values(?,CURRENT_TIME,?,?)',[$id,$key->client_id,$key->branch]);
    }}
return view ('pages.id')->with('data',$data)->with('s','Student Identity')->with('i','studentImage');

  }
 

  
}

public function sms_insert($phone,$sms,$CUSTOMER_ID,$branch,$status)
{
  $data=DB::insert('INSERT into sms (phone,sms,client_id,branch,status) values (?,?,?,?,?)',[$phone,$sms,$CUSTOMER_ID,$branch,$status]);
}

public function stdFeesCollr(Request $request)
{

    if ($request->get_fee1=='get_fee1') {
        $data1=DB::select("select  concat(' Name: ',name,' Designation: ',(select designation from designation where sl=s.designation)) data,sl from stuff_information s".' where client_id='.session('client_id').' and branch='.session('branch')." and s.sl=".$request->user_id);

session(['std_fee_uid' => $request->user_id]);
session(['std_fee_tdate' => $request->tdate]);
foreach ($data1 as $key ) {
  session(['stuff_info' => $key->data]);
}
return redirect('/stuffFeesColl');
}
  ////////////////////*/////////////
                session(['h' => 'student']);
        session(['hs' => 'Student ID']);
        session(['hd' => 'Class']);
        $query='';
        $datan=DB::select('select * from revenue_type where client_id='.session('client_id').' and branch='.session('branch').' and type=9 order by sl');
        $data1n=$datan;
        $data2n=$datan;


         $query=$query. "select ";
        $query=$query. "STUDENT_ID,name,c.class class, ";
        foreach ($datan as $key ) {
         $query=$query. 'sum(IF(sector = '.$key->SL.', ammount, NULL)) AS a'.$key->SL.',';  
         $query=$query.'max(IF(sector = '.$key->SL.', fee, NULL))-sum(IF(sector = '.$key->SL.', ammount, NULL)) AS d'.$key->SL.',';       
        }
         $query=$query. ",from revenue r, student_information s, class c where r.STUDENT_ID=s.SL and c.sl=s.CLASS and 
         r.CLIENT_ID=".session('client_id')." and r.branch=".session('branch')." and s.sl=".$request->user_id." group by student_id,name,c.class";
$query=str_replace(',,',' ',$query);
//return $query;

$row1n=DB::select($query);


     //return $row1;   

       // return view('pages.paymentList')->with('datan', $datan)->with('data1n', $data1n)->with('row1n', $row1n)->with('data2n', $data2n);


        ////////////////////*////////////////
  if ($request->get_fee=='get_fee') {
        $data1=DB::select("select  concat(' Name: ',name,' Class: ',(select class from class where sl=s.class)) data,sl from student_information s".' where client_id='.session('client_id').' and branch='.session('branch')." and s.sl=".$request->user_id);


foreach ($data1 as $key ) {
  session(['std_info' => $key->data]);
}
session(['std_fee_uid' => $request->user_id]);
session(['std_fee_tdate' => $request->tdate]);
    $data=DB::delete('delete from revenue_student_temp_fee where iby=?',[session('user')] );
    $data=DB::select('select ADMISSION_FEE,MONTHLY_FEE,HOSTEL_FEE,EXAM_FEE,OTHER_FEE,TRANSPORT,TRANSPORT_FEE,EXAM_FEE_2,EXAM_FEE_3,ICT_CHARGE from  student_information where sl=?',[$request->user_id]);

    foreach ($data as $key ) {

      DB::insert('insert into revenue_student_temp_fee values (null,?,?,?,?)',
        [
          $request->user_id,
          ucwords(str_replace('_',' ',strtolower('ADMISSION_FEE'))),
          $key->ADMISSION_FEE,
          session('user')
        ]);

      DB::insert('insert into revenue_student_temp_fee values (null,?,?,?,?)',
        [
          $request->user_id,
          ucwords(str_replace('_',' ',strtolower('MONTHLY_FEE'))),
          $key->MONTHLY_FEE,
          session('user')
        ]);

      DB::insert('insert into revenue_student_temp_fee values (null,?,?,?,?)',
        [
          $request->user_id,
          ucwords(str_replace('_',' ',strtolower('HOSTEL_FEE'))),
          $key->HOSTEL_FEE,
          session('user')
        ]);

      DB::insert('insert into revenue_student_temp_fee values (null,?,?,?,?)',
        [
          $request->user_id,
          ucwords(str_replace('_',' ',strtolower('EXAM_FEE'))),
          $key->EXAM_FEE,
          session('user')
        ]);

      DB::insert('insert into revenue_student_temp_fee values (null,?,?,?,?)',
        [
          $request->user_id,
          ucwords(str_replace('_',' ',strtolower('EXAM_FEE_2'))),
          $key->EXAM_FEE_2,
          session('user')
        ]);

      DB::insert('insert into revenue_student_temp_fee values (null,?,?,?,?)',
        [
          $request->user_id,
          ucwords(str_replace('_',' ',strtolower('EXAM_FEE_3'))),
          $key->EXAM_FEE_3,
          session('user')
        ]);

      DB::insert('insert into revenue_student_temp_fee values (null,?,?,?,?)',
        [
          $request->user_id,
          ucwords(str_replace('_',' ',strtolower('OTHER_FEE'))),
          $key->OTHER_FEE,
          session('user')
        ]);

      DB::insert('insert into revenue_student_temp_fee values (null,?,?,?,?)',
        [
          $request->user_id,
          ucwords(str_replace('_',' ',strtolower('TRANSPORT'))),
          $key->TRANSPORT,
          session('user')
        ]);

      DB::insert('insert into revenue_student_temp_fee values (null,?,?,?,?)',
        [
          $request->user_id,
          ucwords(str_replace('_',' ',strtolower('TRANSPORT_FEE'))),
          $key->TRANSPORT_FEE,
          session('user')
        ]);

      

      DB::insert('insert into revenue_student_temp_fee values (null,?,?,?,?)',
        [
          $request->user_id,
          ucwords(str_replace('_',' ',strtolower('ICT_CHARGE'))),
          $key->ICT_CHARGE,
          session('user')
        ]);

     $tfee=DB::select("select * from revenue_student_temp_fee where iby=".session('user')." order by sl");


  $data=DB::select("select  concat('ID: ',sl,' Name:',name,' Class: ',(select class from class where sl=s.class)) data,sl from student_information s".' where client_id='.session('client_id').' and branch='.session('branch'));

  $fees=DB::select("select  sl,description from revenue_type".' where client_id='.session('client_id').' and branch='.session('branch') .' and salary_type in (2) and sl not in('."select 
r.sector sector

from student_information s, revenue_type rt,revenue r where r.sector=rt.sl and r.CLIENT_ID=".session('client_id')." and r.branch=".session('branch')."
and r.sector!=0 and s.sl=r.student_id and r.fee>0 and r.student_id=".$request->user_id."
group by 
rt.description,
r.sector,
r.student_id 
having 
max(r.fee)<=
sum(r.ammount)".')'.'order by sl');

  $fees1=$fees;

  return view('pages.stdFeesColl')->with('data',$data)->with('fees',$fees)->with('fees1',$fees1)->with('tfee',$tfee)->with('datan', $datan)->with('data1n', $data1n)->with('row1n', $row1n)->with('data2n', $data2n);
    }
    
  }elseif ($request->submit=='submit') {
    # code...
  
  session(['std_fee_uid' => '0']);
$data=DB::delete('delete from revenue_student_temp_fee where iby=?',[session('user')] );

  $revenue_sl=$this->revenue_sl();
  for ($i=0; $i <20 ; $i++) { 
    $ammount='ammount'.$i;
    $sub_sl='sub_sl'.$i;
    $description='description'.$i;
    $sector='sector'.$i;
    $fees='fees'.$i;

    if ($request->$ammount>0) {
     $data=DB::insert('INSERT into revenue
      (
      sl,
      sub_sl,
      ammount,
      description,
      sector,
      lmby,
      lmdate,
      student_id,
      client_id,
      branch,
      fee
    ) values (?,?,?,(select description from revenue_type where sl=?),?,?,current_timestamp,?,?,?,?)',[
      $revenue_sl,
      $i,
      $request->$ammount,
      $request->$sector,
      $request->$sector,
      session('user'),
      $request->user_id,
      session('client_id'),
      session('branch'),
      $request->$fees


    ]);
     if (session('client_id')=='15') {
       $data=DB::update('UPDATE revenue set transfer_date=? where sl=?',[$request->tdate,$revenue_sl]);
     }
   }

 }


 $d=DB::select('select PHONE_SMS from student_information where sl=?',[$request->user_id]);
 if (count($d)>0) {
  foreach ($d as $key ) {
    $data=DB::select('select dic_rev_des('.$revenue_sl.') a ');
        foreach ($data as $key1 ) {
          $this->sms_insert($key->PHONE_SMS,$key1->a.' of ID : '.$request->user_id,session('client_id'),session('branch'),0);
        }
    
    //sms_insert($phone,$sms,$CUSTOMER_ID,$status)
  }
  
 }else
 {
  $d=DB::select('select PHONE_SMS from stuff_information where sl=?',[$request->user_id]);
    foreach ($d as $key ) {
    $data=DB::select('select dic_rev_des('.$revenue_sl.') a ');
        foreach ($data as $key1 ) {
          $this->sms_insert($key->PHONE_SMS,$key1->a.' of ID : '.$request->user_id,session('client_id'),session('branch'),0);
        }
    
    //sms_insert($phone,$sms,$CUSTOMER_ID,$status)
  }
 }

 session(['p1' => 'receipt']);
 session(['p2' => $revenue_sl]);



echo "<body onload=".'"'."window.location='".url('/stdFeesColl')."'"."; window.open('".url('/report')."','_blank')".'"'.">";



 //return redirect('/stdFeesColl');

}

}

public function accCollr(Request $request)
{
  DB::update("update revenue set fee=AMMOUNT  WHERE  date_format(lmdate,'%y')='20' and fee=0");
  if ($request->get_fee=='get_fee') {



session(['std_fee_uid' => $request->user_id]);
session(['std_fee_tdate' => $request->tdate]);
    $data=DB::delete('delete from revenue_student_temp_fee where iby=?',[session('user')] );
    $data=DB::select('select ADMISSION_FEE,MONTHLY_FEE,HOSTEL_FEE,EXAM_FEE,OTHER_FEE,TRANSPORT,TRANSPORT_FEE,EXAM_FEE_2,EXAM_FEE_3,ICT_CHARGE from  student_information where sl=?',[$request->user_id]);

    foreach ($data as $key ) {

      DB::insert('insert into revenue_student_temp_fee values (null,?,?,?,?)',
        [
          $request->user_id,
          ucwords(str_replace('_',' ',strtolower('ADMISSION_FEE'))),
          $key->ADMISSION_FEE,
          session('user')
        ]);

      DB::insert('insert into revenue_student_temp_fee values (null,?,?,?,?)',
        [
          $request->user_id,
          ucwords(str_replace('_',' ',strtolower('MONTHLY_FEE'))),
          $key->MONTHLY_FEE,
          session('user')
        ]);

      DB::insert('insert into revenue_student_temp_fee values (null,?,?,?,?)',
        [
          $request->user_id,
          ucwords(str_replace('_',' ',strtolower('HOSTEL_FEE'))),
          $key->HOSTEL_FEE,
          session('user')
        ]);

      DB::insert('insert into revenue_student_temp_fee values (null,?,?,?,?)',
        [
          $request->user_id,
          ucwords(str_replace('_',' ',strtolower('EXAM_FEE'))),
          $key->EXAM_FEE,
          session('user')
        ]);

      DB::insert('insert into revenue_student_temp_fee values (null,?,?,?,?)',
        [
          $request->user_id,
          ucwords(str_replace('_',' ',strtolower('EXAM_FEE_2'))),
          $key->EXAM_FEE_2,
          session('user')
        ]);

      DB::insert('insert into revenue_student_temp_fee values (null,?,?,?,?)',
        [
          $request->user_id,
          ucwords(str_replace('_',' ',strtolower('EXAM_FEE_3'))),
          $key->EXAM_FEE_3,
          session('user')
        ]);

      DB::insert('insert into revenue_student_temp_fee values (null,?,?,?,?)',
        [
          $request->user_id,
          ucwords(str_replace('_',' ',strtolower('OTHER_FEE'))),
          $key->OTHER_FEE,
          session('user')
        ]);

      DB::insert('insert into revenue_student_temp_fee values (null,?,?,?,?)',
        [
          $request->user_id,
          ucwords(str_replace('_',' ',strtolower('TRANSPORT'))),
          $key->TRANSPORT,
          session('user')
        ]);

      DB::insert('insert into revenue_student_temp_fee values (null,?,?,?,?)',
        [
          $request->user_id,
          ucwords(str_replace('_',' ',strtolower('TRANSPORT_FEE'))),
          $key->TRANSPORT_FEE,
          session('user')
        ]);

      

      DB::insert('insert into revenue_student_temp_fee values (null,?,?,?,?)',
        [
          $request->user_id,
          ucwords(str_replace('_',' ',strtolower('ICT_CHARGE'))),
          $key->ICT_CHARGE,
          session('user')
        ]);

     $tfee=DB::select("select * from revenue_student_temp_fee where iby=".session('user')." order by sl");


  $data=DB::select("select  concat('ID: ',sl,' Name:',name,' Class: ',(select class from class where sl=s.class)) data,sl from student_information s".' where client_id='.session('client_id').' and branch='.session('branch'));

  $fees=DB::select("select  sl,description from revenue_type".' where client_id='.session('client_id').' and branch='.session('branch'));

  $fees1=$fees;

  return view('pages.accountColl')->with('data',$data)->with('fees',$fees)->with('fees1',$fees1)->with('tfee',$tfee);
    }
    
  }elseif ($request->submit=='submit') {
    # code...
  
  
$data=DB::delete('delete from revenue_student_temp_fee where iby=?',[session('user')] );

  $revenue_sl=$this->revenue_sl();
  for ($i=0; $i <20 ; $i++) { 
    $ammount='ammount'.$i;
    $sub_sl='sub_sl'.$i;
    $description='description'.$i;
    $sector='sector'.$i;
    $fees='fees'.$i;

    if ($request->$ammount>0) {

     $data=DB::insert('INSERT into revenue
      (
      sl,
      sub_sl,
      ammount,
      description,
      sector,
      lmby,
      lmdate,
      student_id,
      client_id,
      branch,
      fee
    ) values (?,?,?,?,?,?,current_timestamp,?,?,?,?)',[
      $revenue_sl,
      $i,
      $request->$ammount,
      $request->$description,
      $request->$sector,
      session('user'),
      $request->user_id,
      session('client_id'),
      session('branch'),
      '0'


    ]);
     if (session('client_id')=='15') {
       $data=DB::update('UPDATE revenue set transfer_date=? where sl=?',[$request->tdate,$revenue_sl]);
     }
   }

 }


 
  


 session(['p1' => 'receipt']);
 session(['p2' => $revenue_sl]);



 

echo "<body onload=".'"'."window.location='".url('/accColl')."'"."; window.open('".url('/report')."','_blank')".'"'.">";

}

}

public function revenuePrint(Request $request)

{


   //echo "<body onload=window.location='".url('/revenuePrint')."'>";
  //echo "<body onload=window.location='".'http://localhost/report/'.session('user')."'>";
  //return view ('pages.revenuePrint');
  //echo "<body onload=".'"'."window.open('".'http://localhost/report/'.session('user')."','_blank')"."; window.open('".'http://localhost/report/'.session('user')."','_blank')".'"'.">";

  if ($request->submit=='submit') {
if (session('client_id')==15) {
session(['p1' => 'revenue_td']);
}else
{
  session(['p1' => 'revenue']);
}

session(['p2' => $request->sdate]);
session(['p3' => $request->edate]);
session(['p4' => session('client_id')]);
session(['p5' => session('branch')]);
session(['pt' => $request->pt]);
session(['dreset' => '1']);
session(['dp2' => $request->sdate]);
session(['dp3' => $request->edate]);

     echo "<body onload=".'"'."window.open('".url('/report')."','_blank')".'"'.">";
   return view ('pages.revenuePrint');
   
  }else{session(['dreset' => '0']);return view ('pages.revenuePrint');}
}

public function report()

{


  if(session()->has('p1'))
  {
    if (session('p1')=='receipt') {
      if (session('client_id')=='3') {
        session(['p1' => '/3/a4_receipt']);
      }elseif (session('client_id')=='10') {
        session(['p1' => '/10/receipt']);
        session(['p1' => '/10/receipt']);
        //dic_rev_des(s.sl)
        $data=DB::select('select dic_rev_des('.session('p2').') a ');

        foreach ($data as $key ) {

          $data=DB::delete("delete from report_dic_rev_des where sl=".session('p2'));
           $data=DB::insert("insert into report_dic_rev_des values ('".$key->a."','".session('p2')."','".session('user')."') ");
         

        }
      }
      elseif (session('client_id')=='18') {
        session(['p1' => '/18/receipt']);
        session(['p1' => '/18/receipt']);
        //dic_rev_des(s.sl)
        $data=DB::select('select dic_rev_des('.session('p2').') a ');

        foreach ($data as $key ) {

          $data=DB::delete("delete from report_dic_rev_des where sl=".session('p2'));
           $data=DB::insert("insert into report_dic_rev_des values ('".$key->a."','".session('p2')."','".session('user')."') ");
         

        }
      }
    }

    $reportUrl='http://localhost:8080/JasperReportsIntegration/report?_repName=/clientReport/'.session('p1').'&_repFormat=pdf&_dataSource=default&_outFilename=&_repLocale=de_DE&_repEncoding=UTF-8&parameter1='.session('p2').'&parameter2='.session('p3').'&parameter3=6';

   $reportUrl1='http://localhost:8080/JasperReportsIntegration/report?_repName=/clientReport/'.session('p1').'&_repFormat=pdf&_dataSource=default&_outFilename=&_repLocale=de_DE&_repEncoding=UTF-8&parameter1='.session('p2').'&parameter2='.session('p3').'&parameter3='.session('p4').'&parameter4='.session('p5');
 

if (session('pt')=='2') {
  $reportUrl1='http://localhost:8080/JasperReportsIntegration/report?_repName=/clientReport/'.session('p1').'&_repFormat=rtf&_dataSource=default&_outFilename=report.rtf&_repLocale=de_DE&_repEncoding=UTF-8&parameter1='.session('p2').'&parameter2='.session('p3').'&parameter3='.session('p4').'&parameter4='.session('p5');

  echo "<body onload=window.location='".$reportUrl1."'>";
}
    $reportUrlXls='http://localhost:8080/JasperReportsIntegration/report?_repName=/clientReport/'.session('p1').'&_repFormat=xls&_dataSource=default&_outFilename=&_repLocale=de_DE&_repEncoding=UTF-8&parameter1='.session('p2').'&parameter2=ghfg&parameter3=6';


    if (session('p1')=='receipt') {
      $data=DB::delete('DELETE from report_url where user_id=?',[session('user')]);
    $data=DB::insert('INSERT into report_url values (?,?)',[session('user'),$reportUrlXls]);
    }


    $dataof=DB::delete('delete from  report_offline where uid=?',[session('user')]);
    $dataof=DB::insert('INSERT into report_offline values (?,?,?)',
      [
        $reportUrl1,
        session('p1'),
        session('user')
      ]);
    

if (session('client_id')=='10') {

  return redirect('http://nazrif.com/report/'+'result'+'/'+'pdf'+'/'+'99'+'/'+'20'+'/'+'4'+'/b47145ac48477190d0c3bf116da9b141/4ae4a6fbd82a73f0ef4852638257c585/'+'result');
}
else
{
  echo "<body onload=window.location='".'http://localhost/report/'.session('user')."'>";
}
     

    //echo '<h1><a href="'.'http://localhost/report/'.session('user').'">Print</a></h1>';

    /*$filename = 'report.pdf';
  return Response::make(file_get_contents('http://localhost:8080/JasperReportsIntegration/report?_repName='.session('p1').'&_repFormat=pdf&_dataSource=default&_outFilename=&_repLocale=de_DE&_repEncoding=UTF-8&parameter1='.session('p2').'&parameter2=ghfg&parameter3=6'), 200, [
    'Content-Type' => 'application/pdf',
    'Content-Disposition' => 'inline; filename="'.$filename.'"'
  ]);*/





}else{return redirect('/login');}

}

public function report_print($report,$id)

{

  if ($report=='ftp') {
    return redirect('/ftpv/'.$id);
  }

  session(['p1' => $report]);
  session(['p2' => $id]);
  if (session('rcp')!=1) {
    session(['p3' => '']);
  }else
  {
    session(['p3' => session('ry')]);
  }
  
  if(session()->has('p1'))
  {
    if (session('p1')=='receipt') {
      if (session('client_id')=='3') {
        session(['p1' => '/3/a4_receipt']);
      }elseif (session('client_id')=='10') {
        session(['p1' => '/10/receipt']);
        //dic_rev_des(s.sl)
        $data=DB::select('select dic_rev_des('.session('p2').') a ');

        foreach ($data as $key ) {

          $data=DB::delete("delete from report_dic_rev_des where sl=".session('p2'));
           $data=DB::insert("insert into report_dic_rev_des values ('".$key->a."','".session('p2')."','".session('user')."') ");
         

        }
      }
      elseif (session('client_id')=='18') {
        session(['p1' => '/18/receipt']);
        //dic_rev_des(s.sl)
        $data=DB::select('select dic_rev_des('.session('p2').') a ');

        foreach ($data as $key ) {

          $data=DB::delete("delete from report_dic_rev_des where sl=".session('p2'));
           $data=DB::insert("insert into report_dic_rev_des values ('".$key->a."','".session('p2')."','".session('user')."') ");
         

        }
      }
    }

    $reportUrl='http://localhost:8080/JasperReportsIntegration/report?_repName=/clientReport/'.session('p1').'&_repFormat=pdf&_dataSource=default&_outFilename=&_repLocale=de_DE&_repEncoding=UTF-8&parameter1='.session('p2').'&parameter2='.session('p3').'&parameter3=6';

    $reportUrl1='http://localhost:8080/JasperReportsIntegration/report?_repName=/clientReport/'.session('p1').'&_repFormat=pdf&_dataSource=default&_outFilename=&_repLocale=de_DE&_repEncoding=UTF-8&parameter1='.session('p2').'&parameter2='.session('p3').'&parameter3='.session('p4');




    $reportUrlXls='http://localhost:8080/JasperReportsIntegration/report?_repName=/clientReport/'.session('p1').'&_repFormat=xls&_dataSource=default&_outFilename=&_repLocale=de_DE&_repEncoding=UTF-8&parameter1='.session('p2').'&parameter2='.session('p3').'&parameter3='.session('p4');




    if (session('p1')=='receipt') {
      $data=DB::delete('DELETE from report_url where user_id=?',[session('user')]);
    $data=DB::insert('INSERT into report_url values (?,?)',[session('user'),$reportUrlXls]);
    }
    
     $dataof=DB::delete('delete from  report_offline where uid=?',[session('user')]);
    $dataof=DB::insert('INSERT into report_offline values (?,?,?)',
      [
        $reportUrl1,
        session('p1'),
        session('user')
      ]);


    

    if (session('client_id')=='10') {
 
  
  echo "<body onload=window.location='".'http://nazrif.com/report/'.'result'.'/'.'pdf'.'/'.session('p2').'/'.session('p3').'/'.session('p4').'/b47145ac48477190d0c3bf116da9b141/4ae4a6fbd82a73f0ef4852638257c585/'.'result'."'>";
}
else
{
  echo "<body onload=window.location='".'http://localhost/report/'.session('user')."'>";
}





    /*$filename = 'report.pdf';
  return Response::make(file_get_contents('http://localhost:8080/JasperReportsIntegration/report?_repName='.session('p1').'&_repFormat=pdf&_dataSource=default&_outFilename=&_repLocale=de_DE&_repEncoding=UTF-8&parameter1='.session('p2').'&parameter2=ghfg&parameter3=6'), 200, [
    'Content-Type' => 'application/pdf',
    'Content-Disposition' => 'inline; filename="'.$filename.'"'
  ]);*/





}else{return redirect('/login');}

}


public function receiptPrint($id)
{
  $data=DB::select('select url from report_url where user_id=?',[$id]);
  $del=DB::delete('DELETE from report_url where user_id=?',[$id]);
  if (count($data)>0) {
  foreach ($data as $key ) {   
    return $key->url;
  }
  }else{return 0;}

}

public function stdFeesColl()
{
session(['std_fee_uid' => '0']);
session(['std_fee_tdate' => '0']);
 if (session('login')=='y') {
$data=DB::delete('delete from revenue_student_temp_fee where iby=?',[session('user')] );

  $data=DB::select("select  concat('ID: ',sl,' Name:',name,' Class: ',(select class from class where sl=s.class)) data,sl from student_information s".' where client_id='.session('client_id').' and branch='.session('branch'));

  $fees=DB::select("select  sl,description from revenue_type".' where client_id='.session('client_id').' and branch='.session('branch').' and salary_type=2 order by sl');

  $fees1=$fees;

  $tfee=DB::select("select * from revenue_student_temp_fee where iby=".session('user'));

  return view('pages.stdFeesColl')->with('data',$data)->with('fees',$fees)->with('fees1',$fees1)->with('tfee',$tfee);
}
else
{
 return view('pages.login');
}
}

public function stuffFeesColl()
{

 if (session('login')=='y') {


  $data=DB::select("select  concat('ID: ',sl,' Name:',name,' Designation: ',(select designation from designation where sl=s.designation)) data,sl from stuff_information s".' where client_id='.session('client_id').' and branch='.session('branch'));

  $fees=DB::select("select  sl,description from revenue_type".' where client_id='.session('client_id').' and branch='.session('branch').' and salary_type in (1) order by sl');

  $fees1=$fees;

  return view('pages.stuffFeesColl')->with('data',$data)->with('fees',$fees)->with('fees1',$fees1);
}
else
{
 return view('pages.login');
}
}

public function accColl()
{

 if (session('login')=='y') {


  $data=DB::select("select  concat('ID: ',sl,' Name:',name,' Designation: ',(select designation from designation where sl=s.designation)) data,sl from stuff_information s".' where client_id='.session('client_id').' and branch='.session('branch'));

  $fees=DB::select("select  sl,description from revenue_type".' where client_id='.session('client_id').' and branch='.session('branch').' and salary_type in (1,3) order by sl');

  $fees1=$fees;

  return view('pages.accountColl')->with('data',$data)->with('fees',$fees)->with('fees1',$fees1);
}
else
{
 return view('pages.login');
}
}

public function active_branch(Request $request)
{
  session(['branch' => $request->branch]);
  $data=DB::select('select  * from stuff_information where sl=?',[session('user')]);

  $data1=DB::select('select  branch,sl from branch where client_id=?',[session('client_id')]);


  return view('pages.profile')->with('data', $data)->with('data1', $data1);
}





public function loginPage()
{

  session()->forget('page_role');
  session()->forget('institute');
  session()->forget('login');
  session()->forget('p1');
  session()->forget('p2');
  session()->forget('p3');
  session()->forget('p4');

  session(['company' => 'SR Builders']);
  session(['company_url' => 'jisan.info']);
  //session()->flush();
  return view('pages.login');
}

public function login(Request $request)
{
  session()->forget('login');
  $auth=DB::select('select  client_id,page_role,branch from users where user_id=? and password=MD5(?) and active=1',[$request->user_id, $request->password]);

  DB::statement("SET time_zone = '+06:00'");



  foreach ($auth as $key => $value) {
    session(['client_id' => $value->client_id]);
    session(['branch' => $value->branch]);
    session(['user' => $request->user_id]);
    session(['page_role' => $value->page_role]);

    $fv=DB::select("select company,company_url,INSTITUTE from client_information where CLIENT_ID=".$value->client_id);
    foreach ($fv as $key ) {

      session(['company' => $key->company]);
      session(['company_url' => $key->company_url]);
      session(['institute' => $key->INSTITUTE]);


      
    }



  }




  if (count($auth)==1) 
  {
    session(['login' => 'y']);
    $data=DB::select('select  * from stuff_information where sl=?',[session('user')]);

    $data1=DB::select('select  branch,sl from branch where client_id=?',[session('client_id')]);


    
    if (session('user')=='99') {
       DB::update("UPDATE `application_item_lebel` SET `client_id` = '".session('client_id')."', `branch` = '".session('branch')."'");


    }
    //return view('pages.profile')->with('data', $data)->with('data1', $data1);
    //deshboard.blade.php

    return redirect('/home');



  }else
  {
    session(['login' => 'n']);
    return view('pages.login');
  }



}

public function login_client($cd)
{
 // session()->forget('login');
if (session('user')=='99') {
  $id;
  $cl=DB::select('Select sl from stuff_information where CLIENT_ID=? limit 1',[$cd]);
    foreach ($cl as $key ) {
      $id=$key->sl;
    }

  $auth=DB::select('select  client_id,page_role,branch from users where user_id=?  and active=1',[$id]);

 

  DB::statement("SET time_zone = '+06:00'");



  foreach ($auth as $key => $value) {
    session(['client_id' => $value->client_id]);
    session(['branch' => $value->branch]);
    //session(['user' => $id]);
    session(['user' => '99']);
    session(['page_role' => '1']);

    $fv=DB::select("select company,company_url,INSTITUTE from client_information where CLIENT_ID=".$value->client_id);
    foreach ($fv as $key ) {

      session(['company' => $key->company]);
      session(['company_url' => $key->company_url]);
      session(['institute' => $key->INSTITUTE]);


      
    }



  }




  if (count($auth)==1) 
  {
    session(['login' => 'y']);
    $data=DB::select('select  * from stuff_information where sl=?',[$id]);

    $data1=DB::select('select  branch,sl from branch where client_id=?',[session('client_id')]);


    
    if (session('user')=='99') {
       DB::update("UPDATE `application_item_lebel` SET `client_id` = '".session('client_id')."', `branch` = '".session('branch')."'");


    }
    return view('pages.profile')->with('data', $data)->with('data1', $data1);

  }else
  {
    session(['login' => 'n']);
    return redirect('/login');
  }

}else {
  return redirect('/login');
}

}

public function list($id)
{



 if (session('login')=='y') {

if ($this->chk_auth('list',$id)==0 and session('user')!=99) {
 // return redirect('/login');
}
  


   $data=DB::select('select * from '.$id.' where client_id in (0,'.session('client_id').') and branch in (9,'.session('branch').')');
   $col0=DB::select('SELECT * FROM application_item_lebel where table_name=? and input_type!=? order by column_position',[$id,'hidden']);
   $col1=$col0;
   $row=$col1;
   return view('pages.list')->with('col0', $col0)->with('col1', $col1)->with('data', $data)->with('row', $row)->with('head', str_replace('_', ' ', $id));
 }
 else
 {
  return redirect('/');
}
}

public function stdRevlistt($id)
{



 if (session('login')=='y') {

if ($this->chk_auth('list',$id)==0 and session('user')!=99) {
 // return redirect('/login');
}
  


   $data=DB::select('select * from '.$id.' where client_id in (0,'.session('client_id').') and branch in (9,'.session('branch').') and student_id in (select sl from student_information '.' where  client_id in (0,'.session('client_id').') and branch in (9,'.session('branch').')) ');
   $col0=DB::select('SELECT * FROM application_item_lebel where table_name=? and input_type!=? order by column_position',[$id,'hidden']);
   $col1=$col0;
   $row=$col1;
   return view('pages.listt')->with('col0', $col0)->with('col1', $col1)->with('data', $data)->with('row', $row)->with('head', str_replace('_', ' ', $id));
 }
 else
 {
  return redirect('/');
}
}


public function empRevlistt($id)
{



 if (session('login')=='y') {

if ($this->chk_auth('list',$id)==0 and session('user')!=99) {
 // return redirect('/login');
}
  


   $data=DB::select('select * from '.$id.' where client_id in (0,'.session('client_id').') and branch in (9,'.session('branch').') and student_id in (select sl from stuff_information '.' where  client_id in (0,'.session('client_id').') and branch in (9,'.session('branch').')) ');
   $col0=DB::select('SELECT * FROM application_item_lebel where table_name=? and input_type!=? order by column_position',[$id,'hidden']);
   $col1=$col0;
   $row=$col1;
   return view('pages.listt')->with('col0', $col0)->with('col1', $col1)->with('data', $data)->with('row', $row)->with('head', str_replace('_', ' ', $id));
 }
 else
 {
  return redirect('/');
}
}


public function listt($id)
{



 if (session('login')=='y') {

if ($this->chk_auth('list',$id)==0 and session('user')!=99) {
 // return redirect('/login');
}
  


   $data=DB::select('select * from '.$id.' where client_id in (0,'.session('client_id').') and branch in (9,'.session('branch').')');
   $col0=DB::select('SELECT * FROM application_item_lebel where table_name=? and input_type!=? order by column_position',[$id,'hidden']);
   $col1=$col0;
   $row=$col1;
   return view('pages.listt')->with('col0', $col0)->with('col1', $col1)->with('data', $data)->with('row', $row)->with('head', str_replace('_', ' ', $id));
 }
 else
 {
  return redirect('/');
}
}


public function listEdit($id,$te)
{



 if (session('login')=='y') {

if ($this->chk_auth('listedit',$id)==0 and session('user')!=99) {
  //return redirect('/login');
}
   $data=DB::select('select * from '.$id.' where client_id='.session('client_id').' and branch='.session('branch'));

if ($id=='application_item_lebel') {
  $data=DB::select('select * from '.$id.' where client_id='.session('client_id').' and branch='.session('branch').' and table_name=?',[strtolower($te)]);
}

   $col0=DB::select('SELECT * FROM application_item_lebel where table_name=? and input_type!=? order by column_position',[$id,'hidden']);
   $col1=$col0;
   $row=$col1;
   return view('pages.listEdit')->with('col0', $col0)->with('col1', $col1)->with('data', $data)->with('row', $row)->with('head', str_replace('_', ' ', $id));
 }
 else
 {
  return redirect('/');
}
}

public function listEditt($id,$te)
{



 if (session('login')=='y') {

if ($this->chk_auth('listedit',$id)==0 and session('user')!=99) {
  //return redirect('/login');
}
   $data=DB::select('select * from '.$id.' where client_id='.session('client_id').' and branch='.session('branch'));

if ($id=='application_item_lebel') {
  $data=DB::select('select * from '.$id.' where client_id='.session('client_id').' and branch='.session('branch').' and table_name=?',[strtolower($te)]);
}

   $col0=DB::select('SELECT * FROM application_item_lebel where table_name=? and input_type!=? order by column_position',[$id,'hidden']);
   $col1=$col0;
   $row=$col1;
   return view('pages.listtedit')->with('col0', $col0)->with('col1', $col1)->with('data', $data)->with('row', $row)->with('head', str_replace('_', ' ', $id));
 }
 else
 {
  return redirect('/');
}
}


public function student_id()
{
  $id=DB::select("SELECT concat( DATE_FORMAT(sysdate(), '%y'),?,?,2,lpad(id+1,4,0)) id, id+1 ido FROM student_id WHERE client_id=? and branch=?",[session('client_id'),session('branch'),session('client_id'),session('branch')]);


  foreach ($id as $key ) {
    $id=DB::update('update student_id set id=? WHERE client_id=? and branch=?',[$key->ido,session('client_id'),session('branch')]);

    return $key->id;
  }
}




public function stuff_id()
{
  $id=DB::select("SELECT concat( DATE_FORMAT(sysdate(), '%y'),?,?,1,lpad(id+1,4,0)) id, id+1 ido FROM stuff_id WHERE client_id=? and branch=?",[session('client_id'),session('branch'),session('client_id'),session('branch')]);


  foreach ($id as $key ) {
    $id=DB::update('update stuff_id set id=? WHERE client_id=? and branch=?',[$key->ido,session('client_id'),session('branch')]);

    return $key->id;
  }
}


public function revenue_sl()
{
  $id=DB::select("SELECT concat( DATE_FORMAT(sysdate(), '%y'),?,?,1,lpad(REVENUE_SL+1,4,0)) id, REVENUE_SL+1 ido FROM revenue_sl WHERE client_id=? and branch=?",[session('client_id'),session('branch'),session('client_id'),session('branch')]);


  foreach ($id as $key ) {
    $id=DB::update('update revenue_sl set REVENUE_SL=? WHERE client_id=? and branch=?',[$key->ido,session('client_id'),session('branch')]);

    return $key->id;
  }
}

public function register(Request $request,$id)
{



if ($this->chk_auth('register',$id)==0 and session('user')!=99) {
  //return redirect('/login');
}

 $keyCol=DB::select('SELECT column_name,autoid FROM application_item_lebel where table_name=? and column_key=?',[str_replace(' ', '_', $id),'PRI']);


 foreach ($keyCol as $key) {
   $keyCol= $key->column_name;
   $autoID=DB::select($key->autoid);
   foreach ($autoID as $key ) {
    $autoID=$key->autoid;
  }

}





if (session('login')=='y') {




 $data=DB::select('SELECT * FROM application_item_lebel where table_name=? and nvl(column_key,?) not in (?,?) order by column_position',[str_replace(' ', '_', $id),' ','PRI','UNI']);


 if ($request->submit=='submit') {



   if (str_replace(' ', '_', $id)=='student_information') {
    $autoID=$this->student_id();
    $fd=DB::insert('insert into users values (?,MD5(?),0,0,?,?)',[$autoID,'1234',session('client_id'),session('branch')]);


    $d=DB::insert('insert into revenue (sl,sub_sl,sector,CLIENT_ID,BRANCH,STUDENT_ID,AMMOUNT) values (null,null,0,null,null,?,0)',[$autoID]);
    $this->sms_insert($autoID,'!@#$',session('client_id'),session('branch'),0);

  }elseif (str_replace(' ', '_', $id)=='stuff_information') {
    $autoID=$this->stuff_id();
    $fd=DB::insert('insert into users values (?,MD5(?),0,0,?,?)',[$autoID,'1234',session('client_id'),session('branch')]);

    $d=DB::insert('insert into revenue (sl,sub_sl,sector,CLIENT_ID,BRANCH,STUDENT_ID,AMMOUNT) values (null,null,0,null,null,?,0)',[$autoID]);

  }

  if (!file_exists('userFiles/'.session('client_id'))) 
  {
    File::makeDirectory('userFiles/'.session('client_id'));
    File::makeDirectory('userFiles/'.session('client_id').'/studentImage');
    File::makeDirectory('userFiles/'.session('client_id').'/stuffImage');
    File::makeDirectory('userFiles/'.session('client_id').'/webFile');
  }








  $feedBack=DB::insert('insert into '.str_replace(' ', '_', $id).' ('.$keyCol.')values(?)',[$autoID]);

  foreach ($data as $key) {
    $col=$key->column_name;

    if ($key->input_type=='file') {



     if ($request->hasFile($key->column_name))
     {


      $f=DB::select('select max(name)+1 name from last_file_name');
      foreach ($f as $k) {
        $f=DB::insert('insert into last_file_name values (?)',[$k->name]); 
        $f=DB::delete('delete from  last_file_name where name<?',[$k->name]); 



        $file=$request->file($key->column_name);
        $fileName=$k->name.'.'.$file->getClientOriginalExtension();
        if (str_replace(' ', '_', $id)=='student_information') 
        {
          $file->move('userFiles/'.session('client_id').'/studentImage',$fileName);
        }
        elseif (str_replace(' ', '_', $id)=='stuff_information') 
        {
          $file->move('userFiles/'.session('client_id').'/stuffImage',$fileName);
        }

        $feedBack=DB::update('update '.str_replace(' ', '_', $id).' set '.$col.'=? where '.$keyCol.'=?',[$fileName,$autoID]);
      }
    }

  }else
  {
    $feedBack=DB::update('update '.str_replace(' ', '_', $id).' set '.$col.'=? where '.$keyCol.'=?',[$request->$col,$autoID]);
  }




}

}


return view('pages.register')->with('data', $data)->with('head', str_replace('_', ' ', $id));
}else
{
  return redirect('/');
}
}


public function listupdate(Request $request,$id)
{

 $keyCol=DB::select('SELECT column_name,autoid FROM application_item_lebel where table_name=? and column_key=?',[str_replace(' ', '_', $id),'PRI']);



 foreach ($keyCol as $key) {
   $keyCol= $key->column_name;
   $autoID=DB::select($key->autoid);

   foreach ($autoID as $key ) {

    $autoID=$key->autoid;

  }




}

if (session('login')=='y') {


  if (session('result')=='1') {
    
    $data=DB::select("SELECT * FROM application_item_lebel where table_name=? and column_name in ('om".session('exam_no')."','uid') and input_type!=? order by column_position",['result','hidden']);
    session(['result' => '0']);
  }else{
     $data=DB::select('SELECT * FROM application_item_lebel where table_name=? and nvl(column_key,?) not in (?,?) and lower(column_name) not in (?,?) order by column_position',[str_replace(' ', '_', $id),' ','PRI','UNI','branch','client_id']);

  }











 if ($request->submit=='submit') {
           //$feedBack=DB::insert('insert into '.str_replace(' ', '_', $id).' ('.$keyCol.')values(?)',[$autoID]);





  foreach ($request->sl as $d) {


   foreach ($data as $key) {

    $col=$key->column_name;
    $reqVal=$col.$d;
    $reqID=$keyCol.$d;

if (strtolower($col)=='image') {


}
//echo  'update '.str_replace(' ', '_', $id).' set '.$col.'='.$request->$reqVal.' where '.$keyCol.'='.$request->$reqID.'</br>';
   
    $feedBack=DB::update('update '.str_replace(' ', '_', $id).' set '.$col.'=? where '.$keyCol.'=?',[$request->$reqVal,$request->$reqID]);



//echo 'update '.str_replace(' ', '_', $id).' set '.$col.'='.$request->$reqVal.' where '.$keyCol.'='.$request->$reqID.'</br>';



  }
}

}

if (session('result')=='0') {
session(['result' => '2']);
  return redirect('/resultEntry');
  

}
else{
  return redirect('/listedit/'.str_replace(' ', '_', $id).'/y');
  
}
}else
{
  return redirect('/');
}
}
public function chimage(Request $request)
{
    
    
      if (!file_exists('userFiles/'.session('client_id'))) 
  {
    File::makeDirectory('userFiles/'.session('client_id'));
    File::makeDirectory('userFiles/'.session('client_id').'/studentImage');
    File::makeDirectory('userFiles/'.session('client_id').'/stuffImage');
    File::makeDirectory('userFiles/'.session('client_id').'/webFile');
  }




  if ($request->hasFile('image'))
     {


      $f=DB::select('select max(name)+1 name from last_file_name');
      foreach ($f as $k) {
        $f=DB::insert('insert into last_file_name values (?)',[$k->name]); 
        $f=DB::delete('delete from  last_file_name where name<?',[$k->name]); 



        $file=$request->file('image');
        $fileName=$k->name.'.'.$file->getClientOriginalExtension();
        if (str_replace(' ', '_', $request->id)=='student_information') 
        {
          $file->move('userFiles/'.session('client_id').'/studentImage',$fileName);
        }
        elseif (str_replace(' ', '_', $request->id)=='stuff_information') 
        {
          $file->move('userFiles/'.session('client_id').'/stuffImage',$fileName);
        }

        $feedBack=DB::update('update '.str_replace(' ', '_', $request->id).' set image=? where sl=?',[$fileName,$request->user_id]);
      }
    }
    
    return view ('pages.chimage');
}
 public function meritList()
    {
        


        $info=DB::select('select * from client_information where client_id='.session('client_id'));
        $mclass=DB::select('select * from class where sl='.session('class'));
        foreach ($mclass as $key ) {
          session(['iclass' => $key->CLASS]);
          
        }

        $mex=DB::select('select * from exam_name where class='.session('class').' and exam_no='.session('p3'));
        foreach ($mex as $key ) {
          session(['iex' => $key->EXAM_NAME]);
          
        }
        foreach ($info as $key ) {
          session(['iname' => $key->INSTITUTE]);
          session(['iadd' => $key->ADDRESS]);
        }
        $query='';
        $data=DB::select('select * from subject where client_id='.session('client_id').' and branch='.session('branch').' and class='.session('class').' and em'.session('p3').'>0 order by sl');
        $ts=count($data);
        $data1=$data;
        $data2=$data;


         $query=$query. "select ";
        $query=$query. "sd.sl sl,sd.name name, ";

        foreach ($data as $key ) {
         $query=$query. 'max(IF(r.subject = '.$key->SL.', r.em'.session('p3').', NULL)) AS e'.$key->SL.',';  
               
        }
 $query=$query.'(';
        foreach ($data as $key ) {
         $query=$query. 'max(IF(r.subject = '.$key->SL.', r.em'.session('p3').', 0)) +';  
               
        }
        $query=$query.'=';

        foreach ($data as $key ) {
         $query=$query. 'max(IF(r.subject = '.$key->SL.', om'.session('p3').', NULL)) AS a'.$key->SL.',';  
               
        }
        foreach ($data as $key ) {
         $query=$query. 'max(IF(r.subject = '.$key->SL.', om'.session('p3').', 0)) +';  
               
        }
        $query=$query.'_';

        $query=$query.'ROUND((';
        foreach ($data as $key ) {
         $query=$query. 'grade_point(max(IF(r.subject = '.$key->SL.', om'.session('p3').', 0)),max(IF(r.subject = '.$key->SL.', r.em'.session('p3').', 0))) +';  
               
        }

        $query=$query.'*';

        $query=$query.'ROUND((';
        foreach ($data as $key ) {
         $query=$query. 'max(IF(r.subject = '.$key->SL.', om'.session('p3').', 0)) +';  
               
        }
        
         $query=$query. ", from result r,subject s, student_information sd  where 
r.subject=s.sl and r.user_id=sd.sl and

         r.CLIENT_ID=".session('client_id')." and r.branch=".session('branch')." and sd.name!='.' and date_format(idate,'%y')=".session('ry')." and r.class=".session('class').' and r.em'.session('p3').">0 group by sd.sl,sd.name order by total desc";
$query=str_replace('+=',')/'.$ts.' total_em,',$query);
$query=str_replace(',,',' ',$query);
$query=str_replace('+_',' Total, ',$query);
$query=str_replace('+*',' )/'.$ts.',2) gpavg,',$query);
$query=str_replace('+,',' )/'.$ts.',2) avg',$query);
//return $query;

$row1=DB::select($query);


     //==return $row1;   

DB::delete('delete from gpa where client_id=? and branch=?',[session('client_id'),session('branch')]);
foreach ($row1 as $key ) {
DB::insert("insert into gpa (user_id,tn,client_id,branch,gpa,class,oby) 
  values (?,?,?,?,?,?,?)",
  [$key->sl,$key->Total,session('client_id'),session('branch'),$key->gpavg,session('class'),session('user')]);
}

$up_roll=DB::select("SELECT count(*)r,tn FROM `gpa`  where class=? AND client_id=? and branch=?  group by tn order by tn desc",[session('class'),session('client_id'),session('branch')]);
$make_roll=0;
foreach ($up_roll as $key ) {
  $make_roll=$make_roll+1;
  DB::update("update gpa set roll=? where class=? and tn=?",[$make_roll.' ('.$key->r.') ',session('class'),$key->tn]);
}

if (session('rcp')=='1') {
session(['p4' => session('p3')]);
session(['p1' => 'result_common_base']);
session(['p2' => session('user')]);


$this->report_print('result_common_base',session('user'));

}if (session('rcp')=='0') {
        return view('pages.meritList')->with('data', $data)->with('data1', $data1)->with('row1', $row1)->with('data2', $data2);
      }
    }


 public function FeeList($h)
    {
        
        session(['h' => $h]);
        session(['hs' => 'Student ID']);
        session(['hd' => 'Class']);
        $query='';
        $data=DB::select('select * from revenue_type where client_id='.session('client_id').' and branch='.session('branch').' and type=9 order by sl');
        $data1=$data;
        $data2=$data;


         $query=$query. "select ";
        $query=$query. "STUDENT_ID,s.phone_sms s_phone,name,c.class class, ";
        foreach ($data as $key ) {
         $query=$query. 'sum(IF(sector = '.$key->SL.', ammount, NULL)) AS a'.$key->SL.',';  
         $query=$query.'max(IF(sector = '.$key->SL.', fee, NULL))-sum(IF(sector = '.$key->SL.', ammount, NULL)) AS d'.$key->SL.',';       
        }
         $query=$query. ",from revenue r, student_information s, class c where r.STUDENT_ID=s.SL and c.sl=s.CLASS and 
         r.CLIENT_ID=".session('client_id')." and r.branch=".session('branch')." group by student_id,name,c.class,s.phone_sms";
$query=str_replace(',,',' ',$query);
//return $query;

$row1=DB::select($query);


     //return $row1;   

        return view('pages.paymentList')->with('data', $data)->with('data1', $data1)->with('row1', $row1)->with('data2', $data2);
    }


     public function salFeeList($h)
    {
        
        session(['h' => $h]);
        session(['hs' => 'Employee ID']);
        session(['hd' => 'Designation']);
        $query='';
        $data=DB::select('select * from revenue_type where client_id='.session('client_id').' and branch='.session('branch').' and SALARY_TYPE in (1,3) order by sl');
        $data1=$data;
        $data2=$data;


         $query=$query. "select ";
        $query=$query. "STUDENT_ID,s.phone_sms s_phone,name,d.designation class, ";
        foreach ($data as $key ) {
         $query=$query. 'sum(IF(sector = '.$key->SL.', ammount, NULL)) AS a'.$key->SL.',';  
         $query=$query.'max(IF(sector = '.$key->SL.', fee, NULL))-sum(IF(sector = '.$key->SL.', ammount, NULL)) AS d'.$key->SL.',';       
        }
         $query=$query. ",from revenue r, stuff_information s, designation d where r.STUDENT_ID=s.SL and d.sl=s.designation and 
         r.CLIENT_ID=".session('client_id')." and r.branch=".session('branch')." group by student_id,name,d.designation,s.phone_sms";
$query=str_replace(',,',' ',$query);
//return $query;

$row1=DB::select($query);


     //return $row1;   

        return view('pages.paymentList')->with('data', $data)->with('data1', $data1)->with('row1', $row1)->with('data2', $data2);
    }








    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function gen()
    {
      return redirect('/');
/*
      if (session('user')=='99') {
    

    //$del=DB::delete('delete from application_item_lebel');


      $data=DB::select('SELECT  table_name,COLUMN_NAME,ORDINAL_POSITION FROM information_schema.cOLUMNS WHERE TABLE_SCHEMA=?',['jismbdco_smartedu']);


      foreach ($data as $key ) {



        $fc=DB::select('SELECT  table_name,COLUMN_NAME FROM application_item_lebel WHERE table_name=? and COLUMN_NAME=?',[$key->table_name,$key->COLUMN_NAME]);



        if (count($fc)==0) 
        {
          $fb=DB::insert('INSERT into application_item_lebel  SELECT  null,table_name,COLUMN_NAME,ORDINAL_POSITION,IS_NULLABLE,DATA_TYPE,?,null,COLUMN_KEY,null,null,null,null,?,null,0,0 FROM information_schema.cOLUMNS WHERE TABLE_SCHEMA=? and table_name=? and COLUMN_NAME=?',
            ['text',ucwords(str_replace('_',' ',strtolower($key->COLUMN_NAME))),'jismbdco_smartedu',$key->table_name,$key->COLUMN_NAME]);


        }elseif (count($fc)>0) {
          $dd=DB::update('UPDATE application_item_lebel set column_position=? WHERE table_name=? and COLUMN_NAME=? ',[$key->ORDINAL_POSITION,$key->table_name,$key->COLUMN_NAME]);
        } 

        $data1=DB::select('SELECT  table_name,COLUMN_NAME FROM application_item_lebel WHERE table_name=?',[$key->table_name]);
        foreach ($data1 as $key1 ) {
          $c=DB::select('SELECT  * FROM information_schema.cOLUMNS WHERE table_name=? and COLUMN_NAME=?',[$key1->table_name,$key1->COLUMN_NAME]);
          if (count($c)==0) 
          {
            $fb=DB::select('delete from application_item_lebel where table_name=? and column_name=?',[$key1->table_name,$key1->COLUMN_NAME]);
          }
        }

      }

      $data1=DB::update("update application_item_lebel set autoid=CONCAT('select nvl(max(', column_name,'),0)+1 autoid from ',table_name)  where column_key in ('PRI','UNI')"); 

      $data1=DB::update("update application_item_lebel set value='client_id', input_type='hidden'  where lower(COLUMN_NAME)='client_id'"); 
      $data1=DB::update("update application_item_lebel set value='branch',input_type='hidden'  where lower(COLUMN_NAME)='branch'"); 

      $data1=DB::select('SELECT  table_name,COLUMN_NAME FROM application_item_lebel ');


      session(['install' => 'y']);
      session(['meta' => count($data)]);
      session(['data' => count($data1)]);
      return view('pages.install');

}*/
    }

    public function wait()
    {
      return view('pages.loading');
    }

    public function chk()
    {
      $data1=DB::select('SELECT * FROM demo_delete where is_device_found is null');
      return count($data1);
    }


    public function reg()
    {
      $data1=DB::select('SELECT fingerid FROM demo_delete where is_device_found is null');

      foreach ($data1 as $key ) {
       return $key->fingerid;
     }
   }


   public function atd($id)
   {
    $data1=DB::insert('insert into demo_att_delete values (?,current_timestamp)',[$id]);
    return 'ok';

  }


  public function blank()
  {
   
      
    
    $data1=DB::select("SELECT distinct TABLE_NAME FROM information_schema.COLUMNS WHERE TABLE_SCHEMA='jismbdco_smartedu'");

    foreach ($data1 as $key) {
     

      


      try {
        if (strtolower($key->TABLE_NAME)!='application_item_lebel') {
         // DB::statement("ALTER TABLE ".$key->TABLE_NAME." CONVERT TO CHARACTER SET utf8");
        }
        
        //$data1=DB::delete("delete from " .$key->TABLE_NAME);
      } catch (Exception $e) {


        echo $key->TABLE_NAME;
      }

    }
    echo  'ok';
    

  }





}
