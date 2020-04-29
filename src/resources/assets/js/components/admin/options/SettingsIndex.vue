<template>
    <div>
        <table class="table-auto">
            <thead>
            <tr class="border px-4">
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Type</th>
                <th class="px-4 py-2">Settings</th>
                <th class="px-4 py-2">Actions</th>
                <th class="w-100">
                    <i class="fas fa-spinner fa-spin" v-if="loading"></i>
                </th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(option, index) in options" class="border">
                <td class="px-4 py-2">{{ option.key }}</td>
                <td class="px-4 py-2">{{ typeToString(option.type) }}</td>
                <td class="px-4 py-2">
                    <div v-if="option.type === 0">
                        <!-- Toggle Button -->
                        <label
                                :for="'toggle-'+option.id"
                                class="flex items-center cursor-pointer"
                        ></label>
                            <!-- toggle -->
                            <div class="relative">
                                <!-- input -->
                                <input id="toogleA" type="checkbox" class="hidden"
                                       :id="'toggle-'+option.id"
                                       v-model="option.value"
                                />
                                <!-- line -->
                                <div
                                        @click="toggleOption(option)"
                                        class="toggle__line w-10 h-4 bg-gray-400 rounded-full shadow-inner"></div>
                                <!-- dot -->
                                <div
                                        @click="toggleOption(option)"
                                        class="toggle__dot absolute w-6 h-6 bg-white rounded-full shadow inset-y-0 left-0"
                                >
                                </div>
                            </div>
                    </div>
                    <span v-if=" option.type !== 0 ">
                        <small>
                            {{ option.value }}
                        </small>
                    </span>
                </td>
                <td class="px-4 py-2">
                    <router-link :to="{name: 'optionEdit', params: {id: option.id}}">
                        <button class="bg-blue-400 hover:bg-blue-200 text-blue-800 py-1 px-2 mb-2 border border-gray-100 rounded shadow">
                            <svg class="fill-current w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.3 3.7l4 4L4 20H0v-4L12.3 3.7zm1.4-1.4L16 0l4 4-2.3 2.3-4-4z"/></svg>
                        </button>
                    </router-link>
                    <button class="bg-red-400 hover:bg-red-200 text-gray-800 py-1 px-2 border border-gray-100 rounded shadow" v-on:click="deleteEntry(option.id, index)">
                        <svg class="fill-current w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M0 10l7-7h13v14H7l-7-7zm14.41 0l2.13-2.12-1.42-1.42L13 8.6l-2.12-2.13-1.42 1.42L11.6 10l-2.13 2.12 1.42 1.42L13 11.4l2.12 2.13 1.42-1.42L14.4 10z"/></svg>
                    </button>
                </td>
            </tr>
            </tbody>
        </table>
        <nav aria-label="Page navigation example">
            <div class="inline-flex my-2">
            <button v-for="(page, index) in getPagesArray(pagination.total, pagination.per_page)"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-1 px-2 mx-1 rounded" @click="setCurrentPage(page)">
                {{ page }}
            </button>
            </div>
        </nav>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                options: [],
                loading: false,
                items: [],
                current_page: 1,
                pagination: {
                    total: 0,
                    per_page: 0,
                    last_page: 0,
                    first_page_url: '',
                    last_page_url: '',
                    next_page_url: '',
                    prev_page_url: null,
                    path: "",
                    from: 1,
                    to: 15,
                },
                settingSearch: ''
            }
        },
        mounted() {
            this.getData();
        },
        methods: {
            getData(page = 1) {
                let app = this;
                const url = '/adm/api/V1/settings/?page=';
                axios.get(url + app.current_page)
                    .then(function (resp) {
                        app.options = resp.data.data;
                        app.pagination.total = resp.data.total;
                        app.pagination.from = resp.data.from;
                        app.pagination.to = resp.data.to;
                        app.pagination.path = resp.data.path;
                        app.pagination.current_page = resp.data.current_page;
                        app.pagination.last_page = resp.data.last_page;
                        app.pagination.per_page = resp.data.per_page;
                    })
                    .catch(function (resp) {
                        console.log('Could not load options');
                    });
            },
            deleteEntry(id, index) {
                if (confirm("Do you really want to delete it?")) {
                    let app = this;
                    const url = '/adm/api/V1/settings/';
                    axios.delete(url + id)
                        .then(function (resp) {
                            app.options.splice(index, 1);
                        })
                        .catch(function (resp) {
                        });
                }
            },
            toggleOption(option) {
                let app = this;
                app.loading = true;
                option.value = !option.value;
                const url = '/adm/api/V1/settings/';
                axios.patch(url + option.id, option)
                    .then(function (resp) {
                        app.loading = false;
                    })
                    .catch(function (resp) {
                    });
            },
            typeToString(type) {
                switch (type) {
                    case 0:
                        return 'Boolean';
                    case 1:
                        return 'Integer';
                    case 2:
                        return 'String';
                    case 3:
                        return 'Object';
                }
            },
            getPagesArray(total, perPage) {
                let pagesCount = Math.ceil(total / perPage);
                let pages = [];
                for (let i = 1; i <= pagesCount; i++ ) {
                    pages.push(i);
                }
                return pages;
            },
            setCurrentPage(page) {
                let app = this;
                app.current_page = page;
                this.getData(page);
            },
            searchByQuery() {
                let app = this;
                console.log(app.settingSearch)
            }
        }
    }
</script>
