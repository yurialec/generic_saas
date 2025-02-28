<template>
    <transition name="fade">
        <div v-if="visible" :class="['widget-container', statusType ? 'success' : 'error']">
            {{ message }}
        </div>
    </transition>
</template>

<script>
export default {
    props: {
        statusType: Boolean,
        message: String,
    },
    data() {
        return {
            visible: false,
        };
    },
    mounted() {
        this.showWidget();
    },
    methods: {
        showWidget() {
            this.visible = true;
            setTimeout(() => {
                this.visible = false;
            }, 5000);
        },
    }
};
</script>

<style scoped>
.widget-container {
    position: fixed;
    top: 20px;
    right: 20px;
    background-color: #333;
    color: white;
    padding: 10px 20px;
    border-radius: 5px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    z-index: 1050;
}

.success {
    background-color: #4CAF50;
}

.error {
    background-color: #F44336;
}

.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s;
}

.fade-enter,
.fade-leave-to {
    opacity: 0;
}
</style>
