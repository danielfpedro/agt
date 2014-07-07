<?php

/**
* 
*/
class DataUtilComponent extends Component {
	
	public function setPadrao($data) {
		$data = explode('/', $data);
		if (count($data) == 3) {
			return $data[2] . '/' . $data[1] . '/' . $data[0];
		} else {
			return false;
		}
	}
	public function reverse($data) {
		$data = explode('-', $data);
		if (count($data) == 3) {
			return $data[2] . '/' . $data[1] . '/' . $data[0];
		} else {
			return false;
		}
	}
}

?>