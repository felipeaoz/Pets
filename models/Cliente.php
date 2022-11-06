<?php
include '../libs/config.php';

class Cliente extends ActiveRecord\Model
{
    static $has_many = array(
        array('cliente')
    );

    public static function agregar($cliente){
        try{
            
            if(count(self::buscar_cedula($cliente->cedula)) == 0){
                $cliente->save();
                return true;
            }else{
                return false;
            }
            
        }catch(Exception $error){
            return false;
        }
        
    }

    public static function buscar_cedula($cedula){
        $cliente  = New Cliente();
        $cliente = Cliente::find('all',array('conditions' => array("cedula=$cedula")));
        return $cliente;
    }

    public static function buscar_id($id){
        $cliente  = New Cliente();
        $cliente = Cliente::find($id);
        return $cliente;
    }

    public static function modificar($cliente_mod){
        try{        
            $cliente  = New Cliente();
            $cliente = Cliente::find($cliente_mod->id); 
            $cliente->nombres = $cliente_mod->nombres;
            $cliente->apellidos = $cliente_mod->apellidos;
            $cliente->direccion = $cliente_mod->direccion;
            $cliente->telefono = $cliente_mod->telefono;
            $cliente->cedula = $cliente_mod->cedula; 
            $cliente->save($cliente);
            return true;
            
        }catch(Exception $error){
            return false;
        }
    }

    public static function eliminar($id){

        if(Cliente::delete_all(array('conditions' => array("id=$id"))) == 1){
            return true;
        }else{
            return false;
        }
        
    }

    public static function listar(){
        $cliente  = New Cliente();
        $cliente = Cliente::find('all');
        return $cliente;
    }
}

?>