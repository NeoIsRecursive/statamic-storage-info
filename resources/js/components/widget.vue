<template>
  <div class="card p-0 overflow-hidden">
    <h2 class="p-4">
      <a :href="assetsRoute" class="flex items-center">
        <svg-icon name="light/assets" class="h-6 w-6 mr-2 text-gray-800" />
        <span>Storage</span>
      </a>
    </h2>
    <div v-if="loading" class="flex justify-center">
      <loading-graphic :inline="true" :size="22" />
    </div>
    <div v-if="error" class="flex justify-center">
      <p>Something went wrong</p>
    </div>

    <data-list
      :visible-columns="columns"
      :columns="columns"
      :rows="items"
      v-show="items.length"
    >
      <data-list-table>
        <template slot="cell-name" slot-scope="{ row: container }">
          <a :href="container.url">{{ container.name }}</a>
        </template>
      </data-list-table>
    </data-list>
  </div>
</template>

<script>
import Listing from "../../../vendor/statamic/cms/resources/js/components/Listing.vue";

export default {
  props: {
    assetsRoute: String,
    containersString: String,
    storageInfoRoute: String,
  },
  mixins: [Listing],
  computed: {
    requestUrl() {
      return this.storageInfoRoute;
    },
  },
};
</script>
