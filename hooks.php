<?php

// Kontrakty
// ##############################################################################

add_filter('manage_kontrakt_posts_columns', 'bs_kontrakt_table_head');
function bs_kontrakt_table_head( $defaults ) {
    unset($defaults['date']);
    unset($defaults['taxonomy-rodzaj_badania']);
    $defaults['title'] = 'Nr protokołu';
    $defaults['payer'] = 'Płatnik';
    $defaults['taxonomy-rodzaj_badania'] = 'Rodzaj badania';$defaults['osrodek'] = 'Ośrodek';
    $defaults['duration'] = 'Zakres dat';
    $defaults['state'] = 'Stan kontraktu';
    $defaults['doctor'] = 'Lekarze';
    // var_dump($defaults);
    // die();
    return $defaults;
}

add_action( 'manage_kontrakt_posts_custom_column', 'bs_kontrakt_table_content', 10, 2 );

function bs_kontrakt_table_content( $column_name, $post_id ) {
    
	$meta = get_post_custom($post_id);

	if($column_name == 'osrodek') {
    printf('<a href="%s">%s</a>', get_bloginfo('url').'/wp-admin/post.php?post='.(int)$meta['alpc_place'][0].'&action=edit', get_post((int)$meta['alpc_place'][0])->post_title);
	}

	if(in_array($column_name, array('payer', 'doctor'))) {
		$string = '';
		foreach($meta['alpc_'.$column_name] as $person) {
			$person = (int)$person;
			$userdata = get_userdata($person);
			$string .= $userdata->display_name.'<br />';
		}
		$string = rtrim($string, '<br />');
		print($string);
	}

	if($column_name == 'duration') {
		printf('%s - %s', $meta['alpc_diagnistic_start_date'][0], $meta['alpc_diagnistic_end_date'][0]);
	}

	if($column_name == 'state') {
		printf('%s', $meta['alpc_contract_status'][0]);
	}
	// print('<pre>');var_dump($meta);print('</pre>');die();

}

add_filter( 'manage_edit-kontrakt_sortable_columns', 'bs_kontrakt_table_sorting' );
function bs_kontrakt_table_sorting( $columns ) {
  $columns['osrodek'] = 'alpc_place';
  $columns['payer'] = 'alpc_payer';
  $columns['taxonomy-rodzaj_badania'] = 'alpc_diagnistic_type';
  // $columns['duration'] = 'Zakres dat';
  $columns['state'] = 'alpc_contract_status';
  // $columns['doctor'] = 'Lekarz';
  // $columns['title'] = 'Nr protokołu';
  return $columns;
}

add_filter( 'request', 'bs_alpc_place_column_orderby' );
function bs_alpc_place_column_orderby( $vars ) {
    if ( isset( $vars['orderby'] ) && 'alpc_place' == $vars['orderby'] ) {
        $vars = array_merge( $vars, array(
            'meta_key' => 'alpc_place',
            'orderby' => 'meta_value'
        ) );
    }

    return $vars;
}

add_filter( 'request', 'bs_alpc_payer_column_orderby' );
function bs_alpc_payer_column_orderby( $vars ) {
    if ( isset( $vars['orderby'] ) && 'alpc_payer' == $vars['orderby'] ) {
        $vars = array_merge( $vars, array(
            'meta_key' => 'alpc_payer',
            'orderby' => 'meta_value'
        ) );
    }

    return $vars;
}

add_filter( 'request', 'bs_alpc_diagnostic_type_column_orderby' );
function bs_alpc_diagnostic_type_column_orderby( $vars ) {
    if ( isset( $vars['orderby'] ) && 'alpc_diagnostic_type' == $vars['orderby'] ) {
        $vars = array_merge( $vars, array(
            'meta_key' => 'alpc_diagnostic_type',
            'orderby' => 'meta_value'
        ) );
    }

    return $vars;
}

add_filter( 'request', 'bs_alpc_contrace_status_column_orderby' );
function bs_alpc_contrace_status_column_orderby( $vars ) {
    if ( isset( $vars['orderby'] ) && 'alpc_contrace_status' == $vars['orderby'] ) {
        $vars = array_merge( $vars, array(
            'meta_key' => 'alpc_contract_status',
            'orderby' => 'meta_value'
        ) );
    }

    return $vars;
}

