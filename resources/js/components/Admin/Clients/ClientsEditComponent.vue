<template>
    <div class="card">
        <div class="card-header">
            <h4>Editar Cliente</h4>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-center">
                <form method="POST" action="" @submit.prevent="save()" class="col-lg-8" autocomplete="off">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nome</label>
                                <input type="text" class="form-control" v-model="client.name" required>
                            </div>
                            <div class="form-group">
                                <label>CPF</label>
                                <input type="text" class="form-control" v-model="client.cpf" required
                                    v-mask="'###.###.###-##'">
                            </div>
                            <div class="form-group">
                                <label>E-mail</label>
                                <input type="text" class="form-control" v-model="client.email" @input="validateEmail"
                                    autocomplete="off" required>
                                <div v-if="validEmail === false" class="alert alert-danger mt-3" role="alert">E-mail
                                    inválido.</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Telefone</label>
                                <input type="text" class="form-control" v-model="client.phone"
                                    v-mask="['(##) ####-####', '(##) #####-####']" required>
                            </div>
                            <div class="form-group">
                                <label>Cargo/Função</label>
                                <input type="text" class="form-control" v-model="client.function" required>
                            </div>
                            <div class="form-group">
                                <label>CRP</label>
                                <input type="text" class="form-control" v-model="client.tenant.domain"
                                    v-mask="'01/#####'" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-sm-6 text-start">
                            <a :href="urlIndexClient" class="btn btn-secondary btn-sm">Voltar</a>
                        </div>
                        <div class="col-sm-6 text-end">
                            <button class="btn btn-primary btn-sm" type="submit">Cadastrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: {
        id: Number,
        urlIndexClient: String,
    },
    data() {
        return {
            client: {
                cpf: '',
                created_at: '',
                email: '',
                function: '',
                name: '',
                phone: '',
                role: {
                    id: '',
                    name: '',
                    permissions: '',
                },
                tenant: {
                    domain: '',
                }
            },
            validEmail: null,
            loading: null,
        };
    },
    mounted() {
        this.getClientById();
    },
    methods: {
        validateEmail() {
            const emailPattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            this.validEmail = emailPattern.test(this.client.email);
        },
        getClientById() {
            this.loading = true;
            axios.get('/admin/clients/get-client-by-id/' + this.id)
                .then(response => {
                    this.client = response.data.client;
                })
                .catch(errors => {
                    this.$showWidget('Erro!', false);
                }).finally(() => {
                    this.loading = false;
                });
        },
        save() {
            axios.put('/admin/clients/update/' + this.id, this.client)
                .then(response => {
                    this.$showWidget('Cliente alterado com sucessoce!', true);
                })
                .catch(errors => {
                    this.$showWidget('Erro ao editar cliente!', false);
                });
        },
        changePass() {
            this.changePassword = !this.changePassword;
            if (!this.changePassword) {
                this.client.password = '';
                this.confirmPassword = '';
            }
        },
        passwordCheck() {
            if (this.client.password) {
                this.has_number = /\d/.test(this.client.password);
                this.has_lowercase = /[a-zA-Z]/.test(this.client.password);
                this.has_special = /[!@#\$%\^\&*\)\(+=._-]/.test(this.client.password);
                this.has_six_chars = this.client.password.length >= 6;
            }
        },
        showPassword() {
            this.inputPass = !this.inputPass;
        },
    }
}
</script>
