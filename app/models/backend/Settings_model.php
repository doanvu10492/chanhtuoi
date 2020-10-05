<?php
class Settings_model extends My_Model 
{ 
	public function __construct() 
	{
		$this->table = 'dv_settings';
		$this->primary_key = 'id';
		$this->timestamps = TRUE;
		parent::__construct();
	}

	public function getSiteSettings($data = array())
	{
		$query = $this->get_data_list(array('setting_type' => 'S'))->result();

		foreach ($query as $row)
		{
			switch ($row->value_type) {
				case 'T':
					$data[$row->code] = $row->text_value;
					break;
				case 'S':
				case 'P':
					$data[$row->code] = $row->string_value;
					break;

				default:
					$data[$row->code] = $row->int_value;
					break;
			}
		}

		return $data;
	}
 
	// --------------------------------------------------------------------
	/**
	 * Update site settings information.
	 *
	 * @access	private
	 * @param	array	update information related to site
	 * @return	void
	 */
	public function updateSettings($updateData = array())
	{
		foreach ($updateData as $key => $row) {
			$textKeys = [
				'meta_keywords',
				'map',
				'meta_description',
				'footer',
				'about',
				'header_outlink',
				'info_outlink',
				'google_script',
				'fanpage',
				'popup',
				'style',
				'product_text'
			];

			if ($key == 'site_status') {
				$data = [
					'int_value' => $updateData[$key]
				];
			} elseif (in_array($key, $textKeys)) {
				$data = [
					'text_value' => $updateData[$key]
				];
			} else {
				$data = [
					'string_value' => $updateData[$key]
				];
			}

			$this->updateData(['code'=> $key], $data);
		}
	}
}
