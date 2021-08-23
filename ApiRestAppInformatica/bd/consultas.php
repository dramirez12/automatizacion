<?php

ob_start();

require_once "conexion.php";

class Consultas
{

    //Consulta para obtener las notificaciones por token
    public function obtenerNotificacionesToken($token)
    {
        $conexion = new Conexion();
        $bd = $conexion->conexion_bd();
        
        $query = "CALL sp_get_notificacion_token('$token');";
        
        $respuesta = mysqli_query($bd, $query);

        mysqli_close($bd);
        return $respuesta;
    }

    //Consulta para obtener las noticias
    public function obtenerNoticias($token)
    {
        $conexion = new Conexion();
        $bd = $conexion->conexion_bd();
        
        $query = "CALL sp_get_noticias('$token');";
        
        $respuesta = mysqli_query($bd, $query);

        mysqli_close($bd);
        return $respuesta;
    }

    //Consulta para insertar en la bitacora
    public function insertarBitacora($accion, $descripcion, $token, $idObjeto)
    {
        $conexion = new Conexion();
        $bd = $conexion->conexion_bd();
        
        $query = "CALL sp_insert_bitacora('$accion', '$descripcion', '$token', $idObjeto);";
        
        $respuesta = mysqli_query($bd, $query);

        if(mysqli_errno($bd) == 0)
        {
            return $respuesta;

        }else
        {
            return false;
        }

        mysqli_close($bd);
    }

    //Funcion para insertar el token en la base de datos cuando se instala la app en el dispositivo
    public function insertarToken($token, $correo, $tipoPlataforma)
    {
        $conexion = new Conexion();
        $bd = $conexion->conexion_bd();
        
        $query = "CALL sp_insert_token('$token', '$correo', '$tipoPlataforma');";
        
        $respuesta = mysqli_query($bd, $query);

        if(mysqli_errno($bd) == 0)
        {
            return $respuesta;

        }else
        {
            return false;
        }

        mysqli_close($bd);        
    }

    //Para obtener los tokens a los que se enviara la notificacion
    public function obtenerTokensAndroid($segmento)
    {
        $conexion = new Conexion();
        $bd = $conexion->conexion_bd();
        
        $query = "CALL sp_get_tokens_android($segmento);";
        
        $respuesta = mysqli_query($bd, $query);
        
        mysqli_close($bd);
        return $respuesta;
    }

    //Actualizar si se leyo la notificacion
    public function actualizarNotLeida($transaccion)
    {
        $conexion = new Conexion();
        $bd = $conexion->conexion_bd();
        
        $query = "CALL sp_update_notif_leida('$transaccion');";
        
        $respuesta = mysqli_query($bd, $query);

        if(mysqli_errno($bd) == 0)
        {
            return $respuesta;

        }else
        {
            return false;
        }

        mysqli_close($bd);       
    }

    //Actualizar como leidas todas las notificaciones
    public function actualizarAllNotLeida($token)
    {
        $conexion = new Conexion();
        $bd = $conexion->conexion_bd();
        
        $query = "CALL sp_update_all_notif_leida('$token');";
        
        $respuesta = mysqli_query($bd, $query);

        if(mysqli_errno($bd) == 0)
        {
            return $respuesta;

        }else
        {
            return false;
        }

        mysqli_close($bd);       
    }

    //Actualizar cuando se elimine la notificacion
    public function NotificacionEliminada($transaccion)
    {
        $conexion = new Conexion();
        $bd = $conexion->conexion_bd();
        
        $query = "CALL sp_update_notif_eliminada('$transaccion');";
        
        $respuesta = mysqli_query($bd, $query);

        if(mysqli_errno($bd) == 0)
        {
            return $respuesta;

        }else
        {
            return false;
        }

        mysqli_close($bd);       
    }

    //Funcion para insertar cada transaccion en la base de datos cuando se envie una notificacion
    public function insertarTransaccionesAndroid($segmento, $idNotificacion)
    {
        $conexion = new Conexion();
        $bd = $conexion->conexion_bd();
        
        $query = "CALL sp_insert_transacciones_android($segmento, $idNotificacion);";
        
        $respuesta = mysqli_query($bd, $query);

        if(mysqli_errno($bd) == 0)
        {
            return $respuesta;

        }else
        {
            return false;
        }

        mysqli_close($bd);        
    }

    //Confirmar que la notificacion push fue recibida
    public function confirmarNotificacion($token, $idNotificacion)
    {
        $conexion = new Conexion();
        $bd = $conexion->conexion_bd();
        
        $query = "CALL sp_push_confirm('$token', $idNotificacion);";
        
        $respuesta = mysqli_query($bd, $query);

        if(mysqli_errno($bd) == 0)
        {
            return $respuesta;

        }else
        {
            return false;
        }

        mysqli_close($bd);       
    }

    //Funcion para insertar o actualizar los likes
    public function insertUpdateLikes($token, $idNoticia)
    {
        $conexion = new Conexion();
        $bd = $conexion->conexion_bd();
        
        $query = "CALL sp_insert_updates_likes('$token', $idNoticia);";
        
        $respuesta = mysqli_query($bd, $query);

        if(mysqli_errno($bd) == 0)
        {
            return $respuesta;

        }else
        {
            return false;
        }

        mysqli_close($bd);        
    }

    //Consulta para obtener los usuarios
    public function obtenerEstadoLike($token, $idNoticia)
    {
        $conexion = new Conexion();
        $bd = $conexion->conexion_bd();
        
        $query = "CALL sp_get_estado_like('$token', $idNoticia);";
        
        $respuesta = mysqli_query($bd, $query);

        mysqli_close($bd);
        return $respuesta;
    }

     //Consulta para obtener los usuarios
     public function obtenerLikes($idNoticia)
     {
         $conexion = new Conexion();
         $bd = $conexion->conexion_bd();
         
         $query = "CALL sp_get_likes($idNoticia);";
         
         $respuesta = mysqli_query($bd, $query);
 
         mysqli_close($bd);
         return $respuesta;
     }

    //Consulta para obtener los usuarios
    public function obtenerUsuarios($usuario)
    {
        $conexion = new Conexion();
        $bd = $conexion->conexion_bd();
        
        $query = "CALL sp_get_usuarios($usuario);";
        
        $respuesta = mysqli_query($bd, $query);

        mysqli_close($bd);
        return $respuesta;
    }

     //Funcion para insertar los chats
     public function insertarChat($mensaje, $tipoMensaje, $token, $correo)
     {
         $conexion = new Conexion();
         $bd = $conexion->conexion_bd();
         
         $query = "CALL sp_insert_chat('$mensaje', $tipoMensaje, '$token', '$correo');";
         
         $respuesta = mysqli_query($bd, $query);
 
         if(mysqli_errno($bd) == 0)
         {
             return $respuesta;
 
         }else
         {
             return false;
         }
 
         mysqli_close($bd);        
     }

     //Consulta para obtener los usuarios
    public function obtenerChat($token, $correo)
    {
        $conexion = new Conexion();
        $bd = $conexion->conexion_bd();
        
        $query = "CALL sp_get_chat('$token', '$correo');";
        
        $respuesta = mysqli_query($bd, $query);

        mysqli_close($bd);
        return $respuesta;
    }
}

ob_end_flush();