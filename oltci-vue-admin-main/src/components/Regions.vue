<template>
    <v-card color="grey-lighten-5">

        <v-card-title class="d-flex justify-space-between align-center pa-5">
            <div>{{ $t('Regions') }}</div>
            <v-btn prepend-icon="fa-plus" color="orange-darken-4" variant="outlined" @click="editRegion">{{ $t('Region') }}</v-btn>
        </v-card-title>
        <v-card-text>
            <v-row>
                <v-col cols="12" md="4" sm="4">
                    <v-text-field v-model="search" :label="$t('Search')" prepend-inner-icon="mdi-magnify" variant="outlined"
                        hide-details single-line density="compact"></v-text-field>
                </v-col>

            </v-row>

        </v-card-text>

        <v-data-table :items="regions" :headers="headers" :search="search" class="bg-grey-lighten-5" :mobile="sm || xs"
            :sort-by="[{ key: 'id', order: 'desc' }]" :loading="loading">
            <template v-slot:item.actions="{ item }">

                <v-btn size="x-small" class="me-2" variant="tonal" icon="mdi-pencil" @click="editRegion(item)"></v-btn>
                <v-btn size="x-small" color="red-darken-4" variant="tonal" icon="mdi-trash-can"
                    @click="deleteRegion(item.id)"></v-btn>


            </template>
        </v-data-table>
    </v-card>


    <v-dialog max-width="500" v-model="dialogAddRegion">

        <v-card :title="formTitle">
            <v-card-text class="mt-4">

                <v-text-field v-model="region.location" :label="$t('Location')" variant="outlined"
                density="comfortable"></v-text-field>

                <v-textarea :label="$t('Description')" v-model="region.description" row-height="15" rows="3" variant="outlined"
                    auto-grow></v-textarea>

                <v-text-field v-model="region.longitude" :label="$t('Longitude')" variant="outlined"
                    density="comfortable"></v-text-field>
                
                <v-text-field v-model="region.latitude" :label="$t('Latitude')" variant="outlined"
                    density="comfortable"></v-text-field>
                <br>
                <div class="d-flex justify-end">
                    <v-btn :text="$t('Save')" variant="text" color="orange-darken-4" @click="save" :loading="loading"></v-btn>
                    <v-btn :text="$t('Close')" variant="text" @click="closeAddRegion"></v-btn>
                </div>

            </v-card-text>

        </v-card>

    </v-dialog>

    <DialogDelete v-model="dialogDelete" @confirm="deleteRegionConfirm" @close="closeDeleteRegion" entity="region"
        :loading="loading" />
</template>

<script setup>
import { ref, computed } from 'vue'
import { useRegionStore } from '../stores/regions'
import { useDisplay } from "vuetify"
import { storeToRefs } from 'pinia';
import { useSnackbarStore } from "../stores/snackbar";
import DialogDelete from "../components/base/DeleteDialog.vue";

import { useI18n } from 'vue-i18n';

const { t } = useI18n();


const store = useRegionStore()
const { regions, loading, response } = storeToRefs(store)

const { xs, sm } = useDisplay();



const dialogAddRegion = ref(false)
const dialogDelete = ref(false)
const editedIndex = ref(-1)

const search = ref('')
const headers = [
    {
        align: 'start', key: 'id', title: t('ID'),
    },
    { key: 'location', title: t('Location') },
    { key: 'description', title: t('Description'), width: "40%" },
    { key: 'latitude', title: t('Latitude') },
    { key: 'longitude', title: t('Longitude') },
    { key: 'actions', title: t('Actions'), align: 'end', sortable: false, },
]

const region = ref({
    name: '',
    description: '',
    location: '',
    longitude: '',
    latitude: ''
})

const defaultRegion = {
    name: '',
    description: '',
    location: '',
    longitude: '',
    latitude: ''
}


const formTitle = computed(() => {
    return editedIndex.value === -1 ? t('Create_new_region') : t('Edit_region')
});

const editRegion = (item) => {
    dialogAddRegion.value = true
    editedIndex.value = regions.value.indexOf(item)
    region.value = Object.assign({}, item)
}

const deleteRegion = (id) => {
    editedIndex.value = id
    dialogDelete.value = true
}

const save = async () => {
    if (editedIndex.value > -1) {
        await store.handleUpdatedRegion(region.value, region.value.id);
        if (response.value.status === 200 || response.value.status === 204) {
            initialize()
            closeAddRegion()
            snackbarShow(t('Data_has_been_added_successfully'), t('success'))
        } else {
            snackbarShow(`${t('Unable_to_create_data')}. ${t('Please_try_again')}`, t('error'));
        }
    } else {
        await store.handleAddedRegion(region.value)
        if (response.value.status === 200 || response.value.status === 201) {
            initialize()
            closeAddRegion()
            snackbarShow(t('Data_has_been_added_successfully'), t('success'))
        } else {
            snackbarShow(`${t('Unable_to_create_data')}. ${t('Please_try_again')}`, t('error'));
        }
    }
    response.value = null;
}



async function initialize() {
    await store.fetchRegions()

}

const deleteRegionConfirm = async () => {
    await store.handleDeletedRegion(editedIndex.value)

    if (response.value.status === 204) {
        initialize()
        closeDeleteBoat()
        snackbarShow(t('Data_has_been_removed_succesfully'), 'success')
    } else {
        snackbarShow(`${t('Unable_to_remove_data')}. ${t('Please_try_again')}`, t('error'));
    }

}

const closeAddRegion = async () => {
    dialogAddRegion.value = false
    setTimeout(() => {
        region.value = Object.assign({}, defaultRegion)
        editedIndex.value = -1
    }, 500)

}

const closeDeleteRegion = () => {
    dialogDelete.value = false
    editedIndex.value = -1
}

const snackbarShow = (message, type) => {
    useSnackbarStore().showSnackbar(message, type);
}

initialize()
</script>