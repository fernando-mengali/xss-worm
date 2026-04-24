<?php
/**************************
* Srinivas Tamada http://9lessons.info
* Wall_Updates
**************************/
class Wall_Updates {
public $perpage = 10; /*Uploads perpage*/

   	//Username Check for Oauth users
    public function usernameCheck($uid) 
    {
    $uid=mysql_real_escape_string($uid);
    $query=mysql_query("SELECT username FROM users WHERE uid='$uid'");
    if(mysql_num_rows($query)==1)
    {
    $row=mysql_fetch_array($query);
    return $row['username'];
    }
    else
    {
    return false;
    }
    }

	 //Username Check for Oauth users
    public function usernameUpdate($uid,$username)
    {
    $uid=mysql_real_escape_string($uid);
    $username=mysql_real_escape_string($username);
    $query=mysql_query("SELECT uid FROM users WHERE username='$username'");
    if(mysql_num_rows($query)==0)
    {
	 mysql_query("UPDATE users SET username='$username' WHERE uid = '$uid'");
	 //Friend Page Entry
    mysql_query("INSERT INTO friends(friend_one,friend_two,role)VALUES('$uid','$uid','me')");
    return $uid;
    }
    else
    {
    return false;
    }

    }

     /*User Login Check*/
     public function Login_Check($value,$type) 
     {
     $username_email=mysql_real_escape_string($value);
     if($type)
     {
     $query=mysql_query("SELECT uid FROM users WHERE username='$username_email' ");
     }
     else
     {
     $query=mysql_query("SELECT uid FROM users WHERE email='$username_email' ");
     }
     return mysql_num_rows($query);
     }

     /* User ID Valid Check*/
     public function User_ID($username) 
     {
     $username=mysql_real_escape_string($username);

     $query=mysql_query("SELECT uid FROM users WHERE username='$username' AND status='1'");
     if(mysql_num_rows($query)==1)
     {
     $row=mysql_fetch_array($query);
     return $row['uid'];
     }
     else
     {
     return false;
     }
     }



     /* User Details*/
     public function User_Details($uid) 
     {
     $username=mysql_real_escape_string($uid);
     $query=mysql_query("SELECT uid,username,email,friend_count,profile_pic,conversation_count,updates_count,profile_pic_status,name AS full_name FROM users WHERE uid='$uid' AND status='1'");
     $data=mysql_fetch_array($query);
     return $data;    
     }
    /*User Profile Picture */
	public function User_Profilepic($uid,$base_url) 
     {
	     
      	 $uid=mysql_real_escape_string($uid);
		 $query = mysql_query("SELECT email,profile_pic,profile_pic_status FROM `users` WHERE uid='$uid'") or die(mysql_error());
		 $row=mysql_fetch_array($query);
		
		   if($row['profile_pic_status'])
		   {
			      /*User Uploaded Picture */
			      if(!empty($row['profile_pic']))
			      {
			      $profile_pic_path=$base_url.'user_profile_uploads/';
			      $data= $profile_pic_path.$row['profile_pic'];
		          return $data;
		          }
				  else
				  {
				  $data=$base_url."wall_icons/default.jpg";
				  return $data;
				 }
		   
	         }
			 else
			 { 
				    /*Gravator Image*/
			 	    $email=$row['email'];
			        $lowercase = strtolower($email);
			        $imagecode = md5( $lowercase );
					$data="http://www.gravatar.com/avatar/".$imagecode."?d=mm&s=230";
					return $data;
			 }
		
  
     }
 
     /*User Settings*/
     public function Update_Settings($full_name,$actual_image_name,$uid,$p_status)
     {
     $full_name=mysql_real_escape_string($full_name);
     $uid=mysql_real_escape_string($uid);
     $p_status=mysql_real_escape_string($p_status);
     if(strlen($full_name)>0)
     {
	 if($actual_image_name)
	 {
     mysql_query("UPDATE users SET name='$full_name',profile_pic='$actual_image_name',profile_pic_status='$p_status' WHERE uid='$uid'");
     }
     else
     {
	 mysql_query("UPDATE users SET name='$full_name',profile_pic_status='$p_status' WHERE uid='$uid'");
     }
     return true;
     }
     }

    /*User Full Name*/
	public function UserFullName($username) 
	{
	$username=mysql_real_escape_string($username);
	$query = mysql_query("SELECT name FROM `users` WHERE username='$username'") or die(mysql_error());
	$data=mysql_fetch_array($query);
	if($data['name'])
	{
		$name=$data['name'];
		$str_length = strlen($name);       

	       if($str_length > 25)
	       {

	           	$name= substr($name, 0, 25) . "..." ;

	       }
		return ucfirst($name);    
	}        

	else
	{
		return $username;
	}
	
	}
    
