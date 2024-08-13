<template>
    <v-navigation-drawer v-model="drawer" color="grey-darken-4" :temporary="$vuetify.display.mobile">
      <v-list>


        <v-divider/>
        <v-list v-model:opened="open">
          <v-list-group value="Boats">
            <template v-slot:activator="{ props }">
              <v-list-item
                v-bind="props"
                prepend-icon="mdi-ferry"
                title="Boats"
              ></v-list-item>
            </template>

            <v-list-item :to="{ name: 'boats' }" prepend-icon="mdi-ferry">
              {{ $t('Boats') }}
            </v-list-item>
            <v-list-item :to="{ name: 'boat-logs' }" prepend-icon="mdi-book">
              {{ $t('Logs') }}
            </v-list-item>
            <v-list-item :to="{ name: 'boat-maintenance' }" prepend-icon="mdi-tools">
              {{ $t('Maintenance') }}
            </v-list-item>
            <v-list-item :to="{ name: 'boat-fueling' }" prepend-icon="mdi-fuel">
              {{ $t('Fueling') }}
            </v-list-item>
            <v-list-item :to="{ name: 'equipments' }" prepend-icon="mdi-cogs">
              {{ $t('Equipments') }}
            </v-list-item>

          </v-list-group>
        </v-list>




        <v-divider/>
        <v-list v-model:opened="open">
            <v-list-group value="Booking">
              <template v-slot:activator="{ props }">
                <v-list-item
                  v-bind="props"
                  prepend-icon="mdi-calendar-check"
                  title="Booking"
                ></v-list-item>
              </template>

              <v-list-item :to="{ name: 'reservations' }" prepend-icon="mdi-calendar-clock">
                {{ $t('Reservations') }}
              </v-list-item>
              <v-list-item :to="{ name: 'tours' }" prepend-icon="mdi-map-marker-path">
                {{ $t('Tours') }}
              </v-list-item>
              <v-list-item :to="{ name: 'trips' }" prepend-icon="mdi-bag-suitcase">
                {{ $t('Trips') }}
              </v-list-item>
              <v-list-item :to="{ name: 'catch-records' }" prepend-icon="mdi-fish">
                {{ $t('Catch Records') }}
              </v-list-item>
              <v-list-item :to="{ name: 'captains' }" prepend-icon="mdi-ship-wheel">
                {{ $t('Captains') }}
              </v-list-item>
              <v-list-item :to="{ name: 'regions' }" prepend-icon="mdi-earth">
                {{ $t('Regions') }}
              </v-list-item>
              <v-list-item :to="{ name: 'services' }" prepend-icon="mdi-handshake">
                {{ $t('Additional Services') }}
              </v-list-item>
          </v-list-group>
        </v-list>


        <v-divider/>
        <v-list v-model:opened="open">
            <v-list-group value="Accounting">
              <template v-slot:activator="{ props }">
                <v-list-item
                  v-bind="props"
                  prepend-icon="mdi-calculator"
                  title="Accounting"
                ></v-list-item>
              </template>

              <v-list-item :to="{ name: 'transactions' }" prepend-icon="mdi-swap-horizontal">
                {{ $t('Transaction') }}
              </v-list-item>
              <v-list-item :to="{ name: 'incomes' }" prepend-icon="mdi-cash">
                {{ $t('Incomes') }}
              </v-list-item>
              <v-list-item :to="{ name: 'expenses' }" prepend-icon="mdi-currency-usd-off">
                {{ $t('Expenses') }}
              </v-list-item>
              <v-list-item :to="{ name: 'invoices' }" prepend-icon="mdi-receipt">
                {{ $t('Invoices') }}
              </v-list-item>
              <v-list-item :to="{ name: 'Report' }" prepend-icon="mdi-trending-up">
                {{ $t('Reports') }}
              </v-list-item>
          </v-list-group>
        </v-list>
        <v-divider/>


        <v-list v-model:opened="open">
            <v-list-group value="Website">
              <template v-slot:activator="{ props }">
                <v-list-item
                  v-bind="props"
                  prepend-icon="mdi-web"
                  title="Website"
                ></v-list-item>
              </template>

              <v-list-item :to="{ name: 'posts' }" prepend-icon="mdi-newspaper">
                {{ $t('Blog') }}
              </v-list-item>

              <v-list-item :to="{ name: 'subscribers' }" prepend-icon="mdi-account-group">
                {{ $t('Subscribers') }}
              </v-list-item>

          </v-list-group>
        </v-list>

        <v-divider/>

        
        <v-list v-model:opened="open">
            <v-list-group value="Users">
              <template v-slot:activator="{ props }">
                <v-list-item
                  v-bind="props"
                  prepend-icon="mdi-account"
                  title="Users"
                ></v-list-item>
              </template>

              <v-list-item :to="{ name: 'users' }" prepend-icon="mdi-account">
                {{ $t('Users') }}
              </v-list-item>

          </v-list-group>
        </v-list>

        <v-divider/>
      </v-list>
    </v-navigation-drawer>
  </template>
  
  <script setup>
  import { useRoute, useRouter } from 'vue-router';
  import { useI18n } from 'vue-i18n';

  import { ref } from 'vue'

  const panel = ref([0, 1])
  const disabled = ref(false)
  
  const { locale } = useI18n();
  
  const drawer = defineModel({
    type: Boolean,
  });
  
  const route = useRoute();
  const router = useRouter();


  const open = ref(['Users'])

  const admins = [
    ['Management', 'mdi-account-multiple-outline'],
    ['Settings', 'mdi-cog-outline'],
  ]
  const cruds = [
    ['Create', 'mdi-plus-outline'],
    ['Read', 'mdi-file-outline'],
    ['Update', 'mdi-update'],
    ['Delete', 'mdi-delete'],
  ]


  // export default {
  //   data: () => ({
  //     open: ['Users'],
  //     admins: [
  //       ['Management', 'mdi-account-multiple-outline'],
  //       ['Settings', 'mdi-cog-outline'],
  //     ],
  //     cruds: [
  //       ['Create', 'mdi-plus-outline'],
  //       ['Read', 'mdi-file-outline'],
  //       ['Update', 'mdi-update'],
  //       ['Delete', 'mdi-delete'],
  //     ],
  //   }),
  // }



  </script>
  