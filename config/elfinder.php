<?php
return array (
    'dir' => array (
        0 => 'storage/',
    ),
    'disks' => array (
    ),
    'route' => array (
        'prefix' => 'elfinder',
        'middleware' => NULL,
    ),
    'access' => 'Barryvdh\\Elfinder\\Elfinder::checkAccess',
    'roots' => array(
        array(
            'driver'     => 'LocalFileSystem',
            'path'       => 'storage/',
            'URL'        => url('storage'),
            'alias'      => 'Storage',
            'mimeDetect' => 'internal',
            'imgLib'     => 'gd',
            'tmbPath'    => '_thumbs',
            'tmbCrop'    => false,
            'defaults'   => array('read' => true, 'write' => true),

            'uploadDeny' => array('application/x-php', 'text/x-php'),
            'uploadOrder' => array('deny', 'allow'),

            'attributes' => array(
                array(
                    'pattern' => '/\.php$/',
                    'read'    => false,
                    'write'   => false,
                    'locked'  => true,
                    'hidden'  => false,
                ),
                array(
                    'pattern' => '/\.tmb$/',
                    'hidden'  => true,
                ),
                array(
                    'pattern' => '/\.gitignore$/',
                    'hidden'  => true,
                ),
                array(
                    'pattern' => '!^/_thumbs!',
                    'hidden' => true
                )
            ),
        ),
    ),
    'options' => array (
    ),
    'root_options' => array (
    ),
);
