<template>
    <v-card color="grey-lighten-5">
        <v-card-title class="d-flex justify-space-between align-center pa-5">
            <div>{{ $t('Captains') }}</div>
            <v-dialog max-width="900" v-model="dialogAddCaptain">
                <template v-slot:activator="{ props }">
                    <v-btn prepend-icon="fa-plus" color="orange-darken-4" variant="outlined"
                        v-bind="props">{{ $t('Captain') }}</v-btn>
                </template>

                <v-card :title="formTitle">
                    <v-card-text class="mt-4">
                        <v-row dense>
                            <v-col cols="12" sm="6">
                                <v-row dense>
                        
                                    <v-col>
                                        <v-text-field v-model="captain.first_name" :label="$t('First_name')" variant="outlined"
                                            density="comfortable"></v-text-field>
                                    </v-col>
                                    <v-col>
                                        <v-text-field v-model="captain.last_name" :label="$t('Last_name')" variant="outlined"
                                            density="comfortable"></v-text-field>
                                    </v-col>

                                </v-row>
                                <v-row dense>
                                    <v-col>
                                        <DatePicker :label="$t('Date_of_birth')" v-model="captain.date_of_birth"
                                            variant="outlined" density="comfortable" />
                                    </v-col>
                                </v-row>

                                <v-row dense>
                                    <v-col>
                                        <v-text-field v-model="captain.email" :label="$t('Email')" variant="outlined"
                                            density="comfortable"></v-text-field>
                                    </v-col>
                                </v-row>

                                <v-row dense>

                                    <v-col>
                                        <v-text-field v-model="captain.phone" :label="$t('Phone')" variant="outlined"
                                            density="comfortable"></v-text-field>
                                    </v-col>
                                </v-row>


                                <v-row dense>
                                    <v-col>
                                        <v-textarea v-model="captain.address" rows="3" :label="$t('Address')"
                                            variant="outlined" density="comfortable"></v-textarea>
                                    </v-col>
                                </v-row>
                            </v-col>
                            <v-col cols="12" sm="6">
                                <input type="file" @change="handleFileUpload" accept="image/jpg" ref="fileInput"
                                    class="d-none">
                                <v-hover v-slot="{ isHovering, props }">
                                    <div class="d-flex justify-center align-end" v-bind="props">

                                        <v-img :aspect-ratio="1" :src="imageUrl" :lazy-src="imageUrl" cover
                                            class="add-image-component">
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
                                                    {{ $t('Upload_photo') }}
                                                </v-btn>
                                            </v-expand-transition>
                                        </v-img>
                                    </div>
                                </v-hover>
                            </v-col>
                        </v-row>

                        <v-row dense>
                            <v-col cols="12" sm="4">
                                <v-text-field v-model="captain.years_of_experience" :label="$t('Years_of_experience')"
                                    variant="outlined" density="comfortable"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="4">
                                <v-text-field v-model="captain.average_rating" :label="$t('Average_rating')" variant="outlined"
                                    density="comfortable"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="4">

                                <v-select :label="$t('Availability_status')" v-model="captain.availability_status"
                                    :items="availability_items" variant="outlined" density="comfortable" 
                                    item-title="name" item-value="value"></v-select>
                            </v-col>
                        </v-row>

                        <v-row dense>
                            <v-col cols="12" sm="4">
                                <v-text-field v-model="captain.emergency_contact_name" :label="$t('Emergency_contact_name')"
                                    variant="outlined" density="comfortable"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="4">
                                <v-text-field v-model="captain.emergency_contact_relation"
                                    :label="$t('Emergency_contact_relation')" variant="outlined"
                                    density="comfortable"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="4">
                                <v-text-field v-model="captain.emergency_contact_phone" :label="$t('Emergency_contact_phone')"
                                    variant="outlined" density="comfortable"></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row dense>
                            <v-col cols="12" sm="6">
                                <v-text-field v-model="captain.license_number" :label="$t('License_number')" variant="outlined"
                                    density="comfortable"></v-text-field>
                            </v-col>
                            <v-spacer></v-spacer>

                        </v-row>




                        <!-- <v-autocomplete v-model="region" label="Region" variant="outlined" item-title="location"
                            item-value="id" density="comfortable" @update:modelValue="getRegionId"
                            :items="regionStore.regions"></v-autocomplete>

                        <v-text-field prefix="$" v-model="tour.price" label="Price" variant="outlined"
                            density="comfortable"></v-text-field> -->


                        <br>
                        <div class="d-flex justify-end">
                            <v-btn :text="$t('Save')" variant="text" color="orange-darken-4" @click="save"
                                :loading="loading"></v-btn>
                            <v-btn :text="$t('Close')" variant="text" @click="closeAddCaptain"></v-btn>
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

        <v-data-table :headers="headers" :items="captains" :search="search" class="bg-grey-lighten-5" :mobile="sm || xs"
            :loading="loading" :sort-by="[{ key: 'id', order: 'desc' }]">
            <template v-slot:item.actions="{ item }">
                <v-btn size="x-small" class="me-2" variant="tonal" icon="mdi-pencil" @click="editCaptain(item)"></v-btn>
                <v-btn size="x-small" color="red-darken-4" variant="tonal" icon="mdi-trash-can"
                    @click="deleteCaptain(item.id)"></v-btn>
            </template>
            <template v-slot:item.profile_picture="{ item }">
                <v-img :src="item.profile_picture" width="100" height="100" aspect-ratio="1" cover></v-img>
            </template>
            <template v-slot:item.average_rating="{ item }">
                <v-rating v-model="item.average_rating" color="yellow" length="5" dense readonly></v-rating>
            </template>
        </v-data-table>
    </v-card>
    <DialogDelete v-model="dialogDelete" @confirm="deleteCaptainConfirm" @close="closeDeleteCaptain" entity="captain"
        :loading="loading" />
