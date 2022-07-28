<?php 


use \Psr\Http\Message\ServerRequestInterface as Request;
use \Slim\Http\Response as Response;
require 'db.php';
require '../vendor/autoload.php';

$app = new \Slim\App;
session_start();

//ACCOMODATION_MANAGER
//GET: Read approve/reject list
$app->get('/students_apprej_list', function (Request $request, Response $response) {
    

    $sql = "SELECT * FROM student WHERE approvalstatus = '0' AND NOT college = '';" ;

    try {
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $bid = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($bid);
    } catch (PDOException $e) {
        $data = array(
            "status" => "fail"
        );
        echo json_encode($data);
    }

});

//GET: Read approve/reject list (single ID)
$app->get('/students_apprej_list/{id}', function (Request $request, Response $response, array $args) {
    $id=$args['id'];

    $sql = "SELECT * FROM student  WHERE id= $id";

    try {
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $bid = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($bid);
    } catch (PDOException $e) {
        $data = array(
            "status" => "fail"
        );
        echo json_encode($data);
    }

});

//GET: Read college list 
$app->get('/college_list', function (Request $request, Response $response, array $args) {
    $sql = "SELECT * FROM college";

    try {
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $user = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($user);
    } catch (PDOException $e) {
        $data = array(
            "status" => "fail"
        );
        echo json_encode($data);
    }
    return $response;
});

//GET: Read college list {id}
$app->get('/college_list/{id}', function (Request $request, Response $response, array $args) {
    $id=$args['id'];
    $sql = "SELECT * FROM college WHERE id = $id" ;

    try {
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $user = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($user);
    } catch (PDOException $e) {
        $data = array(
            "status" => "fail"
        );
        echo json_encode($data);
    }
    return $response;
});

//PUT: Update APPROVE
$app->put('/updateapprove/{_name}/{_id}/{_college}/{_approvalstatus}', function (Request $request, Response $response, array $args) {
    
    $name = $request->getAttribute('_name');
    $id = $request->getAttribute('_id');
    $college = $request->getAttribute('_college');
    $approvalstatus = $request->getAttribute('_approvalstatus');

   
    
    $ic = $_SESSION["USERNAME"] ;
    $smatric = $_SESSION["MATRIC"] ;
    


    try {
        //get db object
        $db = new db();
        //conncect
        $pdo = $db->connect();


        $sql = "UPDATE student SET id =?, name=?, ic =?, college =?, matric =?, approvalstatus =? WHERE id=?";
       


        $pdo->prepare($sql)->execute([$id, $name, $ic, $college, $smatric, $approvalstatus, $id]);
       

        echo '{"notice": {"text": "Approval status '. $name .' has been just updated now"}}';
        $pdo = null;
    } catch (\PDOException $e) {
        echo '{"error": {"text": ' . $e->getMessage() . '}}';
    }

});

//GET: Read all student detail 
$app->get('/students_detail_list', function (Request $request, Response $response) {
    
    $sql = "SELECT * FROM student";

    try {
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $bid = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($bid);
    } catch (PDOException $e) {
        $data = array(
            "status" => "fail"
        );
        echo json_encode($data);
    }

});


//GET: Read student detail (single Matric No.)
$app->get('/student_detail_list/{matric}', function (Request $request, Response $response, array $args) {
    // $id=$args['matric'];
    $matric = $_POST['matric'];

    $sql = "SELECT * FROM student WHERE matric = '$matric'";

    try {
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $bid = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($bid);
    } catch (PDOException $e) {
        $data = array(
            "status" => "fail"
        );
        echo json_encode($data);
    }

});

//GET: Read Accomodation Manager Data
$app->get('/accom', function (Request $request, Response $response, array $args) {
    $id=$_SESSION['MATRIC'];
    

    $sql = "SELECT * FROM AccomodationManager WHERE staffID = '$id'";

    try {
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $bid = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($bid);
    } catch (PDOException $e) {
        $data = array(
            "status" => "fail"
        );
        echo json_encode($data);
    }

});

