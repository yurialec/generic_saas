<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a :href="urlDashboard" class="brand-link">
            <img src="https://upload.wikimedia.org/wikipedia/commons/3/36/Logo.min.svg" alt="AdminLTE Logo"
                class="brand-image" style="opacity: .8">
            <span class="brand-text font-weight-light">PSYCOSE</span>
        </a>
        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info">
                    <a href="#" class="d-block">Meu Perfil</a>
                </div>
            </div>
            <nav class="mt-2">
                <ul v-for="item in this.menuItems" class="nav nav-pills nav-sidebar flex-column" data-widget="treeview"
                    role="menu">
                    <li class="nav-item">
                        <a :href="item.url" class="nav-link">
                            <i :class="item.icon"></i>
                            <p>{{ item.name }}</p>
                        </a>
                    </li>
                </ul>
            </nav>

        </div>
    </aside>
</template>

<script>

export default {
    props: {
        user: Object,
        urlDashboard: String,
    },
    data() {
        return {
            loading: false,
            menuItems: [],
        };
    },
    created() {
    },
    mounted() {
        this.getMenuItems();
    },
    methods: {
        getMenuItems() {
            this.loading = true;

            const urlPath = window.location.pathname;
            const partes = window.location.pathname.split("/");

            axios.get('/' + partes[1] + '/get-menu')
                .then(response => {
                    this.menuItems = response.data;
                })
                .catch(errors => {
                    
                }).finally(() => {
                    this.loading = false
                });
        }
    }
}
</script>