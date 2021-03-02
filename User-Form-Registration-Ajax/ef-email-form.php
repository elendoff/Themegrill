<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="messsage" style="color:green;"></div>
            <form method="post" id="user_form">
                <div class="row">

                    <div class="form-group row">
                        <label for="email">Email</label>
                        <div class="col-md-12">
                            <input type="text" name="email" id="email" class="form-control">
                            <p id="p1" style="color: red;"></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password">Password</label>
                        <div class="col-md-12">
                            <input type="password" name="password" id="password" class="form-control">
                            <p id="p2" style="color: red;"></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="username">UserName</label>
                        <div class="col-md-12">
                            <input type="text" name="username" id="username" class="form-control">
                            <p id="p3" style="color: red;"></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="display_name">DisplayName</label>
                        <div class="col-md-12">
                            <input type="text" name="displayname" id="displayname" class="form-control">
                            <p id="p4" style="color: red;"></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="first_name">FirstName</label>
                        <div class="col-md-12">
                            <input type="text" name="firstname" id="firstname" class="form-control">
                            <p id="p5" style="color: red;"></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="last_name">LastName</label>
                        <div class="col-md-12">
                            <input type="text" name="lastname" id="lastname" class="form-control">
                            <p id="p6" style="color: red;"></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <select name="role" id="role">
                                <option value="">Role</option>
                                <option value="subscriber">Subscriber</option>
                                <option value="editor">Editor</option>
                                <option value="administrator">Administrator</option>
                            </select>
                            <p id="p7" style="color: red;"></p>
                        </div>
                    </div>
                    <br>
                    <br>
                    <input type="submit" name="submit_button" id="ef_email_form">
                </div>
            </form>
        </div>
    </div>
</div>
<?php // if (isset($_POST['submit_button'])) { // $email=sanitize_email($_POST['email']); // $password=sanitize_text_field($_POST['password']); // $username=sanitize_user($_POST['username']); // $displayname=sanitize_text_field($_POST['displayname']); // $firstname=sanitize_text_field($_POST['firstname']); // $lastname=sanitize_text_field($_POST['lastname']); // $role=sanitize_text_field($_POST['role']); // $user=wp_insert_user(array( // 'user_email'=> $email,
// 'user_pass' => $password,
// 'user_login' => $username,
// 'display_name' => $displayname,
// 'first_name' => $firstname,
// 'last_name' => $lastname,
// 'role' => $role,
// ));
// if (!is_wp_error($user)) {
// add_user_meta($user, 'deepen', 'deepen');
// echo "sucessfully inserted";
// } else {
// echo "not inserted";
// }
// }

?>