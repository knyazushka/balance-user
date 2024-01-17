<template>
    <Navbar/>
    <div class="container">
        <router-view/>
    </div>
</template>

<script>
import Navbar from "@/components/Navbar.vue";

export default {
    name: "App",
    components: {Navbar},
    methods: {
        logout(e) {
            console.log('ss')
            e.preventDefault()
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/logout')
                    .then(response => {
                        if (response.data.success) {
                            window.location.href = "/"
                        } else {
                            console.log(response)
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        }
    },
}
</script>
