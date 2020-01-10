<?php
    return [
        'type'                          => "virtualization",
        'access-hash'                   => false,
        'server-info-checker'           => false,
        'server-info-port'              => true,
        'server-info-not-secure-port'   => 1020,
        'server-info-secure-port'       => 1080,
        'configurable-option-params'    => [
            'Disk Space',
            'RAM',
            'Sample: windows10,windows2008,linux' => 'Operating System',
        ],
    ];