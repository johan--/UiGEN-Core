<?php
class FlowController{

	public $flow_arg; // flow controller args
	public $data_arg; // send post data args
	public $display_arg; // template display controler args

	public $post_type; // wordpress posttype
	public $postData; // request data

	public $current_step;
	public $next_step;
	public $prev_step;

	public $edit_id;
	public $relation_post_id;
	public $relation_user_id;


	// -----------------------------------------------------------------------------------------------------------------	
	public function __construct($post_type, $flow_arg, $data_arg, $display_arg, $postData){	

		@$this -> post_type = $post_type;
		@$this -> flow_arg = $flow_arg;
		@$this -> data_arg = $data_arg;
		@$this -> display_arg = $display_arg;
		@$this -> postData = $postData;

		//$this -> executeStep($data_arg);

	}

	// ---------------------------------------------------------------------------------------------------
	// flow controlls vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv
	// ---------------------------------------------------------------------------------------------------

	public function executeStep($data_arg){

		if( $this -> postData == null ){
			
			//$first_key = $data_arg['prop']['flow'];
			// get first key from flow arg
			$this -> current_step = $data_arg['prop']['flow'];

			$first_key = @array_shift(@array_keys($this -> flow_arg[$this -> post_type]));
			
			$this -> next_step = $this -> flow_arg[$this -> post_type][$first_key]['next_step'];	

			$this -> edit_id = $_GET['eid'];

			$this -> relation_post_id = $_GET['rpid'];	
			$this -> relation_user_id = $_GET['ruid'];	

			if($_GET['fs'] != ''){
				$this -> current_step = $_GET['fs'];
			}

		}else{

			@$this -> current_step = $this -> postData['nextStep'];
			@$this -> next_step = $this -> flow_arg[$this -> post_type][$this -> current_step]['next_step'];
			@$this -> edit_id = $this -> postData['editID'];

			@$this -> relation_post_id = $this -> postData['rpid'];
			@$this -> relation_user_id = $this -> postData['ruid'];

		}

		// echo '<br/> ## Flow controll ---------------------------------------------------------------------- #<br/>';
		// echo '## Jestem w kroku: '. $this -> current_step.' następny krok to: '.$this -> next_step;
		// echo '<br/>## ----------------------------------------------------------------------------------------- #<br/>';

		return $this -> display_arg;
		

	}
	

	// display arg ---------------------------------------------------------------------------------------
	public function setGrid(){
		//var_dump($this -> flow_arg[$this -> post_type][$this -> current_step]);
		@$grid = $this -> flow_arg[$this -> post_type][$this -> current_step]['grid'];			
		
		if($grid != false){
			$this -> display_arg['grid'] = $grid;
		}
		//echo '## Grid:'. $grid.' #<br/>';
		//echo '<br/>## ----------------------------------------------------------------------------------------- #<br/>';
		return $this -> display_arg;

	}
	// display arg ---------------------------------------------------------------------------------------
	public function setMessage(){
		
		@$slotName = $this -> flow_arg[$this -> post_type][$this -> current_step]['msg'][0];	
		if($slotName != false){

			$addSlot = array(	
				
				'type' => 'tpl-part',
				'tpl_part' => $this -> flow_arg[$this -> post_type][$this -> current_step]['msg'][1],		
				'string' => $this -> flow_arg[$this -> post_type][$this -> current_step]['msg'][2],
			);

			$this -> display_arg[$slotName] = $addSlot;
		}
		//var_dump($this -> display_arg);
		return $this -> display_arg;		
	}
	// data arg ------------------------------------------------------------------------------------------
	public function setSubmitButtonName( $data_arg ){

		$this -> data_arg = $data_arg;		
		@$submitName = $this -> flow_arg[$this -> post_type][$this -> current_step]['submit'];	
		if($submitName != ''){
			$this -> data_arg['prop']['submit'] = $submitName;
		}
		@$submitClases = $this -> flow_arg[$this -> post_type][$this -> current_step]['submit_class'];	
		if($submitClases != ''){
			$this -> data_arg['prop']['submit_class'] = $submitClases;
		}
		return $this -> data_arg;

	}
	// data arg ------------------------------------------------------------------------------------------
	public function setCurrentFlowStep($data_arg){

		$this -> data_arg = $data_arg;		
		$flowName = $this -> current_step;
		if($flowName != null){
			$this -> data_arg['prop']['flow'] = $flowName;
		}
		return $this -> data_arg;
	}
	// data arg ------------------------------------------------------------------------------------------
	public function setStepFromSlot($data_arg, $slot_name){
		
		$this -> data_arg = $data_arg;		
		@$set_step = $this -> display_arg[$slot_name]['flow_step'];			
		if($set_step != null){
			$this -> data_arg['prop']['flow'] = $set_step;
		}
		return $this -> data_arg;
	}
	// data arg ------------------------------------------------------------------------------------------
	public function setCurrentTplPath($data_arg){
		@$tplName = $this -> flow_arg[$this -> post_type][$this -> current_step]['tpl_path'];	
		
	
		if($tplName != ''){
			$this -> data_arg = $data_arg;
			$this -> data_arg['prop']['tpl_path'] = $tplName;
			return $this -> data_arg;
		}else{		
			return $data_arg;
		}
	}


