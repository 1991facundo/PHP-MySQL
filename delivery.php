<?php
if (isset($_SESSION['idClient'])) {
?>
    <div class="container mt-3">
        <div class="row">
            <div class="col-6">
                <h3>Client Information</h3>
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="nameCli" id="nameCli" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" name="emailCli" id="emailCli" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Address</label>
                    <textarea name="addressCli" id="addressCli" class="form-control" row="3"></textarea>
                </div>
            </div>
            <div class="col-6">
                <h3>Shipping information/h3>
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="nameRec" id="nameRec" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" name="emailRec" id="emailRec" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Address</label>
                    <textarea name="addressRec" id="addressRec" class="form-control" row="3"></textarea>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" id="push">
                        Get client information
                    </label>
                </div>
            </div>
        </div>
    </div>
<?php
} else {
?>
    <div class="mt-5 text-center">
        Please <a href="login.php">login</a> or <a href="register.php">register</a>
    </div>
<?php

}
?>