<ul class="flex ml-2">
    <li class="mr-3 mt-2">
        <router-link to="/">
            <a href="#"
               class="inline-block border border-blue-200 rounded hover:border-blue-600 text-black-500 hover:bg-blue-300 py-1 px-3"
            >Settings</a>
        </router-link>
        <router-link to="/settings/create">
            <a href="#"
               class="inline-block border border-green-200 rounded hover:border-green-600 text-black-500 hover:bg-green-300 py-1 px-3"
            >Create Setting</a>
        </router-link>
    </li>
    <li class="flex justify-end mt-2">
        <input v-model="searchQuery"
               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="setting-search" type="text" placeholder="Search"
        >
    </li>
</ul>
