<?php
    include('..\SPL\includes\connect.php');
    if(isset($_POST['add_SP'])){
        $SP_name = $_POST['SP_name'];
        //profile picture
        $SP_Profile_picture = $_FILES['profile_picture']['name'];
        $SP_temp_Profile_picture = $_FILES['profile_picture']['tmp_name'];

        //district
        $SP_district = $_POST['District'];
        //area
        $SP_area = $_POST['Service_area'];

        $SP_age = $_POST['Age'];
        $SP_phone = $_POST['Phone'];
        $SP_email = $_POST['Email'];
        //service type
        $SP_type = $_POST['type'];

        $SP_NID_no = $_POST['NID_number'];
        //nid pic
        $SP_NID_pic = $_FILES['NID_picture']['name'];
        $SP_temp_NID_pic = $_FILES['NID_picture']['tmp_name'];

        $SP_price_per_hour = $_POST['Price_per_hour'];
        $SP_description = $_POST['SP_description'];
        $SP_prev_work_desc = $_POST['SP_work_description'];

        //work proof
        $SP_work_proof = $_FILES['work_exprience']['name'];
        $SP_temp_work_proof = $_FILES['work_exprience']['tmp_name'];

        $SP_password = $_POST['SP_password'];

        $SP_isApproved = 1;
        $SP_Admin_who_approved_ID = 1;
        //$SP_Date_registered = time();
        if($SP_name=='' or $SP_Profile_picture=='' or $SP_district=='' or $SP_area=='' or $SP_age=='' 
            or $SP_phone=='' or $SP_email=='' or $SP_type=='' or $SP_NID_no=='' or $SP_NID_pic=='' 
            or $SP_price_per_hour=='' or $SP_description=='' or $SP_work_proof=='' or $SP_password=='')
        {
            echo "<script>alert('Please fill all fields')</script>";
            //exit();
        }
        else{
            move_uploaded_file($SP_temp_Profile_picture,"./Profile_pictures/$SP_Profile_picture");
            move_uploaded_file($SP_temp_NID_pic,"./NID_pictures/$SP_NID_pic");
            move_uploaded_file($SP_temp_work_proof,"./Work_proof/$SP_work_proof");
            //work needs to be done up

            $insert_SP = "insert into `s_provider`(SP_Name,SP_profile_picture,SP_District_Name,SP_Area_Name,SP_Age,
            SP_Phone,SP_mail,SP_Service_type,SP_NID_number,SP_NID_pic,SP_Salary_per_hour,SP_self_desc,SP_prev_work_desc,
            SP_prev_work_proof,SP_Password,isApproved,Admin_who_approved_ID,Date_Registered)
            values('$SP_name','$SP_Profile_picture','$SP_district','$SP_area','$SP_age',
            '$SP_phone','$SP_email','$SP_type','$SP_NID_no','$SP_NID_pic','$SP_price_per_hour','$SP_description','$SP_prev_work_desc',
            '$SP_work_proof','$SP_password','$SP_isApproved','$SP_Admin_who_approved_ID',NOW()) ";

            $result_query=mysqli_query($con,$insert_SP);
            if($result_query){
                echo "<script>alert('Sign UP Successful')</script>";
            }

        }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service provider Sign-Up</title>
