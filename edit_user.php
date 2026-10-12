<?php 
$message='';
include 'db.php';
if(!isset($_SESSION['user_id'])){
    header('Location:login.php');
}
$id = $_GET['id'];
$sql= $conn->prepare("select * from users where id=?");
$sql->bind_param('i',$id);
$sql->execute();
$result=$sql->get_result();
$user =  $result->fetch_assoc();
if($_SERVER['REQUEST_METHOD']==='POST'){
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
   

    if(empty($full_name)|| empty($email)){
        $message="Fields can not be empty";
    }else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $message="Email format does not match";
    }{
        {
          
            $sql=$conn->prepare('update users set fullname=?,email=? where id=?');
            $sql->bind_param('ssi',$full_name,$email,$id);
            if($sql->execute()){
                header('Location:user_management.php');
            }else{
                $message="Registration Failed...";
            } 
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
                <h3 class="text-center mt-3 ">Update!</h3>
                 <?php if ($message != '') { ?>
    <div class="alert alert-danger"><?= htmlspecialchars($message) ?></div>
                        <?php } ?>

                        <form action="" method="post">
                
                <div class="form-floating mb-3">
                    <input
                        type="text"
                        class="form-control"
                        name="full_name"
                        id="formId1"
                        placeholder=""
                        value="<?= $user['fullname'];?>"
                    />
                    <label for="formId1"> Name</label>
                </div>
                
                <div class="form-floating mb-3">
                    <input
                        type="text"
                        class="form-control"
                        name="email"
                        id="formId1"
                        placeholder=""
                        value="<?= $user['email'];?>"
                    />
                    <label for="formId1"> Email</label>
                </div>
                
               
                
                
                <button
                    type="submit"
                    class="btn btn-primary w-100"
                >
                    Submit
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
