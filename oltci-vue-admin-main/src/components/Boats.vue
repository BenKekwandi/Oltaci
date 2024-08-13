<template>
    <v-card color="grey-lighten-5">

        <v-card-title class="d-flex justify-space-between align-center pa-5">
            <div>{{ $t('Boats') }}</div>

            <v-dialog max-width="800" v-model="dialogAddBoat">
                <template v-slot:activator="{ props }">
                    <v-btn prepend-icon="fa-plus" color="orange-darken-4" variant="outlined"
                        v-bind="props">{{ $t('Boats') }}</v-btn>
                </template>
                <v-card :title="formTitle">
                    <v-card-text class="mt-4">
                        <v-row>

                            <v-col cols="7">
                                <v-text-field v-model="boat.name" :label="$t('Name')" variant="outlined" density="comfortable"></v-text-field>

                                <v-text-field v-model="boat.capacity" :label="$t('Capacity')" variant="outlined" density="comfortable"></v-text-field>

                                <v-text-field v-model="boat.length" :label="$t('Length')" variant="outlined" density="comfortable"></v-text-field>

                                <v-text-field v-model="boat.width" :label="$t('Width')" variant="outlined" density="comfortable"></v-text-field>

                                <v-textarea v-model="boat.description" :label="$t('Description')" row-height="15" rows="3" variant="outlined" auto-grow></v-textarea>

                                <v-select v-model="boat.type" :label="$t('Type')" :items="['tour', 'fishing']" variant="outlined"></v-select>
                            </v-col>



                            <v-col cols="5">
                                <input type="file" @change="handleFileUpload" accept="image/jpg" ref="fileInput"
                                    class="d-none">

                                <v-hover v-slot="{ isHovering, props }">
                                    <div class="d-flex justify-center align-end" v-bind="props">

                                        <v-img :aspect-ratio="1" :src="imageUrl" :lazy-src="imageUrl" cover
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
                                                    {{ $t('Upload_main_image') }}
                                                </v-btn>
                                            </v-expand-transition>
                                        </v-img>
                                    </div>
                                </v-hover>

                                <!-- <v-btn class="my-4" prepend-icon="fa-plus" color="orange-darken-4" size="small"
                                    @click="openFilesInput">Add More
                                    Pictures</v-btn> -->
                            </v-col>

                        </v-row>

                        <div class="text-center">
                            <div class="mx-auto pa-2 more-image-component">
                                <!-- <div>
                                    <i class="icon fa-regular fa-circle-down" @click="openFilesInput"></i>
                                    <div class="text-caption mt-2">Add More Images</div>
                                </div> -->

                                <v-row>

                                    <v-col v-for="(imageUrl, index) in imagesUrl" :key="imageUrl"
                                        class="d-flex child-flex" cols="4">
                                        <v-img :src="imageUrl" aspect-ratio="16/9" :width="150"
                                            class="bg-grey-lighten-2" cover rounded>
                                            <v-row class="fill-height pa-0 ma-0" align="start" justify="end">
                                                <v-col class="d-flex justify-end align-end pa-2">
                                                    <v-btn icon="mdi-delete" size="x-small" variant="tonal"
                                                        @click="removeSelectedImage(index)"></v-btn>
                                                </v-col>
                                            </v-row>

                                            <template v-slot:placeholder>
                                                <v-row align="center" class="fill-height ma-0" justify="center">
                                                    <v-progress-circular color="grey-lighten-5"
                                                        indeterminate></v-progress-circular>
                                                </v-row>
                                            </template>
                                        </v-img>
                                    </v-col>
                                    <v-col cols="4">
                                        <v-hover v-slot="{ isHovering, props }">
                                            <v-card :class="{ 'on-hover': isHovering }" elevation="0" min-height="180"
                                                v-bind="props" class="child h-100">
                                                <v-card-text class="d-flex justify-center align-center h-100">
                                                    <div>
                                                        <v-btn @click="openFilesInput" icon="mdi-plus-circle-outline"
                                                            size="x-large" color="orange-darken-4" variant="tonal">
                                                        </v-btn>
                                                        <div class="text-caption mt-2">{{ $t('Add_more_Images')}}</div>
                                                    </div>
                                                </v-card-text>

                                            </v-card>
                                        </v-hover>
                                    </v-col>
                                </v-row>
                            </div>

                            <input type="file" @change="handleFilesUpload" accept="image/*" ref="filesInput"
                                class="d-none">
                        </div>

                        <br>
                        <div class="d-flex justify-end">
                            <v-btn :text="$t('Save')" variant="text" color="orange-darken-4" @click="save"
                                :loading="loading"></v-btn>
                            <v-btn :text="$t('Close')" variant="text" @click="closeAddBoat"></v-btn>
                        </div>
                    </v-card-text>
                </v-card>

            </v-dialog>
        </v-card-title>
        <v-card-text>
            <v-row>
                <v-col cols="12" md="4" sm="4">
                    <v-text-field v-model="search" label="Search" prepend-inner-icon="mdi-magnify" variant="outlined"
                        hide-details single-line density="compact"></v-text-field>
                </v-col>

            </v-row>

        </v-card-text>

        <v-data-table :items="boats" :headers="headers" :search="search" class="bg-grey-lighten-5" :mobile="sm || xs"
            :sort-by="[{ key: 'id', order: 'desc' }]" :loading="loading">

            <template v-slot:item.is_available="{ item }">

                <v-chip v-if="item.is_available" color="light-blue-darken-2">
                    {{ $t('Available') }}
                </v-chip>
                <v-chip v-else color="grey-darken-2">
                    {{ $t('Not Available') }}
                </v-chip>

            </template>
            <template v-slot:item.actions="{ item }">

                <v-btn size="x-small" class="me-2" variant="tonal" icon="mdi-pencil" @click="editBoat(item)"></v-btn>
                <v-btn size="x-small" color="red-darken-4" variant="tonal" icon="mdi-trash-can"
                    @click="deleteBoat(item.id)"></v-btn>
            </template>
            <template v-slot:item.picture="{ item }">
                <v-img :src="item.picture" width="100" height="100" aspect-ratio="1" cover></v-img>
            </template>
        </v-data-table>

    </v-card>


    <DialogDelete v-model="dialogDelete" @confirm="deleteBoatConfirm" @close="closeDeleteBoat" entity="boat"
        :loading="loading" />
