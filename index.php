<?php
include 'class/action.php';
$obj = new DbOperation();
?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

        <title>Advance CRUD</title>
    </head>
    <style>
        body{
            background: rgba(236, 240, 241, 0.47);
        }
    </style>
    <body>
        <div class="container">
            <?php
            if(isset($_GET['inserted'])){ ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Inserted Successfully!!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php } ?>
            <?php
            if(isset($_GET['updated'])){ ?>
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                Updated Successfully!!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php } ?>
            <?php
            if(isset($_GET['deleted'])){ ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Deleted Successfully!!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php } ?>
            <div class="row pt-4">
                <div class="col-md-8 offset-md-2">
                    <div class="card text-center">
                        <div class="card-header bg-info text-light">
                            Enter Medicie Details
                        </div>
                        <div class="card-body">
                            <?php
                            if(isset($_GET['update'])){
                                $id =  base64_decode($_GET['id']);
                                $data= $obj->single_record("medicine",["id"=>$id]);
                            ?> 

                            <form action="class/action.php" method="post">
                                <table class="table table-bordered">
                                    <tr>
                                        <td><h6>Name : </h6></td>
                                        <td>
                                            <input type="text" class="form-control" name="mediname" value ="<?= $data['mediname']?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><h6>Quantity : </h6></td>
                                        <td>
                                            <input type="text" class="form-control" name="quantity" value ="<?= $data['quantity']?>">
                                            <input type="hidden" name="id" value ="<?= $data['id']?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <input type="submit" class="btn btn-success btn-block" value="Update" name="update">
                                        </td>
                                    </tr>
                                </table>
                            </form>

                            <?php  }else{ ?>
                            <form action="class/action.php" method="post">
                                <table class="table table-bordered">
                                    <tr>
                                        <td><h6>Name : </h6></td>
                                        <td>
                                            <input type="text" class="form-control" name="mediname" placeholder="Enter medicine name ">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><h6>Quantity : </h6></td>
                                        <td>
                                            <input type="text" class="form-control" name="quantity" placeholder="Enter quantity ">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <input type="submit" class="btn btn-success btn-block" value="Store" name="store">
                                        </td>
                                    </tr>
                                </table>
                            </form>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <table class="table table-bordered text-center mt-2">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Quantity</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $rows = $obj->fetch_data("medicine",'id','DESC');
                            $i =0;
                            foreach($rows as $row){
                            ?>
                            <tr>
                                <th scope="row"><?= ++$i?></th>
                                <td><?= $row['mediname']?></td>
                                <td><?= $row['quantity']?></td>
                                <td><a href="index.php?update&id=<?= base64_encode($row['id'])?>" class="btn btn-info btn-sm"> Update</a></td>
                                <td><a href="class/action.php?delete&id=<?= base64_encode($row['id'])?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure ?')" > Delete</a></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    </body>
</html>