    /*Change Password*/
     public function Change_Password($oldpassword, $newpassword, $cpassword,$uid) 
     {
     $oldpassword=mysql_real_escape_string($oldpassword);
     $md5_oldpassword=md5($oldpassword);
     $newpassword=mysql_real_escape_string($newpassword);
     $md5_newpassword=md5($newpassword);
     $cpassword=mysql_real_escape_string($cpassword);
     $md5_cpassword=md5($cpassword);
     $uid=mysql_real_escape_string($uid);
     if($newpassword==$cpassword)
     {
     $query=mysql_query("SELECT uid FROM users WHERE uid='$uid' AND password='$md5_oldpassword'");
     	if(mysql_num_rows($query)>0)
	 	{
     		$query=mysql_query("UPDATE users SET password='$md5_newpassword' WHERE uid='$uid'") or die(mysql_error());
     		return true;    
	 	}
	 	else
	 	{
     		return false;
	 	}
	 }
	 else
	 {
	 return false;
	 }
     }

     /*User Search  */ 	
	 public function User_Search($searchword) 
	 {
	 $q=mysql_real_escape_string($_POST['searchword']);
     $query=mysql_query("select username,uid from users where username like '%$q%' or name like '%$q%' order by uid LIMIT 5");
     while($row=mysql_fetch_array($query))
	 {
	 $data[]=$row;
	 }
	 return $data;
 	 }

	 /*Status User Check*/
     public function Status_User($msgid) 
     {
     $msgid=mysql_real_escape_string($msgid);
     $query=mysql_query("SELECT username FROM messages M, users U WHERE  M.uid_fk=U.uid and M.msg_id='$msgid' AND U.status='1'");
     if(mysql_num_rows($query)>0)
     {
     $row=mysql_fetch_array($query);
     return $row['username'];
     }
     else
     {
     return false;
     }
     }

	 /* Status Msg Id Check*/
     public function Status_ID($msgid) 
     {
     $msgid=mysql_real_escape_string($msgid);
     $query=mysql_query("SELECT msg_id FROM messages M, users U WHERE  M.uid_fk=U.uid and M.msg_id='$msgid' AND U.status='1'");
     if(mysql_num_rows($query)>0)
     {
     $row=mysql_fetch_array($query);
     return $row['msg_id'];
     }
     else
     {
     return false;
     }
     }

     /* Share*/
     public function Share($msg_id,$uid) 
     {
     $msg_id=mysql_real_escape_string($msg_id);
     $uid=mysql_real_escape_string($uid);

     $q=mysql_query("SELECT share_id FROM message_share WHERE  uid_fk='$uid' and msg_id_fk='$msg_id' ");
     if(mysql_num_rows($q)==0)
     {
     $q=mysql_query("SELECT uid_fk FROM messages WHERE msg_id='$msg_id'");
     $r=mysql_fetch_array($q);
     $ouid=$r['uid_fk'];
     $time=time();
      $query=mysql_query("INSERT INTO message_share (msg_id_fk,uid_fk,ouid_fk,created) VALUES('$msg_id','$uid','$ouid','$time')");
      $q=mysql_query("UPDATE messages SET share_count=share_count+1 WHERE msg_id='$msg_id'") or die(mysql_error());
      return true;
      }
      else
      {
      return false;
      }
     }
	/* Unshare*/
     public function Unshare($msg_id,$uid) 
     {
     $msg_id=mysql_real_escape_string($msg_id);
     $uid=mysql_real_escape_string($uid);

     $q=mysql_query("SELECT share_id FROM message_share WHERE  uid_fk='$uid' and msg_id_fk='$msg_id' ");
     if(mysql_num_rows($q)>0)
     {
      $query=mysql_query("DELETE FROM message_share WHERE msg_id_fk='$msg_id' and uid_fk='$uid'");
      $q=mysql_query("UPDATE messages SET share_count=share_count-1 WHERE msg_id='$msg_id'") or die(mysql_error());
      return true;
      }
      else
      {
      return false;
      }
     }

      /*Share Message*/
     public function Share_Msg($msg_id) 
     {
     $msg_id=mysql_real_escape_string($msg_id);
     $query=mysql_query("SELECT uid_fk FROM message_share WHERE msg_id_fk='$msg_id' ORDER BY share_id DESC  LIMIT 1 ");
     $data=mysql_fetch_array($query);
	return $data['uid_fk'];;

     }

     /*Like Check*/
     public function Like($msg_id,$uid) 
     {
     $msg_id=mysql_real_escape_string($msg_id);
     $uid=mysql_real_escape_string($uid);
 
     $q=mysql_query("SELECT like_id FROM message_like WHERE  uid_fk='$uid' and msg_id_fk='$msg_id' ");
     if(mysql_num_rows($q)==0)
     {
      $query=mysql_query("INSERT INTO message_like (msg_id_fk,uid_fk) VALUES('$msg_id','$uid')");
      $q=mysql_query("UPDATE messages SET like_count=like_count+1 WHERE msg_id='$msg_id'") or die(mysql_error());
      $g=mysql_query("SELECT like_count FROM messages WHERE msg_id='$msg_id'");
      $d=mysql_fetch_array($g);
      return $d['like_count'];
      }
      else
      {
      return false;
      }
     }

