<?php

function check_error()
{
        if(isset($_SESSION['error']) && $_SESSION['error'] != "" )
        {
                echo $_SESSION['error'];
                unset($_SESSION['error']);
        }
}