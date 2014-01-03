<?php
class SendPostData {	
	/*
	array(
		'reciver' => true
		'nonce'=> true
		'dataprefix' => '234'
		'datasufix' => '235'
		'data'=>array(
			group
				input
					type => 
					name => 
					value =>

				
					
		)
	)
	*/

	public $data_arg;
	public $data_toDisplay; // hashedValues
	private $data_recived;
	public $edit_id;

	// --------------------------------

	public $labelName; // !!! martwa zmienna

	public $blockPost; // is true to dont display this data into html form
	public $important; // is true to ignore data from inpud and take from dataArg array
	public $nameHash; // is true to hashed form inputs names
	public $cryptoValue; // is true - input value is crypting
	public $args;
	
	public $id; 
	public $type;
	public $request;
	public $label;
	public $labels;
	public $values;
	public $desc;
	public $checked;						
	//public $placeholder;
	public $required;
	public $pattern;

	public $name;
	public $value;


	// --------------------------------

	public $crypto; // unique key to crypto operations

	// ---------------------------------------------------------------------------------------------------------------

	public function __construct($arg){			
			$this -> data_arg = $arg;	
			$this -> crypto = $this->data_arg['prop']['crypto'];	
			
	}
	// --------------------------------------------------------------------------------------------------------------
	



	public function addSendForm($edit_id = false){
		/*
			create form to send Get data
		*/	
		
		$output ='
		<form class="flow_form" action="'.$this->data_arg['prop']['source'].'" method="post" enctype="multipart/form-data">';
		 	
		 	if($this->data_arg['prop']['nonce'] == true){
				$output .='
		 		<input type="hidden" name="_nonce" value="g3r23hr63df4s24g6f4vw4s445dgg4">';

		 	}		 
	 	echo $output;
		 	
		 	foreach( $this->data_arg['data'] as $groupName => $groupValue){ 
			 	// check Flow acces 


			 	echo '<fieldset class="flow_set" id="'.$groupName.'" style="border:0px">';
			 	
			 	foreach ($groupValue as $formElementName => $formElement) {	
			 		@$this -> blockPost 	= 	$formElement['blockPost'];	// przesyła dane bez POST 		 		
			 		@$this -> nameHash 		= 	$formElement['nameHash'];	// hashuje atrybut name na fronice
			 		@$this -> cryptoValue 	= 	$formElement['cryptoValue']; // szyfruje atrybut value na fronice
			 		@$this -> args 			= 	$formElement['args'];	 // atrybut obiektu forma		 		
					@$this -> id 			= 	$formElement['id'];	 // atrybut obiektu forma
					@$this -> type 			= 	$formElement['type']; // atrybut obiektu forma
					@$this -> request 		= 	$formElement['request']; // metoda wypełnienia pola przy reedycji		
					@$this -> label 		= 	$formElement['label']; // nazwa obiektu 
					@$this -> labels 		= 	$formElement['labels'];	// nazwy obiektów radio checkbox ...	
					@$this -> values 		= 	$formElement['values'];	// wartości obiektów radio checkbox ...	
					@$this -> desc 			= 	$formElement['desc']; // opis za polem
					@$this -> checked 		= 	$formElement['checked']; // który zaznaczony		
					@$this -> required 		= 	$formElement['required']; // czy wymagane	
					@$this -> pattern 		= 	$formElement['pattern']; // wyrażenie regularne dla walidacji
					@$this -> name 			= 	$formElement['name'];	// atrybut obiektu forma
					@$this -> value 		= 	$formElement['value'];	// atrybut obiektu forma 
					

					if ($this -> cryptoValue == true){			 			
		 				
		 				// ---------------------------------------
		 				// CRYPTO VALUE TO DISPLAY
		 				// ---------------------------------------		 				
		 				$this -> value = $this->crypto(  $this -> crypto , $this -> value );
		 			}

					// ------------------------------------
		 			// check edition id - to set edit mode
		 			// ------------------------------------
		 			


		 			if($edit_id != ''){
		 					$post = get_post($edit_id);
			 				// ------------------------------------
			 				// user edit
			 				if($this -> request == 'profile'){
			 					$user_info = get_userdata($edit_id);
								$this -> value = $user_info -> $formElementName; 
			 				} 
			 				
			 				// ------------------------------------
			 				// meta edit
			 				if($this -> request == 'meta'){
			 					$this -> value  = get_post_meta( $edit_id, $formElementName, true );
			 				} 
			 				// ------------------------------------
			 				// post edit
			 				if($this -> request == 'posttype'){			 					
			 					$this -> value  = $post -> $formElementName;
			 				} 
			 				// ------------------------------------
			 				if($this -> request == 'taxonomy'){

			 					$terms = wp_get_post_terms( $edit_id, $this -> args['taxonomy'], $args );
			 					$this -> value  = $terms[0]->term_id;
			 				} 
			 				// ------------------------------------
			 				if($this -> request == 'thumbnail'){
								$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($edit_id), 'thumbnail' );
								$url = $thumb['0'];
			 					//$terms = wp_get_post_terms( $edit_id, $this -> args['taxonomy'], $args );
			 					$this -> value  = $url;
			 				} 
			 				// ------------------------------------
		 				
		 			}

		 			if ($this -> blockPost == true){		
		 				// dont display input field
		 			}else{

		 				// ------------------------------------------------------------------
		 				// CREATE FORM ELEMENT
		 				get_template_part($this->data_arg['prop']['tpl_path'] ,$this -> type);
		 				// ------------------------------------------------------------------
		 			}
			 	}

				echo '</fieldset>';

			 }
			
