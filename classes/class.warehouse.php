<?php 
/**
* INVENTORY MAIN CLASS
*/
class warehouse extends database
{
	private $table_name;

	function __construct()
	{
		parent::__construct();
		$this->table_name = 'warehouse';
	}

	public function insert_product_warehouse($form)
	{
		$data = array();

		$data['product_id'] = $form['product_name'];
		$data['cost'] = $form['product_cost'];
		$data['price'] = $form['product_quantity'];
		$data['quantity'] = $form['product_price'];
		$data['skutype'] = $form['product_type'];
		$data['skuvalue'] = $form['product_volume'];
	
		$this->insert($this->table_name, $data);

		return $this->row_count();

	} // end of insert

	public function update_product_warehouse($form, $id)
	{
		
		$product_id = $form['product_id'];
		$data = array();

		// $data['product_id'] = $form['product_id'];
		$data['cost'] = $form['product_cost'];
		$data['price'] = $form['product_price'];
		$data['quantity'] = $form['product_quantity'];
		$data['skutype'] = $form['product_type'];
		$data['skuvalue'] = $form['product_volume'];

		$this->where('product_id', $product_id);
		$this->update($this->table_name, $data);

		// Update Cost & Price in Product Table
		$dataproduct['p_cost'] = $form['product_cost'];
		$dataproduct['p_price'] = $form['product_price'];
		$this->where('p_id', $id);
		$this->update('products', $dataproduct);

		return $this->row_count();

	} // end of update

	public function inv_get($ID)
	{
		$this->where('inv_id',$ID);
		$this->from($this->table_name);

		return $this->result();
	} // end of get


	public function get_products($ID = NULL)
	{
		if (isset($ID)) {
			$this->where('id',$ID);
			$this->from($this->table_name);
			return $this->result();
		}
		else {
			// $this->where('id',$ID);
			$this->from($this->table_name);
			return $this->all_results();
		}
	} // end of get

	public function get_product($barcode)
	{
		if (isset($barcode)) {
			$this->where('inv_barcode',$barcode);
		}

		$this->from($this->table_name);


		return $result = $this->all_results();
		


	} // end of get


} // end of class


 ?>