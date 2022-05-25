<template>
    <div>
        <h1>Dang dang nhap voiws gg</h1>
    </div>
</template>

<script>
export default {
    name: 'LoginGG',

    methods: {
        loginGGcallBack() {
            this.axios.get('http://127.0.0.1:8000/api/login/google/callback', {
                params: {
                    code: this.$route.query.code
                }
            }).then(response => {
                // console.log(response.data.user['id']);
                window.localStorage.setItem('token', response.data.access_token);//store token in local storage
                window.localStorage.setItem('idKH', response.data.user['id']);

                if (response.data.url) {
                    window.location.href = response.data.url;
                }
                this.$router.push('/');//redirect to home page
            })
        },
    },
    created() {
        this.loginGGcallBack();
    },

}
</script>