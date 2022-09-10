<?php
$error ='';
$name ='';
$email ='';
$phone ='';

function clean_text($string)
{
    $string =trim($string);
    $string =stripcslashes($string);
    $string = htmlspecialchars($string);
    return $string;
}
if (isset($_POST['submit'])){
    if(empty($_POST['name']))
    {
        $error .='<p><label class="text-danger">Please Enter your name</label></p>';
    }
    else{
        $name = clean_text($_POST["name"]);
            if(!preg_match("/^[a-zA-Z ]*$/",$name))
        {
            $error .='<p><label class="text-danger">Add only Letters!!</label></p>';
        }
    }
    if(empty($_POST['email']))
    {
        $error .='<p><label class="text-danger">Please Enter your email</label></p>';
    }
    else
    {
        $name = clean_text($_POST['email']);
    }
    if(empty($_POST["phone"]))
    {
        $error .= '<p><label class="text-danger">Phone number is required</label></p>';
    }
    else
    {
        $phone = clean_text($_POST["phone"]);
    }
    if ($error == ''){
        $file_open = fopen("detail_data.csv","a");
        $no_row = count(file("detail_data.csv"));
        if ($no_row >1)
        {
            $no_row = ($no_row -1 )+1;

        }
        $form_data= array(
            'sr_no'=> $no_row,
            'name'=> $name,
            'email'=> $email,
            'phone'=> $phone);
        fputcsv($file_open,$form_data);
        $error ='<label class="text-success">Successfully Registered</label>';
        $name='';
        $email='';
        $phone='';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <div class="wrapper">
        <div class="text">
            <div class="register" style="font-size:25px; color:#823e3e;">Login/Signup</div>
            <div class="login"></div>
            
        </div>

        <div class="form-container">
            <div class="slide">
                <input type="radio" style="display:none;" name="slider" id="register"  checked>
                <input type="radio" style="display:none;" name="slider" id="login">
                <label for="register" class="s register">Register</label>
                <label for="login" class="s login">Login</label>
                <div class="tab"></div>
            </div>
            <div class="form">
                <form action="#" class="register" method="post">
                <?php if(!empty($error)) {
                    echo '<div class="alert alert-success" role="alert">'.$error.'</div>';
                    }
                ?>
                    <div class="field">
                        <input type="text" name="name" placeholder="Enter Name" value="<?php echo $name; ?>" />
                        <input type="email" name="email" placeholder="Enter your Email" value="<?php echo $email; ?>" />
                        <input type="text" name="phone" placeholder="Enter Phone Number" value="<?php echo $phone; ?>" />
                        <input type="submit" name=submit value="Register">
                        <div class="link">
                            <br>Already a member?<a href="#"> Login</a>
                        </div>
                        
                    </div>
                    

                </form>
                <form action="#" class="login">
                    <div class="field">
                        <input type="email"  placeholder="Enter your Email" required>
                        <input type="text" placeholder="Enter Phone Number" required>
                        <input type="submit" value="Login">
                        <div class="linkb">
                            <br>Not a memeber?<a href="#">Register</a>
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>
        <script>
            const registerform = document.querySelector("form.register");
            const loginform = document.querySelector("form.login");
            const registerbtn = document.querySelector("label.register");
            const loginbtn = document.querySelector("label.login");
            const registerlink = document.querySelector(".link a");
            const loginlink = document.querySelector(".linkb a");
            registerbtn.onclick = (()=>{
                registerform.style.marginLeft = "0%";
            });
            loginbtn.onclick = (()=>{
                registerform.style.marginLeft = "-107%";
            });
            registerlink.onclick = (()=>{
                loginbtn.click();
                return false;
            });
            loginlink.onclick = (()=>{
                registerbtn.click();
                return false;
            });
        </script>
    </div>
</body>
</html>