add_filter('months_dropdown_results', '__return_empty_array');
add_action( 'restrict_manage_posts', 'bs_kontrakt_table_filtering' );
function bs_kontrakt_table_filtering() {
  global $wpdb;
  $screen = get_current_screen();
  // global $screen;
  if ( $screen->post_type == 'kontrakt' ) {

    // $dates = $wpdb->get_results( "SELECT EXTRACT(YEAR FROM meta_value) as year,  EXTRACT( MONTH FROM meta_value ) as month FROM $wpdb->postmeta WHERE meta_key = '_bs_meta_event_date' AND post_id IN ( SELECT ID FROM $wpdb->posts WHERE post_type = 'event' AND post_status != 'trash' ) GROUP BY year, month " ) ;

    // echo '';
    //   echo '' . __( 'Show all event dates', 'textdomain' ) . '';
    // foreach( $dates as $date ) {
    //   $month = ( strlen( $date->month ) == 1 ) ? 0 . $date->month : $date->month;
    //   $value = $date->year . '-' . $month . '-' . '01 00:00:00';
    //   $name = date( 'F Y', strtotime( $value ) );

    //   $selected = ( !empty( $_GET['event_date'] ) AND $_GET['event_date'] == $value ) ? 'selected="select"' : '';
    //   echo '' . $name . '';
    // }
    // echo '';

  	$users = new WP_User_Query(array('role' => 'doctor'));
  	foreach ($users->results as $user) {
  		// print('<pre>');var_dump($user);print('</pre>');
  		$doctors[$user->ID] = $user->display_name;
  	}
    echo '<select name="doctor">';
      echo '<option selected="selected" disabled="disabled">' . __( 'Lekarz', 'textdomain' ) . '</option>';
    foreach( $doctors as $value => $name ) {
      $selected = ( !empty( $_GET['doctor'] ) AND $_GET['doctor'] == $value ) ? 'selected="selected"' : '';
      echo '<option value="'.$value.'" '.$selected.'.>'. $name . '</option>';
    }
    echo '</select>';

    $users = new WP_User_Query(array('role' => 'payer'));
    	foreach ($users->results as $user) {
    		// print('<pre>');var_dump($user);print('</pre>');
    		$payers[$user->ID] = $user->display_name;
    	}
      echo '<select name="payer">';
        echo '<option selected="selected" disabled="disabled">' . __( 'Płatnik', 'textdomain' ) . '</option>';
      foreach( $payers as $value => $name ) {
        $selected = ( !empty( $_GET['payer'] ) AND $_GET['payer'] == $value ) ? 'selected="selected"' : '';
        echo '<option value="'.$value.'" '.$selected.'.>'. $name . '</option>';
      }
      echo '</select>';

      	$states = array('podpisany' => 'Podpisany', 'rekrutacja' => 'Rekrutacja', 'idace' => 'Idące', 'zakonczone' => 'Zakończone');
		echo '<select name="state">';
		echo '<option selected="selected" disabled="disabled">' . __( 'Stan kontraktu', 'textdomain' ) . '</option>';
		foreach( $states as $value => $name ) {
			$selected = ( !empty( $_GET['state'] ) AND $_GET['state'] == $value ) ? 'selected="selected"' : '';
			echo '<option value="'.$value.'" '.$selected.'.>'. $name . '</option>';
		}
		echo '</select>';

		$posts = new WP_Query(array('post_type' => 'osrodki'));
			foreach ($posts->posts as $post) {
				// print('<pre>');var_dump($post);print('</pre>');
				$places[$post->ID] = $post->post_title;
			}
		  echo '<select name="place">';
		    echo '<option selected="selected" disabled="disabled">' . __( 'Ośrodek', 'textdomain' ) . '</option>';
		  foreach( $places as $value => $name ) {
		    $selected = ( !empty( $_GET['place'] ) AND $_GET['place'] == $value ) ? 'selected="selected"' : '';
		    echo '<option value="'.$value.'" '.$selected.'.>'. $name . '</option>';
		  }
		  echo '</select>';

		  $taxonomies = get_terms('rodzaj_badania', array('hide_empty' => false) );
		  // print('<pre>');var_dump($taxonomies);print('</pre>');
		  	foreach ($taxonomies as $taxonomy) {
		  		// print('<pre>');var_dump($post);print('</pre>');
		  		$diagnostic_types[$taxonomy->term_id] = $taxonomy->name;
		  	}
		    echo '<select name="diagnostic_type">';
		      echo '<option selected="selected" disabled="disabled">' . __( 'Typ badania', 'textdomain' ) . '</option>';
		    foreach( $diagnostic_types as $value => $name ) {
		      $selected = ( !empty( $_GET['diagnostic_type'] ) AND $_GET['diagnostic_type'] == $value ) ? 'selected="selected"' : '';
		      echo '<option value="'.$value.'" '.$selected.'.>'. $name . '</option>';
		    }
		    echo '</select>';

        print('<input type="date" name="starts_from" value="'.@$_REQUEST['starts_from'].'" placeholder="Start" /><input type="date" name="due_to" value="'.@$_REQUEST['due_to'].'" placeholder="Koniec" />');
  }

  if ( $screen->post_type == 'wizyta' ) {
      $users = new WP_User_Query(array('role' => 'doctor'));
      foreach ($users->results as $user) {
        // print('<pre>');var_dump($user);print('</pre>');
        $doctors[$user->ID] = $user->display_name;
      }
      echo '<select name="doctor">';
        echo '<option selected="selected" disabled="disabled">' . __( 'Lekarz', 'textdomain' ) . '</option>';
      foreach( $doctors as $value => $name ) {
        $selected = ( !empty( $_GET['doctor'] ) AND $_GET['doctor'] == $value ) ? 'selected="selected"' : '';
        echo '<option value="'.$value.'" '.$selected.'.>'. $name . '</option>';
      }
      echo '</select>';

      $posts = new WP_Query(array('post_type' => 'osrodki'));
      foreach ($posts->posts as $post) {
        // print('<pre>');var_dump($post);print('</pre>');
        $places[$post->ID] = $post->post_title;
      }
      echo '<select name="place">';
        echo '<option selected="selected" disabled="disabled">' . __( 'Ośrodek', 'textdomain' ) . '</option>';
      foreach( $places as $value => $name ) {
        $selected = ( !empty( $_GET['place'] ) AND $_GET['place'] == $value ) ? 'selected="selected"' : '';
        echo '<option value="'.$value.'" '.$selected.'.>'. $name . '</option>';
      }
      echo '</select>';

      $posts = new WP_Query(array('post_type' => 'kontrakt'));
      foreach ($posts->posts as $post) {
        // print('<pre>');var_dump($post);print('</pre>');
        $places[$post->ID] = $post->post_title;
      }
      echo '<select name="contract">';
        echo '<option selected="selected" disabled="disabled">' . __( 'Kontrakt', 'textdomain' ) . '</option>';
      foreach( $places as $value => $name ) {
        $selected = ( !empty( $_GET['place'] ) AND $_GET['place'] == $value ) ? 'selected="selected"' : '';
        echo '<option value="'.$value.'" '.$selected.'.>'. $name . '</option>';
      }
      echo '</select>';

      print('<input type="date" name="starts_from" value="'.@$_REQUEST['starts_from'].'" placeholder="Start" /><input type="date" name="due_to" value="'.@$_REQUEST['due_to'].'" placeholder="Koniec" />');
  }
}

