<?php

// hardcoded:
// Step name: no_acces_step
// Slot name: form-slot

class RolesController {
	
	public $flow_arg;
	public $post_type;
	public $current_step;
	public $eid;
	

	public function __construct($FC){

		$this -> flow_arg = $FC -> flow_arg;
		$this -> post_type = $FC -> post_type;
		$this -> current_step = $FC -> current_step;

		// check if object is edit
		$this -> eid = @$FC->edit_id;


		$this -> hash = @$FC->display_arg['form-slot']['hash'];
		
	}	

	public function checkUserAcces(){

		//only_owner
		//only_subscriber
		//only_contributor
		//only_author
		//only_editor
		//only_editor
		//subscriber
		//contributor
		//author
		//editor
		//editor

		$my_roles_array = array(
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
				if($user_level != '' || $user_acces == 'all'){
					//echo 'user has acces - level'.$user_level;
					$acces_guardian = true;
				}else{
					//echo 'user has no acces - level'.$user_level;
					$acces_guardian = false;					
				}
		}else{
				//echo 'user has no acces';
				$acces_guardian = false;	
		}

		// check only one role action
		
		if($user_acces == 'only_subscriber'){
			//echo 'only_subscriber'.$user_level;
			// check subscriber role
			if( $user_level == 0 ){
				//iam  subscriber
				if ( is_user_logged_in() ) { 
						$acces_guardian = true; 
				} else { 
						$acces_guardian = false; 
				}
	
			}else{
				//iam  not
				$acces_guardian = false;	
			}
		}


		if($this -> eid != ''){

			// CHECK OBJECT TYPE
			echo 'edytuję';			

			$post = get_post($this -> eid);

			if( @$this -> post_type == @$post -> post_type){
				echo 'co jest...';
			// I THINK IS THIS OBJECT IS POST or POSTTYPE
					echo $post -> post_author."!=". get_current_user_id();

				if( $post -> post_author != get_current_user_id()){
					echo 'acces false';
					$acces_guardian = false;
				}else{
					echo 'acces true';
					$acces_guardian = true;
				}
			
			}else{
				// nie jestem posttypem - czymkolwiek innym - kiluj edycję
				//echo 'nie jestem postem';
				$acces_guardian = false;
			}	


			if( $this -> post_type == 'register_fields'){
			// I THINK IS THIS OBJECT ID USER FORM	

				
				if($this -> eid != get_current_user_id()){				

					$acces_guardian = false;
					//check hash
					$user_data = get_userdata( $this -> eid );
					$my_hash = sha1('sEWF343t34G#$FdWd22nf'.$this -> eid.@$user_data -> user_email.'fwe323dx');
					if($my_hash == $this -> hash){
						$acces_guardian = true;
					}			
					
				}else{
					$acces_guardian = true;
				}				
			}

			// IAM ADMIN
			if ( current_user_can('manage_options') ) {
					$acces_guardian = true;
			}
		
		}
		



		if( $acces_guardian == true ){
			// redirect to flow step
			
		}else{


			@$no_acces_step = $this -> flow_arg[$this -> post_type][$this -> current_step]['no_acces_step'];	
			
			//echo '<br/>';
			
			//echo '#currentstep>>'.$this -> current_step.'<<#<br/>';
			//echo '#posttype>>'.$this -> post_type.'<<#<br/>';
			//echo '#noaccesstep>>'.$no_acces_step.'<<#<br/>';
			// redirect to no accse step
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
				//wp_redirect( home_url() ); exit; 
				echo 'ACCES PROBLEM MAN <br/>login as: <b>'.$user_acces.'</b><br> or powerfull user <br/><br/> if you want set communicate you must use [no_acces_step] in your flow params ';
				die();
			}
		}
	}		
}
?>
