<?php
if (isset($_SESSION['idClient'])) {

    if(isset($_REQUEST['save'])){
        $nameCli=$_REQUEST['nameCli']??'';
        $emailCli=$_REQUEST['emailCli']??'';
        $addressCli=$_REQUEST['addressCli']??'';
        $queryCli="UPDATE clients set name='$nameCli',email='$emailCli',address='$addressCli' where id='".$_SESSION['idClient']."' ";
        $resCli=mysqli_query($con,$queryCli);

        $nameRec=$_REQUEST['nameRec']??'';
        $emailRec=$_REQUEST['emailRec']??'';
        $addressRec=$_REQUEST['addressRec']??'';
        $queryRec="INSERT INTO recives (name,email,address,idCli) VALUES ('$nameRec','$emailRec','$$addressRec','".$_SESSION['idClient']."')
        ON DUPLICATE KEY UPDATE
        name='$nameRec',email='$emailRec',address='$addressRec'; ";
        $resRec=mysqli_query($con,$queryRec);
        if($resCli && $resRec){
            echo '<meta http-equiv="refresh" content="0; url=index.php?module=paymentGateway" />';
        }
        else{
        ?>
            <div class="alert alert-danger" role="alert">
                Error
            </div>

            <?php
        }
    }
    $queryCli="SELECT name,email,address from clients where id='".$_SESSION['idClient']."';";
    $resCli=mysqli_query($con,$queryCli);
    $rowCli=mysqli_fetch_assoc($resCli);

    $queryRec="SELECT name,email,address from recives where idCli='".$_SESSION['idClient']."';";
    $resRec=mysqli_query($con,$queryRec);
    $rowRec=mysqli_fetch_assoc($resRec);

?>
    <form method="post">
        <div class="container mt-3">
            <div class="row">
                <div class="col-6">
                    <h3>Client Information</h3>
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="nameCli" id="nameCli" class="form-control" value="<?php echo $rowCli['name'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="emailCli" id="emailCli" class="form-control" readonly="readonly" value="<?php echo $rowCli['email'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Address</label>
                        <textarea name="addressCli" id="addressCli" class="form-control" row="3"><?php echo $rowCli['address'] ?></textarea>
                    </div>
            
                </div>
                <div class="col-6">
                    <h3>Recipient Information</h3>
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="nameRec" id="nameRec" class="form-control" value="<?php echo $rowRec['name'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="emailRec" id="emailRec" class="form-control" value="<?php echo $rowRec['email'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Address</label>
                        <textarea name="addressRec" id="addressRec" class="form-control" row="3"><?php echo $rowRec['address'] ?></textarea>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" id="recipient">
                            Bring client info
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <a class="btn btn-warning" href="index.php?module=cart" role="button">Back to cart</a>
        <button type="submit" class="btn btn-primary float-right" name="save" value="save">Pay</button>
    </form>
<?php
} else {
?>
    <div class="mt-5 text-center">
        Please <a href="login.php">login</a> or <a href="register.php">register</a>
    </div>
<?php

}
?>