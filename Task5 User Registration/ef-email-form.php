<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form method="post">
                <div class="row">
                    <div class="form-group row">
                        <label for="email">Email</label>
                        <div class="col-md-12">
                            <input type="text" name="email" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password">Password</label>
                        <div class="col-md-12">
                            <input type="password" name="password" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="username">UserName</label>
                        <div class="col-md-12">
                            <input type="text" name="username" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="display_name">DisplayName</label>
                        <div class="col-md-12">
                            <input type="text" name="displayname" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="first_name">FirstName</label>
                        <div class="col-md-12">
                            <input type="text" name="firstname" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="last_name">LastName</label>
                        <div class="col-md-12">
                            <input type="text" name="lastname" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <select name="role">
                                <option value="">Role</option>
                                <option value="subscriber">Subscriber</option>
                                <option value="editor">Editor</option>
                                <option value="administrator">Administrator</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <br>
                    <input type="submit" name="submit_button">
                </div>
            </form>
        </div>
    </div>
</div>
<?php

if (isset($_POST['submit_button'])) {
    $email = sanitize_email($_POST['email']);
    $password = sanitize_text_field($_POST['password']);
    $username = sanitize_user($_POST['username']);
    $displayname = sanitize_text_field($_POST['displayname']);
    $firstname = sanitize_text_field($_POST['firstname']);
    $lastname = sanitize_text_field($_POST['lastname']);
    $role = sanitize_text_field($_POST['role']);

    $user = wp_insert_user(array(
        'user_email'  =>  $email,
        'user_pass' => $password,
        'user_login' => $username,
        'display_name' => $displayname,
        'first_name' => $firstname,
        'last_name' => $lastname,
        'role' => $role,


    ));

    
    if (!is_wp_error($user)) {
        add_user_meta($user, 'deepen','deepen');
        echo "sucessfully inserted";
    } else {
        echo "not inserted";
    }
}

?>