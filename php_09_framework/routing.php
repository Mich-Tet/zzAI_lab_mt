<?php

use core\App;
use core\Utils;

App::getRouter()->setDefaultRoute('calc'); #default action
App::getRouter()->setLoginRoute('login'); #action to forward if no permissions

Utils::addRoute('calc', 'CalcCtrl');
Utils::addRoute('login', 'SecurityCtrl', [], 'login');   
Utils::addRoute('logout', 'SecurityCtrl', [], 'logout');  
Utils::addRoute('secured', 'SecurityCtrl', [], 'secured');