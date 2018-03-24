<?php
/**************************
 Project Name	: POS
Created on		: 04 April, 2016
Last Modified 	: 27 April, 2016
Description		: outlet related functions

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
require APPPATH . '/libraries/REST_Controller.php';
class outlets extends REST_Controller 
    {
	function __construct() {
		parent::__construct ();
		$this->load->library ( 'curl' );
		$this->load->helper ( 'curl' );
		$this->pickup_id = "718B1A92-5EBB-4F25-B24D-3067606F67F0";
	}
	
	/* check outlet avilablity */
	public function find_outlet_get() 
	{
		$company = app_validation ( $this->get ( 'app_id' ) ); /* validate app */
		$app_id = $company ['client_app_id'];
		$avilability_id = $this->get ( 'availability_id' );
		$postal_code = $this->get ( 'postal_code' );
		$timer_status = $company ['client_timer_enable'];
		$output = $minimum_distance = array ();
		change_time_zone ( $company ['client_defalut_timezone'] ); /* to change client time zone.. */

		/* Check outlet avilablity enabled or not */
				$avilablity = $this->Mydb->get_record ( 'company_availability_status', 'pos_company_availability', array (
				'company_app_id' => $app_id,
				'company_availability_id' => $avilability_id,
				'company_availability_status' => 'A' 
		) );
		
		if (empty ( $avilablity )) {
			echo json_encode ( array (
					'status' => 'error',
					'message' => get_label ( 'rest_outlet_feature' ) 
			) );
			exit ();
		}
		
		$zip_resut = $this->Mydb->get_record ( array (
				'zip_latitude',
				'zip_longitude',
				'zip_id' 
		), 'zipcodes', array (
				'zip_code' => $postal_code 
		) );
		$zip_id =  (isset($zip_resut['zip_id']) ?  $zip_resut['zip_id'] : "");
		$latitude = $longitude = "";
		if (! empty ( $zip_resut ) && ($zip_resut ['zip_latitude'] != '') && ($zip_resut ['zip_longitude'] != '')) {
			$latitude = $zip_resut ['zip_latitude'];
			$longitude = $zip_resut ['zip_longitude'];
			$zip_status = "OK";
		} else {
			
			$url = "http://maps.googleapis.com/maps/api/geocode/json?address=" . $postal_code . "+singapore&sensor=false";
			$zip_resut = getCURLresult ( $url );
			$zip_status = $zip_resut->status;
			
			if (! empty ( $zip_resut ) && $zip_status == "OK") {
				
				$latitude = $zip_resut->results [0]->geometry->location->lat;
				$longitude = $zip_resut->results [0]->geometry->location->lng;
				
				if ($latitude != "" && $longitude != "" && $zip_id !="") {
					$this->Mydb->update ( 'zipcodes', array (
							'zip_id' => $zip_id 
					), array (
							'zip_latitude' => $latitude,
							'zip_longitude' => $longitude 
					) );
					
		 
				}
			}
		}
		
		/* get potal code latitude and longitude */
		
		if (! empty ( $zip_resut ) && $zip_status == "OK") {
			
			/* get outlet details.. */
			$join [0] ['select'] = "outlet_availability.oa_outlet_id,outlet_availability.oa_availability_id";
			$join [0] ['condition'] = "outlet_availability.oa_outlet_id = outlet_id";
			$join [0] ['table'] = "outlet_availability";
			$join [0] ['type'] = "INNER";
			
			$join [1] ['select'] = " coverage.oa_region_marker_location, coverage.oa_outlet_id, coverage.oa_region_type_primary, 
					                coverage.oa_region_points_primary,  coverage.oa_region_radius_primary , coverage.oa_region_type_secondary,
					                 coverage.oa_region_points_secondary, coverage.oa_region_radius_secondary, coverage.oa_region_marker_location";
			$join [1] ['condition'] = "coverage.oa_outlet_id = outlet_id";
			$join [1] ['table'] = "outlet_area_coverage as coverage";
			$join [1] ['type'] = "INNER";
			
			/* get secondary map day avilablity */
			$current_day = strtolower ( date ( 'l' ) );
			$join [2] ['select'] = "da_" . $current_day . "_start_time,da_" . $current_day . "_end_time";
			$join [2] ['condition'] = "da_outlet_id = outlet_id";
			$join [2] ['table'] = 'outlet_day_availability';
			$join [2] ['type'] = "LEFT";
			
			$outlet = $this->Mydb->get_all_records ( 'outlet_name,outlet_id,outlet_delivery_timing,outlet_unit_number1,outlet_unit_number2,outlet_address_line1,
			 		                                   outlet_address_line2,outlet_postal_code,outlet_defalut_value,outlet_open_date,outlet_close_date,outlet_open_time,outlet_close_time,outlet_route_id', 'outlet_management', array (
					'outlet_app_id' => $app_id,
					'outlet_availability' => 1,
					'oa_availability_id' => $avilability_id 
			), '', '', '', '', '', $join );
			
			// print_r($outlet); exit;
			
			if (! empty ( $outlet )) {
				
				foreach ( $outlet as $out ) {
					
					/* check outlet default value */
					if ($out ['outlet_defalut_value'] == "Primary") {
						$region_points = $out ['oa_region_points_primary'];
						$region_type = $out ['oa_region_type_primary'];
						$region_radius = $out ['oa_region_radius_primary'];
					} else {
						
						$region_points = $out ['oa_region_points_secondary'];
						$region_type = $out ['oa_region_type_secondary'];
						$region_radius = $out ['oa_region_radius_secondary'];
						
						/* skip time */
						$start_time = $out ["da_" . $current_day . "_start_time"];
						$end_time = $out ["da_" . $current_day . "_end_time"];
						
						if ($start_time != "" && $end_time != "") {
							$curren_time = date ( "H:i:s" );
							if (($start_time > $curren_time && $end_time > $curren_time) || ($start_time < $curren_time && $end_time < $curren_time)) {
								// "time expired";
								continue;
							}
						}
					}
					
					/* validate shoutdown timing */
					$close_start = date ( "Y-m-d H:i:s", strtotime ( $out ['outlet_open_date'] . " " . $out ['outlet_open_time'] ) );
					$close_end = date ( "Y-m-d H:i:s", strtotime ( $out ['outlet_close_date'] . " " . $out ['outlet_close_time'] ) );
					
					if (($out ['outlet_open_date'] != "0000-00-00" || $out ['outlet_open_date'] != "1970-01-01") && ($out ['outlet_close_date'] != "0000-00-00" || $out ['outlet_close_date'] != "1970-01-01")) {
						$current_date = date ( "Y-m-d H:i:s" );
						
						if (($current_date > $close_start) && ($current_date < $close_end)) {
							
							// "time expired";
							continue;
						}
					}
					
					/* validate shop working hours */
					$working_start = $company ['client_start_time'];
					$working_end = $company ['client_end_time'];
					if ($working_start != "" && $working_end != "" && $timer_status == 1) {
						$currentTime = date ( "H:i:s" );
						
						if (($working_start > $currentTime && $working_end > $currentTime) || ($working_start < $currentTime && $working_end < $currentTime)) {
							// "time expired";
							continue;
						}
					}
					
					if ($region_points != '') {
						
						$reg_points = explode ( '|', $region_points );
						
						/* for circle */
						if ($region_type == 'circle') {
							
							$distance = $this->getDistance ( $reg_points [0], $reg_points [1], $latitude, $longitude );
							
							if ($distance <= $region_radius) {
								$output [$out ['outlet_id']] = array (
										'outlet_id' => $out ['outlet_id'],
										'outlet_name' => $out ['outlet_name'],
										'outlet_delivery_timing' => $out ['outlet_delivery_timing'],
										'outlet_unit_number1' => $out ['outlet_unit_number1'],
										'outlet_unit_number2' => $out ['outlet_unit_number2'],
										'outlet_address_line1' => $out ['outlet_address_line1'],
										'outlet_address_line2' => $out ['outlet_address_line2'],
										'outlet_postal_code' => $out ['outlet_postal_code'],
										'outlet_open_date' => $out ['outlet_open_date'],
										'outlet_close_date' => $out ['outlet_close_date'],
										'outlet_open_time' => $out ['outlet_open_time'],
										'outlet_close_time' => $out ['outlet_close_time'],
										'outlet_route_id' => $out ['outlet_route_id'],
										// 'map_type' => $out ['oa_region_type_primary'],outlet_route_id
										'posatl_code_lat_lang' => $out ['oa_region_marker_location'] 
								);
							}
						} else if ($region_type == 'rectangle') {
							$points_lngs = $points_lats = array ();
							foreach ( $reg_points as $reg_pts ) {
								$rects = explode ( ',', $reg_pts );
								$points_lats [] = $rects [0];
								$points_lngs [] = $rects [1];
							}
							if ($this->is_rectangle ( $points_lats, $points_lngs, $latitude, $longitude )) {
								
								$output [$out ['outlet_id']] = array (
										'outlet_id' => $out ['outlet_id'],
										'outlet_name' => $out ['outlet_name'],
										'outlet_delivery_timing' => $out ['outlet_delivery_timing'],
										'outlet_unit_number1' => $out ['outlet_unit_number1'],
										'outlet_unit_number2' => $out ['outlet_unit_number2'],
										'outlet_address_line1' => $out ['outlet_address_line1'],
										'outlet_address_line2' => $out ['outlet_address_line2'],
										'outlet_postal_code' => $out ['outlet_postal_code'],
										'outlet_open_date' => $out ['outlet_open_date'],
										'outlet_close_date' => $out ['outlet_close_date'],
										'outlet_open_time' => $out ['outlet_open_time'],
										'outlet_close_time' => $out ['outlet_close_time'],
										'outlet_route_id' => $out ['outlet_route_id'],
										// 'map_type' => $out ['oa_region_type_primary'],
										'posatl_code_lat_lang' => $out ['oa_region_marker_location'] 
								);
							}
						} elseif ($region_type == 'polygon') {
							$collect_pts = explode ( "|", $region_points );
							$latitudes = explode ( ",", $collect_pts [0] );
							$longitudes = explode ( ",", $collect_pts [1] );
							
							$vertices_x = $longitudes; // x-coordinates of the vertices of the polygon
							$vertices_y = $latitudes; // y-coordinates of the vertices of the polygon
							$points_polygon = count ( $vertices_x ); // number vertices - zero-based array
							$longitude_x = $longitude; // x-coordinate of the point to test
							$latitude_y = $latitude; // y-coordinate of the point to test
							
							if ($this->is_in_polygon ( $points_polygon, $vertices_x, $vertices_y, $longitude_x, $latitude_y )) {
								
								$output [$out ['outlet_id']] = array (
										'outlet_id' => $out ['outlet_id'],
										'outlet_name' => $out ['outlet_name'],
										'outlet_delivery_timing' => $out ['outlet_delivery_timing'],
										'outlet_unit_number1' => $out ['outlet_unit_number1'],
										'outlet_unit_number2' => $out ['outlet_unit_number2'],
										'outlet_address_line1' => $out ['outlet_address_line1'],
										'outlet_address_line2' => $out ['outlet_address_line2'],
										'outlet_postal_code' => $out ['outlet_postal_code'],
										'outlet_open_date' => $out ['outlet_open_date'],
										'outlet_close_date' => $out ['outlet_close_date'],
										'outlet_open_time' => $out ['outlet_open_time'],
										'outlet_close_time' => $out ['outlet_close_time'],
										'outlet_route_id' => $out ['outlet_route_id'],
										// 'map_type' => $out ['oa_region_type_primary'],
										'posatl_code_lat_lang' => $out ['oa_region_marker_location'] 
								);
							}
						}
					}
				}
				
				/* if get mutiple records filter by near one */
				
				if (empty ( $output )) {
					// rest_no_outlets_found ****response
				} else {
					
					$lat_val = $lang_val = "";
					$distance = array ();
					if (count ( $output ) > 1) {
						
						foreach ( $output as $outval ) {
							
							if ($outval ['posatl_code_lat_lang'] != "") {
								
								$marker_val = $outval ['posatl_code_lat_lang'];
								$replaced = str_replace ( array (
										'(',
										')' 
								), array (
										'',
										'' 
								), $marker_val );
								list ( $lat_val, $lang_val ) = explode ( ',', $replaced );
								$distance [$outval ['outlet_id']] = $this->getDistance ( $lat_val, $lang_val, $latitude, $longitude );
							} else {
								
								// rest_no_outlets_found ****response
							}
						}
						
						$minimum_distance = array_keys ( $distance, min ( $distance ) );
					} else {
						
						$minimum_distance = array_column ( $output, 'outlet_id' );
					}
				}
			} else {
				
				// rest_no_outlets_found ****response
			}
		}
		
		/* if set final result */
		if (! empty ( $minimum_distance )) {
			
			/* get postal code details */
			$zip_result = array ();
			if ($company ['client_country'] == 'Singapore') {
				
				$zip_result = $this->Mydb->get_record ( array (
						'zip_id',
						'zip_code',
						'zip_addtype',
						'zip_buno',
						'zip_sname',
						'zip_buname' 
				), 'pos_zipcodes', array (
						'zip_code' => (int)$postal_code,
						'zip_status' => 1 
				) );
			}
			
			$outlet_id = $minimum_distance [0];
			$outlet_deatlls = $output [$outlet_id];
			
			/* validate routing outlet */
			if ($outlet_deatlls ['outlet_route_id'] != 0) {
				
				$route_outlet = $outlet_deatlls ['outlet_route_id'];
				$array_index = "";
				$array_index = ( int ) $this->searchForId ( $route_outlet, $outlet );
				
				if ($array_index == 0 || $array_index != "") {
					if (isset ( $outlet [$array_index] ) && ! empty ( $outlet [$array_index] )) {
						$route_outlet_deatlls = array ();
						$route_outlet_deatlls = $outlet [$array_index];
						
						/* validate shoutdown timing */
						$close_route_start = date ( "Y-m-d H:i:s", strtotime ( $route_outlet_deatlls ['outlet_open_date'] . " " . $route_outlet_deatlls ['outlet_open_time'] ) );
						$close_route_end = date ( "Y-m-d H:i:s", strtotime ( $route_outlet_deatlls ['outlet_close_date'] . " " . $route_outlet_deatlls ['outlet_close_time'] ) );
						if (($route_outlet_deatlls ['outlet_open_date'] != "0000-00-00" || $route_outlet_deatlls ['outlet_open_date'] != "1970-01-01") && ($route_outlet_deatlls ['outlet_close_date'] != "0000-00-00" || $route_outlet_deatlls ['outlet_close_date'] != "1970-01-01")) {
							$current_date = date ( "Y-m-d H:i:s" );
							
							if (($current_date > $close_route_start) && ($current_date < $close_route_end)) {
								
								$this->show_errror_response ();
							}
						}
						
						$route_outlet_deatlls ['postal_code_information'] = $zip_result;
						$route_outlet_deatlls ['is_route'] = "Yes";
						$route_outlet_deatlls ['route_for'] = $route_outlet;
						$route_return_array = array (
								'status' => "ok",
								'result_set' => $route_outlet_deatlls 
						);
						
						echo json_encode ( $route_return_array );
						exit ();
					}
				}
				
				$this->show_errror_response ();
			}
			
			$outlet_deatlls ['postal_code_information'] = $zip_result;
			$outlet_deatlls ['is_route'] = "No";
			$outlet_deatlls ['route_for'] = "";
			$return_array = array (
					'status' => "ok",
					'result_set' => $outlet_deatlls 
			);
			$this->set_response ( $return_array, success_response () );
		} else {
			
			$this->set_response ( array (
					'status' => "error",
					'message' => get_label ( 'rest_no_outlets_found' ) 
			), notfound_response () );
		}
	}
	
	/* this function used to get pickup outlet names... */
	public function pickup_outlets_get() {
		$company = app_validation ( $this->get ( 'app_id' ) ); /* validate app */
		$app_id = $company ['client_app_id'];
		$output = array ();
		$avilability_id = $this->pickup_id;
		$outlet_id = $this->get ( 'outlet_id' );
		change_time_zone ( $company ['client_defalut_timezone'] ); /* to change client time zone.. */
	
		/* Check outlet avilablity enabled or not */
						$avilablity = $this->Mydb->get_record ( 'company_availability_status', 'pos_company_availability', array (
				'company_app_id' => $app_id,
				'company_availability_id' => $avilability_id,
				'company_availability_status' => 'A' 
		) );
		
		if (empty ( $avilablity )) {
			echo json_encode ( array (
					'status' => 'error',
					'message' => get_label ( 'rest_outlet_feature' ) 
			) );
			exit ();
		}
		
		$where_arr = array (
				'outlet_app_id' => $app_id,
				'outlet_availability' => 1,
				'oa_availability_id' => $avilability_id 
		);
		
		if ($outlet_id != "") 
		{
			$where_arr = array_merge ( $where_arr, array (
					'outlet_id' => $outlet_id 
			) );
		}
		
		/* get outlet details.. */
		$join [0] ['select'] = "outlet_availability.oa_outlet_id,outlet_availability.oa_availability_id";
		$join [0] ['condition'] = "outlet_availability.oa_outlet_id = outlet_id";
		$join [0] ['table'] = "outlet_availability";
		$join [0] ['type'] = "INNER";
		
		$outlet = $this->Mydb->get_all_records ( 'outlet_name,outlet_id,outlet_delivery_timing,outlet_unit_number1,outlet_unit_number2,outlet_address_line1,
			 		                                   outlet_address_line2,outlet_postal_code,outlet_defalut_value,outlet_open_date,outlet_close_date,outlet_open_time,outlet_close_time,outlet_route_id,outlet_marker_latitude,outlet_marker_longitude', 'outlet_management', $where_arr, '', '', '', '', '', $join );
		
		if (! empty ( $outlet )) {
			$return_array = array (
					'status' => "ok",
					'result_set' => $outlet 
			);
			$this->set_response ( $return_array, success_response () );
		} else {
			$this->set_response ( array (
					'status' => "error",
					'message' => get_label ( 'rest_no_outlets_found' ) 
			), notfound_response () );
		}
	}
	
	/* To get the distance of a point from the center of the circle in the outlet */
	private function getDistance($latitude1, $longitude1, $latitude2, $longitude2) {
		$earth_radius = 6371;
		
		$dLat = deg2rad ( $latitude2 - $latitude1 );
		$dLon = deg2rad ( $longitude2 - $longitude1 );
		
		$a = sin ( $dLat / 2 ) * sin ( $dLat / 2 ) + cos ( deg2rad ( $latitude1 ) ) * cos ( deg2rad ( $latitude2 ) ) * sin ( $dLon / 2 ) * sin ( $dLon / 2 );
		$c = 2 * asin ( sqrt ( $a ) );
		$d = $earth_radius * $c;
		
		return $d * 1000;
	}
	
	/* point present inside the rectangle starts here */
	private function is_rectangle($points_lats, $points_lngs, $lat, $lng) {
		$position_lat = $lat;
		$position_long = $lng;
		
		$rectanglepoints_lat1 = $points_lats [0];
		$rectanglepoints_lat2 = $points_lats [1];
		
		$rectanglepoints_lng1 = $points_lngs [0];
		$rectanglepoints_lng2 = $points_lngs [1];
		$availabel = false;
		if (($position_lat >= $rectanglepoints_lat1 && $position_lat <= $rectanglepoints_lat2) && ($position_long >= $rectanglepoints_lng1 && $position_long <= $rectanglepoints_lng2)) {
			$availabel = true;
		}
		return $availabel;
	}
	
	/* this function used to serach array values */
	private function searchForId($id, $array) {
		if (! empty ( $array )) {
			foreach ( $array as $key => $values ) {
				if ($values ['outlet_id'] == $id) {
					return $key;
				}
			}
		}
		return "";
	}
	
	/* this function used to show common error response.... */
	private function show_errror_response() {
		echo json_encode ( array (
				'status' => 'error',
				'message' => get_label ( 'rest_no_outlets_found' ) 
		) );
		exit ();
	}
	function is_in_polygon($points_polygon, $vertices_x, $vertices_y, $longitude_x, $latitude_y) {
		$i = $j = $c = $point = 0;
		for($i = 0, $j = $points_polygon; $i < $points_polygon; $j = $i ++) {
			$point = $i;
			if ($point == $points_polygon)
				$point = 0;
			if ((isset ( $vertices_y [$j] )) && (($vertices_y [$point] > $latitude_y != ($vertices_y [$j] > $latitude_y)) && ($longitude_x < ($vertices_x [$j] - $vertices_x [$point]) * ($latitude_y - $vertices_y [$point]) / ($vertices_y [$j] - $vertices_y [$point]) + $vertices_x [$point])))
				$c = ! $c;
		}
		return $c;
	}
}
