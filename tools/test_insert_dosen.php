<?php
$db=new PDO('sqlite:'.__DIR__.'/../database/database.sqlite');
$now=(new DateTime())->format('Y-m-d H:i:s');
$stmt=$db->prepare("INSERT INTO table_dosen (Fullname,NIP,NIDN,Pendidikan_Terakhir,Jurusan_id,Tempat_Lahir,Tanggal_Lahir,Alamat,created_at,updated_at) VALUES (?,?,?,?,?,?,?,?,?,?)");
$res=$stmt->execute(['Test Nama','12345','67890','SMA','jur1','Palu','1990-01-01','Alamat test',$now,$now]);
echo $res?"Inserted\n":"Failed\n";
$count=$db->query("SELECT count(*) as c FROM table_dosen")->fetch(PDO::FETCH_ASSOC);
echo "Rows: ".$count['c']."\n";
