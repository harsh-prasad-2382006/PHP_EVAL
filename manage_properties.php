<?php 
include 'db.php';
if(isset($_GET['user_id'])){
    header('Location:login.php');
}


$property =  $conn->prepare("select properties.*,users.fullname from properties join users on properties.user_id=users.id");
$property->execute();
$result=$property->get_result();
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css" integrity="sha512-QeR2VH+lsBE5LSAe1Q5EnTBbe7XTBubt8dG93Y7gidSgdMCr8nVqKcfKAMyN96SV8KDbZVTDXChatu5G2KQGzg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    </head>

    <body>
        <header>
            <nav
                class="navbar navbar-expand-sm navbar-light bg-light"
            >
                <div class="container">
                    <a class="navbar-brand" href="dashboard.php">Real Estate</a>
                    <!-- <h6 >Welcome, <?php echo $_SESSION['full_name']; ?></h6> -->
                    <button
                        class="navbar-toggler d-lg-none"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapsibleNavId"
                        aria-controls="collapsibleNavId"
                        aria-expanded="false"
                        aria-label="Toggle navigation"
                    >
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="collapsibleNavId">
                        <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="dashboard.php" aria-current="page"
                                    >Home
                                    <span class="visually-hidden">(current)</span></a
                                >
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="add_property.php">Add Property</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="manage_properties.php">Manage Properties</a>
                            </li>
                            
                        </ul>
                        
                        <form class="d-flex my-2 my-lg-0 gap-2" >
                        
                        <a
                            name=""
                            id=""
                            class="btn btn-outline-primary"
                            href="user_management.php"
                            role="button"
                            ><i class="fa-regular fa-user"></i></a
                        >
                        
                        <a
                            name=""
                            id=""
                            class="btn btn-outline-warning"
                            href="logout.php"
                            role="button"
                            >Logout</a
                        >
                        
                            
                        </form>
                    </div>
                </div>
            </nav>
            
        </header>
        <main>

        <div
            class="container"
        >
           <div
            class="table-responsive"
           >
            <table
                class="table table-primary"
            >
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <!-- <th scope="col">user</th> -->
                        <th scope="col">Property name</th>
                        <th scope="col">location</th>
                        <th scope="col">price</th>
                        <th scope="col">property type</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php while($row= $result->fetch_assoc()){?>
                    <tr class="">
                        <td scope="row"><?= $row['id'];?> </td>
                        <td><?= $row['property_name'];?></td>
                        <td><?= $row['location'];?></td>
                        <td><?= $row['price'];?></td>
                        <td><?= $row['property_type'];?></td>
                    
                    </tr>
                    <?php }?>
                </tbody>
            </table>
           </div>
           
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


