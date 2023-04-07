<?php

//this section here deals with the upload of the users image into the petimages folder

$petImagesPath ='..\Images\PetImages\\';

//the first two if statements make sure there are no errors when the image was uploaded 
if (isset($_FILES['jobImage'])) {
    if($_FILES['jobImage']['error'] === 0){
   

    $imageName = explode('.',$_FILES['jobImage']['name']);
    $imageExt = end($imageName);
    $newId =uniqid().'.'.$imageExt;
    $newImageAddress = $petImagesPath.$newId; 

    move_uploaded_file($_FILES['jobImage']['tmp_name'],$newImageAddress);

    }
} else {
    $image = 'image was not pulled'; // or some default value
}


$data =  json_decode( file_get_contents('.\..\Data\jobs.json', true));
$count = count($data);
$data[] = [
    "id" => $count,
    "title" => $_POST["jobTitle"],
    "description" => $_POST["jobDiscription"],
    "pet_type"=> $_POST["petType"],
    "city" => $_POST["city"],
    "neighbourhood" => $_POST["neighbourhood"],
    "date" => $_POST["date"],
    "budget"=> $_POST['deposit'],
    "image"=>$newId,
];


file_put_contents('.\..\Data\jobs.json', json_encode($data))
?>




<html> 
    <body>
        <?php echo $data["id"]?>
        <img src="<?php echo $newImageAddress ?>" alt="pet image">
    </body>
</html>