	public function runControllers($data_arg){
		

		// Warning !!!
		// This calls_array:Array takes first arguments "key($this -> flow_arg)"
		@$calls_array = $this -> flow_arg[key($this -> flow_arg)][$this -> current_step]['controllers'];	
			
		
		
		if($calls_array != ''){

			foreach ($calls_array as $key => $value) {

				// deleted #+chars from string to callback function name
				$key = explode('#',$key);
				$key = $key[0];

				$value['form_data'] = &$data_arg;
				$value['display_data'] = $this -> display_arg; 
				
				/*				
				echo '<pre>';
				print_r(array($value));
				echo '</pre>';
				*/

				call_user_func_array($key,array($value)); 				   
			}
		}


		// SCRIPT EXECUTE
		//echo 'SCRIPT EXECUTE';
		$formula = $this -> flow_arg[$this -> post_type][$this -> current_step]['formula'];
		echo '<script>';
		echo 'jQuery( document ).ready(function() {';
		echo $formula;
		echo '});';
		echo '</script>';


	}

	public function runInControllers($data_arg){
		@$calls_array = $this -> flow_arg[$this -> post_type][$this -> current_step]['IN_controllers'];	
		if($calls_array != ''){
			foreach ($calls_array as $key => $value) {
				
				$value['form_data'] = &$data_arg;
				call_user_func_array($key,array($value)); 				   
			}
		}
	}
	public function user_check_acces(){
		

		/*$my_roles_array = array(
			'subscriber' => 	0,
			'contributor' => 	1,
			'author' => 		2,
			'editor' => 		5,
			'administrator' => 	8,
		);
		$acces_guardian = true;
		// get user acces type from flow
		@$user_acces = $this -> flow_arg[$this -> post_type][$this -> current_step]['user_acces_type'];	
		
		// ceck is user is unlogged
		if ( is_user_logged_in() ) { $acces_guardian = true; } else { $acces_guardian = false; }

		// get acces level
		@$acces_level = $my_roles_array[$user_acces];
		global $current_user;
		$user_level = $current_user->user_level;
		

		// check user rights
		if ($user_level >= $acces_level  || $user_acces == 'all'){
				$acces_guardian = true;
		}else{
				$acces_guardian = false;	
		}

		// check only one role action
		
		if($user_acces == 'only_subscriber'){
			//echo 'only_subscriber'.$user_level;
			// check subscriber role
			if( $user_level == 0 ){
				//iam  subscriber
				
				if ( is_user_logged_in() ) { $acces_guardian = true; } else { $acces_guardian = false; }
	
			}else{
				//iam  not
				$acces_guardian = false;	
			}
		}


		if( $acces_guardian == true ){
			// redirect to flow step
			
		}else{

			@$no_acces_step = $this -> flow_arg[$this -> post_type][$this -> current_step]['no_acces_step'];	
			//echo '#>>'.$no_acces_step.'<<#';
			if($no_acces_step != ''){
				
				global $post;
				if($post -> post_type == 'page'){				
					global $wp;
					$current_url = add_query_arg( $wp->query_string, '', home_url( $wp->request ) );
					$current_url.='&'; 
				}else{
					$current_url = get_permalink();
					$current_url.='?'; 
				}

				//echo $current_url.'data=form-slot%7Cflow_step.'.$no_acces_step;
				wp_redirect($current_url.'data=form-slot%7Cflow_step.'.$no_acces_step); // exit; //'form-slot%7Cflow_step.flow_view_profile'
			
			}else{
				wp_redirect( home_url() ); exit; 
				echo 'ACCES PROBLEM MAN <br/>login as: <b>'.$user_acces.'</b><br> or powerfull user <br/><br/> if you want set communicate you must use [no_acces_step] in your flow params ';
				die();
			}
		}		*/
	}
	
