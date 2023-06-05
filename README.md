# Storage Info

![image preview of widget](https://github.com/NeoIsRecursive/statamic-storage-info/blob/main/misc/storage-info.png)

## Features

This addon does:

- Shows asset containers files and storage used

## How to Install

You can search for this addon in the `Tools > Addons` section of the Statamic control panel and click **install**, or run the following command from your project root:

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
