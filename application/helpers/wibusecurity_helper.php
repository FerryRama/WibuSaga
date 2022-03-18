<?php

function user_security()
{
    $ci = get_instance();
    if (!$ci->session->userdata('userID')) {
        redirect('auth');
    }
}