// //PUT: Update specific accomodation manager
// $app->put('/updatemanager', function (Request $request, Response $response,array $args) {
//     $staffid=$_SESSION['STAFFID'];
    
//     $input = $request->getParsedBody();
//     $sql = "UPDATE accomodationmanager SET name = :name, ic= :ic, staffID = :staffID, WHERE staffID = '$staffid'";

//     try {
//         //get the db object
//         $db = new db();
//         //connect
//         $db = $db->connect();
//         $stmt = $db->prepare($sql);
//         $stmt->bindParam(':name', $input['name']);
//         $stmt->bindParam(':ic', $input['ic']);
//         $stmt->bindParam(':staffID', $input['staffID']);
//         $stmt->execute();
//         $count = $stmt->rowCount();
//         $db = null;

//         $_SESSION["STAFFID"] = $input['staffID'];
//         if($count == 0){
//             return $response->withJson(array('status' => 'Unsuccessful', 'message' => 'Failed to update'), 400);
//         }
//         $data = array(
//             'status' => 'success',
//             'message' => 'successfully update',
//         );
//         return $response->withJson($data, 200);


//     } catch (PDOException $e) {
//         $error = array(
//             'status' => 'Error',
//             'message' => $e->getMessage(),
//         );
//         return $response->withJson($error, 400);
//     }


// });

//GET
$app->put('/updatequota/{name}/{studentID}/{approvalstatus}/{id}/{collegename}/{quota}/{available}', function (Request $request, Response $reponse, array $args) {
    
    $id = $request->getAttribute('id');
    $collegename = $request->getAttribute('collegename');
    $quota = $request->getAttribute('quota');
    $available = $request->getAttribute('available');

    $studentID = $request->getAttribute('studentID');
    $name = $request->getAttribute('name');
    $ic = $_SESSION["USERNAME"] ;
    $smatric = $_SESSION["MATRIC"] ;
    $approvalstatus =  $request->getAttribute('approvalstatus');


    try {
        //get db object
        $db = new db();
        //conncect
        $pdo = $db->connect();


        $sql = "UPDATE college SET collegename =?, quota=?, available =? WHERE id=?";
        $sql2 = "UPDATE student SET college=?, id =?, name=?, ic =?, matric =?, approvalstatus=? WHERE id=?";


        $pdo->prepare($sql)->execute([$collegename, $quota, $available, $id]);
        $pdo->prepare($sql2)->execute([$collegename, $studentID, $name, $ic, $smatric, $approvalstatus, $studentID]);

        echo '{"notice": {"text": "College '. $collegename .' has been just updated now"}}';
        $pdo = null;
    } catch (\PDOException $e) {
        echo '{"error": {"text": ' . $e->getMessage() . '}}';
    }
});


$app->put('/updatemanager/{id}/{staffID}/{name}/{ic}', function (Request $request, Response $reponse, array $args) {
    $id = $request->getAttribute('id');
    $staffid = $request->getAttribute('staffID');
    $name = $request->getAttribute('name');
    $ic = $request->getAttribute('ic');


    try {
        //get db object
        $db = new db();
        //conncect
        $pdo = $db->connect();


        $sql = "UPDATE accomodationmanager SET name =?, ic=?, staffID =? WHERE id=?";


        $pdo->prepare($sql)->execute([$name, $ic,$staffid, $id]);

        echo '{"notice": {"text": "User '. $name .' has been just updated now"}}';
        $pdo = null;
    } catch (\PDOException $e) {
        echo '{"error": {"text": ' . $e->getMessage() . '}}';
    }
});
//delete user
$app->delete('/user/{id}', function (Request $request, Response $response, array $args) {
    $id=$args['id'];
    try{
        $sql = "DELETE FROM user WHERE id = $id";

    // Get DB Object
    $db = new db();
    //Connect
    $db = $db->connect();
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $count = $stmt->rowCount();

    $db = null;
    $data = array(
        "rowAffected" => $count,
        "status" => "success"
    );

    echo json_encode($data);
} catch (PDOException $e) {
    $data = array(
        "status"=>"fail"
    );
    echo json_encode($data);
}
    // $response->getBody()->write("This is delete user with id... :$id");
    // return $response;


});