     /*Comment Like */
     public function Comment_Like($com_id,$uid) 
     {
     $com_id=mysql_real_escape_string($com_id);
     $uid=mysql_real_escape_string($uid);
     $q=mysql_query("SELECT clike_id FROM comment_like WHERE  uid_fk='$uid' and com_id_fk='$com_id' ");
      if(mysql_num_rows($q)==0)
      {
      $query=mysql_query("INSERT INTO comment_like (com_id_fk,uid_fk) VALUES('$com_id','$uid')");
      $q=mysql_query("UPDATE comments SET like_count=like_count+1 WHERE com_id='$com_id'") or die(mysql_error());
      $g=mysql_query("SELECT like_count FROM comments WHERE com_id='$com_id'");
      $d=mysql_fetch_array($g);
      return $d['like_count'];
      }
      else
      {
      return false;
      }
     }
    /*Comment Like Check*/
	public function Comment_Like_Check($com_id,$uid) 
     {
     $com_id=mysql_real_escape_string($com_id);
     $uid=mysql_real_escape_string($uid);
     $q=mysql_query("SELECT clike_id FROM comment_like WHERE  uid_fk='$uid' and com_id_fk='$com_id' ");
     if(mysql_num_rows($q)==0)
     {
     return true;
     }
     else
     {
     return false;
     }
     }

     /*Comment Unlike Check*/
	public function Comment_Unlike($com_id,$uid) 
     {
     $com_id=mysql_real_escape_string($com_id);
     $uid=mysql_real_escape_string($uid);
     $q=mysql_query("SELECT clike_id FROM comment_like WHERE uid_fk='$uid' and com_id_fk='$com_id' ");
     if(mysql_num_rows($q)>0)
     {
      $query=mysql_query("DELETE FROM comment_like WHERE com_id_fk='$com_id' and uid_fk='$uid'");
      $q=mysql_query("UPDATE comments SET like_count=like_count-1 WHERE com_id='$com_id'") or die(mysql_error());
      $g=mysql_query("SELECT like_count FROM comments WHERE com_id='$com_id'");
      $d=mysql_fetch_array($g);
      return $d['like_count'];
      }
      else
      {
      return false;
      }
     }

      /*Like Users*/
     public function Like_Users($msg_id) 
     {
     $msg_id=mysql_real_escape_string($msg_id); 
     $q=mysql_query("SELECT like_id FROM message_like WHERE msg_id_fk='$msg_id' ");
     if(mysql_num_rows($q)>0)
     {
    
     $query=mysql_query("SELECT U.username FROM message_like M, users U WHERE U.uid=M.uid_fk AND M.msg_id_fk='$msg_id' LIMIT 3"); 
       while($row=mysql_fetch_array($query))
	{
	$data[]=$row;
	}
	return $data;
     }
     }

    /*Share Validate Check*/
	public function Share_Check($msg_id,$uid) 
     {
     $msg_id=mysql_real_escape_string($msg_id);
     $uid=mysql_real_escape_string($uid);

     $q=mysql_query("SELECT share_id FROM message_share WHERE  uid_fk='$uid' and msg_id_fk='$msg_id' ");
     if(mysql_num_rows($q)==0)
     {
     return true;
     }
     else
     {
     return false;
     }
     }
 
    /*Like Validate Check*/
	public function Like_Check($msg_id,$uid) 
     {
     $msg_id=mysql_real_escape_string($msg_id);
     $uid=mysql_real_escape_string($uid);
     $q=mysql_query("SELECT like_id FROM message_like WHERE  uid_fk='$uid' and msg_id_fk='$msg_id' ");
     if(mysql_num_rows($q)==0)
     {
     return true;
     }
     else
     {
     return false;
     }
     }

     /*Unlike*/
     public function Unlike($msg_id,$uid) 
     {
     $msg_id=mysql_real_escape_string($msg_id);
     $uid=mysql_real_escape_string($uid);
     $q=mysql_query("SELECT like_id FROM message_like WHERE uid_fk='$uid' and msg_id_fk='$msg_id' ");
     if(mysql_num_rows($q)>0)
     {
      $query=mysql_query("DELETE FROM message_like WHERE msg_id_fk='$msg_id' and uid_fk='$uid'");
      $q=mysql_query("UPDATE messages SET like_count=like_count-1 WHERE msg_id='$msg_id'") or die(mysql_error());
      $g=mysql_query("SELECT like_count FROM messages WHERE msg_id='$msg_id'");
      $d=mysql_fetch_array($g);
      return $d['like_count'];
      }
      else
      {
      return false;
      }
     }
      
     /* Status Updates   	*/
	public function Status_Update($msgid) 
	{
	$query = mysql_query("SELECT M.msg_id, M.uid_fk, M.message, M.created,M.like_count,M.comment_count,M.share_count, U.username,M.uploads FROM messages M, users U  WHERE U.status='1' AND M.uid_fk=U.uid and M.msg_id='$msgid'") or die(mysql_error());
        while($row=mysql_fetch_array($query))
	{
	$data[]=$row;
	}
	return $data;
		
      }
	
