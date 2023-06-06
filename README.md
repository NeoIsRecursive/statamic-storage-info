# Storage Info

![image](https://github.com/NeoIsRecursive/statamic-storage-info/assets/64473191/166c628b-844c-4ce4-b023-3134c3127b90)

## Features

This addon does:

- Shows asset containers files and storage used

## How to Install

Run the following command from your project root:

``` bash
composer require neoisrecursive/statamic-storage-info
```

## How to Use

in `config('statamic.cp')` add new widget with type of storage info :)

```php
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
