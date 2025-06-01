const { createApp } = Vue;

createApp({
    data() {
        return {
            saludo: 'Hi world (Vue 3)'
        }
    }
}).mount('#app');
