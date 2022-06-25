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
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary" @click="(()=>{$router.push({ path: `/edit/${post.id}` })})">Edit</button>
                                <button type="button" class="btn btn-primary" @click="setSelectedPost(post)" data-toggle="modal" data-target="#myModal">Delete</button>
                            </div>
                        </div>
                    </div>
                    <div v-else>
                        <h3>No post yet.</h3>
                    </div>
                </div>
            </div>
	    </div>
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal body -->
                    <div class="modal-body">
                        Do you want to delete this post? <br> 
                        Title: {{selected_post.title}}
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" @click="deletePost(selected_post.id)" data-dismiss="modal">Yes</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import sidenav from '../../common/sidenav.vue'
    import {mapGetters} from 'vuex'

	export default {
        data(){
            return {
                blog_posts: [],
                selected_post: {}
            }
        },
        components:{
			sidenav
		},
        methods:{
            setSelectedPost(post) { this.selected_post = post; },
            async deletePost(id)
            {
                await this.$api.auth.deletePost(id).then(response => {
                    this.$router.go();
                })
            }
        },
        computed:{
            ...mapGetters({ auth: 'getAuth' }),
        },
        watch:{},
		async mounted() {
            await this.$api.auth.getAllPostByUser().then(response => {
                this.blog_posts = response.data.data;
            })
        }
	}
</script>