</template>

<script setup>

import { ref, computed, watch } from 'vue'
import { useCaptainStore } from '../stores/captains'
import { useSnackbarStore } from "../stores/snackbar";
import { useDisplay } from "vuetify"
import { storeToRefs } from 'pinia'
import DialogDelete from "../components/base/DeleteDialog.vue"
import DatePicker from "../components/base/DatePicker.vue"
import { useI18n } from 'vue-i18n';

const { t } = useI18n();

const { xs, sm } = useDisplay()

const store = useCaptainStore()


const { captains, loading, response } = storeToRefs(store)


const search = ref('')

const headers = [
    {
        align: 'start', key: 'id', title: 'ID',
    },
    { key: 'profile_picture', title: t('Profile Picture'), width: "10%" },
    { key: 'first_name', title: t('First_name') },
    { key: 'last_name', title: t('Last_name') },
    { key: 'years_of_experience', title: t('Years of Experience') },
    { key: 'email', title: t('Email') },
    { key: 'phone', title: t('Phone') },
    { key: 'average_rating', title: t('Rating'), width:"20%"},
    { key: 'actions', title: t('Actions'), align: 'end', sortable: false, },
]


const dialogAddCaptain = ref(false)
const dialogDelete = ref(false)
const editedIndex = ref(-1)

const fileInput = ref(null)
const imageUrl = ref("")
const file = ref("")

const availability_items = [
    { name: "Available", value: true },
    { name: "Not Available", value: false }
]

const formTitle = computed(() => {
    return editedIndex.value === -1 ? t('Create_new_captain') : t('Edit_captain')
})

const captain = ref({
    first_name: '',
    last_name: '',
    date_of_birth: '',
    email: '',
    phone: '',
    address: '',
    profile_picture: '',
    years_of_experience: '',
    average_rating: '',
    availability_status: null,
    emergency_contact_name: '',
    emergency_contact_relation: '',
    emergency_contact_phone: '',
    license_number: ''
})

const defaultCaptain = {
    first_name: '',
    last_name: '',
    date_of_birth: '',
    email: '',
    phone: '',
    address: '',
    profile_picture: '',
    years_of_experience: '',
    average_rating: '',
    availability_status: null,
    emergency_contact_name: '',
    emergency_contact_relation: '',
    emergency_contact_phone: '',
    license_number: ''
}



const openFileInput = () => {
    fileInput.value.click()
}

const handleFileUpload = (event) => {
    file.value = event.target.files[0]
    imageUrl.value = URL.createObjectURL(file.value)
    captain.value.profile_picture = file.value
}


const editCaptain = (item) => {
    dialogAddCaptain.value = true
    editedIndex.value = captains.value.indexOf(item)
    captain.value = Object.assign({}, item)
    imageUrl.value = item.profile_picture
}


const deleteCaptain = (id) => {
    captain.value.id = id
    dialogDelete.value = true
}


async function initialize() {
    await store.fetchCaptains()
}

function formType() {
    const formData = new FormData()

    for (const key in captain.value) {
        formData.append(key, captain.value[key]);
    }
    return formData;

}

const save = async () => {
    const data = formType()
    if (editedIndex.value > -1) {
        await store.handleUpdatedCaptain(data, captain.value.id);
        if (response.value.status === 200 || response.value.status === 204) {
            initialize()
            closeAddCaptain()
            snackbarShow(t('Data_has_been_added_successfully'), t('success'))
        } else {
            snackbarShow(`${t('Unable_to_create_data')}. ${t('Please_try_again')}`, t('error'));
        }
        
    } else {
        await store.handleAddedCaptain(data)
        if (response.value.status === 200 || response.value.status === 201) {
            initialize()
            closeAddCaptain()
            snackbarShow(t('Data_has_been_added_successfully'), t('success'))
        } else {
            snackbarShow(`${t('Unable_to_create_data')}. ${t('Please_try_again')}`, t('error'));
        }
    }
    response.value = null;
}

const deleteCaptainConfirm = async () => {
    await store.handleDeletedCaptian(captain.value.id)
    if (response.value.status === 204) {
        initialize()
        closeDeleteCaptain()
        snackbarShow(t('Data_has_been_removed_succesfully'), 'success')
    } else {
        snackbarShow(`${t('Unable_to_remove_data')}. ${t('Please_try_again')}`, t('error'));
    }


}

const closeDeleteCaptain = () => {
    dialogDelete.value = false
    captain.value = Object.assign({}, defaultCaptain)
}

const closeAddCaptain = async () => {
    dialogAddCaptain.value = false
    setTimeout(() => {
        captain.value = Object.assign({}, defaultCaptain)
        editedIndex.value = -1
        imageUrl.value = ""
    }, 250)

}

const snackbarShow = (message, type) => {
    useSnackbarStore().showSnackbar(message, type);
}

watch(dialogAddCaptain, (val) => {
    val || closeAddCaptain()
})

initialize()
</script>

<style scoped>
.add-image-component {
    position: relative;
    background-image: url(../assets/profile-circle-svgrepo-com.svg);
    background-position: center;
    background-size: auto;
    max-height: 320px;
    max-width: 320px;
    border: 2px dashed;
    border-radius: 6px;
    border-color: #757575;
    display: flex;
    justify-content: center;
    align-items: end;
}
</style>