</template>

<script setup>
import { ref, computed, watch } from 'vue'
import { useBoatStore } from '../stores/boats'
import { useDisplay } from "vuetify"
import { storeToRefs } from 'pinia';
import { useSnackbarStore } from "../stores/snackbar"
import DialogDelete from "../components/base/DeleteDialog.vue"

import { useI18n } from 'vue-i18n';

const { t } = useI18n();


const store = useBoatStore()
const { boats, loading, response } = storeToRefs(store)

const { xs, sm } = useDisplay();


const dialogAddBoat = ref(false)
const dialogDelete = ref(false)
const editedIndex = ref(-1)

const fileInput = ref(null)
const filesInput = ref(null)
const imageUrl = ref("")
const imagesUrl = ref([])
const file = ref("")


const search = ref('')
const headers = [
    {
        align: 'start', key: 'id', title: t('ID'),
    },
    { key: 'name', title: t('Name'), width: "10%" },
    { key: 'picture', title: t('Picture'), width: "10%" },
    { key: 'description', title: t('Description'), width: "15%" },
    { key: 'capacity', title: t('Capacity') },
    { key: 'height', title: t('Height') },
    { key: 'width', title: t('Width') },
    { key: 'capacity', title: t('Capacity') },
    { key: 'type', title: t('Type') },
    { key: 'is_available', title: t('Status') },
    { key: 'actions', title: t('Actions'), align: 'end', sortable: false, width: "10%"},
]

const boat = ref({
    name: '',
    description: '',
    type: null,
    picture: null,
    pictures: []
})

const defaultBoat = {
    name: '',
    description: '',
    type: null,
    picture: null,
    pictures: []
}

