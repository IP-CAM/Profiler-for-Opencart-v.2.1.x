<?php 
class ModelModulePvnmProfiler extends Model {
	public function getLoadings($data = array()) {
		$sql = "SELECT l.*, (SELECT COUNT(*) FROM " . DB_PREFIX . "pvnm_query WHERE loading_id = l.loading_id) AS query, (SELECT COUNT(*) FROM " . DB_PREFIX . "pvnm_query WHERE loading_id = l.loading_id AND time >= '" . $this->config->get('pvnm_profiler_query_time') . "') AS slow FROM " . DB_PREFIX . "pvnm_loading l WHERE l.loading_id > 0";

		if (!empty($data['filter_url'])) {
			$sql .= " AND l.url LIKE '%" . $this->db->escape($data['filter_url']) . "%'";
		}

		if (!empty($data['filter_time'])) {
			$sql .= " AND l.time LIKE '" . $this->db->escape($data['filter_time']) . "%'";
		}

		if (!empty($data['filter_date'])) {
			$sql .= " AND DATE(l.date) = DATE('" . $this->db->escape($data['filter_date']) . "')";
		}

		$sort_data = array(
			'l.url',
			'l.time',
			'query',
			'slow',
			'l.date'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];	
		} else {
			$sql .= " ORDER BY l.date";	
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}			

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}	
			
			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getLoadingsTotal($data = array()) {
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "pvnm_loading l WHERE l.loading_id > 0";

		if (!empty($data['filter_url'])) {
			$sql .= " AND l.url LIKE '%" . $this->db->escape($data['filter_url']) . "%'";
		}

		if (!empty($data['filter_time'])) {
			$sql .= " AND l.time LIKE '" . $this->db->escape($data['filter_time']) . "%'";
		}

		if (!empty($data['filter_date'])) {
			$sql .= " AND DATE(l.date) = DATE('" . $this->db->escape($data['filter_date']) . "')";
		}

		$query = $this->db->query($sql);
		
		return $query->row['total'];
	}

	public function deleteLoading($loading_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "pvnm_loading WHERE loading_id = '" . (int)$loading_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "pvnm_query WHERE loading_id = '" . (int)$loading_id . "'");
	}

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
			loading_id int(11) NOT NULL,
			query text NOT NULL,
			time decimal(15,5) NOT NULL DEFAULT '0.00000',
			date datetime NOT NULL default '0000-00-00 00:00:00',
			PRIMARY KEY (query_id, loading_id) 
			) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci");
	}

	public function uninstall() {
		$this->db->query("DROP TABLE IF EXISTS " . DB_PREFIX . "pvnm_loading");
		$this->db->query("DROP TABLE IF EXISTS " . DB_PREFIX . "pvnm_query");
	}
}