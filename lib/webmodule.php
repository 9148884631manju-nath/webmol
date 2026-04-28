<?php
class WebMol{
 public $type;
 public $dbfile;
 public $database;
 public function __construct($type,$dbfile,$database){
   $this->type = $type;
   $this->dbfile = $dbfile;
   $this->database = $database;   
 }
 public function page($p){
  if(file_exists($p)){$p=$p;}else{$p="error.php";}
  $wm = new WebMol($this->type,$this->dbfile,$this->database);
  require_once $p;
 }
 public function getKeys($ar,$v){
  $res=array();
  if(is_array($ar)){
    for($i=0;$i<count($ar);$i+=1){
       if(isset($ar[$i][$v])){
        $res[$i]=$ar[$i][$v];
       }else{
        $res[$i]="";
       }
      }
  }else{}
  //var_dump($res);
  return $res;
 }
 public function dataValidation($form,$colex,$data){
  $vx=$form[$colex]["validation"];
  $vxl=isset($form[$colex]["limit"])?$form[$colex]["limit"]:"";
  $vxt=$form[$colex]["title"];
  $vxn=$form[$colex]["name"]."_ierr";
  $chk=$this->strvalid($data);
  $cs="";
    $errd="";
    $ndata="";
  switch($vx)
  {
    case "alphanumeric": 
      if($chk[$vx]===1){$cr="";}else{$cr="0";
      $cs=".".$vxn."{display:block;}";}
      $errd=$cr;
      $ndata=$chk["value"];
      break;
    case "alpha":
      if($chk[$vx]===1){$cr="";}else{$cr="0";
      $cs=".".$vxn."{display:block;}";}
      $errd=$cr;
      $ndata=$chk["value"];
      break;
    case "email":
      if($chk["atpos"]>-1 and $chk["dotpos"]>-1){$cr="";}else{$cr="0";
      $cs=".".$vxn."{display:block;}";}
      $errd=$cr;
      $ndata=$chk["value"];
      break;
    case "numberlimit":
      if($chk["isnumber"]===true and $chk["strlen"]===(int)$vxl){$cr="";}else{$cr="0";
      $cs=".".$vxn."{display:block;}";}
      $errd=$cr;
      $ndata=$chk["value"];
      break;
    case "number":
      if($chk["isnumber"]===true){$cr="";}else{$cr="0";
      $cs=".".$vxn."{display:block;}";}
      $errd=$cr;
      $ndata=$chk["value"];
      break;
    default:
    $cs="";
    $errd="";
    $ndata=$chk["value"];
    break;
  }
  return array($cs,$errd,$ndata);
 }
 public function encdec($t,$k,$i)
	{
		$output = false; 
	  	$encrypt_method = "AES-256-CBC";
	  	$secret_key = ($i=="")?secret_key : $i;
	  	$secret_iv = ($i=="")?secret_iv : $i;  
	  	$key = hash('sha256', $secret_key);  
	  	$iv = substr(hash('sha256', $secret_iv), 0, 16);
		  switch($t)
		  {
			 case "d":   
				$output = openssl_decrypt(base64_decode($k), $encrypt_method, $key, 0, $iv); 
			break;
			default:  
					$output = openssl_encrypt($k, $encrypt_method, $key, 0, $iv); 
					$output = base64_encode($output); 
			break; 
		  }
		return $output;
	}
 public function strvalid($str)
	{$ar=array();
		$str=trim($str);
		$ar['alphanumeric'] = preg_match('/^[-a-zA-Z0-9 . ,]+$/', $str);
		$ar['alpha'] = preg_match('/^[-a-zA-Z . ,]+$/', $str);
		$ar['strlen'] = strlen($str);
		$ar['isnumber'] = is_numeric($str);
		$ar['atpos']=strpos($str,"@");
		$ar['dotpos']=strpos($str,".");
		$ar['dotexp'] = explode(".",$str);
		$ar['atexp'] = explode("@",$str);
		$ar['ppos'] = strpos($str,"+");
		$ar['value'] = $str;
		return $ar;
	}
 public function meta($p){
  if(file_exists($p)){
    return file_get_contents($p);
  }else{}
 }

