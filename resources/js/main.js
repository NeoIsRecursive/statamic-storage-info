import StorageInfoWidget from './components/widget.vue';

console.log("hello");

Statamic.booting(() => {
    Statamic.$components.register('storage-info-widget', StorageInfoWidget);
});