<?php
    session_start();
    ob_start();  

    require_once "../../bd/conexion.php";  
    require_once "../response/httpResponseCode.php";
    require_once "../../clases/notificacionesClases/envioNotificacionesClase.php";

    $conexion = new Conexion();    
    $httpResponseCode = new httpResponseCode();
    $sendNotification = new ApiRestSendNotification();


    if($conexion->conexion_bd() == null)
    {
        //Error en los datos para la conexion con la base de datos        
        http_response_code(500);
        $mensaje = "la API No se pudo conectar con la base de datos";
        echo json_encode($httpResponseCode->internalServerError($mensaje));

    }elseif(isset($_SERVER['REQUEST_METHOD']))
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            try {
                //Para obtener los datos que se envien por el POST
                $datosJson = file_get_contents("php://input");

                //Llamado de la funcion para insertar y validaciones
                $respuestaApi = $sendNotification->sendNotification($datosJson);

                switch ($respuestaApi) 
                {
                    case "ok":
                        http_response_code(200);
                        $mensaje = "Se enviaron las notificaciones correctamente";
                        echo json_encode($httpResponseCode->ok($mensaje));
                        break;
                    case "bd":
                        http_response_code(404);
                        $mensaje = "No se encontraron usuarios a quien enviar la notificacion";
                        echo json_encode($httpResponseCode->notFound($mensaje));
                        break;
                    case "val":
                        http_response_code(400);
                        $mensaje = "Revise los valores de la variables";
                        echo json_encode($httpResponseCode->badRequest($mensaje));
                        break;
                    case "var":
                        http_response_code(400);
                        $mensaje = "Error con las variables enviadas a la API REST";
                        echo json_encode($httpResponseCode->badRequest($mensaje));
                        break; 
                    case "error":
                        http_response_code(500);
                        $mensaje = "Ocurrio algún problema al insertar las transacciones en la base de datos, no se enviarons las notificaciones, intentelo nuevamente";
                        echo json_encode($httpResponseCode->internalServerError($mensaje));
                        break;                    
                    default:
                        //Algun error del servidor
                        http_response_code(500);
                        echo json_encode($httpResponseCode->internalServerError($respuestaApi));
                        break;
                }
            } catch(Exception $e) {
                http_response_code(500);
                $mensaje = "Error del servidor: ".$e->getMessage;
                echo json_encode($httpResponseCode->internalServerError($mensaje));
            }                    
        }else
        {
            //No se consulto bien la API
            http_response_code(400);
            $mensaje = "Solo se puede consultar por el metodo POST";
            echo json_encode($httpResponseCode->badRequest($mensaje));
        }
    }else
    {
        http_response_code(400);
        $mensaje = "Utilice el metodo POST";
        echo json_encode($httpResponseCode->badRequest($mensaje));
    }

    
    ob_end_flush();