 public function readContent($p){
  if(file_exists($p)){
    return file_get_contents($p);
  }else{}
 }
 public function rep($v){
    $re=array("'",'"',"/");
    $vl=array("",""," or ");
    return str_replace($re,$vl,$v);
 }
 public function getUrl($p,$data){
  $res="";
  $ch = curl_init($p);

  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data); // Encoded as string
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  $res = curl_exec($ch); 
  curl_close($ch);
  return $res;
 }
 public function dataArray($data,$keys,$thm){
  $res="";
  $thm = file_get_contents($thm);
  $col=array();$dat=array();$var=array();$def=array();$ext=array();
  for($i=0;$i<count($keys);$i+=1){
   $col[]=$keys[$i][0];
   $var[]=$keys[$i][1];
   $def[]=$keys[$i][2];
   $ext[]=$keys[$i][3];
  }
  for($i=0;$i<count($data);$i+=1)
    {
      if(is_array($data[$i])){
        for($j=0;$j<count($col);$j+=1)
          {
            if(isset($data[$i][$col[$j]])){
                 $nval[$i][] = $data[$i][$col[$j]];
            }
            else{
                if($col[$j]=="SLN"){
                    $nval[$i][]=$i;
                }else{
                   $nval[$i][]=$def[$j];
                }
            }
            
          }
      }else{

      }
      $res.=str_replace($var,$nval[$i],$thm);
    }
  return $res;
 }
 public function validstr($ty,$vl,$de,$ex){
  $res="";
  $vl=($vl=="") ? $de : $vl;
  switch($ty)
  {
    case "enc":
      $res=$this->encdec("",$vl,$ex);
      break;
    case "dec":
      $res=$this->encdec("d",$vl,$ex);
      break;
    case "txt":
      $res=$vl;
      break;
    case "limit":
      $res=substr($vl,$de,$ex);
      break;
    default:
      $res = $vl;
    break;
  }
  return $res;
 }
 public function htmlData($data,$flds,$theme){
  $res="";$ndat=array();
    $thm = file_get_contents($theme);
    for($i=0;$i<count($data);$i+=1){
      for($j=0;$j<count($data[$i]);$j+=1){
        $ndat[$i][]=$data[$i][$j];
      }
      $res.=str_replace($flds,$ndat[$i],$thm);
    }
    return $res;
 }
 public function html($fld,$theme){
  //var_dump($theme);
  $typs=$this->getKeys($fld,0);
  $vals=$this->getKeys($fld,1);
  $vars=$this->getKeys($fld,2);
  $defs=$this->getKeys($fld,3);
  $exts=$this->getKeys($fld,4);
  if(file_exists($theme)){
    $thm = file_get_contents($theme);
    $nthm="";$nvals=array();
    for($j=0;$j<count($vals);$j+=1)
      {
        $nvals[]=$this->validstr($typs[$j],$vals[$j],$defs[$j],$exts[$j]);
      }  
    $thm=str_replace($vars,$nvals,$thm);
    return $thm;
    }else{
      return "Theme Not Found ".$theme;
    }
 }
 public function redir($fl){
  ?><script>window.location="<?=$fl?>";</script><?php
 }
 public function toses($ar){
  if(is_array($ar) and count($ar)>1){
    for($i=0;$i<count($ar);$i+=1)
      {
        if(is_array($ar[$i])){
          switch($ar[$i][0])
          {
            case "set":
                $_SESSION[$ar[$i][1]]=$ar[$i][2];
              break;
            default:
                unset($_SESSION[$ar[$i][1]]);
            break;
          }
        }
        else{

        }
      }
  }
  else{
    switch($ar[0])
    {
      case "set":
          $_SESSION[$ar[1]]=$ar[2];
        break;
      default:
          unset($_SESSION[$ar[1]]);
      break;
    }
  }
 }

 public function con(){
  $t = $this->type;
   $f = $this->dbfile;
   $db = $this->database;
  if(file_exists($f)){
  $read_file = file_get_contents($f); 
  $rf = json_decode($read_file);
   if(isset($rf->$db)){
     $server = $rf->$db->server;
     $username = $rf->$db->username;
     $password = $rf->$db->password;
     $database = $rf->$db->database;
     switch($t){
      default:     
      mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
      try{
       $con=mysqli_connect($server,$username,$password);  
       try{
        $res = mysqli_select_db($con,$database);
        $res=mysqli_connect($server,$username,$password,$database); 
       }
       catch(\Exception $err){
        $res=$err->getMessage();
       }
      }
      catch (\Exception $err)
      {
       $res=$err->getMessage();
      }
      break;
     }
   }
   else{
    $res="InvalidDbNameValueSetInDbJsonConfig";
   }
  }
  else{
   $res="DbFileNotFound";
  }
  return $res;
 }
 public function table_module($table){
  $res=new class($this, $table){
   private $parent;
   private $table;
   private $err;
    public function __construct($parent, $table) {
        $this->parent = $parent;
        $this->table = $table;
        $cehckTasble = $this->parent->checktable($table['table'],$table['coloums']);
        if($cehckTasble===true){  } else{
         if(isset($cehckTasble->num_rows) > 0 ){ } 
         else{ $this->err=$cehckTasble; }
        }
    }
    public function editform($data,$record_err,$errthm,$sucthm,$fields,$vars,$custdata,$custvars){
        $errthm = file_get_contents($errthm);
        $readTheme = file_get_contents($sucthm);
        $table=$this->table['table'];

        if(count($data)<1){
          return str_replace("Xerror",$record_err,$errthm);
        }else{
          if(isset($data['error']))
            {
              return str_replace("Xerror",$data['error'],$errthm);
            }
            else
            {
              //var_dump($data);
              $c_query = "DESCRIBE ".$table;
               try{
                $cres = mysqli_query($this->parent->con(),$c_query);
                if(isset($cres->num_rows)>0){
                  $ecol=array();
                  while($row = mysqli_fetch_assoc($cres)){
                  if($row['Field']=="id"){}else{
                  $ecol[]=$row['Field'];
                  }
                  }
                  //var_dump($ecol); var_dump($readTheme); var_dump($fields); var_dump($vars);
                  $nvars=array(); $nvals=array();  $xfld="";
                  foreach($vars as $kk=>$vv){
                    if($kk=="XformFields"){
                      $fld = explode(",",$vv);
                      $nvars[]=$kk;
                      for($i=0;$i<count($fld);$i+=1){
                        $attrs="";
                        foreach($fields[$fld[$i]] as $fk=>$fv){
                          if($fk=="title" or $fk=="titlecss" ){}else{
                            if($fk=="value"){
                              if(isset($data[0][$fields[$fld[$i]]['name']]))
                                {
                                  $attrs.=$fk.'="'.$data[0][$fields[$fld[$i]]['name']].'" ';
                                }else{
                                  $attrs.=$fk.'="" ';
                                }
                            }else{
                              $attrs.=$fk.'="'.$fv.'" ';
                            }
                          }
                        }
                        if(isset($fields[$fld[$i]]['titlecss'])){$titlecss=$fields[$fld[$i]]['titlecss'];}else{$titlecss="";}
                        if(isset($fields[$fld[$i]]['parentcss'])){$parentcss=$fields[$fld[$i]]['parentcss'];}else{$parentcss="";}
                        $xfld.='<p class="'.$parentcss.'"><b class="'.$titlecss.'">'.$fields[$fld[$i]]['title'].'</b><input '.$attrs.'" /> </p>';
                      }
                      $nvals[]=$xfld;
                    }else{
                      $nvars[] = $kk;
                      $nvals[] = $vv;
                    }
                    
                  }
                  $nthm = str_replace($nvars,$nvals,$readTheme);
                  return str_replace($custvars,$custdata,$nthm);          
                }
              }
                catch(\Exception $ex){
                  return $ex->getMessage();
                }
            }
        }
    }
    public function viewForm($thm,$fields,$vars,$custdata,$custvars){
      $table=$this->table['table'];
      $readTheme = file_get_contents($thm);
      $c_query = "DESCRIBE ".$table;
      $con=$this->parent->con();
      if(!is_string($con)){
       try{
        $cres = mysqli_query($con,$c_query);
        if(isset($cres->num_rows)>0){
          $ecol=array();
          while($row = mysqli_fetch_assoc($cres)){
          if($row['Field']=="id"){}else{
          $ecol[]=$row['Field'];
          }
          }
          //var_dump($ecol); var_dump($readTheme); var_dump($fields); var_dump($vars);
          $nvars=array(); $nvals=array();  $xfld="";
          foreach($vars as $kk=>$vv){
            if($kk=="XformFields"){
              $fld = explode(",",$vv);
              $nvars[]=$kk;
              for($i=0;$i<count($fld);$i+=1){
                $attrs="";$attrx="";
                if(isset($fields[$fld[$i]])){
                foreach($fields[$fld[$i]] as $fk=>$fv){
                  if($fk=="title" or $fk=="titlecss"){}else{
                    if($fk=="value"){
                      $vex=explode("_",$fv);
                      if(count($vex)>1){
                        switch($vex[0]){
                          case "post":
                            $nw = str_replace($vex[0]."_","",$fv);
                            if(isset($_POST[$nw])){
                              $attrx.=$fk.'="'.$_POST[$nw].'" ';
                            }else{
                              $attrx.=$fk.'="" ';
                            }
                            break;
                          default:
                          break;
                        }
                      }
                      else{
                      $attrx.=$fk.'="'.$fv.'" ';  
                      }
                    }else{
                      $attrx.=$fk.'="'.$fv.'" ';
                    }
                  }                  
                }                
                $attrs=$attrx;
                switch($fields[$fld[$i]]['type']){
                  case "select_options":
                    $dbt = $fields[$fld[$i]]['data'];
                    $ex = explode("|",$dbt);$optx="";
                    for($x=0;$x<count($ex);$x+=1){
                        $el = explode(",",$ex[$x]);
                        $optx.='<option value="'.$el[0].'">'.$el[1].'</option>';
                      }
                    $inps='<select '.$attrs.'>'.$optx.'</select>';
                  break;
                  case "from_db":
                    $dbt = $fields[$fld[$i]]['data'];
                    $ex = explode("|",$dbt);$ald=array();
                    $tab = $ex[0];
                    $col = explode(",",$ex[1]);
                    $gdat = mysqli_query($con,"SELECT ".$ex[1]." FROM ".$tab.$ex[2]);
                    $opt="";
                    if($gdat->num_rows>0){
                      while($dx=mysqli_fetch_assoc($gdat)){
                        $ald[]=$dx;
                      }
                      for($x=0;$x<count($ald);$x+=1){
                        $opt.='<option value="'.$ald[$x][$col[0]].'">'.$ald[$x][$col[1]].'</option>';
                      }
                      //var_dump($ald);
                    }else{}
                    $inps='<select '.$attrs.'>'.$opt.'</select>';
                    break;
                  default:
                    $inps='<input '.$attrs.' /> ';
                  break;
                }
                if(isset($fields[$fld[$i]]['titlecss'])){$titlecss=$fields[$fld[$i]]['titlecss'];}else{$titlecss="";}
                if(isset($fields[$fld[$i]]['parentcss'])){$parentcss=$fields[$fld[$i]]['parentcss'];}else{$parentcss="";}
                $xfld.='<p class="'.$parentcss.'" ><b class="'.$titlecss.'" >'.$fields[$fld[$i]]['title'].'</b>'.$inps.'<i class="flderr '.$fields[$fld[$i]]['name'].'_ierr">'.$fields[$fld[$i]]['error'].'</i></p>';
                }else{}
              }
              $nvals[]=$xfld;
            }else{
              $nvars[] = $kk;
              $nvals[] = $vv;
            }
            
          }
          $nthm = str_replace($nvars,$nvals,$readTheme);
          return str_replace($custvars,$custdata,$nthm);          
        }
       }
        catch(\Exception $ex){
          return $ex->getMessage();
        }
        }else{return $con."<hr/> Check dbcon.json for Database Credentials";}
    }
   public function getAllData($checks,$type,$err,$suc,$fields,$cflds){
    $table=$this->table;$cxs="";$ccks="";$rdat=array();
    foreach($checks as $kk=>$vv){ if($kk=="fields"){$ccks=$vv;} else{$cxs.=$kk." ".$vv."";}}
    if($cxs==""){$cxs="";}else{$cxs=" WHERE ".$cxs;}
    $qry = "SELECT ".$ccks." FROM ".$table['table']." ".$cxs;
    $con=$this->parent->con();
    if(!is_string($con)){
    try{
     $dat = mysqli_query($con,$qry);
     while($dax = mysqli_fetch_assoc($dat)){
      $rdat[]=$dax;
     }
    }
    catch(\Exception $ex){
     $rdat = array("error"=>$ex->getMessage().$qry,"query"=>$qry);
    }
        $types = $this->parent->getKeys($fields,0);
        $fldx = $this->parent->getKeys($fields,1); 
        $vldx = $this->parent->getKeys($fields,2);
        $defs = $this->parent->getKeys($fields,3);
        $extra = $this->parent->getKeys($fields,4);

        $ctypes = $this->parent->getKeys($cflds,0);
        $custflds = $this->parent->getKeys($cflds,1); 
        $custvars = $this->parent->getKeys($cflds,2);
        $cdefs = $this->parent->getKeys($cflds,3);
        $cextra = $this->parent->getKeys($cflds,4);

        
     switch($type)
     {
      case "json":
       return json_encode($rdat);
       break;
       case "table":
        if(isset($rdat['error'])){
        $etheme = file_get_contents($err);
        return str_replace("Xerror",$rdat['error'],$etheme);
       }else{
        $nvals=array();$ncon="";
        $ncon.='<table width="100%" border="1" bordercolor="#ccc" cellpadding="5" cellspacing="0" style="word-break: break-word;">';
        $ncon.="<thead>";
        $ncon.="<tr>";
        for($x=0;$x<count($fldx);$x+=1)
         {
            $ncon.='<th>'.$fldx[$x].'</th>';
         }
        $ncon.="</tr>";
        $ncon.="</thead>";
        for($i=0;$i<count($rdat);$i+=1)
         {
          $ncon.="<tr/>";
          foreach($rdat[$i] as $kk=>$vv){
           $ncon.="<td>";
           if(in_array($kk,$fldx)){
            $ncon.=$vv;
           }else{
            $ncon.="";
           }
           $ncon.="</td>";
          }
          //$ncon.=str_replace($vldx,$nvals[$i],$stheme);
          $ncon.="</tr>";
         }
         return $ncon;
       }
       break;
      case "html": 
       if(isset($rdat['error'])){
        $etheme = file_get_contents($err);
        return str_replace("Xerror",$rdat['error'],$etheme);
       }else{
        if(count($rdat)<1){
          $etheme = file_get_contents($err);
          return str_replace("Xerror","Data Not Found",$etheme);
        }
        $nvals=array();$ncon="";
        $stheme = file_get_contents($suc); 
        for($i=0;$i<count($rdat);$i+=1)
         {
          for($j=0;$j<count($fldx);$j+=1){
            if(isset($rdat[$i][$fldx[$j]])){$cvl=$rdat[$i][$fldx[$j]];}else{$cvl="";}
            $rex[$i][]=$this->parent->validstr($types[$j],$cvl,$defs[$j],$extra[$j]);
          }
          
          $ncon.=str_replace($vldx,$rex[$i],str_replace($custvars,$custflds,$stheme));
         }         
         
         return $ncon;
       }
      break;
      default;
       if(isset($rdat['error'])){
        return $rdat;
       }else{
         return $rdat;
       }
      break;
     }
    }else{
      return $con;
    }
   }
   public function escstr($v){
      $con=$this->parent->con();
      return mysqli_real_escape_string($con,$v);
   }
   public function checkAndInsert($checks,$err,$suc,$cols,$form){
     $rex="";
     
     $data = $this->parent->getKeys($cols,2);
     $cols = $this->parent->getKeys($cols,1);
     $cols = implode(",",$cols);
      $table=$this->table;  $cxs="";$ccks="";
      $con=$this->parent->con();
      foreach($checks as $kk=>$vv){ if($kk=="fields"){$ccks=$vv;} else{$cxs.=$kk."=".$vv."";}}
     $checks = "SELECT ".$ccks." FROM ".$table['table']." WHERE ".$cxs;
     //var_dump($checks);
     try{
       $runq = mysqli_query($con,$checks);
       $runf = mysqli_fetch_assoc($runq);
       if(is_array($runf)){
         return $err;
       }else{
         if($checks==$err){
          return $checks;
         }else{
            //var_dump($data);
           return $this->insertData($cols,$data,$form);
         }
       }
       //return var_dump($runf);

     }catch(\Exception $ex){
      return $ex->getMessage()." ".$checks;
     }    
   }
   public function deleteData($err,$suc,$where){
     $rex="";
      $table=$this->table;  $cxs="";$datx="";      
      foreach($where as $kk=>$vv){$cxs.=$kk."=".$vv."";}
     $checks = "DELETE FROM ".$table['table']." WHERE ".$cxs;
     //var_dump($checks);
     try{
       $runq = mysqli_query($this->parent->con(),$checks);
       if(is_array($runq)){
         return $err;
       }else{
         return $suc;
       }
       //return var_dump($runf);

     }catch(\Exception $ex){
      return $ex->getMessage();
     }    
   }
   public function updateData($form,$flds,$err,$suc,$where){
     $rex="";
      $table=$this->table;  $cxs="";$datx="";
      $fieldx = $this->parent->getKeys($flds,1);
      $data = $this->parent->getKeys($flds,2);
      $cs="";$errd="";$mres=array();
      for($i=0;$i<count($fieldx);$i+=1){          
          $mres[$i]=$this->parent->dataValidation($form,$fieldx[$i],$data[$i]);
          $cs.=$mres[$i][0];
          $errd.=$mres[$i][1];
          $data[$i]=$mres[$i][2];

        $datx.=$fieldx[$i]."='".$this->parent->rep($data[$i])."', ";
      }
      foreach($where as $kk=>$vv){$cxs.=$kk."=".$vv."";}
      if($errd==""){
          $checks = "UPDATE ".$table['table']." SET ".substr($datx,0,-2)."  WHERE ".$cxs;
          try{
            $runq = mysqli_query($this->parent->con(),$checks);
            if(is_array($runq)){
              return $err;
            }else{
              return $suc;
            }
          }catch(\Exception $ex){
            return $ex->getMessage();
          }
        }else{
            return "Check Posted Data In Fields <style>".$cs."</style>";
        }
   }
   public function insertData($cols,$data,$form){
    $rex="";$dxa="";$vls="";$cs="";
    $table=$this->table;
    $colex = explode(",",$cols);
    $con=$this->parent->con();$valid=array();
      $errd="";$ver="";$ndata=array();
      $data=array($data);
    for($i=0;$i<count($data);$i+=1){
      for($j=0;$j<count($data[$i]);$j+=1)
        {
          $mres=$this->parent->dataValidation($form,$colex[$j],$data[$i][$j]);
          $cs.=$mres[0];
          $errd.=$mres[1];
          $ndata[$i][$j]=$mres[2];
        }
    }
    
    $ver=$errd;
    $data=$ndata;
    if(is_array($data)){
      //var_dump($data);
      for($i=0;$i<count($data);$i+=1){
       if(is_array($data[$i])){
        $dva[$i]="";
        for($u=0;$u<count($data[$i]);$u+=1){
         $dva[$i].="'".$data[$i][$u]."', ";
        }
        $vls.="(".substr($dva[$i],0,-2)."),";
       }else{
        $dxa.="'".$data[$i]."', ";
        $vls="(".substr($dxa,0,-2)."),";
       }       
      }
      $vals="VALUES".substr($vls,0,-1);
    }else
    {
     $vals="VALUES(".$data.")";
    }
      $rex="INSERT INTO ".$table['table']."(".$cols.") ".$vals;
      if($ver==""){
        try{
          $rex = mysqli_query($con,$rex);
          return  "Inserted";
        }catch(\Exception $ex){
          return $ex->getMessage();
        }
      }else{
        return "Check Data Entered in Fields <style>".$cs."</style>";
      }   
   }
  };
  return $res;
 }

 public function checktable($table,$cols){
   $con=$this->con();
   if(!is_string($con)){
   $query = "SHOW TABLES FROM ".$this->database;
   try{
     $res=mysqli_query($con,$query); 
     $nrs=$res->num_rows;
     $allt = array(); $alltx = array();
     while($altx = mysqli_fetch_array($res)){ $allt[]=$altx;} for($x=0;$x<count($allt);$x+=1){$alltx[$x]=$allt[$x][0];}
     if(in_array($table,$alltx)){      
      $tcols=array();$tkcols=array();
       if(is_array($cols)){
        $i=0;
         foreach($cols as $kk=>$vv){
          $tkcols[$i]=$kk;
          $tcols[$i]['Field']=$kk;
          $exp=explode(" ",$vv); 
          $tcols[$i]['Type'] = $exp[0];
          $tcols[$i]['Null'] = isset($exp[1]) ? $exp[1] : "";
          $tcols[$i]['Key'] = isset($exp[2]) ? $exp[2] : "";;
          $tcols[$i]['Default'] = isset($exp[3]) ? $exp[3] : "";;
          $tcols[$i]['Extra'] = isset($exp[4]) ? $exp[4] : "";;
          $i+=1;
         }
       }
       $c_query = "DESCRIBE ".$table;
       try{
        $cres = mysqli_query($con,$c_query);
        if(isset($cres->num_rows)>0){
           $ecol=array();$ckecol=array();
           while($row = mysqli_fetch_assoc($cres)){
            if($row['Field']=="id"){}else{
            $ecol[]=$row;
            $ckecol[]=$row['Field'];
            }
           }
           $altq="";
           for($i=0;$i<count($tcols);$i+=1)
           {
            if(in_array($tcols[$i]['Field'],$ckecol)){
              $altq.="";
            }else{
              $af=$i-1;
              if($af<0){$af=0;}else{$af=$af;}
              $altq.="Add ".$tcols[$i]['Field']." ".$tcols[$i]['Type']." ".$tcols[$i]['Null']." ".$tcols[$i]['Key']." ".$tcols[$i]['Default']." ".$tcols[$i]['Extra']." After ".$ecol[$af]['Field'].", ";
            }
           }
           echo $altq;
           if($altq==""){}else{
            $altqs =  "Alter Table ".$table." ".substr($altq,0,-2);
            try{
              $res = mysqli_query($con,$altqs);
            }
            catch(\Exception $ex)
            {
              $res = $ex->getMessage()." ".$altqs;
            }
           }
        }else{}
       }
       catch(\Exception $ex){
        $res = $ex->getMessage();
       }
     }else{
      
      try{
       $tcols="";
       if(is_array($cols)){
         foreach($cols as $kk=>$vv){
          $tcols.=$kk." ".$vv.", ";
         }
       }else{
         $tcols="";
       }
       $res = mysqli_query($con,"CREATE TABLE IF NOT EXISTS ".$table." ( id  bigint(20) NOT NULL AUTO_INCREMENT, ".$tcols." PRIMARY KEY(id) )");
      }
      catch(\Exception $ex)
      {
       $res = $ex->getMessage();
      }
     }
   }
   catch(\Exception $ex){
    $res = $ex->getMessage();
   }
   }else{$res=$con;}
   return $res;
 }
 
 public function __destruct(){
   //echo "<hr/>end";
 }
}

?>