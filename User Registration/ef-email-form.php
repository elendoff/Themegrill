<!-- Tempale of the User Registration -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="messsage" style="color:green;"></div>
            <form method="post" id="user_form">
                <div class="row">
                    <div class="form-group row">
                        <label for="email"><?php echo __( "Email", 'email-form-plugin' )  ?></label>
                        <div class="col-md-12">
                            <input type="text" name="efp_email" id="email" class="form-control">
                            <p id="p1" style="color: red;"></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password"><?php echo __( "Password", 'email-form-plugin' ) ?></label>
                        <div class="col-md-12">
                            <input type="password" name="efp_password" id="password" class="form-control">
                            <p id="p2" style="color: red;"></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="username"><?php echo __( "UserName", 'email-form -plugin' ) ?></label>
                        <div class="col-md-12">
                            <input type="text" name="efp_username" id="username" class="form-control">
                            <p id="p3" style="color: red;"></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="display_name"><?php echo __( "DisplayName", 'email-form -plugin' ) ?></label>
                        <div class="col-md-12">
                            <input type="text" name="efp_displayname" id="displayname" class="form-control">
                            <p id="p4" style="color: red;"></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="first_name"><?php echo __( "FirstName", 'email-form-plugin' ) ?></label>
                        <div class="col-md-12">
                            <input type="text" name="efp_firstname" id="firstname" class="form-control">
                            <p id="p5" style="color: red;"></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="last_name"><?php echo __( "LastName", 'email-form-plugin' ) ?></label>
                        <div class="col-md-12">
                            <input type="text" name="efp_lastname" id="lastname" class="form-control">
                            <p id="p6" style="color: red;"></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <?php global $wp_roles; ?>
                            <select name="efp_role">
                                <?php foreach ( $wp_roles->roles as $key => $value ) : ?>
                                    <option value="<?php echo $key; ?>"><?php echo $value['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <p id="p7" style="color: red;"></p>
                        </div>
                    </div>
                    <br>
                    <br>
                    <input type="submit" name="ur_submit_button" id="ef_email_form">
                </div>
            </form>
        </div>
    </div>
</div>
