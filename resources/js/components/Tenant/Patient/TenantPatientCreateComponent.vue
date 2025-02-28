<template>
    <div class="card">
        <div class="card-header">
            <h4>Cadastrar novo paciente</h4>
        </div>

        <!-- <Notifications  :status-type="true" :message="'opa opa'" /> -->

        <div class="card-body">
            <div class="d-flex justify-content-center">
                <form method="POST" action="" @submit.prevent="save()" class="col-lg-8" autocomplete="off">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nome completo</label>
                                <input type="text" class="form-control" v-model="patient.full_name" required>
                            </div>
                            <div class="form-group">
                                <label>CPF</label>
                                <input type="text" class="form-control" v-model="patient.cpf" required
                                    v-mask="'###.###.###-##'">
                            </div>
                            <div class="form-group">
                                <label>E-mail</label>
                                <input type="email" class="form-control" v-model="patient.email" @input="validateEmail"
                                    required>
                                <div v-if="validEmail === false" class="alert alert-danger mt-3" role="alert">
                                    E-mail inválido
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Grupo</label>
                                <select class="form-select form-control" v-model="patient.group" required>
                                    <option v-for="(label, key) in getGroups" :value="key">{{ label }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Sexo</label>
                                <select class="form-select form-control" v-model="patient.gender" required>
                                    <option value="F">Feminino</option>
                                    <option value="M">Masculino</option>
                                    <option value="other">Outros</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Idade</label>
                                <input type="number" class="form-control" v-model="patient.age" min="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Telefone</label>
                                <input type="text" class="form-control" v-model="patient.phone"
                                    v-mask="['(##) ####-####', '(##) #####-####']" required>
                            </div>
                            <div class="form-group">
                                <label>Responsável (se menor)</label>
                                <input type="text" class="form-control" v-model="patient.guardian_name">
                            </div>
                            <div class="form-group">
                                <label>Telefone do responsável</label>
                                <input type="text" class="form-control" v-model="patient.guardian_phone"
                                    v-mask="['(##) ####-####', '(##) #####-####']">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Contato de emergência</label>
                                <input type="text" class="form-control" v-model="patient.emergency_contact" required>
                            </div>
                            <div class="form-group">
                                <label>Telefone de emergência</label>
                                <input type="text" class="form-control" v-model="patient.emergency_phone"
                                    v-mask="['(##) ####-####', '(##) #####-####']" required>
                            </div>
                            <div class="form-group">
                                <label>Plano de pagamento</label>
                                <select class="form-select form-control" v-model="patient.payment_plan">
                                    <option value="single">Pagamento único</option>
                                    <option value="monthly">Mensal</option>
                                    <option value="semiannual">Semestral</option>
                                    <option value="annual">Anual</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Observações</label>
                                <textarea class="form-control" v-model="patient.notes" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-sm-6 text-start">
                            <a :href="urlIndexPatient" class="btn btn-secondary btn-sm">Voltar</a>
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
import Notifications from '../../Notifications.vue';

export default {
    components: { Notifications },
    props: {
        urlIndexPatient: String,
    },
    data() {
        return {
            patient: {
                group: 'adult',
                gender: 'F',
                age: null,
                full_name: '',
                cpf: '',
                email: '',
                phone: '',
                guardian_name: '',
                guardian_phone: '',
                emergency_contact: '',
                emergency_phone: '',
                payment_plan: 'monthly',
                notes: ''
            },
            validEmail: null,
            tenant: tenant,
        };
    },
    computed: {
        getGroups() {
            return {
                "child": 'Criança',
                "teen": 'Adolescente',
                "adult": 'Adulto',
                "elderly": 'Idoso',
            };
        },
    },
    methods: {
        validateEmail() {
            const emailPattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            this.validEmail = emailPattern.test(this.patient.email);
        },
        save() {
            axios.post(this.tenant + '/patients/store', this.patient)
                .then(() => {
                    showNotification(true, 'Paciente cadastrado com sucesso');
                    window.scrollTo(0, 0);
                    Object.assign(this.$data.patient, this.$options.data().patient);
                })
                .catch(() => {
                    showNotification(false, 'Erro ao carregar os dados.');
                });
        }
    }
}
</script>
