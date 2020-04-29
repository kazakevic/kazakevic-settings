<ul class="flex">
    <li class="mr-3 mt-2">
        <router-link to="/">
            <a href="#"
               class="inline-block border border-white rounded hover:border-gray-200 text-blue-500 hover:bg-gray-200 py-1 px-3"
            >Settings</a>
        </router-link>
        <router-link to="/settings/create">
            <a href="#"
               class="inline-block border border-white rounded hover:border-gray-200 text-blue-500 hover:bg-gray-200 py-1 px-3"
            >Create Setting</a>
        </router-link>
    </li>
    <li class="flex justify-end mt-2">
        <input v-model="searchQuery"
               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="setting-search" type="text" placeholder="Search"
        >
    </li>
</ul>