	// ---------------------------------------------------------------------------------------------------
	// flow controlls ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
	// ---------------------------------------------------------------------------------------------------

	// must mapped this inputs with executeStep() function

	public function addFlowStepsGroup($data_arg){

				$this -> data_arg = $data_arg;	

				$this -> data_arg['data']['flow_steps'] = array(
				'input_current_step' => array(	
						'important' => true, // value blinded $_POSTed data 
						'nameHash'=>false,					
						'id' => 'input_cs',
						'type' => 'hidden',
						'name' => 'currentStep',
						'value' => $this -> current_step,
				), 
				'input_next_step' => array(	
						'important' => true, // value blinded $_POSTed data 
						'nameHash'=>false,					
						'id' => 'input_ns',
						'type' => 'hidden',
						'name' => 'nextStep',
						'value' => $this -> next_step,
				), 
				'input_edited_ocject_id' => array(	
						'important' => true, // value blinded $_POSTed data 
						'nameHash'=>false,					
						'id' => 'input_ei',
						'type' => 'hidden',
						'name' => 'editID',
						'value' => $this -> edit_id,
				), 
				'input_relation_post_id' => array(	
						'important' => true, // value blinded $_POSTed data 
						'nameHash'=>false,					
						'id' => 'input_rpid',
						'type' => 'hidden',
						'name' => 'rpid',
						'value' => $this -> relation_post_id,
				), 
				'input_relation_user_id' => array(	
						'important' => true, // value blinded $_POSTed data 
						'nameHash'=>false,					
						'id' => 'input_ruid',
						'type' => 'hidden',
						'name' => 'ruid',
						'value' => $this -> relation_user_id,
				), 


			);
/*			echo '<pre>';		
			var_dump($this -> data_arg);
			echo '</pre>';*/
	 		return $this -> data_arg;
	}
	// ---------------------------------------------------------------------------------------------------
	public function parser_dataAcces($data_arg){
				
			@$acces = $this -> flow_arg[$this -> post_type][$this -> current_step]['data_acces'];
			$permised_keys = Array();

			$counter = 0;
			if($acces != ''){
				foreach ($acces as $fieldName => $fieldValue ){
					if($fieldName == 'dynamic'){
						//var_dump($this -> postData);
	    				//echo $data_arg['data'][$fieldValue[0]][$fieldValue[1]]['value'];
	    				$permised_keys[$counter] = $data_arg['data'][$fieldValue[0]][$fieldValue[1]]['value'];

					}else{
						//echo $fieldName;
						$permised_keys[$counter] = $fieldName;
					}				
					$counter++;
				}

				
				// remove intruder keys from data_arg
				foreach ( $data_arg['data'] as $groupName => $groupValue ){ 
						
						$deleteGuardian = false;
						foreach( $permised_keys as $value ){
							
							if( $groupName	==  $value ){
								//echo $value.'-zostaje<br/>';
								$deleteGuardian = true;
							}				

						}

						if($groupName == 'flow_steps'){
								//echo $groupName.'-zostaje<br/>';
								$deleteGuardian = true;

						}

						if($deleteGuardian == false){
							//echo $groupName.'-usuwam<br/>';
							unset($data_arg['data'][$groupName]);
						}
				}
				// check is group exist

			}

			return $data_arg;
			//
			//var_dump($this -> data_arg['prop']);
			//echo $acces;

	} 


	// metoda tymczasowa - powinna zmieniać wyświetlanie obiektu na poziomie jego generowania
	public function get_inputToShowObject(){
		// return json object
		$imputs_to_show = $this -> flow_arg[$this -> post_type][$this -> current_step]['show_input'];
		
		//var_dump($imputs_to_show);
		$output = "	
			<script>
				var toShowObject = [
				";

				foreach ($imputs_to_show as $key => $value) {
					
					$output .= "{id:'#".$value."'},";
					
				}
					
		$output .=	"]


		jQuery.each(toShowObject, function(index, value) {
			jQuery(value['id']).parent().css('display','block');
			jQuery(value['id']).get(0).type = 'text';
			jQuery(value['id']).prev().css('display','inline')
		});
			</script>
		";
		return $output;


	}

	


	

}
?>