add_filter( 'parse_query','bs_kontrakt_table_filter' );
function bs_kontrakt_table_filter( $query ) {
  
  if( is_admin() AND $query->query['post_type'] == 'kontrakt' ) {
    $qv = &$query->query_vars;
    $qv['meta_query'] = array();


    if( !empty($_REQUEST['starts_from']) ) {
      $start_time = date( "Ymd", strtotime($_REQUEST['starts_from']) );
      $qv['meta_query'][] = array(
        'field' => 'alpc_diagnistic_start_date',
        'value' => $start_time,
        'compare' => '>=',
        'type' => 'DATE'
      );
    }

    if( !empty($_REQUEST['due_to']) ) {
      $end_time = date( "Ymd", strtotime($_REQUEST['starts_from']) );
      $qv['meta_query'][] = array(
        'field' => 'alpc_diagnistic_end_date',
        'value' => $end_time,
        'compare' => '<=',
        'type' => 'DATE'
      );
    }

    if( !empty( $_GET['doctor'] ) ) {
      $qv['meta_query'][] = array(
        'field' => 'alpc_doctor',
        'value' => $_GET['doctor'],
        'compare' => '=',
        'type' => 'INT'
      );
    }


    if( !empty( $_GET['payer'] ) ) {
      $qv['meta_query'][] = array(
        'field' => 'alpc_payer',
        'value' => $_GET['payer'],
        'compare' => '=',
        'type' => 'INT'
      );
    }

    if( !empty( $_GET['state'] ) ) {
      $qv['meta_query'][] = array(
        'field' => 'alpc_contract_status',
        'value' => $_GET['state'],
        'compare' => '=',
        'type' => 'INT'
      );
    }

    if( !empty( $_GET['place'] ) ) {
      $qv['meta_query'][] = array(
        'field' => 'alpc_place',
        'value' => $_GET['place'],
        'compare' => '=',
        'type' => 'INT'
      );
    }

    if( !empty( $_GET['diagnostic_type'] ) ) {
      $qv['meta_query'][] = array(
        'field' => 'alpc_diagnostic_type',
        'value' => $_GET['diagnostic_type'],
        'compare' => '=',
        'type' => 'INT'
      );
    }
  }

  if( is_admin() AND $query->query['post_type'] == 'wizyta' ) {
    $qv = &$query->query_vars;
    $qv['meta_query'] = array();


    if( !empty($_REQUEST['starts_from']) ) {
      $start_time = explode('-', $_REQUEST['starts_from']);
      $qv['date_query'][] = array(
        'year' => $start_time[0],
        'compare' => '>='
      );
      $qv['date_query'][] = array(
        'month' => $start_time[1],
        'compare' => '>='
      );
      $qv['date_query'][] = array(
        'day' => $start_time[2],
        'compare' => '>='
      );
    }

    if( !empty($_REQUEST['due_to']) ) {
      $end_time = explode('-', $_REQUEST['due_to']);
      $qv['date_query'][] = array(
        'year' => $end_time[0],
        'compare' => '<='
      );
      $qv['date_query'][] = array(
        'month' => $end_time[1],
        'compare' => '<='
      );
      $qv['date_query'][] = array(
        'day' => $end_time[2],
        'compare' => '<='
      );
    }

    if( !empty( $_GET['doctor'] ) ) {
      $qv['meta_query'][] = array(
        'field' => 'alpc_doctor',
        'value' => $_GET['doctor'],
        'compare' => '=',
        'type' => 'INT'
      );
    }


    if( !empty( $_GET['contract'] ) ) {
      $qv['meta_query'][] = array(
        'field' => 'alpc_contract',
        'value' => $_GET['contract'],
        'compare' => '=',
        'type' => 'INT'
      );
    }

    if( !empty( $_GET['place'] ) ) {
      $qv['meta_query'][] = array(
        'field' => 'alpc_place',
        'value' => $_GET['place'],
        'compare' => '=',
        'type' => 'INT'
      );
    }

  }

  // print('<pre>');var_dump($query);print('</pre>');
}

