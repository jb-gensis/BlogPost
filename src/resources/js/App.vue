<template>
	<router-view></router-view>
</template>
<script>
import axios from 'axios'
import {mapActions, mapState} from 'vuex'
export default {
    methods:{
        ...mapActions(['logout'])
    },
    computed: {
        ...mapState({
            user: state => state.auth.id,
        }),
    },
    mounted() {
        if (!this.user && this.$router.currentRoute.path == '/') {
            this.$router.push('/');
        }
    }
}
</script>
