<div class="container" style="width:900px; margin:10px auto;">
    <div class="mws-panel grid_8">
        <div class="mws-panel-header">
            <span>Sign Up New User</span>
        </div>
        <div class="mws-panel-body no-padding">

            <?php if (isset($validate_errors)) { ?>
            <div style="padding:5px 0;">
                <div class="alert alert-error" style="width:90%; margin:10px auto;">
                    <h4>เกิดข้อผิดพลาด</h4>
                    <?php
                    foreach ($validate_errors->all(':message<br>') as $error)
                    {
                        echo $error;
                    }
                    ?>
                </div>
            </div>
            <?php } ?>

            <?php if (isset($signup_success)) { ?>
                <div style="padding:10px;">
                    <h4>สร้างผู้ใช้งานสำเร็จ</h4>
                    <p><a href="<?php echo URL::to('admin/login') ?>" class="btn btn-success">เข้าสู่ระบบ Login</a></p>
                </div>
            <?php } else { ?>

                <form method="post" action="<?php echo URL::to('admin/signup') ?>" class="mws-form">
                    <div class="mws-form-inline">
                        <div class="mws-form-row">
                            <label class="mws-form-label" for="email">E-mail</label>
                            <div class="mws-form-item">
                                <input type="text" class="small" name="email" id="email" value="">
                            </div>
                        </div>
                        <div class="mws-form-row">
                            <label class="mws-form-label" for="username">Username</label>
                            <div class="mws-form-item">
                                <input type="text" class="small" name="username" id="username" value="">
                            </div>
                        </div>
                        <div class="mws-form-row">
                            <label class="mws-form-label" for="password">Password</label>
                            <div class="mws-form-item">
                                <input type="password" class="small" name="password" id="password" value="">
                            </div>
                        </div>
                        <div class="mws-form-row">
                            <label class="mws-form-label" for="password_confirmation">Re-Type Password</label>
                            <div class="mws-form-item">
                                <input type="password" class="small" name="password_confirmation" id="password_confirmation" value="">
                            </div>
                        </div>
                    </div>
                    <div class="mws-button-row">
                        <input type="submit" class="btn btn-primary btn-large" value="Sign Up">
                    </div>
                </form>

            <?php } ?>
        </div>
    </div>
</div>