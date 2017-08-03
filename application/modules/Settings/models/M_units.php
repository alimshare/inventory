<?php
class M_units extends CI_Model {
    private $primary_id='id';
    private $duplicate1='';
    private $duplicate2='';
    private $table_order='';
    private $table_name='tb_units';
    private $site_id='';

    function __construct()
    {
        parent::__construct();
        $this->site_id='1';
    }

    // do insert
    function do_insert($data_insert){
        $this->db->insert($this->table_name, $data_insert);
        return $this->db->insert_id();
    }

    // do update
    function do_update($id, $data_update){
        $this->db->where_in($this->primary_id, $id);
        $result=$this->db->update($this->table_name, $data_update);
        return $id;
    }

    // do delete
    function do_delete($id){
        $this->db->where($this->primary_id, $id);
        $this->db->delete($this->table_name);

    }

	function get_data_json_all($str='')
    {
		$sql = "SELECT T1.*,T2.project_name FROM ".$this->table_name." T1 INNER JOIN tb_project T2 ON T1.project_id=T2.project_id 
		WHERE 1=1 ".$str;

		$data=array();
		$i=1;
        $result=$this->db->query($sql);
        foreach($result->result() as $row)
        {
            $data[] = array(
			$i,
            $row->unit_name,
			$row->project_name,
			"<a  href='#modalForm' link-href='".base_url()."Settings/Units/edit/".$row->id."' class='modal-with-zoom-anim on-default link-edit' title='Edit Row'><i class='fa fa-pencil'></i></a>
			<a  href='#modalConfirm' link-href='".base_url()."Settings/Units/do_del/".$row->id."' class='modal-with-zoom-anim on-default link-del' data-del='".$row->unit_name."'title='Delete Row'><i class='fa fa-trash-o'></i></a>"
			);
			$i++;
        }
        return $data;
    }

	public function get_data_duplicate_name($arg)
	{
        $sql="SELECT * FROM ".$this->table_name."
			WHERE ".$this->duplicate1."='".$arg."'  ";

        $data = array();
        $result=$this->db->query($sql);
        if($result->num_rows() > 0)
        {
            $data=$result->row();
        }
        return $data;
    }

	public function get_data_duplicate_code($arg)
	{
        $sql="SELECT * FROM ".$this->table_name."
			WHERE ".$this->duplicate2."='".$arg."'  ";

        $data = array();
        $result=$this->db->query($sql);
        if($result->num_rows() > 0)
        {
            $data=$result->row();
        }
        return $data;
    }

	function get_data_update($id)
    {
        $data=array();
        $sql = "SELECT * FROM ".$this->table_name."
		WHERE 1=1
        AND  ".$this->primary_id."='$id'";

        $result=$this->db->query($sql);
        if($result->num_rows() > 0)
        {
            $data=$result->row();

        }
        return $data;
    }

























	public function get_data_single($str=''){
        $sql="SELECT * FROM ".$this->table_name."
		WHERE site_id='".$this->site_id."'  ".$str;

        $data = "";
        $result=$this->db->query($sql);
        if($result->num_rows() > 0)
        {
            $data=$result->row()->pkm_titel;
        }
        return $data;
    }

	function get_data_all($str='')
    {
		$sql =   "SELECT * FROM ".$this->table_name." ";
	    $prov = $this->m_daerah->get_daerah_kode($_SESSION['us_wilayah'], "Provinsi");
		if($_SESSION['us_level_instansi']=="Root"){
			$sql.=" WHERE site_id='".$this->site_id."' ".$str;
		}else if($_SESSION['us_level']=="Superadmin" && $_SESSION['us_level_instansi']=="Implementor"){
			$sql.=" WHERE site_id='".$this->site_id."' ".$str;
		}else if($_SESSION['us_level']=="Administrator" || $_SESSION['us_level']=="Editor"){
			$sql.=" WHERE site_id='".$this->site_id."' AND pkm_wilayah LIKE '".$prov."%' ".$str;
		}else if($_SESSION['us_level']=="Superadmin" && $_SESSION['us_level_instansi']=="Instansi"){
			$sql.=" WHERE site_id='".$this->site_id."' AND pkm_wilayah LIKE '".$prov."%' ".$str;
		}else{
			$sql.=" WHERE site_id='".$this->site_id."' AND pkm_wilayah LIKE '".$prov."%' ".$str;
		}

        $data=array();
        $result=$this->db->query($sql);
        if($result->num_rows() > 0)
        {
            foreach($result->result() as $row)
			{
				$data[]=$row;
			}
		}
        return $data;
    }





	function get_data_fasyankes_group($str='')
    {
		$sql =   "SELECT DISTINCT dae.daerah_paren FROM tb_epi_pkm AS pkm
				LEFT JOIN tb_daerah AS dae ON pkm.pkm_wilayah=dae.daerah_kode ";
				$prov = $this->m_daerah->get_daerah_kode($_SESSION['us_wilayah'], "Provinsi");
			if($_SESSION['us_level_instansi']=="Root"){
				$sql.=" WHERE pkm.site_id='".$this->site_id."' ".$str;
			}else if($_SESSION['us_level']=="Superadmin" && $_SESSION['us_level_instansi']=="Implementor"){
				$sql.=" WHERE pkm.site_id='".$this->site_id."' ".$str;
			}else if($_SESSION['us_level']=="Administrator" || $_SESSION['us_level']=="Editor"){
				$sql.=" WHERE pkm.site_id='".$this->site_id."' AND pkm_wilayah LIKE '".$prov."%' ".$str;
			}else if($_SESSION['us_level']=="Superadmin" && $_SESSION['us_level_instansi']=="Instansi"){
				$sql.=" WHERE pkm.site_id='".$this->site_id."' AND pkm_wilayah LIKE '".$prov."%' ".$str;
			}else{
				$sql.=" WHERE pkm.site_id='".$this->site_id."' AND pkm_wilayah LIKE '".$prov."%' ".$str;
			}

        $data=array();
        $result=$this->db->query($sql);
        if($result->num_rows() > 0)
        {
            foreach($result->result() as $row)
			{
				$data[]= array(
					'daerah_paren'	       	=>$row->daerah_paren,
					'daerah_titel'	       	=>$this->m_daerah->get_daerah_titel($row->daerah_paren),
					'pkm'	       	=>$this->get_data_all(" AND pkm_wilayah LIKE '".$row->daerah_paren.".%' ")
				);
			}
		}
        return $data;
    }
}

?>