    /*Profile Updates  */ 	
	public function Updates($uid,$lastid) 
	{
	/* More Button*/
       $morequery="";
       if($lastid)
       {
       $morequery=" and M.msg_id<'".$lastid."' ";
       }
        /* More Button End*/
 
$v=mysql_query("SELECT share_id FROM message_share");
if(mysql_num_rows($v))
{
	
$query=mysql_query("(SELECT DISTINCT M.msg_id, M.uid_fk, M.message, S.created, M.like_count,M.comment_count,M.share_count, U.username,M.uploads, 
S.uid_fk as share_uid,S.ouid_fk as share_ouid 
FROM 
messages M, users U, message_share S 
WHERE 
M.uid_fk=U.uid AND
U.status='1' AND 
S.msg_id_fk=M.msg_id AND
S.uid_fk='$uid'
$morequery group by msg_id)
UNION
(SELECT M.msg_id, M.uid_fk, M.message, M.created,M.like_count,M.comment_count,M.share_count, U.username,M.uploads, '0' AS share_uid, '0' as share_ouid  FROM messages M, users U 
WHERE
U.status='1' AND 
M.uid_fk=U.uid and 
M.uid_fk='$uid'  $morequery group by msg_id ) 
order by created desc limit " .$this->perpage);
}
else
{
$query = mysql_query("SELECT M.msg_id, M.uid_fk, M.message, M.created,M.like_count,M.comment_count, U.username,M.uploads, '0' AS share_uid, '0' as share_ouid FROM messages M, users U  WHERE U.status='1' AND M.uid_fk=U.uid and M.uid_fk='$uid' $morequery order by M.msg_id desc limit " .$this->perpage) or die(mysql_error());
}
 
        while($row=mysql_fetch_array($query))
		{
	    $data[]=$row;
		}
		return $data;
}
	     /* Total Updates   */	
	 public function Total_Updates($uid) 
	 {	   
		$v=mysql_query("SELECT share_id FROM message_share");
		if(mysql_num_rows($v))
		{
		$query=mysql_query("(SELECT DISTINCT M.msg_id, M.uid_fk, M.message, S.created, M.like_count,M.comment_count,M.share_count, U.username,M.uploads, 
		S.uid_fk as share_uid,S.ouid_fk as share_ouid 
		FROM 
		messages M, users U, message_share S 
		WHERE 
		M.uid_fk=U.uid AND
		U.status='1' AND 
		S.msg_id_fk=M.msg_id AND
		S.uid_fk='$uid'
		 group by msg_id)
		UNION
		(SELECT M.msg_id, M.uid_fk, M.message, M.created,M.like_count,M.comment_count,M.share_count, U.username,M.uploads, '0' AS share_uid, '0' as share_ouid  FROM messages M, users U 
		WHERE
		U.status='1' AND 
		M.uid_fk=U.uid and 
		M.uid_fk='$uid' group by msg_id ) 
		order by created desc ");
		}
		else
		{
		$query = mysql_query("SELECT M.msg_id, M.uid_fk, M.message, M.created,M.like_count,M.comment_count, U.username,M.uploads, '0' AS share_uid, '0' as share_ouid FROM messages M, users U  WHERE U.status='1' AND M.uid_fk=U.uid and M.uid_fk='$uid'") or die(mysql_error());
		}
		
      $data=mysql_num_rows($query);
      return $data;
	}

    /* Friends_Updates   */	
	 public function Friends_Updates($uid,$lastid) 
	{
	  /* More Button*/
       $morequery="";
		if($lastid)
		{
		$morequery=" and M.msg_id<'".$lastid."' ";
	    }
	   /*More Button End*/
	$v=mysql_query("SELECT share_id FROM message_share");
	if(mysql_num_rows($v))
	{
	
$query=mysql_query("(SELECT DISTINCT M.msg_id, M.uid_fk, M.message, S.created, M.like_count,M.comment_count,M.share_count, U.username,M.uploads, S.uid_fk as share_uid,S.ouid_fk as share_ouid FROM 
messages M, users U, friends F,message_share S 
WHERE 
F.friend_one='$uid' AND 
U.uid = F.friend_one AND
U.status='1' AND 
F.friend_two != S.ouid_fk AND 
M.uid_fk = S.ouid_fk AND F.role='fri' AND 
S.msg_id_fk = M.msg_id $morequery group by msg_id)
UNION
(SELECT DISTINCT M.msg_id, M.uid_fk, M.message, M.created, M.like_count,M.comment_count,M.share_count, U.username,M.uploads, '0' AS share_uid, '0' as share_ouid 
 FROM messages M, users U, friends F WHERE F.friend_one='$uid' AND U.status='1' AND M.uid_fk=U.uid AND M.uid_fk = F.friend_two  $morequery group by msg_id ) order by created desc limit " .$this->perpage) or die(mysql_error()); 

}
else
{	   
 $query = mysql_query("SELECT DISTINCT M.msg_id, M.uid_fk, M.message, M.created, U.username,M.uploads FROM messages M, users U, friends F  WHERE U.status='1' AND M.uid_fk=U.uid AND  M.uid_fk = F.friend_two AND F.friend_one='$uid' $morequery order by M.msg_id desc limit " .$this->perpage) or die(mysql_error());
}

		
         while($row=mysql_fetch_array($query))
        {
		$data[]=$row;
	    }
	    return $data;
		
    }
	
