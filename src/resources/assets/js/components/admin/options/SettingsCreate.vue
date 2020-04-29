<template>
    <div class="w-full max-w-xs">
    <form v-on:submit="saveForm($event)" class="w-full max-w-lg">
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="setting-key">
                    Setting key
                </label>
                <input v-model="option.key"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="setting-key" type="text">
            </div>
        </div>

        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                    Type:
                </label>
                <select v-model="option.type"
                        class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                    <option
                            v-for="(type, index) in types"
                            v-bind:value="type.id">
                        {{ type.name }}
                    </option>
                </select>
            </div>
        </div>

        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="setting-value">
                    Value:
                </label>
                <div v-if="showTextArea">
                                    <textarea
                                            name="optionType"
                                            id="setting-value"
                                            cols="50"
                                            rows="6"
                                            v-model="option.value"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    ></textarea>
                </div>
                <div v-else-if="showSwitch">

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
                                @click="option.value = !option.value"
                                class="toggle__line w-10 h-4 bg-gray-400 rounded-full shadow-inner"></div>
                        <!-- dot -->
                        <div
                                @click="option.value = !option.value"
                                class="toggle__dot absolute w-6 h-6 bg-white rounded-full shadow inset-y-0 left-0">
                        </div>
                    </div>
                </div>
                <div v-else>
                    <label class="text-gray-700" for="setting-value-simple"></label>
                    <input type="text" v-model="option.value" class="form-control" id="setting-value-simple">
                </div>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
                <button class="bg-green-400 hover:bg-gray-200 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">Save</button>
            </div>
        </div>
        </form>
    </div>

</template>

<script>
    import settingData from './includes/settingsTypes';
    export default {
        data () {
            return {
                types: settingData.types,
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
