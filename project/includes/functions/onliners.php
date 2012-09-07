<?php // catalog/includes/functions/onliners.php (5287)

$oSql = 'SELECT * FROM online LIMIT 1;';
$bestaat = mysql_query($oSql);

/*
if ( !$bestaat ){
	echo "Aanmaken tabellen t.b.v. Counter";
$Crsql = 'CREATE TABLE online (
   id int NOT NULL auto_increment,
   ip varchar(32),
   level int(1),
   time int,
   PRIMARY KEY (id)
);';
$ok = tep_db_query($Crsql);

$Crsql = 'CREATE TABLE mostonline (
   id int NOT NULL auto_increment,
   sinds varchar(10),
   mostonline int,
   totalonline int,
   PRIMARY KEY (id)
);';
$ok = tep_db_query($Crsql);	
}
*/

$to_secs = 600;
$t_stamp = time();                                                                                            
$timeout = $t_stamp - $to_secs; 
$varIp = tep_get_ip_address();

// onliners

//oudjes weg
$oSql = 'DELETE FROM online WHERE time <'.$timeout.';' ;
$succes = tep_db_query($oSql);

//deze erbij?
$oSql = 'SELECT id FROM online WHERE ip ="'.$varIp.'";' ;
$succes = tep_db_query($oSql);
$record = tep_db_fetch_array($succes);

if ($record){
	//haal ID

	$oSql='UPDATE online SET time='.$t_stamp.' WHERE id='.$record['id'].';';
	$succes = tep_db_query($oSql);
	$addOne ='';}
else{
	//nieuwe ip
	$oSql='INSERT INTO online (time, ip) VALUES('.$t_stamp.',"'.$varIp.'");';
	$succes = tep_db_query($oSql);

	// ook totaal bijhouden.
	$addOne ='1';


}


// tel

$oSql = 'SELECT count(id) FROM online;' ;
$onliners = tep_db_query($oSql);

$nowonline = mysql_result($onliners, 0);

// meer dan laatste $mostonline ??

$oSql = 'SELECT * FROM mostonline WHERE id=1;';
$monliners = tep_db_query($oSql);
if (!$monliners ){
 $oldMost='';}
else{
 $record=tep_db_fetch_array($monliners);
 $oldMost = $record['mostonline'];
 $sinds = $record['sinds'];
 $total= $record['totalonline'];}

if ($oldMost==''){
	$oSql='INSERT INTO mostonline (id,sinds, mostonline, totalonline) VALUES (1,"'.date('d-m-Y').'",'.$nowonline.',1);';

	$succes = tep_db_query($oSql);
	$mostonline = '1';
	$sinds = date('d-m-Y') ;}
else{
	if ($nowonline > $oldMost) {
	$oSql='UPDATE mostonline SET mostonline='.$nowonline.' WHERE id=1;';
	$succes = tep_db_query($oSql);
	$mostonline = $nowonline;}
	else $mostonline = $oldMost;}

if ($addOne=='1'){
	$oSql='UPDATE mostonline SET totalonline='.($total+1).' WHERE id=1;';
	$succes = tep_db_query($oSql);
	$totalonline = $total+1;}
else 	$totalonline = $total;
// einde tellen


?>