	/*Total Friends Updates */  	
	public function Total_Friends_Updates($uid) 
	{
			$v=mysql_query("SELECT share_id FROM message_share");
			if(mysql_num_rows($v))
			{
		$query=mysql_query("(SELECT DISTINCT M.msg_id, M.uid_fk, M.message, S.created, M.like_count,M.comment_count,M.share_count, U.username,M.uploads, S.uid_fk as share_uid,S.ouid_fk as share_ouid FROM 
		messages M, users U, friends F,message_share S 
		WHERE 
		F.friend_one='$uid' AND 
		U.uid = F.friend_one AND
		U.status='1' AND 
		F.friend_two != S.ouid_fk AND 
		M.uid_fk = S.ouid_fk AND F.role='fri' AND 
		S.msg_id_fk = M.msg_id group by msg_id)
		UNION
		(SELECT DISTINCT M.msg_id, M.uid_fk, M.message, M.created, M.like_count,M.comment_count,M.share_count, U.username,M.uploads, '0' AS share_uid, '0' as share_ouid 
		 FROM messages M, users U, friends F WHERE F.friend_one='$uid' AND U.status='1' AND M.uid_fk=U.uid AND M.uid_fk = F.friend_two   group by msg_id ) order by created desc ") or die(mysql_error()); 

		}
		else
		{	   
		 $query = mysql_query("SELECT DISTINCT M.msg_id, M.uid_fk, M.message, M.created, U.username,M.uploads FROM messages M, users U, friends F  WHERE U.status='1' AND M.uid_fk=U.uid AND  M.uid_fk = F.friend_two AND F.friend_one='$uid'  ") or die(mysql_error());
		}
		

$data=mysql_num_rows($query);
return $data;		
    }
	
	/*Comments*/
	public function Comments($msg_id,$second_count) 
	{
    	$query='';
	  if($second_count)
	  {
	  $query="limit $second_count,2";
	  }
	    $query = mysql_query("SELECT C.com_id, C.uid_fk, C.comment, C.created,C.like_count, U.username FROM comments C, users U WHERE U.status='1' AND C.uid_fk=U.uid and C.msg_id_fk='$msg_id' order by C.com_id asc $query") or die(mysql_error());
	   while($row=mysql_fetch_array($query))
	    $data[]=$row;
        if(!empty($data))
		{
       return $data;
         }
	}

	/*Insert Update*/
	public function Insert_Update($uid, $update,$uploads) 
	{
	$update=mysql_real_escape_string($update);
    $time=time();
	$ip=$_SERVER['REMOTE_ADDR'];
    $query = mysql_query("SELECT msg_id,message FROM `messages` WHERE uid_fk='$uid' order by msg_id desc limit 1") or die(mysql_error());
    $result = mysql_fetch_array($query);	
    if ($update!=$result['message'])
    {
	$uploads_array=explode(',',$uploads);
	$uploads=implode(',',array_unique($uploads_array));
	
    $query = mysql_query("INSERT INTO `messages` (message, uid_fk, ip,created,uploads) VALUES (N'$update', '$uid', '$ip','$time','$uploads')") or die(mysql_error());
    $v = mysql_query("UPDATE `users` SET updates_count=updates_count+1 WHERE uid='$uid'") or die(mysql_error());
    $newquery = mysql_query("SELECT M.msg_id, M.uid_fk, M.message, M.created,M.uploads,M.like_count,M.comment_count,M.share_count, U.username FROM messages M, users U where M.uid_fk=U.uid and M.uid_fk='$uid' order by M.msg_id desc limit 1 ");
    $result = mysql_fetch_array($newquery);
    return $result;
    } 
	else
	{
	return false;
	}   
    }
	
	/*Delete update*/
	public function Delete_Update($uid, $msg_id) 
	{
		if($uid && $msg_id)
		{
		mysql_query("DELETE FROM `message_like` WHERE msg_id_fk = '$msg_id'") or die(mysql_error());
	    mysql_query("DELETE FROM `comments` WHERE msg_id_fk = '$msg_id'") or die(mysql_error());
        mysql_query("DELETE FROM `messages` WHERE msg_id = '$msg_id' and uid_fk='$uid'") or die(mysql_error());
        mysql_query("UPDATE `users` SET updates_count=updates_count-1 WHERE uid='$uid'") or die(mysql_error());
        return true;
      	}      
    }
	
     /*Image Upload*/
     public function Image_Upload($uid, $image) 
     {
     
     $path="uploads/";
     $img_src = $path.$image;
     $imgbinary = fread(fopen($img_src, "r"), filesize($img_src));
     $img_base = base64_encode($imgbinary);
     $ids = 0;
     $query = mysql_query("insert into user_uploads (image_path,uid_fk)values('$image' ,'$uid')") or die(mysql_error());
     $ids = mysql_insert_id();
     return $ids;
    }
	
