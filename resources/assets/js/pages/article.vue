<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                32123
            </div>
            <v-right></v-right>
        </div>
    </div> <!-- /container -->
</template>
<script>
    import * as api from '../config/httpService'
    import right from '../components/right'
    export default {
        data() {
            return {
                datas: ''

            }
        },
        components: {
            'v-right': right,
        },
        mounted() {
            // api.fetch('/article')
            //     .then(res => {
            //         if (res.data.code == 200) {
            //             this.articles = res.data.data.lists;
            //         }
            //         console.log(this.articles);
            //     })
        }
    }
</script>