// Wizyty
// ##############################################################################

add_filter('manage_wizyta_posts_columns', 'bs_wizyta_table_head');
function bs_wizyta_table_head( $defaults ) {
    $defaults['date'];
    // unset($defaults['taxonomy-rodzaj_badania']);
    $defaults['title'] = 'Wizyta';
    $defaults['place'] = 'Ośrodek';
    $defaults['patient'] = 'Pacjent';
    $defaults['contract'] = 'Kontrakt';
    $defaults['doctor'] = 'Lekarz';
    // var_dump($defaults);
    // die();
    return $defaults;
}

add_action( 'manage_wizyta_posts_custom_column', 'bs_wizyta_table_content', 10, 2 );

function bs_wizyta_table_content( $column_name, $post_id ) {
    
  $meta = get_post_custom($post_id);

  if($column_name == 'place') {
    printf('<a href="%s">%s</a>', get_bloginfo('url').'/wp-admin/post.php?post='.(int)$meta['alpc_place'][0].'&action=edit', get_post((int)$meta['alpc_place'][0])->post_title);
  }

  if($column_name == 'doctor') {
    $string = '';
    foreach($meta['alpc_'.$column_name] as $person) {
      $person = (int)$person;
      $userdata = get_userdata($person);
      $string .= $userdata->display_name.'<br />';
    }
    $string = rtrim($string, '<br />');
    print($string);
  }

  if($column_name == 'patient') {
    printf("%s", $meta['alpc_patient'][0]);
  }

  if($column_name == 'contract') {
    printf('%s - %s', $meta['alpc_diagnistic_start_date'][0], $meta['alpc_diagnistic_end_date'][0]);
  }

}

add_filter( 'manage_edit-wizyta_sortable_columns', 'bs_wizyta_table_sorting' );
function bs_wizyta_table_sorting( $columns ) {
  $columns['place'] = 'alpc_place';
  $columns['patient'] = 'alpc_patient';
  $columns['contract'] = 'alpc_contract';
  $columns['doctor'] = 'alpc_doctor';
  return $columns;
}