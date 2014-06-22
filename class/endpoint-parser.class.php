<?php

/*
			url encode ?data=
			slotName|action.argument1.argument2,action.argument|slotName|action.argument1
			-----------------------------------------------------------------------------
			action[arguements]:
			
			paged [pagedNr]
			sort [orderby,order]
			metasort [orderby,meta_key,order]
			meta_query[key,value]
			-----------------------------------------------------------------------------
		*/

class EndpointParser {	
	
	public $param;
	public $endpoint_data;
	// -----------------------------------------------------------------------------------------------------------------	
	public function __construct(){
		

		@$this->param = $_GET["data"];		
		$this->parseEndpoint();
	}
	// -----------------------------------------------------------------------------------------------------------------	
	public function parseEndpoint(){
		
		//global $wp_query;
		//$param = $wp_query->query_vars['data'];
		

	$slotArray = explode('|',$this->param);
	$slotCounter=0;
	$finishArray = array();
	foreach($slotArray as $slotval){
		
		$tech_array = array();
		$paramArray = explode(',',$slotval);
			
			

		if ($slotCounter % 2 == 0) {
			

		$slotName = $slotval;
		@$finishArray[$slotName];
			//echo '>'.$slotval.'<';

		}else{

			foreach($paramArray as $val){
				if($val != ""){
					$parseVal = explode('.',$val);
					$argsArray = array();
					$counter=0;
					foreach($parseVal as $argsVal){
						if($counter != 0){
						$argsArray[] = $argsVal;
						}
						$counter++;
					}
					$tech_array[$parseVal[0]] = $argsArray;
				}
			}
		
			$finishArray[$slotName] = $tech_array;
		}
		$slotCounter++;

	}
		$this -> endpoint_data = $finishArray;
	}

