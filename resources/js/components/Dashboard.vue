<template>
    <div class="container">
        <h1>Баланс: {{ balance }}</h1>
        <div class="row">
            <div class="col-12">
                <LastOperation/>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "@/axios";
import LastOperation from "@/components/LastOperation.vue";

export default {
    name:"dashboard",
    components: {LastOperation},
    data(){
        return {
            balance: null,
        };
    },
    methods: {
        getBalance() {
            axios.post('/balance')
                .then((response) => {
                    this.balance = response.data.balance.balance;
                })
                .catch((error) => {
                    console.log(error);
                });
        }
    },
    mounted() {
        this.getBalance();
    },
    created(){
        this.interval = setInterval(() =>{
            this.getBalance()},5000)
    },
}
</script>
