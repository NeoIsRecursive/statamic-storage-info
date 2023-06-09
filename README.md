# Storage Info

![image](https://github.com/NeoIsRecursive/statamic-storage-info/assets/64473191/5019b9f4-90d5-4595-a467-6242db66b1ed)


## Features

This addon adds a widget that displays
- Disks (that you specify in the widget)
- Files on the disk
- Bytes used by files
- Unused files

In a nice table 🔥

Also works with s3:

![image](https://github.com/NeoIsRecursive/statamic-storage-info/assets/64473191/166c628b-844c-4ce4-b023-3134c3127b90)

## How to Install

Run the following command from your project root:

``` bash
composer require neoisrecursive/statamic-storage-info
```

## How to Use

in `config('statamic.cp')` add new widget with type of storage info :)

``` php
    'widgets' => [
        [
            'type' => 'storage_info',
            'containers' => [
                'assets'
                ...all-asset-container-handles-you-want-to-include
            ]
        ]
    ],
```
