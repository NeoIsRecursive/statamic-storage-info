import StorageInfoWidget from './components/widget.vue';

Statamic.booting(() => {
    Statamic.$components.register('storage-info-widget', StorageInfoWidget);
});