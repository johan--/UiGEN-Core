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

	// --------------------------------

	public $labelName;
	public $blockPost; // is true to dont display this data into html form
	public $important; // is true to ignore data from inpud and take from dataArg array
	public $nameHash; // is true to hashed form inputs names
	public $cryptoValue; // is true - input value is crypting
	
	public $id; 
	public $type;
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
			$this -> crypto = $this->data_arg['crypto'];	
			
	}
	// --------------------------------------------------------------------------------------------------------------
	



	public function addSendForm(){
		/*
			create form to send Get data
		*/		

		$output ='
		<form action="'.$this->data_arg['source'].'" method="post" enctype="multipart/form-data">';
		 	
		 	if($this->data_arg['nonce'] == true){
				$output .='
		 		<input type="hidden" name="_nonce" value="g3r23hr63df4s24g6f4vw4s445dgg4">';

		 	}		 
	 	echo $output;
		 	
		 	foreach( $this->data_arg['data'] as $groupName => $groupValue){ 
			 	echo '<fieldset id="'.$groupName.'" style="border:0px">';
			 	
			 	foreach ($groupValue as $formElement) {	
			 		@$this -> blockPost = $formElement['blockPost'];			 		 		
			 		@$this -> nameHash = $formElement['nameHash'];	
			 		@$this -> cryptoValue = $formElement['cryptoValue'];			 		
					@$this -> id = $formElement['id'];	
					@$this -> type = $formElement['type'];	
					@$this -> required = $formElement['required'];	
					@$this -> pattern = $formElement['pattern'];
					@$this -> name = $formElement['name'];	
					@$this -> value = $formElement['value'];	
					

					if ($this -> cryptoValue == true){			 			
		 				
		 				// ---------------------------------------
		 				// CRYPTO VALUE TO DISPLAY
		 				// ---------------------------------------		 				
		 				$this -> value = $this->crypto(  $this -> crypto , $this -> value );
		 			}
		 			if ($this -> blockPost == true){		
		 				// dont display input field
		 			}else{
		 				get_template_part($this->data_arg['tpl_path'] ,'input');
		 			}
			 	}

				echo '</fieldset>';

			 }
			
			if($this->data_arg['submit'] == false){
				$output = '<input style="display:none" type="submit" value="'.$this->data_arg['submit'].'">';

			}else{
				$output = '<input type="submit" value="'.$this->data_arg['submit'].'">';
			}
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
	    
	    while ( count($walk) > 0 )
	    {
	        $defer = array();
	        foreach ( $walk as $k=>$v )
	        {   
	            if ( is_array($v) )
	            {       
	                foreach ( $v as $kk=>$vv ) {
	                	$defer["$k.$kk"] = $vv;

	                }
	           
	            } else {
	            	// -------------------------------------------------
	            	// set walked values
	            	
	            	$keyName = explode('.', $k);

	            	if(end($keyName) == 'blockPost'){
	            		$this -> blockPost = $v;
	            	}	            	
	            	if(end($keyName) == 'important'){
	            		$this -> important = $v;
	            	}
	            	if(end($keyName) == 'nameHash'){
	            		$this -> nameHash = $v;
	            	}
	            	if(end($keyName) == 'cryptoValue'){
	            		$this -> cryptoValue = $v;
	            	}
	            	if(end($keyName) == 'id'){
	            		$this -> id = $v;
	            	}
	            	if(end($keyName) == 'type'){
	            		$this -> type = $v;
	            	}	
	            	if(end($keyName) == 'required'){
	            		$this -> required = $v;	            		
	            	}
	            	if(end($keyName) == 'pattern'){
	            		$this -> pattern = $v;	            		
	            	}            	
	            	if(end($keyName) == 'name'){
	            		$this -> name = $v;	            		
	            	}
	            	if(end($keyName) == 'value'){
	            		$this -> value = $v;
        		
	            		// jesli input ma blokadę wyświetlania to nie realizuj poniższego mapowania
	            		if($this -> blockPost != true){
		            		

		            		if($this -> important != true){
		            			$v = $this->postMaper($this -> name, $this -> nameHash);
		            		}

							if($this -> cryptoValue == true){							
		            			// ENCRYPTO
								// ---------------------------------------
								$v = $this -> encrypto($this -> crypto,$v);
								// ---------------------------------------
		            		}
		            		

		            		$this -> set_value($this -> data_arg, $k, $v); 
		            		
		            	}


	            		
	            		// -------------------------------------------------
	            		// reset walked values
	            		$this -> blockPost = '';
	            		$this -> important = '';
						$this -> nameHash = '';
						$this -> cryptoValue = '';
						$this -> id = '';
						$this -> type = '';
						$this -> required = '';
						$this -> pattern = '';
						$this -> name = '';
						$this -> value = '';

	            	}
					
	            }       
	        }   
	        $walk = $defer;
	    }
	  
	    return $this -> data_arg;
	}

	// get value from array by dotted notation
	function set_value(&$root, $compositeKey, $value) {
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
	function myHash($value){
		$returnvalue = md5($value.$this -> crypto);
		return $returnvalue;
	}


	// --------------------------------------------------------------------------------------------------------------
	
	public function crypto($pass , $str){
		
			$arr1 = str_split($str);
			$arr2 = array_reverse($arr1, true);
			
			$str = '';
			foreach ($arr2 as $value)
				{
					$str .= $value;
				}		
			
			return $str;
		
	}
	public function encrypto( $pass, $str){
		
			$arr1 = str_split($str);
			$arr2 = array_reverse($arr1, true);
			
			$str = '';
			foreach ($arr2 as $value)
				{
					$str .= $value;
				}		
			
			return $str;

		
	}
	// --------------------------------------------------------------------------------------------------------------
	// check names with md5 names
	private function postMaper($inputName, $nameHash){

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
	}


	
}
?>
