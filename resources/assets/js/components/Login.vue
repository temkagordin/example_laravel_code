<script>
    export default {

        data() {
            return {
                email: null,
                password: null,
                error: false
            }
        },
        methods: {
            login() {
                var app = this
                this.$auth.login({
                    params: {
                        email: app.email,
                        password: app.password
                    },
                    success: function () {
                    },
                    error: function () {
                    },
                    rememberMe: true,
                    redirect: '/dashboard',
                    fetchUser: true,
                });
            },
        },
        template: require('../views/login.html'),
        name:
            "Login"
    }
</script>

<style scoped>

</style>