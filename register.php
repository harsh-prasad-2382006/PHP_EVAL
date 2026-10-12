
<?php 
$message = '';
include 'db.php';
if($_SERVER['REQUEST_METHOD']==='POST'){
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $confirm_password = $_POST['confirm_password'];

    if(empty($full_name)|| empty($email)|| empty($pass)){
        $message="Fields can not be empty";
    }else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $message="Email format does not match";
    }else if($pass!=$confirm_password){
        $message="Passwords do not match";
    }else{
        $sql = $conn->prepare("select id from users where email=?");
        $sql->bind_param('s',$email);
        $sql->execute();
        $result= $sql->get_result();
        if($result->num_rows>0){
            $message="User already exists";
            
        }else{
            $password = password_hash($pass,PASSWORD_BCRYPT);
            $sql=$conn->prepare('insert into users (fullname,email,password) values(?,?,?)');
            $sql->bind_param('sss',$full_name,$email,$password);
            if($sql->execute()){
                header('Location:login.php');
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
                <h3 class="text-center mt-3 ">Register  here!</h3>
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
                    />
                    <label for="formId1">Full Name</label>
                </div>
                <div class="form-floating mb-3">
                    <input
                        type="text"
                        class="form-control"
                        name="email"
                        id="formId1"
                        placeholder=""
                    />
                    <label for="formId1"> Email</label>
                </div>
                <div class="form-floating mb-3">
                    <input
                        type="password"
                        class="form-control"
                        name="pass"
                        id="formId1"
                        placeholder=""
                    />
                    <label for="formId1">Password</label>
                </div>
                <div class="form-floating mb-3">
                    <input
                        type=""
                        class="form-control"
                        name="confirm_password"
                        id="formId1"
                        placeholder=""
                    />
                    <label for="formId1">Confirm Password</label>
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



