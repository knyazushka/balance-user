<template>
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12 col-md-6 offset-md-3">
                <div class="card shadow sm">
                    <div class="card-body">
                        <h1 class="text-center">Вход</h1>
                        <hr/>
                        <form @submit.prevent="login" class="row" method="post">
                            <div class="form-group col-12">
                                <label for="email" class="font-weight-bold">Email</label>
                                <input type="text" v-model="email" name="email" id="email" class="form-control">
                            </div>
                            <div class="form-group col-12 my-2">
                                <label for="password" class="font-weight-bold">Пароль</label>
                                <input type="password" v-model="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="col-12 mb-2">
                                <button type="submit" @click="login" class="btn btn-primary btn-block">Вход</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "@/axios";
export default {
    data() {
        return {
            email: "",
            password: "",
        };
    },
    methods: {
        async login() {
            try {
                const response = await axios.post("/login", {
                    email: this.email,
                    password: this.password,
                });

                if (response.data.token) {
                    localStorage.setItem('token', response.data.token);
                }

                this.$store.commit('LOGIN');
                this.$router.push('/');
            } catch (error) {
                console.log(error);
            }
        }
    }
}
</script>
