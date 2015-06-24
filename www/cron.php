<?php
$crontab_path="/etc/cron.d/heroeverything";
$tmp_path=""; #<TODO> fix file access comflict
# parameter cron
$barid = $_POST['barid'];
$srcjob = $_POST['cron'];
$parsedjob = "";

# srcjob format: * * * * * inc 10
# parsedjob format: * * * * * www-data curl -XPOST 'http://localhost/api.php/trigger' -d 'barid=2&action=inc&vol=10'

# check base args
if (empty($crontab_path) || empty($barid) || empty($srcjob)){
  echo "{\"status\":\"error\", \"desc\":\"null args\"}";
  return;
}
# do addjob regex check
if (  preg_match ( "/^\S+\s+\S+\s+\S+\s+\S+\s+\S+\s+(inc|dec|kill|full)\s+\d+$/" , $srcjob ) !=1 ){
  echo "{\"status\":\"error\", \"desc\":\"bad cron format\"}";
  return;
}

# permission check <TODO>

# database check <TODO>

# transform job to cron job
# process date
$srcjob = str_replace ( "\t", " " , $srcjob);
$splitjob = explode(' ', $srcjob, 6);
$parsedjob = trim($splitjob[0]).' '.trim($splitjob[1]).' '.trim($splitjob[2]).' '.trim($splitjob[3]).' '.trim($splitjob[4]).' curl -XPOST \'http://localhost/api.php/trigger\' -d \'barid='.$barid.'&action=';
# process action
$action = explode(' ', trim($splitjob[5]), 2);
$parsedjob = $parsedjob.trim($action[0])."&vol=".trim($action[1])."'";

# write to crontab
if (!empty($parsedjob)){
  # remove old cron
  $current = file_get_contents($crontab_path);
  $cronArray = explode('\n',$current);
  $outCron="";
  $i=0; //marker
  $marked=FALSE;
  foreach ($cronArray as $value){
    if (empty(trim($value))){
      continue;
    }
    else if (strrpos ( $value , "barid=".$barid."&" , 30 )==FALSE){
      $outCron=$outCron.$value."\n";
      $i++;
    }
    else{
      $marked=TRUE;
    }
  }
  # append this cron
  $outCron=$outCron.$parsedjob."\n";
  # write new cron
  file_put_contents($crontab_path, $outCron);
  if ($marked)
    echo "{\"status\":\"success\", \"desc\":\"replace\"}";
  else
    echo "{\"status\":\"success\", \"desc\":\"add\"}";
}

# update cron to www-data
shell_exec('crontab '.$crontab_path);

?>