    /*get Image Upload*/
	public function Get_Upload_Image($uid,$image) 
	{	
	 if($image)
	 {
	 $query = mysql_query("select id,image_path from user_uploads where image_path='$image'") or die(mysql_error());
	 }
	 else
	 {
	 $query = mysql_query("select id,image_path from user_uploads where uid_fk='$uid' order by id desc ") or die(mysql_error());
	 }
     $result = mysql_fetch_array($query);
   	return $result;
    }
	
	/*Id Image Upload*/
	public function Get_Upload_Image_Id($id) 
	{	
        $query = mysql_query("select image_path from user_uploads where id='$id'") or die(mysql_error());
        $result = mysql_fetch_array($query);
    	return $result;
    }
	
	/*Delete Comments*/
	public function Insert_Comment($uid,$msg_id,$comment) 
	{
	$comment=mysql_real_escape_string($comment);
    $time=time();
	$ip=$_SERVER['REMOTE_ADDR'];
    $query = mysql_query("SELECT com_id,comment FROM `comments` WHERE uid_fk='$uid' and msg_id_fk='$msg_id' order by com_id desc limit 1 ") or die(mysql_error());
    $result = mysql_fetch_array($query);
    
		if ($comment!=$result['comment']) {

            $query = mysql_query("INSERT INTO `comments` (comment, uid_fk,msg_id_fk,ip,created) VALUES (N'$comment', '$uid','$msg_id', '$ip','$time')") or die(mysql_error());
	    mysql_query("UPDATE messages SET comment_count=comment_count+1 WHERE msg_id='$msg_id'") or die(mysql_error());
            $newquery = mysql_query("SELECT C.com_id, C.uid_fk, C.comment, C.msg_id_fk, C.created, U.username FROM comments C, users U where C.uid_fk=U.uid and C.uid_fk='$uid' and C.msg_id_fk='$msg_id' order by C.com_id desc limit 1 ");

            $result = mysql_fetch_array($newquery);
         
		   return $result;
        } 
		else
		{
		return false;
		}
       
    }
	
	/*Delete Comments*/
         public function Delete_Comment($uid, $com_id) 
	{
	 $uid=mysql_real_escape_string($uid);
	 $com_id=mysql_real_escape_string($com_id);
	

        $q=mysql_query("SELECT M.uid_fk FROM comments C, messages M WHERE C.msg_id_fk = M.msg_id AND C.com_id='$com_id'");
	$d=mysql_fetch_array($q);
	$oid=$d['uid_fk'];

	if($uid==$oid)
	{
	
	$query = mysql_query("DELETE FROM `comments` WHERE com_id='$com_id'") or die(mysql_error());
	mysql_query("UPDATE messages SET like_count=like_count-1 WHERE msg_id='$msgid'") or die(mysql_error());
        return true;
      	}
	else
	{
	
        $query = mysql_query("DELETE FROM `comments` WHERE uid_fk='$uid' and com_id='$com_id'") or die(mysql_error());
        return true;
	}
       }

    /*Friend List*/
         public function Friends_List($uid, $page, $offset, $rowsPerPage) 
	{
	     $uid=mysql_real_escape_string($uid);
	     $page=mysql_real_escape_string($page);
	     $offset=mysql_real_escape_string($offset);
	     $rowsPerPage=mysql_real_escape_string($rowsPerPage);

	    if($page)
	    {
	    $con=$offset.",".$rowsPerPage;
	    }
	    else
	   {
	    $con=$rowsPerPage;
       }
	 
	    $query=mysql_query("SELECT U.username, U.uid FROM users U, friends F WHERE U.status='1' AND U.uid=F.friend_two AND F.friend_one='$uid' AND F.role='fri' ORDER BY F.friend_id DESC LIMIT $con")or die(mysql_error());
	   while($row=mysql_fetch_array($query))
	   {
	   $data[]=$row;
	   }
	   return $data;
      	       
       }


      
    /*Friend Valid Check*/
     public function Friends_Check($uid,$fid)
	{
	
	$query=mysql_query("SELECT role FROM friends WHERE friend_one='$uid' AND friend_two='$fid'") or die(mysql_error());	
	$num=mysql_fetch_array($query);
	return $num['role'];
	}
	
	/*Friends count*/
	public function Friends_Check_Count($uid,$fid)
	{
	$query=mysql_query("SELECT friend_id FROM friends WHERE friend_one='$uid' AND friend_two='$fid'") or die(mysql_error());	
	$num=mysql_num_rows($query);
	return $num;
	}
	
	/*Add Friend*/
	public function Add_Friend($uid,$fid)
	{
	$fid=mysql_real_escape_string($fid);
	$q=mysql_query("SELECT friend_id FROM friends WHERE friend_one='$uid' AND friend_two='$fid' AND role='fri'");
	if(mysql_num_rows($q)==0)
	{
	$query=mysql_query("INSERT INTO friends(friend_one,friend_two,role) VALUES ('$uid','$fid','fri')") or die(mysql_error());	
	$query=mysql_query("UPDATE users SET friend_count=friend_count+1 WHERE uid='$uid'") or die(mysql_error());	
	return true;
	}
	}
	
