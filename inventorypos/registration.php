<?php
include_once'connectdb.php';

session_start();

if($_SESSION['useremail']=="" OR $_SESSION['role']=="User"){
    
    
    header('location:index.php');
}


include_once'header.php';


error_reporting(0);

$id=$_GET['id'];


$delete=$pdo->prepare("delete from tbl_user where userid=".$id);

if($delete->execute()){
    echo'<script type="text/javascript">
jQuery(function validation(){


swal({
  title: "Good Job!",
  text: "Account is deleted !!",
  icon: "success",
  button: "Ok",
});


});

</script>';
    
    
}







if(isset($_POST['btnsave'])){  

$username=$_POST['txtname'];
$useremail=$_POST['txtemail'];
$password=$_POST['txtpassword'];
$userrole=$_POST['txtselect_option'];


//echo $username ."-".$useremail."-".$password."-".$userrole;
    
if(isset($_POST['txtemail'])){ 
    
$select=$pdo->prepare("select useremail from tbl_user where useremail='$useremail'"); 
$select->execute();
    
if($select->rowCount() > 0){
    
echo'<script type="text/javascript">
jQuery(function validation(){


swal({
  title: "Warning!",
  text: "Email Already Exist : Please try from diffrent Email !!",
  icon: "warning",
  button: "Ok",
});


});

</script>'; 
    
}
    // Empty Field Start
    
    elseif(empty($username) || empty($useremail) || empty($password) || empty($userrole)){
    
 $error='<script type="text/javascript">
jQuery(function validation(){


swal({
  title: "Feild is Empty!",
  text: "Please Fill Feild!!",
  icon: "error",
  button: "Ok",
});


});

</script>';   
    
  echo $error;  
    
    
    
}//Empty Field End
    
    
    else{
    
    
      $insert=$pdo->prepare("insert into tbl_user(username,useremail,password,role) values(:name,:email,:pass,:role)"); 
    
    $insert->bindParam(':name',$username);
    $insert->bindParam(':email',$useremail);
    $insert->bindParam(':pass',$password);
    $insert->bindParam(':role',$userrole);
    
    
if( $insert->execute()){
        
/*  echo'<script type="text/javascript">
jQuery(function validation(){


swal({
  title: "Good Job!",
  text: "Your Registration is Successful",
  icon: "success",
  button: "Ok",
});


});

</script>';  */
    
echo "<script>alert('User Added Registered Successfully')</script>"; // Javascript Ok

echo "<script>window.open('registration.php','_self')</script>"; // Javascript Redirect or Reload     
   
        
}else{
        
echo'<script type="text/javascript">
jQuery(function validation(){


swal({
  title: "Error!",
  text: "Registration Fail !!!",
  icon: "error",
  button: "Ok",
});


});

</script>';  
        
}     
    
}    
    
}// end if txtemail
    

      
       
}// btnsave end here


