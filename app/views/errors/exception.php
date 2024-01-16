<div style='background-color: rgb(255, 175, 175); padding: 10px'>
    <h1 style="text-align: center;">Something went wrong!</h1>
    <hr>
    <h2>Info:</h2>
    <p>
        <?php

        if(!empty($msg)){
            echo $msg;
        }else{
            echo 'There is no infomation provided about the error';
        }

        ?>
    </p>
</div>