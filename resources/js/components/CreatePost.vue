<template>
  <div class="card mt-4" :key="componentKey">
    <div class="card-header">New Post</div>
    <div class="card-body">
      <div
        v-if="status_msg"
        :class="{ 'alert-success': status, 'alert-danger': !status }"
        class="alert"
        role="alert"
      >{{ status_msg }}</div>
      <form>
        <div class="form-group">
          <label for="exampleFormControlInput1">Title</label>
          <input
            v-model="title"
            type="text"
            class="form-control"
            id="title"
            placeholder="Post Title"
            required
          />
        </div>
        <div class="form-group">
          <label for="exampleFormControlTextarea1">Post Content</label>
          <textarea v-model="body" class="form-control" id="post-content" rows="3" required></textarea>
        </div>
        <div class>
          <el-upload
            action="https://jsonplaceholder.typicode.com/posts/"
            list-type="picture-card"
            :on-preview="handlePictureCardPreview"
            :on-change="updateImageList"
            :auto-upload="false"
          >
            <i class="el-icon-plus"></i>
          </el-upload>
          <el-dialog :visible.sync="dialogVisible">
            <img width="100%" :src="dialogImageUrl" alt />
          </el-dialog>
        </div>
      </form>
    </div>
    <div class="card-footer">
      <button
        type="button"
        @click="createPost"
        class="btn btn-success"
      >{{ isCreatingPost ? "Posting..." : "Create Post" }}</button>
    </div>
  </div>
</template>

<style>
.avatar-uploader .el-upload {
  border: 1px dashed #d9d9d9;
  border-radius: 6px;
  cursor: pointer;
  position: relative;
  overflow: hidden;
}
.avatar-uploader .el-upload:hover {
  border-color: #409eff;
}
.avatar-uploader-icon {
  font-size: 28px;
  color: #8c939d;
  width: 178px;
  height: 178px;
  line-height: 178px;
  text-align: center;
}
.avatar {
  width: 178px;
  height: 178px;
  display: block;
}
</style>

<script>
import { setTimeout } from "timers";
import { mapState, mapActions } from "vuex";

export default {
  name: "create-post",
  props: ["posts"],
  data() {
    return {
      dialogImageUrl: "",
      dialogVisible: false,
      imageList: [],
      status_msg: "",
      status: "",
      isCreatingPost: false,
      title: "",
      body: "",
      componentKey: 0
    };
  },
  computed: {},
  mounted() {},
  methods: {
    ...mapActions(["getAllPosts"]),
    updateImageList(file) {
      this.imageList.push(file.raw);
    },
    handlePictureCardPreview(file) {
      this.dialogImageUrl = file.url;
      this.imageList.push(file);
      this.dialogVisible = true;
    },
    createPost(e) {
      e.preventDefault();
      if (!this.validateForm()) {
        return false;
      }
      const that = this;
      this.isCreatingPost = true;
      let formData = new FormData();

      formData.append("title", this.title);
      formData.append("body", this.body);

      $.each(this.imageList, function(key, image) {
        formData.append(`images[${key}]`, image);
      });

      api
        .post("/post/create_post", formData, {
          headers: { "Content-Type": "multipart/form-data" }
        })
        .then(res => {
          this.title = this.body = "";
          this.status = true;
          this.showNotification("Post Successfully Created");
          this.isCreatingPost = false;
          this.imageList = [];
          /*
           this.getAllPosts() can be used here as well
           note: "that" has been assigned the value of "this" at the top
           to avoid context related issues.
           */
          that.getAllPosts();
          that.componentKey += 1;
        });
    },
    validateForm() {
      //no vaildation for images - it is needed
      if (!this.title) {
        this.status = false;
        this.showNotification("Post title cannot be empty");
        return false;
      }
      if (!this.body) {
        this.status = false;
        this.showNotification("Post body cannot be empty");
        return false;
      }
      return true;
    },
    showNotification(message) {
      this.status_msg = message;
      setTimeout(() => {
        this.status_msg = "";
      }, 3000);
    }
  }
};
</script>