			// ------------------------------------------------------------------------------------
			// SUBMIT
 			// ------------------------------------------------------------------------------------

			if($this->data_arg['prop']['submit'] == 'false'){				
				//$output = 'false'; 
				$output .= '<div class="submitBtn"><input style="display:none" class="'.$this->data_arg['prop']['submit_class'].'" type="submit" value="'.$this->data_arg['prop']['submit'].'"></div>';

			}else{
				//$output = 'true'; 
				$output .= '<div class="submitBtn"><input class="'.$this->data_arg['prop']['submit_class'].'" type="submit" value="'.$this->data_arg['prop']['submit'].'"></div>';
			}

			/* create extra submit */
			//var_dump($this->data_arg['prop']['extra_submit']);

			$output .='</form>';
			echo $output;
		
	
	}

	// --------------------------------------------------------------------------------------------------------------
	
	public function reciveData($data_arg){		
		
		$this -> data_arg = $data_arg;
		$output='

			<script>
			window.onbeforeunload = function() {
 		 	return "Data will be lost if you leave the page, are you sure?";
			};
			</script>

		';

		if( empty($_POST) ){ echo '<h2>data mishmashroom error::1 and die </h2><br> $_post data is empty'; die();  }

		$this -> data_recived = $_POST;

	
		// walk function rebuild $this->data_arg
		$this -> walk($this -> data_arg);


		return $this -> data_arg;
		
	}

	// --------------------------------------------------------------------------------------------------------------
	// --------------------------------------------------------------------------------------------------------------
	// TECHNICAL METHODS
	// --------------------------------------------------------------------------------------------------------------
	// Recursively traverses a multi-dimensional array. - generated dotted notation list
    private function walk($walk)
	{
	    $cryptoGuardian = false; // activated cryptography;
	    $nameHashGuardian = false;

	    $valueContainer;
	    $nameContainer;
	    
	 
        foreach ( $walk['data'] as $groupName => $groupValue ){ 

        	//var_dump($groupName) ; 

        	foreach ($walk['data'][$groupName] as $fieldName => $fieldValue ){


				foreach ($walk['data'][$groupName][$fieldName] as $attrName => $attrValue ){

	            	// -------------------------------------------------
					//var_dump($attrName);
		        		
	            	// set walked values
	            	            	
	            	if($attrName == 'blockPost'){
	            		$this -> blockPost = $attrValue;
	            	}	            	
	            	if($attrName == 'important'){
	            		$this -> important = $attrValue;
	            	}
	            	if($attrName == 'nameHash'){
	            		$this -> nameHash = $attrValue;
	            	}
	            	if($attrName == 'cryptoValue'){
	            		$this -> cryptoValue = $attrValue;
	            	}
	            	if($attrName == 'args'){
	            		$this -> args = $attrValue;
	            	}
	            	if($attrName == 'id'){
	            		$this -> id = $attrValue;
	            	}
	            	if($attrName == 'type'){
	            		$this -> type = $attrValue;
	            	}	
	            	if($attrName == 'request'){
	            		$this -> request = $attrValue;
	            	}	
					if($attrName == 'label'){
	            		$this -> label = $attrValue;
	            	}
	            	if($attrName == 'labels'){
	            		$this -> labels = $attrValue;
	            	}
	            	if($attrName == 'values'){
	            		$this -> values = $attrValue;
	            	}
	            	if($attrName == 'desc'){
	            		$this -> desc = $attrValue;
	            	}
	            	if($attrName == 'checked'){
	            		$this -> checked = $attrValue;
	            	}	
	            	if($attrName == 'required'){
	            		$this -> required = $attrValue;	            		
	            	}
	            	if($attrName == 'pattern'){
	            		$this -> pattern = $attrValue;	            		
	            	}            	
	            	if($attrName == 'name'){
	            		$this -> name = $attrValue;	            		
	            	}
	            	if($attrName == 'value'){
	            		$this -> value = $attrValue;
	    		
	            		// jesli input ma blokadę wyświetlania to nie realizuj poniższego mapowania
	            		if($this -> blockPost != true){

		            		if($this -> important != true){
		            			
		            			$attrValue = $this->postMaper($this -> name, $this -> nameHash, $this -> value);
		            			//echo $this -> name.'>'.$attrName."->".$attrValue.'<br/>';
		            		}
		            		
							if($this -> cryptoValue == true){							
		            			// ENCRYPTO
								// ---------------------------------------
								$attrValue = $this -> encrypto($this -> crypto,$attrValue);
								// ---------------------------------------
		            		}	            		
							
							$this -> data_arg['data'][$groupName][$fieldName][$attrName] = $attrValue;
		            		//$this -> set_value($this -> data_arg, $fieldName, $attrValue); 
		            		
		            	}
						//var_dump($walk['data'][$groupName][$attrName]);
		            	
	            		
	            		// -------------------------------------------------
	            		// reset walked values
	            		$this -> blockPost = '';
	            		$this -> important = '';
						$this -> nameHash = '';
						$this -> cryptoValue = '';
						$this -> args = '';
						$this -> id = '';
						$this -> type = '';	
						$this -> request = '';							
						$this -> label = '';
						$this -> labels = '';
						$this -> values = '';
						$this -> desc = '';
						$this -> checked = '';
						$this -> required = '';
						$this -> pattern = '';
						$this -> name = '';
						$this -> value = '';

	            	}
        		}
        	}			
    	}  		   
	}

	// get value from array by dotted notation
	public function set_value(&$root, $compositeKey, $value) {
	    $keys = explode('.', $compositeKey);
	    while(count($keys) > 1) {
	        $key = array_shift($keys);
	        if(!isset($root[$key])) {
	            $root[$key] = array();
	        }
	        $root = &$root[$key];
	    }

	    $key = reset($keys);
	    $root[$key] = $value;
	}

	public function myHash($value){
		
		$returnvalue = md5($value.$this -> crypto);
			
		return $returnvalue;
	}


	// --------------------------------------------------------------------------------------------------------------
	
	public function crypto($pass , $str){
		
			/*$arr1 = str_split($str);
			$arr2 = array_reverse($arr1, true);
			
			$str = '';
			foreach ($arr2 as $value)
				{
					$str .= $value;
				}		
			
			return $str;*/
			 
			return str_rot13($str);
		
	}
	public function encrypto( $pass, $str){
		
			/*$arr1 = str_split($str);
			$arr2 = array_reverse($arr1, true);
			
			$str = '';
			foreach ($arr2 as $value)
				{
					$str .= $value;
				}		
			
			return $str;*/
			
			return str_rot13($str);

		
	}
	// --------------------------------------------------------------------------------------------------------------
	// check names with md5 names
	private function postMaper($inputName, $nameHash, $startValue){

			//echo '<br>search with post <br/>';
			//echo $inputName.'----->'.$nameHash.'<br>';

			
			if($nameHash == true){
				
				foreach($this -> data_recived as $key => $value){

		            	if($this -> myHash($inputName) == $key )	{
		            			
		            			return $value;
		            	}		

		         }

		    }else{
		    	
				
				foreach($this -> data_recived as $key => $value){

		            	if($inputName == $key ){
								
		            			return $value;

		            	}		

		         }

		    }
		    return $startValue;
	}


	
}
?>
