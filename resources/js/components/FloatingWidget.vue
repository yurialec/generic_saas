<template>
    <div class="widget-container">
        <div v-if="visible" :class="['floating-widget', type]">
            {{ message }}
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            visible: false,
            message: '',
            type: ''
        };
    },
    methods: {
        show(message, isSuccess) {
            this.message = message;
            this.type = isSuccess ? 'success' : 'error';
            this.visible = true;

            setTimeout(() => {
                this.visible = false;
            }, 3000);
        }
    }
};
</script>

<style scoped>
.widget-container {
    position: relative;
    z-index: 9999;
}

.floating-widget {
    position: fixed;
    top: 20px;
    left: 50%;
    transform: translateX(-50%);
    padding: 15px;
    color: white;
    border-radius: 5px;
    text-align: center;
    min-width: 300px;
}

.success {
    border-color: #2ed573;
    background: #e3f9e5;
    color: #2ed573;
    border-style: solid;
    border-radius: 10px;
    border-width: thin;
}

.error {
    border-color: #ff4757;
    background: #ffe0e3;
    color: #ff4757;
    border-style: solid;
    border-radius: 10px;
    border-style: solid;
    border-width: thin;
}
</style>