	public function procesedTPL($args){
		
		foreach($this -> endpoint_data as $key => $slot){
				
				// grid exception detectad
				if($key == 'grid'){
					$mirrorSlot = array_keys($slot);
					$args[$key] = $mirrorSlot[0];
				}
				if(array_key_exists('tpl_part',  $slot)){
					//echo 'zmień tpl dla - '.$key.' = '.$slot['tpl_part'][0];
					$args[$key]['tpl_part'] = $slot['tpl_part'][0];
				}
				if(array_key_exists('eid',  $slot)){
					//echo 'zmień tpl dla - '.$key.' = '.$slot['tpl_part'][0];
					$args[$key]['eid'] = $slot['eid'][0];
				}
				if(array_key_exists('flow_step',  $slot)){
					//echo 'zmień tpl dla - '.$key.' = '.$slot['tpl_part'][0];
					$args[$key]['flow_step'] = $slot['flow_step'][0];
				}
				if(array_key_exists('hash',  $slot)){
					//echo 'zmień tpl dla - '.$key.' = '.$slot['tpl_part'][0];
					$args[$key]['hash'] = $slot['hash'][0];
				}
		}	
		return $args;
	}
/*	public function procesedUserQuery($args){	
		foreach($this -> endpoint_data as $key => $slot){
				
			if( array_key_exists('m_m_query',  $slot)){			

				$paramRepeater = 2;
				//var_dump(sizeof($slot['m_m_query'])/$paramRepeater);
				if(sizeof($slot['m_m_query'])/$paramRepeater==floor(sizeof($slot['m_m_query'])/$paramRepeater)){

					$length = sizeof($slot['m_m_query'])/$paramRepeater;
					//$args[$key]['query_args']['meta_query'] =  array('relation' => 'LIKE');
					for ($i=0; $i < $length; $i++) { 
			
						$nr =$i*$paramRepeater;
						$args[$key]['query_args']['meta_query'][$i] = array(
					  	 	'key' => $slot['m_m_query'][$nr],
					   		'value' => $slot['m_m_query'][$nr+1],
					   		'compare' => 'IN' //.$slot['m_m_query'][$nr+2]
						);
					}
				}
			}
		}	
		return $args;



	}*/
	public function procesedQuery($args){	
	
		/*
			url encode ?data=
			slotName|action.argument1.argument2,action.argument|slotName|action.argument1
			-----------------------------------------------------------------------------
			action[arguements]:
			
			paged [pagedNr]
			sort [orderby,order]
			metasort [orderby,meta_key,order]
			meta_query[key,value]
			-----------------------------------------------------------------------------
		*/
		foreach($this -> endpoint_data as $key => $slot){

			if(array_key_exists('paged',  $slot)){
				
					$args[$key]['query_args']['paged'] = $slot['paged'][0];
			}
			if(array_key_exists('posts_per_page',  $slot)){

					$args[$key]['query_args']['posts_per_page'] = $slot['posts_per_page'][0];
			}
			if(array_key_exists('author',  $slot)){

					$args[$key]['query_args']['author'] = $slot['author'][0];
			}
			if(array_key_exists('category_name',  $slot)){

					$args[$key]['query_args']['category_name'] = $slot['category_name'][0];
			}
			if(array_key_exists('post_type',  $slot)){

					$args[$key]['query_args']['post_type'] = $slot['post_type'][0];
			}
			if(array_key_exists('sort',  $slot)){
				
				//echo '<p>Sort with orderby:'.$slot['sort'][0].', and:'.$slot['sort'][1].'</p>';
				$args[$key]['query_args']['orderby'] = $slot['sort'][0];
				$args[$key]['query_args']['order'] = $slot['sort'][1];
			}
			if( array_key_exists('metasort',  $slot)){
				
				$args[$key]['query_args']['orderby'] = 'meta_value';
				$args[$key]['query_args']['meta_key'] =  $slot['metasort'][0];
				$args[$key]['query_args']['order'] =  $slot['metasort'][1];
			}
			if( array_key_exists('meta_query',  $slot)){			
				
				echo '<br><br><h3>'.$this -> endpoint_data['meta_query'][1].'</h3>';
				$args[$key]['query_args']['meta_query'] =  array(array(
					   'key' => $slot['meta_query'][0],
					   'value' => $slot['meta_query'][1]
				));
			}
			//?data= querySlot|multi_m_query.key.value.compare.key.value.compare...
			if( array_key_exists('m_m_query',  $slot)){			

				$paramRepeater = 2;
				//var_dump(sizeof($slot['m_m_query'])/$paramRepeater);
				if(sizeof($slot['m_m_query'])/$paramRepeater==floor(sizeof($slot['m_m_query'])/$paramRepeater)){

					$length = sizeof($slot['m_m_query'])/$paramRepeater;
					//$args[$key]['query_args']['meta_query'] =  array('relation' => 'LIKE');
					for ($i=0; $i < $length; $i++) { 
			
						$nr =$i*$paramRepeater;
						$args[$key]['query_args']['meta_query'][$i] = array(
					  	 	'key' => $slot['m_m_query'][$nr],
					   		'value' => $slot['m_m_query'][$nr+1],
					   		'compare' => 'LIKE' //.$slot['m_m_query'][$nr+2]
						);
					}
				}
			}
			if( array_key_exists('m_t_query',  $slot)){			
				$paramRepeater = 2;
				//var_dump(sizeof($slot['m_t_query']) / $paramRepeater);
				if(sizeof($slot['m_t_query']) / $paramRepeater == floor(sizeof($slot['m_t_query']) / $paramRepeater)){

					$length = sizeof($slot['m_t_query']) / $paramRepeater;
					
					$args[$key]['query_args']['tax_query'] = array('relation' => 'AND');
					
					for ($i=0; $i < $length; $i++) { 			
						$nr = $i * $paramRepeater;
						$args[$key]['query_args']['tax_query'][$i+1] = array(
					  	 	'taxonomy' => $slot['m_t_query'][$nr],
					   		'field' => 'id',
					   		'terms' => array( $slot['m_t_query'][$nr+1] )
						);
					}
				}				
			}

/*			if( array_key_exists('xxx',  $slot)){			
				
				echo '<br><br><h3>'.$this -> endpoint_data['meta_query'][1].'</h3>';
				$args[$key]['query_args']['meta_query'] =  array(array(
					   'author' => $slot['meta_query'][0]					  
				));
			}*/
/*			if( array_key_exists('post_type',  $slot)){			
				
				//echo '<br><br><h3>'.$this -> endpoint_data['meta_query'][1].'</h3>';
				$args[$key]['query_args']['meta_query'] =  array(array(
					   'post_type' => $slot['meta_query'][0]					  
				));
			}*/



		}	
		
		return $args;
	}

	
}
?>
