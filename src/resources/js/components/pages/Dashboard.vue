<template>
	<div id="dashboard">
	    <div id="table-wrapper" class="container common-mrgn-top">
            <div class="row">
                <div class="col-sm-4">
                    <sidenav/>
                </div>
                <div class="col-sm-8">
                    <div v-if='auth.isLogin && blog_posts.length'>
                        <div v-for='post in blog_posts' 
                            :key='post.id' class="post-box">
                            <p class="title-post">{{ post.title }}</p>
                            <p class="user-post">Posted By: {{ post.user_name }}</p>
                            <p>{{ post.description }}</p>
                            <p class="date-post">Date Posted: {{ post.updated_at }}</p>
                        </div>
                    </div>
                    <div v-else>
                        <h3>No post yet.</h3>
                    </div>
                </div>
            </div>
	    </div>
    </div>
</template>

<script>
	import sidenav from '../common/sidenav.vue'
    import {mapGetters} from 'vuex'

	export default {
        data(){
            return {
                blog_posts: [],
            }
        },
        methods:{},
        components:{
			sidenav
		},
        computed:{
            ...mapGetters({ auth: 'getAuth' }),
        },
        watch:{},
		async mounted() {
            await this.$api.auth.getAllPost().then(response => {
                this.blog_posts = response.data.data;
            })
        }
	}
</script>
