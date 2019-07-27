<template>
  <div class="row">
    <div class="col-md-6" v-for="(post, i) in posts" :key=i>
      <div class="card mt-4">
        <img v-if="post.post_images.length" class="card-img-top" :src="post.post_images[0].post_image_path" alt="Card image cap">
        <img v-if="!post.post_images.length" class="card-img-top" src="https://images.pexels.com/photos/949587/pexels-photo-949587.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="Card image cap">
        <div class="card-body">
          <p class="card-text">
            <strong>{{ post.title }}</strong> <br>
            {{ truncateText(post.body) }}
          </p>
        </div>
        <button class="btn btn-success m-2" @click="viewPost(i)">View Post</button>
      </div>
    </div>
    <el-dialog v-if="currentPost" :visible.sync="postDialogVisible"
      width="40%">
      <span>
        <h3>{{ currentPost.title }}</h3>
        <div class="row">
          <div class="col-md-6" v-for="(img, i) in currentPost.post_images" :key=i>
            <img :src="img.post_image_path" class="img-thumbnail" alt="">
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-md-12">
            <h4>{{ currentPost.body }}</h4>
          </div>
        </div>
      </span>
      <span slot="footer" class="dialog-footer">
        <el-button type="primary" @click="postDialogVisible = false">Okay</el-button>
      </span>
    </el-dialog>
  </div>
</template>

<script>
import { mapState } from 'vuex';

export default {
  name: 'all-posts',
  data() {
    return {
      postDialogVisible: false,
      currentPost: '',
    };
  },
  computed: {
    ...mapState(['posts'])
  },
  beforeMount() {
    this.$store.dispatch('getAllPosts');
  },
  methods: {
    truncateText(text) {
      if (text.length > 24) {
        return `${text.substr(0, 24)}...`;
      }
      return text;
    },
    viewPost(postIndex) {
      const post = this.posts[postIndex];
      this.currentPost = post;
      this.postDialogVisible = true;
    }
  },
}
</script>