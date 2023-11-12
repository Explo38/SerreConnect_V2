<?php

declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello world!');
        return $response;
    });

    $app->group('/users', function (Group $group) {
        $group->get('', ListUsersAction::class);
        $group->get('/{id}', ViewUserAction::class);
    });

    $app->get('/GetAllUsers', function (Request $request, Response $response) {
        $db = $this->get(PDO::class);
        $sth = $db->prepare("SELECT * FROM `Users`");
        $sth->execute();
        $data = $sth->fetchAll(PDO::FETCH_ASSOC);
        $payload = json_encode($data);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->post('/AddUsers', function (Request $request, Response $response) {
        $data = $request->getParsedBody();
        $db = $this->get(PDO::class);
        $sth = $db->prepare("INSERT INTO `Users` (username, email, phone, password) VALUES (:username, :email, :phone, :password)");
        $sth->bindParam(":username", $data['username']);
        $sth->bindParam(":password", $data['password']);
        $sth->bindParam(":email", $data['email']);
        $sth->bindParam(":phone", $data['phone']);
        $sth->execute();
        $responseData = ["message" => "User entry created successfully"];
        $response->getBody()->write(json_encode($responseData));
        return $response
            ->withStatus(201)
            ->withHeader('Content-Type', 'application/json');
    });

    $app->put('/ModifyUsers/{id}', function (Request $request, Response $response, $args) {
        $id = $args['id'];
        $data = $request->getParsedBody();
        $db = $this->get(PDO::class);
        $sth = $db->prepare("UPDATE Users SET username = :username, email = :email, phone = :phone, password = :password WHERE user_id = :id");
        $sth->bindParam(":id", $id, PDO::PARAM_INT);
        $sth->bindParam(":username", $data['username'], PDO::PARAM_STR);
        $sth->bindParam(":email", $data['email'], PDO::PARAM_STR);
        $sth->bindParam(":phone", $data['phone'], PDO::PARAM_STR);
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
        $sth->bindParam(":password", $hashedPassword, PDO::PARAM_STR);
        $sth->execute();
        $responseData = ["message" => "User entry updated successfully"];
        return $response->withJson($responseData, 200);
    });

    $app->delete('/DellUsers/{id}', function (Request $request, Response $response, $args) {
        $id = $args['id'];
        $db = $this->get(PDO::class);
        $sth = $db->prepare("DELETE FROM Users WHERE user_id = :id");
        $sth->bindParam(":id", $id, PDO::PARAM_INT);
        $sth->execute();
        $responseData = ["message" => "User entry deleted successfully"];
        return $response->withJson($responseData, 200);
    });

    $app->get('/GetAllGreenhouse', function (Request $request, Response $response) {
        $db = $this->get(PDO::class);
        $sth = $db->prepare("SELECT * FROM `Greenhouse`");
        $sth->execute();
        $data = $sth->fetchAll(PDO::FETCH_ASSOC);
        $payload = json_encode($data);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->get('/GetAllSensor', function (Request $request, Response $response) {
        $db = $this->get(PDO::class);
        $sth = $db->prepare("SELECT * FROM `Sensor`");
        $sth->execute();
        $data = $sth->fetchAll(PDO::FETCH_ASSOC);
        $payload = json_encode($data);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->get('/GetAllActuator', function (Request $request, Response $response) {
        $db = $this->get(PDO::class);
        $sth = $db->prepare("SELECT * FROM `Actuator`");
        $sth->execute();
        $data = $sth->fetchAll(PDO::FETCH_ASSOC);
        $payload = json_encode($data);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->put('/ModifyActuatorState/{id}', function (Request $request, Response $response, $args) {
        $id = $args['id'];
        $data = $request->getParsedBody();
        $db = $this->get(PDO::class);
        $sth = $db->prepare("UPDATE Actuator SET state = :state WHERE actuator_id = :id");
        $sth->bindParam(":id", $id);
        $sth->bindParam(":state", $data['state']);
        $sth->execute();
        $responseData = ["message" => "Actuator state updated successfully"];
        return $response->withJson($responseData, 200);
    });

    $app->post('/AddSensorDataHistory', function (Request $request, Response $response) {
        $data = $request->getParsedBody();
        $db = $this->get(PDO::class);
        $sth = $db->prepare("INSERT INTO `SensorDataHistory` (value, date, sensor_id) VALUES (:value, :date, :sensor_id)");
        $sth->bindParam(":value", $data['value']);
        $sth->bindParam(":date", $data['date']);
        $sth->bindParam(":sensor_id", $data['sensor_id']);
        $sth->execute();
        $responseData = ["message" => "Sensor entry created successfully"];
        $response->getBody()->write(json_encode($responseData));
        return $response
            ->withStatus(201)
            ->withHeader('Content-Type', 'application/json');
    });

    $app->get('/GetSensorDataHistory/{sensor_id}', function (Request $request, Response $response, $args) {
        $sensor_id = $args['sensor_id'];
        $db = $this->get(PDO::class);
        $sth = $db->prepare("SELECT * FROM `SensorDataHistory` WHERE sensor_id = :sensor_id");
        $sth->bindParam(":sensor_id", $sensor_id, PDO::PARAM_INT);
        $sth->execute();
        $data = $sth->fetchAll(PDO::FETCH_ASSOC);
        $payload = json_encode($data);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->get('/GetActuatorDataHistory/{actuator_id}', function (Request $request, Response $response, $args) {
        $actuator_id = $args['actuator_id'];
        $db = $this->get(PDO::class);
        $sth = $db->prepare("SELECT * FROM `ActuatorDataHistory` WHERE actuator_id = :actuator_id");
        $sth->bindParam(":actuator_id", $actuator_id, PDO::PARAM_INT);
        $sth->execute();
        $data = $sth->fetchAll(PDO::FETCH_ASSOC);
        $payload = json_encode($data);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->get('/user/by-email', function (Request $request, Response $response) {
        try {
            $email = $request->getHeaderLine('Email');
            error_log("Email: $email");

            // Get the PDO instance
            $db = $this->get(PDO::class);

            // Prepare and execute the SQL statement
            $sql = "SELECT username FROM `Users` WHERE email = :email";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_OBJ);
            if (!$user) {
                $error = array("error" => "No user found with this email");
                $response->getBody()->write(json_encode($error));
                return $response
                    ->withHeader('content-type', 'application/json')
                    ->withHeader('Email', $email)
                    ->withStatus(404);
            }
            error_log(print_r($user, true));
            $response->getBody()->write(json_encode($user));
            return $response
                ->withHeader('content-type', 'application/json')
                ->withHeader('Email', $email)
                ->withStatus(200);
        } catch (Exception $e) {
            error_log($e->getMessage());
            $error = array("message" => $e->getMessage());
            $response->getBody()->write(json_encode($error));
            return $response
                ->withHeader('content-type', 'application/json')
                ->withHeader('Email', $email)
                ->withStatus(500);
        }
    });
};
