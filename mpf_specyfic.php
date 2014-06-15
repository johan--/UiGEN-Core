<?php
	class Custom_Types_Creator {
		public $roles;
		public $post_types;
		public $shortcodes;
		public $sidebars;

		function __construct() {

		}

		public function add_roles() {
			$errors = array();
			foreach ($this->roles as $role => $caps) {
				if (NULL === add_role($role, __($role), $caps)) {
					$errors[] = __('Problem with adding a role').': '.__($role);
				}
			}
			var_dump($errors);
			// $this->show_message($errors, 'Roles added');
		}
		public function add_cap() {
			$errors = array();
			foreach ($this->roles as $role => $caps) {
				$base_role = get_role($role);
				var_dump($base_role);
				if (NULL === $base_role -> add_cap($caps)) {
					$errors[] = __('Problem with adding a role').': '.__($role);
				}
			}
			var_dump($errors);			
		}

		public function remove_roles() {
			foreach ($this->roles as $role => $caps) {
				remove_role($role);
			}
		}

		private function show_message($errors, $success) {
			$message = '';
			if (count($errors) > 0) {
				foreach ($errors as $error) {
					$message .= $error.'<br>';
				}
				$type = 'error';
			} else {
				$message = __($success);
				$type = 'updated';
			}
			printf('<div class="%s" below-h2>%s</div>', $type, $message);
		}

	};

	add_filter('screen_layout_columns', function($columns) {
		$columns['kontrakt'] = $columns['osrodki'] = $columns['wizyta'] = 1;
		return $columns;
	});
	add_filter('get_user_option_screen_layout_kontrakt', function() {return 1;});
	add_filter('get_user_option_screen_layout_osrodki', function() {return 1;});
	add_filter('get_user_option_screen_layout_wizyta', function() {return 1;});