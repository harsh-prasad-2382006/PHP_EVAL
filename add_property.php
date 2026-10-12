<?php 

if(isset($_GET['user_id'])){
    header('Location:login.php');
}
$message='';
include 'db.php';
if($_SERVER['REQUEST_METHOD']==='POST'){
    $user_id = $_SESSION['user_id'];
    $property_name = $_POST['property_name'];
    $location = $_POST['location'];
    $price = $_POST['price'];
    $property_type = $_POST['property_type'];
    $image = $_FILES['image_prop']['name'];

    move_uploaded_file($_FILES['image_prop']['tmp_name'],"uploads/$image");

    if(empty($property_name)|| empty($location)|| empty($price)|| empty($property_name)|| empty($image)){
        $message="Fields can not be empty";
    }else{
            $sql=$conn->prepare('insert into properties (user_id,property_name,location,price,property_type,image) values(?,?,?,?,?,?)');
            $sql->bind_param('issdss',$user_id,$property_name,$location,$price,$property_type,$image);
            if($sql->execute()){
                header('Location:dashboard.php');
            }else{
                $message="Failed to add property...";
            }
        
    }
}

?>

<!doctype html>
<html lang="en" data-bs-theme="light">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- Bootstrap CSS v5.3.8 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
            crossorigin="anonymous"
        />
    </head>

    <body>
        <header>
            <!-- place navbar here -->
        </header>
        <main>
            <div
                class="container col-5 border shadow mt-5 p-4"
            >
                <h3 class="text-center mt-3 ">Add Property </h3>
                 <?php if ($message != '') { ?>
    <div class="alert alert-danger"><?= htmlspecialchars($message) ?></div>
                        <?php } ?>

                        <form action="" method="post" enctype="multipart/form-data">
                <div class="form-floating mb-3">
                    <input
                        type="text"
                        class="form-control"
                        name="property_name"
                        id="formId1"
                        placeholder=""
                    />
                    <label for="formId1">Property Name</label>
                </div>
                <div class="form-floating mb-3">
                    <input
                        type="text"
                        class="form-control"
                        name="location"
                        id="formId1"
                        placeholder=""
                    />
                    <label for="formId1">Location</label>
                </div>
                <div class="form-floating mb-3">
                    <input
                        type="text"
                        class="form-control"
                        name="price"
                        id="formId1"
                        placeholder=""
                    />
                    <label for="formId1">Price</label>
                </div>
                <div class="form-floating mb-3">
                    <input
                        type="text"
                        class="form-control"
                        name="property_type"
                        id="formId1"
                        placeholder=""
                    />
                    <label for="formId1"> Property Type</label>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Add Image</label>
                    <input
                        type="file"
                        class="form-control"
                        name="image_prop"
                        id=""
                        placeholder=""
                        aria-describedby="fileHelpId"
                    />
                    
                </div>
                
                <button
                    type="submit"
                    class="btn btn-primary w-100"
                >
                    Add Property
                </button>
            </form>
                
            </div>
            
        </main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Bundle (includes Popper) -->
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
            crossorigin="anonymous"
        ></script>
    </body>
</html>



