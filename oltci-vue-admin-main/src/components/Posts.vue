<template>
    <v-card color="grey-lighten-5">
      <v-card-title class="d-flex justify-space-between align-center pa-5">
        <div>{{ $t('Articles') }}</div>
        <v-dialog max-width="500" v-model="dialogAddPost">
          <template v-slot:activator="{ props }">
            <v-btn
              prepend-icon="fa-plus"
              color="orange-darken-4"
              variant="outlined"
              v-bind="props"
              >{{ $t('Post') }}</v-btn
            >
          </template>
  
          <v-card :title="formTitle">
            <v-card-text class="mt-4">

              <v-text-field
                v-model="post.title"
                :label="$t('Title')"
                variant="outlined"
                density="comfortable"
              ></v-text-field>
  
              <v-text-field
                v-model="post.body"
                :label="$t('Body')"
                variant="outlined"
                density="comfortable"
              ></v-text-field>

                <input type="file" @change="handleFileUpload" accept="image/jpg" ref="fileInput"
                                        class="d-none">

                <v-hover v-slot="{ isHovering, props }">
                    <div class="d-flex justify-center align-end" v-bind="props">
                        <v-img :aspect-ratio="1" :src="post.media" :lazy-src="imageUrl" cover
                            class="main-image-component">
                            <template v-slot:placeholder>
                                <div class="d-flex align-center justify-center fill-height">
                                    <v-progress-circular v-if="imageUrl" color="grey-lighten-4"
                                        indeterminate></v-progress-circular>
                                </div>
                            </template>
                            <v-expand-transition>
                                    <v-btn @click="openFileInput" v-if="isHovering" block :ripple="false"
                                        rounded="0" flat
                                        class="text-none opacity-70 d-flex transition-fast-in-fast-out bg-grey-darken-4">
                                        {{ $t('Upload Image') }}
                                    </v-btn>
                            </v-expand-transition>
                        </v-img>
                    </div>
                </v-hover>
  
              <br />
              <div class="d-flex justify-end">
                <v-btn
                  :text="$t('Save')"
                  variant="text"
                  color="orange-darken-4"
                  @click="save"
                  :loading="loading"
                ></v-btn>
                <v-btn text="Close" variant="text" @click="closeAddPost"></v-btn>
              </div>
            </v-card-text>
          </v-card>
        </v-dialog>
      </v-card-title>
      <v-card-text>
        <v-row>
          <v-col cols="12" md="4" sm="4">
            <v-text-field
              v-model="search"
              :label="$t('Search')"
              prepend-inner-icon="mdi-magnify"
              variant="outlined"
              hide-details
              single-line
              density="compact"
            ></v-text-field>
          </v-col>
        </v-row>
      </v-card-text>
  
      <v-data-table
        :headers="headers"
        :items="posts"
        :search="search"
        class="bg-grey-lighten-5"
        :mobile="sm || xs"
        :loading="loading"
        :sort-by="[{ key: 'id', order: 'desc' }]"
      >
        <template v-slot:item.actions="{ item }">
          <v-btn
            size="x-small"
            class="me-2"
            variant="tonal"
            icon="mdi-pencil"
            @click="editPost(item)"
          ></v-btn>
          <v-btn
            size="x-small"
            color="red-darken-4"
            variant="tonal"
            icon="mdi-trash-can"
            @click="deletePost(item.id)"
          ></v-btn>
        </template>
        <template v-slot:item.media="{ item }">
            <v-img :src="item.media" width="100" height="100" aspect-ratio="1" cover></v-img>
        </template>
      </v-data-table>
    </v-card>
  
    <DialogDelete
      v-model="dialogDelete"
      @confirm="deletePostConfirm"
      @close="closeDeletePost"
      entity="post"
      :loading="loading"
    />
  </template>
  
  <script setup>
  import { ref, computed, watch, onMounted } from "vue";
  import { usePostStore } from "../stores/posts";
  import { useSnackbarStore } from "../stores/snackbar";
  import { useDisplay } from "vuetify";
  import { storeToRefs } from "pinia";
  import DialogDelete from "../components/base/DeleteDialog.vue";
  
  import { useI18n } from "vue-i18n";
  
  const { t } = useI18n();
  
  
  const { xs, sm } = useDisplay();
  
  const store = usePostStore();

  
  const { posts, loading, response } = storeToRefs(store);
  
  const search = ref("");
  
  const headers = [
    {
      align: "start",
      key: "id",
      title: "ID",
    },
    { key: "user.username", title: t('User') },
    { key: "media", title: t('Media') },
    { key: "title", title: t('Title') },
    { key: "body", title: t('Body') },
    { key: "actions", title: t('Actions'), align: "end", sortable: false, width:"10%" },
  ];
  
  const dialogAddPost = ref(false);
  const dialogDelete = ref(false);
  const editedIndex = ref(-1);
  
  const formTitle = computed(() => {
    return editedIndex.value === -1 ? t('Create New Post') : t('Edit Post');
  });

  const user = ref("");
  
  const post = ref({
    id: "",
    media: "",
    body: "",
    user_id: ""
  });
  
  const defaultPost = {
    id: "",
    media: "",
    body: "",
    user_id: ""
  };

  const fileInput = ref(null)
  const imageUrl = ref("")
  const imagesUrl = ref([])
  const file = ref("")
  
  const editPost = (item) => {
    console.log('before', item)
    dialogAddPost.value = true;
    editedIndex.value = posts.value.indexOf(item);
    console.log('after', item)
    post.value.id = item.id;
    post.value.body = item.body;
    post.value.media = item.media;
    post.value.user_id = user.id;
    user.value = Object.assign({}, item.user);
  };

  const getUserId = (val) => {
  post.value.user_id = val;
};
  
  
  const deletePost = (id) => {
    post.value.id = id;
    dialogDelete.value = true;
  };

  const openFileInput = () => {
    fileInput.value.click()
}

  const handleFileUpload = (event) => {
    file.value = event.target.files[0]
    imageUrl.value = URL.createObjectURL(file.value)
    post.value.media = file.value
}
  
  async function initialize() {
    await store.fetchPosts();
  }
  
  onMounted(async () => {
    await store.fetchPosts();
    // await userStore.fetchUsers();
  });
  
  const save = async () => {
    if (editedIndex.value > -1) {
      await store.handleUpdatedPost(post.value, post.value.id);
      if (response.value.status === 200 || response.value.status === 204) {
        initialize();
        closeAddPost();
        snackbarShow("Data has been updated successfully", "success");
      } else {
        snackbarShow("Unable to update data. Please try again.", "error");
      }
    } else {
      await store.handleAddedPost(post.value);
      if (response.value.status === 200 || response.value.status === 201) {
        initialize();
        closeAddPost();
        snackbarShow("Data has been added successfully", "success");
      } else {
        snackbarShow("Unable to create data. Please try again.", "error");
      }
    }
    response.value = null;
  };
  
  const deletePostConfirm = async () => {
    await store.handleDeletedPost(post.value.id);
    if (response.value.status === 204) {
      initialize();
      closeDeletePost();
      snackbarShow("Data has been removed successfully", "success");
    } else {
      snackbarShow("Unable to remove data. Please try again.", "error");
    }
  };
  
  const closeDeletePost = () => {
    dialogDelete.value = false;
    post.value = Object.assign({}, defaultPost);
  };
  
  const closeAddPost = async () => {
    dialogAddPost.value = false;
    setTimeout(() => {
      post.value = Object.assign({}, defaultPost);
      editedIndex.value = -1;
    }, 250);
  };
  
  const snackbarShow = (message, type) => {
    useSnackbarStore().showSnackbar(message, type);
  };
  
  watch(dialogAddPost, (val) => {
    val || closeAddPost();
  });
  
  initialize();
  </script>
  