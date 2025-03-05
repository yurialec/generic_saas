<template>
    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-12 col-md-3 text-md-left text-center mb-2 mb-md-0">
                    <h3>Pacientes</h3>
                </div>
                <div class="col-12 col-md-6 text-center mb-2 mb-md-0">
                    <div class="input-group">
                        <input type="text" class="form-control" v-model="searchFilter" />
                        <button type="button" class="btn btn-primary" @click="pesquisar()">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </div>
                <div class="col-12 col-md-3 text-md-end">
                    <a :href="urlCreatePatient" class="btn btn-primary btn-sm">Cadastrar</a>
                </div>
            </div>
        </div>
        <div v-if="!patients.data.length" class="card-body text-center">
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
                            <th scope="col">E-mail</th>
                            <th scope="col">Status</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="patient in patients.data" :key="patient.id">
                            <th scope="row">{{ patient.id }}</th>
                            <td>{{ patient.name }}</td>
                            <td>{{ patient.email }}</td>
                            <td>{{ patient.deleted_at ? 'Desativado' : 'Ativado' }}</td>
                            <td>
                                <a :href="'/' + tenant + '/patients/edit/' + patient.id">
                                    <i class="fa-solid fa-pen-to-square text-warning"></i>
                                </a>
                                &nbsp;&nbsp;&nbsp;
                                <button type="button" class="btn p-0" @click="disablePatient(patient)"
                                    data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i v-if="patient.deleted_at"
                                        class="fa-solid fa-circle-check text-success"></i>&nbsp;
                                    <i v-else class="fa-solid fa-circle-xmark text-danger"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer" v-if="patients.data.length">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li v-for="(link, key) in patients.links" :key="key" class="page-item"
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
        urlCreatePatient: String,
    },
    data() {
        return {
            patients: {
                data: [],
                links: []
            },
            searchFilter: '',
            patientToDisable: null,
            alertStatus: null,
            msg: [],
            loading: null,
            tenant: tenant,
        };
    },
    mounted() {
        this.getPatients();
    },
    methods: {
        pesquisar() {
            this.getPatients(this.tenant + '/patients/list', this.searchFilter);
        },
        pagination(url) {
            if (url) {
                this.getPatients(url);
            }
        },
        getPatients() {
            this.loading = true;
            let url = this.tenant + '/patients/list';
            axios.get(url)
                .then(response => {
                    this.patients = response.data.patients;
                })
                .catch(errors => {
                    console.log(errors);
                }).finally(() => {
                    this.loading = false
                });
        },
        disablePatient(patient) {
            this.patientToDisable = patient;
        },
        disable() {
            if (this.patientToDisable !== null) {
                this.loading = true;
                axios.post('/' + this.tenant + '/patients/disable', { patient: this.patientToDisable })
                    .then(response => {
                        this.getPatients();
                        this.patientToDisable = null;

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