<?php
class M_General extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function getGFAS($project_id){        
        $sql    = "SELECT gfas FROM tb_project WHERE project_id = '".$_SESSION['project_id']."'";
        $result = $this->db->query($sql)->row_array()['gfas'];

        return $result;
    }

}

?>
