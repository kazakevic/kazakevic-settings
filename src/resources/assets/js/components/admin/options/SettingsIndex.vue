<template>
    <div>
        <div class="form-group">
        </div>
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Settings</th>
                <th>Actions</th>
                <th width="100">
                    <i class="fas fa-spinner fa-spin" v-if="loading"></i>
                </th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(option, index) in options">
                <td>{{ option.key }}</td>
                <td>{{ typeToString(option.type) }}</td>
                <td>
                    <div v-if="option.type === 0">
                        <div class="custom-control custom-switch">
                            <input type="checkbox"
                                   class="custom-control-input"
                                   :id="'toggle-'+option.id"
                                   v-model="option.value"
                                   @click="toggleOption(option)">
                            <label class="custom-control-label" :for="'toggle-'+option.id">{{ option.value }}</label>
                        </div>
                    </div>
                    <span v-if=" option.type !== 0 ">
                        <small>
                            {{ option.value }}
                        </small>
                    </span>
                </td>
                <td>
                    <router-link :to="{name: 'optionEdit', params: {id: option.id}}">
                        <button class="btn btn-primary btn-sm">e</button>
                    </router-link>
                    <button class="btn btn-danger btn-sm" v-on:click="deleteEntry(option.id, index)">
                        x
                    </button>
                </td>
            </tr>
            </tbody>
        </table>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li
                    class="page-item"
                    v-for="(page, index) in getPagesArray(pagination.total, pagination.per_page)"
                >
                    <a class="page-link" href="#" @click="setCurrentPage(page)">{{ page }}</a>
                </li>
            </ul>
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
                    "total": 0,
                    "per_page": 0,
                    "last_page": 0,
                    "first_page_url": "",
                    "last_page_url": "",
                    "next_page_url": "",
                    "prev_page_url": null,
                    "path": "",
                    "from": 1,
                    "to": 15,
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
