<template>
    <v-card color="grey-lighten-5">

        <v-card-title class="d-flex justify-space-between align-center pa-5">
            <div>{{$t('Users')}}</div>
            <v-btn prepend-icon="fa-plus" color="orange-darken-4" variant="outlined" @click="editUser">{{ $t('User') }}</v-btn>
        </v-card-title>
        <v-card-text>
            <v-row>
                <v-col cols="12" md="4" sm="4">
                    <v-text-field v-model="search" :label="$t('Search')" prepend-inner-icon="mdi-magnify" variant="outlined"
                        hide-details single-line density="compact"></v-text-field>
                </v-col>

            </v-row>

        </v-card-text>

        <v-data-table :headers="headers" :items="users" :search="search" class="bg-grey-lighten-5" :mobile="sm || xs"
            :sort-by="[{ key: 'id', order: 'desc' }]">
            <template v-slot:item.actions="{ item }">
                <v-btn size="x-small" class="me-2" variant="tonal" icon="mdi-pencil" @click="editUser(item)"></v-btn>
                <v-btn size="x-small" color="red-darken-4" variant="tonal" icon="mdi-trash-can"
                    @click="deleteUser(item.id)"></v-btn>
            </template>
            <template v-slot:item.is_active="{ item }">
                <v-chip v-if="item.is_active" color="light-blue-darken-2">
                    {{ $t('Active') }}
                </v-chip>
                <v-chip v-else color="red-darken-2">
                    {{ $t('Inactive') }}
                </v-chip>
            </template>
        </v-data-table>
    </v-card>


    <v-dialog max-width="500" v-model="dialogAddUser">

        <v-card :title="formTitle">
            <v-card-text class="mt-4">
                <v-row>
                    <v-col>
                        <v-text-field v-model="user.name" :label="$t('Name')" variant="outlined"
                            density="comfortable"></v-text-field>
                    </v-col>
                    <v-col>
                        <v-text-field v-model="user.lastname" :label="$t('Last_name')" variant="outlined"
                            density="comfortable"></v-text-field>
                    </v-col>
                </v-row>
                <v-text-field v-model="user.email" :label="$t('Email')" variant="outlined"
                    density="comfortable"></v-text-field>
                <v-text-field v-model="user.phone" :label="$t('Phone')" variant="outlined"
                    density="comfortable"></v-text-field>
                <v-text-field v-model="user.username" :label="$t('Username')" variant="outlined"
                    density="comfortable"></v-text-field>
                <br>
                <div class="d-flex justify-end">
                    <v-btn :text="$t('Save')" variant="text" color="orange-darken-4" :loading="loading" @click="save"></v-btn>
                    <v-btn :text="$t('Close')" variant="text" @click="closeAddUser"></v-btn>
                </div>

            </v-card-text>

        </v-card>

    </v-dialog>

    <DialogDelete v-model="dialogDelete" @confirm="deleteUserConfirm" @close="closeDeleteUser" entity="user" />
</template>

<script setup>
import { ref, computed } from 'vue'
import { useUsersStore } from '../stores/users'
import { useDisplay } from "vuetify"
import { storeToRefs } from 'pinia'
import DialogDelete from "../components/base/DeleteDialog.vue";
import { useI18n } from 'vue-i18n';

const { t } = useI18n();


const store = useUsersStore()
const { users, loading, response } = storeToRefs(store)

const { xs, sm } = useDisplay();

const dialogAddUser = ref(false)
const dialogDelete = ref(false)
const editedIndex = ref(-1)

const search = ref('')
const headers = [
    {   
        align: 'start', key: 'id', title: t('ID'),
    },
    { key: 'name', title: t('Name')},
    { key: 'lastname', title: t('Last_name') },
    { key: 'email', title: t('Email') },
    { key: 'phone', title: t('Phone') },
    { key: 'username', title: t('Username') },
    { key: 'is_active', title: t('Activity') },
    { key: 'actions', title: t('Actions'), align: 'end', sortable: false, },
]

const user = ref({
    name: '',
    lastname: '',
    email: '',
    phone: '',
    username: '',
})

const defaultUser = {
    name: '',
    lastname: '',
    email: '',
    phone: '',
    username: '',
}

const formTitle = computed(() => {
    return editedIndex.value === -1 ? t('Create_new_user') : t('Edit_user')
});

const editUser = (item) => {
    dialogAddUser.value = true
    editedIndex.value = users.value.indexOf(item)
    user.value = Object.assign({}, item)
}

const save = async () => {
    if (editedIndex.value > -1) {
        await store.handleUpdatedUser(user.value, user.value.id);
        if (response.value) {
            initialize()
            closeAddUser()
        }
    } else {
        await store.handleAddedUser(user.value)
        if (response.value) {
            initialize()
            closeAddUser()
        }
    }
    response.value = null
}

const deleteUser = (id) => {
    editedIndex.value = id
    dialogDelete.value = true
}

const deleteUserConfirm = async () => {
    await store.handleDeletedUser(editedIndex.value)
    if (response.value) {
        initialize()
        closeDeleteUser()
    }
}


async function initialize() {
    await store.fetchUsers()

}

const closeAddUser = () => {
    dialogAddUser.value = false
    setTimeout(() => {
        user.value = Object.assign({}, defaultUser)
        editedIndex.value = -1
    }, 500)

}

const closeDeleteUser = () => {
    dialogDelete.value = false
    editedIndex.value = -1
}

initialize()
</script>