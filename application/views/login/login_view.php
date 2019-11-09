<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN'
    'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='en' lang='en'>

    <head>    
        <title>Login Screen | Welcome </title>
    </head>
    <body>
        <div id='login_form'>
            <form action='<?php echo base_url(); ?>login/login_control/process' method='post' name='process'>
                <h2>User Login</h2>
                <br />            
                <label for='username'>Username</label>
                <input type='text' name='username' id='username' size='25' /><br />

                <label for='password'>Password</label>
                <input type='password' name='password' id='password' size='25' /><br />                            

                <input type='Submit' value='Login' />  
                <div class="form-group">
                    <div class="col-md-12 control">
                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                            Don't have an account! 
                            <a href="#" onClick="$('#loginbox').hide();
                                                $('#signupbox').show()">
                                Sign Up Here
                            </a>
                        </div>
                    </div>
                </div>
            </form>
            <?php echo $msg; ?>
        </div>
    </body>
</html>

