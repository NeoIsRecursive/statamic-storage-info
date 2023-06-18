# Storage Info

![image](https://github.com/NeoIsRecursive/statamic-storage-info/assets/64473191/355c30c0-b593-480e-9db8-d2fb1b74d39f)

## Features

This addon adds a widget that displays

- Asset Containers (that you specify in the widget)
- Files on the disk
- Bytes used by files
- Unused files

In a nice table 🔥

Also works with s3 *(image is from an old unreleased version)*: 

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
