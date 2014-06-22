<?php
    // // Evaluates mathematical calculations (and other code...)
    // function do_math($data, $formula) {
    //     // Extract fields from array
    //     extract($data, EXTR_REFS);
    //     // Evaluate formula
    //     var_dump('formula' , $formula);
    //     eval(str_replace('#', '$', addslashes($formula[0])));
    //     // Pack everything back
    //     $cd = array();
    //     foreach ($data as $key => $value) {
    //         $cd[] = $key;
    //     }
    //     $data = compact($cd);
    //     return ($data);
    // }
    // function getOldOptions($oldID){
    // }

    function test_inputData_process($data_arg, $postmeta){
            /*  echo "<pre style=\"border: 1px solid #000; height: 200px; overflow: auto; margin: 0.5em;\">";
            var_dump('gameprops->>',@$_POST['game_props']);
            echo "</pre>\n";*/
           
            //var_dump('postmeta------>',$postmeta);
            //if(isset($_POST['game_props'])){
            $game_props = json_decode(stripcslashes(urldecode(@$_POST['game_props'])), true);

            //var_dump('game props to fullfil -> ', $game_props);

            // asstes exception -----------------------------------

            $old_assets = $game_props['assets'];
            if(is_null($old_assets)){
                $old_assets = array();
            }
            $new_assets = json_decode($postmeta['assets'][0], true);
            if(is_null($old_assets)){
                $old_assets = array();
            }
        var_dump('old assets ->', $old_assets);
        var_dump('new assets ->', $new_assets);

        // Uncover new assets (if any...)
       
        $parsed_assets = array_merge($old_assets,$new_assets);
      
        $game_props['assets'] = $parsed_assets;
        // asstes exception ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
        
        //var_dump('merge assets>>',$game_props);
        //$game_props = stripcslashes(json_encode($game_props));


        // $stage_props = $data_arg['stage_props'];
        // $formula = $stage_props['formula'];
        // // Evaluate formula
        // if(!is_null($formula)) {
        //     $fields = $data_arg['data']['game_point'];
        //     $parsed_fields = array();
        //     foreach ($fields as $field => $meta) {
        //         $parsed_fields[@$key] = @$meta['value'];
        //     }       
        //     do_math($parsed_fields, $formula);
        //     foreach ($parsed_fields as $field => $meta) {
        //         $data_arg['data']['game_point'][$field]['value'] = $meta;
        //     }
        // }
            // Uncover new assets (if any...)
           
            $parsed_assets = array_merge($old_assets,$new_assets);
          
            $game_props['assets'] = $parsed_assets;
            // asstes exception ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

          
            $game_props = stripcslashes(json_encode($game_props));



                $stage_props = $data_arg['stage_props'];
                $formula = $stage_props['formula'];
                
                // Evaluate formula
               /* if(!is_null($formula)) {
                    $fields = $data_arg['data']['game_point'];
                    $parsed_fields = array();
                    foreach ($fields as $field => $meta) {
                        $parsed_fields[@$key] = @$meta['value'];
                    }       
                    do_math($parsed_fields, $formula);
                    foreach ($parsed_fields as $field => $meta) {
                        $data_arg['data']['game_point'][$field]['value'] = $meta;
                    }
                }*/
                
                //var_dump('merge assets>>',$game_props);

                $data_arg['data']['game_point']['game_props']['value'] = urlencode($game_props);
                //var_dump('game props ->', $game_props);
                return $data_arg;
    }

    function validate_answer($args) {
           
        global $TDC;
        global $wpdb;

        // Get the props
        //var_dump($_COOKIE);
        $game_id = @$_COOKIE['game_props'];
        $stage_props = $args['form_data']['stage_props'];
        $end_demo = @$stage_props['end-demo'];
        $points = intval($stage_props['points'][0]);
        $current_step = $stage_props['current_step'];
      
       
        //var_dump('New assets', $new_assets);
        $current_user_id = wp_get_current_user()->ID;
        //var_dump($stage_props);

        // check game ID from _GET method
        if(isSet($_GET['gid'])) {
            $gid = intval($_GET['gid']);
            if($gid > 0) {
                $query = "SELECT `ID` FROM ".$wpdb->prefix."posts WHERE `post_type` LIKE 'gry'";
                //print($query);
                $games = $wpdb->get_col($query);
                //var_dump('Games',$games);
                if (in_array($gid, $games)) {
                    $game_id = $gid;
                } else {
                    // Wrong game ID
                    //print('dupa');
                }
            } else {
                // grong game ID format
                //print('i chuj');
            }
        }

        if (isSet($_GET['action'])) {
            switch ($_GET['action']) {
                case 'newgame':
                    // Add to users games if game is free
                    $old_users_games = get_user_meta( $current_user_id, 'games', true );
                    if ($old_users_games == '') {
                        $new_users_games = json_encode(array($gid));
                    } else {
                        $old_users_games = json_decode($old_users_games, true);
                        $new_users_games = json_encode(array_merge($old_users_games, array($gid)));
                    }
                    update_user_meta( $current_user_id, 'games', $new_users_games );
                    // Set demo mode
                    $demo = true;      
                    // Check if user bought this game...
                    $users_games = json_decode(get_user_meta($current_user_id, 'games', true), true);
                    if (@in_array($gid, $users_games)) {
                        //$props['demo'] = false;
                        $demo = false;
                    }

                    // Insert instance into database
                    $wpdb->insert($wpdb->prefix.'games', array(
                        'user_id' => wp_get_current_user()->ID,
                        'game_id' => $game_id,
                        'game_hash' => md5(wp_get_current_user()->ID."salttttttt".$game_id),
                        'demo' => $demo,
                    ));
                    $game_id = $wpdb->insert_id;
                    setcookie('game_props', $game_id, time()+3600, '/');
                    break;
                case 'continue':
                    $query = "SELECT `ID` FROM {$wpdb->prefix}games WHERE `user_id` = {$current_user_id} ORDER BY `ID` DESC LIMIT 1;";
                    $instance = $wpdb->get_results($query);
                    $instance = $instance[0]->ID;
                    $query = "SELECT * FROM {$wpdb->prefix}game_history WHERE `game_id`= {$instance_id} ORDER BY `ID` DESC LIMIT 1;";
                    $game_data = $wpdb->get_results($query);
                    // Set rebuild_id (last_step col)
                    // Set game_props (user_data col)
                    break;
                default:
                    //print('Something went wrong...');
            }    
        }

        $query = "SELECT * FROM ".$wpdb->prefix."games WHERE `ID` = ".$game_id.' ORDER BY `ID` DESC;';
        $demo = $wpdb->get_results($query);
        $demo = $demo[0]->demo;
        if ($demo == 0) {
            $demo = false;
        } else {
            $demo = true;
        }
        
        if($game_id == 0) {
            print ("something went wrong- wrong game ID");
        }

        // If in demo mode check if current scene is demo ender
        // if($demo){
        //     if($end_demo == 'true') {
        //         //var_dump($args);
        //         wp_redirect(get_bloginfo('url'));
        //     }
        // }

        $game_data = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."games WHERE `ID` = ".$game_id.";");
        if (count($game_data) > 0) {
            // Do the stuff
            $last_step = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."game_history WHERE `game_id` = ". $game_id." ORDER BY `id` DESC LIMIT 1;");
            if(@$last_step[0]->last_step == @$current_step) {
                // Your'e very very bad person, NO CHEATING!!!
                print("Użyto przysisku wstecz...");
            } else {
                $game_fields = array();
                // Everything seems to be fine...
                $game_fields['game_id'] = $game_id;
                $game_fields['user_id'] = $current_user_id;
                $game_fields['last_step'] = $current_step;

                // Update points
                $game_fields['score'] = $points;



                
                $game_fields['user_data'] = $args['form_data']['data']['game_point']['game_props']['value'];
                // Insert history entry
                //var_dump('game_fields-->',$game_fields);
                $wpdb->insert($wpdb->prefix."game_history", $game_fields);
            }
        }  else {
            // Data corruption (more than one game with same ID)
            //print("409 Conflict");
        }
    }