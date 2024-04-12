<?php  

if ($_SERVER['REQUEST_METHOD'] == 'POST'):

    $errors = array();
    $uploaded_images = $_FILES['my_work'];

    $allowed_extensions = array('jpg', 'png', 'gif', 'jpeg'); 

    // Check if files were uploaded
    if ($uploaded_images['error'][0] == 4):
        echo "<h1>Files not uploaded.</h1>";
    else:
        $count_images = count($uploaded_images['name']);

        for ($i = 0; $i < $count_images; $i++) {
            $errors = array();

            $image_extension[$i]= strtolower(pathinfo($uploaded_images['name'][$i], PATHINFO_EXTENSION));


            $image_random[$i] = rand(1,1000000000000000) . '.' . $image_extension[$i];


            // Check the size
            if ($uploaded_images['size'][$i] > 90000):
                $errors[] = "<h1>The file size is larger than the allowed required.</h1>";
            endif;

            // Check if the file extension is valid
            if (!in_array($image_extension[$i], $allowed_extensions)):
                $errors[] = "<h1>The file format is not supported.</h1>";
            endif;

            // Check if there are no errors 
            if (empty($errors)):
                move_uploaded_file($uploaded_images['tmp_name'][$i], 'up/' . $uploaded_images['name'][$i]);
                // move_uploaded_file($image_temp [$i], $_SERVER['DOCUMENT_ROOT'] . '\Upload_Img\up\\' . $image_name[$i]);

                echo '<h1 style="background-color:#EEE;padding: 10px;margin-bottom: 20px">';
                echo '<h1>File Number: ' . ($i + 1) . ' </h1> uploaded successfully.' ;
                echo '<h1>File Name: ' . $uploaded_images['name'][$i] . '</h1>' ;
                echo '<h1>New Name: ' . $image_random[$i] . '</h1>' ;
                echo "</h1>";
            else:
                echo '<h1 style="background-color:#EEE;padding: 10px;margin-bottom: 20px">';
                echo 'Errors for File Number: '. ($i + 1); 
                echo '<h1>File Name: ' . $uploaded_images['name'][$i] . '</h1>' ;

                foreach ($errors as $error):
                    echo $error;
                endforeach;
                echo "</h1>";
            endif;
        }
    endif;
endif;
?>

<form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="my_work[]" multiple="multiple"><br><br>
    <input type="submit" name="" value="Upload">
</form>



<!-- <?php  

if($_SERVER['REQUEST_METHOD'] == 'POST'):


    $errors =array();

    $uploaded_image = $_FILES['my_work'];



    $image_name =  $uploaded_image['name'];
    $image_type =  $uploaded_image['type'];
    $image_temp =  $uploaded_image['tmp_name'];
    $image_size =  $uploaded_image['size'];
    $image_error=  $uploaded_image['error']; // Add this line to capture the error code


    

    // echo 'Image_name :' . $image_name.'<br>';
    // echo 'Image_type :' . $image_type.'<br>';
    // echo 'Image_temp :' . $image_temp.'<br>';
    // echo 'Image_size :' . $image_size.'<br>';

    $count_image = count($image_name);

    for($i = 0; $i < $count_image; $i++){

    $errors =array();
        
    
        
        // check the size
    if($image_size[$i] > 90000):
            $errors[] = "<div> The file size more bigger than X</div>";

            endif;

        

            // check if there are no errors 
        if(empty($errors)):
            move_uploaded_file($image_temp[$i],'up/'.$image_name[$i]);
            // move_uploaded_file($image_temp , $_SERVER['DOCUMENT_ROOT'] . '\Upload_Img\up\\' . $image_name);
            echo '<div style="background-color:sliver;padding: 10px;margin-bottom: 20px">';
            echo 'file Number' . ($i + 1) . 'uploaded' ;
            echo "</div>";

        else:

            echo '<div style="background-color:sliver;padding: 10px;margin-bottom: 20px">';
            echo 'Errors  for file Number'. ($i + 1); 
            foreach ($errors as $error ):
                echo $error;
        endforeach;
        echo "</div>";

    endif;
            
        // echo $count_image;die;
    }
    endif;


?>
