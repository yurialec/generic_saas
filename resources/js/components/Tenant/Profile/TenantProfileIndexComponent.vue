<template>
    <div class="container mt-1">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div v-if="loading" class="d-flex justify-content-center">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden"></span>
                    </div>
                </div>

                <div v-else class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title mb-0">Meu Perfil</h3>
                    </div>
                    <div class="card-body">
                        <!-- Informações Pessoais -->
                        <div class="mb-4">
                            <h5 class="text-primary">Informações Pessoais</h5>
                            <ul class="list-unstyled">
                                <li><strong>Nome:</strong> {{ profile?.name || 'N/A' }}</li>
                                <li><strong>Email:</strong> {{ profile?.email || 'N/A' }}</li>
                                <li><strong>CPF:</strong> {{ profile?.cpf || 'N/A' }}</li>
                                <li><strong>Função:</strong> {{ profile?.function || 'N/A' }}</li>
                                <li><strong>Telefone:</strong> {{ profile?.phone || 'N/A' }}</li>
                            </ul>
                        </div>

                        <!-- Informações da Empresa (Tenant) -->
                        <div class="mb-4">
                            <h5 class="text-primary">Informações da Empresa</h5>
                            <ul class="list-unstyled">
                                <li><strong>Nome da Empresa:</strong> {{ profile?.tenant?.name || 'N/A' }}</li>
                                <li><strong>Domínio:</strong> {{ profile?.tenant?.domain || 'N/A' }}</li>
                                <li><strong>Data de Criação:</strong> {{ formatDate(profile?.tenant?.created_at) ||
                                    'N/A' }}</li>
                            </ul>
                        </div>

                        <!-- Plano Associado -->
                        <div>
                            <h5 class="text-primary">Plano Atual</h5>
                            <ul class="list-unstyled">
                                <li><strong>Nome do Plano:</strong> {{ profile?.tenant?.plan?.name || 'N/A' }}</li>
                                <li><strong>Preço:</strong> {{ formatPrice(profile?.tenant?.plan?.price) || 'N/A' }}
                                </li>
                                <li><strong>Descrição:</strong> {{ profile?.tenant?.plan?.description || 'N/A' }}</li>
                                <li><strong>Duração:</strong> {{ profile?.tenant?.plan?.duration }} {{
                                    profile?.tenant?.plan?.duration_type === 'D' ? 'dias' : 'meses' || 'N/A' }}</li>
                            </ul>
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
        tenant: String,
    },
    data() {
        return {
            profile: {},
            loading: false,
        };
    },
    created() {
    },
    mounted() {
        this.getTenantProfile();
    },
    methods: {
        getTenantProfile() {
            this.loading = true;
            let url = this.tenant + '/view-profile';
            axios.get(url)
                .then(response => {
                    this.profile = response.data.profile || {};
                })
                .catch(errors => {
                    this.$showWidget('Ocorreu um erro ao carregar o perfil.', false);
                }).finally(() => {
                    this.loading = false;
                });
        },
        formatDate(dateString) {
            if (!dateString) return 'N/A';
            const date = new Date(dateString);
            return date.toLocaleDateString('pt-BR', { timeZone: 'UTC' });
        },
        formatPrice(price) {
            if (!price) return 'N/A';
            return `R$ ${parseFloat(price).toFixed(2).replace('.', ',')}`;
        }
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

.text-primary {
    font-weight: bold;
}
</style>