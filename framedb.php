<?php
class database{	
	public $con;
	public function __construct(){
	  $host = "localhost";
	  /* $database = "id1831412_easytoselect";
	  $user = "id1831412_easytoselect";
	  $password = "easytoselect@123"; */
	  $database = "tkyykccx_easytoselect";
	  $user = "tkyykccx_admin";
	  $password = "admin123";
	  $this->con=mysqli_connect($host,$user,$password,$database);
	}
//======================================================================================
	public function insertrec($query){
	  //mysqli_real_escape_string($this->con,$query); 
	  $result = mysqli_query($this->con,$query);
	  return $result;
	}
	public function insertid($query){
	  //mysqli_real_escape_string($this->con,$query); 
	  mysqli_query($this->con,$query);
	  $result=mysqli_insert_id($this->con);
	  return $result;
	}
//======================================================================================		
	public function singlerec($query){
	  //mysqli_real_escape_string($this->con,$query); 
	  $result = mysqli_query($this->con,$query);
		if(!($result)) {
            $err1 = mysqli_errno();
            $err2 = mysqli_error();
            echo ("$query  $err1 $err2");
            exit;
		}
	  $row = mysqli_fetch_array($result,MYSQLI_BOTH);
	  return $row;
	}
//======================================================================================
	public function get_all($query){
	  //mysqli_real_escape_string($this->con,$query); 
	  $result = mysqli_query($this->con,$query);
	  $i=0; $row1=array();
	  while($row = mysqli_fetch_array($result,MYSQLI_BOTH)){
	  $row1[$i]= $row;
	  $i++;
	  }
	  return $row1;
	}
	public function get_all_assoc($query){
	  //mysqli_real_escape_string($this->con,$query); 
	  $result = mysqli_query($this->con,$query);
	  $i=0; $row1=array();
	  while($row = mysqli_fetch_assoc($result,MYSQLI_BOTH)){
	  $row1[$i]= $row;
	  $i++;
	  }
	  return $row1;
	}
  //======================================================================================	
  function singlecolumn ($query) {
        $x = 0;
		//mysqli_real_escape_string($this->con,$query); 
		$result = mysqli_query($this->con,$query);
        $q = array() ;
        while ($row =  mysqli_fetch_array($result,MYSQLI_BOTH)) {
            $q[$x] = $row[0];
            $x++;
        }
        mysqli_free_result($result);
        return $q;
    }
	//======================================================================================	
	function Extract_Single($query){
        $x = 0;
        //mysqli_real_escape_string($this->con,$query); 
		$result = mysqli_query($this->con,$query);
        while($row=mysqli_fetch_array($result,MYSQLI_BOTH)){
            $q[$x] = $row[0];
            $implode[] = $q[$x] ;
            $x++;
        }
        mysqli_free_result($result);
        return @implode(',', $implode);
    }
//======================================================================================	
	function check1column($table,$column,$v1) {
        $query="select * from $table where $column ='$v1'";
		//mysqli_real_escape_string($this->con,$query); 
		$result = mysqli_query($this->con,$query);
        $row=mysqli_fetch_array($result,MYSQLI_BOTH);
		//echo count($row); die;
		mysqlI_free_result($result);
        if ($row[0])
            $var =  1;
        else
            $var =  0;
        return $var;
    }
  //======================================================================================	
       function check2column($table,$column1,$v1,$column2,$v2) {
        $query="select * from $table where $column2 ='$v2' and $column1='$v1'";
        //mysqli_real_escape_string($this->con,$query); 
		$result = mysqli_query($this->con,$query);
        $row=mysqli_fetch_array($result,MYSQLI_BOTH);
		mysqlI_free_result ($result);
        if ($row[0])
            $var =  1;
        else
            $var =  0;
        return $var;
    }
    //======================================================================================
	/* Pagination*/
    //==========================================================================================================
	function page_break($count,$records,$page){
		$livepage = $_SERVER["PHP_SELF"];
		$livepage = substr(strrchr($livepage, '/'), 1);
		$disp="";
		if($records < $count){
			$limit=$count / $records;
			for($i=0;$i<$limit;$i++){
				$slno=$i+1;
				$link="$livepage?page=".$slno;
				$disp .="<li><a href='$link'>$slno</a></li>";
			}
		}
		else{
			unset($_SESSION['limit']);
			unset($_SESSION['start']);
		}		
		return $disp;	
    }
	//========================================================================	
	public function strescap($string){
		$ret = addslashes(mysqli_real_escape_string($this->con,$string));
		return $ret;
	}
}

	$GT_vadmin = 1;
//========================================================================
while(list($key,$value)=@each($_POST)) {
	$$key=$value;
}

while(list($key,$value)=@each($_GET)) {
    $$key=$value;
}	
?>