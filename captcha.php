<?php


$_cats = [
    '1-1.jpg',
    '1-2.jpg',
    '1-3.jpg',
    '1-4.jpg',
    '1-5.jpg',
    '1-6.jpg',
    '1-7.jpg',
    '1-8.jpg',
    '1-9.jpg'
    ];
    $_dogs = [
    '2-1.jpg',
    '2-2.jpg',
    '2-3.jpg',
    '2-4.jpg',
    '2-5.jpg',
    '2-6.jpg',
    '2-7.jpg',
    '2-8.jpg',
    '2-9.jpg'
    ];
    $secret = $control = 46884564;
    // generavimo pradžia
    $target = (rand(0, 1)) ? '_cats' : '_dogs'; 
    shuffle($_cats);
    shuffle($_dogs);
    //palyginimo paveiksliuko išvedimas

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Captch</title>
</head>
<style>
.block {
    margin-top: 50px;
    display:inline-block;
    width: 316px;
    margin-left: calc(50% - 190px);
    border: 1px solid #9bc5f9;
    padding: 30px;
    border-radius: 10px;
}
    .title {
        display:inline-block;
        width: 160px;
    }
    .img {
        display:inline-block;
        width: 100px;
        height: 100px;
        margin-bottom: -20px;
        border-radius: 5px;
        cursor: pointer;
        border: 1px solid #9bc5f9;
    }
    input {
        width: 100px;
        height: 100px;
        opacity: 0.2;
        position: absolute;
        display: block;
        margin-left: 1px;
        margin-top: 1px;
    }
    label {
        
        display: block;
        width: 100px;
        height: 100px;
        cursor: pointer;
    }
    
    .check {
        display: block;
        float: left;
        position: relative;
        border-radius: 5px;
        margin-left: 2.5px;
        margin-right: 2.5px;
        margin-bottom: 5px;
    }
    .line {
        display: inline-block;
    }
    .top {
        margin-bottom: 20px;
    }
    .verify {
        display: inline-block;
        width: 100%;
        border-top: 1px solid #9bc5f9;
        border-bottom: 1px solid #9bc5f9;
        margin-top: 20px;
    }
    .verify-title {
        display: inline-block;
        float: right;
        cursor: pointer;
        border: 1px solid #9bc5f9;
        background-color: transparent;
        width: 80px;
        text-align: center;
        padding: 5px;
        margin-top: 20px;
        border-radius: 5px;
        margin-bottom: 20px;
    }
    button:hover {
        background-color: #9bc5f9;
        color: #fff;
    }
    shadow {
        background-color: black;
        opacity: 0.5;
        z-index: 1;
        background-color: black;
        opacity: 0.5;
        z-index: 1;
    }
</style>
<body>
    <div class="block">
        <div class="top">
            <p class="title">Select all images below that match this one:</p>
            <img class="img" src="img/<?= array_shift($$target) ?>" alt="photo">
        </div>

        <?php if(isset($_SESSION['err'])) { ?>
                <h2> <?= $_SESSION['err'] ?></h2>
                <?php unset($_SESSION['err']) ?>
                <?php } ?>
        <form action="" method="post">
            <div class="line">
                <?php $count = 0;  $count1 = 0?>
                <?php for ($i=0; $i<9; $i++) { ?>
                <?php  $random = (rand(0, 1)) ? '_cats' : '_dogs';
                $random_control = (rand(10000000, 99999999));
                if ($target == $random) {
                    $control = $control + $random_control;
                }?>
                    <div class="check">
                        <input type="checkbox" name="images[]" value="<?= $random_control ?>">
                        <label class="label1" for="<?= $val['id']?>">
                        <div class="shadow"></div>
                        <img class="img" src="img/<?= array_shift($$random) ?>" alt="photo"></label> 
                    </div>
                <?php } ?>
                <div class="verify">
                    <input type="hidden" name="control" value="<?= $control ?>">
                    <button class="verify-title" name="button" type="submit" value="Gerai">Verify</button>
                </div>
            </div>
        </form>
        <?php
//tikrinimas
if (isset($_POST['button'])) {
    if(isset($_POST['images']) && (array_sum($_POST['images']) + $secret) == $_POST['control']) {
        echo '<h1 style="color:green;">You are human.</h1>';
    }
    else {
        echo '<h1 style="color:red;">You are a robot.</h1>';
        echo '<iframe width="56" height="31" src="https://www.youtube.com/embed/sWMDV-cveUA?start=28&autoplay=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
    }
}
?>      

</body>
</html>