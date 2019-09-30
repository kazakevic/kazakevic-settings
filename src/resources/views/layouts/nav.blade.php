<nav class="navbar navbar-light bg-light">
    <form class="form-inline">
        <router-link to="/">
            <a href="#" class="btn btn-outline-info btn-sm mr-2">Settings</a>
        </router-link>
        <router-link to="/settings/create">
            <a href="#" class="btn btn-outline-success btn-sm mr-2">Create Setting</a>
        </router-link>
    </form>
    <form class="form-inline">
        <input class="form-control mr-sm-2" type="search" v-model="settingSearch" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit" @click="searchByQuery()">Search</button>
    </form>
</nav>
