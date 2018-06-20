<script>
    export default {
        data() {
            return {
                name: this.$route.query.name?this.$route.query.name:'',
                email: this.$route.query.email?this.$route.query.email:'',
                password: '',
                google_id: this.$route.query.google_id?this.$route.query.google_id:'',
                error: false,
                errors: {},
                success: false
            };
        },
        methods: {
            signup() {
                var app = this;
                this.$auth.register({
                    params: {
                        name: app.name,
                        email: app.email,
                        password: app.password,
                        google_id: app.google_id
                    },
                    success: function () {
                        app.success = true
                    },
                    error: function (resp) {
                        app.error = true;
                        app.errors = resp.response.data.errors;
                    },
                    redirect: null
                });
            },
        },
        template: require('../views/signup.html'),
        name: "SignUp"

    }
</script>

<style scoped>

</style>