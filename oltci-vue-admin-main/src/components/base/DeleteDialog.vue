<template>
    <v-dialog v-model="dialogDelete" max-width="400" persistent>

        <v-card>
            <v-alert border="top" type="warning" variant="text" prominent>
                {{$t('Are_you_sure_you_want_to_delete_this')}} {{ entity }}?
            </v-alert>
            <template v-slot:actions>

                <v-btn color="warning" @click="emits('confirm')" :loading="loading">
                    {{$t('Delete')}}
                </v-btn>

                <v-btn @click="emits('close')">
                    {{$t('Cancel')}}
                </v-btn>


            </template>
        </v-card>
    </v-dialog>
</template>

<script setup>
import { ref } from 'vue';
import { useI18n } from 'vue-i18n';

const { t } = useI18n();

const props = defineProps({ entity: String, loading: Boolean })

const dialogDelete = defineModel({ type: Boolean })

const emits = defineEmits(["confirm", "close"])

</script>