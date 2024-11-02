<?php

return array(
    '^$' => 'Site/Index',//Домашняя страница
    '^([0-9a-z-]+)$' => '$1/Index', // Перенаправление на actionIndex Controller/ActionIndex
    '^([0-9a-z-]+)/([0-9a-z-]+)$' => '$1/$2', // Controller/Action
    '^([0-9a-z-]+)/editfill/([0-9]+)' => '$1/editFill/$2', //Controller/EditFill/Param1
    '^([0-9a-z-]+)/print/([0-9]+)' => '$1/print/$2', //Controller/print/Param1
    '^([0-9a-z-]+)/([0-9a-z-]+)/page-([0-9]+)' => '$1/$2/$3', //Controller/Action/Param1
);
