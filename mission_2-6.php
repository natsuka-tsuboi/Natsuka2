<?php

/*header("Content-Type: text/html; charset=UTF-8");
 header("Cache-Control: no-store, no-cache, must-revalidate");
 header("Cache-Control: post-check=0, pre-check=0", FALSE);
 header("Pragma: no-cache");
*/

//�ҏW����
//�ҏW����ԍ�����̓t�H�[���ɕ\��������
if(isset($_POST['edit2']))
{
	$file_name = "text2-6.txt";
	$array = file($file_name);
	for($i = 0; $i < count($array);++$i)
	{
		$line =explode("<>",$array[$i]);
		if($line[0] == $_POST['edit2'])
		{
		$file = file('text2-6.txt');
		
		file_put_contents('text2-6.txt',$file);
		}
	}
}
//�ҏW�ԍ��ƈ�v������̂�T��
$filedata = file('text2-6.txt');
if(isset($_POST['edit']))
{
	$fp = fopen('text2-6.txt','r');
	foreach($filedata as $line)
	{
		$data = explode('<>',$line);
		$edit_num= $_POST['edit'];
	
		if($data[0] == $edit_num)
		{
		$name=$data[1];
		$comment=$data[2];
		}

	}
fclose($fp);
}
?>

<!DOCTYPE html>
<head>
<title> �ڎw���I�S�V�s���{�����e�I�I
</title>
<h1>���s���L</h1>
</head>

<body>
<form action="mission_2-6.php" method="post">
<input type= "hidden" name="edit_num"  value="<?php echo $edit_num;?>"/><br/>


���O;<br />

<input type="text" name="name" value="<?php echo $name;?>"/><br />

�R�����g;<br />

<input type="text" name="comment" value="<?php echo $comment;?>"/><br />

�p�X���[�h;<br />
<input type ="text" name ="password1"><br />

<br/>
<input type="submit" name ="send" value="���M����"><br/>

<br/>
�폜����ԍ�;<br />
<input type ="text" name="delete"><br />

�p�X���[�h;<br />
<input type ="text" name="password2"><br />

<input type="submit"  name = "delete2" value="�폜����">

<br/>
�ҏW����ԍ�;<br />
<input type ="text" name ="edit"><br />

�p�X���[�h;<br />
<input type ="text" name ="password3"><br />

<input type = "submit" name ="edit2" value= "�ҏW�Ώ۔ԍ�">

</form>
</body>
</html>

<?php
 //�f�[�^����M���ăt�@�C���ɕۑ�

//�ȈՌf���̍쐬
$boards = file('text2-6.txt',FILE_IGNORE_NEW_LINES);
//�ԍ��U�蕪��
$maxNumber = 0;
  foreach ($boards as $filename){
  $line = explode('<>',$filename);
  if($maxNumber < $line[0]){
     $maxNumber = $line[0];
     }
}
$nextNumber = $maxNumber +1;

$date = new DateTime();

$board = $nextNumber.'<>'.$_POST['name'].'<>'.$_POST['comment'].'<>'.$date->format('Y-m-d-H-i').'<>'.$_POST['password1'].'<>'."\n";

$edit_num=$_POST['edit_num'];
$pass1 =$_POST['password1'];


//$boards��ۑ�����
if ($_POST['name']!=null && $edit_num ==""){
$fp = fopen('text2-6.txt','a');
fwrite($fp,$board);
fclose($fp);
}


//�폜����
$pass2 =$_POST['password2'];
$pasCon = file('text2-6.txt');

if(isset($_POST['delete2']))
{
	for($r = 0; $r < count($pasCon) ; $r++)
	{
	$passdata = explode("<>",$pasCon[$r]);

	$file_name = "text2-6.txt";
	$array = file($file_name);
	if($passdata[4] ==$pass2 && $passdata[0] == $_POST['delete'])
	{
	for($i = 0; $i < count($array);$i++) 
		{
		$line =explode("<>",$array[$i]);

		if($line[0] == $_POST['delete'] && $passdata[4] == $pass2)
			{
			$file = file('text2-6.txt');
			unset($file[$i]);
			array_splice($pasCon,$r,1);
			file_put_contents('text2-6.txt',$pasCon);
			//file_put_contents('testpass.txt',$pasCon);
			}
		}
	}
	}
}



//�ҏW�ԍ��ƈ�v������̂�T��
$filedata = file('text2-6.txt');
$pass3=$_POST['password1'];
if($_POST['name']!=null && $edit_num!="")
{
	$fp = fopen('text2-6.txt','w+');
	//foreach($filedata as $line)
	for($k=0; $k < count($filedata); $k++)
	{
		//$data = explode("<>",$line);
		$edit_num = $_POST['edit_num'];
		/*$pass1 =$_POST['password1'];
		if($data[0] == $edit_num && $data[5] == $pass3)
		{
		$text = $edit_num.'<>'.$_POST['name'].'<>'.$_POST['comment'].'<>'.$date->format('Y-m-d-H-i').'<>'.$pass1."\n"; 
		fputs($fp,$text);
*/
		$Data = explode("<>",$filedata[$k]);
		if($line[0] == $edit_num && $Data[4] == $pass3){
		$text =$edit_num.'<>'.$_POST['name'].'<>'.$_POST['comment'].'<>'.$date->format('Y-m-d-H-i').'<>'.$pass1.'<>'."\n";
		fputs($fp,$text);

		}
	else{
		fputs($fp,$filedata[$k]);
	    }

	}

fclose($fp);
}



for($i = 0; $i < count($filedata);++$i) {
//�����ŕ���
  $data = explode("<>",$filedata[$i]);
//�����������̂̕\��
    echo $data[0],"#";
    echo $data[1],"#";
    echo $data[2],"#";
    echo "<p>",$data[3],"</p>";
}

?>