<?php

    function redirect_to($args) {
    ?>
        <script type="text-javascript">
    <?php
        foreach($args['form_data']['data']['game_actions'] as $button) {
    ?>
            $('#'+<?php print($button['id']); ?>).click(function() {
                window.location.href = '/?p='+<?php print($button['args']['redirect_to']); ?>;
                return false;
            });
    <?php        
        }
    }