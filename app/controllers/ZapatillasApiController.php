<?php
require_once 'app/models/ZapatillasModel.php';
require_once 'app/views/ZapatillasApiView.php';

class ZapatillasApiController{
    private $model;
    private $view;
    private $data;

    public function __construct(){
        $this->model=new ZapatillasModel();
        $this->view=new ZapatillasApiView();
        $this->data= file_get_contents("php://input");
    }

    private function getData(){
        return json_decode($this->data);
    }

    function getSneakers(){
        $select=empty($_GET['select']) ? '*' : $_GET['select'];
        $orderBy=empty($_GET['orderBy']) ? null : $_GET['orderBy'];
        $orderMode=empty($_GET['orderMode']) ? null : $_GET['orderMode'];
        $startAt=isset($_GET['startAt']) ? $_GET['startAt'] : null;
        $endAt=isset($_GET['endAt']) ? $_GET['endAt'] : null;
        $linkToArray=isset($_GET['linkTo']) ? explode(",",$_GET['linkTo']) : null;
        $equalToArray=isset($_GET['equalTo']) ? explode(",",$_GET['equalTo']) : null;    
        $this->verifyParams($select,$linkToArray,$equalToArray,$orderBy,strtoupper($orderMode),$startAt,$endAt);
        $sneakers=$this->model->getAll($select,$linkToArray,$equalToArray,$orderBy,$orderMode,$startAt,$endAt);
        $this->view->response($sneakers);
    }

    function getSneaker($params=null){
        $id=$params[':ID'];
        $sneaker=$this->model->getOne($id);
        if ($sneaker){
            $this->view->response($sneaker);
        }else{
            $this->view->response("La zapatilla con el id=$id no existe", 404);
        }
    }

    function deleteSneaker($params=null){
        $id=$params[':ID'];
        $sneaker=$this->model->getOne($id);
        if ($sneaker){
            $this->model->deleteSneaker($id);
            $this->view->response($sneaker);
        }else{
            $this->view->response("La zapatilla con el id=$id no existe", 404);
        }
    }

    function addSneaker(){
        $zapatilla= $this->getData();
        if (!empty($_POST['nombre']) && !empty($_POST['marca']) && !empty($_POST['precio']) && !empty($_POST['descripcion']) && !empty($_POST['id_CategoriaDeZapatillas_fk'])){
            $nombre=$_POST['nombre'];
            $marca=$_POST['marca'];
            $precio=$_POST['precio'];
            $descripcion=$_POST['descripcion'];
            if ($_POST['id_CategoriaDeZapatillas_fk']>0&&$_POST['id_CategoriaDeZapatillas_fk']<12){
            $categoria=$_POST['id_CategoriaDeZapatillas_fk'];
            }else{
                $this->view->response("Numero de categoria inválido - Ingresar entre 1 y 11", 400); 
                die();
            }
            $id=$this->model->addSneaker($nombre,$marca,$precio,$descripcion,$categoria);
            $zapatilla=$this->model->getOne($id);
            $this->view->response($zapatilla,201);
        }else{
            $this->view->response("Completar datos", 400);
        }
    }

    function verifyParams($select,$linkToArray,$equalToArray,$orderBy,$orderMode,$startAt,$endAt){
        $columns=[
            "id_zapatilla",
            "nombre",
            "marca",
            "precio",
            "descripcion",
            "id_CategoriaDeZapatillas_fk"
        ];
        foreach($_GET as $i=>$value){
            if ($i != 'select' && $i != 'linkTo' && $i != 'equalTo' && $i != 'orderBy' && $i != 'orderMode'&& $i != 'resource' && $i != 'startAt' && $i != 'endAt'){
                $this->view->response('Parametro Inexistente', 400);
                die;
            }
        }
        if($select!=null&&$select!='*'){
            $key="select";
            $select=explode(",",$select);
            $this->verifyArray($select,$columns,$key);
        }
        if ($linkToArray!=null){
            $key="linkToArray";
            $this->verifyArray($linkToArray,$columns,$key);
        }
        if ($orderBy!=null&&!in_array(strtolower($orderBy),$columns)){
            $this->view->response("Nombre de columna en orderBy : '$orderBy' inválido", 400); 
            die;
        }
        if ($orderMode!=null&&($orderMode!="DESC")&&($orderMode!="ASC")){
            $this->view->response("Modo de ordenamiento invalido - Ingresar entre ASC o DESC", 400); 
            die;
        }
        if ($startAt!=null&&!is_numeric($startAt)||$startAt<0){
            $this->view->response("Numero en startAt invalido - Ingresar numero mayor o igual a 0", 400); 
            die;
        }
        if ($endAt!=null&&!is_numeric($endAt)||$endAt<0){
            $this->view->response("Numero en endAt invalido - Ingresar numero mayor o igual a 0", 400); 
            die;
        }
        return true;
    }

    function verifyArray($array,$columns,$key){       
        foreach($array as $value){
            if (!in_array($value,$columns)){
                $this->view->response("Nombre de columna en $key : '$value' inválido", 400); 
                die();
            }
        }       
        return true;
    }

}
