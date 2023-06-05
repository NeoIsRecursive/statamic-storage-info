<template>
    <div class="card p-0">
        <div class="flex justify-between items-center p-4 pb-0">
            <h2><a :href="assetsRoute" class="flex items-center">
                    <div class="h-6 w-6 mr-2 text-gray-800"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                d="m15.543 15.543-2.628-6.571c-.2-.511-.558-.519-.785-.018l-2.087 4.589-1.859-2.231a.667.667 0 0 0-1.155.089l-2.486 4.142">
                            </path>
                            <rect width="17" height="17" x="1.543" y="1.543" fill="none" stroke="currentColor"
                                stroke-linecap="round" stroke-linejoin="round" rx="1" ry="1"></rect>
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                d="m20.551 7.424 1 .091a1 1 0 0 1 .901 1.085l-1.181 12.948a1 1 0 0 1-1.087.9L6.243 21.18m-4.7-5.637h17">
                            </path>
                            <circle cx="6.043" cy="6.043" r="1.5" fill="none" stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round"></circle>
                        </svg></div>
                    <span>Storage</span>
                </a></h2>
        </div>
        <div v-if="loading" class="flex justify-center">
            <loading-graphic :inline="true" :size="22" />
        </div>
        <div class="card-body p-4 flex flex-col content" v-for="container in containers">
            <div class="flex justify-between items-center mt-2">
                <p class="mb-0">name</p>
                <div class="flex">
                    <p class="mb-0">files</p>
                    <p class="mb-0 ml-2">size</p>
                </div>
            </div>
            <div class="flex justify-between items-center mt-2">
                <a class="mb-0" :href="container.url">
                    <h4></h4>
                </a>
                <div class="flex">
                    <p class="mb-0">files</p>
                    <p class="mb-0 ml-2">space used</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: [
        'assetsRoute',
        'containers',
        'storageInfoRoute'
    ],
    data() {
        return {
            containers: [],
            loading: false,
            error: false
        }
    },
    mounted: () => {
        this.getContainers();
    },
    methods: {
        async getContainers(route, containers) {
            const params = new URLSearchParams();

            for (const container of containers.split(',')) {
                params.append('containers', container);
            }

            try {
                const res = await fetch(`${route}?${params.toString()}`)
                const data = await res.json();
                this.loading = false;
                this.containers = data;
            } catch (e) {
                this.error = true;
                console.error(e);
            }

        }
    }
}
</script>