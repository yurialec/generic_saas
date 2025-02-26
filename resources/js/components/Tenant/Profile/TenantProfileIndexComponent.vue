<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title mb-0">Perfil do Usuário</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <h4>{{ user.name }}</h4>
                                <p class="text-muted">{{ user.function }}</p>
                            </div>
                            <div class="col-md-8">
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <strong>Email:</strong>
                                    </div>
                                    <div class="col-sm-8">
                                        {{ user.email }}
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <strong>CPF:</strong>
                                    </div>
                                    <div class="col-sm-8">
                                        {{ user.cpf }}
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <strong>Telefone:</strong>
                                    </div>
                                    <div class="col-sm-8">
                                        {{ user.phone }}
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <strong>Função:</strong>
                                    </div>
                                    <div class="col-sm-8">
                                        {{ user.function }}
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <strong>Papel:</strong>
                                    </div>
                                    <div class="col-sm-8">
                                        {{ user.role.name }}
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <strong>Permissões:</strong>
                                    </div>
                                    <div class="col-sm-8">
                                        <ul class="list-unstyled">
                                            <li v-for="permission in user.role.permissions" :key="permission.id">
                                                {{ permission.label }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <strong>Membro desde:</strong>
                                    </div>
                                    <div class="col-sm-8">
                                        {{ new Date(user.created_at).toLocaleDateString() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        user: Object,
    },
    data() {
        return {
            loading: false,
        };
    },
    created() {
    },
    mounted() {
    },
    methods: {

    }
}
</script>

<style scoped>
.card {
    border: none;
    border-radius: 10px;
}

.card-header {
    border-radius: 10px 10px 0 0;
}

.list-unstyled {
    margin-bottom: 0;
}
</style>