if(isset($_POST['btnupdate'])){
    
$username=$_POST['txtname'];
$useremail=$_POST['txtemail'];
$password=$_POST['txtpassword'];
$userrole=$_POST['txtselect_option'];
$userid=$_POST['txtid'];
    
if(empty($username) || empty($useremail) || empty($password) || empty($userrole)){
   
$errorupdate='<script type="text/javascript">
jQuery(function validation(){


swal({
  title: "Error",
  text: "Feild is empty : please Fill Field!",
  icon: "error",
  button: "Ok",
});


});

</script>';    
    
    
  echo $errorupdate; 
    
} 
    
if(!isset($errorupdate)){ 

$update=$pdo->prepare("update tbl_user set username=:uname , useremail=:uemail , password=:upassword , role=:urole where userid = $userid");
     
     $update->bindParam(':uname',$username);
     $update->bindParam(':uemail',$useremail);
     $update->bindParam(':upassword',$password);
     $update->bindParam(':urole',$userrole);
     
if($update->execute()){
  /* echo '<script type="text/javascript">
jQuery(function validation(){


swal({
  title: "Updated!",
  text: "Your User is Updated!",
  icon: "success",
  button: "Ok",
});


});

</script>';  */
       
echo "<script>alert('User is Updated Successfully')</script>"; // Javascript Ok

echo "<script>window.open('registration.php','_self')</script>"; // Javascript Redirect or Reload     
    
}else{
    
      echo '<script type="text/javascript">
jQuery(function validation(){


swal({
  title: "Error!",
  text: "Your User is  Not Updated!",
  icon: "error",
  button: "Ok",
});


});

</script>';
    
    
    
    
}    




}  
    
    
} // btn update code end here

     
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Registration&trade;
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
               <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Registration Form</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="" method="post">
              <div class="box-body">
              
              
              
              
                  
                  <!--- Demarcation  --->
                  <?php
        if(isset($_POST['btnedit'])){
            
    $select=$pdo->prepare("select * from tbl_user where userid=".$_POST['btnedit']); 
    $select->execute();
    if($select){
    $row =$select->fetch(PDO::FETCH_OBJ);    
         echo'    <div class="col-md-4">
                  
                  <input type="hidden" class="form-control" value="'.$row->userid.'" name="txtid"  placeholder="Uesr Id" >
                  
                  <div class="form-group">
                  <label >Name</label>
                  <input type="text" class="form-control" value="'.$row->username.'" name="txtname" placeholder="Enter Name" >
                </div>
                                 
                                 
                <div class="form-group">
                  <label >Email address</label>
                  <input type="email" class="form-control" value="'.$row->useremail.'" name="txtemail" placeholder="Enter email" >
                </div>
                <div class="form-group">
                  <label >Password</label>
                  <input type="password" class="form-control" value="'.$row->password.'" name="txtpassword" placeholder="Password" >
                </div>
               
                <div class="form-group">
                  <label>Role</label>
                  <select class="form-control" name="txtselect_option" >
                    <option value="" disabled selected>'.$row->role.'</option>
                   <option>User</option>
                     <option>Admin</option>
                    
                  </select>
                </div>
                
                 <button type="submit" class="btn btn-warning" name="btnupdate">Update</button>
                 </div>';
                  
                 }        
            
          
       
        }else{
            
        echo' <div class="col-md-4">
                 
                                 
                <div class="form-group">
                  <label >Name</label>
                  <input type="text" class="form-control" name="txtname" placeholder="Enter Name" >
                </div>
                                 
                                 
                <div class="form-group">
                  <label >Email address</label>
                  <input type="email" class="form-control" name="txtemail" placeholder="Enter email" >
                </div>
                <div class="form-group">
                  <label >Password</label>
                  <input type="password" class="form-control" name="txtpassword" placeholder="Password" >
                </div>
               
                <div class="form-group">
                  <label>Role</label>
                  <select class="form-control" name="txtselect_option" >
                    <option value="" disabled selected>Select role</option>
                   <option>User</option>
                     <option>Admin</option>
                    
                  </select>
                </div>
                
                 <button type="submit" class="btn btn-info" name="btnsave">Save</button>
                 </div>';
                 
                 }          
               
         ?>

           
                  
              
               <div class="col-md-8">
                   
        <table id="tableregistration" class="table table-striped">
        <thead>
        <tr>
        <th>#</th>
         <th>NAME</th>   
          <th>EMAIL</th>   
           <th>PASSWORD</th>   
            <th>ROLE</th>
            <th>EDIT</th>
            <th>DELETE</th>      
        </tr>    
            
        </thead> 
           
              
                 
        <tbody>
        
    <?php
    $select=$pdo->prepare("select * from tbl_user  order by userid desc");
            
    $select->execute();
            
while($row=$select->fetch(PDO::FETCH_OBJ)  ){
    
    echo'
    <tr>
    <td>'.$row->userid.'</td>
    <td>'.$row->username.'</td>
    <td>'.$row->useremail.'</td>
    <td>'.$row->password.'</td>
    <td>'.$row->role.'</td>
    <td>
      <button type="submit" value='.$row->userid.' name="btnedit" class="btn btn-success" ><span class="glyphicon glyphicon-edit" style="color:#ffffff" data-toggle="tooltip"  title="Edit User"></span></button>
    </td>
    <td>
<a href="registration.php?id='.$row->userid.'" class="btn btn-danger" role="button"><span class="glyphicon glyphicon-trash" style="color:#ffffff" data-toggle="tooltip" title="delete"></span></a>   
    
    </td>
     </tr>
     ';
    
}          
?>        
                
 </tbody>               
</table>           
</div>
</div>
              <!-- /.box-body -->

              <div class="box-footer">
               
              </div>
            </form>
          </div>
       
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<script>
  $(document).ready( function () {
    $('#tableregistration').DataTable();
} );  
    
    
</script>

<script>
  $(document).ready( function () {
    $('[data-toggle="tooltip"]').tooltip();
} );  
    
    
</script>

  <?php

include_once'footer.php';

?>