<template>
    <div class="card p-0 overflow-hidden">
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
        <div class="card-body flex flex-col content py-4 text-sm">
            <table class="w-full table-auto">
                <thead class="px-4 font-medium">
                    <tr>
                        <td class="px-4">Container</td>
                        <td>Assets</td>
                        <td class="pl-4">Unused</td>
                        <td class="px-4 text-right whitespace-nowrap">Space used</td>
                    </tr>
                </thead>
                <tbody v-for="container in containers">
                    <tr class="hover:bg-[rgb(250,252,255)]">
                        <td class="px-4 py-1 w-full"><a class="mb-0" :href="container.url">{{ container.name }}
                            </a></td>
                        <td class="font-mono">{{ container.files }}</td>
                        <td class="font-mono pl-4">{{ container.unused }}</td>
                        <td class="font-mono w-fit whitespace-nowrap text-right px-4">{{ container.spaceUsed }}</td>
                    </tr>
                </tbody>
            </table>
            <div v-if="loading" class="flex justify-center">
                <loading-graphic :inline="true" :size="22" />
            </div>
            <div v-if="error" class="flex justify-center">
                <p>Something went wrong</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        'assetsRoute': String,
        'containersString': String,
        'storageInfoRoute': String
    },
    data() {
        return {
            containers: [],
            loading: true,
            error: false
        }
    },
    mounted() {
        this.getContainers(this.storageInfoRoute, this.containersString);
    },
    methods: {
        async getContainers(route, containers) {
            const params = new URLSearchParams();

            for (const [key, container] of containers.split(',').entries()) {
                params.append(`containers[${key}]`, container);
            }

            try {
                const res = await fetch(`${route}?${params.toString()}`)
                const data = await res.json();
                this.loading = false;
                this.containers = data
            } catch (e) {
                this.error = true;
                this.loading = false;
                console.error(e);
            }

        }
    }
}
</script>