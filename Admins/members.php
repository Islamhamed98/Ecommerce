<?php

/*
    *******************************************************
    **  Manage Members Page
    **  You Can Add || Edit || Delete Members From Here
    *******************************************************
*/
session_start();
if(isset($_SESSION['Username'])) {

    $pageTitle = 'Members';

    include 'init.php';
    $do =  isset($_GET['do']) ? $_GET['do'] : 'Manage';
    if($do == 'Manage'){ // Manage Page

        $stmt = $con->prepare("SELECT * FROM users WHERE GroupID != 1 ");
        $stmt->execute();
        $rows = $stmt->fetchAll();

  ?>
        <h1 class="text-center"> Manage Members  </h1>
        <div class="container">
            <div class="table-responsive">
                <table class="main-table text-center table table-bordered">
                    <tr class="ter">
                        <td>#ID</td>
                        <td>Usernaem</td>
                        <td>Email</td>
                        <td>Full Name</td>
                        <td>Regesterd Date</td>
                        <td>Control</td>
                        <td> </td>
                    </tr>
                    <?php
                        foreach( $rows as $row )
                        {
                            echo "<tr>";
                                echo "<td>" . $row['UserID']  . "</td>";
                                echo "<td>" . $row['Username']  . "</td>";
                                echo "<td>" . $row['Email']  . "</td>";
                                echo "<td>" . $row['FullName'] . "</td>";
                                echo "<td>" . '15 / 20 / 2018' . "</td>";
                                echo "<td>" . 'Admin' . "</td>";
                                echo "<td> <a href='members.php?do=Edit&userid=" . $row['UserID'] . "' class='btn btn-success btn'>Edit</a>

                                   <a href='members.php?do=Delete&userid=" . $row['UserID'] . "' class='btn btn-danger'>Delete</a>
                                 </td>";
                            echo "</tr>";
                        }


                    ?>
               </table>
            </div>
        </div>


    <?php }
    elseif($do == 'Add'){ // Add Member Page ?>


            <h1 class="text-center">  Add New Member  </h1>
            <div class="container">
                <form class="form-horizontal" action="?do=Insert" method="POST">
                    <!--Start Username Field -->
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Username</label>
                            <div class="col-sm-10 col-md-6">
                                <input type="text" name="username" class="form-control" placeholder="Username" autocomplete="off" />
                                <i class="star fa fa-star fa-1x " style="color:#560d0d" ></i>
                            </div>
                    </div>
                    <!-- Start Password Field -->
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10 col-md-6">
                                <input type="password" name="newpassword" class="password form-control" placeholder="Password" autocomplete="off"  />
                                <i class="show-pass fa fa-eye fa-2x"></i>
                            </div>
                    </div>
                     <!-- Start Email Feild  -->
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10 col-md-6">
                                <input type="email" name="email" class="form-control" placeholder="Email" autocomplete="off"  />
                                <i class="star fa fa-star fa-1x " style="color:#560d0d" ></i>
                            </div>
                    </div>
                    <!-- Start Fullname Feild -->
                    <div class="form-group">
                        <label class="col-sm-2 control-label ">Fullname</label>
                            <div class="col-sm-10 col-md-6">
                                <input type="text" name="full" class="form-control" placeholder="Fullname" autocomplete="off"  />
                                <i class="star fa fa-star fa-1x " style="color:#560d0d" ></i>
                            </div>
                     </div>
                    <!-- Button To Send The Request Of Form  -->
                    <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" value="Add Member" class="btn btn-danger" />
                    </div>
                    </div>

                </form>
             </div>



   <?php }
    elseif ($do == 'Insert'){

        if( $_SERVER['REQUEST_METHOD'] == 'POST' )
            {

                // Get Variables From Form
                echo '<h1 class="text-center"> Add Member </h1>';
                echo  "<div class='container'>";

                // Condition previation ==> condition() ? True : false;
                $pass = $_POST['newpassword'];
                $user = $_POST['username'];
                $email = $_POST['email'];
                $fullname = $_POST['full'];
                $hasspassword=sha1( $_POST['newpassword']);
                 // Validate The Form

                $formErrors = array();
                if(empty($user) || strlen($user) < 4 )   $formErrors[] =  'Please Check The <strong> User</strong> Feild' ;
                if(empty($email))    $formErrors[] = "Please Check The <strong>Email</strong> Feild ";
                if(empty($fullname)) $formErrors[] = "Please Check The <strong> FullName</strong> Feild";
                if(empty($pass))     $formErrors[] = "Please Check The <strong> Password</strong> Feild";
                foreach( $formErrors as $error ){
                    echo '<div class="alert alert-danger"' . $error . '</div>' .  '<br/>' ;
                }

                // Update The db With This Info
                if(empty($formErrors)) {

                    $stmt = $con->prepare("INSERT INTO users ( Username , password , Email , FullName )
                                                       Values   ( '$user' , '$hasspassword', '$email',' $fullname') ");
                    $stmt->execute(array( $user , $hasspassword, $email, $fullname ));

                }

        } else {
                echo "You Can't Browse This Page Directly " ;
            }

        echo "</div> ";

    }

    }
    elseif($do === 'Edit') { // Edit Page


        $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

        $stmt  = $con->prepare( "SELECT * From users WHERE UserID = ? Limit 1" );
        $stmt->execute(array($userid));
        $row   = $stmt->fetch();
        $count = $stmt->rowCount();
        // To Check About The Member Is Found in The Database Or Not
        if($count > 0) {  ?>

        <h1 class="text-center">  Edit Member  </h1>
            <div class="container">
                <form class="form-horizontal" action="?do=Update" method="POST">
                    <input type="hidden" name="userid" value="<?php echo $userid ;?>"/> <!-- To get id from member -->
                    <!--Start Username Field -->
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Username</label>
                            <div class="col-sm-10 col-md-6">
                                <input type="text" name="username" class="form-control" value = "<?php echo $row['Username'] ?>"autocomplete="off" required="required"/>
                            </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10 col-md-6">
                                <input type="hidden" name="oldpassword" class="form-control" value = "<?php echo $row['password'] ?>" autocomplete="off" />
                                <input type="password" name="newpassword" class="form-control" value = "<?php echo $row['password'] ?>" autocomplete="off"/>
                            </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10 col-md-6">
                                <input type="email" name="email" class="form-control" value = "<?php echo $row['Email'] ?>" autocomplete="off" required="required"/>
                            </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label ">Fullname</label>
                            <div class="col-sm-10 col-md-6">
                                <input type="text" name="full" class="form-control" value = "<?php echo $row['FullName'] ?>" autocomplete="off" required="required"/>
                            </div>
                    </div>
                    <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" value="Save" class="btn btn-danger" />
                    </div>
                    </div>

                </form>

            </div>
       <?php
        }else { // IF The Member Is Not Found
            echo "There Is No Such Id ";
        }

    } elseif($do == 'Update'){
         echo '<h1 class="text-center"> Update Member </h1>';
         echo  "<div class='container'>";
         if( $_SERVER['REQUEST_METHOD'] == 'POST' )
            {
                // Get Variables From Form
                // Condition previation ==> condition() ? True : false;
                $pass = empty($_POST['newpassword']) ?  $_POST['oldpassword'] :  $_POST['newpassword'];
                $user = $_POST['username'];
                $email = $_POST['email'];
                $user = $_POST['username'];
                $fullname = $_POST['full'];
                // Validate The Form
                $formErrors = array();
                if(empty($user) || strlen($user) < 4 )   $formErrors[] =    'Please Check The <strong> User</strong> Feild' ;
                if(empty($email))    $formErrors[] = "Please Check The <strong>Email</strong> Feild ";
                if(empty($fullname)) $formErrors[] = "Please Check The <strong> FullName</strong> Feild";
                if(empty($pass))     $formErrors[] = "Please Check The <strong> Password</strong> Feild";
                foreach( $formErrors as $error ){
                    echo '<div class="alert alert-danger"' . $error . '</div>' .  '<br/>' ;
                }

                // Update The db With This Info
                if(empty($formErrors )) {


                    $stmt = $con->prepare("UPDATE users SET Username = ? , Email = ? , FullName = ?  WHERE UserID = ? ");
                    $stmt->execute(array( $user,  $email , $fullname , $id));
                    echo "<div class='alert alert-success'> " . $stmt->rowCount() . '<strong> Updated Record </strong></div>' ;
                }

            }  else  echo "You Can't Browse This Page Directly " ;


        echo "</div> ";
    }
    else if($do == 'Delete'){
        //delete page
        echo  " Esla m ASdasd ";
    }

else {
    header('Location: index.php');
    exit();
}
