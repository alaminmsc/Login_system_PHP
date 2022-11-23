<?php

    $conn = mysqli_connect('localhost','root','','registration') or die(msqli_error());
    if(!$conn){
        echo 'Database not connected';
    }


    if(isset($_POST['submit'])){
        $fname = $_POST['fname'];
        $uname = $_POST['uname'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        if(isset($_POST['gender'])){$gender = $_POST['gender'];}
        if(isset($_POST['games'])){$games = $_POST['games'];}
        if(isset($_POST['country'])){$country = $_POST['country'];}
        $pass = $_POST['pass'];
        $cpass = $_POST['cpass'];

        $error = [];

        if(empty($fname)){
            $error['fname'] = 'Please write your full name';
        }
        if(empty($uname)){
            $error['uname'] = 'Please write your user name';
        }
        if(empty($email)){
            $error['email'] = 'Please write your email';
        }
        if(empty($address)){
            $error['address'] = 'Please write your Address';
        }
        if(empty($gender)){
            $error['gender'] = 'Please write your Gender';
        }
        if(empty($games)){
            $error['games'] = 'Please write your Gender';
        }
        if(empty($country)){
            $error['country'] = 'Please write your Country';
        }
        if(empty($pass)){
            $error['pass'] = 'Please write your Password';
        }
        if(empty($cpass)){
            $error['cpass'] = 'Please write your Confirm Password';
        }

        if(count($error) == 0){
            $email_check = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
            $email_count = mysqli_num_rows($email_check);
            if($email_count == 0){
                $uname_check = mysqli_query($conn, "SELECT * FROM users WHERE uname = '$uname'");
                $uname_count = mysqli_num_rows($uname_check);
                if($uname_count == 0){
                    if(strlen($uname) > 6) {
                        if(strlen($pass) > 7){
                            if($pass == $cpass){

                            }else{
                                $pass_match = "Password Not Match";
                            }
                        }else{
                            $pass_len = "Password at least 8 character";
                        }

                    }else{
                        $user_len = "Username at least 6 character";
                    }
                    
                }else{
                    $uname_match = "User name Already Exists!";
                }
            }else{
                    $email_match = "Email Already Exists!";
            }
        }else{
            
        }

    }

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col-xxl-5 mx-auto">
                <h3 class="p-3 bg-primary text-white text-center">Registration Form</h3>
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                    <div class="mb-3">
                        <label>Full Name</label>
                        <input type="text" name="fname" class="form-control" value="<?php if(isset($fname)){echo $fname;}?>">
                        <span style="color:red;">
                            <?php
                                if(isset($error['fname'])){
                                    echo $error['fname'];
                                }
                            ?>
                        </span>
                    </div>
                    <div class="mb-3">
                        <label>User Name</label>
                        <input type="text" name="uname" class="form-control" value="<?php if(isset($uname)){echo $uname;}?>">
                        <span style="color:red;">
                            <?php
                                if(isset($error['uname'])){
                                    echo $error['uname'];
                                }
                            ?>
                        </span>
                        <span style="color:red;">
                            <?php
                                if(isset($uname_match)){
                                    echo $uname_match;
                                }
                            ?>
                        </span>
                        <span style="color:red;">
                            <?php
                                if(isset($user_len)){
                                    echo $user_len;
                                }
                            ?>
                        </span>
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="<?php if(isset($email)){echo $email;}?>">
                        <span style="color:red;">
                            <?php
                                if(isset($error['email'])){
                                    echo $error['email'];
                                }
                            ?>
                        </span>
                        <span style="color:red;">
                            <?php
                                if(isset($email_match)){
                                    echo $email_match;
                                }
                            ?>
                        </span>
                    </div>
                    <div class="mb-3">
                        <label>Address</label>
                        <textarea name="address" class="form-control"><?php if(isset($address)){echo $address;}?></textarea>
                        <span style="color:red;">
                            <?php
                                if(isset($error['address'])){
                                    echo $error['address'];
                                }
                            ?>
                        </span>
                    </div>
                    <div class="mb-3">
                        <label>Gender</label>
                        <br>
                        <input type="radio" name="gender" value="Male" <?php if(isset($gender) && $gender == 'Male'){echo 'Checked';}?>> Male
                        <input type="radio" name="gender" value="Female" <?php if(isset($gender) && $gender == 'Female'){echo 'Checked';}?>> Female
                        <br>
                        <span style="color:red;">
                            <?php
                                if(isset($error['gender'])){
                                    echo $error['gender'];
                                }
                            ?>
                        </span>
                    </div>
                    <div class="mb-3">
                        <label>Games</label>
                        <br>
                        <input type="checkbox" name="games[]" value="Cricket" <?php if(isset($games)){if(in_array('Cricket',$games)){echo 'checked';}}?>> Cricket
                        <input type="checkbox" name="games[]" value="Football" <?php if(isset($games)){if(in_array('Football',$games)){echo 'checked';}}?>> Football
                        <input type="checkbox" name="games[]" value="Hockey" <?php if(isset($games)){if(in_array('Hockey',$games)){echo 'checked';}}?>> Hockey
                        <br>
                        <span style="color:red;">
                            <?php
                                if(isset($error['games'])){
                                    echo $error['games'];
                                }
                            ?>
                        </span>
                    </div>
                    <div class="mb-3">
                        <label>Select Country</label>
                        <select name="country" class="form-control">
                            <option selected disabled>Choose Country</option>
                            <option value="Bangladesh" <?php if(isset($country) && $country == 'Bangladesh'){echo 'selected';}?>>Bangladesh</option>
                            <option value="USA" <?php if(isset($country) && $country == 'USA'){echo 'selected';}?>>USA</option>
                            <option value="Canada" <?php if(isset($country) && $country == 'Canada'){echo 'selected';}?>>Canada</option>
                            <option value="Malaysia" <?php if(isset($country) && $country == 'Malaysia'){echo 'selected';}?>>Malaysia</option>
                        </select>
                        <br>
                        <span style="color:red;">
                            <?php
                                if(isset($error['country'])){
                                    echo $error['country'];
                                }
                            ?>
                        </span>
                    </div>
                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="pass" class="form-control" value="<?php if(isset($pass)){echo $pass;}?>">
                        <br>
                        <span style="color:red;">
                            <?php
                                if(isset($error['pass'])){
                                    echo $error['pass'];
                                }
                            ?>
                        </span>
                        <span style="color:red;">
                            <?php
                                if(isset($pass_len)){
                                    echo $pass_len;
                                }
                            ?>
                        </span>
                    </div>
                    <div class="mb-3">
                        <label>Confirm Password</label>
                        <input type="password" name="cpass" value="<?php if(isset($cpass)){echo $cpass;}?>" class="form-control">
                        <br>
                        <span style="color:red;">
                            <?php
                                if(isset($error['cpass'])){
                                    echo $error['cpass'];
                                }
                            ?>
                        </span>
                        <span style="color:red;">
                            <?php
                                if(isset($pass_match)){
                                    echo $pass_match;
                                }
                            ?>
                        </span>
                    </div>
                    <div class="mb-3">
                        <input type="submit" value="Registration" name="submit" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>