watch(() => boat.value.type, (newVal) => {
    if (newVal)
        boat.value.type = newVal.toLowerCase()
})



const formTitle = computed(() => {
    return editedIndex.value === -1 ? t('Create_new_boat') : t('Edit_boat')
})

const openFileInput = () => {
    fileInput.value.click()
}

const openFilesInput = () => {
    filesInput.value.value = null
    filesInput.value.click()
}


const handleFileUpload = (event) => {
    file.value = event.target.files[0]
    imageUrl.value = URL.createObjectURL(file.value)
    boat.value.picture = file.value
}

const handleFilesUpload = (event) => {

    file.value = event.target.files[0]
    imagesUrl.value.push(URL.createObjectURL(file.value))
    boat.value.pictures.push(file.value)
}

const removeSelectedImage = (index) => {
    imagesUrl.value.splice(index, 1)
    boat.value.pictures.splice(index, 1)
}

function formType() {
    const formData = new FormData()

    formData.append('name', boat.value.name);
    formData.append('description', boat.value.description);
    if (boat.type !== null) {
        formData.append('type', boat.value.type);
    }
    if (boat.picture !== null) {
        formData.append('picture', boat.value.picture);
    }
    boat.value.pictures.forEach((image, index) => {
        formData.append('pictures[]', image);
    });
    return formData;

}

const editBoat = (item) => {
    editedIndex.value = boats.value.indexOf(item)
    boat.value = Object.assign({}, item)
    dialogAddBoat.value = true
    imageUrl.value = item.picture
    item.pictures.forEach((data) => {
        imagesUrl.value.push(data.picture)
    })

    console.log(imagesUrl.value);
}

const deleteBoat = (id) => {
    editedIndex.value = id
    dialogDelete.value = true
}

const save = async () => {
    const data = formType()
    if (editedIndex.value > -1) {
        await store.handleUpdatedBoat(data, boat.value.id);
        if (response.value.status === 200 || response.value.status === 204) {
            initialize()
            closeAddBoat()
            snackbarShow('Data has been updated successfully', 'success')
        } else {
            snackbarShow('Unable to update data. Please try again.', "error")
        }
    } else {
        await store.handleAddedBoat(data)
        if (response.value.status === 200 || response.value.status === 201) {
            initialize()
            closeAddBoat()
            snackbarShow(t('Data_has_been_added_successfully'), t('success'))
        } else {
            snackbarShow(`${t('Unable_to_create_data')}. ${t('Please_try_again')}`, t('error'));
        }
    }
    response.value = null;
}



async function initialize() {
    await store.fetchBoats()

}

const deleteBoatConfirm = async () => {
    await store.handleDeletedBoat(editedIndex.value)
    if (response.value.status === 204) {
        initialize()
        closeDeleteBoat()
        snackbarShow(t('Data_has_been_removed_succesfully'), 'success')
    } else {
        snackbarShow(`${t('Unable_to_remove_data')}. ${t('Please_try_again')}`, t('error'));
    }

}

const closeAddBoat = async () => {
    dialogAddBoat.value = false
    setTimeout(() => {
        boat.value = Object.assign({}, defaultBoat, { pictures: [...defaultBoat.pictures] })
        editedIndex.value = -1
        imageUrl.value = ''
        imagesUrl.value = []

    }, 250)

}

const closeDeleteBoat = () => {
    dialogDelete.value = false
    editedIndex.value = -1
}

const snackbarShow = (message, type) => {
    useSnackbarStore().showSnackbar(message, type);
}

initialize()
</script>

<style scoped>
.main-image-component {
    position: relative;
    background-image: url(../assets/upload-image-svgrepo-com.svg);
    background-position: center;
    max-height: 250px;
    max-width: 320px;
    border: 2px dashed;
    border-radius: 6px;
    border-color: #BDBDBD;
    display: flex;
    justify-content: center;
    align-items: end;
}

.child {
    border: 1px dashed;
    border-color: #E65100;
}

.more-image-component {
    min-height: 180px;
    max-width: 100%;
    border: 1px solid;
    border-radius: 6px;
    border-color: #BDBDBD;
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>