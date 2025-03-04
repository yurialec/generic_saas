<template>
    <div class="card">
        <div class="card-header">
            <h4>Cadastrar novo paciente</h4>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-center">
                <form method="POST" action="" @submit.prevent="save()" class="col-lg-8 col-12" autocomplete="off">
                    <!-- Primeira linha de campos -->
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group mb-3">
                                <label>Nome completo</label>
                                <input type="text" class="form-control" v-model="patient.full_name" required>
                            </div>
                            <div class="form-group mb-3">
                                <label>CPF</label>
                                <input type="text" class="form-control" v-model="patient.cpf" required
                                    v-mask="'###.###.###-##'">
                            </div>
                            <div class="form-group mb-3">
                                <label>E-mail</label>
                                <input type="email" class="form-control" v-model="patient.email" @input="validateEmail"
                                    required>
                                <div v-if="validEmail === false" class="alert alert-danger mt-3" role="alert">
                                    E-mail inválido
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group mb-3">
                                <label>Grupo</label>
                                <select class="form-select form-control" v-model="patient.group" required>
                                    <option v-for="(label, key) in getGroups" :value="key">{{ label }}</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label>Sexo</label>
                                <select class="form-select form-control" v-model="patient.gender" required>
                                    <option v-for="(label, key) in getGender" :value="key">{{ label }}</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label>Idade</label>
                                <input type="number" class="form-control" v-model="patient.age" min="0" required>
                            </div>
                        </div>
                    </div>

                    <!-- Segunda linha de campos -->
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group mb-3">
                                <label>Telefone</label>
                                <input type="text" class="form-control" v-model="patient.phone"
                                    v-mask="['(##) ####-####', '(##) #####-####']" required>
                            </div>
                            <div class="form-group mb-3">
                                <label>Responsável (se menor)</label>
                                <input type="text" class="form-control" :require="patient.age < 18"
                                    v-model="patient.guardian_name">
                            </div>
                            <div class="form-group mb-3">
                                <label>Telefone do responsável</label>
                                <input type="text" class="form-control" :require="patient.age < 18"
                                    v-model="patient.guardian_phone" v-mask="['(##) ####-####', '(##) #####-####']">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group mb-3">
                                <label>Contato de emergência</label>
                                <input type="text" class="form-control" v-model="patient.emergency_contact" required>
                            </div>
                            <div class="form-group mb-3">
                                <label>Telefone de emergência</label>
                                <input type="text" class="form-control" v-model="patient.emergency_phone"
                                    v-mask="['(##) ####-####', '(##) #####-####']" required>
                            </div>
                            <div class="form-group mb-3">
                                <label>Plano de pagamento</label>
                                <select class="form-select form-control" v-model="patient.payment_plan" required>
                                    <option v-for="(label, key) in getPayment" :value="key">{{ label }}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Textarea para observações -->
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label>Observações</label>
                                <textarea class="form-control" v-model="patient.notes" rows="3"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Botões -->
                    <div class="row mt-4">
                        <div class="col-sm-6 col-12 text-start mb-2 mb-sm-0">
                            <a :href="urlIndexPatient" class="btn btn-secondary btn-sm w-100">Voltar</a>
                        </div>
                        <div class="col-sm-6 col-12 text-end">
                            <button class="btn btn-primary btn-sm w-100" type="submit">Cadastrar</button>
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
        urlIndexPatient: String,
    },
    data() {
        return {
            patient: {
                group: 'adult',
                gender: 'F',
                age: 20,
                full_name: 'teste',
                cpf: '030.471.691-01',
                email: 'yuri.alec@hotmail.com',
                phone: '616161616161',
                guardian_name: 'teste',
                guardian_phone: '616161616161',
                emergency_contact: 'TESTE',
                emergency_phone: '616161616161',
                payment_plan: 'monthly',
                notes: 'TESTETSETSTE'
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
        getGender() {
            return {
                "F": "Feminino",
                "M": "Masculino",
                "other": "Outros",
            }
        },
        getPayment() {
            return {
                "single": "Pagamento único",
                "monthly": "Mensal",
                "semiannual": "Semestral",
                "annual": "Anual",
            }
        }
    },
    methods: {
        validateEmail() {
            const emailPattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            this.validEmail = emailPattern.test(this.patient.email);
        },
        save() {
            axios.post(this.tenant + '/patients/store', this.patient)
                .then((response) => {
                    this.$showWidget('Operação realizada com sucesso!', true);
                    window.scrollTo(0, top);
                })
                .catch((errors) => {

                    if (errors.response && errors.response.data.errors) {
                        const errorMessages = Object.values(errors.response.data.errors).flat();
                        errorMessages.forEach(message => {
                            this.$showWidget(message, false);
                        });
                    } else {
                        this.$showWidget('Ocorreu um erro inesperado.', false);
                    }

                    window.scrollTo(0, top);
                })
                .finally(() => {

                });
        }
    }
}
</script>
