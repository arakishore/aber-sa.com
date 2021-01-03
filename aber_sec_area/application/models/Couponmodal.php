<?php
class Couponmodal extends CI_Model {
    
	public function addCoupon($data) {
		$this->db->query("INSERT INTO coupon SET name = '" . $this->common->mysql_safe_string($data['name']) . "', code = '" . $this->common->mysql_safe_string($data['code']) . "', discount = '" . (float)$data['discount'] . "', type = '" . $this->common->mysql_safe_string($data['type']) . "', total = '" . (float)$data['total'] . "', logged = '" . (int)$data['logged'] . "', shipping = '" . (int)$data['shipping'] . "', date_start = '" . $this->common->mysql_safe_string($data['date_start']) . "', date_end = '" . $this->common->mysql_safe_string($data['date_end']) . "', uses_total = '" . (int)$data['uses_total'] . "', uses_customer = '" . (int)$data['uses_customer'] . "', status = '" . (int)$data['status'] . "',vendor_id='".$data['vendor_id']."', date_added = NOW()");

		//$coupon_id = $this->db->getLastId();
		$coupon_id = $this->db->insert_id();
		 

		return $coupon_id;
	}

	public function editCoupon($coupon_id, $data) {
		$this->db->query("UPDATE coupon SET name = '" . $this->common->mysql_safe_string($data['name']) . "', code = '" . $this->common->mysql_safe_string($data['code']) . "', discount = '" . (float)$data['discount'] . "', type = '" . $this->common->mysql_safe_string($data['type']) . "', total = '" . (float)$data['total'] . "', logged = '" . (int)$data['logged'] . "', shipping = '" . (int)$data['shipping'] . "', date_start = '" . $this->common->mysql_safe_string($data['date_start']) . "', date_end = '" . $this->common->mysql_safe_string($data['date_end']) . "', uses_total = '" . (int)$data['uses_total'] . "', uses_customer = '" . (int)$data['uses_customer'] . "', status = '" . (int)$data['status'] . "' WHERE coupon_id = '" . (int)$coupon_id . "'");

		
	
	}

	public function deleteCoupon($coupon_id) {
		$this->db->query("DELETE FROM coupon WHERE coupon_id = '" . (int)$coupon_id . "'");
		$this->db->query("DELETE FROM coupon_product WHERE coupon_id = '" . (int)$coupon_id . "'");
		$this->db->query("DELETE FROM coupon_category WHERE coupon_id = '" . (int)$coupon_id . "'");
		$this->db->query("DELETE FROM coupon_history WHERE coupon_id = '" . (int)$coupon_id . "'");
	}

	public function getCoupon($coupon_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM coupon WHERE coupon_id = '" . (int)$coupon_id . "'");

		return $query->row_array();
	}
	public function getVCoupon($coupon_id,$vendor_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM coupon WHERE coupon_id = '" . (int)$coupon_id . "' and vendor_id='".(int)$vendor_id."' ");

		return $query->row_array();
	}
	public function getCouponByCode($code) {
		$query = $this->db->query("SELECT DISTINCT * FROM coupon WHERE code = '" . $this->common->mysql_safe_string($code) . "'");

		return $query->row_array();
	}

	public function getCoupons($data = array()) {
		$sql = "SELECT coupon_id, name, code, discount, date_start, date_end, status FROM coupon";

		$sort_data = array(
			'name',
			'code',
			'discount',
			'date_start',
			'date_end',
			'status'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY name";
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

		return $query->result_array();
	}

	public function getCouponProducts($coupon_id) {
		$coupon_product_data = array();

		$query = $this->db->query("SELECT * FROM coupon_product WHERE coupon_id = '" . (int)$coupon_id . "'");

		foreach ($query->result_array() as $result) {
			$coupon_product_data[] = $result['product_id'];
		}

		return $coupon_product_data;
	}

	public function getCouponCategories($coupon_id) {
		$coupon_category_data = array();

		$query = $this->db->query("SELECT * FROM coupon_category WHERE coupon_id = '" . (int)$coupon_id . "'");

		foreach ($query->result_array() as $result) {
			$coupon_category_data[] = $result['category_id'];
		}

		return $coupon_category_data;
	}

	public function getTotalCoupons() {
		$query = $this->db->query("SELECT COUNT('') AS total FROM coupon");
		$query_row = $query->row_array();
		return $query_row['total'];
	}

	public function getCouponHistories($coupon_id, $start = 0, $limit = 10) {
		if ($start < 0) {
			$start = 0;
		}

		if ($limit < 1) {
			$limit = 10;
		}

		$query = $this->db->query("SELECT ch.order_id, CONCAT(c.firstname, ' ', c.lastname) AS customer, ch.amount, ch.date_added FROM coupon_history ch LEFT JOIN customer c ON (ch.customer_id = c.customer_id) WHERE ch.coupon_id = '" . (int)$coupon_id . "' ORDER BY ch.date_added ASC LIMIT " . (int)$start . "," . (int)$limit);

		return $query->result_array();
	}

	public function getTotalCouponHistories($coupon_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM coupon_history WHERE coupon_id = '" . (int)$coupon_id . "'");
		$query_row = $query->row_array();
		return $query_row['total'];
	}
}