<?php
class M_consultant extends CI_Model {
    
    private $primary_id='consultant_id';
    private $duplicate1='consultant_code';
    private $duplicate2='consultant_name';
    private $table_order='consultant_name';
    private $table_name='tb_consultant';
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
		$sql = "SELECT * FROM ".$this->table_name."
		WHERE trash!='1' ".$str;

		$data=array();
		$i=1;
        $result=$this->db->query($sql);
        foreach($result->result() as $row)
        {
            $data[] = array(
			$i,
            $row->consultant_code,
            $row->consultant_name,
			$row->contract,
			"By: ".$row->create_by.", on date: ".date_format_id($row->create_date,2),
			"<a  href='#modalForm' link-href='".base_url()."Settings/Consultant/edit/".$row->consultant_id."' class='modal-with-zoom-anim on-default link-edit' title='Edit Row'><i class='fa fa-pencil'></i></a>
			<a  href='#modalConfirm' link-href='".base_url()."Settings/Consultant/do_del/".$row->consultant_id."' class='modal-with-zoom-anim on-default link-del' data-del='".$row->consultant_name."'title='Delete Row'><i class='fa fa-trash-o'></i></a>"
			);
			$i++;
        }
        return $data;
    }

	public function get_data_duplicate_name($arg)
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

	public function get_data_duplicate_code($arg)
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

	function get_data_update($id)
    {
        $data=array();
        $sql = "SELECT * FROM ".$this->table_name."
		WHERE trash!='1'
        AND  ".$this->primary_id."='$id'";

        $result=$this->db->query($sql);
        if($result->num_rows() > 0)
        {
            $data=$result->row();

        }
        return $data;
    }
    
}

?>
