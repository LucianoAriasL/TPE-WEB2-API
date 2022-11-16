<?php
class ZapatillasModel{
    private $db;

    function __construct(){ 
        $this->db = $this->conectDB();
    }

    private function conectDB(){
        $db= new PDO('mysql:host=localhost;'.'dbname=tienda_de_zapatillas;charset=utf8','root','');
        return $db;
    }

    function getAll($select,$linkToArray=null,$equalToArray=null,$orderBy=null,$orderMode=null,$startAt=null,$endAt=null){
        $query="SELECT $select FROM zapatillas";
        if(($linkToArray&&$equalToArray)||($orderBy&&$orderMode)||($startAt!=null&&$endAt!=null)){
            if($linkToArray&&$equalToArray){
                $query.=" WHERE $linkToArray[0] = :$linkToArray[0]";
                if (count($linkToArray)>1){                    
                    foreach($linkToArray as $key => $value){
                        if ($key>0){
                            $query.= " AND ".$value." = :".$value." ";
                        }
                    }
                }               
            }
            if ($orderBy&&$orderMode){
                $query.=" ORDER BY $orderBy $orderMode";
            }
            if (isset($startAt)&&isset($endAt)){
                $query.=" LIMIT $startAt, $endAt";
            }
            
        }
        $query=$this->db->prepare($query);
        if(isset($linkToArray)&&isset($equalToArray)){
            foreach($linkToArray as $key =>$value){
                $query-> bindParam(":".$value,$equalToArray[$key],PDO::PARAM_STR);
            }
        }          
        $query->execute();
        $sneakers=$query->fetchAll(PDO::FETCH_OBJ);
        return $sneakers;
    }

    function getOne($id){
        $query=$this->db->prepare('SELECT id_zapatilla,nombre,marca,precio,descripcion,id_CategoriaDeZapatillas_fk FROM zapatillas WHERE id_zapatilla = ?');
        $query->execute([$id]);
        $sneaker=$query->fetch(PDO::FETCH_OBJ);
        return $sneaker;
    }

    function deleteSneaker($id){
        $query=$this->db->prepare('DELETE FROM zapatillas WHERE id_zapatilla=?');
        $query->execute([$id]);
    }

    function addSneaker($nombre,$marca,$precio,$descripcion,$categoria){
        $query=$this->db->prepare('INSERT INTO zapatillas (nombre,marca,precio,descripcion,id_CategoriaDeZapatillas_fk) VALUES (?,?,?,?,?)');
        $query->execute([$nombre,$marca,$precio,$descripcion,$categoria]);
        return $this->db->lastInsertId();
    }
}