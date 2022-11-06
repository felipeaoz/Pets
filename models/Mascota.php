<?php
include '../libs/config.php';

class Mascota extends ActiveRecord\Model
{
    static $belongs_to = array(
        array('cliente'),
        array('medicamento')
    );


    public static function agregar($mascota){
        try{
            $mascota->save();
            return $mascota;            
        }catch(Exception $error){
            return false;
        }
        
    }

    public static function buscar_id($id){
        $mascota  = New Mascota();
        $mascota = Mascota::find($id);
        return $mascota;
    }

    public static function modificar($mascota_mod){
        try{        
            $mascota  = New Mascota();
            $mascota = Mascota::find($mascota_mod->id); 
            $mascota->nombre = $mascota_mod->nombre;
            $mascota->raza = $mascota_mod->raza;
            $mascota->edad = $mascota_mod->edad;
            $mascota->peso = $mascota_mod->peso;
            $mascota->cliente_id = $mascota_mod->cliente_id; 
            $mascota->save($mascota);
            return true;
            
        }catch(Exception $error){
            return false;
        }
    }

    public static function eliminar($id){

        if(Mascota::delete_all(array('conditions' => array("id=$id"))) == 1){
            return true;
        }else{
            return false;
        }
        
    }

    public static function listar(){
        $mascota  = New Mascota();
        $mascota = Mascota::find('all',array('select' => 'mascotas.*, 
                                                          clientes.cedula, 
                                                          clientes.nombres, 
                                                          clientes.apellidos,
                                                          medicamentos.nombre as medicamento,
                                                          medicamentos.dosis',
                                            'joins' => array('cliente','medicamento')));
        return $mascota;
    }
}

?>