<template>
    <div>
        <div class="card">
            <div class="card-header">
                Create new option
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <form v-on:submit="saveForm($event)">
                        <div class="row">
                            <div class="col-xs-12 form-group">
                                <label class="control-label">Option key</label>
                                <input type="text" v-model="option.key" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 form-group">
                                <label class="control-label">Option type</label>
                                <div class="btn-group" role="group">
                                    <button
                                        v-for="(type, index) in types"
                                        type="button"
                                        class="btn btn-outline-primary"
                                        v-bind:class="{ active: option.type === index }"
                                        v-on:click="option.type = index"
                                    >{{ type }}
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 form-group">
                                <div v-if="showTextArea">
                                    <textarea
                                        v-model="option.value"
                                        cols="50"
                                        rows="6"
                                        class="form-control"
                                    ></textarea>
                                </div>
                                <div v-else-if="showSwitch">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="toggle" v-model="option.value">
                                        <label class="custom-control-label" for="toggle">{{ option.value }}</label>
                                    </div>
                                </div>
                                <div v-else>
                                    <input type="text" v-model="option.value" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 form-group">
                                <button class="btn btn-success">Create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                types: ['Bool', 'Int', 'String', 'Object'],
                option: {
                    key: '',
                    value: '',
                    type: 0,
                }
            }
        },
        methods: {
            saveForm(e) {
                e.preventDefault();
                let app = this;
                let newOption = app.option;
                const url = '/adm/api/V1/settings/';
                axios.post(url, newOption)
                    .then(function (resp) {
                        app.$router.push({path: '/'});
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Could not create your option");
                    });
            }
        },
        computed: {
            showTextArea: function () {
                let app = this;
                return app.option.type === 2 || app.option.type === 3;
            },
            showSwitch: function () {
                let app = this;
                return app.option.type === 0;
            }
        }
    }
</script>
