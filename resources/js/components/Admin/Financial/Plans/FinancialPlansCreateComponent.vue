<template>
    <div class="card">
        <div class="card-header">
            <h4>Cadastrar novo plano</h4>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-center">
                <form method="POST" action="" @submit.prevent="save()" class="col-lg-8 col-md-10 col-sm-12"
                    autocomplete="off">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input type="text" class="form-control" id="name" v-model="plan.name" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="price">Preço</label>
                                <input type="number" min="0.00" max="10000.00" step="0.01" class="form-control"
                                    id="price" v-model="plan.price" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="description">Descrição</label>
                                <input type="text" class="form-control" id="description" v-model="plan.description"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="duration">Duração</label>
                                <input type="text" class="form-control" id="duration" v-model="plan.duration" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label for="features">Features</label>
                                <div v-for="(feature, index) in plan.features" :key="index" class="input-group mb-2">
                                    <input type="text" class="form-control" v-model="plan.features[index]" required>
                                    <div class="input-group-append">
                                        <button v-show="index != 0" type="button" @click="removeRow(index)"
                                            class="btn btn-secondary">-</button>
                                    </div>
                                </div>
                                <div class="input-group mb-2">
                                    <a @click="addRow" class="btn btn-primary">+</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-sm-6 col-12 mb-3 mb-sm-0">
                            <a :href="urlIndexPlans" class="btn btn-secondary btn-sm w-100">Voltar</a>
                        </div>
                        <div class="col-sm-6 col-12">
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
        urlIndexPlans: String,
    },
    data() {
        return {
            plan: {
                name: '',
                price: '',
                description: '',
                duration: '',
                features: [''],
            },
        };
    },
    methods: {
        save() {
            const cleanedFeatures = this.plan.features.filter(feature => feature.trim() !== '');

            const payload = {
                ...this.plan,
                features: cleanedFeatures,
            };

            axios.post('/admin/financial/plan/store', payload)
                .then((response) => {
                    this.$showWidget('Operação realizada com sucesso!', true);
                    this.limparForm();
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
                });
        },
        addRow() {
            this.plan.features.push('');
        },
        removeRow(index) {
            this.plan.features.splice(index, 1);
        },
        limparForm() {
            this.plan.name = '';
            this.plan.price = '';
            this.plan.description = '';
            this.plan.duration = '';
            this.plan.features = [];
        }
    }
}
</script>