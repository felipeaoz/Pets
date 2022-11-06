<?php
include '../libs/config.php';

class Usuario extends ActiveRecord\Model
{
    public static function agregar($usuario){
        try{
            if(count(self::buscar_usuario($usuario->usuario)) == 0){
                $usuario->save();
                return true;
            }else{
                return false;
            }
            
        }catch(Exception $error){
            return false;
        }
        
    }

    public static function buscar_usuario($username){
        $usuario  = New Usuario();
        $usuario = Usuario::find('all',array('conditions' => array("usuario LIKE '$username'")));
        return $usuario;
    }

    public static function validar_login($username,$password){
        $usuario  = New Usuario();
        $usuario = $usuario = Usuario::find('all',array('conditions'=>array('usuario=? AND password=?',$username,$password)));
        return $usuario;
    }

    public static function buscar_id($id){
        $usuario  = New Usuario();
        $usuario = Usuario::find($id);
        return $usuario;
    }

    public static function modificar($usuario_mod){
        try{        
            $usuario  = New Usuario();
            $usuario = Usuario::find($usuario_mod->id); 
            $usuario->nombres = $usuario_mod->nombres;
            $usuario->apellidos = $usuario_mod->apellidos;
            $usuario->usuario = $usuario_mod->usuario;
            $usuario->password = $usuario_mod->password;
            $usuario->correo = $usuario_mod->correo; 
            $usuario->save($usuario);
            return true;
            
        }catch(Exception $error){
            return false;
        }
    }

    public static function eliminar($id){

        if(Usuario::delete_all(array('conditions' => array("id=$id"))) == 1){
            return true;
        }else{
            return false;
        }
        
    }

    public static function listar(){
        $usuario  = New Usuario();
        $usuario = Usuario::find('all');
        return $usuario;
    }
}

?>