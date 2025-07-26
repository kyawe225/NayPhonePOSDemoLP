<?php

namespace App\Repository\Interface;

interface IAuthRepository
{
    function register(array $register);
    function login(array $register);
}

?>