<template>
	<div>
		<div class="btn-group-vertical sidenav" style="position:fixed;">
			<h5 style="font-weight:600;">&nbsp Hi, {{ auth.name }} </h5>
			<button type="button" class="btn btn-primary" v-if="$route.name == 'dashboard'" @click="(()=>{$router.push({ path: '/myposts' })})">View My Posts</button>
			<button type="button" class="btn btn-primary" v-if="$route.name == 'myposts'" @click="(()=>{$router.push({ path: '/dashboard' })})">Dashboard</button>

			<button type="button" class="btn btn-primary" @click="(()=>{$router.push({ path: '/create' })})">Create Post</button>
			<button type="button" class="btn btn-primary" @click="(()=>{$router.push({ path: '/logout' })})">Logout</button>
		</div>
	</div>
</template>
<script>
	import {mapGetters} from 'vuex'

	export default {
		data(){
            return {}
        },
        computed:{
            ...mapGetters({ auth: 'getAuth' }),
        },
        watch:{},
		async mounted() {}
	}
</script>
