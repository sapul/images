<?

include('\admin\db_fns.php');

if(empty($_GET['view'])) $view = 'index';
else $view = $_GET['view'];	

$page_data = page_data($view);

switch($view)
{
	case "index":
	
	break;
	
	case "news":
		$news = select_data($view);
	break;
	
	case "video":
		$video = select_data($view);
	
	break;
	
	case "documents":
	    $table     = "d_passport"; 
		$documents = select_data($table);
	
	break;
	
	case "contacts":
		$contacts = select_data($view);
	
	break;
	
	case "dict":
	    $idparent  = 1;
//		$dict = select_data($view);
		$title     = $_GET['t'];	
		
		$r         = $_GET['r'];	
	
		
//		$page_data = get_dict($title);
        if(isset($title))
		{
		    	
			if(isset($_GET['r']))
			{
//			echo "Переменная r: ".$r;
				$dict      = select_dict_record($title);

			}	
			else
				$dict      = select_dict($title);
			if(isset($_POST['add']))
			{
			  $table            = "dict";
			  
			  $row['id']        = "id";
  			  $row['name']      = "name";
			  $row['idparent']  = "idparent";
			  
			  $data['id']       = "''";
  			  $data['name']     = "'".$_POST['name']."'";
			  $data['idparent'] = "'".$_POST['idparent']."'";
//			  $comment             = implode(',',$data);
//			  add_comment($comment);
			  insert_data($table,$row,$data);			  
			}
			if(isset($_POST['del']))
			{
			  $table            = "dict";
			  
			  $data             = $_POST['id'];
			  
			  delete_data($table,$data);			  
			} 
			if(isset($_POST['edit']))
			{
			  $table            = "dict";
			  
  			  $row['id']        = "id";
  			  $row['name']      = "name";
			  $row['idparent']  = "idparent";

			  $id               = $_POST['id'];
			  
			  $data['id']       = "'".$_POST['id']."'";
  			  $data['name']     = "'".$_POST['name']."'";
			  $data['idparent'] = "'".$_POST['idparent']."'";
			  
			  update_data($table, $id, $row, $data);		  
			} 
			
		}	
		else
		{			
			$dict      = select_dict($idparent);
		}
	
	break;
}

include($_SERVER['DOCUMENT_ROOT'].'/ezt/views/layouts/site.php');

?>