</head>
<body>
    <h1 class = "text-center">WE CARE</h1>
    <h2 class = "text-center">SIGN UP AS A SERVICE PROVIDER</h2>
    <!-- form -->
    <h3 class = "text-center">Personal Information</h3>
    <form action = "" method = "post" enctype = "multipart/form-data">
        <!-- SP_name -->
        <label for ="SP_name">Name</label><br>
        <input type = "text" name = "SP_name" id="SP_name" placeholder="Enter Your Name">
        <!-- SP_name ends -->
        <!-- profile_picture -->
        <br>
        <label for ="profile_picture">Set a Profile Picture</label><br>
        <input type = "file" name = "profile_picture" id="profile_picture" placeholder="Enter Your Picture">
        <!-- profile_picture ends-->
        <!-- District -->
        <br>
        <label for ="District">Choose District</label><br>
        <select name ="District" id="">
            <?php
                $select_query = "Select * from `district`";
                $result_query = mysqli_query($con,$select_query);
                while($row=mysqli_fetch_assoc($result_query)){
                    $district_id = $row['District_ID'];
                    $district_name = $row['District_Name'];
                    echo "<option value='$district_id'>$district_name</option>";
                }
            ?>
        </select>
        <!-- District ends -->
        <!-- Area -->
        <br>
        <label for ="Service_area">Choose Service Area</label><br>
        <select name ="Service_area" id="">
            <?php
                $select_query = "Select * from `area` Where District_ID = 2";
                //gotta change this
                $result_query = mysqli_query($con,$select_query);
                while($row=mysqli_fetch_assoc($result_query)){
                    $area_id = $row['Area_ID'];
                    $area_name = $row['Area_name'];
                    echo "<option value='$area_id'>$area_name</option>";
                }
            ?>
        </select>
        <!-- area ends -->
        <!-- Age -->
        <br>
        <label for ="Age">Age</label><br>
        <input type = "number" name = "Age" id="Age" placeholder="Enter Your Age">
        <!-- age ends -->
        <!-- phone -->
        <br>
        <label for ="Phone">Phone Number</label><br>
        <input type = "text" name = "Phone" id="Phone" placeholder="Enter Your Phone Number">
        <!-- phone ends -->
        <!-- email -->
        <br>
        <label for ="Email">Your Email</label><br>
        <input type = "text" name = "Email" id="Email" placeholder="Enter Your Email">
        <!-- email ends -->

    <h3 class = "text-center">Service Information</h3>

        <!-- Service_type -->
        <br>
        <label for ="type">Choose Service Type</label><br>
        <select name ="type" id="">
            <?php
                $select_query = "Select * from `service_type`";
                $result_query = mysqli_query($con,$select_query);
                while($row=mysqli_fetch_assoc($result_query)){
                    $type_id = $row['Service_ID'];
                    $type_name = $row['Service_Name'];
                    echo "<option value='$area_id'>$type_name</option>";
                }
            ?>
        </select>
        <!-- Service_type ends -->
        <!-- NID_number -->
        <br>  
        <label for ="NID_number">NID number</label><br>
        <input type = "number" name = "NID_number" id="NID_number" placeholder="Enter Your NID number">
        <!-- NID_number ends -->
        <!-- NID_picture -->
        <br>
        <label for ="NID_picture">Picture of NID</label><br>
        <input type = "file" name = "NID_picture" id="NID_picture" placeholder="Enter Your NID number">
        <!-- NID_picture ends-->
        <!-- Price -->
        <br>  
        <label for ="Price_per_hour">Service Remunertaion per hour</label><br>
        <input type = "number" name = "Price_per_hour" id="Price_per_hour" placeholder="Enter Your Service Remuneration(per hour)">
        <!-- Price ends -->
        <!-- Describe yourself -->
        <br>  
        <label for ="SP_description">Describe Yourself</label><br>
        <input type = "text" name = "SP_description" id="SP_description" placeholder="Write about yourself and your service">
        <!-- Describe yourself ends -->
        <!-- Describe your work exprience -->
        <br>  
        <label for ="SP_work_description">Previous Work Exprience</label><br>
        <input type = "text" name = "SP_work_description" id="SP_work_description" placeholder="Enter Your Previous Work Exprience">
        <!-- Describe your work exprience ends -->
        <!-- Work_exprience_proof -->
        <br>
        <label for ="work_exprience">Provide Proof of your previous work</label><br>
        <input type = "file" name = "work_exprience" id="work_exprience">
        <!-- Work_exprience_proof ends-->
        <!-- Password-->
        <br><br><br>
        <label for ="SP_password">Enter Password</label><br>
        <input type = "text" name = "SP_password" id="SP_password" placeholder="atleast 8 characters">
        <!-- Password ends-->
        <!-- Button-->
        <br>
        <input type="submit" name="add_SP">
        <!-- Button ends-->

    </form>
</body>
</html>