<template>
    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-12 col-md-3 text-md-left text-center mb-2 mb-md-0">
                    <h3>Planos</h3>
                </div>
                <div class="col-12 col-md-6 text-center mb-2 mb-md-0">
                    <div class="input-group">
                        <input type="text" class="form-control" v-model="searchFilter" />
                        <button type="button" class="btn btn-primary" @click="pesquisar()">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
                <div class="col-12 col-md-3 text-md-end">
                    <a :href="urlCreatePlan" class="btn btn-primary btn-sm">Cadastrar</a>
                </div>
            </div>
        </div>
        <div v-if="!plans.data.length" class="card-body text-center">
            <h5>Nenhum resultado encontrado</h5>
        </div>
        <div v-else class="card-body">
            <div v-if="loading" class="d-flex justify-content-center">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden"></span>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-sm table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="plan in plans.data" :key="plan.id">
                            <th scope="row">{{ plan.id }}</th>
                            <td>{{ plan.name }}</td>
                            <td>
                                <a href="#">
                                    <i class="bi bi-pencil-square text-warning"></i>
                                </a>
                                &nbsp;&nbsp;&nbsp;
                                <button type="button" class="btn p-0" @click="deletePlan(plan)" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    <i class="bi bi-trash3 text-danger"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer" v-if="plans.data.length">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li v-for="(link, key) in plans.links" :key="key" class="page-item"
                        :class="{ 'active': link.active }">
                        <a class="page-link" href="#" @click.prevent="pagination(link.url)" v-html="link.label"></a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-sm">
                <!-- <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmação de Exclusão</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> -->
                <div class="modal-body">
                    Tem certeza que deseja ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary btn-sm" @click="disable">Confirmar</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { Modal } from 'bootstrap';

export default {
    props: {
        urlCreatePlan: String,
    },
    data() {
        return {
            plans: {
                data: [],
                links: []
            },
            searchFilter: '',
            planToDelete: null,
            alertStatus: null,
            msg: [],
            loading: null,
        };
    },
    mounted() {
        this.getPlans();
    },
    methods: {
        pesquisar() {
            this.getPlans('/admin/financial/plan/list', this.searchFilter);
        },
        pagination(url) {
            if (url) {
                this.getPlans(url);
            }
        },
        getPlans() {
            this.loading = true;
            let url = '/admin/financial/plan/list';
            axios.get(url)
                .then(response => {
                    this.plans = response.data.plans;
                })
                .catch(errors => {
                    console.log(errors);
                }).finally(() => {
                    this.loading = false
                });
        },
        deletePlan(plan) {
            this.planToDelete = plan;
        },
        disable() {
            if (this.planToDelete !== null) {
                this.loading = true;
                axios.post('/plans/disable', { plan: this.planToDelete })
                    .then(response => {
                        this.getPlans();
                        this.planToDelete = null;

                        const modal = Modal.getInstance(document.getElementById('exampleModal'));
                        if (modal) {
                            modal.hide();
                        }

                        this.$showWidget('Operação realizada com sucesso!', true);
                        window.scrollTo(0, top);
                    })
                    .catch(errors => {
                        const modal = Modal.getInstance(document.getElementById('exampleModal'));
                        if (modal) {
                            modal.hide();
                        }

                        if (errors.response && errors.response.data.errors) {
                            const errorMessages = Object.values(errors.response.data.errors).flat();
                            errorMessages.forEach(message => {
                                this.$showWidget(message, false);
                            });
                        } else {
                            this.$showWidget('Ocorreu um erro inesperado.', false);
                        }
                    }).finally(() => {
                        this.loading = false
                    });
            }
        },
    }
}
</script>