//post insert data
$app->post('/user', function (Request $request, Response $response, array $args) {

    // $response->getBody()->write("this is post user");

    // return $response;

    $name = $_POST["name"];
    $id = $_POST["id"];
    $email = $_POST["email"];
    $age = $_POST["age"];

    try {
        $sql = "INSERT INTO user (name,id,email,age) VALUES (:name,:id,:email,:age)";
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':age', $age);

        $stmt->execute();
        $count = $stmt->rowCount();
        $db = null;

        $data = array(
            "status" => "success",
            "rowcount" =>$count
        );
        echo json_encode($data);
    } catch (PDOException $e) {
        $data = array(
            "status" => "fail"
        );
        echo json_encode($data);
    }
});

$app->get('/user/{id}', function ($request,$response,$args) {
    
    $id = $args['id'];
    $sql = "SELECT * FROM user WHERE id = $id";

    try {
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $user = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($user);
    } catch (PDOException $e) {
        $data = array(
            "status" => "fail"
        );
        echo json_encode($data);
    }
});

//login
$app->post('/login', function (Request $request, Response $response, array $args) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    try {
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
    
        $stmt = $db->query($sql);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $db = null;
        

            if($stmt->rowCount() > 0){
                $_SESSION["Login"] = "YES";
                $_SESSION["USERNAME"] = $user['username'];
                $_SESSION["PASSWORD"] =$user['password'];
                $_SESSION["LEVEL"] =$user['level'];
                $_SESSION["MATRIC"] = $user['matric'];
                echo ($_SESSION["LEVEL"]);
            } 

    } catch (PDOException $e) {
        $data = array(
            "status" => "fail"
        );
        echo json_encode($data);  
    }
});

//view for student
$app->get('/studentinfo', function ($request,$response,$args) {

    $matric = $_SESSION["MATRIC"] ;
    $sql = "SELECT * FROM student WHERE matric = '$matric'";

    try {
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $user = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($user);
    } catch (PDOException $e) {
        $data = array(
            "status" => "fail"
        );
        echo json_encode($data);
    }
});

$app->put('/updatestudentinfo/{id}/{name}/{ic}/{matric}', function (Request $request, Response $response, array $args) {
    $id = $request->getAttribute('id');
    $name = $request->getAttribute('name');
    $ic = $request->getAttribute('ic');
    $matric = $request->getAttribute('matric');
    // $username = $_SESSION["USERNAME"] ;
    $password = $_SESSION["PASSWORD"] ;
    $level = $_SESSION["LEVEL"] ;
    $smatric = $_SESSION["MATRIC"] ;

        try {
        //get db object
        $db = new db();
        //conncect
        $pdo = $db->connect();


        $sql = "UPDATE student SET name =?, ic=?, matric =? WHERE id=?";
        $sql2 = "UPDATE user SET username=?, password=?, level =?, matric =? WHERE matric=?";


        $pdo->prepare($sql)->execute([$name, $ic,$matric, $id]);
        $pdo->prepare($sql2)->execute([$ic, $password, $level, $matric, $smatric]);

        echo '{"notice": {"text": "User '. $name .' has been just updated now"}}';
        $pdo = null;
    } catch (\PDOException $e) {
        echo '{"error": {"text": ' . $e->getMessage() . '}}';
    }
});

$app->get('/user', function (Request $request, Response $response, array $args) {

    $sql = "SELECT * FROM user";

    try {
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $user = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($user);
    } catch (PDOException $e) {
        $data = array(
            "status" => "fail"
        );
        echo json_encode($data);
    }



});

$app->get('/home', function (Request $request, Response $response, array $args) {
    $response->getBody()->write("This is the home folder");

    return $response;
});

$app->get('/', function (Request $request, Response $response, array $args) {
    $response->getBody()->write("This is the root directory");

    return $response;
});


$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");

    return $response;
});
$app->run();

?>