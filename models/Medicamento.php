<?php
include '../libs/config.php';

class Medicamento extends ActiveRecord\Model
{
    

    public static function agregar($medicamento){
        try{
            $medicamento->save();
            return true;            
        }catch(Exception $error){
            return false; 
        }
        
    }



    public static function buscar_id($id){
        $medicamento  = New Medicamento();
        $medicamento = Medicamento::find($id);
        return $medicamento;
    }

    public static function modificar($medicamento_mod){
        try{        
            $medicamento  = New Medicamento();
            $medicamento = Medicamento::find($medicamento_mod->id); 
            $medicamento->nombre = $medicamento_mod->nombre;
            $medicamento->descripcion = $medicamento_mod->descripcion;
            $medicamento->dosis = $medicamento_mod->dosis;
            $medicamento->save($medicamento);
            return true;
            
        }catch(Exception $error){
            return false;
        }
    }

    public static function eliminar($id){

        if(Medicamento::delete_all(array('conditions' => array("id=$id"))) == 1){
            return true;
        }else{
            return false;
        }
        
    }

    public static function listar(){
        $medicamento  = New Medicamento();
        $medicamento = Medicamento::find('all');
        return $medicamento;
    }
}

?>