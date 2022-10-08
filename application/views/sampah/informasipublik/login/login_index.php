<section id="services">
    <div class="container"> 
        <div style="margin-top: 150px;"></div>
        <div class="row" id="loginpage">
            <div class="col-md-4 col-md-offset-4">
                <div class="well">
                    <h3>Login</h3>
                    <hr>
                    <br>
                    <?php
                    echo validation_errors('<div class="aleft alert-danger">', '</div>');
                    $attributes = array('data-toggle' => 'validator', 'role' => 'form');
                    echo form_open('login', $attributes);
                    ?>
                    <div class="form-group has-feedback">
                        <label>Email</label>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            <input type="text" class="form-control" id="username" placeholder="username" name="username" autocomplete="off" required="true" autofocus="true">
                        </div>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <label>Password</label>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-key"></i></div>
                            <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>                                    
                        </div>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                    <div class="form-group">
                        <div class="pull-right">
                            <button type="submit" name="submit" class="btn btn-danger btn-outline"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Login</button>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <?php echo form_close(); ?>
                </div>                    
            </div>
        </div>
        <div style="margin-top: 100px;"></div>
    </div>
</section>