	/*Remove Friend*/
	public function Remove_Friend($uid,$fid)
	{
	$fid=mysql_real_escape_string($fid);
	$q=mysql_query("SELECT friend_id FROM friends WHERE friend_one='$uid' AND friend_two='$fid' AND role='fri'");
	if(mysql_num_rows($q)==1)
	{
	$query=mysql_query("DELETE FROM friends WHERE friend_one='$uid' AND friend_two='$fid'") or die(mysql_error());
	$query=mysql_query("UPDATE users SET friend_count=friend_count-1 WHERE uid='$uid'") or die(mysql_error());	
	return true;
	}
	
	}
	
	/*Conversations*/
	public function Conversation_Single($user_one,$conversation_uid) 
	{
		
	    $user_one=mysql_real_escape_string($user_one);

		$query=mysql_query("SELECT u.uid,c.c_id,u.username,u.email,c.time
		FROM conversation c, users u
		WHERE CASE 
		WHEN c.user_one = '$user_one'
		THEN c.user_two = u.uid
		WHEN c.user_two = '$user_one'
		THEN c.user_one= u.uid
		END 
		AND (
		c.user_one ='$user_one'
		OR c.user_two ='$user_one'
		) AND u.uid='$conversation_uid' ");

		    	while($row=mysql_fetch_array($query))
		        {
			    $data[]=$row;
			   
			    }
		        if(!empty($data))
				{
		        return $data;
		        }

	}
	/* Converstaions */
	public function Conversation($user_one,$last_time,$conversation_uid) 
	{
		
		   /* More Records*/
	       $morequery="";
	       if($last_time)
	       {
	       $morequery=" and c.time<'".$last_time."' ";
	       }
	        /* More Button End*/
	
	    $user_one=mysql_real_escape_string($user_one);
	
		$query=mysql_query("SELECT DISTINCT u.uid,c.c_id,u.username,u.email,c.time
		FROM conversation c, users u, conversation_reply r
		WHERE CASE 
		WHEN c.user_one = '$user_one'
		THEN c.user_two = u.uid
		WHEN c.user_two = '$user_one'
		THEN c.user_one= u.uid
		END 
		AND (
		c.user_one ='$user_one'
		OR c.user_two ='$user_one'
		) AND c.c_id=r.c_id_fk AND u.uid<>'$conversation_uid'
		$morequery ORDER BY c.time DESC Limit 10");

		    	while($row=mysql_fetch_array($query))
		        {
			    $data[]=$row;
			    }
		        if(!empty($data))
				{
		        return $data;
		        }

	}

    /*Insert Conversation Reply*/
	public function Conversation_List($c_id,$uid) 
	{
	     $user_one=mysql_real_escape_string($uid);
	     $c_id=mysql_real_escape_string($c_id);

		 $query= mysql_query("SELECT R.cr_id,R.time,R.reply,R.user_id_fk,R.read_status FROM conversation_reply R WHERE R.c_id_fk='$c_id' ORDER BY R.cr_id DESC LIMIT 1") or die(mysql_error());
			    while($row=mysql_fetch_array($query))
			    {
			    $data[]=$row;
			    }
		        if(!empty($data))
				{
		        return $data;
		        }
			

	}

    /*Insert Conversation Reply*/
	public function Conversation_Updates($c_id,$uid,$last,$conversation_uid) 
	{
		$c_id=mysql_real_escape_string($c_id);
	
		$query= mysql_query("SELECT R.cr_id, U.conversation_count FROM users U, conversation_reply R WHERE R.user_id_fk=U.uid and R.c_id_fk='$c_id'") or die(mysql_error());
		$g=mysql_num_rows($query);
	   

        	$second_count=$g-20;
			 $squery='';
			
			  if($second_count && $g>20)
			  {
			  $x_count=$second_count.',';
			  }
			
				/* More Records*/
			       $morequery="";
			       if($last)
			       {
			       $morequery=" and R.cr_id<'".$last."' ";
			       $x_count='';
			       }
      
		   
		$q= mysql_query("SELECT R.cr_id,R.time,R.reply,R.user_id_fk FROM conversation_reply R WHERE R.c_id_fk='$c_id' ORDER BY R.cr_id DESC LIMIT 1") or die(mysql_error());
		$k=mysql_fetch_array($q);
		$o_uid=$k['user_id_fk'];
		$r=mysql_fetch_array($query);
		
		if($conversation_uid)
		{
			
		if($o_uid!=$uid)
		{
		mysql_query("UPDATE conversation_reply SET read_status='0' WHERE c_id_fk='$c_id' ORDER BY cr_id DESC LIMIT 1") or die(mysql_error());
		
		$sql=mysql_query("SELECT conversation_count from users WHERE uid='$uid'");
		$vv=mysql_fetch_array($sql);
		$conversation_count=$vv['conversation_count'];
	
		if($conversation_count>0)
		{
			mysql_query("UPDATE users SET conversation_count=conversation_count-1 WHERE uid='$uid' ") or die(mysql_error());
		}
		
	    }
	
	    }
	
	  

		 $query= mysql_query("SELECT R.cr_id,R.time,R.reply,U.uid,U.username,U.email,U.conversation_count FROM users U, conversation_reply R WHERE R.user_id_fk=U.uid and R.c_id_fk='$c_id' $morequery ORDER BY R.cr_id ASC LIMIT $x_count 20") or die(mysql_error());
	
		     	while($row=mysql_fetch_array($query))
		        {
		
			    $data[]=$row;
			    }
		        if(!empty($data))
				{
		          return $data;
		        }

	}
    
    /*Insert Conversation Reply*/
	public function Conversation_Insert($user_one,$user_two) 
	{
	      	$user_one=mysql_real_escape_string($user_one);
			$user_two=mysql_real_escape_string($user_two);
		    if($user_one!=$user_two)
		    {
			if($user_one>0 && $user_two>0 )
			{
		    $q= mysql_query("SELECT c_id FROM conversation WHERE (user_one='$user_one' and user_two='$user_two') or (user_one='$user_two' and user_two='$user_one') ") or die(mysql_error());
			$time=time();
			$ip=$_SERVER['REMOTE_ADDR'];
		 	 if(mysql_num_rows($q)==0)  
		     { 
			 $query = mysql_query("INSERT INTO conversation (user_one,user_two,ip,time) VALUES ('$user_one','$user_two','$ip','$time')") or die(mysql_error());
			
			$q=mysql_query("SELECT c_id FROM conversation WHERE user_one='$user_one' ORDER BY c_id DESC limit 1");
			$v=mysql_fetch_array($q);
			return $v['c_id'];
	        }
			else
			{
	        $v=mysql_fetch_array($q);
		    return  $v['c_id'];
	        }
	      }
	    }
	}

	/*Insert Conversation Reply*/
	public function ConversationReply_Insert($reply,$cid,$uid) 
	{
		$reply=mysql_real_escape_string($reply);
		$cid=mysql_real_escape_string($cid);
		$uid=mysql_real_escape_string($uid);
		$time=time();
		$ip=$_SERVER['REMOTE_ADDR'];
	if($uid>0 && $cid>0)
	{
	
    mysql_query("INSERT INTO conversation_reply (user_id_fk,reply,ip,time,c_id_fk) VALUES ('$uid','$reply','$ip','$time','$cid')") or die(mysql_error());
    $time=time();
	mysql_query("UPDATE conversation SET time='$time' WHERE c_id='$cid'") or die(mysql_error());

	$q=mysql_query("SELECT if(user_one = '$uid',user_two,user_one) AS uid FROM conversation where c_id = '$cid' ") or die(mysql_error());

	$v=mysql_fetch_array($q);
	$o_uid=$v['uid'];
	if($o_uid!=$uid)
	{	
	
    $g=mysql_query("SELECT read_status FROM conversation_reply WHERE c_id_fk='$cid' and user_id_fk='$uid' ORDER BY cr_id DESC LIMIT 1,1") or die(mysql_error());
    $h=mysql_fetch_array($g);
    if($h['read_status']==0 || $h['read_status']='' )
    {
	mysql_query("UPDATE users SET conversation_count=conversation_count+1 WHERE uid='$o_uid'") or die(mysql_error());
    }
    }

	$q=mysql_query("SELECT R.cr_id,R.time,R.reply,U.uid,U.username,U.email FROM users U, conversation_reply R WHERE R.user_id_fk=U.uid and R.c_id_fk='$cid' ORDER BY R.cr_id DESC");
	$v=mysql_fetch_array($q);
	return $v;

	}

	}
	
	/*Delete Conversation Reply*/
	public function Delete_Conversation($uid, $c_id) 
	{
	    $uid=mysql_real_escape_string($uid);
    	$c_id=mysql_real_escape_string($c_id);
	    $q = mysql_query("SELECT c_id FROM conversation WHERE c_id = '$c_id' and (user_one='$uid' or user_two='$uid')") or die(mysql_error());
	    if(mysql_num_rows($q)>0)
	    {
	       
			$g=mysql_query("SELECT read_status,user_id_fk FROM conversation_reply WHERE c_id_fk='$c_id'  ORDER BY cr_id DESC LIMIT 1") or die(mysql_error());
		    $h=mysql_fetch_array($g);
	     	$vid=$h['user_id_fk'];
		    if($h['read_status']==1  )
		    {
				$q=mysql_query("SELECT if(user_one = '$vid',user_two,user_one) AS uid FROM conversation where c_id = '$c_id' ") or die(mysql_error());

				$v=mysql_fetch_array($q);
				$o_uid=$v['uid'];
			
			mysql_query("UPDATE users SET conversation_count=conversation_count-1 WHERE uid='$o_uid'") or die(mysql_error());
		    }
		mysql_query("DELETE FROM `conversation_reply` WHERE c_id_fk = '$c_id'") or die(mysql_error());	
		mysql_query("DELETE FROM `conversation` WHERE c_id = '$c_id'") or die(mysql_error());	
	    } 
	    return true;

	}
	
	

}

?>
