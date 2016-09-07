<?php 
class ModelModulePvnmProfiler extends Model {
	public function install() {
		$this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "pvnm_loading (
			loading_id int(11) NOT NULL AUTO_INCREMENT,
			url text NOT NULL,
			time decimal(15,5) NOT NULL DEFAULT '0.00000',
			date datetime NOT NULL default '0000-00-00 00:00:00',
			PRIMARY KEY (loading_id)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci");

		$this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "pvnm_query (
			query_id int(11) NOT NULL AUTO_INCREMENT,
			query text NOT NULL,
			time decimal(15,5) NOT NULL DEFAULT '0.00000',
			date datetime NOT NULL default '0000-00-00 00:00:00',
			PRIMARY KEY (query_id) 
			) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci");
	}

	public function uninstall() {
		$this->db->query("DROP TABLE IF EXISTS " . DB_PREFIX . "pvnm_loading");
		$this->db->query("DROP TABLE IF EXISTS " . DB_PREFIX . "pvnm_query");
	}
}