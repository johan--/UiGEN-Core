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
			// $this->show_message($errors, 'Roles added');
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