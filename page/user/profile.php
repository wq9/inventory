<?php include_once('../../header.php'); ?>

<div class="row">
    <div class="four columns">

        <?php
        if (isset($_POST['btn_update_profile'])) {
            $continue = true;
            $password = isset($_POST['password']) ? safety_filter($_POST['password']) : exit;
            $password_again = isset($_POST['password_again']) ? safety_filter($_POST['password_again']) : exit;
            $old_password = isset($_POST['old_password']) ? safety_filter($_POST['old_password']) : exit;
            $email = safety_filter($_POST['email']);
            $phone = safety_filter($_POST['phone']);
            $fax = safety_filter($_POST['fax']);
            $mobile = safety_filter($_POST['mobile']);
            if ($password != '') {
                if ($password != $password_again) {
                    $continue = false;
                    alert_box('alert', get_lang('Passwords do not match'));
                }
                if (md5($old_password) != get_the_current_user('password')) {
                    $continue = false;
                    alert_box('alert', get_lang('The old password is not correct'));
                }
                if (update_user(get_the_current_user('id'), get_the_current_user('status'), get_the_current_user('user_name'), $password, $email, $phone, $fax, $mobile, get_the_current_user('level'))) {
                    echo '<script> window.location = "?&success"; </script>';
                }
            } else {
                if (update_user_profile(get_the_current_user('id'), $email, $phone, $fax, $mobile)) {
                    echo '<script> window.location = "?&success"; </script>';
                }
            }
        }
        if (isset($_GET['success'])) {
            alert_box('success', get_lang('Successful'));
        }
        ?>

        <form name="form_login" id="form_login" action="" method="POST">
            <fieldset>
                <legend><?php lang('Profile'); ?></legend>



                <label for="user_name"><?php lang('User Name'); ?></label>
                <input type="text" name="user_name" id="user_name" class="required" minlength="3" maxlength="20" value="<?php the_current_user('user_name'); ?>" readonly / >    

                       <div class="row">
                    <div class="six columns">
                        <label for="level"><?php lang('Level'); ?></label>
                        <select name="level" id="level">
                            <option value="<?php the_current_user('level'); ?>" selected><?php the_current_user('level'); ?></option>
                        </select>
                    </div>
                    <div class="six columns">
                        <label for="status"><?php lang('Status'); ?></label>
                        <select name="status" id="status">
                            <option value="<?php the_current_user('status'); ?>" selected><?php the_current_user('status'); ?></option>
                        </select>
                    </div>
                </div>

                <hr />

                <label for="password"><?php lang('New'); ?> <?php lang('Password'); ?></label>
                <input type="password" name="password" id="password" minlength="3" maxlength="20" class="" />      

                <label for="password_again"><?php lang('New'); ?> <?php lang('Password Again'); ?></label>
                <input type="password" name="password_again" id="password_again" minlength="3" maxlength="20" class="" />

                <label for="old_password"><?php lang('Old Password'); ?></label>
                <input type="password" name="old_password" id="old_password" minlength="3" maxlength="20" class="" />     

                <label for="email"><?php lang('Email'); ?></label>
                <input type="text" name="email" id="email" class="required" minlength="3" maxlength="100" value="<?php the_current_user('email'); ?>" />

                <label for="phone"><?php lang('Phone'); ?></label>
                <input type="text" name="phone" id="phone" class=""minlength="10" maxlength="11" value="<?php the_current_user('phone'); ?>" />

                <label for="fax"><?php lang('Fax'); ?></label>
                <input type="text" name="fax" id="fax" class="" minlength="10" maxlength="11" value="<?php the_current_user('fax'); ?>" />

                <label for="mobile"><?php lang('Mobile'); ?></label>
                <input type="text" name="mobile" id="mobile" class="" minlength="10" maxlength="11" value="<?php the_current_user('mobile'); ?>" />


                <p></p> 

                <input type="submit" name="btn_update_profile" id="btn_update_profile" class="button" value="<?php lang('Update Profile'); ?>" />
                <input type="reset" class="button" value="<?php lang('Reset'); ?>" />

                <p></p>  

            </fieldset>
        </form>
    </div> <!-- /.four columns -->
    <div class="eight columns">


    </div> <!-- /.eight columns -->
</div> <!-- /.row -->

<?php include_once('../../footer.php'); ?>
