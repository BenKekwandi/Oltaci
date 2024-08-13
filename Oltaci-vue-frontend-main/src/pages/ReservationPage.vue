<template>
   <div class="page">
    <v-main>
          <section class="page my-5 bg-grey-lighten-5">
          <v-container fluid style="max-width: " class="page pl-16 pr-16 pt-8" :mobile="sm || xs">
            <v-row>
                
                <v-col cols="7">
                  <v-card-title class="text-h5 text-dark mb-5">
                    {{ $t('Profile') }}
                  </v-card-title>
                  <v-text-field v-model="user.name" :label="$t('Name')" variant="outlined" density="comfortable"></v-text-field>
                  <v-text-field v-model="user.lastname" :label="$t('Last Name')" variant="outlined" density="comfortable"></v-text-field>
                  <v-text-field v-model="user.email" :label="$t('Email')" variant="outlined" density="comfortable"></v-text-field>
                </v-col>

                <v-col cols="12" mt="10">
                    <v-card class="pa-5 mb-5 custom-card">
                        <v-card-title class="text-h6 text-dark">
                        {{ $t('Reservations') }}
                        </v-card-title>
                      
                        <v-data-table :items="memberReservations" :headers="headers" :search="search" class="bg-grey-lighten-5" :mobile="sm || xs"
                            :sort-by="[{ key: 'id', order: 'desc' }]" :loading="loading">

                            <template v-slot:item.has_been_paid="{ item }">

                                <v-chip v-if="item.has_been_paid" color="green">
                                    {{ $t('Paid') }}
                                </v-chip>
                                <v-chip v-else color="yellow-darken-2">
                                    {{ $t('Pending') }}
                                </v-chip>

                            </template>
                            <!-- <template v-slot:item.actions="{ item }">
                                <v-btn size="x-small" class="me-2" variant="tonal" icon="mdi-pencil" @click="viewReservation(item)"></v-btn>
                            </template> -->
                        </v-data-table>

                    </v-card>
                </v-col>

                <v-col cols="12" mt="10">
                  <v-card class="pa-5 mb-5 custom-card">
                    <v-card-title class="text-h6 text-dark">
                      {{ $t('Trips') }}
                    </v-card-title>
                      
                    <v-data-table :items="memberTrips" :headers="tripHeaders" :search="search" class="bg-grey-lighten-5" :mobile="sm || xs"
                      :sort-by="[{ key: 'id', order: 'desc' }]" :loading="loading">

                        <template v-slot:item.status="{ item }">
                          <v-chip v-if="item.status === 'SCHEDULED'" color="yellow-darken-2">
                            {{ $t('SCHEDULED') }}
                          </v-chip>
                          <v-chip v-else-if="item.status === 'COMPLETED'" color="blue-darken-2">
                            {{ $t('COMPLETED') }}
                          </v-chip>
                          <v-chip v-else-if="item.status === 'ONGOING'" color="green-darken-2">
                            {{ $t('ONGOING') }}
                          </v-chip>
                      </template>
                    </v-data-table>
                  </v-card>
            </v-col>
          </v-row>
        </v-container>
      </section>
    </v-main>

    <Footer />
   </div>

</template>
  
<script setup>
  import Navbar from "./../components/layouts/Navbar.vue";
  import Footer from "./../components/layouts/Footer.vue";
  import InfoCard from "./../components/base/infoCard.vue";
  import BoatCard from "./../components/base/BoatsCard.vue";
  import RegionCard from "./../components/base/RegionCard.vue";
  import Hero from "./../components/base/Hero.vue";
  import { useAuthStore } from "../stores/auth";
  import { useReservationStore } from "../stores/reservation";
  import { useTripStore } from "../stores/trips";
  import { storeToRefs } from "pinia";
  import { ref, onMounted } from "vue";
  import { useI18n } from "vue-i18n";

  const { t } = useI18n();
  
  const store = useAuthStore();
  const tripStore = useTripStore();
  const reservationStore = useReservationStore();

  const { user, fetchUser } = storeToRefs(store);
  const { memberReservations, fetchMemberReservations } = storeToRefs(reservationStore);
  const { memberTrips, fetchMemberTrips } = storeToRefs(tripStore);

  console.log('member Reservations', memberReservations)


  const headers = [
    {
        align: "start",
        key: "id",
        title: "ID",
    },
    { key: "tour.boat.name", title: t('Boat') },
    { key: "departure", title: t('Departure'), value: (item) => `${item.tour.departure.location}, ${item.departure_date}` },
    { key: "return", title: t('Return'), value: (item) => `${item.tour.destination.location}, ${item.return_date}` },
    { key: "total_price", title: t('Total Price') },
    { key: "currency", title: t('Currency') },
    { key: "number_of_people", title: t('Number Of People') },
    { key: 'has_been_paid', title: t('Confirmed') },
    // { key: "actions", title: t('Actions'), align: "end", sortable: false },
    ];

    const tripHeaders = [
  {
    align: "start",
    key: "id",
    title: "ID",
  },
  { key: "boat.name", title: t('Boat') },
  { key: "captain", title: t('Captain'), value: (item) => `${item.captain.first_name} ${item.captain.last_name}` },
  { key: "departure", title: t('Departure'), value: (item) => `${item.departure}, ${item.start}` },
  { key: "return", title: t('Return'), value: (item) => `${item.destination}, ${item.end}` },
  { key: "status", title: t('Status') },
  // { key: "actions", title: t('Actions'), align: "end", sortable: false },
];


  onMounted(async () => {
  await reservationStore.fetchMemberReservations(user.value.id);
  await tripStore.fetchMemberTrips(user.value.id)
});





  
</script>
  
  <style scoped>
  .hero-section {
    position: relative;
    width: 100%;
    height: 100vh;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  
  .video-background {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  
  .overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    z-index: 1;
  }
  
  .hero-title {
    font-size: 4rem;
    margin: 0;
  }
  
  .hero-subtitle {
    font-size: 1rem;
    margin-top: 1rem;
  }
  </style>
  